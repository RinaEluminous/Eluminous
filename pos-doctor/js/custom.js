$(document).ready(function() {
  // Toggle Menu
  $('#desk_btn').click(function() {
    $('#desk_btn').addClass('active');
    $('.sidebar').addClass('active');
    $('.menu_overlay').addClass('active');
  });

  $('#menu_btn, .menu_overlay, nav ul li a').click(function() {
    $('#desk_btn').removeClass('active');
    $('.sidebar').removeClass('active');
    $('.menu_overlay').removeClass('active');
  });

  // Dashboard Slider
  $('#dashboard_slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    autoplayTimeout:9000,
    navText: ["<img src='images/icons/slider-navigation-prev-icon.png'>", "<img src='images/icons/slider-navigation-next-icon.png'>"],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1
      }
    }
  });

  // Customor Slider
  $('#customer_slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: true,
    autoplay: 7000,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1
      }
    }
  });

  // Smooth Scroll
  $('a[href^="#"]').on('click', function(event) {
    var target = $($(this).attr('href'));
    if (target.length) {
      event.preventDefault();
      $('html, body').animate({ scrollTop: target.offset().top - 85 }, 600);
    }
  });

    $(function() {
      var $ele = $('.scrollToTop');
        $(window).scroll(function() {
            $(this).scrollTop() >= 200 ? $ele.show(1).animate({ right : '15px' }, 1) : $ele.animate({ right : '-80px' }, 1);
        });
        $ele.click(function(e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 600);
        });
    });
  // sticky header 
  $(window).scroll(function() {
    if ($(window).scrollTop() >= 1) {
      $('header').addClass('sticky');
    } else {
      $('header').removeClass('sticky');
    }
  });

});