<?php

/**
 * Version details
 *
 * @package    localmessage
 * @author     KZL
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 function local_message_extend_before_footer_html_generation($hook) {
    // Your custom logic here (e.g., adding HTML or performing actions before footer).
    // For now, let's just add a simple message for testing:
    $hook->add_html('<div class="local-message-footer">Hello from local message plugin</div>');
}