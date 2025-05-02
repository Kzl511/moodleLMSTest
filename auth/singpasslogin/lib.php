<?php

function auth_singpasslogin_loginpage_hook() {
    global $OUTPUT;

    // Output the button using the template
    echo $OUTPUT->render_from_template('auth_singpasslogin/login_button', []);
}