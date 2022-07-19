

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

    $("#testimonials_slider, #review_slider").owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        dots: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1
            }
        }
    }); 

    $("#partner_slider").owlCarousel({
        loop: true,
        margin: 13,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 2
            },
            401: {
                items: 3
            },
            767: {
                items: 4
            },
            991: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    }); 

});