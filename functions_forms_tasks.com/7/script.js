$(function() {
    $('.comments__delete').on('click', function () {

        $(this).parent().animate({
            opacity: 0
        }, 800, function() {
            $(this).closest("div").remove();
        });


    });

});