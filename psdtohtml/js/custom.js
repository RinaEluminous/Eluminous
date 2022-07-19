$(document).ready(function() {
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
    $(".dropdown-menu li a").click(function() {
        $(".sub-btn:first-child").html($(this).text() + ' <span class="caret"></span>');
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    $('a[href^="#"]').on('click', function(event) {
        var target = $($(this).attr('href'));
        var strClass = $(event.target).attr('class');
        if (!$(this).hasClass('fixtop')) {
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 150
                }, 600);
                if ($(window).width() < 767) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 65
                    }, 600);
                }
            }
        }
    });
    $(".service_top_sect").sticky({
        topSpacing: 0
    });
    $('.psd_responsive a').on('click', function() {
        $('.psd_responsive').addClass('current');
        $('.psd_html_5').removeClass('current');
        $('.psd_wordpress').removeClass('current');
    });
    $('.psd_html_5 a').on('click', function() {
        $('.psd_html_5').addClass('current');
        $('.psd_responsive').removeClass('current');
        $('.psd_wordpress').removeClass('current');
    });
    $('.psd_wordpress a').on('click', function() {
        $('.psd_wordpress').addClass('current');
        $('.psd_responsive').removeClass('current');
        $('.psd_html_5').removeClass('current');
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    $(document).on('click', function() {
        $('.collapse').collapse('hide');
    })
 
//<![CDATA[
        $(window).on('load', function() { // makes sure the whole site is loaded 
            $('#status').fadeOut(); // will first fade out the loading animation 
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
            $('body').delay(350).css({'overflow':'visible'});
          })
    //]]>
 
 
    $('#stickyform').click(function() {
        var isFormUp = $('.nb-form').hasClass('formup');
        if (isFormUp) {
            $('.nb-form').addClass('formdown');
            $('.nb-form').removeClass('formup');
        } else {
            $('.nb-form').removeClass('formdown');
            $('.nb-form').addClass('formup');
        }
    });
});
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 250) {
        $("body").addClass("serviceinfo");
    } else {
        $('body').removeClass('serviceinfo');
    }
});
$(document).ready(function() {
    $('.formContact').on('submit', function(e) {
        var obj = $(this);
        $.ajax({
            type: 'post',
            url: 'post.php',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(msg) {
                if (msg.type == 'succs') {
                    $("#myModal").modal('show');
                    obj[0].reset()
                } else {
                    if (msg.fullName != '') {
                        obj.find(".errfname").html(msg.fullName).show()
                    }
                    if (msg.email != '') {
                        obj.find(".erremail").html(msg.email).show()
                    }
					 if (msg.country != '') {
                        obj.find(".errcountry").html(msg.country).show()
                    }
                    if (msg.mobileNo != '') {
                        obj.find(".errmobileNo").html(msg.mobileNo).show()
                    }
                }
            }
        });
        e.preventDefault()
    })
    $(".contForm").on("submit", function(e) {
        $("#loader").show();
        var o = new FormData($(this)[0]),
            a = $(this);
        $.ajax({
            type: "post",
            url: "postCont.php",
            dataType: "JSON",
            data: o,
            async: !1,
            cache: !1,
            contentType: !1,
            processData: !1,
            success: function(e) {
                $("#loader").hide(), "succs" == e.type ? ($("#myModal2").modal("hide"), $("#myModal").modal("show"), a[0].reset()) : ("" != e.fullName && a.find(".errfname").html(e.fullName).show(), "" != e.email && a.find(".erremail").html(e.email).show(), "" != e.mobileNo && a.find(".errmobileNo").html(e.mobileNo).show())
            }
        }), e.preventDefault()
    })
})