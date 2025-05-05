<?php
require_once(__DIR__ . '/../../config.php');

$client_id = 'YOUR_CLIENT_ID';
$redirect_uri = new moodle_url('/auth/singpass/callback.php');
$state = bin2hex(random_bytes(16)); // CSRF protection

// Save state in session for verification in callback
$_SESSION['singpass_state'] = $state;

// Singpass authorization URL (sandbox/test endpoint example)
$auth_url = 'https://sandbox.api.singpass.gov.sg/v1/oauth/authorize?' . http_build_query([
    'response_type' => 'code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri->out(false),
    'scope' => 'openid',
    'state' => $state
]);

redirect($auth_url);