<?php
require('../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/local/helloworld/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_helloworld'));
$PAGE->set_heading(get_string('pluginname', 'local_helloworld'));

echo $OUTPUT->header();
echo html_writer::tag('p', get_string('helloworld', 'local_helloworld'));
echo $OUTPUT->footer();