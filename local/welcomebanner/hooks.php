<?php

namespace local_welcomebanner\hook;

use core\output\html_writer;

class output_before_footer_html_generation {
    /**
     * Hook implementation for before_footer_html_generation.
     *
     * @return string HTML to be added before the footer.
     */
    public static function execute(): string {
        global $PAGE, $USER, $SESSION;

        // Show only to logged-in users on the dashboard
        if ($PAGE->pagelayout === 'mydashboard' && isloggedin() && !isguestuser() && empty($SESSION->welcomebanner_shown)) {
            $welcome = html_writer::div(
                '🎉 Welcome back, ' . fullname($USER) . '!',
                'alert alert-success',
                ['style' => 'margin: 1em auto; text-align: center; max-width: 800px; font-size: 1.2em;']
            );

            // Prevent it from showing again in this session
            $SESSION->welcomebanner_shown = true;

            return $welcome;
        }

        return ''; // Return empty string if no content is to be added.
    }
}