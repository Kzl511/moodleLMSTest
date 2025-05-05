<?php
require_once(__DIR__ . '/../../config.php');
require_logout();

$client_id = get_config('auth_singpass', 'clientid');
$redirect_uri = get_config('auth_singpass', 'redirecturi');
$state = bin2hex(random_bytes(8));
$nonce = bin2hex(random_bytes(8));

$_SESSION['singpass_state'] = $state;
$_SESSION['singpass_nonce'] = $nonce;

$params = http_build_query([
    'response_type' => 'code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => 'openid',
    'state' => $state,
    'nonce' => $nonce
]);

$login_url = "https://stg-id.singpass.gov.sg/auth/realms/h2h/protocol/openid-connect/auth?$params";
redirect($login_url);