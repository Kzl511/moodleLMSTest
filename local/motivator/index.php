<?php

require('../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/local/motivator/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_motivator'));
$PAGE->set_heading(get_string('heading', 'local_motivator'));

echo $OUTPUT->header();

$quotes = [
    "Believe in yourself and all that you are.",
    "The future depends on what you do today.",
    "Don’t watch the clock; do what it does. Keep going.",
    "It always seems impossible until it’s done.",
    "Push yourself, because no one else is going to do it for you.",
    "Success is not final, failure is not fatal: It is the courage to continue that counts.",
    "Great things never come from comfort zones.",
    "Dream big and dare to fail.",
    "You are capable of amazing things.",
    "Stay positive, work hard, make it happen."
];

$quote = $quotes[array_rand($quotes)];

echo $OUTPUT->box($quote, 'generalbox centered', 'motivator-quote');

echo $OUTPUT->footer();