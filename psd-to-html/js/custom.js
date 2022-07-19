$(document).ready(function() {
    
	/* price tag animation - start 
	var animCount = 0; isCountPlus = true;
    roadInterval = setInterval(function(){
      if(isCountPlus == true){
        animCount = animCount+0.5;
        if(animCount >= 5){
          isCountPlus = false;
        }
      }else{
        animCount = animCount-0.5;
          if(animCount <= -5){
            isCountPlus = true;
          }
      }
      $('.tech-pricing').css({ '-webkit-transform': 'translate3d('+ -animCount*2 +'px, 0, 0) rotate('+ animCount +'deg)',
    '-moz-transform': 'translate3d('+ -animCount*2 +'px, 0, 0) rotate('+ animCount +'deg)',
    'transform': 'translate3d('+ -animCount*2 +'px, 0, 0) rotate('+ animCount +'deg)' });
    }, 100);
	 price tag animation - end */
	

	
	
	  $("#owl-demo").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1,
        nav: true,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
    });
	
	$("#team").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1,
        nav: true,
		margin:40,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
		responsive : {
			// breakpoint from 0 up
			360 : {
				items:1,
			},
			// breakpoint from 480 up
			480 : {
				items:2,
			},
			// breakpoint from 768 up
			768 : {
				items:2,
			},
			// breakpoint from 992 up
			992 : {
				items:1,
			}
		}
    });
	
	  $("#notification").owlCarousel({
 
		navigation:true,
		slideSpeed: 200,
		paginationSpeed: 400,
		singleItem: true,
		items: 1,
		nav: false,
		loop: true,
		autoplay: true,
		autoplayTimeout:3000,
		autoplayHoverPause: true,
	 
	  });
	  
	    $("#feedback").owlCarousel({ 
		navigation:true,
		slideSpeed: 200,
		paginationSpeed: 400,
		singleItem: true,
		items: 1,
		nav: true,
		loop: true,
		autoplay: true,
		autoplayTimeout:3000,
		autoHeight : true,
		autoplayHoverPause: true,
	 
	  });
		
	
	
	if ($(window).width() > 992) {
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();
	
		if (scroll >= 100) {
			$("body").addClass("darkHeader");
		} else {
			$("body").removeClass("darkHeader");
		}
	});
	}
	
	
/* $('.formContact').on('submit', function(e) {
    	var obj = $(this);
        $.ajax({
            type: 'post',
            url: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(msg) {
                if (msg.type == 'succs') {
                    $("#myModal").modal('show');
                    obj[0].reset()
                } else {
                    if (msg.fullName != '') {
                        obj.find(".errfname").html(msg.fullName).show();
                    }
                    if (msg.email != '') {
                        obj.find(".erremail").html(msg.email).show();
                    }
					 if (msg.country != '') {
                        obj.find(".errcountry").html(msg.country).show();
                    }
                    if (msg.mobileNo != '') {
                        obj.find(".errmobileNo").html(msg.mobileNo).show();
                    }
                }
            }
        });
        e.preventDefault();
    })*/

      $.validator.addMethod("nameval", function(value, element) { 
           return  /^([a-zA-Z]+([a-zA-Z ]){1,30})$/.test(value); 
      }, "Please fill valid name.");

      $.validator.addMethod("emailval", function(value, element) { 
           return  /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value); 
      }, "Please fill valid email.");

      $.validator.addMethod("mobileval", function(value, element) { 
      return /^[0-9\()\- ]\d{9,14}$/.test(value); 
    }, "Please fill valid contact number.");

      $(document).ready(function(){
        $('#frmContact').validate({
          highlight: function(element) {
            $(element).parent().addClass("errorElement");
          },
          rules: {
            fullName: {
              required: true,
              nameval: true
            },
            email: { 
              required: true,
              emailval: true
            },
            country: {
              required: true,
            },
            contactNo: {
              required: true,
              mobileval: true
            },            
          },
          messages: {
            fullName: {
              required: 'This is required.',
            },
            email: {
              required: 'This is required.',
            },
            country: {
              required: 'This is required.',
            },
            contactNo: {
              required: 'This is required.',
            },
          },
          
          submitHandler: function(){
            var formData = $('#frmContact').serialize();
            console.log(formData);
            $("#btnSubmit").prop('disabled', true);
            $("#btnSubmit").attr('value', 'SENDING..');
            $.ajax({
              method: 'POST',
              url: 'post',
              data: formData,
              success: function(data){
                if(data.indexOf('mailsuccess') != -1){
                 // alert('Mail sent successfully..');
                  $("#frmContact")[0].reset();
                  $("#get-quote").prop('disabled', false);
                  $("#myModal").modal('show');
                  // $("#get-quote").attr('value', 'SEND');
                }else{
                  // alert('Message could not be sent. Please try again!');
                  $("#get-quote").prop('disabled', false);
                  // $("#get-quote").attr('value', 'SEND');
                }
                if(data.indexOf('Invalid reCAPTCHA') != -1){
                  $('#capchaErr').html('Invalid reCAPTCHA code, please verify you have entered the code correctly');
                }
              }
            });
          }
        });
      });
	
   
   $('#hero a.contactBtn').bind('click', function(event) {
	  var $anchor = $(this);
	  var $mobHeader = $('.navbar-fixed-top').height();
	  $('html, body').stop().animate({
		  scrollTop: $($anchor.attr('href')).offset().top - $mobHeader
	  }, 1000);
	  event.preventDefault();
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

}); //end document.ready

$('.orange').click(function(e) {
     e.preventDefault();
	 $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top -102
    }, 500);
});


     
//<![CDATA[
$(window).on('load', function() { // makes sure the whole site is loaded 
  $('#status').fadeOut(); // will first fade out the loading animation 
  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(350).css({'overflow':'visible'});
})
    //]]>