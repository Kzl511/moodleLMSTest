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
    
        // Load AMD module (optional if you have JavaScript logic)
        $PAGE->requires->js_call_amd('auth_singpass/login', 'init');
    
        // Render Singpass button
        $renderer = $PAGE->get_renderer('core');
        $singpassbutton = $renderer->render_from_template('auth_singpass/loginbutton', []);
    
        // Add the button to the login page
        $PAGE->requires->data_for_js('auth_singpass', ['html' => $singpassbutton]);
        echo $singpassbutton; // You can also inject this more cleanly using a block or template system if needed.
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