<?php


add_action('admin_footer','wpcs_notice_script');
/**
 * @author Mohammad Mursaleen
 * @usage script to run ajax request on closing notice
 */
function wpcs_notice_script(){

    if( !wpcs_time_to_display_update_notice() )
    return;

    // if(get_transient('wpcs-admin-notice-2-2-hold'))
    //     return '';

    // if (  get_option('wpcs_display_notice_2_2') == 'no' )
    //     return '';
    
    ?>
    <script>
        jQuery(document).on( 'click', '.wpcs-first-notice .notice-dismiss', function() {
            jQuery.ajax({
                url: ajaxurl,
                data: {
                    action: 'dismiss_wpcs_notice'
                }
            })
        })
    </script>
    <style>
        .wpcs-first-notice {
            padding: 0;
        }
        .wp-6-c {
            width: 49%;
            display: inline-block;
        }
        .wp-6-c img {
            width: auto;
            height: 128px;
            float: left;
            margin-bottom: -4px;
        }
        .content-contact {
            float: left;
            width: 74%;
        }
        .logo-contact {
            float: left;
        }
        .content-contact h2 {
            padding: 0!important;
            font-size: 16px;
            margin: 7px 0 0 0!important;
            line-height: 24px;
            padding-left: 14px!important;
        }
        .content-contact p {
            line-height: 16px;
            margin: 0;
            padding-left: 16px;
        }
        .content-contact .button.button-primary.button-hero {
            box-shadow: 0 2px 0 #006799;
            margin: 8px 0 0px 16px;
            height: auto;
            line-height: 34px;
            font-weight: bold;
        }
        .wpcs-first-notice > h2 {
            position: absolute;
            top: -61px;
            display: none;
            font-weight: bold;
        }
        .wpcs_coupon_code{
            font-weight:bold;
        }
        .wpcs_coupon_line{
            background: #dd3333;
            padding: 0px 10px 3px 5px !important;
            color: white;         
        }
        /* CSS For Discount Animation */
        .wpcs_coupon_line_wrap {
            margin:0;
            overflow:hidden;
            }

            /* blue bar */
            .wpcs_coupon_line_wrap {
            position: relative;
            }

            /* text */
            .wpcs_coupon_line {
            color:#fff;
            left:50%;
            transform:translate(-50%,-50%);
            }
            .wpcs_coupon_line {
            top:50%;
            }

            /* Shine */
            .wpcs_coupon_line_wrap:after {
                content:'';
            top:0;
                transform:translateX(100%);
                width:100%;
                height:220px;
                position: absolute;
                z-index:1;
                animation: slide 1s infinite;
                
            /* 
            CSS Gradient - complete browser support from http://www.colorzilla.com/gradient-editor/ 
            */
            background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.8) 50%, rgba(128,186,232,0) 99%, rgba(125,185,232,0) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(255,255,255,0)), color-stop(50%,rgba(255,255,255,0.8)), color-stop(99%,rgba(128,186,232,0)), color-stop(100%,rgba(125,185,232,0))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,0.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,0.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%,rgba(255,255,255,0.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%); /* IE10+ */
                background: linear-gradient(to right, rgba(255,255,255,0) 0%,rgba(255,255,255,0.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#007db9e8',GradientType=1 ); /* IE6-9 */
            }
            /* animation */
            @keyframes slide {
                0% {transform:translateX(-100%);}
                100% {transform:translateX(100%);}
            }

        @media only screen and (max-width: 1252px) {

            .content-contact .button.button-primary.button-hero {
                margin: 3px 0 0px 16px;
            }
            .wp-6-c img {
                height: 100px;
            }
            .content-contact p {
                margin: 5px 0 0 0;
            }
            .wp_contact_notice {
                margin-top: 65px;
            }
            .wpcs-first-notice > h2 {
                display: block;
            }
            .content-contact h2{
                display: none;
            }
        }
        @media only screen and (max-width: 1024px) {
            .wp-6-c {
                width: 100%;
            }
        }
    </style>
    <?php
}


add_action( 'admin_notices', 'wpcs_update_notice' );
/**
 * @author Mohammad Mursaleen
 * @usage display update notice
 */
function wpcs_update_notice() {

    if( !wpcs_time_to_display_update_notice() )
    return;

    $screen = get_current_screen();


    if($screen->post_type != 'wpcs')
        return;


    if( isset($_GET['page']) && 'wp-contact-slider-addons' == $_GET['page']){
        update_option('wpcs_display_notice_2_2','no');
        return;
    }

    $addons_url = "https://wpcontactslider.com/addons-bundle/?utm=plugin_bundle"; //admin_url( 'edit.php?post_type=wpcs&page=wp-contact-slider-addons', 'https' );

    $class = 'notice notice-info is-dismissible wpcs-first-notice';
    $heading = __( 'GET ADD-ONS BUNDLE FOR WP CONTACT SLIDER' , 'wpcs' );
    $message = __( '<div class="wp_contact_notice">
                    <div class="wp-6-c">
                    <div class="logo-contact">
                          <a href="'.$addons_url.'"> <img src="'. plugins_url( 'img/notice-images/bundle-addon-icon.png', dirname(__FILE__) ). '" alt=""/></a>
                    </div>
                    <div class="content-contact">
                    <h2>GET ADD-ONS BUNDLE FOR WP CONTACT SLIDER</h2>
                    <p>Unleash the power of WP Contact Slider with AddOns Bundle</p>
                    <p class="wpcs_coupon_line_wrap"><span class="wpcs_coupon_line">Use Coupon code <span class="wpcs_coupon_code">LIFETIME40FF</span> to get <b>40% discount</b> on LifeTime Bundles</span></p>
                    <a class="button button-primary button-hero" href="'.$addons_url.'">GET ADD-ONS BUNDLE</a>
                    </div>
                    </div>
                    <div class="wp-6-c">
                       <a href="'.$addons_url.'"> <img src="'. plugins_url( 'img/notice-images/advance-setting-icon.png', dirname(__FILE__) ). '" alt=""/></a>
                          <a href="'.$addons_url.'"> <img src="'. plugins_url( 'img/notice-images/trigers-and-shortcodes.png', dirname(__FILE__) ). '" alt=""/></a>
                          <a href="'.$addons_url.'"> <img src="'. plugins_url( 'img/notice-images/font-awesome-icon.png', dirname(__FILE__) ). '" alt=""/></a>
                          <a href="'.$addons_url.'"> <img src="'. plugins_url( 'img/notice-images/multiple-sliders.png', dirname(__FILE__) ). '" alt=""/></a>
                    </div>
                    </div>' , 'wpcs');

    printf( '<div data-dismissible="notice-one-forever-wpcs" class="%1$s"><h2 style="font-size: 20px;font-weight: 800;" >%2$s</h2>%3$s</div>', esc_attr( $class ), esc_html( $heading ) ,  $message  );

}


/**
 * @author : Mohammad Mursaleen
 * @usage : save in option to not display it again
 */
function wpcs_dismiss_update_notice(){

    update_option('wpcs_display_notice_2_2','no');

}
add_action('wp_ajax_dismiss_wpcs_notice', 'wpcs_dismiss_update_notice');


/**
 * wpcs_time_to_display_update_notice
 *
 * @return void
 */
function wpcs_time_to_display_update_notice(){

    if(get_transient('wpcs-admin-notice-2-2-hold'))
    return false;


    if ( get_option('wpcs_display_notice_2_2') == 'no' )
    return false;

    return true;

}