$(document).ready(function () {
	$('.editTag').click(function(){
        $(".my_tag").val($(this).attr('tag'));
        $(".my_id").val($(this).attr('id'));
	});
	$('.deleteTag').click(function(){
			$(".my_tag").text($(this).attr('tag'));
			$(".my_id").val($(this).attr('id'));
		});

    $('yourmodalselector').on('hide',function(e){
        if(yourConditionNotToCloseMet){
            e.preventDefault();
        }
    });

 });