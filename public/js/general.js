const btnBurger = document.querySelector('.btn-hamburger');
const menuWrapper = document.querySelector('.menu-wrapper');

if(btnBurger !== null) {
    btnBurger.addEventListener('click', () => {
        btnBurger.classList.toggle('btn-hamburger_active');
        menuWrapper.classList.toggle('menu-active');
    })
}
