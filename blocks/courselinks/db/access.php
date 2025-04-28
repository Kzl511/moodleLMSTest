<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'block/courselinks:addinstance' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        'clonepermissionfrom' => 'moodle/site:manageblocks'
    ),
);