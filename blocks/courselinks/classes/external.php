<?php

namespace block_courselinks;

use core_external\external_function_parameters;
use core_external\external_value;
use core_external\external_multiple_structure;
use core_external\external_single_structure;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/externallib.php');
require_once($CFG->dirroot . '/report/outline/locallib.php');

class external extends \core_course_external {
 
    public static function get_course_modules_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT, 'Current Course Id', VALUE_DEFAULT, 0)
        ]);
    }

    public static function get_course_modules($courseid) {
        global $DB, $USER;

        $allmodules = $activitylist = array();
        $params = self::validate_parameters(self::get_course_modules_parameters(), [
            'courseid' => $courseid
        ]);
        
        $params = array('id' => $courseid);
        $course = $DB->get_record('course', $params, '*', MUST_EXIST);

        $modinfo = get_fast_modinfo($course);
        $modules = $modinfo->get_cms();
        foreach ($modules as $module) {
            if (!$module->uservisible || $module->is_stealth() || empty($module->url)) {
                continue;
            }
            $modname = $module->get_formatted_name();
            if (!$module->visible) {
                $modname .= ' ' . get_string('hiddenwithbrackets');
            }
            $linkurl = new moodle_url($module->url, array());
            $views = report_outline_user_outline($USER->id, $module->id, $modname, $module->instance);
            if ($views->info == null) {
                $viewed = '0 views';
            } else {
                $viewed = $views->info;
            }
            $allmodules[] = [
                'id' => $module->id,
                'name' => $modname,
                'url' => $linkurl->out(false),
                'added' => userdate($module->added, '%d-%m-%Y'),
                'views' => $viewed
            ];
        }
        return $allmodules;
    }

    public static function get_course_modules_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_TEXT, 'Module ID'),
                    'name' => new external_value(PARAM_TEXT, 'Module Name'),
                    'url' => new external_value(PARAM_RAW, 'Module URL'),
                    'added' => new external_value(PARAM_TEXT, 'Module Added on'),
                    'views' => new external_value(PARAM_TEXT, 'Module Views'),
                )
            )
        );
    }
}