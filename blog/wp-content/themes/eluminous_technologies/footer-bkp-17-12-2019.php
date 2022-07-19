<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eluminous_technologies
 */

?>

<?php 
if($_COOKIE['cookieAccept'] && $_COOKIE['cookieAccept'] == "Accepted"){
  ?>

<script>
jQuery(document).ready(function () {
  jQuery("#cookieStrip").hide();
});
</script>

  <?php 
}else{
  ?>
<script>
  jQuery(document).ready(function () {
  jQuery("#cookieStrip").show();
});
</script>

  <?php
}


$strAddress = get_option('strAddress');
$intContact = get_option('intContact');
$strEmail = get_option('strEmail');
$strSkype = get_option('strSkype');
$strCopyright = get_option('strCopyright');

  ?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <h6>Know more</h6>
                <ul>
                    <li><a href="<?php echo SITE_URL;?>about-us.php">About us</a></li>
                    <li><a href="<?php echo SITE_URL;?>case-studies.php">Case Studies</a></li>
                    <li><a href="<?php echo SITE_URL;?>clients-testimonials.php">Testimonials</a></li>
                    <li><a href="<?php echo SITE_URL;?>career.php">Careers</a></li>
                    <li><a href="<?php echo SITE_URL;?>contact.php">Free Quote</a></li>
                     <li><a href="<?php echo SITE_URL;?>company-brochure" target="_blank">Company Brochure</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-3">
                <h6>Our Services</h6>
                <ul>
                    <li class="active"><a href="<?php echo SITE_URL;?>web-application-development.php">Web Development</a></li>
                    <li><a href="<?php echo SITE_URL;?>mobile-app-development.php">Mobile Apps Development</a></li>
                    <li class=""><a href="<?php echo SITE_URL;?>front-end-development.php">Front End Development</a></li>
                    <li><a href="<?php echo SITE_URL;?>business-intelligence-services.php">Business Intelligence Services</a></li>
                    <li><a href="<?php echo SITE_URL;?>dedicated-developer.php">Hire Dedicated Developers</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-2">
                <h6>Support</h6>
                <ul>
                    <li><a href="http://etdigitalmarketing.com/" target="_blank">Digital Marketing</a></li>
                    <li><a href="https://eluminousva.com/" target="_blank">Virtual Assistant</a></li>
                </ul>
            </div>
            <div class="col-md-12 col-lg-4 full_tablet_view">
                <h6>Contact</h6>
                <address>
                    <div class="company_adress d-flex">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <?php echo (isset($strAddress) && ($strAddress != '')) ? $strAddress : '' ?>
                    </div>
                    <div class="company_contact d-flex">
                        <a href="tel:<?php echo (isset($intContact) && ($intContact != '')) ? $intContact : '' ?>"> <i class="fa fa-phone" aria-hidden="true"></i>
                        <?php echo (isset($intContact) && ($intContact != '')) ? $intContact : '' ?></a></div>
                        <div class="company_mail d-flex">
                            <a href="mailto:<?php echo (isset($strEmail) && ($strEmail != '')) ? $strEmail : '' ?>" class="desktop">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <?php echo (isset($strEmail) && ($strEmail != '')) ? $strEmail : '' ?></a>
                        </div>
                        <div class="company_skype d-flex">
                            <a href="skype:<?php echo (isset($strSkype) && ($strSkype != '')) ? $strSkype : '' ?>?chat"><i class="fa fa-skype" aria-hidden="true"></i><?php echo (isset($strSkype) && ($strSkype != '')) ? $strSkype : '' ?></a>
                        </div>
                    </address>
                </div>
            </div>
        </div>
    </footer>
    
<?php
$strFBLink = get_option('strFBLink');
$strTwitterLink = get_option('strTwitterLink');
$strGplus = get_option('strGplus');
$strLinkedIn = get_option('strLinkedIn');
$strYTLink = get_option('strYTLink');
?>    

    <section class="bottom_footer">
        <div class="container">
            <div class="row">
                <div class="social_media col-12 col-md-6 col-sm-12">
                    <ul>
                        <li class="facebook"><a href="<?php echo (isset($strFBLink) && ($strFBLink != '')) ? $strFBLink : '' ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li class="twitter"><a href="<?php echo (isset($strTwitterLink) && ($strTwitterLink != '')) ? $strTwitterLink : '' ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li class="google-plus"><a href="<?php echo (isset($strGplus) && ($strGplus != '')) ? $strGplus : '' ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li class="linkedin"><a href="<?php echo (isset($strLinkedIn) && ($strLinkedIn != '')) ? $strLinkedIn : '' ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li class="youtube"><a href="<?php echo (isset($strYTLink) && ($strYTLink != '')) ? $strYTLink : '' ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="copy_right col-12 col-md-6 col-sm-12 text-right">
                     <?php echo (isset($strCopyright) && ($strCopyright != '')) ? $strCopyright : '' ?>
                    <ul>
                        <li><a href="<?php echo SITE_URL;?>terms-and-conditions.php">Terms &amp;  Conditions</a></li>
                        <li><a href="<?php echo SITE_URL;?>privacy-policy.php">Privacy &amp; Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="cookieStrip">
        <div class="container">
        <div class="cookieStrip">
            <p>eLuminous Technologies uses cookies to ensure that we give you the best experience on our website. If you continue we assume that you consent to our use of cookies. Click <a href="privacy-policy.php">here </a>to find out more.</p>           <a class="contBtn" id="contBtn" href="#">Continue</a>
        </div>
        </div>
    </div>
    <div class='scrolltop'>
        <div class='scroll icon'><i class="fa fa-4x fa-angle-up"></i></div>
    </div>
    <a href="#chat" class="chatting-popup"><i class="fa fa-comments" aria-hidden="true"></i>
    </a>
    <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script> -->
    <script src="<?php echo SITE_URL;?>js/jquery.min.js"></script>
    <script src="<?php echo SITE_URL;?>js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_URL;?>assets/owlcarousel/js/owlcarousel.min.js"></script>
    <script src="<?php echo SITE_URL;?>js/custom.js"></script>
    <script src="<?php echo SITE_URL;?>assets/slick/js/slick.js"></script>
    <script src="<?php echo SITE_URL;?>assets/slick/js/slick.min.js"></script>
    <script src='<?php echo SITE_URL;?>js/ryxren.js'></script>
    <script src='<?php echo SITE_URL;?>js/index.js'></script>
    
<!-- Start of Async Drift Code -->
<script>
"use strict";

!function() {
  var t = window.driftt = window.drift = window.driftt || [];
  if (!t.init) {
    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
    t.factory = function(e) {
      return function() {
        var n = Array.prototype.slice.call(arguments);
        return n.unshift(e), t.push(n), t;
      };
    }, t.methods.forEach(function(e) {
      t[e] = t.factory(e);
    }), t.load = function(t) {
      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
      var i = document.getElementsByTagName("script")[0];
      i.parentNode.insertBefore(o, i);
    };
  }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('8axgs8ar6c2k');
</script>
<!-- End of Async Drift Code -->

    <?php wp_footer(); ?>
</body>
</html>