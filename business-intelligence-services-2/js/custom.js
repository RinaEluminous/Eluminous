
$(document).ready(function() {

	 $("#header").sticky({topSpacing:0});


      $("#turf-points").owlCarousel({
	items : 1,
    itemsCustom : false,
    itemsDesktop : [1199,1],
    itemsDesktopSmall : [980,1],
    itemsTablet: [768,1],
    itemsTabletSmall: false,
    itemsMobile : [479,1],
        navigation : false,
		pagination : true,
		
		//Basic Speeds
    slideSpeed : 1500,
    paginationSpeed : 800,
    rewindSpeed : 1000,
	//Autoplay
    autoPlay : true,
      });

        $(".navbar-nav li a").click(function(event) {
        $(".navbar-collapse").collapse('hide');
    });
    });


 $(function() {
    $('.navbar-nav a[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
  });

 $('.navbar-nav').onePageNav({
    scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
    filter: ':not(.external)',
    changeHash: true
  });

    