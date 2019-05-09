$(document).ready(function () {


    $('.delete').click(function(){
        $(".id").val($(this).attr('id'));
        $(".titles").text($(this).attr('nickname'));

    });





    $(window).load(function() {

        $('.icon-close').click(function(){

            $('#edit').modal('hide');


        });
    });




	$('.edit').click(function(){

        $(".nickname").val($(this).attr('nickname'));
        $(".id").val($(this).attr('id'));
        $(".avatar").val($(this).attr('avatar'));
        $(".bio").text($(this).attr('bio'));
        var date=$(this).attr('birth_date');
        var x=date.split("-");
        $(".day").val(x[2].replace(/^0+/, ''));
        $(".mounth").val(x[1].replace(/^0+/, ''));
        $(".year").val(x[0].replace(/^0+/, ''));

	});





});

