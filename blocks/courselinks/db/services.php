<?php 
defined('MOODLE_INTERNAL') || die();

$functions = array (
    'block_courselinks_get_course_modules' => array (
        'classpath' => 'block/courselinks/classes/external.php',
        'classname' => 'block_courselinks_external',
        'method_name' => 'get_course_modules',
        'description' => 'Get course modules details',
        'type' => 'read',
        'ajax' => true,
    ),
);