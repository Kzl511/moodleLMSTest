<?php

use GuzzleHttp\Promise\Is;

require('../../config.php');

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once($CFG->libdir.'/authlib.php');
require_once($CFG->libdir.'/filelib.php');

$client_id = get_config('auth_googlelogin', 'clientid');
$client_secret = get_config('auth_googlelogin', 'clientsecret');
$redirect_uri = (new moodle_url('/auth/googlelogin/login.php'))->out(false);

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope('email');
$client->addScope('profile');

if (!isset($_GET['code'])) {
    redirect($client->createAuthUrl());
} else {
    $client->authenticate($_GET['code']);
    $token = $client->getAccessToken();
    $client->setAccessToken($token);

    $oauth2 = new Google_Service_Oauth2($client);
    $userinfo = $oauth2->userinfo->get();

    $email = $userinfo->email;
    $fullname = $userinfo->name;
    $firstname = $userinfo->givenName;
    $lastname = $userinfo->familyName;

    if ($user = get_complete_user_data('email', $email)) {
        complete_user_login($user);
        redirect(new moodle_url('/'));
    } else {
        $user = create_user_record($email, '', 'googlelogin');
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->confirmed = 1;
        user_update_user($user);
        redirect(new moodle_url('/'));
    }
}