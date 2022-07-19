 <?php
      /*$filename1 != "gitex-2018" && $filename1 !="thank-you"*/
      if($filename1 == 'index'){ ?>
        
      <?php }?>
      <?php
      if($filename1 == 'index' || $filename1 == 'web-application-development'){ ?>
   <div class="divi-logo-btn">
   	<button type="button" class=" " data-toggle="modal" data-target="#onpageLoadPopup"> 
      <img src="<?php echo SITE_URL;?>images/event/divi-logo.png" alt="divi-logo 2019" class="img-fluid">
  </button>
  </div>
      <div id="onpageLoadPopup" class="modal fade hire-divi-expert" role="dialog">
         <div class="modal-dialog">
            
            <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <section class="event-banner p-0">
                  <div class="row m-0">
                      <div class="col-md-6 d-none d-lg-block d-md-block p-0">
                        <img src="<?php echo SITE_URL;?>images/event/onload-popup-img.jpg" alt="gitex-2018" class="img-fluid">
                     </div>
                     
                     <div class="text-left col-md-6 p-0">
                        <div class="right-section-popup">
                           <div class="logo ml-0">
                              <img src="<?php echo SITE_URL;?>images/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" class="img-fluid">
                           </div>

                           <h2><span>Get The Best</span> <b>Divi Expert Services</b>
                              <small>How does Divi stand out from the rest?</small></h2>
                           <ul>
                              <li>Most Popular WordPress Theme</li> 
                              <li>100% customization options</li> 
                              <li>Faster and Reliable Changes</li> 
                              <li>Flexible</li> 
                              <li>Responsive Editing</li> 
                              <li>Real-Time Design</li> 
                              <li>Import & Export Layouts</li> 
                              <li>Multilingual, and many more!</li> 
                           </ul>
<h5><b>eLuminous</b> provide an excellent Divi expert service to assist you all design and development would like for Divi theme. </h5>
<h6>100% Satisfaction Guarenteed</h6> 
                           <a href="<?php echo SITE_URL;?>contact" class="blue_big_btn">HIRE NOW</a>
                        </div>
                     </div>
                    
                  </div>
               </section>
            </div>
         </div>
      </div>
      <?php }?>


      <style type="text/css" media="screen">
.hire-divi-expert h2 {
    font-size: 23px;
    color: #333333;
    margin-top: 24px;
    margin-bottom: 15px;
}   
.hire-divi-expert h2 small{
  font-size: 18px;
  font-family: "Poppins";
  color: rgb(255, 48, 139);
  font-weight: 600;
  line-height: 1.333;
  text-align: left; 
}
.hire-divi-expert ul li {
    font-size: 15px;
    font-family: "Poppins";
    color: #333333;
    line-height: 1.6;
    text-align: left;
    position: relative;
    padding-left: 16px;
    font-weight: 400;
}
.hire-divi-expert ul li:after {
    content: "";
    width: 6px;
    height: 6px;
    background-color: #ff308b;
    position: absolute;
    left: 0;
    top: 9px;
    border-radius: 50%;
} 
.hire-divi-expert h5{
font-size: 15px;
    font-family: "Poppins";
    color: rgb(51, 51, 51);
    line-height: 1.4;
    margin-top: 12px;
}
.hire-divi-expert h6{
    font-size: 21px;
    font-family: "Poppins";
    color: rgb(51, 51, 51);
    font-weight: bold;
    line-height: 1.2;
    margin: 20px 0;
}
.hire-divi-expert a.blue_big_btn { 
   background-color: rgb(255, 48, 139); 
   width: 100%; 
   font-size: 24px;
   font-weight: bold;
   border: 0;
   
    margin-left: 0;
}
.mobile-app-development div#onpageLoadPopup, .mobile-app-development .modal-backdrop.show,
.data-analytics-and-bi div#onpageLoadPopup, .data-analytics-and-bi .modal-backdrop.show {
  display: none !important;
}
.divi-logo-btn button {
	border: 0;
	cursor: pointer;
	background-color: transparent;
}
.divi-logo-btn {
	position: fixed;
	right: 0;
	top: 30%;
	max-width: 100px;
	-webkit-transform: translateY(30%);
	-ms-transform: translateY(30%);
	transform: translateY(30%);
	    z-index: 99;
}
body.data-analytics-and-bi.modal-open, body.mobile-app-development {
  overflow: auto !important;padding: 0 !important;
}
.hire-divi-expert .right-section-popup {padding: 30px;} 
.case_study_img img {max-width: 45%;}
.hire-divi-expert a.blue_big_btn:hover {background-color: #4843d2;}
@media only screen and (max-width: 767px) {
.divi-logo-btn {max-width: 60px;}
}
@media only screen and (max-width: 540px) {
.hire-divi-expert .right-section-popup {padding: 15px;}
div#onpageLoadPopup .modal-dialog {transform: scale(0.85);}
}
      </style>