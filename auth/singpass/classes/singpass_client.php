<?php
namespace auth_singpass;

defined('MOODLE_INTERNAL') || die();

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

class singpass_client {
    private $clientid;
    private $redirecturi;
    private $jwksuri;

    public function __construct() {
        $this->clientid = get_config('auth_singpass', 'clientid');
        $this->redirecturi = get_config('auth_singpass', 'redirecturi');
        $this->jwksuri = get_config('auth_singpass', 'jwksuri');
    }

    public function exchange_code_for_id_token($code) {
        $tokenurl = 'https://test.api.myinfo.gov.sg/com/v4/token'; // Replace

        $post = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->redirecturi,
            'client_id' => $this->clientid,
        ];

        $response = download_file_content($tokenurl, null, $post, true);
        $json = json_decode($response, true);
        return $json['id_token'] ?? null;
    }

    public function validate_and_decode_token($idtoken) {
        $jwks = download_file_content($this->jwksuri);
        $keys = json_decode($jwks, true);
        $decoded = JWT::decode($idtoken, JWK::parseKeySet($keys), ['RS256']);
        return (array) $decoded;
    }
}