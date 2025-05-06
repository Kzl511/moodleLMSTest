<?php
require('../../config.php');
require_once($CFG->dirroot . '/auth/singpass/classes/loginlib.php');

use auth_singpass\loginlib;

$code = required_param('code', PARAM_RAW);
$state = required_param('state', PARAM_RAW);

if ($state !== $_SESSION['singpass_state']) {
    throw new moodle_exception('Invalid state');
}

$userinfo = loginlib::exchange_code_for_user($code);

$userid = loginlib::find_or_create_user($userinfo);
complete_user_login(core_user::get_user($userid));

redirect($CFG->wwwroot);