<?php
$pagename = "portfolio";
$pagename1 = " ";
$pageTitle = "Portfolio  - eLuminous Technologies"; //Put page title here
$metaDesc = "Watch out the latest projects devloped by eLuminous. We have developed 1000 plus web , mobile & front-end applications in instinct of technologies."; //Put meta description here
$keywords = "eLuminous portfolio, web development projects,mobile app development projects, front end development projects,IT projects, design and development projects";//Put keywords here
?>
<?php require_once 'includes/head.php';?>
<style type="text/css">
.margin-mobile-bottom.quoteBg:after {
   display: none;
}

.quoteBg .gray_bg:hover {
   -webkit-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.09);
   box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.09);
}

.quoteBg .gray_bg {
   transition: all 0.2s ease-in-out;
}
.error{
   color: #ff0000;
}
.loader{
        display: none;
       position: absolute;
       top:0px;
      right:0px;
      width:100%;
      height:100%;
      background-color:#eceaea;
      background-image:url('<?php echo SITE_URL;?>images/loader.gif');
      background-size: 50px;
      background-repeat:no-repeat;
      background-position:center;
      z-index:10000000;
      opacity: 0.4;
      filter: alpha(opacity=40);
      }
</style>
<!-- inner_banner -->
<section class="inner_banner">
   <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner.jpg" alt="Portfolio" class="img-fluid">
   <div class="inner_page_title">
      <div class="container">
         <h1>Portfolio</h1>
         <ul class="portfolio_list text-white">
            <li><span class="text-white">2589+</span> Websites Developed</li>
            <li><span class="text-white">657+</span> E-commerce Websites Developed</li>
            <li><span class="text-white">513+</span> Mobile Apps Developed</li>
         </ul>
         <!-- <a href="#contact" class="blue_big_btn blue_big_btn_scrool">Let's Grow Together</a> -->
      </div>
   </div>
</section>
<section class="case_studay">
   <div class="container">
      <div class="row m-lg-0">
         <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="row">
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/jack-wills/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio-jackwills.jpg"
                                 alt="Portfolio - Jack Wills" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Jack Wills</h4>
                              <p><b>Designed Engaging UI/UX for UK's Popular Fashion Brand</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/afra-furniture/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio1.jpg"
                                 alt="Portfolio - Afra Furniture" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Afra Furniture</h4>
                              <p><b>Developing a Web based Product Catalogue for Furniture Manufacturer in Canada</b>
                              </p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/cosmeticplant/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio2.jpg"
                                 alt="Portfolio - Cosmetic Plant" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Cosmetic Plant</h4>
                              <p><b>Online Beauty store for a beauty product manufacturer in Israel</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/angelcarebaby/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio3.jpg"
                                 alt="Portfolio - Angelcare Baby" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Angelcare Baby</h4>
                              <p><b>Multilingual eCommerce Store For Babycare Products</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/b1g1-NGO/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio4.jpg"
                                 alt="Portfolio - B1G1" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>B1G1</h4>
                              <p><b>Highly optimised website for a global NGO on a mission to create "A World Full of
                                    Giving"</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/pi-rate/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio5.jpg"
                                 alt="Portfolio - Pi-Rate" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Pi-Rate</h4>
                              <p><b>Demand Side platform (DSP) for Digital and Print media Advertiser in Australia</b>
                              </p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/trtcle/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio6.jpg"
                                 alt="Portfolio - TRTCLE" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>TRTCLE</h4>
                              <p><b>eLearning Management System for CLE (Continuiing Legal Education)</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/edunetsol/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio7.jpg"
                                 alt="Portfolio - Edunet" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Edunet</h4>
                              <p><b>School Communication ERP Product with Real Time Tracking</b></p>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/trakinvest/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio8.jpg"
                                 alt="Portfolio - TrackInvest" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>TrackInvest</h4>
                              <p><b>World’s 1st Social Equity Trading Platform with High-Profit Margins</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/club-bookers/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio9.jpg"
                                 alt="Portfolio - Club Bookers" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Club Bookers</h4>
                              <p><b>Centralized Club Booking System with Dynamic Pricing Solution</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/logo-maker/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio10.jpg"
                                 alt="Portfolio - Logo Maker - Create a design" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Logo Maker - Create a design</h4>
                              <p><b>Most popular Logo Maker app with 1 Million+ downloads & 66K reviews</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/BI-tyre-manufacturer/" target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio11.jpg"
                                 alt="Portfolio - BI project for Tyre (tire) manufacturing company" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>BI project for Tyre (tire) manufacturing company</h4>
                              <p><b>Top Notched BI Solution for Giant in Tyre Industry</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
               <!-- case study start HERE -->
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12 margin-mobile-bottom quoteBg">
                  <div class="gray_bg">
                     <div class="row">
                        <a href="<?php echo SITE_URL;?>portfolio_details/behaviour-management-analysis/"
                           target="_blank">
                           <div class="case_study_img col-sm-12 col-md-12 col-lg-12">
                              <img src="<?php echo SITE_URL;?>images/portfolio-thumb/portfolio12.jpg"
                                 alt="Portfolio - Behaviour Management Analysis" class="img-fluid">
                           </div>
                           <div class="project_details col-sm-12 col-md-12 col-lg-12 ">
                              <h4>Behaviour Management Analysis</h4>
                              <p><b>Developed BMA Mobile App For real-time Record Keeping</b></p>

                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <!-- case study END HERE -->
            </div>
         </div>			
			<div class="col-sm-12 col-md-4 col-lg-3">
				<div class="form__wrapper">
					<img src="<?php echo SITE_URL;?>images/portfolio-collage.png" alt="Portfolio Collage" class="w-100 img-fluid" />
					<div class="wrap">
                  <div class="download__box" style="display:none;" id="portfolio_download__box">
                     <h5>Download Case Studies PDF Here:</h5>
                     <div class="form-group">
   							<a class="btn" href="<?php echo SITE_URL;?>images/pdf-file/Case-Studies-eLuminous-Technologies.pdf" download >
   								Download Now!
   							</a>
   						</div>
                  </div>
                  <div class="loader"></div>
                  <!-- <div class="loader">
                    <img src="<?php echo SITE_URL;?>images/loader.gif" alt="" style="width: 50px;height:50px;">
                </div> -->
                  <div class="form__box" id="portfolio_form__box">
                     <h5>Get Our Recent <br/> Case Studies in Your Inbox!</h5>
                     <div class="form">
                        <span class="error" id="err"></span>
                        <div class="form-group">
                           <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                           <button class="btn" name="submit" type="button" id="make_proposal" value="Submit">
                              Submit
                           </button>

                        </div>
                     </div>
   					</div>
					</div>
				</div>
			</div> 
      </div>
   </div>
</section>
<?php require_once 'includes/footer.php'; ?>
<?//php require_once 'includes/free_quote.php';?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
$(document).ready(function() {
   
   // On email Input Enter function For getting Case Studies
   $(document).on("keypress", "input", function(e){
      
      var email = $('#email').val(); 
      var error = '';
      console.log(email);
      if(email != '' && emailReg != 'NaN'){
         var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
         var valid = emailReg.test( email ); 
         console.log(valid);
         if(!valid){
            error = 'Please enter valid email';
         }
      }else{
         error = 'Email field is required';
      }
      //console.log('error :' + error);
      if(error == ''){
         $('.loader').show();
         $.ajax({
            method: 'POST',
            url: "<?php echo SITE_URL.'mail-portfolio-enquiry.php'; ?>",
            data: {email:email},
            success: function(data) {
               $('.loader').hide();
               $("#portfolio_form__box").hide();
               $("#portfolio_download__box").show();
               //var res = JSON.parse(data);
               
               //console.log(res);
               //window.location = '<?php echo SITE_URL."thank-you/"; ?>';
               /*if(res.type == "success"){
                  window.location = '<?php echo SITE_URL."thank-you/"; ?>';
                  
               }else{ 
                  $('#err').html(res.msg);
               }*/
               
            }
         });
      }else{ 
         $('#err').html(error);
      }
      

   });

   // On Submit Function For getting Case Studies

   $('#make_proposal').click(function(){
      var email = $('#email').val(); 
      var error = '';
      console.log(email);
      if(email != '' && emailReg != 'NaN'){
         var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
         var valid = emailReg.test( email ); 
         console.log(valid);
         if(!valid){
            error = 'Please enter valid email';
         }
      }else{
         error = 'Email field is required';
      }
      //console.log('error :' + error);
      if(error == ''){
         // $.LoadingOverlay("show", {
         //       background: "rgba(165, 190, 100, 0.5)"
         // });
         $('.loader').show();
         $.ajax({
            method: 'POST',
            url: "<?php echo SITE_URL.'mail-portfolio-enquiry.php'; ?>",
            data: {email:email},
            success: function(data) {
               // $.LoadingOverlay("hide");
               $('.loader').hide();
               $("#portfolio_form__box").hide();
               $("#portfolio_download__box").show();
               //var res = JSON.parse(data);
               
               //console.log(res);
               //window.location = '<?php echo SITE_URL."thank-you/"; ?>';
               /*if(res.type == "success"){
                  window.location = '<?php echo SITE_URL."thank-you/"; ?>';
                  
               }else{ 
                  $('#err').html(res.msg);
               }*/
               
            }
         });
      }else{ 
         $('#err').html(error);
      }
      

   });
});
</script>