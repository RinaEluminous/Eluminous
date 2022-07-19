function setHeaderSticky() {
    if ($(window).scrollTop() >= 80) {
        $("nav").addClass("sticky");
    } else {
        $("nav").removeClass("sticky");
    }
}
$(window).scroll(function() {
    setHeaderSticky();
});

$(window).on("load", function() {
    setHeaderSticky();
});
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

   

$(document).ready(function() {

 

    window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
  document.body.appendChild(css);
};


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

$('.scroll_form').on('click', function() {
   

        $("html, body").stop().animate({scrollTop: $($(this).attr("href")).offset().top - 140},600);
           setTimeout(function() {
            $("#contact-form-top").addClass("animated bounce");
        }, 600);
     setTimeout(function() {
            $("#contact-form-top").removeClass("animated bounce");
        }, 6000);

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
        nav: true,
        autoplay: true,
        autoplayTimeout: 3000,
        itemsDesktop: [1000, 1],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsMobile: [650, 1],
        pagination: true,
        autoPlay: true

    });
    // Project Slider Js
  $('#review_slider').owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    responsiveClass: true,
    nav: false,
    responsive: {
      0: {
        items: 1
      }
    }
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

    // typing text
var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 1000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 300 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};


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

    
});
