export const init = () => {
    const loginContainer = document.querySelector('.loginbox');
    if (loginContainer) {
        const btn = document.createElement('a');
        btn.className = 'btn btn-primary w-100 mt-3';
        btn.href = M.cfg.wwwroot + '/auth/singpass/login.php';
        btn.innerText = 'Login with Singpass';
        loginContainer.appendChild(btn);
    }
};