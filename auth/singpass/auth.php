<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_singpass extends auth_plugin_base {

    public function __construct() {
        $this->authtype = 'singpass';
        $this->config = get_config('auth/singpass');
    }

    public function loginpage_hook() {
        global $PAGE;

        $PAGE->requires->js_call_amd('auth_singpass/singpass', 'init');
    }
}