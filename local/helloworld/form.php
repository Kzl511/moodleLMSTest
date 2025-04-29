<?php
require_once("$CFG->libdir/formslib.php");

class local_helloworld_form extends moodleform {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'yourname', get_string('yourname', 'local_helloworld'));
        $mform->setType('yourname', PARAM_TEXT);
        $mform->addRule('yourname', get_string('required', 'local_helloworld'), 'required');

        $this->add_action_buttons();
    }
}