/*********************************************************
 * Javascript Global Functions for WP editor
 *********************************************************/
function set_seo_hidden_description(post_content){
    var description = sp_seo.Analysis.getText(post_content);
    description = description.substring(0, Math.min(description.length - 1, 200));
    jQuery("#sp_fake_meta_description").val(description);
}
/*********************************************************
 * Javascript Global Functions for WP editor ends here
 *********************************************************/

/*********************************************************
 * Javascript Functions for Tweeter starts here
 *********************************************************/
sp_utilities = (function () {
    var sp_utilities;
// ReSharper disable DuplicatingLocalDeclaration
    (function(sp_utilities) {
// ReSharper restore DuplicatingLocalDeclaration
        var textProcessor = (function() {
            var urlPattern = /((http|ftp|https):\/\/)?[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/gmi,
                protocolPattern = /(http|ftp|https):\/\/.*/gmi;
            function TextProcessor(text) {
                this.text = text;
            }

            Object.defineProperty(TextProcessor.prototype, "links", {
                get: function () {
                    var matchedUrls = this.text.match(urlPattern),
                    hasLink = matchedUrls && matchedUrls.length > 0;

                    if (hasLink) {
                        return matchedUrls;
                    } else {
                        return null;
                    }
                },
                enumerable: true,
                configurable: true
            });

            Object.defineProperty(TextProcessor.prototype, "hasLinks", {
                get: function () {
                    var matchedUrls = this.text.match(urlPattern);
                    return !!(matchedUrls && matchedUrls.length > 0);
                },
                enumerable: true,
                configurable: true
            });

            Object.defineProperty(TextProcessor.prototype, "hasProtocol", {
                get: function () {
                    var matchedProtocols = this.text.match(protocolPattern);
                    return !!(matchedProtocols && matchedProtocols.length > 0);
                },
                enumerable: true,
                configurable: true
            });
            return TextProcessor;
        })();
        sp_utilities.TextProcessor = textProcessor;
    })(sp_utilities || (sp_utilities = {}));

    return sp_utilities;
})();
sp_constants = (function() {
    var sp_constants;
    (function() {
    	sp_constants.MaxTweetLength = 140;
        sp_constants.TweetLinkLength = 23;
        sp_constants.TweetImageLinkLength = 23;
        sp_constants.LinkToArticle = "[link to article]";
    })(sp_constants || (sp_constants = {}));
    return sp_constants;
})();
function spCheckTwitterCharacterCountString(inputString, output, saveButton, hasLink, hasImage) {
    var left = spTwitterCharactersLeft(inputString, hasLink);
    if (hasImage != undefined && hasImage == true) {
        left = left - sp_constants.TweetImageLinkLength;
    }
    jQuery(output).text(left);
    console.log(left);
    if (left < 0) {
        jQuery(saveButton).addClass("disabled");
        jQuery(output).css("background-color","#d15b47!important");
    }else if(left == 0){
        jQuery(output).css("background-color","#abbac3!important");
        jQuery(saveButton).removeClass("disabled");
    } 
    else {
        jQuery(output).css("background-color","#82af6f!important");
        jQuery(saveButton).removeClass("disabled");
    }
}
function spTwitterCharactersLeft(text, hasLink) {
    var tp = new sp_utilities.TextProcessor(text),
    left = sp_constants.MaxTweetLength;
    if (tp.hasLinks) {
        var i = 0, links = tp.links;
        left -= sp_constants.TweetLinkLength * tp.links.length;
        for (; i < links.length; i++) {
            left += links[i].length;
            if (links[i].startsWith("https://")) {
                left -= 1;
            }
        }
    } else {
        if (hasLink != undefined && hasLink == true) {
            left -= sp_constants.TweetLinkLength;
        }
    }
    
    //handle [link to article]
    if (text.indexOf(sp_constants.LinkToArticle) > -1) {
        left -= sp_constants.TweetLinkLength - sp_constants.LinkToArticle.length;
    }

    left -= text.length;
    
    return left;
}
/*********************************************************
 * Javascript Functions for Tweeter ends here
 *********************************************************/


/*********************************************************
 * Javascript For Spokal SEO starts here
 *********************************************************/
function show_social_modal(){
    jQuery("#sp_social_button").click();
    return false;
}
jQuery(document).ready(function($){
//    if(typeof(spKeywords) != "undefined"){
        sp_seo.Analysis.run($);
        
        $("#title").keyup(function(){sp_seo.Analysis.run($);});
        $("#title").change(function(){sp_seo.Analysis.run($);});
        $("#title").on('paste',function(){sp_seo.Analysis.run($);});
        $("#content").keyup(function(){sp_seo.Analysis.run($);});
        $("#content").change(function(){sp_seo.Analysis.run($);});
        $("#content").blur(function(){sp_seo.Analysis.run($);});
        $("#content").focus(function(){sp_seo.Analysis.run($);});
        $("#content").on('paste',function(){sp_seo.Analysis.run($);});
        $("#spokal_keywords").keyup(function(){sp_seo.Analysis.run($);});
        $("#spokal_keywords").change(function(){sp_seo.Analysis.run($);});
        $("#sp-social-save").click(function(){sp_seo.Analysis.run($);});
        
        if(
            (typeof(tinymce) != "undefined") && 
            (typeof(tinymce.majorVersion) != "undefined") &&
            (typeof(tinyMCE) != "undefined")
        )
        {
            if(parseInt(tinymce.majorVersion) < 4){
                tinyMCE.onAddEditor.add(function(mgr,ed) {
                    ed.onKeyUp.add(function(ed, e) {
                        sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                        set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                    ed.onPaste.add(function(ed, e) {
                        sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                        set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                    ed.onChange.add(function(ed, e) {
                        sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                        set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                });
            }else{
                tinyMCE.on("AddEditor",function(e){
                    var  ed = e.editor;
                    ed.on('keyup', function(e) {
                            sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                            set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                    ed.on('paste', function(e) {
                            sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                            set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                    ed.on('change', function(e) {
                            sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                            set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                    ed.on('NodeChange', function(e) {
                            sp_seo.Analysis.runVisual($,ed.getContent({format : 'raw'}));
                            set_seo_hidden_description(ed.getContent({format : 'raw'}));
                    });
                });
            }
        }
//    }
});
/*********************************************************
 * Javascript For Spokal SEO ends here
 *********************************************************/


/*********************************************************
 * Javascript For Spokal A/B test title starts here
 *********************************************************/
jQuery(document).ready(function() {
        jQuery("#sp-sec-title-show").click(function(){
            jQuery(this).hide();
            jQuery("#sp-sec-title-hide").show();
            jQuery("#spokal-secondary-title-input").show();
            return false;
        });
        
        jQuery("#sp-sec-title-test-show").click(function(){
            jQuery(this).hide();
            jQuery("#sp-sec-title-hide").show();
            jQuery("#spokal-secondary-title-input").show();
            return false;
        });
        
        jQuery("#sp-sec-title-hide").click(function(){
            var sec_title = jQuery("#spokal-secondary-title-input").val();
            jQuery(this).hide();
            jQuery("#spokal-secondary-title-input").hide();
            if(sec_title != ""){
                jQuery("#sp-sec-title-test-show").show();
            }else{
                jQuery("#sp-sec-title-show").show();
            }
            return false;
        });
        
        
        var ab_title_wrap = document.getElementById("sp_ab_title_wrap");
        var ab_title_input = document.getElementById("spokal-secondary-title-input");
        if(ab_title_wrap && ab_title_input){
            var spSelectorTitleWrapp = jQuery("#sp_ab_title_wrap");
            var spSelectorTitleInput = jQuery("#spokal-secondary-title-input");
            spSelectorTitleWrapp.insertAfter("#post-body #title").removeAttr("hidden");
            spSelectorTitleInput.insertAfter("#sp_ab_title_wrap");
            jQuery("#post-body #title").css({width: "90%"});
        }
});
/*********************************************************
 * Javascript For Spokal A/B test title ends here
 *********************************************************/


/*********************************************************
 * Javascript For Spokal Draft Share in wp editor starts here
 *********************************************************/

jQuery(document).ready(function(){
    jQuery("#sp_draft_preview").hover(
        function(){jQuery("#sp_preview_pop_messag").show();},
        function(){jQuery("#sp_preview_pop_messag").hide();}
    );
});
/*********************************************************
 * Javascript For Spokal Draft Share in wp editor ends here
 *********************************************************/



/*********************************************************
 * Javascript For Spokal Keywords in wp editor starts here
 *********************************************************/
jQuery(document).ready(function($) {
    if(typeof(spKeywords) != "undefined"){
        jQuery( "#spokal_keywords" ).autocomplete({
            source: spKeywords,
            appendTo: "#sp-keywords-wrapp",
            select: function(event, ui) {
                setTimeout(function(){ sp_seo.Analysis.run($);}, 100);
            },
            response:function(event, ui) {
                if (ui.content.length === 0) {
                    $("#sp-no-keyword-error").text("Please choose a keyword you've added to Spokal.");
                } else {
                    $("#sp-no-keyword-error").empty();
                }
            }
        });
    }
    
    /*
     * Removing typed content on blur if doesn't exist in keywords array
     */
    jQuery("#spokal_keywords").blur(function(){
        jQuery("#sp-no-keyword-error").empty();
        if(jQuery.inArray(this.value,spKeywords) == -1){
            this.value = "";
        }
    });
    
    jQuery("#spokal_keywords").keyup(function(){
        if(this.value == ""){
            jQuery("#sp-no-keyword-error").empty();
        }
    });
});
/*********************************************************
 * Javascript For Spokal Keywords in wp editor ends here
 *********************************************************/


/********************************************************
 * Javascript For Spokal Focuses in wp editor starts here
 ********************************************************/
jQuery(document).ready(function() {
    /*
     * Javacript for Focuses autocomplete
     */
    if(typeof(spFocus) != "undefined"){
        jQuery( "#spokal_focuses" ).autocomplete({
            source: spFocus,
            minLength: 0,
            appendTo: "#spokal_focus_wrap",
            open: function() {
                var top = jQuery("#spokal_focus_wrap").height() + 16;
                var width = jQuery("#spokal_focus_wrap").width() + 16;
                jQuery("#spokal_focus_wrap > ul").css({left: 0 + "px", top: top + "px"});
                jQuery("#spokal_focus_wrap > ul").css({width: width + 2 + "px"});

                var element = document.getElementById("spokal_focus_wrap");
                var old_f = element.getElementsByTagName("DIV");
                if(old_f.length == 2){
                    jQuery("#spokal_focus_wrap > ul").css({display: "none"});
                    jQuery(this).val("");
                }
            },
            select: function(event, ui) {
                var div = document.createElement("div");
                div.innerHTML = ui.item.value;
                div.setAttribute("tabindex", "0");
                div.setAttribute("class", "sp_focus_tag");
                jQuery(div).insertBefore(this);

                var element = document.getElementById("spokal_focus_wrap");
                var old_f = element.getElementsByTagName("DIV");
                if(old_f.length){
                    this.setAttribute("placeholder", "");
                    jQuery(this).css({width: 4 + "px"});
                    jQuery(this).focus();
                }

                var ln = old_f.length;
                var f_hidden = jQuery("#spokal_focuses_hidden").val();
                if(f_hidden == ""){
                    jQuery("#spokal_focuses_hidden").val(ui.item.value + ",")
                }else if(jQuery(this.nextSibling).hasClass("sp_focus_tag")){
                    jQuery("#spokal_focuses_hidden").val(ui.item.value + "," + f_hidden)
                }else{
                    jQuery("#spokal_focuses_hidden").val(f_hidden + ui.item.value + ",")
                }


                var index = jQuery.inArray(ui.item.value, spFocus);
                spFocus.splice(index, 1);
            },
            close: function(){
                jQuery(this).val("");
                jQuery(this).blur();
            },
            change: function(event, ui) {
                jQuery("#spokal_focuses").val("");
            }
        });
    }
    
    /*
     * Function for getting focused element
     */
    function spGetFocussedElement() {
        var el;
        if ((el = document.activeElement) && el != document.body)
            return el;
        else
            return null;
    }
    
    /*
     * Function for resetting focus autocomplete array
     */
    function spResetAutocomplete(element, index, array) {
        spFocus.splice(index, 1,element);
    }
    
    /*
     * Focus to focuses input when wrap div is clicked
     */
    jQuery("#spokal_focus_wrap").click(function(){
        var el = spGetFocussedElement();
           if(el && jQuery(el).hasClass("sp_focus_tag")){
               jQuery(el).focus();
           }else{
               jQuery("#spokal_focuses").focus();
           }
    });
    
    /*
     * Removing Focus tag when backspase is pressed
     */
    jQuery("#spokal_focuses").keydown(function(e) {
        if(e.which == 8){
            if(this.value == ""){
                var element = document.getElementById("spokal_focus_wrap");
                var childs = element.getElementsByTagName("DIV");
                var ln = childs.length;
                if(ln){
                    var f_hidden = jQuery("#spokal_focuses_hidden").val();
                    if(f_hidden == ""){
                    }else{
                        f_hidden = f_hidden.replace(childs[ln -1].innerHTML+",",'');
                        jQuery("#spokal_focuses_hidden").val(f_hidden)
                    }
                    spFocusBackup.forEach(spResetAutocomplete);
                    jQuery(childs[ln -1]).remove();
                    ln = childs.length;
                    if(ln == 1){
                        var index = jQuery.inArray(childs[0].innerHTML, spFocus);
                        spFocus.splice(index, 1);
                    }else if(ln == 0){
                        jQuery("#spokal_focuses").attr("placeholder","Choose...");
                        jQuery("#spokal_focuses").css("width","65px");
                    }
                    jQuery("#spokal_focuses").focus();
                }
            }
        }
    });
    
    /*
     * Removing Focus tag when delete is pressed
     */
    jQuery(document).keydown(function(e) {
        if(e.which == 46){
            var el = spGetFocussedElement();
           if(el && jQuery(el).hasClass("sp_focus_tag")){
                var f_hidden = jQuery("#spokal_focuses_hidden").val();
                if(f_hidden == ""){
                }else{
                    f_hidden = f_hidden.replace(el.innerHTML+",",'');
                    jQuery("#spokal_focuses_hidden").val(f_hidden)
                }

                var element = document.getElementById("spokal_focus_wrap");
                var childs = element.getElementsByTagName("DIV");
                if((childs.length == 2) && (el == childs[0])){
                    jQuery("#spokal_focuses").insertBefore(childs[0]);
                }
                spFocusBackup.forEach(spResetAutocomplete);
                jQuery(el).remove();

                ln = childs.length;
                if(ln == 1){
                    var index = jQuery.inArray(childs[0].innerHTML, spFocus);
                    spFocus.splice(index, 1);
                }else if(ln == 0){
                    jQuery("#spokal_focuses").attr("placeholder","Choose...");
                    jQuery("#spokal_focuses").css("width","65px");
                }
                jQuery("#spokal_focuses").focus();
           }else if(jQuery(el).hasClass("spokal_focuses_input") && jQuery(el.nextSibling).hasClass("sp_focus_tag")){
                var f_hidden = jQuery("#spokal_focuses_hidden").val();
                if(f_hidden == ""){
                }else{
                    f_hidden = f_hidden.replace(el.nextSibling.innerHTML+",",'');
                    jQuery("#spokal_focuses_hidden").val(f_hidden)
                }
                var element = document.getElementById("spokal_focus_wrap");
                var childs = element.getElementsByTagName("DIV");
                spFocusBackup.forEach(spResetAutocomplete);
                jQuery(el.nextSibling).remove();

                ln = childs.length;
                if(ln == 1){
                    var index = jQuery.inArray(childs[0].innerHTML, spFocus);
                    spFocus.splice(index, 1);
                }else if(ln == 0){
                    jQuery("#spokal_focuses").attr("placeholder","Choose...");
                    jQuery("#spokal_focuses").css("width","65px");
                }
                jQuery("#spokal_focuses").focus();
           }
        }
    });
    
    /*
     * Removing typed content on blur if doesn't exist in focus array
     */
    jQuery("#spokal_focuses").blur(function(){
        if(jQuery.inArray(this.value,spFocus) == -1){
            this.value = "";
            if(jQuery(this.nextSibling).hasClass("sp_focus_tag")){
                jQuery(this).insertAfter(this.nextSibling);
            }
        }
    });
});
/********************************************************
 * Javascript For Spokal Focuses in wp editor ends here
 ********************************************************/


/********************************************************
 * Javascript For Spokal Modal in wp editor starts here
 ********************************************************/
var is_modal_changed = false;
var sp_twt_old;
var sp_twt_alt_old;

function sp_is_hidden(el) {
    var style = window.getComputedStyle(el);
    return (style.display === 'none')
}

function sp_show_twt_link_info()
{
    var twt = jQuery("#sp_twt_desc").val();
    if(twt.indexOf(sp_constants.LinkToArticle) > -1){
        jQuery("#sp-twt-link-info").show();
    }
//    else
//    {
//        var alt_wrap = document.getElementById("twitter_title_b_wrapp");
//        if(!sp_is_hidden(alt_wrap)){
//            var twt = jQuery("#sp_twt_alt_title").val();
//            if(twt.indexOf(sp_constants.LinkToArticle) > -1){
//                jQuery("#sp-twt-link-info").show();
//            }
//        }
//    }
}

function sp_disable_soc_account(account)
{
    var disabled = account.getAttribute("sp-account-disabled");  
    var soc_ID = account.getAttribute("sp-soc-id");
    
    var dis_input = document.getElementById("sp_disabled_soc_accounts").value;
    var enab_input = document.getElementById("sp_enabled_soc_accounts").value;
    if(dis_input != ""){
        var dis_array = dis_input.split(",");
    }
    else{
        var dis_array = new Array();
    }
    
    if(enab_input != ""){
        var en_array = enab_input.split(",");
    }
    else{
        var en_array = new Array();
    }
    var was_dis = jQuery.inArray( soc_ID, dis_array );
    var was_enab = jQuery.inArray( soc_ID, en_array );
    
    if(disabled == "true"){
        if(was_dis > -1){
            dis_array.splice(was_dis, 1);
            en_array.push(soc_ID);
        }
        account.setAttribute("sp-account-disabled","false");
    }
    else{
        if(was_dis == -1){
            dis_array.push(soc_ID);
        }
        
        if(was_enab > -1){
            en_array.splice(was_enab, 1);
        }
        account.setAttribute("sp-account-disabled","true");
    }
//    var type = account.getAttribute("sp-soc-type");  
//    if(type == "2"){
//        var all_twts = document.getElementById("sp_social_accounts").querySelectorAll('[sp-soc-type="2"][sp-account-disabled="false"]');
//        
//        if(all_twts.length > 0)
//        {
//            jQuery("#sp_twt_modal").show();
//        }
//        else{
//            jQuery("#sp_twt_modal").hide();
//        }
//    }
    
    
    document.getElementById("sp_disabled_soc_accounts").value = dis_array.join();
    document.getElementById("sp_enabled_soc_accounts").value = en_array.join();
}


function sp_set_recurring(_this)
{
    if(jQuery(_this).hasClass("sp_recurring_enabled"))
    {
        jQuery("#sp_recurring_inner").html("This post is not in or will be removed from your recurring queue.");
        jQuery("#sp_is_recurring_message").css("top","-53px");
        jQuery(_this).removeClass("sp_recurring_enabled");
        jQuery(_this).addClass("sp_recurring_disabled");
        jQuery("#sp_recurring_value").val("false");
    }
    else
    {
        jQuery("#sp_is_recurring_message").css("top","-73px");
        jQuery("#sp_recurring_inner").html("This post is in or will be added to your recurring queue. It will assume the same focus as the post (if any)");
        jQuery(_this).removeClass("sp_recurring_disabled");
        jQuery(_this).addClass("sp_recurring_enabled");
        jQuery("#sp_recurring_value").val("true");
    }
}

jQuery(document).ready(function ($) {
    var spokal_tweeter_uploader;
    var spokal_facebook_uploader;
    
    function sp_tweeter_upload(link,img_input,img){
        if (spokal_tweeter_uploader) {
                spokal_tweeter_uploader.open();
                return;
        }
        spokal_tweeter_uploader = wp.media.frames.file_frame = wp.media({
                title   : "Use Image",
                button  : { text: "Use Image" },
                multiple: false
        });
        spokal_tweeter_uploader.on('select', function () {
                var attachment = spokal_tweeter_uploader.state().get('selection').first().toJSON();
                if(link != ""){jQuery(link).hide();}
                jQuery(img_input).val(attachment.url);
                jQuery(img).attr("src",attachment.url);
                jQuery(img).show();
                $('#sp_twt_img_remove').show();
                sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_desc'), jQuery('#sp_tweetCharacterCount'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
//                sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_alt_title'), jQuery('#sp_tweetCharacterCountB'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
        });
        spokal_tweeter_uploader.open();
    }
    
    function sp_facebook_upload(link,img_input,img){
        if (spokal_facebook_uploader) {
                spokal_facebook_uploader.open();
                return;
        }
        spokal_facebook_uploader = wp.media.frames.file_frame = wp.media({
                title   : "Use Image",
                button  : { text: "Use Image" },
                multiple: false
        });
        spokal_facebook_uploader.on('select', function () {
                var attachment = spokal_facebook_uploader.state().get('selection').first().toJSON();
                if(link != ""){jQuery(link).hide();}
                jQuery(img_input).val(attachment.url);
                jQuery(img).attr("src",attachment.url);
                jQuery(img).show();
                $('#sp_fb_img_remove').show();
        });
        spokal_facebook_uploader.open();
    }
    
    $('#sp_twt_img_set').click(function (e) {
            e.preventDefault();
            sp_tweeter_upload("#sp_twt_img_set","#sp_twt_img_input","#sp_twt_img_elem");
//            $('#sp_twt_img_remove').show();
    });
    
    $('#sp_twt_img_remove').click(function (e) {
            e.preventDefault();
            jQuery("#sp_twt_img_input").val("");
            jQuery("#sp_twt_img_elem").attr("src","");
            jQuery("#sp_twt_img_elem").hide();
            jQuery(this).hide();
            jQuery('#sp_twt_img_set').show();
            sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_desc'), jQuery('#sp_tweetCharacterCount'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
//            sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_alt_title'), jQuery('#sp_tweetCharacterCountB'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
    });
    
    $('#sp_twt_img_elem').click(function (e) {
            e.preventDefault();
            sp_tweeter_upload("","#sp_twt_img_input","#sp_twt_img_elem");
//            $('#sp_twt_img_remove').show();
    });
    
    $('#sp_fb_img_set').click(function (e) {
            e.preventDefault();
            sp_facebook_upload("#sp_fb_img_set","#sp_fb_img_input","#sp_fb_img_elem");
//            $('#sp_fb_img_remove').show();
    });
    
    $('#sp_fb_img_remove').click(function (e) {
            e.preventDefault();
            jQuery("#sp_fb_img_input").val("");
            jQuery("#sp_fb_img_elem").attr("src","");
            jQuery("#sp_fb_img_elem").hide();
            jQuery(this).hide();
            jQuery('#sp_fb_img_set').show();
    });
    
    $('#sp_fb_img_elem').click(function (e) {
            e.preventDefault();
            sp_facebook_upload("","#sp_fb_img_input","#sp_fb_img_elem");
//            $('#sp_fb_img_remove').show();
    });


    jQuery("#close_sp_soc_modal").click(function(){
        jQuery("#sp_social_modal").hide();
        return false;
    });
        
    jQuery("#sp_social_button").click(function(){
        try {
            sp_populate_social_modal();
            sp_show_twt_link_info();
            sp_textarea_height(document.getElementById('sp_fb_desc'));
            sp_textarea_height(document.getElementById('sp_fb_post_desc'));
            sp_textarea_height(document.getElementById('sp_meta_desc'));
            sp_textarea_height(document.getElementById('sp_twt_desc'));
//            sp_textarea_height(document.getElementById('sp_twt_alt_title'));
            sp_twt_old = jQuery("#sp_twt_desc").val();
            sp_twt_alt_old = jQuery("#sp_twt_desc").val();
        }catch(err) {
        }
        jQuery("#sp_social_blank").show();
        jQuery("#sp_social_modal").show();
        return false;
    });
    
    //Js for setting hidden metadescription in social modal. To be used if user didn't set it by it self
    var sp_descript = jQuery("#wp-content-editor-container #content").val();
    set_seo_hidden_description(sp_descript);
    $("#content").keyup(function(){set_seo_hidden_description(this.value);});
    $("#content").change(function(){set_seo_hidden_description(this.value);});
    $("#content").blur(function(){set_seo_hidden_description(this.value);});
    $("#content").focus(function(){set_seo_hidden_description(this.value);});
    $("#content").on('paste',function(){set_seo_hidden_description(this.value);});
    
    function sp_populate_social_modal(){
//        var al_title = jQuery("#spokal-secondary-title-input").val();
//        if(al_title){
//            jQuery("#twitter_title_b_wrapp").show();
//            jQuery("#sp_tweetCharacterCountB").show();
//            jQuery("#tw_span_sitle_a").show();
//        }else{
//            jQuery("#twitter_title_b_wrapp").hide();
//            jQuery("#sp_tweetCharacterCountB").hide();
//            jQuery("#tw_span_sitle_a").hide();
//        }
//        
        // Automatically rendering description
        var description = jQuery("#wp-content-editor-container #content").val();
        var description = sp_seo.Analysis.getText(description);
        description = description.substring(0, Math.min(description.length, 200));
        if((!sp_fb_desc_set)){
            jQuery("#sp_fb_desc").val(description); 
        }
        
        if((!sp_meta_desc_set)){
            jQuery("#sp_meta_desc").val(description);
        }
        
        //check Metadecsription length
        var cn = 160 - jQuery("#sp_meta_desc").val().length;
        if(cn < 0){
            jQuery("#sp_metaCharacterCount").css("color","rgb(248, 148, 6)");
        }else{
            jQuery("#sp_metaCharacterCount").css("color","rgb(0, 0, 0)");
        }
        jQuery("#sp_metaCharacterCount").html(cn);
        
        var post_title = jQuery("#titlewrap #title").val();
        // Automatically rendering title
        if((!is_modal_changed) && (!sp_fb_title_set)){
            jQuery("#sp_fb_title").val(post_title);
        }
        
        
        // Regenerate Titles
        if((!sp_twt_title_set)){
            jQuery("#sp_twt_desc").val(post_title + " [link to article] ");
        }
        
        jQuery("#sp_meta_desc_title").html(post_title);
        
        // Regenerate alternative twitter
//        if((!sp_twt_alt_title_set)){
//            var post_title = jQuery("#spokal-secondary-title-input").val();
//            jQuery("#sp_twt_alt_title").val(post_title + " [link to article] ");
//        }
        
        
        sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_desc'), jQuery('#sp_tweetCharacterCount'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
//        sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_alt_title'), jQuery('#sp_tweetCharacterCountB'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
    }

    jQuery("#sp_google_icon").hover(
        function(){jQuery("#sp_google_message").show();},
        function(){jQuery("#sp_google_message").hide();}
    );
    
    jQuery(".sp-social-account").hover(
        function(){
            var popup = document.getElementById("sp-acc-popup-msg");
            
            var left = jQuery(this).position().left;
            var title = this.getAttribute("sp-soc-title");
            document.getElementById("sp-acc-inner-msg").innerHTML = title;
            
            popup.style.display = "block";
            popup.style.left = left + "px"; 
            popup.style.marginLeft = -(popup.offsetWidth/2) + 25 + "px";
        },
        function(){
            var title = this.getAttribute("sp-soc-title");
            document.getElementById("sp-acc-inner-msg").innerHTML = "";
            document.getElementById("sp-acc-popup-msg").style.display = "none";
        }
    );
    
    
    jQuery("#sp_enable_recurring").hover(
            function(){jQuery("#sp_is_recurring_message").show();},
            function(){jQuery("#sp_is_recurring_message").hide();}
    );
    
    jQuery("#sp_twt_img_elem").hover(
        function(){jQuery("#sp_social_twt_img_messag").show();},
        function(){jQuery("#sp_social_twt_img_messag").hide();}
    );
    
    jQuery("#sp_fb_img_elem").hover(
        function(){jQuery("#sp_social_fb_img_messag").show();},
        function(){jQuery("#sp_social_fb_img_messag").hide();}
    );

    jQuery("#sp_social_button").hover(
        function(){jQuery("#sp_social_pop_messag").show();},
        function(){jQuery("#sp_social_pop_messag").hide();}
    );
    
    jQuery("#sp_soc_reset").hover(
        function(){jQuery("#sp_social_recover_messag").show();},
        function(){jQuery("#sp_social_recover_messag").hide();}
    );

    jQuery("#sp-social-save").click(function(){
        if(jQuery(this).hasClass("disabled")){
            return false;
        }
        is_modal_changed = true;
        jQuery("#sp_social_modal").hide();
        jQuery("#sp_social_blank").hide();
        return false;
    });

    jQuery("#title").keyup(function(){
        var txt = this.value;
        jQuery("#sp_meta_desc_title").html(txt);
    });
     
    //Don't Allow to overwrite [link to article]
    jQuery("#sp_twt_desc").keyup(function(){
        var newValue = this.value;
        if(
            sp_twt_old.indexOf(sp_constants.LinkToArticle) > -1 && 
            newValue.indexOf(sp_constants.LinkToArticle) == -1
            ){
            jQuery("#sp_twt_desc").val(sp_twt_old);
        }
        else{
            sp_twt_old = newValue;
        }
    });
    
//    jQuery("#sp_twt_alt_title").keyup(function(){
//        var newValue = this.value;
//        if(
//            sp_twt_alt_old.indexOf(sp_constants.LinkToArticle) > -1 && 
//            newValue.indexOf(sp_constants.LinkToArticle) == -1
//            ){
//            jQuery("#sp_twt_alt_title").val(sp_twt_alt_old);
//        }
//        else{
//            sp_twt_alt_old = newValue;
//        }
//    });
    
    jQuery("#sp_fb_title").keyup(function(){
         sp_fb_title_set = true;
    });

    jQuery("#sp_fb_desc").keyup(function(){
        sp_fb_desc_set = true;
        sp_meta_desc_set = true;
    });

    jQuery("#sp_twt_desc").keyup(function(){
        sp_twt_title_set = true;
        sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_desc'), jQuery('#sp_tweetCharacterCount'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
    });
    
//    jQuery("#sp_twt_alt_title").keyup(function(){
//        sp_twt_alt_title_set = true;
//        sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_alt_title'), jQuery('#sp_tweetCharacterCountB'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
//    });
    
    jQuery("#sp_meta_desc").keyup(function(){
        sp_meta_desc_set = true;
        sp_fb_desc_set = true;
        var cn = 160 - this.value.length;
        if(cn < 0){
            jQuery("#sp_metaCharacterCount").css("color","rgb(248, 148, 6)");
        }else{
            jQuery("#sp_metaCharacterCount").css("color","rgb(0, 0, 0)");
        }
        jQuery("#sp_metaCharacterCount").html(cn);
    });

    jQuery("#sp_soc_reset").click(function(){
        
        // Regenerate images images
        jQuery("#sp_twt_img_elem").attr("src","");
        jQuery("#sp_twt_img_elem").hide();
        jQuery("#sp_twt_img_set").show();
        jQuery("#sp_twt_img_remove").hide();
        jQuery("#sp_twt_img_input").val("");
        
        jQuery("#sp_fb_img_elem").attr("src","");
        jQuery("#sp_fb_img_elem").hide();
        jQuery("#sp_fb_img_set").show();
        jQuery("#sp_fb_img_remove").hide();
        jQuery("#sp_fb_img_input").val(""); 
        
        
        // Regenerate descriptions
        var post_html = jQuery("#wp-content-editor-container #content").val();
        var post_txt = sp_seo.Analysis.getText(post_html);
        post_txt = post_txt.substring(0,200);
        jQuery("#sp_fb_desc").val(post_txt); 
        
        jQuery("#sp_meta_desc").val(post_txt);
        
        
        // Regenerate Titles
        var post_title = jQuery("#titlewrap #title").val();
        jQuery("#sp_fb_title").val(post_title);
        
        jQuery("#sp_twt_desc").val(post_title + " [link to article] ");
        sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_desc'), jQuery('#sp_tweetCharacterCount'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
        
        // Regenerate alternative twitter
//        var post_title = jQuery("#spokal-secondary-title-input").val();
//        jQuery("#sp_twt_alt_title").val(post_title + " [link to article] ");
//        sp_seo.Func.checkTwitterCharacterCount(jQuery('#sp_twt_alt_title'), jQuery('#sp_tweetCharacterCountB'), jQuery('#sp-social-save'), sp_seo.Func.hasTwitterImage(jQuery('#sp_twt_img_input')));
        return false;
    });
    
    function sp_textarea_height(_this){
        try {
            var spHidden = $(document.getElementById('sp-content-hidden')),
            content = null;
            content = $(_this).val();
            content = content.replace(/\n/g, '<br>');
            spHidden.html(content + '<br class="lbr">');
            style = window.getComputedStyle(_this);
            if((spHidden.height() - parseInt(style.maxHeight)) > 3){
                $(_this).css('overflow', "");
                $(_this).css('overflow-y', "visible");
                $(_this).css('overflow-x', "hidden");
            }
            else{
                $(_this).css('overflow', "hidden");
                $(_this).css('overflow-y', "");
                $(_this).css('overflow-x', "");
                if(spHidden.height() < parseInt(style.minHeight)){
                    $(_this).css('height', style.minHeight);
                }
                else
                {
                    $(_this).css('height', spHidden.height());
                }


            }
            spHidden.html("");
        }catch(err) {
        }
    }
    
    $('#sp_fb_desc').on('keyup', function(){sp_textarea_height(this)});
    $('#sp_fb_post_desc').on('keyup', function(){sp_textarea_height(this)});
    $('#sp_meta_desc').on('keyup', function(){sp_textarea_height(this)});
    $('#sp_twt_desc').on('keyup', function(){sp_textarea_height(this)});
//    $('#sp_twt_alt_title').on('keyup', function(){sp_textarea_height(this)});
});
/********************************************************
 * Javascript For Spokal Modal in wp editor starts here
 ********************************************************/


/********************************************************
 * Javascript For Inline CTA in wp editor starts here
 ********************************************************/
jQuery(document).ready(function(){
    jQuery("#close_inline_cta_settings").click(function(){
        jQuery("#sp_inline_cta_settings").hide();
        return false;
    });
    jQuery("#sp_inline_cta_short").click(function(){
        jQuery("#sp_inline_cta_settings").show();
        return false;
    });

    jQuery(".sp-optin-cancel").click(function(){
        jQuery("#sp_inline_cta_settings").hide();
        return false;
    });

    function sp_validate_opt(opt_field,f_name){
        if(

            (opt_field.indexOf('"') === -1) && 
            (opt_field.indexOf(']') === -1) && 
            (opt_field.indexOf('[') === -1) &&
            (opt_field !== "")
          )
        {
         return true;
        }
        else{
            jQuery(".sp-optin-alert-error").html('The '+ f_name + ' field must not be empty or contain the [, ] or " characters');
            jQuery(".sp-optin-alert-error").show();
            return false;
        }
    }

    jQuery(".sp-optin-generate").click(function(){
        jQuery(".sp-optin-alert-error").hide();
        jQuery("#optin-value-wrapp").hide();
        jQuery("#sp-optin-shortcode-value").val("");

        var sp_title = jQuery("#sp-optin-title").val();
        if(!sp_validate_opt(sp_title,"Title")){return false;}

        var sp_text = jQuery("#sp-optin-text").val();
        if(!sp_validate_opt(sp_text,"Text")){return false;}

        var sp_buttontext = jQuery("#sp-optin-buttontext").val();
        if(!sp_validate_opt(sp_buttontext,"Button text")){return false;}

        var sp_success_message = jQuery("#sp-optin-success-message").val();
        if(!sp_validate_opt(sp_success_message,"Success message")){return false;}

        var sp_error_message = jQuery("#sp-optin-error-message").val();
        if(!sp_validate_opt(sp_error_message,"Error message")){return false;}

        var sp_invalid_email_message = jQuery("#sp-optin-invalid-email-message").val();
        if(!sp_validate_opt(sp_invalid_email_message,"Invalid error message")){return false;}

        var sp_optin_image = jQuery("#sp-optin-image-hidden").val();
        var sp_border = jQuery("#sp-optin-border").is(':checked');
        var sp_collectfirstname = jQuery("#sp-optin-collectfirstname").is(':checked');
        var sp_collectlastname = jQuery("#sp-optin-collectlastname").is(':checked');
        var sp_collectphone = jQuery("#sp-optin-collectphone").is(':checked');
        var sp_collectcompany = jQuery("#sp-optin-collectcompany").is(':checked');

        var optin_short = '[optin title="'+sp_title+'" text="'+sp_text+'" buttontext="'+sp_buttontext+'" successMessage="'+sp_success_message+'" errorMessage="'+sp_error_message+'" invalidEmailMessage="'+sp_invalid_email_message+'" image="'+sp_optin_image+'" border="'+sp_border+'" collectfirstname="'+sp_collectfirstname+'" collectlastname="'+sp_collectlastname+'" collectphone="'+sp_collectphone+'" collectcompany="'+sp_collectcompany+'"]';
        jQuery("#sp-optin-shortcode-value").val(optin_short);
        jQuery("#optin-value-wrapp").show();
        return false;
    });

    jQuery(".sp-inline-remove").click(function(){
        jQuery('#sp-optin-image').attr("src","");
        jQuery('#sp-optin-image-hidden').val("");
        jQuery(this).addClass("disabled");
        return false;
    });
});
jQuery(document).ready(function ($) {
    var spokal_custom_uploader;
    $('.sp-inline-upload').click(function (e) {
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
                    $("#sp_inline_spinner").css("display","inline-block");
                    var attachment = spokal_custom_uploader.state().get('selection').first().toJSON();
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {action: "sp_inline_cta_img",id: attachment.id},
                        success: function(data) {
                            $("#sp_inline_spinner").hide();
                            if(data.url){
                                $('#sp-optin-image').attr("src",data.url);
                                $('#sp-optin-image-hidden').val(data.url);
                            }
                        }
                    });
                    jQuery(".sp-inline-remove").removeClass("disabled");
            });
            spokal_custom_uploader.open();
    });
});
/********************************************************
 * Javascript For Inline CTA in wp editor ends here
 ********************************************************/

/********************************************************
 * Javascript For SP SEO analysis in wp editor starts here
 ********************************************************/
var sp_seo = new Object();
sp_seo.Analysis = {
    init: function () {
    },
    status: { danger: 'danger', warning: 'warning', success: 'success' },
    thresholds: { danger: 25, warning: 15, success: 0 },
    setupAnalysis: function (analysis) {
        analysis = analysis || {};
        analysis.results = [];
        analysis.title = analysis.title || "";
        analysis.content = analysis.content || "";
        analysis.keyword = analysis.keyword || "";
        analysis.description = analysis.description || "";
        analysis.status = 0;
        analysis.scoreTotal = sp_seo.Analysis.thresholds.success;
        analysis.metaDescription = analysis.metaDescription || "";
        //content
        
        //clean styles
        analysis.text = sp_seo.Analysis.getText(analysis.content);
        analysis.tokens = analysis.text.split(/[\W]+/gi);
        analysis.keywordEscaped = analysis.keyword.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
        analysis.keywordRegex = new RegExp(analysis.keywordEscaped, "gi");

        analysis.keywordWordLength = sp_seo.Analysis.getWordCount(analysis.keyword);

        //content stopped
        analysis.textStopped = sp_seo.Analysis.removeStopWord(analysis.text);
        analysis.tokensStopped = analysis.textStopped.split(/[\W]+/gi);

        analysis.titleStopped = sp_seo.Analysis.removeStopWord(analysis.title);
        analysis.descriptionStopped = sp_seo.Analysis.removeStopWord(analysis.description);

        analysis.keywordStopped = sp_seo.Analysis.removeStopWord(analysis.keywordEscaped);
        analysis.keywordStoppedRegex = new RegExp(analysis.keywordStopped, "gi");
        var element = document.createElement("DIV");
        element.innerHTML = analysis.content;
        var $content = jQuery(element);
        analysis.images = $content.find("img");
        analysis.linksOutbound = $content.find("a[href^=http]");

        return analysis;
    },
    getWordCount: function (keyword) {
        var s = keyword.replace(/(^\s*)|(\s*$)/gi, "");
        s = s.replace(/[ ]{2,}/gi, " ");
        s = s.replace(/\n /, "\n");

        return s.split(' ').length;
    },
    analyze: function (analysis) {
        sp_seo.Analysis.setupAnalysis(analysis);
        if(typeof(spKeywords) == "undefined"){
            return analysis;
        }
        if (analysis.keyword.length == 0) {
            analysis.results = [sp_seo.Analysis.noKeyword()];
            analysis.status = sp_seo.Analysis.status.danger;
            return analysis;
        }

        analysis.results = jQuery.map(sp_seo.Analysis.modules, function (module) {
            var result = module.analyze(analysis);
            result.scoreCurrent = result.score[result.status];
            analysis.scoreTotal += result.scoreCurrent;
            return result;
        }).sort(function (a, b) {
            return Math.min(Math.max(sp_seo.Analysis.thresholds[b.status] - sp_seo.Analysis.thresholds[a.status], -1), 1);
        });

        analysis.status = sp_seo.Analysis.getStatus(analysis.scoreTotal);
        return analysis;
    },
    getText: function (content) {
        var $placeholder = jQuery("<div />")
            .html(content);

        $placeholder.find("style").html("");
        $placeholder.find("script[data-sp-ignore]").html("");
        $placeholder.find("div").after(" ");
        return $placeholder.text().replace(/\s+/g, ' ');
    },
    getStatus: function (scoreTotal) {
        if (scoreTotal >= sp_seo.Analysis.thresholds.danger) {
            return sp_seo.Analysis.status.danger;
        }

        if (scoreTotal >= sp_seo.Analysis.thresholds.warning) {
            return sp_seo.Analysis.status.warning;
        }

        return sp_seo.Analysis.status.success;
    },
    removeStopWord: function (content) {
        return content.replace(/\b[\w]+\b/g, function (match) {
            if (sp_seo.Analysis.isStopWord(match)) {
                return "";
            }

            return jQuery.trim(match);
        });
    },
    isStopWord: function (word) {
        return sp_seo.Analysis.stopWords.match(sp_seo.Analysis.wordMatch(word));
    },
    wordMatch: function (word) {
        return new RegExp("\\b" + word + "\\b", "gi");
    },
    result: function (id) {
        var result = {
            id: id,
            status: sp_seo.Analysis.status.danger,
            score: {}
        };

        result.score[sp_seo.Analysis.status.danger] = 10;
        result.score[sp_seo.Analysis.status.warning] = 5;
        result.score[sp_seo.Analysis.status.success] = 0;

        return result;
    },
    noKeyword: function () {
        var result = sp_seo.Analysis.result('no-keyword');
        result.status = sp_seo.Analysis.status.danger;
        result.scoreCurrent = 10;
        return result;
    },
    run: function($){
        var analysis = sp_seo.Analysis.analyze({
            content: $("#content").val(),
            keyword: $("#spokal_keywords").val(),
            title: $("#title").val(),
            metaDescription: $("#sp_meta_desc").val()
        });
        var seo_html = sp_seo.Analysis.handleAnalyse(analysis);
        $("#sp_seo_analyser").html(seo_html);
        $("#sp_post_lenght").val(analysis.tokens.length - 1);
        return analysis;
    },
    runVisual: function($,content){
        var analysis = sp_seo.Analysis.analyze({
            content: content,
            keyword: $("#spokal_keywords").val(),
            title: $("#title").val(),
            metaDescription: $("#sp_meta_description_input").val()
        });
        var seo_html = sp_seo.Analysis.handleAnalyse(analysis);
        $("#sp_seo_analyser").html(seo_html);
        $("#sp_post_lenght").val(analysis.tokens.length - 1);
        return analysis;
    },
    handleAnalyse: function(analysis){
        var seo_html = "";
        for (var key in analysis.results) {
            if (analysis.results.hasOwnProperty(key)) {
                var r = analysis.results[key];
                if(r.id == "no-keyword")
                    return sp_seo.Method.noKeyword(r);
                if(r.id == "content-keyword")
                    seo_html += sp_seo.Method.contentKeyword(r);
                if(r.id == "content-length")
                    seo_html += sp_seo.Method.contentLength(r);
                if(r.id == "title-contains")
                    seo_html += sp_seo.Method.titleContains(r);
                if(r.id == "metadesc-keyword")
                    seo_html += sp_seo.Method.metadescKeyword(r);
                if(r.id == "content-image-alt")
                    seo_html += sp_seo.Method.contentImageAlt(r);
                if(r.id == "content-link")
                    seo_html += sp_seo.Method.contentLink(r);
            }
        }
        return seo_html;
    },
    the: 'end'
};

sp_seo.Method = {
    init: function () {
    },
    noKeyword: function(r){
        return '<div class="sp-seo-alert sp-seo-danger">There is no keyword for this post.</div>';
    },
    contentKeyword: function(r){
        var s = "";
        s += '<div class="sp-seo-alert sp-seo-' + r.status + '" >The keyword makes up <strong>'+r.density.toFixed(2)+'</strong>% of your blog, ';
           if(r.density >= r.min && r.density <= r.max)
                s += '<span>which is great,</span>';
            if(r.density < r.min)
                s += '<span>which is low, aim for a minimum of <strong>'+r.min.toFixed(2)+'</strong>%,</span>';
            if(r.density > r.max)
                s += '<span>which is over the advised <strong>'+r.max.toFixed(2)+'</strong>% maximum,</span>';
        s += ' you used your keyword <strong>'+r.occurrences+'</strong> times.</div>';
        return s;
    },
    contentLength: function(r){
        var s = "";
        s += '<div class="sp-seo-alert sp-seo-' + r.status + '" >Your blog has <strong>'+r.wordLength+'</strong> words. ';
           if(r.wordLength < r.low)
                s += '<span>This is too short. Keep going - it should be more than <strong></strong>'+r.low+'.</span>';
            if(r.wordLength >= r.low && r.wordLength < r.medium)
                s += '<span>It\'s short and sweet, but should be more than <strong>'+r.medium+'</strong>.</span>';
            if(r.wordLength >= r.medium)
                s += '<span>which Spokey says is beautiful!</span>';
        s += '</div>';
        return s;
    },
    titleContains: function(r){
        var s = "";
        s += '<div class="sp-seo-alert sp-seo-' + r.status + '" >';
           if(r.status == "danger")
                s += '<span>Your keyword isn\'t in the title. Tisk tisk.</span>';
            if(r.status == "success")
                s += '<span>Your keyword is in the title. Awesome.</span>';
        s += '</div>';
        return s;
    },
    metadescKeyword: function(r){
        var s = "";
        s += '<div class="sp-seo-alert sp-seo-' + r.status + '" >';
           if(r.status == "danger")
                s += '<span>You haven\'t used the keyword in the meta description that shows up in search results. <a href="#" id="sp-fix-meta-desc" onclick="show_social_modal()">Fix this.</a></span>';
            if(r.status == "success")
                s += '<span>You used your keyword in the meta description that shows up in search results. (Doesn\'t affect SEO, but increases clicks.)</span>';
        s += '</div>';
        return s;
    },
    contentImageAlt: function(r){
        var s = "";
        s += '<div class="sp-seo-alert sp-seo-' + r.status + '" >';
           if(r.status == "danger")
                s += '<span>Your blog has a photo without a title (or the title does not contain the keyword), help Google by adding your keyword in there.</span>';
            if(r.status == "warning")
                s += '<span>Your blog doesn\'t have any photos. Boo.</span>';
            if(r.status == "success")
                s += '<span>Your blog has a photo that\'s labelled with your keyword.</span>';
        s += '</div>';
        return s;
    },
    contentLink: function(r){
        var s = "";
        s += '<div class="sp-seo-alert sp-seo-' + r.status + '" >';
        if(r.linksOutboundLength)
                s += '<span>Your blog has <strong>'+ r.linksOutboundLength +'</strong> link(s) to other sites.</span>';
        else
            s += '<span>Your blog has <strong>no</strong> link(s) to other sites.</span></span>';
        s += '</div>';
        return s;
    },
    the: 'end'
};

sp_seo.Func = {
    init: function () {
    },
    checkTwitterCharacterCount: function(input, output, saveButton, hasImage){
        if (input == undefined || output == undefined) {
            return;
        }

        var hasLink = false;
        var tweetHtml = jQuery(input).val();
        var element = jQuery('<p>' + tweetHtml + '</p>');
        var span = element.find('span'); //.remove();

        if (span != undefined && span != null && span.is('span')) {
            hasLink = true;
            span.remove();
        }
        spCheckTwitterCharacterCountString(element.text(), output, saveButton, hasLink, hasImage);
    },
    hasTwitterImage: function(elem){
        var img = elem.val();
        if((img)){
            if(img.length > 0){
                return true;
            }
        }
        return false;
    },
    the: 'end'
};

sp_seo.Analysis.modules = [
    {
        id: "content-keyword",
        analyze: function (analysis) {
            var result = sp_seo.Analysis.result(this.id);
            var match = analysis.textStopped.match(analysis.keywordStoppedRegex);
            result.occurrences = match ? match.length : 0;
            result.density = (result.occurrences / Math.max(((analysis.tokens.length - 1) / analysis.keywordWordLength), 1)) * 100;
            result.max = 3.5;
            result.min = 0.8;
            result.score[sp_seo.Analysis.status.danger] = 8;
            result.score[sp_seo.Analysis.status.warning] = 4;

            if (result.density >= result.min && result.density < result.max) {
                result.status = sp_seo.Analysis.status.success;
            }

            if (result.density > 0.0 && result.density < result.min) {
                result.status = sp_seo.Analysis.status.warning;
            }

            return result;
        }
    }, {
        id: "content-length",
        analyze: function (analysis) {
            var result = sp_seo.Analysis.result(this.id);
            result.wordLength = analysis.tokens.length - 1;
            result.low = 600;
            result.medium = 1000;
            result.score[sp_seo.Analysis.status.danger] = 10;
            result.score[sp_seo.Analysis.status.warning] = 5;

            if (result.wordLength >= result.low) {
                result.status = sp_seo.Analysis.status.warning;
            }

            if (result.wordLength >= result.medium) {
                result.status = sp_seo.Analysis.status.success;
            }

            return result;
        }
    },
    {
        id: "content-image-alt",
        analyze: function (analysis) {
            var result = sp_seo.Analysis.result(this.id);
            result.altsLength = 0;
            result.altsKeywordLength = 0;
            result.score[sp_seo.Analysis.status.danger] = 6;
            result.score[sp_seo.Analysis.status.warning] = 1;

            if (analysis.images.length > 0) {
                var alts = jQuery.grep(jQuery.map(analysis.images,
                function (element) {
                    return jQuery(element).attr("alt") || "";
                }),
                function (element) {
                    return element.match(analysis.keywordRegex);
                });

                if (alts.length > 0) {
                    result.status = sp_seo.Analysis.status.success;
                }

            } else {
                result.status = sp_seo.Analysis.status.warning;
            }

            return result;
        }
    }, {
        id: "content-link",
        analyze: function (analysis) {
            var result = sp_seo.Analysis.result(this.id);
            result.status = sp_seo.Analysis.status.warning;
            result.linksOutboundLength = analysis.linksOutbound.length;
            result.scoreMax = 70;
            result.score[sp_seo.Analysis.status.warning] = 4;

            if (result.linksOutboundLength > 0) {
                result.status = sp_seo.Analysis.status.success;
            }

            return result;
        }
    },
   {
        id: "title-contains",
        analyze: function (analysis) {
            var result = sp_seo.Analysis.result(this.id);
            result.keywordExists = analysis.title.match(analysis.keywordRegex);
            result.keywordStarts = analysis.title.match(new RegExp("^(" + analysis.keywordEscaped + ")", "gi"));
            result.scoreMax = 150;
            result.score[sp_seo.Analysis.status.danger] = 10;

            if (result.keywordExists) {
                result.status = sp_seo.Analysis.status.success;
            }

            return result;
        }
    }, 
    {
        id: "metadesc-keyword",
        analyze: function (analysis) {
            var result = sp_seo.Analysis.result(this.id);
            //result.metaDescription = analysis.metaDescription.length != 0;

            result.score[sp_seo.Analysis.status.danger] = 10;

            if (analysis.metaDescription.match(analysis.keywordRegex)) {

                result.status = sp_seo.Analysis.status.success;
            }

            return result;
        }
    }
    
];

sp_seo.Analysis.stopWords = "a,able,about,above,abst,accordance,according,accordingly,across,act,actually,added,adj,\
affected,affecting,affects,after,afterwards,again,against,ah,all,almost,alone,along,already,also,although,\
always,am,among,amongst,an,and,announce,another,any,anybody,anyhow,anymore,anyone,anything,anyway,anyways,\
anywhere,apparently,approximately,are,aren,arent,arise,around,as,aside,ask,asking,at,auth,available,away,awfully,\
b,back,be,became,because,become,becomes,becoming,been,before,beforehand,begin,beginning,beginnings,begins,behind,\
being,believe,below,beside,besides,between,beyond,biol,both,brief,briefly,but,by,c,ca,came,can,cannot,can't,cause,causes,\
certain,certainly,co,com,come,comes,contain,containing,contains,could,couldnt,d,date,did,didn't,different,do,does,doesn't,\
doing,done,don't,down,downwards,due,during,e,each,ed,edu,effect,eg,eight,eighty,either,else,elsewhere,end,ending,enough,\
especially,et,et-al,etc,even,ever,every,everybody,everyone,everything,everywhere,ex,except,f,far,few,ff,fifth,first,five,fix,\
followed,following,follows,for,former,formerly,forth,found,four,from,further,furthermore,g,gave,get,gets,getting,give,given,gives,\
giving,go,goes,gone,got,gotten,h,had,happens,hardly,has,hasn't,have,haven't,having,he,hed,hence,her,here,hereafter,hereby,herein,\
heres,hereupon,hers,herself,hes,hi,hid,him,himself,his,hither,home,how,howbeit,however,hundred,i,id,ie,if,i'll,im,immediate,\
immediately,importance,important,in,inc,indeed,index,information,instead,into,invention,inward,is,isn't,it,itd,it'll,its,itself,\
i've,j,just,k,keep,keeps,kept,kg,km,know,known,knows,l,largely,last,lately,later,latter,latterly,least,less,lest,let,lets,like,\
liked,likely,line,little,'ll,look,looking,looks,ltd,m,made,mainly,make,makes,many,may,maybe,me,mean,means,meantime,meanwhile,\
merely,mg,might,million,miss,ml,more,moreover,most,mostly,mr,mrs,much,mug,must,my,myself,n,na,name,namely,nay,nd,near,nearly,\
necessarily,necessary,need,needs,neither,never,nevertheless,new,next,nine,ninety,no,nobody,non,none,nonetheless,noone,nor,\
normally,nos,not,noted,nothing,now,nowhere,o,obtain,obtained,obviously,of,off,often,oh,ok,okay,old,omitted,on,once,one,ones,\
only,onto,or,ord,other,others,otherwise,ought,our,ours,ourselves,out,outside,over,overall,owing,own,p,page,pages,part,\
particular,particularly,past,per,perhaps,placed,please,plus,poorly,possible,possibly,potentially,pp,predominantly,present,\
previously,primarily,probably,promptly,proud,provides,put,q,que,quickly,quite,qv,r,ran,rather,rd,re,readily,really,recent,\
recently,ref,refs,regarding,regardless,regards,related,relatively,research,respectively,resulted,resulting,results,right,run,s,\
said,same,saw,say,saying,says,sec,section,see,seeing,seem,seemed,seeming,seems,seen,self,selves,sent,seven,several,shall,she,shed,\
she'll,shes,should,shouldn't,show,showed,shown,showns,shows,significant,significantly,similar,similarly,since,six,slightly,so,\
some,somebody,somehow,someone,somethan,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specifically,specified,specify,\
specifying,still,stop,strongly,sub,substantially,successfully,such,sufficiently,suggest,sup,sure,t,take,taken,taking,tell,tends,\
th,than,thank,thanks,thanx,that,that'll,thats,that've,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,\
thered,therefore,therein,there'll,thereof,therere,theres,thereto,thereupon,there've,these,they,theyd,they'll,theyre,they've,\
think,this,those,thou,though,thoughh,thousand,throug,through,throughout,thru,thus,til,tip,to,together,too,took,toward,towards,\
tried,tries,truly,try,trying,ts,twice,two,u,un,under,unfortunately,unless,unlike,unlikely,until,unto,up,upon,ups,us,use,used,\
useful,usefully,usefulness,uses,using,usually,v,value,various,'ve,very,via,viz,vol,vols,vs,w,want,wants,was,wasn't,way,we,wed,\
welcome,we'll,went,were,weren't,we've,what,whatever,what'll,whats,when,whence,whenever,where,whereafter,whereas,whereby,wherein,\
wheres,whereupon,wherever,whether,which,while,whim,whither,who,whod,whoever,whole,who'll,whom,whomever,whos,whose,why,widely,\
willing,wish,with,within,without,won't,words,world,would,wouldn't,www,x,y,yes,yet,you,youd,you'll,your,youre,yours,yourself,\
yourselves,you've,z,zero";

/********************************************************
 * Javascript For SP SEO analysis in wp editor ends here
 ********************************************************/