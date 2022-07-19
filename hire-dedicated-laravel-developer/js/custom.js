function setHeaderSticky() {
    if ($(window).scrollTop() >= 80) {
        $("header").addClass("sticky");
    } else {
        $("header").removeClass("sticky");
    }
}
$(window).scroll(function() {
    setHeaderSticky();
});

$(window).on("load", function() {
    setHeaderSticky();
});
$(document).ready(function() {
    // Sticky Header Js
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() >= 1) {
    //         $('header').addClass('sticky');
    //     } else {
    //         $('header').removeClass('sticky');
    //     }
    // });

    // Counter Js
    $(".counter").countUp();

    // SrollTop Js
    $(function() {
        var $ele = $(".scrollToTop");

        $(window).scroll(function() {
            $(this).scrollTop() >= 100 ?
                $ele.show(1).animate({
                        right: "10px",

                        opacity: "1"
                    },
                    1
                ) :
                $ele.animate({
                        right: "-50px",

                        opacity: "0"
                    },
                    1
                );
        });

        $ele.click(function(e) {
            e.preventDefault();

            $("html,body").animate({
                    scrollTop: 0
                },
                600
            );
        });
    });

    $("#trusted_partner").owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            1000: {
                margin: 35,
                items: 5
            }
        }
    });

    $("#elu_slider").owlCarousel({
        loop: true,
        margin: 5,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1
            }
        }
    });

    // Team Slider Js
    $(".team_slider").owlCarousel({
        loop: true,
        items: 1,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 3000,
        itemsDesktop: [1000, 1],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsMobile: [650, 1],
        pagination: true,
        autoPlay: true
    });

    // case studies Slider Js
    $(".studies_slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3,
                autoplay: false,
                dots: false
            }
        }
    });

    new WOW().init();

    // $('.scroll_form').on('click', function(event) {
    //     $(".nav_two a").removeClass('active');
    //     $(this).addClass('active');
    //     var target = $($(this).attr('href'));
    //     if (target.length) {
    //         event.preventDefault();
    //         $('html, body').animate({
    //             scrollTop: target.offset().top - 300
    //         }, 800)
    //     }
    // });

    $(window).scroll(function() {
        if (
            $(window).scrollTop() + $(window).height() >
            $(document).height() - 78
        ) {
            //
            $("#quote").css({ bottom: "78px" });
            // $('#floatingcontactcta').animate({bottom:'70px'},1000);
        } else {
            $("#quote").css({ bottom: "0" });
        }
    });

    $(".scroll_form").click(function() {
        $("html, body")
            .stop()
            .animate({
                    scrollTop: $($(this).attr("href")).offset().top - 140
                },
                600
            );
        setTimeout(function() {
            $("#contact-form-top").addClass("animated bounce");
        }, 600);

        setTimeout(function() {
            $("#contact-form-top").removeClass("animated bounce");
        }, 6000);
    });
});