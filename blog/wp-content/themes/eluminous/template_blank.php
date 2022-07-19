<?php
$pageTitle = get_the_title() ;

if($pageTitle  == "Mobile App download link" ){
	
	if( isset($_GET['ebook']) ){
			if( base64_decode($_REQUEST['ebook']) != "mobile" ){
				 $redirect = 'http://eluminoustechnologies.com/blog/mobile-app-ebook/';
	     			wp_redirect($redirect);
				
			}
			
		}
		else{
				$redirect = 'http://eluminoustechnologies.com/blog/mobile-app-ebook/';
	     		wp_redirect($redirect);
			}
				 /*if($_SERVER['HTTP_REFERER'] != "http://eluminoustechnologies.com/blog/mobile-app-ebook/"){
			 	if( $ebookMobile != "mobile")
			 	 $redirect = 'http://eluminoustechnologies.com/blog/mobile-app-ebook/';
			     wp_redirect($redirect);
			 }*/
 
}
get_header();
require_once('mail_functions.php');
ob_start();
?>


<style>

@import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900');

@import url('https://fonts.googleapis.com/css?family=Anton');

/*font-family: 'Anton', sans-serif;*/

.entry-title {
	
	display: none !important;
}

a{ text-decoration:none;}

.popup-sec {

  background-color: #fff;

  border: 1px solid #ededed;

  border-radius: 10px;

  font-family: "Roboto",sans-serif;

  margin: auto;

  max-width: 600px;

  overflow: hidden;

  padding: 25px 0px 0;

}

.popup-sec h2 {

  color: #c35150;

  font-family: "Anton",sans-serif;

  font-size: 36px;

  font-weight: normal;

  line-height: 43px;

  margin-bottom: 11px;

  margin-top: 10px;

  text-transform: uppercase;

}

  .popup-sec h3 {

  color: #323232;

  font-size: 18px;

  margin-bottom: 0px;

  margin-top: 0;

  font-weight:normal;

 }

.popup-sec img {

  float: left;

  margin-left: 30px;

  margin-right: 18x;

}

.popup-form {

  background: #efede1 none repeat scroll 0 0;

  height: 130px;
  
  clear: both;

  float: left;

  margin-top: 10px;

  padding: 15px 25px;

  width: 100%;

  text-align:center;
  


}

.popup-form a {

  background: #333;

  color: #fff;

  padding: 10px 20px;

  border-radius: 5px;

}

.popup-form a:hover {

  background: #434343;

  }

.popup-footer {

  background: #c35150 none repeat scroll 0 0;

  clear: both;

  color: #fff;

  display: block;

  float: left;

  font-size: 12px;

  line-height: 36px;

  padding: 0 25px;

  text-align: center;

  width: 100%;

}

.popup-form [type="text"], .popup-form [type="phone"], .popup-form [type="email"] {

  border: 1px solid #e1e1e1;

  border-radius: 5px;

  box-sizing: border-box;

  padding: 6px 10px;

  width: 100%;

}

.popup-form .col {

  float: left;

  margin-bottom: 9px;

  width: 60%;

}

.popup-form [type="submit"] {

  background: #171717 none repeat scroll 0 0;

  border: medium none;

  border-radius: 5px;

  color: #fff;

  cursor: pointer;

  font-family: "Roboto Condensed",sans-serif;

  font-size: 20px;

  font-weight: 700;

  line-height: 87px;

  margin-top: -130px;

  text-transform: uppercase;
   
  margin-left: 347px;

}

.popup-form [type="button"]:hover{ background:#0d0d0d;}

.col-last {

  float: left;

  margin-left: 20px;

  width: 36%;

}

.popup-form .col:nth-child(2) {

  margin: 0;

}

.popup-sec2 {

  margin-top: 30px;

}

@media (max-width: 640px){

	.popup-sec {text-align: center;}

	.popup-sec h2 {font-size: 23px;line-height: 26px;}

	.popup-form {padding: 15px;}

	.popup-form .col {width: 100%;}

	.col-last {margin-left: 0;width: 100%;}

	.popup-form [type="submit"] {line-height: 29px;margin-top: 10px;font-size: 17px;}

	.popup-footer {line-height: 15px;padding: 7px 25px;width: 130%;}

	.popup-sec img {float: none;}

	}

.abh_box.abh_box_down.abh_box_business{
	
display: none !important;
}
.wpcf7-form label {
    margin-right: 219px !important;
}

.wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email.wpcf7-not-valid {
    border: 2px solid red;
}

.wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required.wpcf7-not-valid {
    border: 2px solid red !important;
}

.wpcf7-form .wpcf7-not-valid-tip {
    display:none  !important;
}
.downloadd_link{
	margin-top:33px;
}

</style>
<?php
/* Template Name: Blank */

         while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
        <?php comments_template( '', true ); ?>
      <?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>

