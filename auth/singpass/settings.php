<?php
defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_configtext(
    'auth_singpass/clientid',
    'Singpass App ID',
    'Your registered App ID from Singpass',
    'dfkZ2MwYtkmA01ZVY9B5UOze1ocNWKy5'
));

$settings->add(new admin_setting_configtext(
    'auth_singpass/redirecturi',
    'Redirect URI',
    'Your plugin\'s callback URL',
    'http://localhost/moodle/auth/singpass/redirect.php'
));