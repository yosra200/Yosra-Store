(function($){  

$('.item-quantity').on('change', function(e) {

    $.ajax({
        url: "/cart/" + $(this).data('id'), //data-id
        method: 'put',
        data: {
            quantity: $(this).val(),
            _token: csrf_token
        }
    });
});
})(jQuery);

$('.remove-item').on('click', function(e) {

    let id = $(this).data('id');
    $.ajax({
        url: "/cart/" + id, //data-id
        method: 'delete',
        data: {
            _token: csrf_token
        },
        success: response => {
            $(`#${id}`).remove();
        }
    });
});
