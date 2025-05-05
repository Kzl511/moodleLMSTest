<?php
defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_configtext(
    'auth_singpass/clientid',
    'Singpass Client ID',
    'Your Singpass App ID',
    'dfkZ2MwYtkmA01ZVY9B5UOze1ocNWKy5',
    PARAM_TEXT
));

$settings->add(new admin_setting_configtext(
    'auth_singpass/redirecturi',
    'Redirect URI',
    'Where Singpass redirects after login',
    'https://8e5c-118-189-156-214.ngrok-free.app/moodle/auth/singpass/redirect.php',
    PARAM_URL
));

$settings->add(new admin_setting_heading(
    'auth_singpass/heading',
    'Instructions',
    'Add this URL as your redirect URI in Singpass dashboard: ' . (new moodle_url('/auth/singpass/redirect.php'))
));
