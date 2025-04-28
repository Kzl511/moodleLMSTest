<?php

namespace block_courselinks\output;

defined('MOODLE_INTERNAL') || die();

use core\output\plugin_renderer_base;

class renderer extends plugin_renderer_base {
    public function renderer_main(main $main) {
        return $this->render_from_template('block_courselinks/main',
            $main->export_for_template($this));
    }
}   