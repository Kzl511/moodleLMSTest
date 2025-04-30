<?php
namespace local_welcomebanner\hook\output;

use core\hook\output\before_footer_html_generation;
use core\output\html_writer;

class before_footer_html_generation_hook implements before_footer_html_generation {
    public static function execute(): void {
        global $SESSION, $OUTPUT;

        if (empty($SESSION->welcomebanner_shown)) {
            $banner = $OUTPUT->notification('🎉 Welcome back! You have successfully logged in.', 'notifymessage');
            echo html_writer::div($banner, 'welcomebanner');
            $SESSION->welcomebanner_shown = true;
        }
    }
}

function local_welcomebanner_user_logout($user) {
    global $SESSION;
    unset($SESSION->welcomebanner_shown);
}