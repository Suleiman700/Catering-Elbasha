var gallery_open = false;
$('#gallery-chevron-btn').on('click', function () {
    if (gallery_open===false) {
        $( "#gallery_section" ).animate({height: "100%",}, 1000 ); // Show gallery
        $('#gallery-chevron-btn').removeClass('fa fa-chevron-down');
        $('#gallery-chevron-btn').addClass('fa fa-chevron-up');
        gallery_open = true;
    }
    else if (gallery_open===true) {
        $("#gallery_section" ).animate({height: "190px",}, 1000 ); // Hide gallery
        $('#gallery-chevron-btn').removeClass('fa fa-chevron-up');
        $('#gallery-chevron-btn').addClass('fa fa-chevron-down');
        gallery_open = false;
        $('html, body').animate({
            scrollTop: $("#gallery").offset().top
        }, 0);
    }
});