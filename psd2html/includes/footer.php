<?php include('sucess-popup.php'); ?>
<section id="footer">
  <footer>
    <div class="container">
    	<div class="row">
        	<div class="col-sm-6 col-md-6">Copyright &copy; 2017 <a href="http://eluminoustechnologies.com/" target="_blank">eLuminous technologies Pvt. Ltd</a></div>
            <div class="col-sm-6 col-md-6 links">
            	<a href="#about"> About us</a> / 
                <a href="#portfolio"> Portfolio</a> /
                <a href="#reviews"> Testimonials</a> /                
                <!--<a href="#faq"> FAQ</a >/-->
                <a href="#" data-toggle="modal" data-target="#myModal2"> Contact us</a >/
                <a href="http://eluminoustechnologies.com/blog/" target="_blank">Blog</a>     
            </div>
        </div>    
    </div>
  </footer>
</section>

<script type="text/javascript">
window.addEventListener('load',function(){
jQuery('#frmContact .submit-btn').click(function(){
var timer= setInterval(function(){google()},1000)
function google(){
if(jQuery(' h2:contains("Thanks for your interest ")').is(":visible")){
jQuery('body').append('<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/880466289/?label=0yh4CJb8k3MQ8bLrowM&amp;guid=ON&amp;script=0"/>');
clearInterval(timer);
}
}
})
})
</script>



<!-- JavaScript Files--> 
<script src="js/jquery-1.9.1.min.js"></script> 
<script src="js/myCustom.js"></script> 
<script src="js/mycontact.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="assets/masterslider/jquery.easing.min.js"></script> 
<script src="assets/owl-carousel/owl.carousel.min.js"></script> 
<script type="text/JavaScript" src="js/go-top.js"></script> 


    <!-- load cubeportfolio -->
    <script type="text/javascript" src="assets/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>

    <!-- init cubeportfolio -->
    <script type="text/javascript" src="js/main.js"></script>
 
<!-- SCRIPTS -->
<script type="text/javascript">			
	$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

</script> 
<script type="text/javascript">
$(document).ready(function() {
	$("#header-logo").owlCarousel({
		items:4,
		margin:20,
		loop:true,
		autoplay:true,
   		autoplayTimeout:2000,
		responsive: {
			0: {
				items: 1
			},
			480: {
				items: 2
			},			
			736: {
				items: 2
			},
			767: {
				items: 2
			},
			1024: {
				items: 3
			},
			1280: {
				items: 3
			},
			1366: {
				items: 3
			},
			1440: {
				items: 3
			},
			1600: {
				items: 4
			}
		}
	});
	//$('#faq-banner').css('height', $(window).height());	
});
$( window ).resize(function() {
	//$('#faq-banner').css('height', $(window).height());
}); 
jQuery(function($) {
 var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
 $('.nav a').each(function() {
  if (this.href === path) {
   $(this).closest('ul').find('.active').removeClass('active');
   $(this).parent().addClass('active');    
  }
 });
});
</script> 
<script type="text/javascript">
$(document).ready(function() {
	 var owl = $('#testimonial-sec .owl-carousel');
	  owl.owlCarousel({
		margin: 30,
		nav: true,
		loop: true,		
		autoplay:true,
    	autoplayTimeout:5000,
   		autoplayHoverPause:true,
		
		responsive: {
		  0: {
			items: 1
		  },
		  600: {
			items: 1
		  },
		  992: {
			items: 2
		  }
		}
	  })	 
	  	  
})
</script> 
<script type="text/javascript">
$( document ).ready(function() {	
	
	/* highlight the top nav as scrolling occurs */
	$('body').scrollspy({ target: '#nav' });
	
	$("a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){   
			window.location.hash = hash;
		  });
    	} 
  	});
	
});

</script>
    
<!-- Preloader -->
<script type="text/javascript">
    //<![CDATA[
        $(window).load(function() { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(350).css({'overflow':'visible'});
            $('#videoModalLoad').show();
        })
    //]]>
</script>
<script type="text/javascript">
	$('.collapse').on('shown.bs.collapse', function(){
	$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
	}).on('hidden.bs.collapse', function(){
	$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
	});
	
	
	// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
	
   //to hide and show the get a free quote link	
   $(window).resize(function() {
		if($(window).width() > 768){
			$("#mobile-nav").show();
			$(".contacts").show();
		}else{
			 var toggle = $(".navbar-toggle").is(":visible");
			 if (toggle) {
					$("#mobile-nav").hide();
					$(".contacts").hide();
			 }else{
				 $("#mobile-nav").show();
				 $(".contacts").show();
			 }
		}
	
	});	
	//Hamburger Menu Toggle start
  $(".navbar-nav li a").click(function (event) {
    // check if window is small enough so dropdown is created
    var toggle = $(".navbar-toggle").is(":visible");
    if (toggle) {
      $(".navbar-collapse").collapse('hide');
	  if($(window).width() <= 768){
		$("#mobile-nav").hide(); 
		$(".contacts").hide();
	 }
    }
  });
  
  $("#mobile-nav").click(function (event) {
    // check if window is small enough so dropdown is created
    var toggle = $(".navbar-toggle").is(":visible");
    if (toggle) {
      $(".navbar-collapse").collapse('hide');
	 if($(window).width() <= 768){
		  $("#mobile-nav").hide(); 
		  $(".contacts").hide();
	   }
    }
	
  });
//Hamburger Menu Toggle end
	
	//Nav Click - START	
	jQuery("#navmenu").on('click', function(){
		setTimeout(function(){	
			var isClicked = jQuery("#navmenu").attr('aria-expanded');
			if( isClicked == "true" ){
			   jQuery("header nav").addClass('select');
			   $("#mobile-nav").show();		
			    $(".contacts").show();
			  
			} else {
				jQuery("header nav").removeClass('select');
				 if($(window).width() <= 768){
					$("#mobile-nav").hide(); 
				    $(".contacts").hide();
				 }
			}
		}, 100);
	});
	//Nav Click - END
	
	//Intrest form
	$('.btn-interest').click(function(e) {
        $('.interestform').show('milliseconds');
		$('.actionbtn').hide();
		
    });
	
	$('.btn-interest-close').click(function(e) {
        $('.interestform').hide('milliseconds');
		$('.actionbtn').show('milliseconds');
		
    });
	
		

var show = function(){
    $('#exitpopup').modal('show');
};

$(window).load(function(){
    var timer = window.setTimeout(show,5000);
});

</script>

<script type="text/javascript">

    $(document).ready(function(){     

	
        var url = $("#eluminousVideo").attr('src');


        $("#videoModal").on('hide.bs.modal', function(){

            $("#eluminousVideo").attr('src', '');

        });
        

        $("#videoModal").on('show.bs.modal', function(){

            $("#eluminousVideo").attr('src', url);

        });

    });
	
		$('.playbtn').click(function(){ 
    $('.playbtn').addClass('moveout');
});


$('#videoModal').click(function(){ 
    $('.playbtn').removeClass('moveout');
});

</script>




</body>
</html>