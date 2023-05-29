$(document).ready(function(){
    $(".zoom").hover(function(){
        $(this).addClass('transition');
    }, function(){
        $(this).removeClass('transition');
    });
});