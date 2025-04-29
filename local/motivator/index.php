<?php

use core\output\html_writer;

require('../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/local/motivator/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_motivator'));
$PAGE->set_heading(get_string('heading', 'local_motivator'));

echo $OUTPUT->header();

$quote = '';
$author = '';

require_once($CFG->libdir . '/filelib.php');
$curl = new curl();
$response = $curl->get('https://api.quotable.io/random');

if ($response) {
    $data = json_decode($response);
    if (!empty($data->content) && !empty($data->author)) {
        $quote = $data->content;
        $author = $data->author;
    } else {
        $quote = "Sorry, couldn't fetch a quote.";
    }
} else {
    $quote = "Unable to connect to the quote api";
}

// $quotes = [
//     "Believe in yourself and all that you are.",
//     "The future depends on what you do today.",
//     "Don't watch the clock; do what it does. Keep going.",
//     "It always seems impossible until it's done.",
//     "Push yourself, because no one else is going to do it for you.",
//     "Success is not final, failure is not fatal: It is the courage to continue that counts.",
//     "Great things never come from comfort zones.",
//     "Dream big and dare to fail.",
//     "You are capable of amazing things.",
//     "Stay positive, work hard, make it happen."
// ];

// $quote = $quotes[array_rand($quotes)];

echo $OUTPUT->box($quote, 'generalbox centered', 'motivator-quote');
if ($author) {
    echo html_writer::tag('p', '- ' . s($author), ['class' => 'author']);
}

echo $OUTPUT->footer();