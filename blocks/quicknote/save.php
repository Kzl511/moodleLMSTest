<?php 
require('../../config.php');
require_login();

if (!confirm_sesskey()) {
    print_error('invalidsesskey');
}

$note = optional_param('note', '', PARAM_TEXT);
$userid = $USER->id;

global $DB;

if ($DB->record_exists('block_quicknote', ['userid' => $userid])) {
    $DB->set_field('block_quicknote', 'note', $note, ['userid' => $userid]);
} else {
    $DB->insert_record('block_quicknote', (object) [
        'userid' => $userid,
        'note' => $note,
        'timecreated' => time(),
    ]);
}

redirect(new moodle_url('/my'));