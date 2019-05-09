$(document).ready(function () {
	$('.edit').click(function(){

        $(".title").val($(this).attr('title'));
        $(".section").val($(this).attr('section'));
        $(".movie_id").val($(this).attr('id'));
        $(".cover").val($(this).attr('cover'));
        $(".post_price").val($(this).attr('post_price'));
        $(".digital_price").val($(this).attr('digital_price'));
        $(".description").text($(this).attr('description'));


	});



	$('.delete').click(function(){

           $(".title").text($(this).attr('nickname'));
        $(".id").val($(this).attr('id'));

    });



});