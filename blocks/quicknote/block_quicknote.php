<?php

class block_quicknote extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_quicknote');
    }

    public function get_content() {
        global $USER, $DB, $OUTPUT, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $context = context_system::instance();

        $note = $DB->get_field('block_quicknote', 'note', ['userid' => $USER->id], IGNORE_MISSING);

        $formaction = new moodle_url('/blocks/quicknote/save.php');
        $this->content->text = '
            <form method="post" action="'.$formaction.'">
                <textarea name="note" rows="4" cols="30">'.s($note).'</textarea><br>
                <input type="hidden" name="sesskey" value="'.sesskey().'">
                <input type="submit" value="'.get_string('save', 'block_quicknote').'">
            </form>
        ';
        return $this->content;
    }

    public function has_config() {
        return false;
    }
}