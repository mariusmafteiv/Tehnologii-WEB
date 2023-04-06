const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const loginBtn = document.querySelector('.login-btn');
const iconClose = document.querySelector('.icon-close')
const forgotPass = document.querySelector('.forgot-link');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('on-register');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('on-register');
});

loginBtn.addEventListener('click', ()=> {
    wrapper.classList.add('on-login');
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('on-login');
    wrapper.classList.remove('on-register');
});

