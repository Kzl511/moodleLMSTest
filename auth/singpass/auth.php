<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/auth/singpass/classes/loginlib.php');

class auth_plugin_singpass extends auth_plugin_base {

    public function __construct() {
        $this->authtype = 'singpass';
        $this->config = get_config('auth_singpass');
    }

    public function loginpage_hook() {
        global $PAGE;
        $PAGE->requires->js_call_amd('auth_singpass/login', 'init');
    }

    public function user_login($username, $password) {
        return false; // Singpass doesn't use traditional login
    }

    public function can_signup() {
        return false;
    }

    public function login_url() {
        return new moodle_url('/auth/singpass/singpass_login.php');
    }
}