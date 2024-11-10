window.addEventListener('DOMContentLoaded', () => {
    updateCart();

    window.addEventListener('added_to_cart removed_from_cart adding_to_cart wc_cart_button_updated cart_totals_refreshed updated_cart_totals', function(){
        // console.log('updated_cart_totals')
        updateCart();
    });

    function updateCart() {
        document.querySelector('.cart_btn').addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('.wc-block-mini-cart__button').click()
        });
    }
});
