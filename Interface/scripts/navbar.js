const toggleBtn = document.querySelector('.toggle-btn');
const toggleBtnIcon = document.querySelector('.toggle-btn i');
const dropdownMenu = document.querySelector('.dropdown-menu');
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const loginBtn = document.querySelector('.login-btn');
const dmloginBtn = document.querySelector('.dm-login-btn');
const iconClose = document.querySelector('.icon-close')
const forgotPass = document.querySelector('.forgot-link');

toggleBtn.onclick = function(){
    dropdownMenu.classList.toggle('open');
    const isOpen = dropdownMenu.classList.contains('open');

    toggleBtnIcon.classList = isOpen
    ? 'fa fa-times'
    : 'fa fa-bars'

}

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('on-register');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('on-register');
});

loginBtn.addEventListener('click', ()=> {
    wrapper.classList.add('on-login');
});

dmloginBtn.addEventListener('click', ()=> {
    wrapper.classList.add('on-login');
    toggleBtn.click();
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('on-login');
    wrapper.classList.remove('on-register');
});
