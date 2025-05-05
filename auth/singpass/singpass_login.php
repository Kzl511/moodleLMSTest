<?php
require_once(__DIR__ . '/../../config.php');

// Set up the page
$PAGE->set_url(new moodle_url('/auth/singpass/singpass_login.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Login with Singpass');
$PAGE->set_heading('Login with Singpass');
$PAGE->set_pagelayout('login');

// Output the page header and heading
echo $OUTPUT->header();
echo $OUTPUT->heading("Welcome to Singpass Login");

// Define the URL to redirect for Singpass authentication
$authurl = new moodle_url('/auth/singpass/redirect.php');

// Define the image to use as a login button
$imageurl = new moodle_url('/auth/singpass/logo/singpass_logo_fullcolours-1.png'); // Make sure the image exists
$image = html_writer::empty_tag('img', [
    'src' => $imageurl,
    'alt' => 'Login with Singpass',
    'style' => 'height: 60px;' // Adjust image size as needed
]);

// Wrap the image in a link
$buttonhtml = html_writer::link($authurl, $image, [
    'class' => 'btn',
    'style' => 'margin-top: 20px; display: inline-block;'
]);

// Center the button
echo html_writer::div($buttonhtml, 'singpass-login-button', [
    'style' => 'text-align: center; margin-top: 40px;'
]);

// Output the page footer
echo $OUTPUT->footer();
