<?php

use core\output\html_writer;
use core_table\output\html_table;

require('../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/local/helloworld/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_helloworld'));
$PAGE->set_heading(get_string('pluginname', 'local_helloworld'));

echo $OUTPUT->header();

$greeting = get_config('local_helloworld', 'defaultgreeting');
echo html_writer::tag('p', $greeting . ', welcome to the HelloWorld plugin!');

// $link = new moodle_url('/local/helloworld/index.php', ['showtable' => 1]);
// echo html_writer::link($link, get_string('showtable', 'local_helloworld'), ['class' => 'btn btn-primary']);

// if (optional_param('showtable', 0, PARAM_INT)) {
//     $table = new html_table();
//     $table->head = ['ID', 'Name', 'Email'];
//     $table->data = [
//         [1, 'Alice', 'alice@example.com'],
//         [2, 'Bob', 'bob@example.com'],
//         [3, 'Charlie', 'charlie@example.com'],
//     ];
//     echo html_writer::table($table);
// }

require_once(__DIR__ . '/form.php');

global $DB;

$mform = new local_helloworld_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/local/helloworld/index.php'));
} else if ($data = $mform->get_data()) {
    $record = new stdClass();
    $record->name = $data->yourname;

    $newid = $DB->insert_record('helloworld', $record);

    echo $OUTPUT->notification("Hello, " . s($data->yourname) . "!", 'notifysuccess');
}

// echo $OUTPUT->single_button(
//     new moodle_url('/local/helloworld/showtable.php'),
//     get_string('show_table', 'local_helloworld')
// );

echo html_writer::link(new moodle_url('/local/helloworld/showtable.php'), get_string('showtable', 'local_helloworld'));

echo $OUTPUT->footer();