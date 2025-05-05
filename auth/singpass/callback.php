<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/filelib.php');

$code = required_param('code', PARAM_RAW);
$state = required_param('state', PARAM_RAW);

// Verify state
if (!isset($_SESSION['singpass_state']) || $_SESSION['singpass_state'] !== $state) {
    print_error('Invalid session state.');
}
unset($_SESSION['singpass_state']);

// Configuration
$client_id = 'sDRIq83pbDFJyJHrd7hIBtEX51RPVDbE';
$client_secret = 'YOUR_CLIENT_SECRET';
$redirect_uri = (new moodle_url('/auth/singpass/callback.php'))->out(false);

// Step 1: Exchange code for access token
$response = download_file_content('https://sandbox.api.singpass.gov.sg/v1/oauth/token', null, [
    'post' => true,
    'postfields' => http_build_query([
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
        'client_id' => $client_id,
        'client_secret' => $client_secret
    ]),
    'timeout' => 30
]);

$data = json_decode($response, true);
if (!isset($data['access_token'])) {
    print_error('Failed to retrieve access token.');
}

$access_token = $data['access_token'];

// Step 2: Get user info
$userinfo = download_file_content('https://sandbox.api.singpass.gov.sg/v1/oauth/userinfo', null, [
    'header' => ['Authorization: Bearer ' . $access_token],
    'timeout' => 30
]);

$userinfo = json_decode($userinfo, true);
if (!isset($userinfo['sub']) || !isset($userinfo['email'])) {
    print_error('Failed to retrieve user info.');
}

$email = strtolower(trim($userinfo['email']));

// Step 3: Check if email is already in Moodle
$user = $DB->get_record('user', ['email' => $email, 'auth' => 'singpass']);
if (!$user) {
    // Optionally, check other auth types too
    $user = $DB->get_record('user', ['email' => $email]);
    if ($user && $user->auth !== 'singpass') {
        // Optional: prevent login if auth is different
        print_error('Your email is registered with a different login method.');
    }
}

// Step 4: If no user found at all, show error
if (!$user) {
    echo $OUTPUT->header();
    echo $OUTPUT->notification('Your email address is not registered in this system. Please contact administrator.');
    echo $OUTPUT->footer();
    exit;
}

// Step 5: Update auth type (if needed)
if ($user->auth !== 'singpass') {
    $user->auth = 'singpass';
    user_update_user($user);
}

// Step 6: Complete login
complete_user_login($user);
redirect(new moodle_url('/my'));