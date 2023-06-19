const showPasswordCheckbox = document.querySelector('input[name="showPassword"]');
const passwordInput = document.querySelector('input[name="password"]');

showPasswordCheckbox.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});