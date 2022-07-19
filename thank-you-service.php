<?php
session_start();
$pageTitle = "Thank You | eLuminous Technologies"; //Put page title here
$metaDesc = "eLuminous Technologies Pvt Ltd is One of The Leading Information Technology, Consulting And Outsourcing Company. We Believe That Customers are The Reason For Our Success, And Are Committed To Protecting Your Privacy On The Internet."; //Put meta description here
$keywords = "Thank You, eLuminous Technologies Privacy Policy";//Put keywords here
?>
<?php require_once 'includes/head.php';?>
<!-- inner_banner -->
<!-- inner_banner -->
<section class="mb-5 mt-5 thank_you_bg" >
	<div class="container">
		<div class="text-center thank_you">
			<div class="tick_icon text-center col-12"><img src="images/check.png" alt="thank you" class="mt-1 mb-4 img-fluid"></div>
			<h1>Thank You <span>for showing interest in our services, <?php echo $_SESSION['name']?> </span></h1>
			<p><strong>
			Our expert will get back to you within next 24 hours.</strong>
		</p>

		 <!-- <a href="#" class="blue_big_btn blue_big_btn_scrool mt-5"><img src="images/call_center.png" alt="call center" style="margin-right: 10px;" /> Live Chat Now!</a>  -->
			
		</div>
	</section>
	<?php require_once 'includes/footer.php';
unset($_SESSION['name']);
	?>
	<?//php require_once 'includes/free_quote.php';?>