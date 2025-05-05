<?php
require_once(__DIR__ . '/../../config.php');

// Set up the page
$PAGE->set_url(new moodle_url('/auth/singpass/singpass_login.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Login with Singpass');
$PAGE->set_heading('Login with Singpass');
$PAGE->set_pagelayout('login');

// Output the page header
echo $OUTPUT->header();

// Styled heading
$heading = html_writer::tag('div', 'Login with', [
    'style' => 'text-align: left; font-size: 4em; font-weight: 600; margin-bottom: 10px;'
]);
echo $heading;

// Define the URL to redirect for Singpass authentication
$authurl = new moodle_url('/auth/singpass/redirect.php');

// Define the image to use as a login button
$imageurl = new moodle_url('/auth/singpass/logo/singpass_logo_fullcolours-1.png');
$image = html_writer::empty_tag('img', [
    'src' => $imageurl,
    'alt' => 'Login with Singpass',
    'style' => 'height: 60px;'
]);

// Wrap image in link
$buttonhtml = html_writer::link($authurl, $image, [
    'class' => 'btn',
    'style' => 'display: inline-block;'
]);

// Center the image/button
echo html_writer::div($buttonhtml, 'singpass-login-button', [
    'style' => 'text-align: left; margin-top: 10px;'
]);

// Output the page footer
echo $OUTPUT->footer();