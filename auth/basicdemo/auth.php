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

        $record = $DB->get_record('basicdemo_users', ['username' => $username]);

        if ($record) {
            if ($record->password === $password) {
                return true;
            }
        }
        return false;
    }

    // public function can_create_users() {
    //     return true;
    // }

    // public function create_user($user, $password) {
    //     global $DB;

    //     $user->auth = $this->authtype;
    //     $user->id = user_create_user($user, false, false);
    //     return $user->id;
    // }

    // public function user_update_password($user, $newpassword) {
    //     return true;
    // }

    // public function loginpage_hook() {
        
    // }
}