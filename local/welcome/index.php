<?php
require('../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/local/welcome/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title("Welcome");
$PAGE->set_heading("Welcome");

echo $OUTPUT->header();
echo $OUTPUT->box("Login successful! Welcome, " . fullname($USER), 'generalbox');
echo $OUTPUT->footer();