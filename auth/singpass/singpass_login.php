<?php
require('../../config.php');

$client_id = get_config('auth_singpass', 'clientid');
$redirect_uri = get_config('auth_singpass', 'redirecturi');
$state = bin2hex(random_bytes(8));
$nonce = bin2hex(random_bytes(8));

// --- PKCE: Generate code_verifier and code_challenge ---
$code_verifier = bin2hex(random_bytes(32)); // 64-character string
$_SESSION['code_verifier'] = $code_verifier; // Save for later during token exchange

// Create code_challenge (Base64 URL-encoded SHA256 hash of code_verifier)
$code_challenge = rtrim(strtr(base64_encode(hash('sha256', $code_verifier, true)), '+/', '-_'), '=');

// Save state and nonce to session for validation
$_SESSION['singpass_state'] = $state;
$_SESSION['singpass_nonce'] = $nonce;

$params = http_build_query([
    'response_type' => 'code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => 'openid',
    'state' => $state,
    'nonce' => $nonce,
    'code_challenge' => $code_challenge,
    'code_challenge_method' => 'S256'
]);

$login_url = "https://stg-id.singpass.gov.sg/auth/realms/h2h/protocol/openid-connect/auth?$params";
redirect($login_url);