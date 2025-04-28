<?php

namespace block_courselinks\output;

defined('MOODLE_INTERNAL') || die();

use core\output\renderable;
use core\output\renderer_base;
use core\output\templatable;

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->libdir . '/completionlib.php');

class main implements renderable, templatable {
    public function export_for_template(renderer_base $output) {
        global $PAGE;
        return [
            'displaycourse' => $PAGE->course->id
        ];
    }
}   