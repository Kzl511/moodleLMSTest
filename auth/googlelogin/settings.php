<?php 
defined('MOODLE_INTERNAL') || die();

$settings->add (new admin_setting_configtext(
    'auth_googlelogin/clientid',
    get_string('clientid', 'auth_googlelogin'),
    '',
    ''
));

$settings->add(new admin_setting_configtext(
    'auth_googlelogin/clientsecret',
    get_string('clientsecret', 'auth_googlelogin'),
    '',
    ''
));