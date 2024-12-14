window.addEventListener('DOMContentLoaded', () => {
    jQuery('#navigation_account').select2({
        minimumResultsForSearch: Infinity,
        width: '100%',
    });

    jQuery('#navigation_account').on('select2:select', function (e) {
        window.location.href = e.params.data.id;
    });
});