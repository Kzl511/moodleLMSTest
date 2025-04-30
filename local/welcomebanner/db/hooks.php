<?php
defined('MOODLE_INTERNAL') || die();

return [
    'core\hook\output\before_footer_html_generation' => [
        'local_welcomebanner\hook\output\before_footer_html_generation_hook',
    ],
];