<?php

defined('MOODLE_INTERNAL') || die();

use core\output\html_writer;

function local_welcomebanner_before_footer() {
    global $PAGE, $USER, $SESSION, $OUTPUT;

    // Show only to logged-in users on the dashboard
    if ($PAGE->pagelayout === 'mydashboard' && isloggedin() && !isguestuser() && empty($SESSION->welcomebanner_shown)) {
        $welcome = html_writer::div(
            '🎉 Welcome back, ' . fullname($USER) . '!',
            'alert alert-success',
            ['style' => 'margin: 1em auto; text-align: center; max-width: 800px; font-size: 1.2em;']
        );
        echo $welcome;

        // Prevent it from showing again in this session
        $SESSION->welcomebanner_shown = true;
    }
}