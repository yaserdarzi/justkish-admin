$(document).ready(function () {
    $('.edit').click(function () {
        $(".invoice_id").val($(this).attr('id'));
    });
});