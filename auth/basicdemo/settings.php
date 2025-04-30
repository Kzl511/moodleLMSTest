<?php
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_heading('auth_basicdemo/pluginname',
        get_string('pluginname', 'auth_basicdemo'),
        get_string('auth_basicdemodescription', 'auth_basicdemo')
    ));
}