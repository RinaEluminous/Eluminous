var ajaxInProcess = false; //global one

function switchTabs(id, buttonId) {
    jQuery(".tab-button").removeClass('active');
    jQuery(".main-menu").removeClass('active-li');
    jQuery(".open").removeClass('active-li');
    jQuery(".tab-box").hide();
    jQuery("#"+buttonId).addClass('active');
    jQuery("#"+buttonId).parent().addClass('active-li');
    document.getElementById(id).style.display = "block";
}

function disabledTab(){
}

/*
 * 
 * Function for Spokal Popup Starts Here
 * 
 */
function sp_remove_popup(id,remove,cta){
    if(remove){
        jQuery('#' + id).fadeOut();
        jQuery('#' + id).remove();
    }else if(cta == "ExitIntent"){
        sp_ei_remove(id);
    }else{
        jQuery('#' + id).fadeOut();
    }
    return false;
}


function sp_continue_popup(id,remove,cta){
    if(remove){
        jQuery('#' + id).fadeOut();
        jQuery('#' + id).remove();
    }else if(cta == "ExitIntent"){
        sp_ei_remove(id);
    }else{
        jQuery('#' + id).fadeOut();
    }
    
    setTimeout(function(){
        jQuery("#" + id).remove();
    },320);
    return false;
}

function deleteSpPopup(id,row){
    jQuery(".sp_style_cta_form_spiner").show();
    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: "delete_spokal_popup",
            id: id
        },
        success: function(data) {
            jQuery(".sp_style_cta_form_spiner").hide();
            if(data.status){
                jQuery("#" + row).remove();
                var popups = jQuery("#spokal_popups_admin_body .sp_popups_list").length;
                if(popups < 1){
                    jQuery("#no-spokal-popups").show();
                }
                
                var pop_select = document.getElementById("exit_intent_popups");
                if(pop_select){
                    var tmp_div = document.createElement('div');
                    tmp_div.innerHTML = data.popup_select;
                    pop_select.parentNode.replaceChild(tmp_div, pop_select);
                }
            }
        }
    });
}

function previewPopup(id){
    jQuery(".sp_style_cta_form_spiner").show();
    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: "preview_spokal_popup",
            id: id
        },
        success: function(data) {
            jQuery(".sp_style_cta_form_spiner").hide();
            if(data.popup){
                jQuery("body").append(data.popup);
                jQuery("#sp_popup_overlay-"+id).show();
            }
        }
    });
}
/*
 * 
 * Function for Spokal Popup Ends Here
 * 
 */


function switchSubTabs(id, buttonId) {
    jQuery(".tab-button").removeClass('active');
    jQuery(".main-menu").removeClass('active-li');
    jQuery(".open").removeClass('active-li');
    jQuery(".tab-box").hide();
    jQuery("#"+buttonId).addClass('active');
    jQuery("#"+buttonId).parent().parent().parent().addClass('active-li');
    document.getElementById(id).style.display = "block";
}

function colapseTabs(id,parent) {
    if(jQuery("#"+parent).hasClass('colapsed')){
        jQuery("#"+parent).removeClass('colapsed');
        jQuery("#"+parent+'-parent').removeClass('main-menu');
        jQuery("#"+parent+'-parent').addClass('open');
        jQuery("#"+id).slideDown(200);
    }else{
        jQuery("#"+id).slideUp(200);
        jQuery("#"+parent).addClass('colapsed');
        jQuery("#"+parent+'-parent').addClass('main-menu');
        jQuery("#"+parent+'-parent').removeClass('open');
//        jQuery("#"+id).slideUp(200);
    }
}

function showExplanation(element){
    var parentDIV = document.createElement("DIV");
    parentDIV.setAttribute("id","scrollbox-placeholder-info");
    
    var textDIV = document.createElement("DIV");   
    var textnode = document.createTextNode("A placeholder is the text that is shown inside the text box. Generally you want to leave the default settings, unless your site is in a language other than English.");         
    textDIV.appendChild(textnode);
    textDIV.setAttribute("class","scrollbox-placeholder-text");
    
    var arrowDIV = document.createElement("DIV");  
    arrowDIV.setAttribute("class","scrollbox-placeholder-arrow");
    
    parentDIV.appendChild(textDIV);
    parentDIV.appendChild(arrowDIV);
    element.parentNode.appendChild(parentDIV);
}

function hideExplanation(element){
    document.getElementById("scrollbox-placeholder-info").remove();
}


//Hovers starts here
jQuery(document).ready(function(){
    jQuery("#sp_social_media_enable").hover(
        function(){jQuery("#sp_enable_social_settings").fadeIn();},
        function(){jQuery("#sp_enable_social_settings").fadeOut();}
    );
    
    jQuery("#sp_social_media_disable_label").hover(
        function(){jQuery("#sp_enable_social_settings").fadeIn();},
        function(){jQuery("#sp_enable_social_settings").fadeOut();}
    );
});
//Hovers ends here

jQuery(document).ready(function(){
    jQuery(".pages-specific").change(function(){
        var value = jQuery(this).val();
        var id = jQuery(this).attr('popup');
        if(value === "page" && jQuery(this).is(':checked')){
            jQuery('#' + id + '-page').removeClass('hide-opt');
            jQuery('#' + id + '-page').addClass('show-opt');
        }else if(value === "page"){
            jQuery('#' + id + '-page').removeClass('show-opt');
            jQuery('#' + id + '-page').addClass('hide-opt');
        }
        
        if(value === "post" && jQuery(this).is(':checked')){
            jQuery('#' + id + '-post').removeClass('hide-opt');
            jQuery('#' + id + '-post').addClass('show-opt');
        }else if(value === "post"){
            jQuery('#' + id + '-post').removeClass('show-opt');
            jQuery('#' + id + '-post').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#smartBarFirstName").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#sb_fn_placeholder_wrap').removeClass('hide-opt');
            jQuery('#sb_fn_placeholder_wrap').addClass('show-opt');
            jQuery(this).parent().css('float','right');
        }else{
            jQuery('#sb_fn_placeholder_wrap').removeClass('show-opt');
            jQuery('#sb_fn_placeholder_wrap').addClass('hide-opt');
            jQuery(this).parent().css('float','left');
        }
    });
});

// ScrollBox dynamic placeholders starts here
jQuery(document).ready(function(){
    jQuery("#scrolBoxFirstName").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#sbx_fn_placeholder_wrap').removeClass('hide-opt');
            jQuery('#sbx_fn_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#sbx_fn_placeholder_wrap').removeClass('show-opt');
            jQuery('#sbx_fn_placeholder_wrap').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#scrolBoxLastName").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#sbx_ln_placeholder_wrap').removeClass('hide-opt');
            jQuery('#sbx_ln_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#sbx_ln_placeholder_wrap').removeClass('show-opt');
            jQuery('#sbx_ln_placeholder_wrap').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#scrolBoxPhone").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#sbx_ph_placeholder_wrap').removeClass('hide-opt');
            jQuery('#sbx_ph_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#sbx_ph_placeholder_wrap').removeClass('show-opt');
            jQuery('#sbx_ph_placeholder_wrap').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#scrolBoxCompany").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#sbx_cp_placeholder_wrap').removeClass('hide-opt');
            jQuery('#sbx_cp_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#sbx_cp_placeholder_wrap').removeClass('show-opt');
            jQuery('#sbx_cp_placeholder_wrap').addClass('hide-opt');
        }
    });
});
// ScrollBox dynamic placeholders ends here

// Exit Intent dynamic placeholders starts here
jQuery(document).ready(function(){
    jQuery("#exitIntentFirstName").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#ei_fn_placeholder_wrap').removeClass('hide-opt');
            jQuery('#ei_fn_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#ei_fn_placeholder_wrap').removeClass('show-opt');
            jQuery('#ei_fn_placeholder_wrap').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#exitIntentLastName").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#ei_ln_placeholder_wrap').removeClass('hide-opt');
            jQuery('#ei_ln_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#ei_ln_placeholder_wrap').removeClass('show-opt');
            jQuery('#ei_ln_placeholder_wrap').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#exitIntentPhone").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#ei_ph_placeholder_wrap').removeClass('hide-opt');
            jQuery('#ei_ph_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#ei_ph_placeholder_wrap').removeClass('show-opt');
            jQuery('#ei_ph_placeholder_wrap').addClass('hide-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#exitIntentCompany").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#ei_cp_placeholder_wrap').removeClass('hide-opt');
            jQuery('#ei_cp_placeholder_wrap').addClass('show-opt');
        }else{
            jQuery('#ei_cp_placeholder_wrap').removeClass('show-opt');
            jQuery('#ei_cp_placeholder_wrap').addClass('hide-opt');
        }
    });
});
// Exit Intent dynamic placeholders ends here


jQuery(document).ready(function(){
    jQuery("#xmlsitemas_user").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#user-sitemap-settings').removeClass('show-opt');
            jQuery('#user-sitemap-settings').addClass('hide-opt');
        }else{
            jQuery('#user-sitemap-settings').removeClass('hide-opt');
            jQuery('#user-sitemap-settings').addClass('show-opt');
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#xmlsitemas_enable").change(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#sp-xmlsitemaps-detail-settings').removeClass('hide-opt');
            jQuery('#sp-xmlsitemaps-detail-settings').addClass('show-opt');
            jQuery('#sp-sitemap-url').removeClass('hide-opt');
        }else{
            jQuery('#sp-xmlsitemaps-detail-settings').removeClass('show-opt');
            jQuery('#sp-xmlsitemaps-detail-settings').addClass('hide-opt');
            jQuery('#sp-sitemap-url').addClass('hide-opt');
            
        }
    });
});

jQuery(document).ready(function(){
    jQuery("#nav-menu-button").click( function(){
//        if(jQuery("#spokal-tabs-wrapper").is(":visible") ){
//            jQuery("#spokal-tabs-wrapper").slideUp(200);
//        }else{
//            jQuery("#spokal-tabs-wrapper").slideDown(200);
//        }
        jQuery('#spokal-tabs-wrapper').toggleClass('tabs-wrapper-hidde');
    });
});

jQuery(document).ready(function($) {
    $('#first-form').submit(function() {
        $(".form-element").removeClass("error-on-submit");
        var status = true; //indicates are we going to invoke ajax or not
        
        var apiKey = document.getElementById("api_key").value;
        
        var submitButtonObject = $('#submit');
        
        if(!isValidApiKey(apiKey)) {
            $("#api_key").addClass("error-on-submit");
            status = false;
        }
        if(status && !ajaxInProcess) {
            document.getElementById("connection_status").innerHTML = "Connecting...";
            ajaxInProcess = true;
            submitButtonObject.attr('disabled','disabled');
            $("#first-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#first-form").serialize(),
                success: function(data) {
                    $("#first-form-spiner").hide();
                    jQuery("#error_message").parent().hide();
                    document.getElementById("error_message").innerHTML = "";
                    if(data.response_type == "Error") {
                        jQuery("#connection_status").parent().addClass("spokal_warning_box");
                        jQuery("#connection_status").parent().removeClass("spokal_success_box");
                        document.getElementById("connection_status").innerHTML = "Not Connected";
                        document.getElementById("connection_button").value = "Connect";
                        jQuery("#error_message").parent().show();
                        document.getElementById("error_message").innerHTML = data.response_message;
                    }
                    else if(data.response_type == "Success") {
                        jQuery("#connection_status").parent().removeClass("spokal_warning_box");
                        jQuery("#connection_status").parent().addClass("spokal_success_box");
                        document.getElementById("connection_status").innerHTML = "Connected";
                        document.getElementById("connection_button").value = "Reconnect";
                    }
                    if((typeof(data.response_warning) == "undfined") && (data.response_warning !== "")){
                        document.getElementById("warning_message").innerHTML = data.response_warning;
                        jQuery("#warning_message").parent().show();
                    }
                    ajaxInProcess = false;
                    submitButtonObject.removeAttr('disabled');
                }
            });
        }
        
        return false; //prevent default submit thing
    }); 
});


/*
 * Yeah.. These function looks same i know.. But, maybe we are going to change it later..
 */
function isValidApiKey(apiKey) {
    var status = true; //assume that is ok (optimist :) )
	
    if(apiKey.length == 0){
        status = false;
    }
    else if(apiKey.length > 100) {
        status = false;
    }

    return status;
}


function isValidPassword(password) {
    var status = true; //assume that is ok (optimist :) )
	
    if(password.length == 0){
        status = false;
    }
    else if(password.length > 100) {
        status = false;
    }

    return status;
}

jQuery(document).ready(function($) {
    $('#sp-main-settings').submit(function() {        
        
        
        
            $("#sp-main-settings-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#sp-main-settings").serialize(),
                success: function(data) {
                    $("#sp-main-settings-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});



jQuery(document).ready(function($) {
    $('#second-form').submit(function() {        
        
        
        
            $("#second-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#second-form").serialize(),
                success: function(data) {
                    $("#second-form-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});



jQuery(document).ready(function($) {
    $('#clear-cache').click(function() {        
        
        
        
            $("#sp_clear_cache-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "sp_clear_cache_action"
                },
                success: function(data) {
                    console.log(data);
                    $("#sp_clear_cache-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


jQuery(document).ready(function($) {
    $('#xml-sitemaps-form').submit(function() {        
        
        
        
            $("#xml-sitemaps-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#xml-sitemaps-form").serialize(),
                success: function(data) {
                    $("#xml-sitemaps-form-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});



jQuery(document).ready(function($) {
    $('#third-form').submit(function() {   
        
            $("#third-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#third-form").serialize(),
                success: function(data) {
                    $("#third-form-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

jQuery(document).ready(function($) {
    $('#tenth-form').submit(function() {   
        
            $("#tenth-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#tenth-form").serialize(),
                success: function(data) {
                    $("#tenth-form-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

jQuery(document).ready(function($) {
    $('#form-tab4').submit(function() {   
        
            $("#form-tab4-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#form-tab4").serialize(),
                success: function(data) {
                    $("#form-tab4-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


jQuery(document).ready(function($) {
    $('#fifth-form').submit(function() {   
        
            $("#fifth-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#fifth-form").serialize(),
                success: function(data) {
                    $("#fifth-form-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


jQuery(document).ready(function($) {
    $('#jetpack-settings-form').submit(function() {   
        
            $("#jetpack-settings-form-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#jetpack-settings-form").serialize(),
                success: function(data) {
                    $("#jetpack-settings-form-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


jQuery(document).ready(function($) {
    $('#htmlGenerateForm').submit(function() {   
            
            $("#htmlGenerateForm-spiner").show();
            jQuery('#appendHtmlForm').html('');
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#htmlGenerateForm").serialize(),
                success: function(data) {
                    $("#htmlGenerateForm-spiner").hide();
                    jQuery('#appendHtmlForm').html(data.form);
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

jQuery(document).ready(function($) {
    $('#generate_3rdPartyHMLForm').submit(function() {   
            
            $("#generate_3rdPartyHMLForm-spiner").show();
            jQuery('#append3rdPartyHtmlForm').html('');
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#generate_3rdPartyHMLForm").serialize(),
                success: function(data) {
                    $("#generate_3rdPartyHMLForm-spiner").hide();
                    jQuery('#append3rdPartyHtmlForm').html(data.form);
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

jQuery(document).ready(function($) {
    $('#netHtmlGenerateForm').submit(function() {   
            
            $("#netHtmlGenerateForm-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#netHtmlGenerateForm").serialize(),
                success: function(data) {
                    jQuery('#netHtmlForm').hide();
                    jQuery('#netSettingsInstruc').hide();
                    jQuery('#netGetFormInstruc').show();
                    jQuery('#extHtmlFormContent').html(data.form);
                    jQuery('#extHtmlFormContent').show();
                    jQuery('#cancelHtmlButton').show();
                    
                    console.log(data.form);
                    $("#netHtmlGenerateForm-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

jQuery(document).ready(function() {
    jQuery('#cancelHtmlForm').click(function(){
        jQuery('#extHtmlFormContent').hide();
        jQuery('#cancelHtmlButton').hide();
        jQuery('#netGetFormInstruc').hide();
        jQuery('#netSettingsInstruc').show();
        jQuery('#netHtmlForm').show();
        
        return false;
    });
    
});


jQuery(document).ready(function($) {
    $('#scrollBoxContentForm').submit(function() {   
            
            $("#scrollBoxContentForm-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#scrollBoxContentForm").serialize(),
                success: function(data) {
                    $("#scrollBoxContentForm-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


// Enable Spokal Scroll Box
jQuery(document).ready(function($) {
    $('#enableScrollBoxForm').submit(function() {   
            jQuery('#enableScrollBox').css('margin-right','0px');
            $("#enableScrollBox-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#enableScrollBoxForm").serialize(),
                success: function(data) {
                    $("#enableScrollBox-spiner").hide();
                    jQuery('#enableScrollBox').hide();
                    jQuery('#disableScrollBox').show();
                    jQuery('#scrollbox-instructions-wrap').addClass('enabled-instructions');
                    jQuery('#scrollBoxSettings').addClass('enabled-settings');
                    jQuery('#scrollBoxSettings').show();
                    jQuery('#ResetInstrucions').show();
                    jQuery('#scrollBoxContentForm').submit();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

// Disable Spokal Scroll Box
jQuery(document).ready(function($) {
    $('#disableScrollBoxForm').submit(function() {   
            jQuery('#disableScrollBox').css('margin-right','0px');
            $("#disableScrollBox-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#disableScrollBoxForm").serialize(),
                success: function(data) {
                    $("#disableScrollBox-spiner").hide();
                    jQuery('#disableScrollBox').hide();
                    jQuery('#clearScrollBoxCookie').hide();
                    jQuery('#scrollBoxSettings').hide();
                    jQuery('#scrollbox-instructions-wrap').removeClass('enabled-instructions');
                    jQuery('#scrollBoxSettings').removeClass('enabled-settings');
                    jQuery('#ResetInstrucions').hide();
                    jQuery('#enableScrollBox').show();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

// SMART BAR

jQuery(document).ready(function($) {
    $('#smartBarContentForm').submit(function() {   
            
            $("#smartBarContentForm-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#smartBarContentForm").serialize(),
                success: function(data) {
                    $("#smartBarContentForm-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


// Enable Spokal Smart Bar
jQuery(document).ready(function($) {
    $('#enableSmartBarForm').submit(function() {   
            jQuery('#enableSmartBar').css('margin-right','0px');
            $("#enableSmartBar-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#enableSmartBarForm").serialize(),
                success: function(data) {
                    $("#enableSmartBar-spiner").hide();
                    jQuery('#enableSmartBar').hide();
                    jQuery('#disableSmartBar').show();
                    jQuery('#smartbar-instructions-wrap').addClass('enabled-instructions');
                    jQuery('#smartBarSettings').addClass('enabled-settings');
                    jQuery('#smartBarSettings').show();
                    jQuery('#ResetInstrucionsSmartBar').show();
                    jQuery('#smartBarContentForm').submit();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

// Disable Spokal Smart Bar
jQuery(document).ready(function($) {
    $('#disableSmartBarForm').submit(function() {   
            jQuery('#disableSmartBar').css('margin-right','0px');
            $("#disableSmartBar-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#disableSmartBarForm").serialize(),
                success: function(data) {
                    $("#disableSmartBar-spiner").hide();
                    jQuery('#disableSmartBar').hide();
                    jQuery('#smartBarSettings').hide();
                    jQuery('#smartbar-instructions-wrap').removeClass('enabled-instructions');
                    jQuery('#smartBarSettings').removeClass('enabled-settings');
                    jQuery('#ResetInstrucionsSmartBar').hide();
                    jQuery('#enableSmartBar').show();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


// END SMART BAR
 
// EXIT INTENT

jQuery(document).ready(function($) {
    $('#exitIntentContentForm').submit(function() {   
            
            $("#exitIntentContentForm-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#exitIntentContentForm").serialize(),
                success: function(data) {
                    $("#exitIntentContentForm-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


// Enable Spokal Exit Intent
jQuery(document).ready(function($) {
    $('#enableExitIntentForm').submit(function() {   
            jQuery('#enableExitIntent').css('margin-right','0px');
            $("#enableExitIntent-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#enableExitIntentForm").serialize(),
                success: function(data) {
                    $("#enableExitIntent-spiner").hide();
                    jQuery('#enableExitIntent').hide();
                    jQuery('#disableExitIntent').show();
                    jQuery('#exitintent-instructions-wrap').addClass('enabled-instructions');
                    jQuery('#exitIntentSettings').addClass('enabled-settings');
                    jQuery('#exitIntentSettings').show();
                    jQuery('#exitIntentContentForm').submit();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

// Disable Spokal Exit Intent
jQuery(document).ready(function($) {
    $('#disableExitIntentForm').submit(function() {   
            jQuery('#disableExitIntent').css('margin-right','0px');
            $("#disableExitIntent-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#disableExitIntentForm").serialize(),
                success: function(data) {
                    $("#disableExitIntent-spiner").hide();
                    jQuery('#disableExitIntent').hide();
                    jQuery('#exitIntentSettings').hide();
                    jQuery('#exitintent-instructions-wrap').removeClass('enabled-instructions');
                    jQuery('#exitIntentSettings').removeClass('enabled-settings');
                    jQuery('#enableExitIntent').show();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

// END EXIT INTENT

// SPOKAL CUSTOM WP UPLOADER

jQuery(document).ready(function ($) {
	var spokal_custom_uploader;
	$('.sp_image_upload_button').click(function (e) {
		sp_target_id = $(this).attr('id').replace(/_button$/,'');
		e.preventDefault();
		if (spokal_custom_uploader) {
			spokal_custom_uploader.open();
			return;
		}
                
		spokal_custom_uploader = wp.media.frames.file_frame = wp.media({
			title   : "Use Image",
			button  : { text: "Use Image" },
			multiple: false
		});
		spokal_custom_uploader.on('select', function () {
			var attachment = spokal_custom_uploader.state().get('selection').first().toJSON();
			$('#'+ sp_target_id).val(attachment.url);
		});
		spokal_custom_uploader.open();
	});
});

// END SPOKAL CUSTOM WP UPLOADER

// Delete sp_lists cookie
jQuery(document).ready(function($) {
    $('#clearLeadListCookieForm').submit(function() {
            document.cookie = "sp_scbx_shown=; Path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "sp_smbr_shown=; Path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            document.cookie = "sp_ei_shown=; Path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            $("#clearLeadListCookieForm-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#clearLeadListCookieForm").serialize(),
                success: function(data) {
                    $("#clearLeadListCookieForm-spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});


jQuery(document).ready(function($) {
    $(document).on('submit','.sp_style_cta_form',function() {        
            $(".sp_style_cta_form_spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery(this).serialize(),
                success: function(data) {
                    jQuery("#"+data.appender).append(data.html);
                    if(data.height){
                        jQuery("#"+data.appender).css("min-height",data.height);
                    }
                    $(".sp_style_cta_form_spiner").hide();
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

/*
 * This function will display additional text of requirement within Status tab
 */
function showAdditionalRequirement(id) {
    var additionalTextObject = jQuery("#"+id);
    if(!additionalTextObject.is(':visible')) {
        additionalTextObject.slideDown();
    }
    else {
        additionalTextObject.slideUp();
    }
    
}


/*
 * This is ajax call for setings error log
 */
jQuery(document).ready(function($) {
    $('#form_error_log').submit(function() {   
        
            $("#form-error-log-spiner").show();
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: jQuery("#form_error_log").serialize(),
                success: function(data) {
                    $("#form-error-log-spiner").hide();
                    
                    if(data.status){
                        $(".spokal-error-box .error-renderer").html(data.message);
                    }else{
                        $(".failed_error_log").html(data.message);
                    }    
                }
            });
        
        return false; //prevent default submit thing
    }); 
});

jQuery(document).ready(function($) {
    jQuery("#error_log").click(function(){
        jQuery("#error_logging_overlay").show();
        return false;
    });
});

jQuery(document).ready(function($) {
    jQuery("#cancel_logging").click(function(){
        jQuery("#error_logging_overlay").hide();
        return false;
    });
});

jQuery(document).ready(function($) {
    jQuery("#confirm_logging").click(function(){
        jQuery("#error_logging_overlay").hide();
        jQuery("#form_error_log").submit();
        return false;
    });
});

// Handling password length on connection with spokal
jQuery(document).ready(function() {
    jQuery('input#user_password').keyup(function() {
        var _this = jQuery(this);
        
        if(_this.val().length > 30){
            jQuery('#user_password_error').show();
        }else{
            jQuery('#user_password_error').hide();
        }
       
    });
    
    jQuery('input#user_password').on('paste', function () {
        var _this = jQuery(this);
        setTimeout(function () {
            if(_this.val().length > 30){
                jQuery('#user_password_error').show();
            }else{
                jQuery('#user_password_error').hide();
            }
        }, 100);
    });
      
});



