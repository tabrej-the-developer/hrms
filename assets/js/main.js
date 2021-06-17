const { on } = require("process");

$(document).ready(function(){
    $(window).scroll(function() {
        if ($(window).scrollTop() > 0) {
          $('.header').addClass('fixed');          
        } else {
            $('.header').removeClass('fixed'); 
        }
    });

    $(".Play").on("click", function (e) {
        e.preventDefault();
        $(".popUp").fadeIn();
        $("body").css("overflow", "hidden");
    });
    $(".cross").on("click", function (e) {
        e.preventDefault();
        $(".popUp").fadeOut();
        $("body").css("overflow-y", "scroll");
    });

    $(".mobileMenu").on("click", function(){
        $(".toggleMenu").toggle();
    });


    $(".owl-carousel").owlCarousel({
        items: 4,
        loop:Infinity,
        nav: false,
        dots: true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                nav:true,
                loop:false
            }
        }
    });

    $(".getStarted").on("click", function(){
        $(".getStartedCont").css("display", "flex");
    });
    $(".closeGetStartedCont").on("click", function(){
        $(".getStartedCont").hide();
    });
    
    
});
