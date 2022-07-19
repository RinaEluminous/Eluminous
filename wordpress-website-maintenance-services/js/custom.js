$( document ).ready(function() {
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 80) {
        $("header").addClass("scroll-header");
        $(".scrolltop:hidden").stop(!0, !0).fadeIn()
        
    } else {
      $("header").removeClass("scroll-header");      
    $(".scrolltop").stop(!0, !0).fadeOut()
    }
    if ($(this).scrollTop() > 50) {
      $('#back-to-top').fadeIn('slow');
    } else {
      $('#back-to-top').fadeOut('slow');
    }

});

$('#customer').owlCarousel({
    loop:true,
    margin:15,
    nav:false,
    dots:false, 
    autoplay:true,
autoplayTimeout:5000,
autoplayHoverPause:false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        768:{
            items:4
        },
        1000:{
            items:5
        } 
    }
})

 $(document).on('click', '#run', function(e) {
    e.preventDefault();
    $('#simple-example-table').stacktable();
    $(this).replaceWith('<span>ran - resize your window to see the effect</span>');
  });
  $('#responsive-example-table').stacktable({myClass:'your-custom-class'});
  $('#card-table').cardtable();
  $('#agenda-example').stackcolumns();

function scrollNav() {
	$('.scroll-down').click(function () {
		$('html, body').stop().animate({
			scrollTop: $($(this).attr('href')).offset().top - 90
		}, 400);
		return !1;
	});
    $('.scroll-top').click(function () {
        $('html, body').stop().animate({
            scrollTop: $($(this).attr('href')).offset().top - 140
        }, 400);
        $('#contact-form-top h2').addClass('animated bounce'); 
        setTimeout(function(){
            $('#contact-form-top h2').removeClass('animated bounce'); 
        }, 3000);
        return !1;
    });
	$('.scrollTop a').scrollTop();
}
scrollNav();

 $(function() {
        $(".scroll").click(function() {
            return $("html,body").animate({
                scrollTop: $("html").offset().top
            }, "1000"), !1
        })
        })

});
