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

echo html_writer::tag('p', get_string('helloworld', 'local_helloworld'));

$link = new moodle_url('/local/helloworld/index.php', ['showtable' => 1]);
echo html_writer::link($link, get_string('showtable', 'local_helloworld'), ['class' => 'btn btn-primary']);

if (optional_param('showtable', 0, PARAM_INT)) {
    $table = new html_table();
    $table->head = ['ID', 'Name', 'Email'];
    $table->data = [
        [1, 'Alice', 'alice@example.com'],
        [2, 'Bob', 'bob@example.com'],
        [3, 'Charlie', 'charlie@example.com'],
    ];
    echo html_writer::table($table);
}

require_once(__DIR__ . '/form.php');
$form = new local_helloworld_form();
if ($form->is_cancelled()) {
    redirect($PAGE->url);
} else if ($data = $form->get_data()) {
    echo html_writer::tag('p', 'You entered: ' . format_string($data->yourname));
} else {
    $form->display();
}

echo $OUTPUT->footer();