<?php

use core\output\pix_icon;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_singpass extends auth_plugin_base {
    public function __construct()
    {
        $this->authtype = 'singpass';
        $this->config = get_config('auth_singpass');
    }

    public function loginpage_idp_list($wantsurl)
    {
        $url = new moodle_url('/auth/singpass/login.php', ['wantsurl' => $wantsurl]);
        return [
            'url' => $url->out(false),
            'icon' => new pix_icon('i/user', 'Singpass'),
            'name' => get_string('loginsingpass', 'auth_singpass'),
            'login' => true,
        ];
    }

    public function user_login($username, $password)
    {
        return false;
    }
}