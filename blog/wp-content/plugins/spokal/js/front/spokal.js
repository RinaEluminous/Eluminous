/*********************************************************
 * Javascript Spokal Functions starts here
 *********************************************************/
function cookieIsset(name){
    var cookies = document.cookie.split(";");
    for (var i in cookies){
        if (cookies[i].indexOf(name + "=") == 0)
        return true;
    }
    return false;
}

function setCookie(sName, sValue, sExpires) {
    var expDate = new Date();
    expDate.setTime(expDate.getTime() + (sExpires * 1000)); // ici 1 an
    document.cookie = sName + "=" + escape(sValue) + ";expires=" + expDate.toGMTString() + ";path=/";
}

jQuery(document).ready(function(){
    jQuery(".sp_popup_overlay").on("click", function (e) { e.preventDefault(); });
    jQuery(".sp_popup_overlay .sp_popup_submit").on("click", function (e) { e.preventDefault(); e.stopPropagation(); jQuery(this).parent().submit();});
    jQuery(".sp_popup_overlay .sp_popup_continue").on("click", function (e) { e.preventDefault();});
});

function submitSpPopup(_this,sc_msg,f_msg,e_msg){
    var parent = _this.parentNode.parentNode;
    var sp_submit = parent.getElementsByClassName("sp_popup_cta_submit_text");
    var sp_error = parent.getElementsByClassName("sp_popup_error_message");
    var sp_load_gif = parent.getElementsByClassName("sp_popup_LoadGif");
    var sp_succes = parent.getElementsByClassName("sp_popup_succes_message");
    var sp_continue = parent.getElementsByClassName("sp_popup_continue");
    var sp_form_content = parent.getElementsByClassName("sp_popup_form_content");
    var progress = parent.getElementsByClassName("sp_popup_prog_header");

    jQuery(sp_submit).hide();
    jQuery(sp_error).hide();
    jQuery(sp_load_gif).show();
    jQuery.ajax({
        type: "POST",
        url: sp_ajaxurl,
        data: jQuery(_this).serialize(),
        success: function(data){
            jQuery(sp_load_gif).hide();
            if(data.status){
                jQuery(sp_error).hide();
                jQuery(sp_form_content).hide();
                jQuery(progress).hide();
                jQuery(sp_succes).html(sc_msg);
                jQuery(sp_succes).show();
                jQuery(sp_continue).show();
            }else{
                if(data.message == 'invalidEmail'){
                    var failMessage = e_msg;
                }else{
                    var failMessage = f_msg;
                }
                jQuery(sp_submit).show();
                jQuery(sp_error).html(failMessage);
                jQuery(sp_error).show();
            }
        },
        error: function(){
            jQuery(sp_load_gif).hide();
            jQuery(sp_submit).show();
            jQuery(sp_error).html(f_msg);
            jQuery(sp_error).show();
        }
    });
    return false;
}

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

function sp_show_popup(id){
    jQuery('#' + id).fadeIn();
}

/*
 * Checking required fields on submit (lead generator widget form)
 */
function validLeadGeneratorRequest(formID,message) {

    var status = true;

    jQuery("#" + formID + " .spokal-required").each(function(i, obj) {
        
        //check for email (two checks, valid or empty
        if(jQuery(this).hasClass("email")) {
            
            //removing if there is an label already...
            jQuery(this).parent().find("label").remove();
            jQuery(this).parent().find("br").remove();
            
            var emailValue = jQuery(this).val();
            
            if(emailValue.length <= 0) {
                status = false;
                jQuery(this).parent().append('<br><label for="' + jQuery(this).attr('id') +  '" generated="true" class="spokal-error">'+ message +'</label>');
                return false; //to break a loop
            }
            
            if(!isValidEmail(emailValue)) {
                status = false;
                jQuery(this).parent().append('<br><label for="' + jQuery(this).attr('id') +  '" generated="true" class="spokal-error">'+ message +'</label>');
                return false; //to break a loop
            }
        }
        
    });
    
    return status;

}

function validWidgetLeadGeneratorRequest(formID,message) {
    var status = true;
    jQuery("#" + formID + " .spokal-required").each(function(i, obj) {
        //check for email (two checks, valid or empty
        if(jQuery(this).hasClass("email")) {
            var emailValue = jQuery(this).val();
            if(emailValue.length <= 0) {
                status = false;
                return false; //to break a loop
            }
            if(!isValidEmail(emailValue)) {
                status = false;
                return false; //to break a loop
            }
        }
    });
    return status;
}


function isValidEmail(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
}



/*
 * Function for encrypt data
 */

function base64_encode(data) {
    
  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = '',
    tmp_arr = [];

  if (!data) {
    return data;
  }

  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}



/*
 * Function for decrypt data
 */

function base64_decode(data) {

  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = '',
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec.replace(/\0+$/, '');
}

/*
 *  Get cookie
 */

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2){
      return parts.pop().split(";").shift();
  }else{
      return "";
  }
}
/*********************************************************
 * Javascript Spokal Functions ends here
 *********************************************************/


/*********************************************************
 * Javascript for Autolinking starts here
 *********************************************************/
var keywords = new Array(); //global
var linked_keywords = new Object();
jQuery(document).ready(function() {
    var length = keywords.length;
    if(keywords.length > 0){
        for (var i = 0; i < length; i++) {
            if(Object.sp_size(linked_keywords) >= 5){
                break;
            }
            jQuery('div[data-spokal="postcontainer"] p').each(function(){
                var element = null;
                var link = null;
                element =  keywords[i][0];
                link = keywords[i][1];
                traverseChildNodes(this,element,link);
                
            });
        }
    }
});
 
function traverseChildNodes(node,element,link) {
    
    var next;
    if (node.nodeType === 1) {
        // (Element node)
        if (node = node.firstChild) {
            do {
                // Recursively call traverseChildNodes
                // on each child node
                next = node.nextSibling;
                traverseChildNodes(node,element,link);
            } while(node = next);
        }
 
    } else if (node.nodeType === 3 && !isTextNodeAnchor(node) && !is_forbiden_element(node) && !is_spokal_image(node)) {
        
        // (Text node)           
        var patern = new RegExp("\\b"+element+"\\b", "gi");
        
        if (patern.test(node.data) && !linked_keywords.hasOwnProperty(element)) {
                wrapMatchesInNode(node, element, link);
        }else if(element.search("'")){
            var qu_pat = new RegExp("\\b'\\b", "gi");
            var tm_quote = document.createElement('div');
            tm_quote.innerHTML = element.replace(qu_pat, "&rsquo;");
            var new_element = tm_quote.innerHTML;
            qu_pat = new RegExp("\\b" + new_element + "\\b", "gi");
             if (qu_pat.test(node.data) && !linked_keywords.hasOwnProperty(new_element)) {
                 wrapMatchesInNode(node, new_element, link);
             }
        }
           
    }
}

function isTextNodeAnchor(curNode) {
    while (curNode) {
       if (curNode.tagName == 'A') {
           return true;
       }                  
       else
          curNode = curNode.parentNode;
    }
    return false;
}


function is_forbiden_element(curNode){
    if(curNode.parentNode){
        var nodeTag = curNode.parentNode.tagName;
        if (nodeTag == 'DIV' || nodeTag == 'P' || nodeTag == 'SPAN') {
               return false;
        }
        return true;
    }
    return false;
}

function is_spokal_image(curNode){
    var patern = new RegExp("\\bspcaption\\b", "gi");
    var patern2 = new RegExp("\\bsp_skip_autolink\\b", "gi");
    while (curNode) {
       if (patern.test(curNode.className) || patern2.test(curNode.className)) {
           return true;
       }                  
       else
          curNode = curNode.parentNode;
    }
    return false;
}

function wrapMatchesInNode(textNode, element, link) {
 
    var temp = document.createElement('div');
    var patern = new RegExp("\\b"+element+"\\b", 'i');
    
    temp.innerHTML = textNode.data.replace(patern, '<a href="' + link + '">$&</a>');
 
    while (temp.firstChild) {
        if(textNode.parentNode === null) {
            break;
        }
        linked_keywords[element] = "true";
        textNode.parentNode.insertBefore(temp.firstChild, textNode);
    }
 
    // Remove original text-node:
    if(textNode.parentNode !== null) {
        textNode.parentNode.removeChild(textNode);
    }
    
}

Object.sp_size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
/*********************************************************
 * Javascript for Autolinking ends here
 *********************************************************/

/*********************************************************
 * Javascript For ScrollBox starts here
 *********************************************************/
var scbx_ajax_prog = false;
if (typeof spSCBX === 'undefined') {
    var spSCBX = new Object();
}
jQuery(document).ready(function(){
    jQuery('#scrollBoxContinue').click(function(){
        jQuery('#spokalScrollBoxShowOnScrole').slideUp(300);
        if(document.cookie.indexOf("sp_scbx_shown") < 0){
            var exdays = parseInt(spSCBX.timeShowingMeasure) * parseInt(spSCBX.timeShowing) * 60;
            setCookie("sp_scbx_shown","true",exdays);
        }
        setTimeout(function(){
            jQuery('#spokalScrollBoxShowOnScrole').remove();
        },320);
        return false;
    });
    jQuery('#closeScrollBox').click(function(){
        jQuery('#spokalScrollBoxShowOnScrole').slideUp(300);
        if(document.cookie.indexOf("sp_scbx_shown") < 0){
            var exdays = parseInt(spSCBX.timeShowingMeasure) * parseInt(spSCBX.timeShowing) * 60;
            setCookie("sp_scbx_shown","true",exdays);
        }
    });
});


 jQuery(document).ready(function(){
    jQuery('#spokalLeadsScrollBox').submit(function(){
        jQuery('#spokalLeadsScrollBox .scrollBoxSubmit').hide();
        jQuery('#ScrollBoxErrorMessage').hide();
        jQuery('#scrollBoxLoadGif').show();
        
        if(!scbx_ajax_prog){
            scbx_ajax_prog = true;
            jQuery.ajax({
                type: "POST",
                url: sp_ajaxurl,
                data: jQuery("#spokalLeadsScrollBox").serialize(),
                success: function(data){
                    if(data.status){
                        jQuery('#scrollBoxLoadGif').hide();
                        jQuery('#ScrollBoxErrorMessage').hide();
                        jQuery('#spokalScrollBoxFormContent').hide();
                        jQuery('#scrollBoxSuccesMessage').html(spSCBX.successmsg);
                        jQuery('#scrollBoxSuccesMessage').show();
                        jQuery('#scrollBoxContinue').show(); 
                   }else{
                        if(data.message == 'invalidEmail'){
                            var failMessage = spSCBX.invalidEmailMsg;
                        }else{
                            var failMessage = spSCBX.failmsg;
                        }
                        jQuery('#scrollBoxLoadGif').hide();
                        jQuery('#spokalLeadsScrollBox .scrollBoxSubmit').show();
                        jQuery('#ScrollBoxErrorMessage').html(failMessage);
                        jQuery('#ScrollBoxErrorMessage').show();
                    }
                    scbx_ajax_prog = false;
                },
                error: function(){
                    jQuery('#scrollBoxLoadGif').hide();
                    jQuery('#spokalLeadsScrollBox .scrollBoxSubmit').show();
                    jQuery('#ScrollBoxErrorMessage').html(spSCBX.failmsg);
                    jQuery('#ScrollBoxErrorMessage').show();
                    scbx_ajax_prog = false;
                }
            });
        }
        return false;
    });
});

jQuery(document).ready(function($){
    if(!jQuery.isEmptyObject(spSCBX))
    {
        $.fn.scrollStopped = function(callback){
            $(this).scroll(function(){
                var self = this, $this = $(self);
                if($this.data('scrollTimeout')){
                    clearTimeout($this.data('scrollTimeout'));
                }
                $this.data('scrollTimeout', setTimeout(callback,250,self));
            });
        };
        jQuery(window).scrollStopped(function(){
            var docH = jQuery(document).height();
            var winH = jQuery(window).height();
            var scrollTop = jQuery(this).scrollTop();
            if(docH === winH){
                var totalPixels = docH;
            }else{
                var totalPixels = docH - winH;
            }
            var scrollPercentage = parseFloat(scrollTop/totalPixels * 100);
            if(scrollPercentage > parseFloat(spSCBX.showingPercent)){
                if(document.cookie.indexOf("sp_scbx_shown") < 0){
                    jQuery('#spokalScrollBoxShowOnScrole').slideDown(300);
                }
            }
        });
    }
});
/*********************************************************
 * Javascript For ScrollBox ends here
 *********************************************************/

/*********************************************************
 * Javascript For Smartbar starts here
 *********************************************************/
if (typeof spSMBR === 'undefined') {
    var spSMBR = new Object();
}
var sb_ajax_prog = false;
jQuery(document).ready(function(){
    if(jQuery(window).width() > 700){
        if(document.getElementById("spokalSmartbarEmail")){
            var spanBar = jQuery('<span/>').html(jQuery('#spokalSmartbarEmail').attr('placeholder')).css({position: 'absolute',left: -9999,top: -9999}).appendTo('body');
            var EmailWidth = spanBar.width();
            spanBar.remove();
            jQuery('#spokalSmartbarEmail').css('min-width',EmailWidth + 10 + 'px');
        }
        if(document.getElementById("spokalSmartbarName")){
            var spanBar2 = jQuery('<span/>').html(jQuery('#spokalSmartbarName').attr('placeholder')).css({position: 'absolute',left: -9999,top: -9999}).appendTo('body');
            var NameWidth = spanBar2.width();
            spanBar2.remove();
            jQuery('#spokalSmartbarName').css('min-width',NameWidth + 20 + 'px');
        }
    }
});

jQuery(document).ready(function() {
    jQuery('.spokalSmartBar button').focus(function() {
        this.blur();
    });
});

jQuery(document).ready(function(){
    jQuery('#smartBarContinue').click(function(){
        jQuery('#spokalSmartBarShowOnScrole').slideUp(300);
        if(document.cookie.indexOf("sp_smbr_shown") < 0){
            var exdays = parseInt(spSMBR.timeShowingMeasure) * parseInt(spSMBR.timeShowing) * 60;
            setCookie("sp_smbr_shown","true",exdays);
        }
        setTimeout(function(){
            jQuery('#spokalSmartBarShowOnScrole').remove();
        },320);
        return false;
    });
    jQuery('#closeSmartBar').click(function(){
        jQuery('#spokalSmartBarShowOnScrole').slideUp(300);
        if(document.cookie.indexOf("sp_smbr_shown") < 0){
            var exdays = parseInt(spSMBR.timeShowingMeasure) * parseInt(spSMBR.timeShowing) * 60;
            setCookie("sp_smbr_shown","true",exdays);
        }
    });
});

jQuery(document).ready(function(){
    jQuery('#spokalLeadsSmartBar').submit(function(){
        jQuery('#SmartBarErrorMessage').hide();
        jQuery('#smartBarLoadGif').show();
        if(!sb_ajax_prog){
            sb_ajax_prog = true;
            jQuery.ajax({
                type: "POST",
                url: sp_ajaxurl,
                data: jQuery("#spokalLeadsSmartBar").serialize(),
                success: function(data){
                    jQuery('#smartBarLoadGif').hide();
                    if(data.status){
                        jQuery('#SmartBarErrorMessage').hide();
                        jQuery('#smartBarFormContent').hide();
                        jQuery('#smartBarSuccesMessage').html(spSMBR.successmsg);
                        jQuery('#smartBarSuccesMessage').css("display","inline-block");
                        jQuery('#smartBarContinue').show();
                    }else{
                        if(data.message == 'invalidEmail'){
                            var failMessage = spSMBR.invalidEmailMsg;;
                        }else{
                            var failMessage = spSMBR.failmsg;;
                        }jQuery('#SmartBarErrorMessage').html(failMessage);
                        jQuery('#SmartBarErrorMessage').show();
                    }
                    sb_ajax_prog = false;
                },
                error: function(){
                    jQuery('#SmartBarErrorMessage').html(spSMBR.failmsg);
                    jQuery('#SmartBarErrorMessage').show();
                    sb_ajax_prog = false;
                }
            });
        }
        return false;
    });
});


jQuery(document).ready(function($){
    if(!jQuery.isEmptyObject(spSMBR))
    {
        if(spSMBR.behavior === 'scroll'){
            var lastScrollTop = 0;
            jQuery(window).scroll(function(event){
                var st = $(this).scrollTop();
                if (st <= lastScrollTop){
                    if(document.cookie.indexOf("sp_smbr_shown") < 0){
                        jQuery('#spokalSmartBarShowOnScrole').slideDown(300);
                    }
                }
                lastScrollTop = st;
            });
        }
    }
});
/*********************************************************
 * Javascript For Smartbar ends here
 *********************************************************/

/*********************************************************
 * Javascript For ExitIntent starts here
 *********************************************************/
if (typeof spEI === 'undefined') {
    var spEI = new Object();
}
var spei_ajax_prog = false;

jQuery(document).ready(function(e){
    if(!jQuery.isEmptyObject(spEI))
    {
        spEI.previousY = -1;
         e(document).mousemove(function(e) {
            if (e.clientY < spEI.previousY) {
                var n = e.clientY + (e.clientY - spEI.previousY);
                if (n <= 5) {
                    spEI.checking = true;
                    setTimeout(function() {
                        show_sp_EI(spEI)
                    }, 1)
                }
            }
            spEI.previousY = e.clientY
         });
     }
});

function show_sp_EI(spEI) {
    if (spEI.checking && (document.cookie.indexOf("sp_ei_shown") < 0)) {
        jQuery('#sp_popup_overlay-' + spEI.ei_popup).fadeIn();
    }
    spEI.checking = false
}

function sp_ei_remove(id){
    jQuery("#" + id).fadeOut();
    if(document.cookie.indexOf("sp_ei_shown") < 0){
        var exdays = parseInt(spEI.timeShowingMeasure) * parseInt(spEI.timeShowing) * 60;
        setCookie("sp_ei_shown","true",exdays);
    }
}




jQuery(document).ready(function(){
    jQuery('#exit_intent_continue').click(function(){
        jQuery('#sp_exit_intent_overlay').fadeOut();
        if(document.cookie.indexOf("sp_ei_shown") < 0){
            var exdays = parseInt(spEI.timeShowingMeasure) * parseInt(spEI.timeShowing) * 60;
            setCookie("sp_ei_shown","true",exdays);
        }
        setTimeout(function(){
            jQuery('#sp_exit_intent_overlay').remove();
        },320);
        return false;
    });
});

jQuery(document).ready(function(){
    jQuery('#sp_form_exit_intent').submit(function(){
        jQuery('#sp_form_exit_intent .exit_intent_submit').hide();
        jQuery('#exit_intent_error_message').hide();
        jQuery('#exit_intent_LoadGif').show();
        if(!spei_ajax_prog){
            spei_ajax_prog = true;
            jQuery.ajax({
                type: "POST",
                url: sp_ajaxurl,
                data: jQuery("#sp_form_exit_intent").serialize(),
                success: function(data){
                    if(data.status){
                        jQuery('#exit_intent_LoadGif').hide();
                        jQuery('#exit_intent_error_message').hide();
                        jQuery('#sp_exit_intent_form_content').hide();
                        jQuery('#exit_intent_succes_message').html(spEI.successmsg);
                        jQuery('#exit_intent_succes_message').show();
                        jQuery('#exit_intent_continue').show();
                    }else{
                        if(data.message == 'invalidEmail'){
                            var failMessage = spEI.invalidEmailMsg;
                        }else{
                            var failMessage = spEI.failmsg;
                        }
                        jQuery('#exit_intent_LoadGif').hide();
                        jQuery('#sp_form_exit_intent .exit_intent_submit').show();
                        jQuery('#exit_intent_error_message').html(failMessage);
                        jQuery('#exit_intent_error_message').show();
                    }
                    spei_ajax_prog = false;
                },
                error: function(){
                    jQuery('#scrollBoxLoadGif').hide();
                    jQuery('#sp_form_exit_intent .exit_intent_submit').show();
                    jQuery('#exit_intent_error_message').html(spEI.failmsg);
                    jQuery('#exit_intent_error_message').show();
                    spei_ajax_prog = false;
                }
            });
        }
        return false;
    });
});

/*********************************************************
 * Javascript For ExitIntent ends here
 *********************************************************/