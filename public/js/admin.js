let deleteForms = document.querySelectorAll('.form-delete');
let btnCancel = document.querySelector('.btn-cancel');
let btnConfirm = document.querySelector('.btn-confirm');
let closeModalBtn = document.querySelector('.delete-modal-close');
let modalWrapper = document.querySelector('.delete-modal-wrapper');

const btnBurger = document.querySelector('.btn-hamburger');
const adminMenuWrapper = document.querySelector('.admin-menu-wrapper');

if(btnBurger !== null) {
    btnBurger.addEventListener('click', () => {
        btnBurger.classList.toggle('btn-hamburger_active');
        adminMenuWrapper.classList.toggle('admin-menu-active');
    })
}

setEventListeners();

window.addEventListener('contentChanged', event => {
    deleteForms = document.querySelectorAll('.form-delete');
    btnCancel = document.querySelector('.btn-cancel');
    btnConfirm = document.querySelector('.btn-confirm');
    closeModalBtn = document.querySelector('.delete-modal-close');
    modalWrapper = document.querySelector('.delete-modal-wrapper');
    setEventListeners();
});

function setEventListeners() {
    if (deleteForms !== null) {
        deleteForms.forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();
                modalWrapper.classList.remove('d-none');
                modalWrapper.style.top = window.pageYOffset + 'px';
                if (btnConfirm !== null) {
                    btnConfirm.addEventListener('click', e => {
                        form.submit();
                    });
                }
            });
        });
    }

    if (btnCancel !== null) {
        btnCancel.addEventListener('click', e => {
            modalWrapper.classList.add('d-none');
        })
    }

    if (closeModalBtn !== null) {
        closeModalBtn.addEventListener('click', e => {
            modalWrapper.classList.add('d-none');
        })
    }

    if (modalWrapper !== null) {
        modalWrapper.addEventListener('click', e => {
            modalWrapper.classList.add('d-none');
        })

        modalWrapper.children[0].addEventListener('click', e => {
            e.stopPropagation();
        });
    }
}
