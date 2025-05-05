<?php
require('../../config.php');
require_login();

$clientid = get_config('auth_singpass', 'clientid');
$redirecturi = get_config('auth_singpass', 'redirecturi');

$url = "https://test.api.myinfo.gov.sg/com/v4/authorize?" . http_build_query([
    'client_id' => $clientid,
    'redirect_uri' => $redirecturi,
    'response_type' => 'code',
    'scope' => 'openid email',
]);

redirect($url);