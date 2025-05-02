<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = null; // Add this line

    $settings = new admin_settingpage('authsetting_singpass', get_string('pluginname', 'auth_singpass'));

    $settings->add(new admin_setting_configtext(
        'auth_singpass/clientid',
        'Client ID',
        'Your Singpass MyInfo client ID.',
        '',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'auth_singpass/clientsecret',
        'Client Secret',
        'Your Singpass MyInfo client secret.',
        '',
        PARAM_TEXT
    ));

    $ADMIN->add('authsettings', $settings);
}