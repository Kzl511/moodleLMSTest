<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * Singpass Login authentication plugin.
 */
class auth_plugin_singpasslogin extends auth_plugin_base {

    public function __construct() {
        $this->authtype = 'singpasslogin';
        $this->config = get_config('auth_singpasslogin');
    }

    // This function isn't required to make the button show, but it's good to stub it out:
    public function user_login($username, $password) {
        return false; // Always false because Singpass login doesn't use Moodle passwords.
    }
}