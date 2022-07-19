<script>
$(window).scroll(function() {
    $(window).scrollTop() >= 3 ? $("header").addClass("sticky") : $("header").removeClass("sticky")
});

$('#our_parthner_slider').owlCarousel({
    loop: true,
    margin: 15,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        640: {
            items: 2
        },
        768: {
            items: 3
        },
        1220: {
            items: 4
        }
    }
});
$("#our_portfolio").owlCarousel({
    loop: !0,
    margin: 20,
    autoplay: !0,
    nav: !1,
    autoplayTimeout: 3e3,
    responsiveClass: !0,
    responsive: {
        0: {
            items: 1,
            loop: !0
        },
        600: {
            items: 2,
            loop: !1
        },
        1000: {
            items: 3,
            loop: !1
        },
        1200: {
            items: 4,
            loop: !1
        },
    },
});
</script>
<!-- <script type="text/javascript">
   setTimeout(function () {
      var mybot = document.createElement('mybot'); mybot.id = 'webchat';
      var body = document.getElementsByTagName('body')[0]; body.appendChild(mybot, body);
      var userId = document.createElement('input'); userId.type = 'hidden'; userId.id = 'userId'; userId.name = 'userId';
      mybot.parentNode.insertBefore(userId, mybot);
      var userReq = document.createElement('input'); userReq.type = 'hidden'; userReq.id = 'userReq'; userReq.name = 'userReq';
      mybot.parentNode.insertBefore(userReq, mybot);

      var origin = "https://betaeserver.com/elum-chatboat";
      var source = [
         //{"name":"bootstrap", "type":"js", "url": "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"}, 
         { "name": "webscript_form", "type": "js", "url": origin + "/UI/static/js/webscript_form.js" },
         { "name": "jquery", "type": "js", "url": "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" },
         // {"name":"bootstrap", "type":"css", "url": "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"},
         { "name": "wechatstyle", "type": "css", "url": origin + "/UI/static/css/wechatstyle.css" }
      ]
      source.forEach(importSrc);

      function importSrc(obj) {
         if (obj.type == 'js') {
            if (obj.name == 'jquery' && window.jQuery)
               return
            var be = document.createElement('script');
            be.crossorigin = '*';
            be.type = 'text/javascript';
            be.async = true;
            be.src = obj.url;
            var j = document.getElementsByTagName('script')[0]; j.parentNode.insertBefore(be, j);
         } else {
            var link = document.createElement("link");
            link.type = "text/css";
            link.rel = "stylesheet";
            link.href = obj.url;
            var s = document.getElementsByTagName('head')[0]; s.appendChild(link, s);
         }
      };
   }, 2000);

   jQuery(document).ready(function () {
      jQuery.get(
         "https://ipinfo.io",
         function (e) {
            (randNum = Math.floor(100 * Math.random() + 400)),
               (randNum += "+"),
               (dynamicCountryName = " Happy Clients From " + e.country),
               "IN" == e.country
                  ? $("#inCode").show()
                  : "US" == e.country
                     ? ($("#usCode").show(), $("#inCode").hide())
                     : "ZA" == e.country
                        ? ($("#zaCode").show(), $("#inCode").hide())
                        : "UK" == e.country || "GB" == e.country
                           ? ($("#ukCode").show(), $("#inCode").hide())
                           : $("#inCode").show();
         },
         "jsonp"
      ),
         setTimeout(function () {
            jQuery("#randNumber").text(randNum), jQuery("#randvalue").text(dynamicCountryName);
         }, 1e3);

        $(window).scroll(function () {
            $(window).scrollTop() >= 3 ? $("header").addClass("sticky") : $("header").removeClass("sticky");
        })

       $("#contBtn").click(function () {
            $("#cookieStrip").hide(),
                $.ajax({
                   url: "cookieAccept.php",
                   type: "post",
                   dataType: "json",
                   data: { authentication: "cookieAccept" },
                   success: function (e) {
                      $("#cookieStrip").hide();
                   },
                });
        });

        
    });

   $(window).scroll(function () {
      $(this).scrollTop() > 50 ? $(".scrolltop:hidden").stop(!0, !0).fadeIn() : $(".scrolltop").stop(!0, !0).fadeOut();
   });

   $(".scroll").click(function () {
      return $("html,body").animate({ scrollTop: $("html").offset().top }, "1000"), !1;
   });

   
</script> -->

<?php /*
    if($_COOKIE['cookieAccept'] == "Accepted"){
    ?>
<script>
$(document).ready(function() {
    $("#cookieStrip").hide();
});
</script>
<?php
    }else{
        ?>
<script>
$(document).ready(function() {
    $("#cookieStrip").show();
});
</script>
<?php
    }*/
    ?>
<!-- BEGIN PLERDY CODE -->
<script type="text/javascript" defer data-plerdy_code='1'>
var _protocol = "https:" == document.location.protocol ? " https://" : " http://";
_site_hash_code = "eb52a398c6e4f78f04632ba8ce412749", _suid = 26495, plerdyScript = document.createElement("script");
plerdyScript.setAttribute("defer", ""), plerdyScript.dataset.plerdymainscript = "plerdymainscript",
    plerdyScript.src = "https://a.plerdy.com/public/js/click/main.js?v=" + Math.random();
var plerdymainscript = document.querySelector("[data-plerdymainscript='plerdymainscript']");
plerdymainscript && plerdymainscript.parentNode.removeChild(plerdymainscript);
try {
    document.head.appendChild(plerdyScript)
} catch (t) {
    console.log(t, "unable add script tag")
}
</script>
<!-- END PLERDY CODE -->

<!-- Start of HubSpot Embed Code -->
<?php if(strpos($_SERVER['REQUEST_URI'], 'job-apply') == false){ ?>
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/632147.js"></script>
<?php  } ?>
<!-- End of HubSpot Embed Code -->
</body>

</html>