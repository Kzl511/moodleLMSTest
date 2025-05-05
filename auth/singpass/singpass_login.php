<?php
require_once(__DIR__ . '/../../config.php');

// Set up the page
$PAGE->set_url(new moodle_url('/auth/singpass/singpass_login.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Login with Singpass');
$PAGE->set_heading('Login with Singpass');
$PAGE->set_pagelayout('login');

// Output starts
echo $OUTPUT->header();
echo $OUTPUT->heading("Welcome to Singpass Login");

// Create the button (change redirect URL later as needed)
$buttonurl = new moodle_url('/auth/singpass/redirect.php');
$buttonhtml = html_writer::link($buttonurl, 'Login with Singpass', [
    'class' => 'btn btn-primary',
    'style' => 'margin-top: 20px; display: inline-block; padding: 10px 20px; font-size: 1.2em;',
]);

echo html_writer::div($buttonhtml, 'singpass-login-button', ['style' => 'text-align:center;']);

echo $OUTPUT->footer();