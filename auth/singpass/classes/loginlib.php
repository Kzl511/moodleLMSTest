<?php
namespace auth_singpass;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class loginlib {
    public static function exchange_code_for_user($code) {
        global $CFG;

        $client_id = get_config('auth_singpass', 'clientid');
        $redirect_uri = get_config('auth_singpass', 'redirecturi');
        $privateKey = file_get_contents($CFG->dirroot . '/auth/singpass/private.key');

        $jwt = JWT::encode([
            'iss' => $client_id,
            'sub' => $client_id,
            'aud' => 'https://stg-id.singpass.gov.sg/auth/realms/h2h/protocol/openid-connect/token',
            'exp' => time() + 300,
            'jti' => bin2hex(random_bytes(8))
        ], $privateKey, 'RS256');

        $data = http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'client_id' => $client_id,
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'client_assertion' => $jwt
        ]);

        $opts = ['http' => ['method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $data]];
        $response = file_get_contents('https://stg-id.singpass.gov.sg/auth/realms/h2h/protocol/openid-connect/token', false, stream_context_create($opts));
        $token_data = json_decode($response, true);

        $id_token = $token_data['id_token'];
        $publicCert = file_get_contents($CFG->dirroot . '/auth/singpass/singpass_public.crt');
        $decoded = JWT::decode($id_token, new Key($publicCert, 'RS256'));

        return ['sub' => $decoded->sub];
    }

    public static function find_or_create_user($userinfo) {
        global $DB;

        $username = strtolower($userinfo['sub']);
        $user = $DB->get_record('user', ['username' => $username, 'auth' => 'singpass']);

        if ($user) {
            return $user->id;
        }

        $newuser = new \stdClass();
        $newuser->auth = 'singpass';
        $newuser->confirmed = 1;
        $newuser->username = $username;
        $newuser->firstname = 'Singpass';
        $newuser->lastname = 'User';
        $newuser->email = $username . '@example.com';
        $newuser->timecreated = time();

        return $DB->insert_record('user', $newuser);
    }
}