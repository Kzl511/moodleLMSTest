<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'sqlsrv';
$CFG->dblibrary = 'native';
$CFG->dbhost    = '10.64.2.18';
$CFG->dbname    = 'moodleLMS';
$CFG->dbuser    = 'moodleLMSAdmin';
$CFG->dbpass    = 'absolute6464!';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 1433,
  'dbsocket' => '',
);

$CFG->wwwroot   = 'https://5f12-118-189-156-214.ngrok-free.app/moodle';
$CFG->dataroot  = '/var/www/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
