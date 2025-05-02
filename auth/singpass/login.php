<?php

use core\exception\moodle_exception;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir.'/authlib.php');

$client_id = get_config('auth_singpass', 'clientid');
$client_secret = get_config('auth_singpass', 'clientsecret');
$redirect_uri = (new moodle_url('/auth/singpass/login.php'))->out(false);
$auth_endpoint = 'https://www.ndi-api.gov.sg/idp/oauth2/authorize';
$token_endpoint = 'https://www.ndi-api.gov.sg/idp/oauth2/token';
$myinfo_endpoint = 'https://www.ndi-api.gov.sg/myinfo/v3/person';

if (!isset($_GET['code'])) {
    $state = bin2hex(random_bytes(16));
    $_SESSION['singpass_state'] = $state;

    $params = [
        'response_type' => 'code',
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'scope' => 'openid profile',
        'state' => $state,
    ];
    redirect($auth_endpoint . '?' . http_build_query($params));
} else {
    if ($_GET['state'] !== $_SESSION['singpass_state']) {
        throw new moodle_exception('Invalid State');
    } 

    $code = $_GET['code'];

    $response = download_file_content($token_endpoint, null, [
        'post' => true,
        'postfields' => http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ]),
    ]);

    $token = json_decode($response);
    if (!isset($token->access_token)) {
        throw new moodle_exception('Failed to get token');
    }
    
    $userinfo = download_file_content($myinfo_endpoint, null, [
        'headers' => ['Authorization: Bearer ' . $token->access_token]
    ]);

    $userinfo = json_decode($userinfo);

    $nric = $userinfo->uinfin ?? null;
    $name = $userinfo->name->value ?? 'Singpass User';

    if (!$nric) {
        throw new moodle_exception('Failed to retrieve NRIC');
    }

    $email = $nric . '@singpass.local';

    if ($user = get_complete_user_data('email', $email)) {
        complete_user_login($user);
    } else {
        print_error('auth_singpass_noaccount', 'auth_singpass');
    }

    redirect(new moodle_url('/'));
}