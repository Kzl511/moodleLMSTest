<?php
require_once(__DIR__ . '/../../config.php');

require_login();

echo $OUTPUT->header();
echo $OUTPUT->heading("Redirecting to Singpass...");
echo html_writer::div('This is where you will handle Singpass login flow.');
echo $OUTPUT->footer();