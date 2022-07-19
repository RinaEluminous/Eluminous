<?php
$pagename = 'Contact';
$pagename1 = ' ';
$pageTitle = 'Contact Us - eLuminous - Usa, Uk, South Africa, India';
//Put page title here
$metaDesc = 'Connnect to eLuminous to get the one stop IT solutions to empower your business with high profit margins.Get a Quote Today!';
//Put meta description here
$keywords = 'Contact Us, Contact Us Email, Contact eLuminous Technologies, IT solutions company';
//Put keywords here
?>
<?php
require_once 'includes/head.php';
require_once 'captchaGenerate.php';
?>
<!-- inner_banner -->
<script src = 'https://www.google.com/recaptcha/api.js'></script>
<section class = 'inner_banner'>
      <img src = '<?php echo SITE_URL;?>images/contact_us_banner.png' alt = 'Contact - eLuminous Technologies' class = 'img-fluid'>
      <div class = 'inner_page_title'>
            <div class = 'container'>
                  <h1>Let's get the conversation started
                        <small>Its time to hear your ideas &amp; business challenges</small>
                  </h1>
            </div>
      </div>
</section>
<!-- inner_banner -->
<section id="inspire_true_connection" class="p-0 contact-us-form">
      <?php require_once 'includes/main_contact.php';?>
</section>
<div class="container">
      <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                  <div class="modal-content" style="background-color: #fff;">
                        <div class="modal-header">
                              <button type="button" class="close modalClose" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body"> Thanks For contacting with us
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default modalClose"
                                    data-dismiss="modal">Close</button>
                        </div>
                  </div>
            </div>
      </div>
</div>
<section class="gray_bg branches_all_wrapper">
      <div class="bg-img">
            <div class="container">
                  <h2 class="text-center"> Corporate Office</h2>
                  <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="branches_all_over_world">
                                    <span><img src="<?php echo SITE_URL;?>images/contact/india_flag.jpg" alt="India Flag">HQ
                                          Nashik</span>
                                    <address>
                                          IT Park-29/7, Near Power House, MIDC Ambad, Ambad Industrial Area, Nashik,
                                          Maharashtra,India - 422010
                                    </address>
                                    <div class="contact_details">
                                          <a href="mailto:sales@eluminoustechnologies.com">
                                                <img src="<?php echo SITE_URL;?>images/contact/country_mail.png" alt="">
                                                sales@eluminoustechnologies.com</a>
                                    </div>
                                    <div class="contact_details">
                                          <a href="tel:[912532382566]">
                                                <img src="<?php echo SITE_URL;?>images/contact/country_phone.png"
                                                      alt="">
                                                +91 253 238 2566</a>
                                    </div>
                              </div>
                        </div>
                        <div class="col-md-12 three_branhes">
                              <div class="row">
                                    <div class="col-md-12 col-lg-4 col-sm-12">
                                          <div class="branches_all_over_world">
                                                <span><img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg"
                                                            alt="USA Flag">USA</span>
                                                <address>
                                                      708, 3rd Avenue,<br>New York-10017, <br>USA
                                                </address>
                                                <div class="contact_details">
                                                      <a href="mailto:sales@eluminoustechnologies.com">
                                                            <img src="<?php echo SITE_URL;?>images/contact/country_mail.png"
                                                                  alt="">
                                                            sales@eluminoustechnologies.com</a>
                                                </div>

                                                <div class="contact_details">
                                                      <a href="tel:+918208222939">
                                                            <img src="<?php echo SITE_URL;?>images/contact/country_phone.png"
                                                                  alt="">
                                                                  +1 484 401 9147</a>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-sm-12">
                                          <div class="branches_all_over_world">
                                                <span><img src="<?php echo SITE_URL;?>images/contact/uk_flag.jpg"
                                                            alt="UK Flag">UK</span>
                                                <address>
                                                      12 Hammersmith <br>Grove London W6 7AP,<br>UK
                                                </address>
                                                <div class="contact_details">
                                                      <a href="mailto:sales@eluminoustechnologies.com">
                                                            <img src="<?php echo SITE_URL;?>images/contact/country_mail.png"
                                                                  alt="">
                                                            sales@eluminoustechnologies.com</a>
                                                </div>
                                                <div class="contact_details">
                                                      <a href="tel:+918208222939">
                                                            <img src="<?php echo SITE_URL;?>images/contact/country_phone.png"
                                                                  alt="">
                                                                  +44 186 560 0698</a>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-sm-12">
                                          <div class="branches_all_over_world">
                                                <span><img src="<?php echo SITE_URL;?>images/contact/south_africa_flag.png"
                                                            alt="South Africa Flag">South Africa</span>
                                                <address>
                                                      65 Cumberland Avenue,<br> Bryanston, Sandton,<br> South Africa.
                                                </address>
                                                <div class="contact_details">
                                                      <a href="mailto:sales@eluminoustechnologies.com">
                                                            <img src="<?php echo SITE_URL;?>images/contact/country_mail.png"
                                                                  alt="">
                                                            sales@eluminoustechnologies.com</a>
                                                </div>
                                                <div class="contact_details">
                                                      <a href="tel:[27798748495]">
                                                            <img src="<?php echo SITE_URL;?>images/contact/country_phone.png"
                                                                  alt="">
                                                            +27 (79)874-8495</a>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>
<?php require_once 'includes/footer.php';
?>