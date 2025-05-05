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

// Define the redirect URL and logo image URL
$authurl = new moodle_url('/auth/singpass/redirect.php');
$imageurl = new moodle_url('/auth/singpass/logo/singpass_logo_fullcolours-1.png');

// Create the "Login with" + logo button content
$logintext = html_writer::tag('span', 'Login with', [
    'style' => 'font-family: Poppins, sans-serif; font-size: 16pt; font-weight: bold; vertical-align: middle; margin-right: 10px;'
]);

$imageinline = html_writer::empty_tag('img', [
    'src' => $imageurl,
    'alt' => 'Singpass logo',
    'style' => 'height: 40px; vertical-align: middle;'
]);

// Combine into a clickable link styled as a button
$buttoncontent = $logintext . $imageinline;

$buttonlink = html_writer::link($authurl, $buttoncontent, [
    'style' => 'display: inline-block; padding: 10px 20px; border: 2px solid #ccc; border-radius: 8px; text-decoration: none; background-color: #f9f9f9; transition: background-color 0.3s;',
    'onmouseover' => "this.style.backgroundColor='#e6e6e6';",
    'onmouseout' => "this.style.backgroundColor='#f9f9f9';"
]);

// Center the button on the page
echo html_writer::div($buttonlink, 'singpass-login-wrapper', [
    'style' => 'text-align: center; margin-top: 60px;'
]);

// Output the footer
echo $OUTPUT->footer();