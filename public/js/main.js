$(document).ready(function() {
  //Color transition on scroll for navbar
    $(window).scroll(function() {
        if ($(document).scrollTop() > 10) {
            // $(".navbar-fixed-top").css("background-color", "transparent");
            $(".navbar").css({
                'background-color': 'rgba(239, 239, 239, 0.7)',
                'transition': '1.4s'
            });
            $('.navbar a').attr('style', 'color: #000 !important');
        } else {
            $(".navbar").css("background-color", "transparent");
            $(".navbar a").css({
                'color': 'rgba(242, 242, 242, 0.6)'
            });
        }
    });
});//end of script 