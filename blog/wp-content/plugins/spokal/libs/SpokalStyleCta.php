<?php

class SP_Style_CTA{
    
    public $callbacks = array(
        "scrollbox" => array("ScrollBoxAddon","renderFrontScrollBox"),
        "smartbar" => array("SmartBarAddon","renderFrontSmartBar"),
        "exitintent" => array("ExitIntent","renderFrontExitIntent"),
        "spokalwidget" => array("SP_Style_CTA","renderSpokalWidget"),
        "inlineCta" => array("SP_Style_CTA","renderInlineCTA"),
        "sppopup" => array("SpokalPopup","renderSpokalPopup")
    );
    

    public $options_calback = array(
        "scrollbox" => array("ScrollBoxAddon","getScrollBoxOptions"),
        "smartbar" => array("SmartBarAddon","getSmartBarOptions"),
        "exitintent" => array("ExitIntent","getExitIntentOptions"),
        "sppopup" => array("SpokalPopup","getSpokalPopupOptions"),
    );

    
    public $cta_names = array(
        "scrollbox" => "Scroll Box",
        "smartbar" => "Smart Bar",
        "exitintent" => "Exit Intent",
        "spokalwidget" => "Widget",
        "inlineCta" => "Inline CTA",
        "sppopup" => "Spokal Popup",
    );
    
    
    public $style_file = "";
    
    
    public $db_options = array(
        "scrollbox" => 'spokal_scroll_box_content',
        "smartbar" => 'spokal_smart_bar_content',
        "exitintent" => 'spokal_exit_intent_content',
        "inlineCta" => 'spokal_inlineCta_ph'
    );
    
    
    public $versions = array(
        'scrollbox' => array(
                "form" => "#spokalScrollBoxFormContent",
                "message" => "#scrollBoxSuccesMessage",
                "button" => "#scrollBoxContinue"
        ),
        'smartbar' => array(
                "form" => "#smartBarFormContent",
                "message" => "#smartBarSuccesMessage",
                "button" => "#smartBarContinue"
        ),
        'exitintent' => array(
                "form" => "#sp_exit_intent_form_content",
                "message" => "#exit_intent_succes_message",
                "button" => "#exit_intent_continue"
        ),
        'spokalwidget' => array(
                "form" => "",
                "message" => "",
                "button" => ""
        ),
        'inlineCta' => array(
                "form" => "#inline_cta_from",
                "message" => ".inline_succes_msg",
                "button" => ""
        ),
        'sppopup' => array(
                "form" => ".sp_popup_form_content",
                "message" => ".sp_popup_succes_message",
                "button" => ".sp_popup_continue",
        )
    );
    
    
    public $settings = array(
            'scrollbox' => array(
                'background' => array(
                                    "name" => "Background",
                                    "identifier" => ".spokalScrollBox",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "F0F0F0"),
                                        "font-color" => array("show" => false, "default" => ""),
                                        "width" => array("show" => true, "default" => "267", "max" => "600"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => ""),
                                        "text-content" => array("show" => false, "default" => ""),
                                    ),
                                ),
                'title'      => array(
                                    "name" => "Title",
                                    "identifier" => ".scrollBoxTitle",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "000000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "20"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => "bold"),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'top-text'   => array(
                                    "name" => "Top Text",
                                    "identifier" => ".scrollBoxTopText",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "000000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "15"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'close'   => array(
                                    "name" => "Close Scroll Box",
                                    "identifier" => "#closeScrollBox",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "bbb"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => ""),
                                        "text-content" => array("show" => false, "default" => ""),
                                    ),
                                ),
                'input-text'   => array(
                                    "name" => "Text Inputs",
                                    "identifier" => ".scrollBox-field input",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "FFFFFF"),
                                        "font-color" => array("show" => true, "default" => "000000"),
                                        "placeholder-color" => array("show"=>true, "default" => "none"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "15"),
                                        "text-content" => array("show" => false, "default" => ""),
                                    ),
                                ),
                'lead-fields'   => array(
                                    "name" => "Collect More Information:",
                                    "identifier" => "#sbx-email-field",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => "FFFFFF"),
                                        "font-color" => array("show" => false, "default" => "000000"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => "15"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "first-name" => array("show" => true, "default" => "","identifier" => "#sbx-fname-field"),
                                        "last-name" => array("show" => true, "default" => "","identifier" => "#sbx-lname-field"),
                                        "phone" => array("show" => true, "default" => "","identifier" => "#sbx-phone-field"),
                                        "company" => array("show" => true, "default" => "","identifier" => "#sbx-company-field"),
                                    ),
                                ),
                'error-msg' => array(
                                    "name" => "Error Messages",
                                    "identifier" => ".scrollBoxErrorMessage",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "FF0000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "13"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "error" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'success-msg' => array(
                                    "name" => "Success Message",
                                    "identifier" => ".scrollBoxSuccesMessage",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "008000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "17"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'button' => array(
                                    "name" => "Button",
                                    "identifier" => ".scrollBoxSubmit",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "0f52ba"),
                                        "font-color" => array("show" => true, "default" => "FFFFFF"),
                                        "hover-color" => array("show" => true, "default" => "0d48a2"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "15"),
                                        "text-content" => array(
                                                "show" => true,
                                                "buttontext" => array("name" => "Subscribe Button Text:", "identifier" => ".sbx_cta_submit_text"),
                                                "continueButtonText" => array("name" => "Continue Button Text:", "identifier" => ".sbx_cta_continue_text"),
                                        ),
                                    ),
                                ),
                'footer' => array(
                                    "name" => "Footer",
                                    "identifier" => ".scrollBox_footer",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "d8d8d8"),
                                        "font-color" => array("show" => true, "default" => "484848"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "12"),
                                        "text-content" => array("show" => false, "default" => ""),
                                    ),
                                ),
            ),
        
            "smartbar" => array(
                'background' => array(
                                    "name" => "Background",
                                    "identifier" => ".spokalSmartBar",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "F0F0F0"),
                                        "font-color" => array("show"=>false, "default" => ""),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'top-text'   => array(
                                    "name" => "Top Text",
                                    "identifier" => ".smartBarTopText",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "16"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                    ),
                                ),
                'close'   => array(
                                    "name" => "Close Smart Bar",
                                    "identifier" => "#closeSmartBar",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "bbb"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'input-text'   => array(
                                    "name" => "Text Inputs",
                                    "identifier" => ".smartBar-field  input",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "FFFFFF"),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "placeholder-color" => array("show"=>true, "default" => "none"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "16"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'lead-fields'   => array(
                                    "name" => "Collect More Information:",
                                    "identifier" => "#spokalSmartbarEmail",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => "FFFFFF"),
                                        "font-color" => array("show" => false, "default" => "000000"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => "15"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "first-name" => array("show" => true, "default" => "","identifier" => "#spokalSmartbarName"),
                                    ),
                                ),
                'error-msg' => array(
                                    "name" => "Error Messages",
                                    "identifier" => ".smartBarErrorMessage",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "FF0000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "13"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "error" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'success-msg' => array(
                                    "name" => "Success Message",
                                    "identifier" => ".smartBarSuccesMessage",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "008000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "15"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                    ),
                                ),
                'button' => array(
                                "name" => "Button",
                                "identifier" => ".smartBarSubmit",
                                "fields" => array(
                                    "back-color" => array("show" => true, "default" => "0f52ba"),
                                    "font-color" => array("show" => true, "default" => "FFFFFF"),
                                    "hover-color" => array("show" => true, "default" => "0d48a2"),
                                    "font-family" => array("show" => true, "default" => ""),
                                    "font-size" => array("show" => true, "default" => "16"),
                                    "text-content" => array(
                                            "show" => true,
                                            "buttontext" => array("name" => "Subscribe Button Text:", "identifier" => ".smb_cta_submit_text"),
                                            "continueButtonText" => array("name" => "Continue Button Text:", "identifier" => ".smb_cta_continue_text"),
                                    )
                                ),
                            ),
            ),
            "exitintent" => array(
                'background' => array(
                                    "name" => "Background",
                                    "identifier" => ".sp_exit_intent",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "fefefe"),
                                        "font-color" => array("show"=>false, "default" => ""),
                                        "width" => array("show" => true, "default" => "650", "max" => "680"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'title'      => array(
                                    "name" => "Title",
                                    "identifier" => ".sp_exit_intent_title",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "444444"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "24"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => "bold"),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'top-text'   => array(
                                    "name" => "Top Text",
                                    "identifier" => ".sp_exit_intent_top_text",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "444444"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "24"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                
                'image'   => array(
                                    "name" => "Exit Intent Logo Image",
                                    "identifier" => ".sp_exit_intent_top_text",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>false, "default" => "000000"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => "24"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "image" => array("show" => true, "default" => ""),
                                    ),
                                ),
                
                'close'   => array(
                                    "name" => "Close Exit Intent",
                                    "identifier" => "#close_sp_exit_intent",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "bbb"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'input-text'   => array(
                                    "name" => "Text Inputs",
                                    "identifier" => ".exit_intent_field  input",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "FFFFFF"),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "placeholder-color" => array("show"=>true, "default" => "none"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "19"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'lead-fields'   => array(
                                    "name" => "Collect More Information:",
                                    "identifier" => "#ei-email-field",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => "FFFFFF"),
                                        "font-color" => array("show" => false, "default" => "000000"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => "15"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "first-name" => array("show" => true, "default" => "","identifier" => "#ei-fname-field"),
                                        "last-name" => array("show" => true, "default" => "","identifier" => "#ei-lname-field"),
                                        "phone" => array("show" => true, "default" => "","identifier" => "#ei-phone-field"),
                                        "company" => array("show" => true, "default" => "","identifier" => "#ei-company-field"),
                                    ),
                                ),
                'error-msg' => array(
                                    "name" => "Error Messages",
                                    "identifier" => ".exit_intent_error_message",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "FF0000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "error" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'success-msg' => array(
                                    "name" => "Success Message",
                                    "identifier" => ".exit_intent_succes_message",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "008000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "24"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'button' => array(
                                    "name" => "Button",
                                    "identifier" => ".exit_intent_submit",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "0f52ba"),
                                        "font-color" => array("show" => true, "default" => "FFFFFF"),
                                        "hover-color" => array("show" => true, "default" => "0d48a2"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "20"),
                                        "text-content" => array(
                                            "show" => true,
                                            "buttontext" => array("name" => "Subscribe Button Text:", "identifier" => ".ei_cta_submit_text"),
                                            "continueButtonText" => array("name" => "Continue Button Text:", "identifier" => ".ei_cta_continue_text"),
                                        )
                                    ),
                                ),
            ),
        "spokalwidget" => array(
                'background' => array(
                                    "name" => "Background",
                                    "identifier" => ".swg_wrap_for_cta .sp_widget_wrap",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => ""),
                                        "font-color" => array("show"=>false, "default" => ""),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'title'      => array(
                                    "name" => "Title",
                                    "identifier" => ".swg_wrap_for_cta .swg_title",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "18"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'top-text'   => array(
                                    "name" => "Top Text",
                                    "identifier" => ".swg_wrap_for_cta .swg_top_text",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "16"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'input-text'   => array(
                                    "name" => "Text Inputs",
                                    "identifier" => " .swg_wrap_for_cta .sp_widget_wrap .swg-input",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "FFFFFF"),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "placeholder-color" => array("show"=>true, "default" => "none"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "17"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'lead-fields'   => array(
                                    "name" => "Collect More Information:",
                                    "identifier" => ".swg_wrap_for_cta .sp_widget_wrap .email_input",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => "FFFFFF"),
                                        "font-color" => array("show" => false, "default" => "000000"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => ""),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "first-name" => array("show" => true, "default" => "","identifier" => ".sp_widget_wrap .fname_input"),
                                        "last-name" => array("show" => true, "default" => "","identifier" => ".sp_widget_wrap .lname_input"),
                                        "phone" => array("show" => true, "default" => "","identifier" => ".sp_widget_wrap .phone_input"),
                                        "company" => array("show" => true, "default" => "","identifier" => ".sp_widget_wrap .company_input"),
                                    ),
                                ),
                'error-msg' => array(
                                    "name" => "Error Messages",
                                    "identifier" => ".swg_wrap_for_cta .swg_error_message",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "FF0000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "error" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'success-msg' => array(
                                    "name" => "Success Message",
                                    "identifier" => ".swg_wrap_for_cta .swg_success_msg",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "008000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'button' => array(
                                    "name" => "Button",
                                    "identifier" => ".swg_wrap_for_cta .sp_widget_wrap .swg_submit",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "0f52ba"),
                                        "font-color" => array("show" => true, "default" => "FFFFFF"),
                                        "hover-color" => array("show" => true, "default" => "0d48a2"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "15"),
                                        "text-content" => array(
                                            "show" => true,
                                            "buttontext" => array("name" => "Subscribe Button Text:", "identifier" => '.swg_wrap_for_cta .sp_widget_wrap input[type=submit]'),
                                        )
                                    ),
                                ),
            ),
            "inlineCta" => array(
                'background' => array(
                                    "name" => "Background",
                                    "identifier" => ".inlince-cta-wrap",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => ""),
                                        "font-color" => array("show"=>false, "default" => ""),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'title'      => array(
                                    "name" => "Title",
                                    "identifier" => ".inline-title",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "000000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "18"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'top-text'   => array(
                                    "name" => "Top Text",
                                    "identifier" => ".inline-top-text",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "000000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'input-text'   => array(
                                    "name" => "Text Inputs",
                                    "identifier" => ".inlince-cta-wrap .icta-input",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "FFFFFF"),
                                        "font-color" => array("show" => true, "default" => "000000"),
                                        "placeholder-color" => array("show" => true, "default" => "none"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "17"),
                                        "text-content" => array("show" => false, "default" => ""),
                                    ),
                                ),
                'lead-fields'   => array(
                                    "name" => "Placeholders:",
                                    "identifier" => ".inlince-cta-wrap .email_input",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => "FFFFFF"),
                                        "font-color" => array("show" => false, "default" => "000000"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => ""),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "first-name" => array("show" => true, "default" => "","identifier" => ".inlince-cta-wrap .fname_input"),
                                        "last-name" => array("show" => true, "default" => "","identifier" => ".inlince-cta-wrap .lname_input"),
                                        "phone" => array("show" => true, "default" => "","identifier" => ".inlince-cta-wrap .phone_input"),
                                        "company" => array("show" => true, "default" => "","identifier" => ".inlince-cta-wrap .company_input"),
                                    ),
                                ),
                'error-msg' => array(
                                    "name" => "Error Messages",
                                    "identifier" => ".inline_error_msg",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "FF0000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "error" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'success-msg' => array(
                                    "name" => "Success Message",
                                    "identifier" => ".inline_succes_msg",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "008000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "left"),
                                    ),
                                ),
                'button' => array(
                                    "name" => "Button",
                                    "identifier" => ".inlince-cta-wrap .icta-submit",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "0f52ba"),
                                        "font-color" => array("show" => true, "default" => "FFFFFF"),
                                        "hover-color" => array("show" => true, "default" => "0d48a2"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "15"),
                                        "text-content" => array(
                                            "show" => false,
                                            "buttontext" => array("name" => "Subscribe Button Text:", "identifier" => '.sp_widget_wrap input[type=submit]'),
                                        )
                                    ),
                                ),
            ),
            "sppopup" => array(
                'popup_name' => array(
                            "name" => "Popup Name: *",
                            "identifier" => ".sp_popup_wrapp",
                            "fields" => array(
                                "back-color" => array("show"=>false, "default" => "fefefe"),
                                "font-color" => array("show"=>false, "default" => ""),
                                "font-family" => array("show"=>false, "default" => ""),
                                "font-size" => array("show"=>false, "default" => ""),
                                "text-content" => array("show"=>false, "default" => ""),
                            ),
                                   
                ),
                'show-field' => array(
                            "name" => "Progress Bar",
                            "identifier" => ".sp_popup_progressValue",
                            "fields" => array(
                                "back-color" => array("show"=>true, "default" => "390DFF"),
                                "font-color" => array("show"=>true, "default" => "444444","identifier" => ".sp_popup_prog_header"),
                                "font-family" => array("show"=>false, "default" => ""),
                                "font-size" => array("show"=>false, "default" => ""),
                                "text-content" => array("show"=>false, "default" => ""),
                                "show-field" => array("show"=>true, "default" => "","identifier" => ".sp_popup_prog_header"),
                            ),
                                   
                ),
                'background' => array(
                                    "name" => "Background",
                                    "identifier" => ".sp_popup_wrapp",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "fefefe"),
                                        "font-color" => array("show"=>false, "default" => ""),
                                        "width" => array("show" => true, "default" => "650", "max" => "680"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'title'      => array(
                                    "name" => "Title",
                                    "identifier" => ".sp_popup_title",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "444444"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "24"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => "bold"),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'top-text'   => array(
                                    "name" => "Top Text",
                                    "identifier" => ".sp_popup_top_text",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "444444"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "24"),
                                        "text-content" => array("show"=>true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                
                'image'   => array(
                                    "name" => "Image",
                                    "identifier" => ".sp_popup_top_text",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>false, "default" => "000000"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => "24"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "image" => array("show" => true, "default" => ""),
                                    ),
                                ),
                
                'close'   => array(
                                    "name" => "Close Popup",
                                    "identifier" => ".close_sp_popup",
                                    "fields" => array(
                                        "back-color" => array("show"=>false, "default" => ""),
                                        "font-color" => array("show"=>true, "default" => "bbb"),
                                        "font-family" => array("show"=>false, "default" => ""),
                                        "font-size" => array("show"=>false, "default" => ""),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'input-text'   => array(
                                    "name" => "Text Inputs",
                                    "identifier" => ".sp_popup_field  input",
                                    "fields" => array(
                                        "back-color" => array("show"=>true, "default" => "FFFFFF"),
                                        "font-color" => array("show"=>true, "default" => "000000"),
                                        "placeholder-color" => array("show"=>true, "default" => "none"),
                                        "font-family" => array("show"=>true, "default" => ""),
                                        "font-size" => array("show"=>true, "default" => "19"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                    ),
                                ),
                'lead-fields'   => array(
                                    "name" => "Collect More Information:",
                                    "identifier" => "#sp-pop-email-field",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => "FFFFFF"),
                                        "font-color" => array("show" => false, "default" => "000000"),
                                        "font-family" => array("show" => false, "default" => ""),
                                        "font-size" => array("show" => false, "default" => "15"),
                                        "text-content" => array("show" => false, "default" => ""),
                                        "first-name" => array("show" => true, "default" => "","identifier" => "#sp-pop-fname-field"),
                                        "last-name" => array("show" => true, "default" => "","identifier" => "#sp-pop-lname-field"),
                                        "phone" => array("show" => true, "default" => "","identifier" => "#sp-pop-phone-field"),
                                        "company" => array("show" => true, "default" => "","identifier" => "#sp-pop-company-field"),
                                    ),
                                ),
                'error-msg' => array(
                                    "name" => "Error Messages",
                                    "identifier" => ".sp_popup_error_message",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "FF0000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "16"),
                                        "text-content" => array("show"=>false, "default" => ""),
                                        "error" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'success-msg' => array(
                                    "name" => "Success Message",
                                    "identifier" => ".sp_popup_succes_message",
                                    "fields" => array(
                                        "back-color" => array("show" => false, "default" => ""),
                                        "font-color" => array("show" => true, "default" => "008000"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "24"),
                                        "text-content" => array("show" => true, "default" => ""),
                                        "word-buttons" => array("show" => true, "default" => ""),
                                        "text-bold" => array("show" => true, "default" => ""),
                                        "text-italic" => array("show" => true, "default" => ""),
                                        "text-decoration" => array("show" => true, "default" => ""),
                                        "text-align" => array("show" => true, "default" => "center"),
                                    ),
                                ),
                'button' => array(
                                    "name" => "Button",
                                    "identifier" => ".sp_popup_submit",
                                    "fields" => array(
                                        "back-color" => array("show" => true, "default" => "0f52ba"),
                                        "font-color" => array("show" => true, "default" => "FFFFFF"),
                                        "hover-color" => array("show" => true, "default" => "0d48a2"),
                                        "font-family" => array("show" => true, "default" => ""),
                                        "font-size" => array("show" => true, "default" => "20"),
                                        "text-content" => array(
                                            "show" => true,
                                            "buttontext" => array("name" => "Subscribe Button Text:", "identifier" => ".sp_popup_cta_submit_text"),
                                            "continueButtonText" => array("name" => "Continue Button Text:", "identifier" => ".sp_popup_cta_continue_text"),
                                        )
                                    ),
                                ),
            ),
    );


    public $form_keys = array(
        "background" => array("back-color","width"),
        "title" => array("font-color","font-family","font-size","text-bold","text-italic","text-decoration","text-align"),
        "top-text" => array("font-color","font-family","font-size","text-bold","text-italic","text-decoration","text-align"),
        "error-msg" => array("font-color","font-family","font-size","text-bold","text-italic","text-decoration","text-align"),
        "success-msg" => array("font-color","font-family","font-size","text-bold","text-italic","text-decoration","text-align"),
        "close" => array("font-color"),
        "input-text" => array("back-color","font-color","font-family","font-size","placeholder-color"),
        "button" => array("back-color","font-color","hover-color","font-family","font-size"),
        "footer" => array("back-color","font-color","font-family","font-size"),
        "show-field" => array("back-color","font-color"),
    );
    
    public $inline_cta_instance = array(
        "emailPlaceholder" => "Email",
        "firstNamePlaceholder" => "First Name",
        "lastNamePlaceholder" => "Last Name",
        "phonePlaceholder" => "Phone",
        "companyPlaceholder" => "Company",
    );


    public $css_options = array(
        "scrollbox"  => "spokal_sbx_custom_style",
        "smartbar" => "spokal_smb_custom_style",
        "exitintent" => "spokal_ei_custom_style",
        "inlineCta" => "spokal_icta_custom_style"
    );


    public function __construct()
    {
        add_action('wp_ajax_sp_style_cta', array(&$this, 'renderStyleSettings'));
        add_action('wp_ajax_handle_sp_style_cta_content', array(&$this, 'handleSpStyleCtaContent'));
    }




    public function handleSpStyleCtaContent()
    {
        $content = stripslashes_deep($_POST);
        $cta = $content['cta'];
        switch ($content['cta']){
            case "scrollbox":
                $option = "spokal_sbx_custom_style";
                break;
            case "smartbar":
                $option = "spokal_smb_custom_style";
                break;
            case "exitintent":
                $option = "spokal_ei_custom_style";
                break;
            case "inlineCta":
                $option = "spokal_icta_custom_style";
                break;
            default:
                $option = "";
        } 
        
        //Gettings css fields and saving in to array
        $instance = array();
        foreach($this->form_keys as $name => $field){
            foreach($field as $f_name){
                if(isset($content[$name."-".$f_name]) && !empty($content[$name."-".$f_name])){
                    $instance[$name][$f_name] = $content[$name."-".$f_name];
                }
            }
        }
        
        //Gettings CTA content and saving it to array
        $instance_content = $this->updateCtaContent($cta,$content);
        
        //Handling case for Spokal Widget becasue we can't manualy save values in database
        //It needs to be done from widget form, so we are returning data and saving it to hidden inputs in widget settings
        if($content['cta'] == "spokalwidget"){
            $resultarray = array(
                'status' => true,
                'css' => base64_encode(json_encode($instance)),
                'content' => base64_encode(json_encode($instance_content)),
            );
            header('Content-type: application/json');
            echo json_encode($resultarray);
            die();
        }elseif($content['cta'] == "sppopup"){
            $popup_name = isset($content['popup_name']) ? $content['popup_name'] : "";
            $response = SpokalPopup::saveSpokalPopup($instance_content,$instance,$content['popup_id'],$popup_name);
            $append = '<tr class="sp_popups_list" id="sp_popup_row_'.$response["id"].'">
                                    <td>
                                        <span title="Preview" onclick="previewPopup('.$response["id"].')" class="popup_title">'.get_the_title($response["id"]).'</span>
                                    </td>
                                    <td>
                                        <div style="float: left;" class="" title="Edit Popup">
                                            <form action="" method="post" name="sp_style_cta_form" id="sp_style_cta_form" class="sp_style_cta_form">
                                                <input type="hidden" name="action" value="sp_style_cta">
                                                <input type="hidden" name="style_file" value="'.SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css">
                                                <input type="hidden" name="sp_cta" value="sppopup">
                                                <input type="hidden" name="boxId" value="box8-5">
                                                <input type="hidden" name="popup_id" value="'.$response["id"].'">
                                                <input type="hidden" name="version" value="">
                                                <input class="popup_edit" type="submit" name="submit_cta" value=""> 
                                                <div style="clear:both;"></div>
                                            </form>
                                        </div>
                                        <div title="Delete Popup" style="float: left;" class="popup_delete" onclick="deleteSpPopup('.$response["id"].',\'sp_popup_row_'.$response["id"].'\')"></div>
                                        <div style="clear:both;"></div>
                                    </td>
                                </tr>';
            
            $popup_select = $this->render_popup_select();
            
            $resultarray = array(
                'status' => true,
                "popup_id" => $response["id"],
                "popup_action" => $response["action"],
                "append" => $append,
                "popup_select" => $popup_select
            );
            header('Content-type: application/json');
            echo json_encode($resultarray);
            die();
        }
        
        //Saving css in database for ScrollBox, SmartBar or ExitIntent
        update_option($option,$instance);
        
        //Merging content with other fields for ScrollBox, SmartBar or ExitIntent and updating databse
        if(array_key_exists ($cta, $this->options_calback)){
            $oldInstance = call_user_func($this->options_calback[$cta]);
        }elseif($cta === "inlineCta"){
            $oldInstance = get_option("spokal_inlineCta_ph",array());
        }
        $instance_content = array_merge($oldInstance,$instance_content);
        update_option($this->db_options[$cta], $instance_content);
                
        $resultarray = array(
            'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    public function render_popup_select()
    {
        extract(SpokalVars::getInstance()->ExitIntentOptions);
        $popups = SpokalPopup::get_popups();
        
        $select = "";
        
        if(is_array($popups) && !empty($popups) ){ 
            $select = '<select id="exit_intent_popups" name="ei_popup" ><option value="">Choose Popup</option>';
            foreach($popups as $popup){ 
                $checked = ($popup->ID == $ei_popup) ? "selected" : "";
                $select .= '<option '.$checked.' value="'.$popup->ID.'">'.$popup->post_title.'</option>';
            } 
            $select .= '</select>';
        }else{
            $select .= '<span id="exit_intent_popups" ><br>You haven\'t created any popups. Click <a href="'.admin_url("admin.php?page=spokal_options&sp_tab=tab8-5").'">here</a> here to create one now.</span>';
        } 
        return $select;
    }
    
    
    /*
     * Gettings CTA content from Popup styler and returning it as array
     * @param string $cta  Name of string
     * @param array $content   POST data from popup styler CTA
     */
    public function updateCtaContent($cta,$content)
    {
        if(isset($content['title-text']) ){
            $newInstance['title'] = $content['title-text'];
        }
        
        if(isset($content['top-text-text'])){
            $newInstance['toptext'] = $content['top-text-text'];
        }
        
        if(isset($content['button-buttontext-text'])){
            $newInstance['buttontext'] = $content['button-buttontext-text'];
        }
        
        if(isset($content['button-continueButtonText-text'])){
            $newInstance['continueButtonText'] = $content['button-continueButtonText-text'];
        }
        
        if(isset($content['error-msg-email-text'])){
            $newInstance['invalidEmailMsg'] = $content['error-msg-email-text'];
        }
        
        if(isset($content['error-msg-fail-text'])){
            $newInstance['failmsg'] = $content['error-msg-fail-text'];
        }
        
        if(isset($content['success-msg-text'])){
            $newInstance['successmsg'] = $content['success-msg-text'];
        }
        
        if(isset($content['lead-fields-em-ph-text'])){
            $newInstance['emailPlaceholder'] = $content['lead-fields-em-ph-text'];
        }
        
        if(isset($content['lead-fields-fn-ph-text'])){
            $newInstance['firstNamePlaceholder'] = $content['lead-fields-fn-ph-text'];
        }
        
        if(isset($content['lead-fields-ln-ph-text'])){
            $newInstance['lastNamePlaceholder'] = $content['lead-fields-ln-ph-text'];
        }
        
        if(isset($content['lead-fields-ph-ph-text'])){
            $newInstance['phonePlaceholder'] = $content['lead-fields-ph-ph-text'];
        }
        
        if(isset($content['lead-fields-cm-ph-text'])){
            $newInstance['companyPlaceholder'] = $content['lead-fields-cm-ph-text'];
        }
        
        
        
        if ( isset( $content[ 'collect_fname' ] ) ) {
            $newInstance[ 'collectfirstname' ] = true;
        }else{
            $newInstance[ 'collectfirstname' ] = false;
        }
        
        if ( isset( $content[ 'spokalShowProgress' ] ) ) {
            $newInstance[ 'spokalShowProgress' ] = true;
        }else{
            $newInstance[ 'spokalShowProgress' ] = false;
        }
        
        if ( isset( $content[ 'collect_lname' ] ) ) {
            $newInstance[ 'collectlastname' ] = true;
        }else{
            $newInstance[ 'collectlastname' ] = false;
        }
        
        if ( isset( $content[ 'collect_phone' ] ) ) {
            $newInstance[ 'collectphone' ] = true;
        }else{
            $newInstance[ 'collectphone' ] = false;
        }
        
        if ( isset( $content[ 'collect_company' ] ) ) {
            $newInstance[ 'collectcompany' ] = true;
        }else{
            $newInstance[ 'collectcompany' ] = false;
        }
        
        if(isset($content[ 'sp_exit_intent_image' ])) {
            $newInstance[ 'exitIntentLogo' ] = $content[ 'sp_exit_intent_image' ];
        }
        
        return $newInstance;
    }
    
    
    
    /*
     * Rendering settings for Popup Cta Styler
     */
    public function renderStyleSettings()
    {
        $this->prepare();
        
        ob_start();
        $this->renderHtml();
        $html = ob_get_contents();
        ob_end_clean();
        
        $height = (($this->cta === "inlineCta") || $this->cta === "sppopup") ? "700px" : false;
        
        $resultarray = array(
            'status' => true,
            'html' => $html,
            'appender' => $_POST['boxId'],
            "height" => $height
        );
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    /*
     * Preparing data for rendering settings for specific CTA
     */
    public function prepare()
    {
        
        $this->cta = (isset($_POST['sp_cta'])) ? $_POST['sp_cta'] : "";
        $this->style_file = (isset($_POST['style_file'])) ? $_POST['style_file'] : "";
        $this->cta_name = (isset($this->cta)) ? $this->cta_names[$this->cta] : "";
        
        if($this->cta == "sppopup"){
//            SpokalPopup::init()->createEditPopup();
        }
        
        if(array_key_exists ($this->cta, $this->options_calback)){
            $this->cta_instance = call_user_func($this->options_calback[$this->cta]);
        }elseif(isset($_POST["sp_widget_instace"])){
            $this->cta_instance = json_decode(base64_decode($_POST["sp_widget_instace"]),true);
        }elseif($this->cta === "inlineCta"){
            $instance = get_option("spokal_inlineCta_ph",false);
            $this->cta_instance = $instance ? $instance : $this->inline_cta_instance;
        }
        
        
        //Handling case when it's Spokal Widget. Gettings ID's of hidden fields to save custom css and content
        $this->swg_css = (isset($_POST["swg_css"])) ? $_POST["swg_css"] : "";
        $this->swg_content = (isset($_POST["swg_content"])) ? $_POST["swg_content"] : "";
        
        if($this->cta === "spokalwidget"){
            $this->versions[$this->cta]["form"] = "#myForm_".$this->cta_instance['widget_id'];
            $this->versions[$this->cta]["message"] = "#result_".$this->cta_instance['widget_id']."_succes";
            $this->css_from_db = json_decode(base64_decode($this->cta_instance["custom_css"]),true);
        }elseif($this->cta == "sppopup"){
            $this->css_from_db = SpokalPopup::init()->getSpokalPopupCss();
        }else{
            $this->css_from_db = get_option($this->css_options[$this->cta],false);
        }
        
        
        switch ($this->cta){
            case "scrollbox":
                $this->force_style = "#spokalScrollBoxShowOnScrole{position: absolute !important; display: block !important; z-index:99 !important;}";
                break;
            case "smartbar":
                $this->force_style = "#spokalSmartBarShowOnScrole{position: absolute !important; display: block !important; z-index:99 !important;}";
                break;
            case "exitintent":
                $this->force_style = "#sp_exit_intent_overlay{position: absolute !important; display: block !important; z-index:99 !important;}";
                break;
            case "sppopup":
                $this->force_style = ".sp_popup_overlay{position: absolute !important; display: block !important; z-index:99 !important;} .sp_popup_wrapp{top: 5%;}";
                break;
            default:
                $this->force_style = "";
        }
    }
    
    
    
    /*
     * Rendering HTML of Popup Cta Styler
     */
    public function renderHtml()
    { ?>
        <div id="sp_inline_cta-<?php echo $this->cta; ?>" class="sp_inline_cta">
            <?php 
//            $this->renderTempCss();
            $this->renderStyleCtaJs();
            ?>
            <div class="title" style="position: relative;">
                Customize <?php echo $this->cta_name; ?>
                <div class="closeStyleCta" onclick="closeStyleCta('sp_inline_cta-<?php echo $this->cta; ?>')"></div>                
                <div class="version-tabs">
                    <span id="subsctibe-<?php echo $this->cta; ?>" class="active-sub subscribe-tab" onclick="spSwitchWersions(this,'success-<?php echo $this->cta; ?>','<?php echo $this->versions[$this->cta]["form"]; ?>','<?php echo $this->versions[$this->cta]["message"]; ?>','<?php echo $this->versions[$this->cta]["button"]; ?>','<?php echo $this->cta; ?>')">Subscribe</span>
                    <span id="success-<?php echo $this->cta; ?>" class="success-tab" onclick="spSwitchWersions(this,'subsctibe-<?php echo $this->cta; ?>','<?php echo $this->versions[$this->cta]["form"]; ?>','<?php echo $this->versions[$this->cta]["message"]; ?>','<?php echo $this->versions[$this->cta]["button"]; ?>','<?php echo $this->cta; ?>')">Success</span>
                </div>
            </div>
            
            <div class="settings">
                <div style="padding-left: 10px; padding-right: 10px;">
                    <form action="" method="post" name="sp_style_cta_conten" id="sp_style_cta_conten">
                        <input type="hidden" name="action" value="handle_sp_style_cta_content">
                        <input type="hidden" name="cta" value="<?php echo $this->cta; ?>">
                        <?php if(isset($_POST["popup_id"]))echo '<input type="hidden" name="popup_id" value="'.$_POST["popup_id"].'">'; ?>
                        <?php $this->renderSettings(); ?>
                        <?php 
                            if($this->cta === "spokalwidget"){
                                echo '<p style="float:right;"><input type="submit" name="saveCtaChanges" class="button button-primary" value="Save Changes"></p>';
                            }else{
                                SpokalAdminView::submitButton('Save Changes','style_cta','primary');
                            }
                        ?>
                        <div style="float:right; margin: 1em 0;" class="spinner-container">
                            <span id="sp_style_cta_conten_spiner"  class="sp_spinner sp_style_cta_conten_spiner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
            
            <div class="cta_wrapp">
                <div id="<?php echo $this->cta.'-button-hover'; ?>"></div>
                <div id="<?php echo $this->cta.'-button-placeholder'; ?>"></div>
                <?php $this->renderCta(); ?>
            </div>
            
            <div style="clear:both;"></div>
            <div class="title bottom-title">Customize <?php echo $this->cta_name; ?></div>
        </div>  
<?php }
    
    
    
    /*
     * Rendering Html of current CTA
     */
    public function renderCta()
    {
//        $style = "";
//        if(is_readable($this->style_file)){
//            $style = file_get_contents($this->style_file);
//        }
        
        ?>
        <style type="text/css">
            <?php // echo $style; ?>
            <?php echo $this->force_style; ?>
        </style>
        <?php
        if(isset($this->cta)){
            if(array_key_exists ($this->cta, $this->callbacks)){
                $param = (isset($_POST["sp_widget_instace"])) ? $_POST["sp_widget_instace"] : true;
                call_user_func($this->callbacks[$this->cta],$param);
            }
        }
    }
    
    
    
    /*
     * Renderign settings fields
     */
    public function renderSettings()
    { 
        foreach($this->settings[$this->cta] as $key => $value){
            echo "<div class='cta_opt_wrap' style='padding-bottom: 10px; border-bottom: 1px dotted #395997;'>";
            echo '<h3 class="settings-header">'.$value["name"].'</h3>';
            
            $this->renderPopupName($key, $value);

            $this->renderColorField($key, $value);
            
            if(isset($value["fields"]["width"])){
                $this->renderFieldWidth($key, $value);
            }
            
            if(isset($value["fields"]["show-field"])){
                $this->renderCheckBox($key, $value);
            }
            
            if($value["fields"]["font-family"]["show"]){
                $this->renderFontFamily($key, $value);
            }
            
            if($value["fields"]["font-size"]["show"] && ($key !== "footer")){
                $this->renderFontSize($key, $value);
            }
            
            if($value["fields"]["text-content"]["show"]){
                $this->textContentField($key, $value);
            }
            
            if(isset($value["fields"]["error"])){
                $this->errorMessagesField($key, $value);
            }
            

            if(isset($value["fields"]["word-buttons"])){
                echo '<div class="cta-setting-field">';
                if(isset($value["fields"]["text-bold"])){
                    $this->textBoldField($key, $value);
                }

                if(isset($value["fields"]["text-italic"])){
                    $this->textItalicField($key, $value);
                }

                if(isset($value["fields"]["text-decoration"])){
                    $this->textDecorationField($key, $value);
                }

                if(isset($value["fields"]["text-align"])){
                    $this->textAlignField($key, $value);
                }
                echo '</div>';
            }
            
            if($key === "lead-fields"){
                $this->leadFields($key, $value);
            }
            
            if($key === "image"){
                $this->uploadImageField($key, $value);
            }
            echo "</div>";
        }
    }
    
    
    public function renderCheckBox($key, $value){ 
        extract($this->cta_instance); ?>
        <div class="cta-setting-field">
            <input type="checkbox" class="checkbox"  name="spokalShowProgress"  <?php echo  checked($spokalShowProgress, true, false); ?> onchange="spShowField(this,'<?php echo $value["fields"]["show-field"]["identifier"]?>')" />
            <label class="option-label" ><?php _e( 'Show Progress Bar' ); ?></label>
        </div>
<?php }
    
    
    public function renderPopupName($key, $value){
        if($key == "popup_name"){ 
            $val = (isset($_POST["popup_id"]) && $_POST["popup_id"] != "new") ? get_the_title($_POST["popup_id"]) : "";
            ?>
            <div class="cta-setting-field">
                <input type="text" class="cta-form-element" name="<?php echo $key; ?>"  value="<?php echo esc_attr($val); ?>">
            </div>
        <?php
        }
    }
    
    
    
    public function uploadImageField($key, $value)
    {
        extract($this->cta_instance);
        ?>
        <div class="cta-setting-field spokal_buttons" style="float: none;">
            <input id="sp_exit_intent_image" class="form-element sp_ei_image_url" type="text" size="36" name="sp_exit_intent_image" value="<?php echo $spokalPopupLogo; ?>" onchange="setEiImageCta(this.value)">
            <input id="sp_exit_intent_image_button" class="sp_image_upload_button btn spokal_submit spokal-primary" type="button" value="Upload Image">
        </div> 
<?php }
    
    
    
    
    public function leadFields($key, $value)
    { 
        extract($this->cta_instance); ?>
        
        <div class="cta-setting-field">
            <label>Email Placeholder:</label>
            <input type="text" class="cta-form-element" name="<?php echo $key; ?>-em-ph-text"  onchange="spPlaceholderText(this.value,'<?php echo $value["identifier"]; ?>')" onkeyup="spPlaceholderText(this.value,'<?php echo $value["identifier"]; ?>')" value="<?php echo esc_attr($emailPlaceholder); ?>">
        </div>
        
        <?php
        if(isset($value["fields"]["first-name"])){ 
            $display = ($collectfirstname || ($this->cta == "inlineCta")) ? "" : "display:none;"; 
            if($this->cta !== "inlineCta" ){ ?>
                <div class="cta-setting-field">
                    <input type="checkbox" class="checkbox"  name="collect_fname"  <?php echo  checked($collectfirstname, true, false); ?> onchange="spHandlePH(this,'#<?php echo $key.'-fn-ph-text'; ?>','<?php echo $value["fields"]["first-name"]["identifier"]; ?>','<?php echo $this->cta; ?>')" />
                    <label class="option-label" for="scrolBoxFirstName"><?php _e( 'First name' ); ?></label>
                </div>
      <?php } ?>
            <div id="<?php echo $key.'-fn-ph-text'; ?>" class="cta-setting-field" style="<?php echo $display; ?>">
                <label>First Name Placeholder:</label>
                <input type="text" class="cta-form-element" name="<?php echo $key; ?>-fn-ph-text"  onchange="spPlaceholderText(this.value,'<?php echo $value["fields"]["first-name"]["identifier"]; ?>')" onkeyup="spPlaceholderText(this.value,'<?php echo $value["fields"]["first-name"]["identifier"]; ?>')" value="<?php echo esc_attr($firstNamePlaceholder); ?>">
            </div>
            
  <?php }
        
        if(isset($value["fields"]["last-name"])){ 
            $display = ($collectlastname || ($this->cta == "inlineCta")) ? "" : "display:none;";
            if($this->cta !== "inlineCta" ){ ?>
                <div class="cta-setting-field">
                    <input type="checkbox" class="checkbox"  name="collect_lname"  <?php echo  checked($collectlastname, true, false); ?> onchange="spHandlePH(this,'#<?php echo $key.'-ln-ph-text'; ?>','<?php echo $value["fields"]["last-name"]["identifier"]; ?>','<?php echo $this->cta; ?>')"/>
                    <label class="option-label" for="scrolBoxFirstName"><?php _e( 'Last name' ); ?></label>
                </div>
      <?php } ?>
            <div id="<?php echo $key.'-ln-ph-text'; ?>" class="cta-setting-field" style="<?php echo $display; ?>">
                <label>Last Name Placeholder:</label>
                <input type="text" class="cta-form-element" name="<?php echo $key; ?>-ln-ph-text"  onchange="spPlaceholderText(this.value,'<?php echo $value["fields"]["last-name"]["identifier"]; ?>')" onkeyup="spPlaceholderText(this.value,'<?php echo $value["fields"]["last-name"]["identifier"]; ?>')" value="<?php echo esc_attr($lastNamePlaceholder); ?>">
            </div>
  <?php }
        
        if(isset($value["fields"]["phone"])){ 
            $display = ($collectphone || ($this->cta == "inlineCta")) ? "" : "display:none;";
            if($this->cta !== "inlineCta" ){ ?>
                <div class="cta-setting-field">
                    <input type="checkbox" class="checkbox"  name="collect_phone"  <?php echo  checked($collectphone, true, false); ?>  onchange="spHandlePH(this,'#<?php echo $key.'-ph-ph-text'; ?>','<?php echo $value["fields"]["phone"]["identifier"]; ?>','<?php echo $this->cta; ?>')" />
                    <label class="option-label" for="scrolBoxFirstName"><?php _e( 'Phone' ); ?></label>
                </div>
      <?php } ?>
            <div id="<?php echo $key.'-ph-ph-text'; ?>" class="cta-setting-field" style="<?php echo $display; ?>">
                <label>Phone Placeholder:</label>
                <input type="text" class="cta-form-element" name="<?php echo $key; ?>-ph-ph-text"  onchange="spPlaceholderText(this.value,'<?php echo $value["fields"]["phone"]["identifier"]; ?>')" onkeyup="spPlaceholderText(this.value,'<?php echo $value["fields"]["phone"]["identifier"]; ?>')" value="<?php echo esc_attr($phonePlaceholder); ?>">
            </div>
  <?php }
  
        if(isset($value["fields"]["company"])){ 
            $display = ($collectcompany || ($this->cta == "inlineCta")) ? "" : "display:none;";
            if($this->cta !== "inlineCta" ){ ?>
                <div class="cta-setting-field">
                    <input type="checkbox" class="checkbox"  name="collect_company"  <?php echo  checked($collectcompany, true, false); ?> onchange="spHandlePH(this,'#<?php echo $key.'-cm-ph-text'; ?>','<?php echo $value["fields"]["company"]["identifier"]; ?>','<?php echo $this->cta; ?>')"/>
                    <label class="option-label" for="scrolBoxFirstName"><?php _e( 'Company' ); ?></label>
                </div>
      <?php } ?>
            <div id="<?php echo $key.'-cm-ph-text'; ?>" class="cta-setting-field" style="<?php echo $display; ?>">
                <label>Company Placeholder:</label>
                <input type="text" class="cta-form-element" name="<?php echo $key; ?>-cm-ph-text"  onchange="spPlaceholderText(this.value,'<?php echo $value["fields"]["company"]["identifier"]; ?>')" onkeyup="spPlaceholderText(this.value,'<?php echo $value["fields"]["company"]["identifier"]; ?>')" value="<?php echo esc_attr($companyPlaceholder); ?>">
            </div>
  <?php } ?>
<?php }
    
    
    
    
    public function textBoldField($key, $value)
    {
        $bold = (isset($this->css_from_db[$key]["text-bold"])) ? $this->css_from_db[$key]["text-bold"] : $value["fields"]["text-bold"]["default"];
        $bold_img = ($bold == "bold") ? "images/fonts/bold_a.gif" : "images/fonts/bold.gif"; ?>
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-bold"; ?>" name="bold" src="<?php echo SpokalVars::getInstance()->pluginUrl.$bold_img; ?>" onclick="spbold(this,'<?php echo $value["identifier"]; ?>','<?php echo "#".$this->cta.$key."-input-bold"; ?>')">
        <input type="hidden" id="<?php echo $this->cta.$key."-input-bold"; ?>" value="<?php echo $bold;?>" name="<?php echo $key."-text-bold"; ?>">
<?php }
    
    
    
    
    public function textItalicField($key, $value)
    {
        $italic = (isset($this->css_from_db[$key]["text-italic"])) ? $this->css_from_db[$key]["text-italic"] : "";
        $italic_img = ($italic == "italic") ? "images/fonts/italic_a.gif" : "images/fonts/italic.gif"; ?>
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-italic"; ?>" name="italic" src="<?php echo SpokalVars::getInstance()->pluginUrl.$italic_img; ?>" onclick="spitalic(this,'<?php echo $value["identifier"]; ?>','<?php echo "#".$this->cta.$key."-input-italic"; ?>')">
        <input type="hidden" id="<?php echo $this->cta.$key."-input-italic"; ?>" value="<?php echo $italic;?>" name="<?php echo $key."-text-italic"; ?>">
<?php }
    
    
    
    
    public function textDecorationField($key, $value)
    {
        $uline = (isset($this->css_from_db[$key]["text-decoration"])) ? $this->css_from_db[$key]["text-decoration"] : $value["fields"]["text-decoration"]["default"];
        $uline_img = ($uline == "underline") ? "images/fonts/uline_a.gif" : "images/fonts/uline.gif";
        $sthrough_img = ($uline == "line-through") ? "images/fonts/sthrough_a.gif" : "images/fonts/sthrough.gif";
        ?>
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-uline"; ?>" name="uline" src="<?php echo SpokalVars::getInstance()->pluginUrl.$uline_img; ?>" onclick="spuline(this,'<?php echo $value["identifier"]; ?>','<?php echo $this->cta.$key."-sthrough"; ?>','<?php echo "#".$this->cta.$key."-input-uline"; ?>')">
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-sthrough"; ?>" name="sthrough" src="<?php echo SpokalVars::getInstance()->pluginUrl.$sthrough_img; ?>" onclick="spsthrough(this,'<?php echo $value["identifier"]; ?>','<?php echo $this->cta.$key."-uline"; ?>','<?php echo "#".$this->cta.$key."-input-uline"; ?>')">				
        <input type="hidden" id="<?php echo $this->cta.$key."-input-uline"; ?>" value="<?php echo $uline;?>" name="<?php echo $key."-text-decoration"; ?>">
<?php }
    
    
    
    
    public function textAlignField($key, $value)
    {
        
        $align = (isset($this->css_from_db[$key]["text-align"])) ? $this->css_from_db[$key]["text-align"] : $value["fields"]["text-align"]["default"];
        $left_img = ($align == "left") ? "images/fonts/left_a.gif" : "images/fonts/left.gif";
        $center_img = ($align == "center") ? "images/fonts/center_a.gif" : "images/fonts/center.gif";
        $right_img = ($align == "right") ? "images/fonts/right_a.gif" : "images/fonts/right.gif"; 
        ?>
        
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-left-align"; ?>" name="left" src="<?php echo SpokalVars::getInstance()->pluginUrl.$left_img; ?>" onclick="spleft(this,'<?php echo $value["identifier"]; ?>','<?php echo $this->cta.$key."-center-align"; ?>','<?php echo $this->cta.$key."-right-align"; ?>','<?php echo "#".$this->cta.$key."-input-align"; ?>')">
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-center-align"; ?>" name="center" src="<?php echo SpokalVars::getInstance()->pluginUrl.$center_img; ?>" onclick="spcenter(this,'<?php echo $value["identifier"]; ?>','<?php echo $this->cta.$key."-left-align"; ?>','<?php echo $this->cta.$key."-right-align"; ?>','<?php echo "#".$this->cta.$key."-input-align"; ?>')">
        <input class="image-style-button" type="image" id="<?php echo $this->cta.$key."-right-align"; ?>" name="right" src="<?php echo SpokalVars::getInstance()->pluginUrl.$right_img; ?>" onclick="spright(this,'<?php echo $value["identifier"]; ?>','<?php echo $this->cta.$key."-center-align"; ?>','<?php echo $this->cta.$key."-left-align"; ?>','<?php echo "#".$this->cta.$key."-input-align"; ?>')">
        <input type="hidden" id="<?php echo $this->cta.$key."-input-align"; ?>" value="<?php echo $align;?>" name="<?php echo $key."-text-align"; ?>">
<?php }
    
    
    
    
    public function renderFieldWidth($key, $value)
    { 
        if(is_array($this->css_from_db) && isset($this->css_from_db[$key]["width"])){
            $def_value = $this->css_from_db[$key]["width"];
        }else{
            $def_value = $value["fields"]["width"]["default"];
        }
        ?>
      <div class="cta-setting-field">
        <label class="option-label">Width:</label><br>
        <input class="cta-form-element" style="width: 60px;" type="number" value="<?php echo $def_value; ?>" name="<?php echo $key; ?>-width" max="<?php echo $value["fields"]["width"]["max"]; ?>" maxlength="3" onchange="spFieldWidth(this,'<?php echo $value["identifier"]; ?>')" onkeyup="spFieldWidth(this.value,'<?php echo $value["identifier"]; ?>')">
        <label class="option-label">px</label>
    </div>  
<?php }
    
    
    
    
    public function renderColorField($key,$value)
    { 
        if($value["fields"]["back-color"]["show"]){
            if(is_array($this->css_from_db) && isset($this->css_from_db[$key]["back-color"])){
                $def_value = $this->css_from_db[$key]["back-color"];
            }else{
                $def_value = $value["fields"]["back-color"]["default"];
            }
            ?>
            <div class="cta-setting-field">
                <label class="option-label">Background Color:</label>
                <div class="colorSelector" js_style="backgroundColor" input-atr="<?php echo $this->cta.$key; ?>-input-back-color" el-style="<?php echo $value["identifier"]; ?>" style="background-color: #<?php echo $def_value; ?>;">
                    <div class="sp_arrow_wrapp"><span class="sp_arrow"></span></div>
                    <input class="<?php echo $this->cta.$key; ?>-input-back-color" type="hidden" name="<?php echo $key; ?>-back-color" value="<?php echo $def_value; ?>">
                </div>
            </div>
  <?php }
        
        if($value["fields"]["font-color"]["show"]){ 
            if(is_array($this->css_from_db) && isset($this->css_from_db[$key]["font-color"])){
                $def_value = $this->css_from_db[$key]["font-color"];
            }else{
                $def_value = $value["fields"]["font-color"]["default"];
            }
            if($key == "show-field"){
                $ident =  $value["fields"]["font-color"]["identifier"];
            }else{
                $ident =  $value["identifier"];
            }
            ?>
            <div class="cta-setting-field">
                <label class="option-label"><?php echo ($key == "close") ? "Color:" : "Font Color:"; ?></label>
                <div class="colorSelector" js_style="color" input-atr="<?php echo $this->cta.$key; ?>-input-font-color" el-style="<?php echo $ident; ?>" style="background-color: #<?php echo $def_value; ?>;">
                    <div class="sp_arrow_wrapp"><span class="sp_arrow"></span></div>
                    <input class="<?php echo $this->cta.$key; ?>-input-font-color" type="hidden" name="<?php echo $key; ?>-font-color" value="<?php echo $def_value; ?>">
                </div>
            </div>
  <?php }
        
        if(isset($value["fields"]["placeholder-color"]["show"])){ 
                if(is_array($this->css_from_db) && isset($this->css_from_db[$key]["placeholder-color"])){
                    $def_value = $this->css_from_db[$key]["placeholder-color"];
                }else{
                    $def_value = $value["fields"]["placeholder-color"]["default"];
                }
                ?>
                <div class="cta-setting-field">
                    <label class="option-label">Placeholder Color:</label>
                    <div class="colorSelector" output="<?php echo $this->cta.'-button-placeholder'; ?>" js_style="placeholder" input-atr="<?php echo $this->cta.$key; ?>-input-placeholder-color" el-style="<?php echo $value["identifier"]; ?>" style="background-color: #<?php echo $def_value; ?>;">
                        <div class="sp_arrow_wrapp"><span class="sp_arrow"></span></div>
                        <input class="<?php echo $this->cta.$key; ?>-input-placeholder-color" type="hidden" name="<?php echo $key; ?>-placeholder-color" value="<?php echo $def_value; ?>">
                    </div>
                </div>
  <?php }
        
        if(isset($value["fields"]["hover-color"]["show"])){ 
            if(is_array($this->css_from_db) && isset($this->css_from_db[$key]["hover-color"])){
                $def_value = $this->css_from_db[$key]["hover-color"];
            }else{
                $def_value = $value["fields"]["hover-color"]["default"];
            }
            ?>
            <div class="cta-setting-field">
                <label class="option-label">Hover Color:</label>
                <div class="colorSelector" output="<?php echo $this->cta.'-button-hover'; ?>" js_style="hover" input-atr="<?php echo $this->cta.$key; ?>-input-hover-color" el-style="<?php echo $value["identifier"]; ?>" style="background-color: #<?php echo $def_value; ?>;">
                    <div class="sp_arrow_wrapp"><span class="sp_arrow"></span></div>
                    <input class="<?php echo $this->cta.$key; ?>-input-hover-color" type="hidden" name="<?php echo $key; ?>-hover-color" value="<?php echo $def_value; ?>">
                </div>
            </div>
  <?php }
        
    }
    
    
    
    
    public function renderFontFamily($key, $value)
    { 
        $fonts = array(
                0 => array("name" => "Courier","font" => "courier, &quot;courier new&quot;, monospace"),
                1 => array("name" => "Georgia","font" => "georgia, serif"),
                2 => array("name" => "Palatino","font" => "&quot;palatino linotype&quot;, palatino, serif"),
                3 => array("name" => "Times New Roman","font" => "&quot;times new roman&quot;, times, serif"),
                4 => array("name" => "Arial","font" => "arial, sans-serif"),
                5 => array("name" => "Helvetica","font" => "helvetica, sans-serif"),
                6 => array("name" => "Impact","font" => "impact, sans-serif"),
                7 => array("name" => "Lucida Sans","font" => "&quot;lucida sans unicode&quot;, &quot;lucida grande&quot;, sans-serif"),
                8 => array("name" => "Tahoma","font" => "&quot;Tahoma&quot;, &quot;Geneva&quot;, sans-serif"),
                9 => array("name" => "Trebuchet MS","font" => "&quot;trebuchet MS&quot;, sans-serif"),
                10 => array("name" => "Verdana","font" => "verdana, sans-serif"),
        );
        $def_value = (isset($this->css_from_db[$key]["font-family"])) ? $this->css_from_db[$key]["font-family"] : $value["fields"]["font-family"]["default"]; ?>
        <div class="cta-setting-field">
            <label class="option-label">Font style:</label><br>
            <select class="cta-select" name="<?php echo $key; ?>-font-family" onchange="spSetFontFamily(this.value,'<?php echo $value["identifier"]; ?>')">
                <option value="" >Select Font</option>
          <?php foreach($fonts as $font){ 
                    $selected = (html_entity_decode($def_value) === html_entity_decode($font["font"])) ? "selected" : ""; ?>
                    <option value="<?php echo $font["font"]; ?>" <?php echo $selected; ?> ><?php echo $font["name"]; ?></option>
          <?php } ?>
            </select>
        </div>
<?php }
    
    
    
    
    public function renderFontSize($key, $value)
    {
        if(is_array($this->css_from_db) && isset($this->css_from_db[$key]["font-size"])){
            $def_value = $this->css_from_db[$key]["font-size"];
        }else{
            $def_value = $value["fields"]["font-size"]["default"];
        }
        ?>
        <div class="cta-setting-field">
            <label class="option-label">Font Size:</label><br>
            <input class="cta-form-element" style="width: 60px;" type="number" value="<?php echo $def_value; ?>" name="<?php echo $key; ?>-font-size" maxlength="3" onchange="spSetFontSize(this.value,'<?php echo $value["identifier"]; ?>')" onkeyup="spSetFontSize(this.value,'<?php echo $value["identifier"]; ?>')">
            <label class="option-label">px</label>
        </div>
<?php }
    
    
    
    
    public function textContentField($key, $value)
    {
        if($key == "button"){
            $fields = $value["fields"]["text-content"];
            foreach($fields as $id => $field){
                $handler = (strpos($field["identifier"],"smb")) ? "" : "button";
                if($id === "show"){continue;}
                $val = $this->cta_instance[$id]; ?>
                <div class="cta-setting-field">
                    <label class="option-label"><?php echo $field['name']; ?></label><br>
                    <input type="text" class="cta-form-element" name="<?php echo $key."-".$id; ?>-text"  onchange="spTextContent(this.value,'<?php echo $field["identifier"]; ?>','<?php echo $handler; ?>')" onkeyup="spTextContent(this.value,'<?php echo $field["identifier"]; ?>','<?php echo $handler; ?>')" value="<?php echo esc_attr($val); ?>">
                </div>
      <?php }
            return false;
        }
        $handler = "";
        if($key == "title"){
            $val = $this->cta_instance["title"];
        }elseif($key == "top-text"){
            $val = $this->cta_instance["toptext"];
        }elseif($key == "success-msg"){
            $val = $this->cta_instance["successmsg"];
        }
        ?>
        <div class="cta-setting-field">
            <label class="option-label">Text:</label><br>
            <?php if($key == "top-text"){ ?>
                    <textarea class="cta-form-element" name="<?php echo $key; ?>-text"  onchange="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" onkeyup="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')"><?php echo $val; ?></textarea>
            <?php }else{ ?>
                    <input type="text" class="cta-form-element" name="<?php echo $key; ?>-text"  onchange="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" onkeyup="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" value="<?php echo esc_attr($val); ?>">
            <?php } ?>
        </div>
        
<?php }




    public function errorMessagesField($key, $value)
    { 
        $handler = "";
        $val = (isset($this->cta_instance["invalidEmailMsg"])) ? $this->cta_instance["invalidEmailMsg"] : "";
        if(empty($val)){
            if(isset($this->cta_instance["invalidEmailMessage"])){
                $val = $this->cta_instance["invalidEmailMessage"];
            }
        }
        $val = (!empty($val)) ? $val : "Your email address does not appear valid.";
        
        $val2 = (isset($this->cta_instance["failmsg"])) ? $this->cta_instance["failmsg"] : "Failed to send your message. Please try later.";
        ?>
        <div class="cta-setting-field" >
            <input type="checkbox" id="<?php echo $key.'-checkbox-email'; ?>" class="checkbox" name="scrolBoxPhone" onchange="showElement('<?php echo $value["identifier"]; ?>',this,'<?php echo '#'.$key.'-text-email'; ?>','<?php echo '#'.$key.'-text-fail'; ?>','<?php echo '#'.$key.'-checkbox-fail'; ?>','<?php echo $this->cta; ?>');">
            <label class="option-label" for="scrolBoxPhone">Show Invalid Email Message</label>
        </div>
        <div class="cta-setting-field" style="display:none;">
            <label class="option-label">Text:</label><br>
            <input type="text" id="<?php echo $key.'-text-email'; ?>" class="cta-form-element" name="<?php echo $key; ?>-email-text"  onchange="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" onkeyup="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" value="<?php echo esc_attr($val); ?>">
        </div>
        
        <div class="cta-setting-field">
            <input type="checkbox" id="<?php echo $key.'-checkbox-fail'; ?>" class="checkbox" name="scrolBoxPhone" onchange="showElement('<?php echo $value["identifier"]; ?>',this,'<?php echo '#'.$key.'-text-fail'; ?>','<?php echo '#'.$key.'-text-email'; ?>','<?php echo '#'.$key.'-checkbox-email'; ?>','<?php echo $this->cta; ?>');">
            <label class="option-label" for="scrolBoxPhone">Show Default Fail Message</label>
        </div>
        <div class="cta-setting-field" style="display:none;">
            <label class="option-label">Text:</label><br>
            <input type="text" id="<?php echo $key.'-text-fail'; ?>" class="cta-form-element" name="<?php echo $key; ?>-fail-text"  onchange="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" onkeyup="spTextContent(this.value,'<?php echo $value["identifier"]; ?>','<?php echo $handler; ?>')" value="<?php echo esc_attr($val2); ?>">
        </div>
        
<?php }
    
    
    
    
    public function renderStyleCtaJs()
    { 
        if($this->cta === "spokalwidget"){ ?>
            <script type="text/javascript">
                function loadjscssfile(filename, filetype){
                    if (filetype === "js"){ //if filename is a external JavaScript file
                        var fileref=document.createElement('script');
                        fileref.setAttribute("type","text/javascript");
                        fileref.setAttribute("src", filename);
                    }
                    else if (filetype === "css"){ //if filename is an external CSS file
                        var fileref=document.createElement("link");
                        fileref.setAttribute("rel", "stylesheet");
                        fileref.setAttribute("type", "text/css");
                        fileref.setAttribute("href", filename);
                    }
                    if (typeof fileref != "undefined")
                        document.getElementsByTagName("head")[0].appendChild(fileref);
                }

                if(sp_already_loaded == "undefined"){
                    var sp_already_loaded = "false"
                }

                if(sp_already_loaded !== "true"){
                        loadjscssfile("<?php echo SpokalVars::getInstance()->pluginUrl.'addons/colorPicker/css/colpick.min.css'; ?>","css");
                        <?php echo file_get_contents(SpokalVars::getInstance()->pluginUrl.'addons/colorPicker/js/colpick.min.js'); ?>
                        sp_already_loaded = "true";
                }
            </script>
  <?php } ?>
        <script type="text/javascript">
            
            function spSetFontFamily(fontFamily,selector){
                if(selector.search("footer") === -1){
                    jQuery(selector).css("fontFamily",fontFamily);
                }else{
                    jQuery(selector + " a").css("fontFamily",fontFamily);
                }
            }
            
            function spSetFontSize(fontsize,selector){
                jQuery(selector).css("font-size",fontsize+ 'px');
            }
            
            function spFieldWidth(_this,selector){
                if(parseInt(_this.value) > parseInt(_this.max)){
                    var width = _this.max;
                    _this.value = _this.max;
                }else{
                    var width = _this.value;
                }

                jQuery(selector).css("width",width + 'px');
                if(selector === ".sp_exit_intent"){
                    jQuery(selector).css("margin-left","-"+parseInt(width)/2 + 'px');
                }
            }
            
            function spTextContent(text,selector,handler){
                if(handler === "button" ){
                    jQuery(selector).val(text);
                }else{
                    jQuery(selector).html(text);
                }
                
            }
            
            function spPlaceholderText(_placeh,selector){
                jQuery(selector).attr("placeholder", _placeh);
            }
            
            function spSwitchWersions(_this,second,form,message,button,cta){
                jQuery(_this).toggleClass("active-sub");
                jQuery("#"+ second).toggleClass("active-sub");
                
                if(jQuery(_this).hasClass("subscribe-tab")){
                    jQuery(form).show();
                    jQuery(message).hide();
                    jQuery(button).hide();
                }else{
                    jQuery(form).hide();
                    if(cta === "smartbar"){
                        jQuery(message).css("display","inline-block");
                    }else{
                        jQuery(message).show();
                    }
                    jQuery(button).show();
                }
            }
            
            function showElement(elem,checkbox,own,other,checkbox2,cta){  
                if (checkbox.checked) {
                    jQuery(elem).html(jQuery(own).val());
                    jQuery(elem).css("display","block");
                    if(cta !== "inlineCta"){
                        jQuery(other).parent().css("display","none");
                        jQuery(own).parent().css("display","block");
                    }
                    jQuery(checkbox2).attr('checked', false);
                } else {
                    if(cta !== "inlineCta"){
                        jQuery(own).parent().css("display","none");
                    }
                    jQuery(elem).css("display","none");
                }
            }
            
            function spHandlePH(_this,change_ph,field,cta){
                if (_this.checked) {
                    jQuery(change_ph).show();
                    if(cta === "smartbar"){
                        jQuery(field).css("display","inline-block");
                    }else{
                        jQuery(field).parent().show();
                    }
                }else{
                    jQuery(change_ph).hide();
                    if(cta === "smartbar"){
                        jQuery(field).hide();
                    }else{
                        jQuery(field).parent().hide();
                    }
                }
            }
            
            function spShowField(_this,field){
                if (_this.checked) {
                    jQuery(field).show();
                }else{
                    jQuery(field).hide();
                }
            }
            
            function closeStyleCta(element){
                jQuery("#" + element).remove();
            }
            
            function changeButtonHover(selector,color,output){
                var css= selector + ':hover{background-color:#'+ color + ' !important;}';
                style=document.createElement('style');
                if (style.styleSheet)
                    style.styleSheet.cssText=css;
                else 
                    style.appendChild(document.createTextNode(css));
                document.getElementById(output).appendChild(style);
            }
            
            function changeButtonPlaceholder(selector,color,output){
                var css= selector + '::-webkit-input-placeholder{color:#'+ color + ' !important;}';
                css += selector + ':-moz-placeholder{color:#'+ color + ' !important;}';
                css += selector + '::-moz-placeholder{color:#'+ color + ' !important;}';
                css += selector + ':-ms-input-placeholder{color:#'+ color + ' !important;}';
                style=document.createElement('style');
                if (style.styleSheet)
                    style.styleSheet.cssText=css;
                else 
                    style.appendChild(document.createTextNode(css));
                document.getElementById(output).appendChild(style);
            }
            
            function setEiImageCta(url){
                if(url){
                    var eiImg = document.getElementById("sp_popup_logo");
                    if(eiImg){
                        eiImg.src = url;
                    }else{
                        jQuery(".sp_popup_content").prepend('<img id="sp_popup_logo" class="sp_popup_logo" src="' + url +' " alt>');
                    }
                }else{
                    jQuery("#sp_popup_logo").remove();
                }
            }
            
            function spbold(_this,selector,input){
                var bold = _this;
                if(bold.src.match('bold.gif')){
                  bold.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/bold_a.gif';
                  jQuery(selector).css("font-weight","bold");
                  jQuery(input).val("bold");
                }else{
                  bold.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/bold.gif';
                  jQuery(selector).css("font-weight","normal");
                  jQuery(input).val("normal");
                }
            }

            function spitalic(_this,selector,input){
                var italic = _this;
                if(italic.src.match('italic.gif')){
                  italic.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/italic_a.gif';
                  jQuery(selector).css("font-style","italic");
                  jQuery(input).val("italic");
                }else{
                  italic.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/italic.gif';
                  jQuery(selector).css("font-style","");
                  jQuery(input).val("");
                }
            }

            function spuline(_this,selector,through,input){
                var sthrough = document.getElementById(through);
                if(_this.src.match('uline.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/uline_a.gif';
                  sthrough.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/sthrough.gif';
                  jQuery(selector).css("text-decoration","underline");
                  jQuery(input).val("underline");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/uline.gif';
                  jQuery(selector).css("text-decoration","");
                  jQuery(input).val("");
                }
                
                return false;
            }

            function spsthrough(_this,selector,uline,input){
                var suline = document.getElementById(uline);
                if(_this.src.match('sthrough.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/sthrough_a.gif';
                  suline.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/uline.gif';
                  jQuery(selector).css("text-decoration","line-through");
                  jQuery(input).val("line-through");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/sthrough.gif';
                  jQuery(selector).css("text-decoration","");
                  jQuery(input).val("");
                }
            }

            function spallcaps(_this,selector,other){
            
                var other = document.getElementById(other);
                if(_this.src.match('allcaps.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/allcaps_a.gif';
                  other.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/smallcaps.gif';
                  jQuery(selector).css("text-transform","uppercase");
                  jQuery(selector).css("font-variant","");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/allcaps.gif';
                  jQuery(selector).css("text-transform","");
                }
            }

            function spsmallcaps(_this,selector,other){
                var other = document.getElementById(other);
                if(_this.src.match('allcaps.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/smallcaps_a.gif';
                  other.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/allcaps.gif';
                  jQuery(selector).css("font-variant","small-caps");
                  jQuery(selector).css("text-transform","");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/smallcaps.gif';
                  jQuery(selector).css("font-variant","");
                }
            }

            function spleft(_this,selector,center,right,input){
            
                var center = document.getElementById(center);
                var right = document.getElementById(right);
                if(_this.src.match('left.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/left_a.gif';
                  center.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/center.gif';
                  right.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/right.gif';
                  jQuery(selector).css("text-align","left");
                  jQuery(input).val("left");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/left.gif';
                  jQuery(selector).css("text-align","");
                  jQuery(input).val("");
                }
            }

            function spcenter(_this,selector,left,right,input){
                var left = document.getElementById(left);
                var right = document.getElementById(right);
                if(_this.src.match('center.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/center_a.gif';
                  left.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/left.gif';
                  right.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/right.gif';
                  jQuery(selector).css("text-align","center");
                  jQuery(input).val("center");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/center.gif';
                  jQuery(selector).css("text-align","");
                  jQuery(input).val("");
                }
            }

            function spright(_this,selector,center,left,input){
                var center = document.getElementById(center);
                var left = document.getElementById(left);
                if(_this.src.match('right.gif')){
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/right_a.gif';
                  left.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/left.gif';
                  center.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/center.gif';
                  jQuery(selector).css("text-align","right");
                  jQuery(input).val("right");
                }else{
                  _this.src = '<?php echo SpokalVars::getInstance()->pluginUrl; ?>' + 'images/fonts/right.gif';
                  jQuery(selector).css("text-align","");
                  jQuery(input).val("");
                }
            }
            
            function spSetColorPicker($){
                $('.colorSelector').colpick({
                    layout:'hex',
                    submit:0,
                    onShow: function (colpkr) {
                            $(colpkr).fadeIn();
                            return false;
                    },
                    onHide: function (colpkr) {
                            $(colpkr).fadeOut();
                            return false;
                    },
                    onChange: function (hsb, hex, rgb,elem,sm) {
                        
                            var el_style = $(elem).attr("el-style");
                            var input_atr = $(elem).attr("input-atr");
                            var js_style = $(elem).attr("js_style");
                            
                            if((el_style.search("footer") > -1) && js_style == "color"){
                                $(el_style + " a").css(js_style, '#' + hex);
                            }else if(js_style == "hover"){
                                var output = $(elem).attr("output");
                                changeButtonHover(el_style,hex,output);
                            }else if(js_style == "placeholder"){
                                var output = $(elem).attr("output");
                                changeButtonPlaceholder(el_style,hex,output);
                            }else{
                                $(el_style).css(js_style, '#' + hex);
                            }
                            $("."+input_atr).val(hex);
                            $(elem).css("backgroundColor", '#' + hex);
                    }
                });
            }
            
            jQuery(document).ready(function ($) {
                    spSetColorPicker($);
            });
            
            
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
                                    setEiImageCta(attachment.url);
                            });
                            spokal_custom_uploader.open();
                    });
            }); 
            <?php if($this->cta  !== "inlineCta"){ ?>
                    jQuery(document).ready(function($) {
                        $('<?php echo $this->versions[$this->cta]["message"]; ?>').html('<?php echo $this->cta_instance['successmsg']; ?>');
                    });
            <?php }?>
            
            function sp_find_form(curNode) {
                while (curNode) {
                   if (curNode.tagName == 'FORM') {
                       return curNode;
                   }                  
                   else
                      curNode = curNode.parentNode;
                }
                return false;
            }
            jQuery(document).ready(function(){
                jQuery(".image-style-button").click(function(e){
                    e.preventDefault();
                });
            });
            var spStyleInProgress = false;
            jQuery(document).ready(function($) {
                $(document).on('submit','#sp_style_cta_conten',function() {                    
                    if('<?php echo $this->cta; ?>' === "spokalwidget"){
                        var swg_css = '<?php echo $this->swg_css; ?>';
                        var swg_content = '<?php echo $this->swg_content; ?>';
                        var w_form = sp_find_form(document.getElementById(swg_css));
                    }
                    if(!spStyleInProgress){
                        spStyleInProgress = true;
                    $(".sp_style_cta_conten_spiner").show();
                        $.ajax({
                            type: "POST",
                            url: ajaxurl,
                            data: jQuery("#sp_style_cta_conten").serialize(),
                            success: function(data) {
                                spStyleInProgress = false;
                                //saving form
                                $(".sp_style_cta_conten_spiner").hide();
                                
                                //Specific case for Spokal Widget because we are not saving data directly in database
                                //We are setting it as hidden fields in widget settings form
                                if(swg_css && swg_content){
                                    document.getElementById(swg_css).value = data.css;
                                    document.getElementById(swg_content).value = data.content;
                                    var s = w_form.getElementsByClassName('widget-control-save');
                                    s[0].click();
                                }else if(data.popup_id){
                                    var pop_select = document.getElementById("exit_intent_popups");
                                    if(pop_select){
                                        var tmp_div = document.createElement('div');
                                        tmp_div.innerHTML = data.popup_select;
                                        pop_select.parentNode.replaceChild(tmp_div, pop_select);
                                    }
                                    
                                    if(data.popup_action == "edit"){
                                        jQuery( "#sp_popup_row_" + data.popup_id ).replaceWith( data.append );
                                    }else{
                                        var popups = jQuery("#spokal_popups_admin_body .sp_popups_list").length;
                                        if(popups < 1){
                                            jQuery("#no-spokal-popups").hide();
                                        }
                                        jQuery("#spokal_popups_admin_body").prepend(data.append);
                                    }
                                    closeStyleCta('sp_inline_cta-sppopup');
                                }
                            }
                        });
                    }
                    return false; //prevent default submit thing
                }); 
            });
        </script>
<?php }
    
    
    
    public static function renderTempCss($is_widget)
    { ?>
        <style type="text/css">
            .cta-setting-field{
                margin-top: 7px;
                margin-bottom: 7px;
            }
            .colorSelector{
                position: relative;
                border: 4px solid rgb(82, 82, 82);
                border-radius: 8px;
                width: 30px;
                height: 30px;
                cursor: pointer;
            }
            
            .cta-select:focus{
                box-shadow: none;
                color: #696969;
                border-color: #f59942;
                outline: 0;
            }
            
            .option-label{
                font-size: 14px;
                color: #393939;
            }
            
            input[type="text"].cta-form-element,
            textarea.cta-form-element{
                width: 100%;
            }
            
            textarea.cta-form-element{
                min-height: 100px;
            }
            
            input[type="text"].cta-form-element,
            input[type="number"].cta-form-element,
            textarea.cta-form-element{
                border-radius: 0!important;
                color: #858585;
                background-color: #fff;
                border: 1px solid #d5d5d5;
                padding: 5px 4px 6px;
                font-size: 14px;
                font-family: inherit;
                -webkit-box-shadow: none!important;
                box-shadow: none!important;
                -webkit-transition-duration: .1s;
                transition-duration: .1s;
            }
            
            input[type="text"].cta-form-element:focus,
            input[type="number"].cta-form-element:focus,
            textarea.cta-form-element:focus{
                color: #696969;
                border-color: #f59942;
                outline: 0;
            }
            
            .settings-header{
                color: #395997;
                font-size: 18px;
                font-weight: bold;
            }
            
            .sp_inline_cta{ 
                position: absolute;
                top: 0;
                bottom: 0;
                right: 0;
                left: 0;
                background-color: rgba(7,6,5,0.5);
                padding: 25px;
            }
            
            .sp_inline_cta .settings{
                float: left;
                width: 30%;
                height: 600px;
                background: #d8d8d8;
                overflow-y: scroll;
            }
            
            .sp_inline_cta .cta_wrapp{
                overflow-y: scroll;
                float: left;
                width: 70%;
                height: 600px;
                position: relative;
                background-color: rgb(68, 68, 68);
            }
            
            
            
            .sp_inline_cta .title{
                background: #438eb9;
                color: white;
                padding: 10px;
            } 
            
            .version-tabs span{
                padding: 0 10px 2px;
                border-radius: 10px;
                border: 1px solid #f1f1f1;
                color: #f1f1f1;
                text-transform: lowercase;
                opacity: .5;
                cursor: pointer;
            }
            
            .version-tabs{
                position: absolute;
                left: 50%;
                top: 28%;
            }
            
            .active-sub.subscribe-tab,
            .active-sub.success-tab,
            .subscribe-tab:hover,
            .success-tab:hover{
                opacity: 1;
            }
            
            #sp_style_cta_conten .spokal_buttons{
                float: right;
                margin-right: 10px;
            }
            
            .closeStyleCta{
                position: absolute;
                top: 0px;
                right: 10px;
                cursor: pointer;
                color: #bbb;
            }
            .closeStyleCta:after {
                position: absolute;
                content: "\00D7";
                font-size: 44px;
                line-height: 31px;
                height: 30px;
                width: 30px;
                text-align: center;
                top: 3px;
                right: 3px;
            }
            
            .sp_arrow_wrapp{
                width: 10px;
                height: 10px;
                display: block;
                position: absolute;
                background-color: #535454;
                border-radius: 3px;
                bottom: -1px;
                right: -1px;
            }
            
            .sp_arrow{
                width: 0;
                height: 0;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
                border-top: 4px solid WHITE;
                position: absolute;
                top: 3px;
                left: 1px;
            }
            
            .cta-setting-field input[type="image"]{
                padding: 0px;
            }
            
            .cta-setting-field input[type="image"]:focus{
                  outline: none;
            }
            
            .spokalScrollBox,.sp_exit_intent{
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box; 
            }
            
            .sp_inline_cta .sp_exit_intent{
                top: 5%;
            }
            
            @media (max-width: 720px) {
                .sp_inline_cta .settings{
                    float: none;
                    width: 100%;
                    height: 250px;
                }
            
                .sp_inline_cta .cta_wrapp{
                    float: none;
                    width: 100%;
                }
                
                .version-tabs{
                    position: relative;
                    top: 17%;
                    left: 0;
                }
                .sp_inline_cta .title{
                    height: 45px;
                    text-align: center;
                }
                .sp_inline_cta .title.bottom-title{
                    height: 15px;
                }
            }
        </style>
        
        <?php 
            if($is_widget){ ?>
                <style type="text/css">
                    
                    .sp_spinner {
                        background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/spinner.gif) 0 0/20px 20px no-repeat;
                        -webkit-background-size: 20px 20px;
                        display: none;
                        float: right;
                        opacity: .7;
                        filter: alpha(opacity=70);
                        width: 20px;
                        height: 20px;
                        margin: 2px 5px 0;
                    }
                    
                    .sp_inline_cta{
                        position: fixed;
                        padding-left: 20%;
                        padding-right: 10%;
                        padding-top: 50px;
                        overflow-y: auto;
                        z-index: 1000;
                    }
                    
                    .swg_wrap_for_cta{
                        padding: 25px 15px 0 15px;
                    }
                    
                    .sp_widget_wrap{
                        max-width: 330px;
                    }
                    @media screen and (max-width: 782px){
                        .sp_inline_cta{
                            padding-left: 8%;
                            padding-right: 8%;
                        }
                    }
                </style>
                <style type="text/css">.colpick{z-index: 10000;}</style>
      <?php } ?>
<?php }
    
    
    
    
    public function renderSpokalWidget($instance,$is_preview = false){
//        $instance = $this->cta_instance;
        $instance = json_decode(base64_decode($instance),true);
        $title = $instance['title'];
        $buttontext = $instance['buttontext']; 
        $collectfirstname = $instance['collectfirstname'];
        $collectlastname = $instance['collectlastname'];	
        $collectphone = $instance['collectphone'];
        $collectcompany = $instance['collectcompany'];
        $failmsg = $instance['failmsg'];		
        $successmsg = $instance['successmsg'];
        $firstNamePlaceholder = $instance['firstNamePlaceholder'];
        $lastNamePlaceholder = $instance['lastNamePlaceholder'];
        $phonePlaceholder = $instance['phonePlaceholder'];		
        $companyPlaceholder = $instance['companyPlaceholder'];
        $emailPlaceholder = $instance['emailPlaceholder'];
        $invalidEmailMessage = $instance['invalidEmailMessage'];
        $widget_id = $instance['widget_id'];
        $custom_css = (isset($instance['custom_css'])) ? $instance['custom_css'] : "";
        
        self::default_widget_style();
        //checking for custom CSS from Spokal popup styler
        if(!empty($custom_css)){
            $custom_css = json_decode(base64_decode($custom_css),true);
            if(is_array($custom_css)){
                self::renderWidgetAdditionalCss($custom_css,"#".$widget_id."-front_wrapp");
            }
        }
        ?>
        <div class='<?php echo (!$is_preview) ? "swg_wrap_for_cta": ""; ?>'>
        
            <div id='<?php echo $widget_id."-front_wrapp" ?>' class='sp_widget_wrap'>
                <?php
                if ( ! empty( $title ) ) {
                    echo "<div class='swg_title'>" . $title . "</div>";
                } ?>

                <div style="display:none;" id="<?php echo "result_".$widget_id; ?>_succes" class="swg_success_msg"><?php echo $successmsg; ?></div>

                <?php if($instance['toptext'] != strip_tags($instance['toptext'])){ ?>
                        <div class="swg_top_text" id = 'spokalToptext_<?php echo $widget_id; ?>'><?php echo $instance['toptext']; ?></div>
                <?php }else{ ?>
                        <p class="swg_top_text" id = 'spokalToptext_<?php echo $widget_id; ?>' style="overflow: hidden;"><?php echo $instance['toptext']; ?></p>
                <?php }?>

                <div class="editor-field">
                    <input id="Email_<?php echo $widget_id; ?>" name="Email" type="text" placeholder="<?php echo $emailPlaceholder; ?>" class = 'spokal-required email swg-input email_input'>
                </div>    
                <div style="<?php echo ($collectfirstname) ? "" : "display:none; "?>" class="editor-field">
                    <input id="FirstName_<?php echo $widget_id;?>" class="swg-input fname_input" name="FirstName" type="text" placeholder="<?php echo $firstNamePlaceholder ?>">
                </div>
                <div style="<?php echo ($collectlastname) ? "" : "display:none; "?>" class="editor-field">
                    <input id="LastName_<?php echo $widget_id; ?>" name="LastName" class="swg-input lname_input" type="text" placeholder="<?php echo $lastNamePlaceholder ?>">
                </div>
                <div style="<?php echo ($collectphone) ? "" : "display:none; "?>" class="editor-field">
                    <input name="phone" class="swg-input phone_input" placeholder="<?php echo $phonePlaceholder ?>" type="text">
                </div>
                <div style="<?php echo ($collectcompany) ? "" : "display:none; "?>" class="editor-field">
                    <input name="company" class="swg-input company_input" placeholder="<?php echo $companyPlaceholder ?>" type="text">
                </div>
                <input name = 'spokalsubmitbutton' id = 'button_<?php echo $widget_id; ?>' value="<?php echo $buttontext; ?>" type="submit" class='button_<?php echo $widget_id; ?> swg_submit' onKeyPress="return checkSubmitsidebar(event)" />
                <div style="display:none;" id="<?php echo "result_".$widget_id; ?>" class="swg_error_message"><?php echo $failmsg; ?></div>

            </div>
        </div>
        <?php
    }
    
    
    
    
    public function renderInlineCTA( $atts ) { ?>
        <?php $this->default_inlince_cta_style(); ?>
        <?php $this-> renderInlineAdditionalCss(); ?>
        
        <?php 
        $placeholders = get_option("spokal_inlineCta_ph",array());
        $emailPlaceholder = (isset($placeholders["emailPlaceholder"])) ? $placeholders["emailPlaceholder"] : "Email";
        $firstNamePlaceholder = (isset($placeholders["firstNamePlaceholder"])) ? $placeholders["firstNamePlaceholder"] : "First Name";
        $lastNamePlaceholder = (isset($placeholders["lastNamePlaceholder"])) ? $placeholders["lastNamePlaceholder"] : "Last Name";
        $phonePlaceholder = (isset($placeholders["phonePlaceholder"])) ? $placeholders["phonePlaceholder"] : "Phone";
        $companyPlaceholder = (isset($placeholders["companyPlaceholder"])) ? $placeholders["companyPlaceholder"] : "Company";
        ?>
        <div class="settings-cta-wrapp">
            <div id="" class="sp_skip_autolink inlince-cta-wrap">
                <div class="">
                    <h2 class="inline-title">Signup</h2>
                </div>

                <p class="inline-top-text">Enter your personal information below:</p> 

                <div style="display: none;" class="inline_succes_msg">Message has been submitted successfully.</div>
                <form action="" method="post" name="" id="inline_cta_from" style="width: 230px; max-width: 100%;">
                    <div class="editor-field">
                        <input name="Email" placeholder="<?php echo $emailPlaceholder; ?>" class="spokal-required email icta-input email_input" type="text">
                    </div>
                    <div class="editor-field">
                        <input class="icta-input fname_input" placeholder="<?php echo $firstNamePlaceholder; ?>" name="FirstName" type="text">
                    </div>
                    <div class="editor-field">
                        <input class="icta-input lname_input" name="LastName" placeholder="<?php echo $lastNamePlaceholder; ?>" type="text">
                    </div>
                    <div class="editor-field">
                        <input class="icta-input phone_input" name="phone" placeholder="<?php echo $phonePlaceholder; ?>" type="text">
                    </div>
                    <div class="editor-field">
                        <input class="icta-input company_input" name="company" placeholder="<?php echo $companyPlaceholder; ?>" type="text">
                    </div>
                    <input name = 'spokal_submitbutton' value="Register" type="submit" class = 'buttonshortcode icta-submit' />
                </form>
                <div style="display: none;" class="inline_error_msg"></div>
            </div>
        </div>

        <?php
    }
    
    
    
    
    public function renderInlineAdditionalCss(){
        $css_instance = get_option("spokal_icta_custom_style",array());
        
        $classes = array(
            "background" => ".inlince-cta-wrap",
            "title" => ".inlince-cta-wrap .inline-title",
            "top-text" => ".inline-top-text",
            "input-text" => ".inlince-cta-wrap .icta-input",
            "button" => ".inlince-cta-wrap .icta-submit",
            "success-msg" => ".inline_succes_msg",
            "error-msg" => ".inline_error_msg"
        );
        
        $css = "";
        foreach($css_instance as $key => $value ){
            if(isset($classes[$key])){
                
                $css .= $classes[$key]."{";
                    if(isset($value["back-color"]) && !empty($value["back-color"])){
                        $css .= "background-color:#".$value["back-color"].";";
                    }
                    if(isset($value["font-color"]) && !empty($value["font-color"])){
                        $css .= "color:#".$value["font-color"].";";
                    }
                    if(isset($value["font-family"]) && !empty($value["font-family"])){
                        $css .= "font-family:".$value["font-family"].";";
                    }
                    
                    if(isset($value["text-bold"]) && !empty($value["text-bold"])){
                        $css .= "font-weight:".$value["text-bold"].";";
                    }
                    
                    if(isset($value["text-italic"]) && !empty($value["text-italic"])){
                        $css .= "font-style:".$value["text-italic"].";";
                    }
                    
                    if(isset($value["text-align"]) && !empty($value["text-align"])){
                        $css .= "text-align:".$value["text-align"].";";
                    }
                    
                    if(isset($value["text-decoration"]) && !empty($value["text-decoration"])){
                        $css .= "text-decoration:".$value["text-decoration"].";";
                    }
                    
                    if($key === "title"){
                        $css .= "margin: 15px 0 15px 0;";
                    }
                    
                    if($key === "input-text"){
                        $css .= "line-height: normal;box-sizing: border-box;-webkit-appearance: none;-webkit-border-radius: 0;border-radius: 0;";
                    }
                    
                    if($key === "button"){
                        $css .= "border: 0;border-radius: 2px;padding: 8px 15px 8px;text-align:center;cursor:pointer;margin-top: 10px;box-sizing: border-box;max-width: 100%;";
                    }
                    
                $css .= "}";


                //make sure to keep it responsive
                $css .="@media all and (min-width: 650px) {";

                    if(isset($value["font-size"]) && !empty($value["font-size"])){
                        $css .= $classes[$key]."{font-size:".$value["font-size"]."px;}";
                    }
                $css .= "}";


                if(isset($value["placeholder-color"]) && !empty($value["placeholder-color"]) && ($value["placeholder-color"] !=="none")){
                    $css .= $classes[$key]."::-webkit-input-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key]."::-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-ms-input-placeholder{color:#".$value["placeholder-color"].";}";
                }

                if(isset($value["hover-color"]) && !empty($value["hover-color"])){
                    $css .= $classes[$key].":hover{background-color:#".$value["hover-color"].";}";
                }
            }
        }
        if(!empty($css)){
            $css .=  ".inlince-cta-wrap .editor-field{margin-bottom: 5px;}";
            echo "<style type='text/css' scoped>".$css."</style>";
        }
    }
    
    
    
    
    public static function renderWidgetAdditionalCss($css_instance,$id){
        
        $classes = array(
            "background" => $id,
            "title" => $id." > :first-child",
            "top-text" => $id." .swg_top_text",
            "input-text" => $id." .swg-input",
            "button" => $id." .swg_submit",
            "success-msg" => $id." .swg_success_msg",
            "error-msg" => $id." .swg_error_message"
        );
        
        $css = "";
        foreach($css_instance as $key => $value ){
            if(isset($classes[$key])){
                
                $css .= $classes[$key]."{";
                    if(isset($value["back-color"]) && !empty($value["back-color"])){
                        $css .= "background-color:#".$value["back-color"].";";
                    }
                    if(isset($value["font-color"]) && !empty($value["font-color"])){
                        $css .= "color:#".$value["font-color"].";";
                    }
                    if(isset($value["font-family"]) && !empty($value["font-family"])){
                        $css .= "font-family:".$value["font-family"].";";
                    }
                    
                    if(isset($value["text-bold"]) && !empty($value["text-bold"])){
                        $css .= "font-weight:".$value["text-bold"].";";
                    }
                    
                    if(isset($value["text-italic"]) && !empty($value["text-italic"])){
                        $css .= "font-style:".$value["text-italic"].";";
                    }
                    
                    if(isset($value["text-align"]) && !empty($value["text-align"])){
                        $css .= "text-align:".$value["text-align"].";";
                    }
                    
                    if(isset($value["text-decoration"]) && !empty($value["text-decoration"])){
                        $css .= "text-decoration:".$value["text-decoration"].";";
                    }
                    
                $css .= "}";


                //make sure to keep it responsive
                $css .="@media all and (min-width: 650px) {";
                    if(isset($value["width"]) && !empty($value["width"])){
                        $css .= $classes[$key]."{width:".$value["width"]."px;}";
                    }

                    if(isset($value["font-size"]) && !empty($value["font-size"])){
                        $css .= $classes[$key]."{font-size:".$value["font-size"]."px;}";
                    }
                $css .= "}";


                if(isset($value["placeholder-color"]) && !empty($value["placeholder-color"]) && ($value["placeholder-color"] !=="none")){
                    $css .= $classes[$key]."::-webkit-input-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key]."::-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-ms-input-placeholder{color:#".$value["placeholder-color"].";}";
                }

                if(isset($value["hover-color"]) && !empty($value["hover-color"])){
                    $css .= $classes[$key].":hover{background-color:#".$value["hover-color"].";}";
                }
            }
        }
        if(!empty($css)){
             $css .=  $id."{padding: 10px;}".$id." .editor-field{margin-bottom: 5px;}";
            echo "<style type='text/css' scoped>".$css."</style>";
        }
    }
    
    
    
    
    public static function default_widget_style(){ ?>
        <style type="text/css">
            .sp_widget_wrap{
                background-color: white;
                padding: 10px;
            }
            
            .swg_error_message{
                color: #FF0000;
                font-size: 16px;
                line-height: 1.2;
            }
            
            .swg_success_msg{
                color: #008000;
                font-size: 16px;
                line-height: 1.2;
            }
            
            .swg_title{
                font-weight: bold;
                font-size: 16px;
                margin-bottom: 10px;
            }
            
            .sp_widget_wrap .swg-input{
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 2px;
                color: #2b2b2b;
                padding: 7px 10px 7px;
                line-height: normal;
                vertical-align: baseline;
                box-sizing: border-box;
                font-size: 100%;
                font-size: 17px;
                font-family: Lato, sans-serif;
                font-weight: 400;
                background-image: -webkit-linear-gradient(hsla(0,0%,100%,0), hsla(0,0%,100%,0));
                min-height: 35px; 
                -webkit-appearance: none; 
                -webkit-border-radius: 0; 
                 border-radius: 0;
                 width: 100%
            }
            
            .editor-field{
                margin-bottom: 5px;
            }
            
            .swg_top_text{
                font-size: 16px;
            }
            
            .sp_widget_wrap .swg_submit{
                background-color: #0f52ba;
                border: 0;
                border-bottom: 0px;
                border-radius: 2px;
                color: #fff;
                font-size: 15px;
                padding: 8px 15px 8px;
                text-align:center;
                cursor:pointer;
                box-sizing: border-box;
                max-width: 100%;
            }
        </style>
<?php }
    
    
    
    
    public function default_inlince_cta_style(){ ?>
        <style type="text/css">
            .settings-cta-wrapp{
                padding: 15px;
            }
            
            .inlince-cta-wrap{
                background-color: white;
                padding: 15px;
            }
            
            .swg_error_message{
                color: #FF0000;
                font-size: 16px;
                line-height: 1.2;
            }
            
            .inline_succes_msg{
                color: #008000;
                font-size: 16px;
                line-height: 1.2;
            }
            
            .inline-title{
                font-weight: bold;
                font-size: 16px;
                margin-bottom: 10px;
            }
            
            .inlince-cta-wrap .icta-input{
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 2px;
                color: #2b2b2b;
                padding: 7px 10px 7px;
                line-height: normal;
                vertical-align: baseline;
                box-sizing: border-box;
                font-size: 100%;
                font-size: 17px;
                font-family: Lato, sans-serif;
                font-weight: 400;
                background-image: -webkit-linear-gradient(hsla(0,0%,100%,0), hsla(0,0%,100%,0));
                min-height: 35px; 
                -webkit-appearance: none; 
                -webkit-border-radius: 0; 
                 border-radius: 0;
                max-width: 100%;
            }
            
            .editor-field{
                margin-bottom: 5px;
            }
            
            .inline-top-text{
                font-size: 16px;
            }
            
            .inlince-cta-wrap .icta-submit{
                background-color: #0f52ba;
                border: 0;
                border-bottom: 0px;
                border-radius: 2px;
                color: #fff;
                font-size: 15px;
                padding: 8px 15px 8px;
                text-align:center;
                cursor:pointer;
                box-sizing: border-box;
                max-width: 100%;
            }
        </style>
<?php }
}

new SP_Style_CTA();