$(document).ready(function () {
	$('.edit').click(function(){
        $(".my_tags").val($(this).attr('tags'));
        $(".my_title").val($(this).attr('title'));
        $(".my_en_title").val($(this).attr('en_title'));
        $(".my_id").val($(this).attr('id'));
	});
	$('.delete').click(function(){
			$(".my_title").text($(this).attr('title'));
			$(".my_id").val($(this).attr('id'));
		});



});