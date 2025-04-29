<?php
defined('MOODLE_INTERNAL') || die();

$functions = array(
    'block_courselinks_get_course_modules' => array(
        'classname' => 'block_courselinks\external',
        'methodname' => 'get_course_modules',
        'description' => 'Get course modules details',
        'type' => 'read',
        'ajax' => true,
    ),
);
