<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/auth/singpass/singpasslib.php');

class auth_plugin_singpass extends auth_plugin_base {

    public function __construct() {
        $this->authtype = 'singpass';
        $this->config = get_config('auth_singpass');
    }

    public function loginpage_hook() {
        global $PAGE, $OUTPUT;
        $PAGE->requires->js_call_amd('auth_singpass/singpass', 'init');
    }

    public function user_login($username, $password) {
        return false; // Singpass handles auth, not this.
    }

    public function can_signup() {
        return false;
    }

    public function user_signup($user, $notify = true) {
        return false;
    }
}