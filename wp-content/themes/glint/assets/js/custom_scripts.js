window.addEventListener('DOMContentLoaded', () => {
    // updateCart();

    // window.addEventListener('added_to_cart removed_from_cart adding_to_cart wc_cart_button_updated cart_totals_refreshed updated_cart_totals', function(){
    //     updateCart();
    // });

    // function updateCart() {
    //     document.querySelector('.cart_btn').addEventListener('click', (e) => {
    //         e.preventDefault();
    //         document.querySelector('.wc-block-mini-cart__button').click()
    //     });
    // }
    // Email валидация
    // function validateEmail(email) {
    //     const re =
    //         /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //     return re.test(email);
    // }
    // Email валидация


    // Валидация формы
    // const form = document.querySelector(".contact-page-area form"),
    //     formPhone = form.querySelector("[name='userphone']");

    // form.addEventListener("submit", (e) => {
    //     e.preventDefault();
    //     let error = 0;

    //     // Проверка телефона
    //     if (formName.value.length == 0) {
    //         formName.classList.add("invalid");
    //         error++;
    //     } else {
    //         formName.classList.remove("invalid");
    //     }


    //     if (error === 0) {

    //     }
    // });

    // function emailTest(input) {
    //     return !/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/.test(input.value);
    // }

    // Кастомная маска телефона
    const mask = (selector, pattern) => {
        function createMask(event) {
            let matrix = pattern,
                i = 0,
                def = matrix.replace(/\D/g, ''),
                val = this.value.replace(/\D/g, '');

            if (def.length >= val.length) {
                val = def;
            }

            this.value = matrix.replace(/./g, function(a) {
                return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
            });

            if (event.type === 'blur') {
                if (this.value.length == 2) {
                    this.value = '';
                }
            } else {
                setCursorPosition(this.value.length, this);
            }
        }

        let inputs = document.querySelectorAll(selector);

        inputs.forEach(input => {
            input.addEventListener('input', createMask);
            input.addEventListener('focus', createMask);
            input.addEventListener('blur', createMask);
        });
    };

    mask("[name='userphone']", '+____________'); 
    // mask(".phone", '+__ (___) ___ __ __'); 
    // Кастомная маска телефона
});
