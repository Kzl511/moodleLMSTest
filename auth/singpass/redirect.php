<?php
require('../../config.php');
require_once($CFG->dirroot . '/auth/singpass/singpasslib.php');

$code = required_param('code', PARAM_RAW);

$client = new \auth_singpass\singpass_client();
$idtoken = $client->exchange_code_for_id_token($code);

$payload = $client->validate_and_decode_token($idtoken);

if (!isset($payload['email'])) {
    print_error('Email not found in token');
}

$email = $payload['email'];

if ($user = $DB->get_record('user', ['email' => $email, 'deleted' => 0])) {
    complete_user_login($user);
    redirect(new moodle_url('/'));
} else {
    print_error("No account found for this email. Please contact admin.");
}