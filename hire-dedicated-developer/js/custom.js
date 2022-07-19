$(document).ready(function() {
    $(".scroll_form").click(function() {
        $("html, body")
            .stop()
            .animate({
                    scrollTop: $($(this).attr("href")).offset().top - 180
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

    $("#review_slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: true,
        animateIn: 'fadeIn',
        // animateOut: 'fadeOut',
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1
            }
        }
    });

    if ($(window).width() < 768) {
        startCarousel();
    } else {
        $('.technologiesList__wrapper .owl-carousel').addClass('off');
    }

    $(window).resize(function() {
        if ($(window).width() < 768) {
            startCarousel();
        } else {
            stopCarousel();
        }
    });

    function startCarousel() {
        $("#technologiesSlider").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            animateIn: 'fadeIn',
            mouseDrag: false,
            freeDrag: false,
            touchDrag: false,
            // animateOut: 'fadeOut',
            autoplay: true,
            autoplayTimeout: 8000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 1
                }
            }
        });
        $(".technologiesSliderInner").owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            animateIn: 'fadeIn',
            autoplay: true,
            autoplayTimeout: 8000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 2,
                },
                576: {
                    items: 4,
                }
            }
        });
    }

    function stopCarousel() {
        var owl = $('.technologiesList__wrapper .owl-carousel');
        owl.trigger('destroy.owl.carousel');
        owl.addClass('off');
    }



});