$(document).ready(function () {
	$('.edit').click(function(){

        $(".title").val($(this).attr('title'));
        $(".series_id").val($(this).attr('id'));
        $(".cover").val($(this).attr('cover'));
        $(".description").text($(this).attr('description'));

	});
	$('.delete').click(function(){
			$(".series_id").val($(this).attr('id'));
           $(".title").text($(this).attr('title'));

    });



});t