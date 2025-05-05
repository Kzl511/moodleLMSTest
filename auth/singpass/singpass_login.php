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

// Define the image URL for the logo
$imageurl = new moodle_url('/auth/singpass/logo/singpass_logo_fullcolours-1.png');

// Create the "Login with" text
$logintext = html_writer::tag('span', 'Login with', [
    'style' => 'font-size: 2em; font-weight: 600; vertical-align: middle; margin-right: 10px;'
]);

// Create the logo image inline
$imageinline = html_writer::empty_tag('img', [
    'src' => $imageurl,
    'alt' => 'Singpass logo',
    'style' => 'height: 40px; vertical-align: middle;'
]);

// Combine the text and image into one heading row
$combinedheading = html_writer::div($logintext . $imageinline, 'login-heading-combined', [
    'style' => 'text-align: center; margin-bottom: 30px;'
]);

echo $combinedheading;

// Define the URL to redirect for Singpass authentication
$authurl = new moodle_url('/auth/singpass/redirect.php');

// Wrap the image in a clickable link
$buttonhtml = html_writer::link($authurl, $imagebutton, [
    'class' => 'btn',
    'style' => 'display: inline-block;'
]);

// Center the button below the heading
echo html_writer::div($buttonhtml, 'singpass-login-button', [
    'style' => 'text-align: center; margin-top: 20px;'
]);

// Output the page footer
echo $OUTPUT->footer();