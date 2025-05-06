<?php
defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_configtext(
    'auth_singpass/clientid',
    'Singpass App ID',
    'Your registered App ID from Singpass',
    ''
));

$settings->add(new admin_setting_configtext(
    'auth_singpass/redirecturi',
    'Redirect URI',
    'Your plugin’s callback URL, e.g., https://yourdomain/auth/singpass/redirect.php',
    ''
));