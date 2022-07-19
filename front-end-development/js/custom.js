

function setHeaderSticky() {
    if ($(window).scrollTop() >= 80) {
        $("header").addClass("sticky");
    } else {
        $("header").removeClass("sticky");
    }
}
$(window).scroll(function () {
    setHeaderSticky();
});

$(window).on("load", function () {
    setHeaderSticky();
});
$(document).ready(function () {
    $(".scroll_form").click(function () {
        $("html, body")
            .stop()
            .animate({
                scrollTop: $($(this).attr("href")).offset().top - 140
            },
                600
            );
        setTimeout(function () {
            $("#contact-form-top").addClass("animated bounce");
        }, 600);

        setTimeout(function () {
            $("#contact-form-top").removeClass("animated bounce");
        }, 6000);
    });

    // SrollTop Js
    $(function () {
        var $ele = $(".scrollToTop");

        $(window).scroll(function () {
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

        $ele.click(function (e) {
            e.preventDefault();

            $("html,body").animate({
                scrollTop: 0
            },
                600
            );
        });
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


});