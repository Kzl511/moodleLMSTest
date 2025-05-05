<?php
defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_configtext(
    'auth_singpass/clientid',
    'Singpass App ID',
    'dfkZ2MwYtkmA01ZVY9B5UOze1ocNWKy5',
    ''
));

$settings->add(new admin_setting_configtext(
    'auth_singpass/redirecturi',
    'Redirect URI',
    'https://8e5c-118-189-156-214.ngrok-free.app/moodle/auth/singpass/redirect.php',
    ''
));