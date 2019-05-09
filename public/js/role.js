$(document).ready(function () {
	$('.edit').click(function(){
        $(".role_name").val($(this).attr('role_name'));
        $(".my_id").val($(this).attr('id'));
	});
	$('.delete').click(function(){
			$(".role_name").text($(this).attr('role_name'));
			$(".my_id").val($(this).attr('id'));
		});



});