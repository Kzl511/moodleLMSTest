<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_helloworld', get_string('pluginname', 'local_helloworld'));
    $ADMIN->add('localplugins', $settings);

    $settings->add(new admin_setting_configtext(
        'local_helloworld/defaultgreeting',
        get_string('default_greeting', 'local_helloworld'),
        '',
        'Hello'
    )); 
}