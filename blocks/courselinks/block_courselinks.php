<?php
defined('MOODLE_INTERNAL') || die();

class block_courselinks extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_courselinks');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $renderable = new \block_courselinks\output\main();
        $renderer = $this->page->get_renderer('block_courselinks');

        $this->content = (object) [
            'text' => $renderer->render($renderable)
        ];

        return $this->content;
    }

    public function applicable_formats() {
        return array('course'=>true);
    }

    public function has_config() {
        return true; 
    }
}