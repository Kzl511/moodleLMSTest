define(['jquery'], function($) {
    return {
        init: function() {
            const loginForm = $('#login'); // Default login form ID
            if (!loginForm.length) return;

            const singpassBtn = $(`
                <div class="singpass-login">
                    <a href="auth/singpass/redirect.php" class="btn btn-primary" style="margin-top: 1em;">
                        Login with Singpass
                    </a>
                </div>
            `);
            loginForm.prepend(singpassBtn);
        }
    };
});