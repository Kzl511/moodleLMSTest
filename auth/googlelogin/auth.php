<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_googlelogin extends auth_plugin_base {
    public function __construct()
    {
        $this->authtype = 'googlelogin';
        $this->config = get_config('auth_googlelogin');
    }

    public function loginpage_hook()
    {
        global $PAGE;
        $PAGE->requires->js_call_amd('auth_googlelogin/googlelogin', 'init', []);
    }

    public function user_login($username, $password)
    {
        return false;
    }

    public function loginpage_idp_list($wantsurl)
    {
        $url = new moodle_url('/auth/googlelogin/login.php');
        return [
            'url' => $url->out(false),
            'icon' => new pix_icon('i/user', 'Google'),
            'name' => get_string('logingoogle', 'auth_googlelogin'),
            'login' => true,
        ];
    }
}