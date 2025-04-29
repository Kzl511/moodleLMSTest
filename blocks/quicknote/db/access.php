<?php
/**
 * Plugin capabilities for the repository_pluginname plugin.
 *
 * @package   repository_pluginname
 * @copyright 2025, author_fullname <author_link>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$capabilities = [
	// Ability to use the plugin.
	'block/quicknote:myaddinstance' => [
		'captype' => 'write',
		'contextlevel' => CONTEXT_SYSTEM,
		'archetypes' => ['user' => CAP_ALLOW],
		'clonepermissionfrom' => 'moodle/my:manageblocks',
	],
];
