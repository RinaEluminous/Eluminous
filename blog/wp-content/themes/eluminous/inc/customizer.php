<?php
/**
 * _s Theme Customizer
 *
 * @package eluminous
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eluminous_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default   = '#1FA67A';
}
add_action( 'customize_register', 'eluminous_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eluminous_customize_preview_js() {
	wp_enqueue_script( 'eluminous_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20150423', true );
}
add_action( 'customize_preview_init', 'eluminous_customize_preview_js' );

/**
 * Options for eluminous Theme Customizer.
 */
function eluminous_customizer( $wp_customize ) {

    /* Main option Settings Panel */
    $wp_customize->add_panel('eluminous_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('eluminous Options', 'eluminous'),
        'description' => __('Panel to update eluminous theme options', 'eluminous'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));

        /* eluminous Main Options */
        $wp_customize->add_section('eluminous_slider_options', array(
            'title' => __('Slider options', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            $wp_customize->add_setting( 'eluminous[eluminous_slider_checkbox]', array(
                    'default' => 0,
                    'type' => 'option',
                    'sanitize_callback' => 'eluminous_sanitize_checkbox',
            ) );
            $wp_customize->add_control( 'eluminous[eluminous_slider_checkbox]', array(
                    'label'	=> esc_html__( 'Check if you want to enable slider', 'eluminous' ),
                    'section'	=> 'eluminous_slider_options',
                    'priority'	=> 5,
                    'type'      => 'checkbox',
            ) );

            // Pull all the categories into an array
            global $options_categories;
            $wp_customize->add_setting('eluminous[eluminous_slide_categories]', array(
                'default' => '',
                'type' => 'option',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'eluminous_sanitize_slidecat'
            ));
            $wp_customize->add_control('eluminous[eluminous_slide_categories]', array(
                'label' => __('Slider Category', 'eluminous'),
                'section' => 'eluminous_slider_options',
                'type'    => 'select',
                'description' => __('Select a category for the featured post slider', 'eluminous'),
                'choices'    => $options_categories
            ));

            $wp_customize->add_setting('eluminous[eluminous_slide_number]', array(
                'default' => 3,
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_number'
            ));
            $wp_customize->add_control('eluminous[eluminous_slide_number]', array(
                'label' => __('Number of slide items', 'eluminous'),
                'section' => 'eluminous_slider_options',
                'description' => __('Enter the number of slide items', 'eluminous'),
                'type' => 'text'
            ));

        $wp_customize->add_section('eluminous_layout_options', array(
            'title' => __('Layout options', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            // Layout options
            global $site_layout;
            $wp_customize->add_setting('eluminous[site_layout]', array(
                 'default' => 'side-pull-left',
                 'type' => 'option',
                 'sanitize_callback' => 'eluminous_sanitize_layout'
            ));
            $wp_customize->add_control('eluminous[site_layout]', array(
                 'label' => __('Website Layout Options', 'eluminous'),
                 'section' => 'eluminous_layout_options',
                 'type'    => 'select',
                 'description' => __('Choose between different layout options to be used as default', 'eluminous'),
                 'choices'    => $site_layout
            ));

            $wp_customize->add_setting('eluminous[element_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[element_color]', array(
                'label' => __('Element Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_layout_options',
                'settings' => 'eluminous[element_color]',
            )));

            $wp_customize->add_setting('eluminous[element_color_hover]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[element_color_hover]', array(
                'label' => __('Element color on hover', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_layout_options',
                'settings' => 'eluminous[element_color_hover]',
            )));

         /* eluminous Action Options */
        $wp_customize->add_section('eluminous_action_options', array(
            'title' => __('Action Button', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            $wp_customize->add_setting('eluminous[w2f_cfa_text]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('eluminous[w2f_cfa_text]', array(
                'label' => __('Call For Action Text', 'eluminous'),
                'description' => sprintf(__('Enter the text for call for action section', 'eluminous')),
                'section' => 'eluminous_action_options',
                'type' => 'textarea'
            ));

            $wp_customize->add_setting('eluminous[w2f_cfa_button]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_nohtml'
            ));
            $wp_customize->add_control('eluminous[w2f_cfa_button]', array(
                'label' => __('Call For Action Button Title', 'eluminous'),
                'section' => 'eluminous_action_options',
                'description' => __('Enter the title for Call For Action button', 'eluminous'),
                'type' => 'text'
            ));

            $wp_customize->add_setting('eluminous[w2f_cfa_link]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control('eluminous[w2f_cfa_link]', array(
                'label' => __('CFA button link', 'eluminous'),
                'section' => 'eluminous_action_options',
                'description' => __('Enter the link for Call For Action button', 'eluminous'),
                'type' => 'text'
            ));

            $wp_customize->add_setting('eluminous[cfa_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[cfa_color]', array(
                'label' => __('Call For Action Text Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_action_options',
            )));
            $wp_customize->add_setting('eluminous[cfa_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[cfa_bg_color]', array(
                'label' => __('Call For Action Background Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_action_options',
            )));
            $wp_customize->add_setting('eluminous[cfa_btn_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[cfa_btn_color]', array(
                'label' => __('Call For Action Button Border Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_action_options',
            )));
            $wp_customize->add_setting('eluminous[cfa_btn_txt_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[cfa_btn_txt_color]', array(
                'label' => __('Call For Action Button Text Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_action_options',
            )));

        /* eluminous Typography Options */
        $wp_customize->add_section('eluminous_typography_options', array(
            'title' => __('Typography', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            global $typography_defaults;

            // Typography Options
            global $typography_options;
            $wp_customize->add_setting('eluminous[main_body_typography][size]', array(
                'default' => $typography_defaults['size'],
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_typo_size'
            ));
            $wp_customize->add_control('eluminous[main_body_typography][size]', array(
                'label' => __('Main Body Text', 'eluminous'),
                'description' => __('Used in p tags', 'eluminous'),
                'section' => 'eluminous_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['sizes']
            ));
            $wp_customize->add_setting('eluminous[main_body_typography][face]', array(
                'default' => $typography_defaults['face'],
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_typo_face'
            ));
            $wp_customize->add_control('eluminous[main_body_typography][face]', array(
                'section' => 'eluminous_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['faces']
            ));
            $wp_customize->add_setting('eluminous[main_body_typography][style]', array(
                'default' => $typography_defaults['style'],
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_typo_style'
            ));
            $wp_customize->add_control('eluminous[main_body_typography][style]', array(
                'section' => 'eluminous_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['styles']
            ));
            $wp_customize->add_setting('eluminous[main_body_typography][color]', array(
                'default' => $typography_defaults['color'],
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[main_body_typography][color]', array(
                'section' => 'eluminous_typography_options',
            )));

            $wp_customize->add_setting('eluminous[heading_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[heading_color]', array(
                'label' => __('Heading Color', 'eluminous'),
                'description'   => __('Color for all headings (h1-h6)','eluminous'),
                'section' => 'eluminous_typography_options',
            )));
            $wp_customize->add_setting('eluminous[link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[link_color]', array(
                'label' => __('Link Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_typography_options',
            )));
            $wp_customize->add_setting('eluminous[link_hover_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[link_hover_color]', array(
                'label' => __('Link:hover Color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_typography_options',
            )));

        /* eluminous Header Options */
        $wp_customize->add_section('eluminous_header_options', array(
            'title' => __('Header', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            $wp_customize->add_setting('eluminous[top_nav_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[top_nav_bg_color]', array(
                'label' => __('Top nav background color', 'eluminous'),
                'description'   => __('Default used if no color is selected','eluminous'),
                'section' => 'eluminous_header_options',
            )));
            $wp_customize->add_setting('eluminous[top_nav_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[top_nav_link_color]', array(
                'label' => __('Top nav item color', 'eluminous'),
                'description'   => __('Link color','eluminous'),
                'section' => 'eluminous_header_options',
            )));

            $wp_customize->add_setting('eluminous[top_nav_dropdown_bg]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[top_nav_dropdown_bg]', array(
                'label' => __('Top nav dropdown background color', 'eluminous'),
                'description'   => __('Background of dropdown item hover color','eluminous'),
                'section' => 'eluminous_header_options',
            )));

            $wp_customize->add_setting('eluminous[top_nav_dropdown_item]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[top_nav_dropdown_item]', array(
                'label' => __('Top nav dropdown item color', 'eluminous'),
                'description'   => __('Dropdown item color','eluminous'),
                'section' => 'eluminous_header_options',
            )));

        /* eluminous Footer Options */
        $wp_customize->add_section('eluminous_footer_options', array(
            'title' => __('Footer', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            $wp_customize->add_setting('eluminous[footer_widget_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[footer_widget_bg_color]', array(
                'label' => __('Footer widget area background color', 'eluminous'),
                'section' => 'eluminous_footer_options',
            )));

            $wp_customize->add_setting('eluminous[footer_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[footer_bg_color]', array(
                'label' => __('Footer background color', 'eluminous'),
                'section' => 'eluminous_footer_options',
            )));

            $wp_customize->add_setting('eluminous[footer_text_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[footer_text_color]', array(
                'label' => __('Footer text color', 'eluminous'),
                'section' => 'eluminous_footer_options',
            )));

            $wp_customize->add_setting('eluminous[footer_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[footer_link_color]', array(
                'label' => __('Footer link color', 'eluminous'),
                'section' => 'eluminous_footer_options',
            )));

            $wp_customize->add_setting('eluminous[custom_footer_text]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('eluminous[custom_footer_text]', array(
                'label' => __('Footer information', 'eluminous'),
                'description' => sprintf(__('Copyright text in footer', 'eluminous')),
                'section' => 'eluminous_footer_options',
                'type' => 'textarea'
            ));

        /* eluminous Social Options */
        $wp_customize->add_section('eluminous_social_options', array(
            'title' => __('Social', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            $wp_customize->add_setting('eluminous[social_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[social_color]', array(
                'label' => __('Social icon color', 'eluminous'),
                'description' => sprintf(__('Default used if no color is selected', 'eluminous')),
                'section' => 'eluminous_social_options',
            )));

            $wp_customize->add_setting('eluminous[social_hover_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'eluminous_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'eluminous[social_hover_color]', array(
                'label' => __('Social Icon:hover Color', 'eluminous'),
                'description' => sprintf(__('Default used if no color is selected', 'eluminous')),
                'section' => 'eluminous_social_options',
            )));

            $wp_customize->add_setting('eluminous[footer_social]', array(
                'default' => 0,
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_checkbox'
            ));
            $wp_customize->add_control('eluminous[footer_social]', array(
                'label' => __('Footer Social Icons', 'eluminous'),
                'description' => sprintf(__('Check to show social icons in footer', 'eluminous')),
                'section' => 'eluminous_social_options',
                'type' => 'checkbox',
            ));

        /* eluminous Other Options */
        $wp_customize->add_section('eluminous_other_options', array(
            'title' => __('Other', 'eluminous'),
            'priority' => 31,
            'panel' => 'eluminous_main_options'
        ));
            $wp_customize->add_setting('eluminous[custom_css]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'eluminous_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('eluminous[custom_css]', array(
                'label' => __('Custom CSS', 'eluminous'),
                'description' => sprintf(__('Additional CSS', 'eluminous')),
                'section' => 'eluminous_other_options',
                'type' => 'textarea'
            ));

        $wp_customize->add_section('eluminous_important_links', array(
            'priority' => 5,
            'title' => __('Support and Documentation', 'eluminous')
        ));
            $wp_customize->add_setting('eluminous[imp_links]', array(
              'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control(
            new eluminous_Important_Links(
            $wp_customize,
                'eluminous[imp_links]', array(
                'section' => 'eluminous_important_links',
                'type' => 'eluminous-important-links'
            )));

}
add_action( 'customize_register', 'eluminous_customizer' );



/**
 * Sanitize checkbox for WordPress customizer
 */
function eluminous_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: colors
 * @package eluminous
 */
function eluminous_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package eluminous
 */
function eluminous_sanitize_nohtml($input) {
    return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package eluminous
 */
function eluminous_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package eluminous
 */
function eluminous_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Slider Category
 * @package eluminous
 */
function eluminous_sanitize_slidecat( $input ) {
    global $options_categories;
    if ( array_key_exists( $input, $options_categories ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package eluminous
 */
function eluminous_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Typography Size
 * @package eluminous
 */
function eluminous_sanitize_typo_size( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['sizes'] ) ) {
        return $input;
    } else {
        return $typography_defaults['size'];
    }
}
/**
 * Adds sanitization callback function: Typography Face
 * @package eluminous
 */
function eluminous_sanitize_typo_face( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['faces'] ) ) {
        return $input;
    } else {
        return $typography_defaults['face'];
    }
}
/**
 * Adds sanitization callback function: Typography Style
 * @package eluminous
 */
function eluminous_sanitize_typo_style( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['styles'] ) ) {
        return $input;
    } else {
        return $typography_defaults['style'];
    }
}

/**
 * Add CSS for custom controls
 */
function eluminous_customizer_custom_control_css() {
	?>
    <style>
        #customize-control-eluminous-main_body_typography-size select, #customize-control-eluminous-main_body_typography-face select,#customize-control-eluminous-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'eluminous_customizer_custom_control_css' );

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a eluminous important links
 */
class eluminous_Important_Links extends WP_Customize_Control {

   public $type = "eluminous-important-links";

   public function render_content() {?>
         <!-- Twitter -->
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        <!-- Facebook -->
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=328285627269392";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="inside">
            <div id="social-share">
              <div class="fb-like" data-href="<?php echo esc_url( 'https://www.facebook.com/colorlib' ); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="true"></div>
              <div class="tw-follow" ><a href="https://twitter.com/colorlib" class="twitter-follow-button" data-show-count="false">Follow @colorlib</a></div>
            </div>
            <p><b><a href="<?php echo esc_url( 'http://colorlib.com/wp/support/eluminous' ); ?>"><?php esc_html_e('eluminous Documentation','eluminous'); ?></a></b></p>
            <p><?php _e('The best way to contact us with <b>support questions</b> and <b>bug reports</b> is via','eluminous') ?> <a href="<?php echo esc_url( 'http://colorlib.com/wp/forums' ); ?>"><?php esc_html_e('Colorlib support forum','eluminous') ?></a>.</p>
            <p><?php esc_html_e('If you like this theme, I\'d appreciate any of the following:','eluminous') ?></p>
            <ul>
              <li><a class="button" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/eluminous?filter=5' ); ?>" title="<?php esc_attr_e('Rate this Theme', 'eluminous'); ?>" target="_blank"><?php printf(esc_html__('Rate this Theme','eluminous')); ?></a></li>
              <li><a class="button" href="<?php echo esc_url( 'http://www.facebook.com/colorlib' ); ?>" title="Like Colorlib on Facebook" target="_blank"><?php printf(esc_html__('Like on Facebook','eluminous')); ?></a></li>
              <li><a class="button" href="<?php echo esc_url( 'http://twitter.com/colorlib/' ); ?>" title="Follow Colrolib on Twitter" target="_blank"><?php printf(esc_html__('Follow on Twitter','eluminous')); ?></a></li>
            </ul>
        </div><?php
   }

}

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );

function customizer_custom_scripts() { ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /* This one shows/hides the an option when a checkbox is clicked. */
        jQuery('#customize-control-eluminous-eluminous_slide_categories, #customize-control-eluminous-eluminous_slide_number').hide();
        jQuery('#customize-control-eluminous-eluminous_slider_checkbox input').click(function() {
            jQuery('#customize-control-eluminous-eluminous_slide_categories, #customize-control-eluminous-eluminous_slide_number').fadeToggle(400);
        });

        if (jQuery('#customize-control-eluminous-eluminous_slider_checkbox input:checked').val() !== undefined) {
            jQuery('#customize-control-eluminous-eluminous_slide_categories, #customize-control-eluminous-eluminous_slide_number').show();
        }
    });
</script>
<style>
    li#accordion-section-eluminous_important_links h3.accordion-section-title, li#accordion-section-eluminous_important_links h3.accordion-section-title:focus { background-color: #00cc00 !important; color: #fff !important; }
    li#accordion-section-eluminous_important_links h3.accordion-section-title:hover { background-color: #00b200 !important; color: #fff !important; }
    li#accordion-section-eluminous_important_links h3.accordion-section-title:after { color: #fff !important; }
</style>
<?php
}
