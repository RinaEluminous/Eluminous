<?php
$pagename = "services";
$pagename1 = "Hire Dedicated Developers |Hire App Programmers";
$pageTitle = "Hire Dedicated Developer / Programmer with eLuminous - Know Why?"; //Put page title here
$metaDesc = "Hire Dedicated Developers & programmers from eLuminous with flexi-hiring models for Web Development, Mobile App Development & Business Intelligence."; //Put meta description here
$keywords = "hire dedicated web developers,hire dedicated developers,dedicated offshore developers,hire offshore dedicated developer,hire dedicated mobile developers.hire dedicated resource,hire indian programmers,hire dedicated programmers";//Put keywords here
?>
<?php require_once 'includes/head.php';?>
<style>
#main-dadicated-banner .full-img{
width: 100%;
}
section.main-dadicated-banner {
margin-top: 117px;
position: relative;
padding-top: 0;
padding-bottom: 0;
}
.main-banner-wrapper {
position: absolute;
top: 0;
width: 100%;
height: 100%;
display: flex;
align-items: center;
}
.main-banner-wrapper .container {
display: flex;
justify-content: space-between;
align-items: center;
max-width: 1199px;
}
.banner-containt {
max-width: 805px;
position: relative;
padding: 50px 50px 50px 50px;
z-index: 1;
}
.banner-containt:after {content: "";width: 100%;height: 100%;border: 4px solid rgba(255, 255, 255, 0.51);position: absolute;left: 0;top: 0;max-width: 584px;border-right: 0;z-index: -1;}
.banner-containt h3 {
color: #fff;
font-weight: bold;
font-size: 45px;
line-height: 54px;
margin-bottom: 20px
}
.banner-containt:before{
content: "";
width: 100%;
height: 30px;
border-right: 4px solid rgba(255, 255, 255, 0.51);
position: absolute;
left: 0;
top: 4px;
max-width: 584px; z-index: -1;
}
.banner-containt h3::after {
content: "";
width: 100%;
height: 240px;
border-right: 4px solid rgba(255, 255, 255, 0.51);
position: absolute;
left: 0;
bottom: 4px;
max-width: 584px;
z-index: -1;
}
.banner-containt small {
font-size: 22px;
color: #fff;
max-width: 526px;
width: 100%;
display: block;
margin-bottom: 20px;
}
a.button-main-banner {
background-color: rgb(54, 194, 100);
width: 100%;
height: 42px;
line-height: 42px !important;
text-align: center;
color: #fff !important;
margin-top: 18px;
border: 0 !important;
text-transform: capitalize !important;
letter-spacing: 0.5px;
display: inline-block;
max-width: 270px;
transition: all 0.5s;
}
a.button-main-banner:hover{
background-color: #239b4b;
-webkit-box-shadow: 0px 30px 30px 0px rgba(1, 1, 1, 0.1);
box-shadow: 0px 30px 30px 0px rgba(1, 1, 1, 0.1);
}
.banner-containt ul li {
color: #fff;
font-size: 16px;
font-weight: 500;
line-height: 34px;
padding-left: 39px;
background-image: url(images/dedicated-developer-2020/tick.png);
background-repeat: no-repeat;
background-position: left center;
}
.banner-containt ul {
margin-bottom: 30px;
}
.commen-section h2{
color: #08093a;
font-size: 36px;
font-weight: 500;
margin-bottom: 20px;
}
.commen-section h2 small{font-size: 16px; color:#08093a;}
.item-wrapper {
border: 3px solid #e6e6eb;
padding: 40px 30px;
min-height: 340px;
border-radius: 10px;
transition: all 0.5s;
cursor: pointer;
margin: 30px 0;
height: 100%;
max-height: 340px;
}
.item-wrapper h3 {
font-size: 20px;
margin: 23px 0;
}
.logo-box {
display: flex;
align-items: center;
}
.logo-box li {
padding: 30px;
background-color: #fff;
border: 3px solid #f4f5f9;
margin-right: 15px;
margin-bottom: 15px;
border-radius: 10px;
min-height: 140px;
display: flex;
align-items: center;
justify-content: center;
width: 150px;
}
section.dedicated-developer-logos {
padding: 0;
background-color: #f4f5f9;
position: relative;
z-index: 1;
}
.logo-box li:last-child {
margin-bottom: 0;
}
section.dedicated-developer-logos::after, section.dedicated-developer-logos::before {
width: 100%;
height: 30px;
content: "";
background-color: #fff;
position: absolute;
top: 0;
left: 0;
z-index: -1;
}
section.dedicated-developer-logos::before{
top: auto;
bottom: 0;
}
.item-wrapper:hover {
background-color: #169ef8;
border: 3px solid #169ef8;
}
.commen-section p {
font-size: 16px;
color: #000;
line-height: 28px;
margin-bottom: 15px;
}
.commen-section p:last-child {
margin-bottom: 0;
}
.item-wrapper p {
font-size: 14px;
line-height: 22px;
}
section.hiring-process .container{
max-width: 1250px;
}
.commen-section .blue_big_btn {
width: 100%;
max-width: 240px;
margin-top: 50px;
}
.item-wrapper:hover h3, .item-wrapper:hover p {
color: #fff;
}
.hiring-models h2 {
margin-bottom: 60px;
}
section.hiring-process .logo-box li {
max-width: 194px;
width: 100%;
position: relative;
flex-wrap: wrap;
transition: all 0.5s;
}
section.hiring-process .logo-box li h3 {
font-size: 16px;
text-align: center;
}
.number {
background-color: #169ef8;
position: absolute;
top: -3px;
right: -3px;
width: 25px;
height: 25px;
text-align: center;
line-height: 25px;
font-size: 12px;
color: #fff;
font-weight: 500;
transition: all 0.5s;
}
.icon-hover-change {
background-image: url(images/dedicated-developer-2020/all-icon-img-5.png);
width: 54px;
height: 54px;
background-size: auto;
margin-bottom: 20px;
}
section.hiring-process .logo-box li:hover {
background-color: #2196f3;border-color: #2196f3; cursor: pointer;
}
section.hiring-process .logo-box li:hover h3, section.hiring-process .logo-box li:hover p{
color: #fff;
}
section.hiring-process .logo-box li:hover .number{
background-color: #c7dbff; color: #1d4e9c;
}
.icon-hover-change.icon-hover-2 {
background-position: 0 -72px;
}
.icon-hover-change.icon-hover-3 {
background-position: 0 -144px;
}
.icon-hover-change.icon-hover-4 {
background-position: 0 -216px;
}
.icon-hover-change.icon-hover-5 {
background-position: 0 -288px;
}
section.hiring-process .logo-box li:hover .icon-hover-1 {
background-position: -65px 0;
}
section.hiring-process .logo-box li:hover .icon-hover-change.icon-hover-2 {
background-position: -65px -72px;
}
section.hiring-process .logo-box li:hover .icon-hover-change.icon-hover-3 {
background-position: -65px -144px;
}
section.hiring-process .logo-box li:hover .icon-hover-change.icon-hover-4 {
background-position: -65px -216px;
}
section.hiring-process .logo-box li:hover .icon-hover-change.icon-hover-5 {
background-position: -65px -288px;
}
section.dedicated-resources-wrapper h2 small {
margin-bottom: 10px;
}
section.dedicated-resources-wrapper h2 {
line-height: 38px;
margin-bottom: 40px;
}
section.dedicated-resources-wrapper ul li {
font-size: 18px;
color: #000000;
font-weight: 500;
line-height: 36px;
position: relative;
padding-left: 30px;
}
section.dedicated-resources-wrapper ul li::after {content: "";width: 9px;height: 9px;position: absolute;border-radius: 100px;border: 1px solid #000;top: 13px;left: 0;}
section.dedicated-resources-wrapper .container{
max-width: 1150px;
}
section.dedicated-resources-wrapper .img-box {
position: absolute;
z-index: -1;
left: -90px;
top: -50px;
}
section.dedicated-resources-wrapper {
background-color: #f4f5f9;
position: relative;
z-index: 1;
padding-top: 120px;
padding-bottom: 0;
}
section.dedicated-resources-wrapper::after {
background-color: #fff;
height: 70px;
position: absolute;
content: "";
width: 100%;
bottom: 0;
z-index: -1;
}
.good-firms p {
font-size: 18px;
max-width: 400px;
margin-bottom: 60px;
}
section.good-firms {
background-color: #f4f5f9;
margin-bottom: 100px;
background-image: url(images/dedicated-developer-2020/object.png);
background-repeat: no-repeat;
background-position: right 60px;
position: relative;
z-index: 1;
}
section.good-firms::after {
content: "";
background-image: url(images/dedicated-developer-2020/object-1.png);
background-repeat: no-repeat;
background-position: left 230px;
position: absolute;
width: 100%;
height: 100%;
left: auto;
top: 0;
z-index: -2;
}
.good-firms-list {
margin-right: 80px;
}
.commen-hover-box {
background-image: url(images/dedicated-developer-2020/hiring-models.png);
width: 64px;
height: 58px;
background-size: inherit;
margin-bottom: 20px;
margin-left: auto;
margin-right: auto;
}
.item-wrapper:hover .item-wrapper-hover-1 {
background-position: -82px -1px;
}
.item-wrapper-hover-2 {
background-position: 2px -66px;
width: 68px;
height: 70px;
}
.item-wrapper:hover .item-wrapper-hover-2 {
background-position: 68px -66px;
}
.item-wrapper-hover-3 {
background-position: 2px -136px;
width: 68px;
height: 70px;
}
.item-wrapper:hover .item-wrapper-hover-3 {
background-position: 68px -136px;
}
.item-wrapper-hover-4 {
background-position:2px -214px;
width: 68px;
height: 70px;
}
.item-wrapper:hover .item-wrapper-hover-4 {
background-position: 68px -214px;
}
.item-wrapper:hover {
background-color: #169ef8;
border: 3px solid #169ef8;
box-shadow: 4px 3px 8px rgba(0, 0, 0, 0.27);
}
.popup-bar .modal-dialog {
background-color: #fff;
max-width: 390px;
padding: 30px;
border-radius: 10px;
}
.popup-bar {
margin-top: 80px;padding: 0 15px !important;
}
.popup-bar button.close {
position: static;
padding: 0 !important;
}
.popup-bar .modal-header {
padding: 0;
border: 0;
}
.popup-bar .modal-header button.close {
font-size: 22px;
}
.popup-bar .form-control {
border: 0;
}
.popup-bar .contact-form-error-message span {
margin: 13px 0;
}
.popup-bar .form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
color: #333; font-size: 12px; letter-spacing: 0.5px;
}
.popup-bar .form-control::-moz-placeholder { /* Firefox 19+ */
color: #333; font-size: 12px; letter-spacing: 0.5px;
}
.popup-bar .form-control:-ms-input-placeholder { /* IE 10+ */
color: #333; font-size: 12px; letter-spacing: 0.5px;
}
.popup-bar .form-control:-moz-placeholder { /* Firefox 18- */
color: #333; font-size: 12px; letter-spacing: 0.5px;
}
.popup-bar .form-control{
font-size: 14px;
}
.popup-bar .input_white_bg span img {
width: 100%;
}
.popup-bar .input_white_bg.textarea_box {
height: 90px;
}
.popup-bar .small_blue_btn {
    height: 44px;
    line-height: 44px;
    font-size: 14px;
    width: calc(100% - 8px);
    margin: 0 5px;
}
.popup-bar .input_white_bg.textarea_box {
height: 90px;
}
.input_white_bg span {
width: 36px;
padding-right: 14px;
margin-left: 10px;
}
section.dedicated-resources-wrapper button {
    max-width: none !important;
    display: inline-block;
    width: auto !important;
}
.banner-containt button.blue_big_btn {
    background-color: #36c264;
    line-height: 44px;
    height: 44px;
    margin-top: 30px;
}
.form-row_custom h4 {
    font-size: 24px;
    font-weight: 500;
}
.logo-box li img {
    max-width: 70px;
}

/*Mobile*/
@media (max-width: 1600px) {
.banner-containt h3 {
font-size: 36px;
line-height: 40px;
}
.banner-containt small {
font-size: 20px;
}
.banner-containt ul {
margin-bottom: 0;
}
div#main-dadicated-banner img {
max-width: none;
width: auto !important;
height: auto;
}
div#main-dadicated-banner {
overflow: hidden;
height: 650px;
}
.main-banner-wrapper {
padding: 0 30px;
}
}
@media (max-width: 1199px) {
section.dedicated-developer-logos .container, section.hiring-process .container, section.dedicated-resources-wrapper
.container {
padding:0  30px;
}
section.dedicated-developer-logos .commen-section {
padding-left: 70px;
}
section.dedicated-developer-logos::after, section.dedicated-developer-logos::before {
height: 70px;
}
section.hiring-process .logo-box li {
max-width: max-content;
width: auto;
}
section.dedicated-resources-wrapper .img-box + img {
width: 100%;
}
.commen-section h2 {
font-size: 27px;
line-height: 35px;
}
section.good-firms {
padding-left: 0;
padding-right: 0;
}
section.main-dadicated-banner {padding-left: 0;padding-right: 0;}
div#our_parthner_slider .owl-nav {
display: none;
}
.logo-box li {
width: auto;
padding: 15px;
min-height: 110px;
}
section.dedicated-developer-logos::after, section.dedicated-developer-logos::before{display: none;}
section.dedicated-developer-logos {padding: 60px 0;}
section.dedicated-resources-wrapper ul li {
font-size: 14px;
line-height: 22px;
margin-bottom: 20px;
}
section.dedicated-resources-wrapper {overflow: hidden;}
section.dedicated-resources-wrapper ul li::after {
top: 8px;
}
section.dedicated-resources-wrapper::after{display: none}
section.dedicated-resources-wrapper {
padding-bottom: 60px;
}
}
@media (max-width: 767px) {
.commen-section h2 small {
text-align: left;
max-width: 100%;
}
section.dedicated-resources-wrapper .commen-section {
margin-top: 50px;
}
.good-firms p {
max-width: 100%;
margin-bottom: 30px;
}
section.good-firms {
padding-bottom: 50px;
}
.good-firms-list {
margin-right: 0;
text-align: center;
}
section.good-firms .col-md-6.text-right {
order: 2;
margin-top: 50px;
}
section.hiring-process .logo-box li {
min-height: 160px;
max-width: 210px;
}
.logo-box {
flex-direction: column;
width: 100%;
margin-top: 70px;
}
section.hiring-process .logo-box li h3 {
width: 100%;
}
.logo-box ul {
display: flex;
align-items: center;
justify-content: center;
}
section.dedicated-developer-logos .commen-section {
padding-left: 30px;
padding-right: 30px;
}
section.dedicated-developer-logos .container, section.hiring-process .container, section.dedicated-resources-wrapper .container {
padding: 0 15px;
}
.company-logo-slider {
display: none;
}
section.commen-section.hiring-models small {
text-align: center;
}
section.dedicated-developer-logos .logo-box {
margin-top: 0;
}
section.dedicated-developer-logos .logo-box ul {
width: 100%;
}
section.dedicated-developer-logos .logo-box ul li {
width: 170px;
margin-bottom: 20px;
}
section.dedicated-developer-logos .logo-box ul li:last-child {
margin-right: 0;
}
section.hiring-process .logo-box li:last-child {
margin-right: 0;
}
section.good-firms {
background-image: none;
}
}
@media (max-width: 640px) {
.item-wrapper {min-height: auto;}
section.main-dadicated-banner {margin-top: 91px;}
.banner-containt {
padding:0;
}
.banner-containt h3{
    font-size: 36px;
    line-height: 44px;
}
section.hiring-process .logo-box li {
max-width: 100%;
width: 100%;
margin-right: 0;
margin-bottom: 15px;
}
section.hiring-process .logo-box ul {
flex-wrap: wrap;
}
.banner-containt:after, .banner-containt:before, .banner-containt h3::after {
    display: none;
}
div#main-dadicated-banner {
    height: 550px;
}
}
@media (max-width: 480px) {
.item-wrapper {
min-height: auto;
}
.banner-containt h3{    
font-size: 28px;
    line-height: 38px;
}
.main-banner-wrapper{padding: 15px;}
.banner-containt small {font-size: 16px;}
.banner-containt ul li{font-size: 14px;}
.logo-box li {
width: 100% !important;
margin-right: 0;
}
.logo-box ul {
flex-wrap: wrap;
}
div#main-dadicated-banner {
height: 460px;
}
.good-firms-list img {
max-width: 100%;
}
.commen-section .blue_big_btn {
height: 44px;
line-height: 44px;
max-width: 100%;
margin-top: 20px;
}
}
@media (max-width: 400px) {
div#main-dadicated-banner {
height: 560px;
}
.banner-containt ul li {
    background-position: left 7px;
    padding-left: 20px;
    background-size: 12px;
    line-height: 19px;
    margin-bottom: 15px;
}

.banner-containt ul li:last-child {
    margin-bottom: 0;
}
}
</style>
<!-- inner_banner -->
<section class="main-dadicated-banner">
    <div id="main-dadicated-banner">
        <img src="images/dedicated-developer-2020/main-banner-bg.jpg" alt="main-banner" class="img-fluid full-img">
    </div>
    <div class="main-banner-wrapper">
        <div class="container">
            <div class="banner-containt">
                <h3>Hire Dedicated Developer</br>
                with Stress-Free Management</h3>
                <small>Team augmentation & flexi-hiring models to quickly expand your staff</small>
                <ul>
                    <li>Strict NDA & Data Security</li>
                    <li>Cross Industry Verticals Experience</li>
                    <li>Quick Turnaround Time</li>
                </ul>
                <button type="button" class="blue_big_btn blue_big_btn_scrool wow fadeInDown" data-toggle="modal" data-target="#exampleModal">
                Talk to developer now!
                </button>
            </div>
            <div class="company-logo-slider">
                <img src="images/dedicated-developer-2020/app-development.png" alt="app-development" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<!-- INDUSTRIES SERVED -->
<section class="commen-section hiring-models">
    <div class="container text-center">
        <h2><small>Partner With Us</small>
        Hiring Models
        </h2>
        <div class="parthner-slider">
            <div id="our_parthner_slider" class="owl-carousel">
                <div class="item">
                    <div class="item-wrapper ">
                        <div class="item-wrapper-hover-1 commen-hover-box"></div>
                        <h3>Individual Dedicated Developer</h3>
                        <p>Hire a skilled developer who can operate remotely, equipped with standard work labs</p>
                    </div>
                </div>   
                <div class="item">
                    <div class="item-wrapper">
                        <div class="item-wrapper-hover-2 commen-hover-box"></div>
                        <h3>Team Of Dedicated Developers</h3>
                        <p>Hire a team of dedicated resources with a dedicated office space and complete control over the work process</p>
                    </div>
                </div>
                <div class="item">
                    <div class="item-wrapper ">
                        <div class="item-wrapper-hover-3 commen-hover-box"></div>
                        <h3>On-Site Developers</h3>
                        <p>We provide best suited on-site developers who understand the foreign work-culture</p>
                    </div>
                </div>
                <div class="item">  
                    
                    <div class="item-wrapper">
                        <div class="item-wrapper-hover-4 commen-hover-box"></div>
                        <h3>Industry-Specific Developers</h3>
                        <p>Hire dedicated proficient having the core IT experience of individual Industry</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Technology Expertise -->
<section class="dedicated-developer-logos">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="logo-box">
                    <ul>
                        <li><img src="images/dedicated-developer-2020/shopify.png" alt="shopify"></li>
                        <li><img src="images/dedicated-developer-2020/magento.png" alt="magento"></li>
                        <li><img src="images/dedicated-developer-2020/laravel.png" alt="laravel"></li>
                    </ul>
                    <ul>
                        <li><img src="images/dedicated-developer-2020/android.png" alt="word-press"></li>
                        <li><img src="images/dedicated-developer-2020/flutter.png" alt="php"></li>
                        
                    </ul>
                    <ul>
                        <li><img src="images/dedicated-developer-2020/react.png" alt="html"></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 commen-section">
                <h2>
                    <!-- <small>Partner With Us</small> -->
                Our Technology Expertise 
                </h2>
                <p>Develop comprehensive IT solutions with modern and cutting-edge technologies. </p>
                <p>We leverage various app development technologies, frameworks, platforms, and software design patterns to provide cost-effective and scalable IT services and solutions that help our clients drive innovation and business value.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Our Technology Expertise -->
<section class="hiring-process">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-7 commen-section">
                <h2><small>Hiring Process</small>
                Faster Go-To-Market with
                Our Expert Resource
                Pool</h2>
                <p>You will work with the experts who understand your business challenges, technological needs & more important your work culture Empowers Valuable experience.</p>

                <button type="button" class="blue_big_btn blue_big_btn_scrool wow fadeInDown" data-toggle="modal" data-target="#exampleModal">
                Hire Expert Now
                </button>
            </div>
            <div class="col-md-5 d-flex justify-content-end">
                <div class="logo-box">
                    <ul>
                        <li>
                            <div class="number">1</div>
                            <div class="icon-hover-change icon-hover-1"></div>
                            <h3><b>Submit</b>
                            your request</h3>
                        </li>
                        <li><div class="number">2</div>
                        <div class="icon-hover-change icon-hover-2"></div>
                        <h3><b>Screen</b>
                        Resumes</h3>
                    </li>
                    <li><div class="number">3</div>
                    <div class="icon-hover-change icon-hover-3"></div>
                    <h3><b>Interview</b>
                    Selected </h3>
                </li>
            </ul>
            <ul>
                <li><div class="number">4</div>
                <div class="icon-hover-change icon-hover-4"></div>
                <h3><b>Final</b>
                Selection</h3>
            </li>
            <li><div class="number">5</div>
            <div class="icon-hover-change icon-hover-5"></div>
            <h3><b>Terms</b>
            and contract</h3>
        </li>
    </ul>
</div>
</div>
</div>
</div>
</section>
<!-- our END -->
<section class="dedicated-resources-wrapper">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="img-box"><img src="images/dedicated-developer-2020/dotted-img.png" alt="word-press"></div>
<img src="images/dedicated-developer-2020/dedicated-resources-img.png" alt="word-press">
</div>
<div class="col-md-6">
<div class="commen-section">
    <h2><small>Competitive Advantage Of Hiring</small>
    Dedicated Resources With
    eLuminous</h2>
    <ul>
        <li>Trending Technologies that suits Enterprises</li>
        <li>Cost Effective & result oriented Development</li>
        <li>4+ years Employee Retention</li>
        <li>Reduced investment risk </li>
        <li>Stress Reduction of Managing Work</li>
    </ul>
    <button type="button" class="blue_big_btn blue_big_btn_scrool wow fadeInDown" data-toggle="modal" data-target="#exampleModal">Talk to developers now!</button>
</div>
</div>
</div>
</div>
</section>
<!-- our END -->
<!-- our portfolio -->
<section id="portfolio" class="pb-0">
<div class="container text-center">
<h2>Portfolio
<ul class="portfolio_list">
<li><span>2000+</span> Websites Developed</li>
<li><span>500+</span> E-commerce Websites Developed</li>
<li><span>500+</span> Mobile Apps Developed</li>
</ul>
</h2>
<?php require_once 'includes/portfolio-home.php';?>
</div>
</section>
<!-- Our Insights-->
<!-- our END -->
<section class="good-firms">
<div class="container">
<div class="row align-items-center">
<div class="col-md-6 text-right">
<div class="good-firms-list">
    <img src="images/dedicated-developer-2020/good-firms-list.png" alt="word-press">
</div>
</div>
<div class="col-md-6">
<div class="commen-section">
    <h2><small>Recognized by</small>
    Good Firms</h2>
    <p>Utilize our decades of experience with Industry experts meets your business needs across the digital landscape with their knowledge and skills</p>
   <a href="https://www.goodfirms.co/company/eluminous-technologies-pvt-ltd" target="_blank"> <img src="images/dedicated-developer-2020/good-firm.png" alt="good-firm"></a>
</div>
</div>
</div>
</div>
</section>
<!-- our END -->
<!-- Modal -->
<div class="modal fade popup-bar" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="form-row_custom">
    <div class="row">
        <div class="left_section">
            <h4 class="text-center mb-4 mt-0">Go for Risk-Free Trial</h4>
            <div class="form-row m-0">
                <div class="col-md-12">
                    <div class="input_white_bg">
                        <span><img src="<?php echo SITE_URL;?>images/contact/name.png" alt="name"></span>
                        <input type="text" class="form-control" id="dedicatedPageName" placeholder="Your name *" value="" required>
                    </div>
                    <div class="contact-form-error-message">
                        <span class="dedicatedPageNameError "></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input_white_bg">
                        <span><img src="<?php echo SITE_URL;?>images/contact/your_email.png" alt="your_email"></span>
                        <input type="text" class="form-control" id="dedicatedPageEmail" placeholder="Email Address *" required>
                    </div>
                    <div class="contact-form-error-message">
                        <span class="dedicatedPageEmailError "></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input_white_bg">
                        <span><img src="<?php echo SITE_URL;?>images/contact/mobile_number.png" alt="mobile_number"></span>
                        <input type="text" class="form-control" id="dedicatedPageMobile" placeholder="Mobile Number " required>
                    </div>
                    <div class="contact-form-error-message">
                        <span class="dedicatedPageMobileError "></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input_white_bg">
                        <span><img src="<?php echo SITE_URL;?>images/dedicated-developer/skype.png" alt="Skype"></span>
                        <input type="text" class="form-control" id="dedicatedPageSkypeId" placeholder="Skype ID " required>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="input_white_bg textarea_box">
                        <textarea type="text" class="form-control" id="dedicatedMessage" placeholder="Requirement Brief" required></textarea>
                    </div>
                </div>
                <div class="col-12 col-xs-12 col-lg-12 p-0 mt-3">
                    <div class="text-right align_mobile_sec">
                        <button type="submit"   class="small_blue_btn" id="dedicatedDeveloperSubmit">Request A Quote</button>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- END here  -->
    </div>
</div>
<!-- form-row -->
</div>
</div>
</div>
</div>
<?php require_once 'includes/footer.php';?>
<script>
$('#our_parthner_slider').owlCarousel({
loop:true,
margin:15,
nav:true,
responsive:{
0:{
items:1
},
640:{
items:2
},
768:{
items:3
},
1220:{
items:4
}
}
})
</script>
<?//php require_once 'includes/free_quote.php';?>
<!-- JSON-LD markup generated by Google Structured Data Markup Helper. -->
<script type="application/ld+json">
{
"@context" : "http://schema.org",
"@type" : "LocalBusiness",
"name" : "Hire Dedicated Developers",
"image" : "https://eluminoustechnologies.com/images/16-years.png",
"telephone" : "+91 253 238 2566",
"email" : "sales@eluminoustechnologies.com",
"description": "Hire Dedicated Developers & programmers from eLuminous with flexi-hiring models for Web Development, Mobile App Development & Business Intelligence.",
"address" : {
"@type" : "PostalAddress",
"streetAddress" : "IT Park-29/7, Near Power House, MIDC Ambad",
"addressLocality" : "Nashik",
"addressRegion" : "Maharashtra",
"addressCountry" : "India",
"postalCode" : "422010"
},
"url" : "paste targeted service page url",
"aggregateRating" : {
"@type" : "AggregateRating",
"ratingValue" : "4.63",
"bestRating" : "5",
"worstRating" : "1",
"ratingCount" : "205"
}
}
</script>