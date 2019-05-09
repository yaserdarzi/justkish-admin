$(document).ready(function () {

$('.delet_movie_id').click(function(){
    $.ajax({
        url: "/gallerys/deleteGallery",
        data:{
            id:$(this).attr('id'),
        },
        success: function(html){
        }
    });
});
});
