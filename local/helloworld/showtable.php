<?php

use core\output\html_writer;

require('../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/local/helloworld/showtable.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Show Table');
$PAGE->set_heading('Show Table');

echo $OUTPUT->header();

global $DB;
$records = $DB->get_records('helloworld');

if (!empty($records)) {
    echo html_writer::start_tag('table', ['class' => 'generaltable']);
    echo html_writer::start_tag('thead');
    echo html_writer::tag('tr',
        html_writer::tag('th', 'ID') . 
        html_writer::tag('th', 'Name') . 
        html_writer::tag('th', 'Time Created')
    );
    echo html_writer::end_tag('thead');

    echo html_writer::start_tag('tbody');
    foreach ($records as $record) {
        echo html_writer::tag('tr',
            html_writer::tag('td', $record->id) . 
            html_writer::tag('td', s($record->name)) . 
            html_writer::tag('td', userdate(strtotime($record->timecreated)))
        );
    }
    echo html_writer::end_tag('tbody');
    echo html_writer::end_tag('table');
} else {
    echo $OUTPUT->notification('No records found.', 'notifymessage');
}

echo html_writer::link(new moodle_url('/local/helloworld/index.php'), get_string('goback', 'local_helloworld'));

echo $OUTPUT->footer();