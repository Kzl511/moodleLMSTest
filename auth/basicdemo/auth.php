<?php 
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_basicdemo extends auth_plugin_base {
    
    public function __construct() {
        $this->authtype = 'basicdemo';
        $this->config = get_config('auth_basicdemo');
    }

    public function user_login($username, $password) {
        // $valid_users = [
        //     'demo' => 'password123',
        //     'admin' => 'adminpass',
        // ];

        // if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
        //     return true;
        // }
        // return false;

        global $DB;

        $user = $DB->get_record('user', ['username' => $username, 'deleted' => 0, 'suspended' => 0]);

        if (!$user) {
            return false;
        } 
        return validate_internal_user_password($user, $password);
        
    }

    public function user_update_password($user, $newpassword) {
        return true;
    }

    public function can_change_password() {
        return true;
    }

    public function loginpage_hook() {
        global $DB, $SESSION;

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = trim(core_text::strtolower($_POST['username']));
            $password = $_POST['password'];

            if ($DB->record_exists('user', ['username' => $username, 'deleted' => 0])) {
                $user = $DB->get_record('user', ['username' => $username, 'deleted' => 0]);
                if (validate_internal_user_password($user, $password)) {
                    $SESSION->wantsurl = new moodle_url('/local/welcome/index.php');
                }
            }
        }
    }
}