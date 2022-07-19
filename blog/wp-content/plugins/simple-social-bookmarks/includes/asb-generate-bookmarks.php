<?php
/**
* Generate social bookmarks
*
* Generation the social bookmarks code
*
* @package	Artiss-Social-Bookmarks
*/

/**
* Generate social bookmarks
*
* Generate the required social bookmarks code
*
* @since	3.2
*
* @uses 	asb_get_parameters          Extract parameters
* @uses     asb_setup_social_sites      Setup an array of social sites
*
* @param    string      $add_paras      Parameters
* @param    string      $style          Stylesheet details
* @param    string      $url            URL to link to
* @param    string      $shorturl       Short URL to link to
* @param    string      $title          Alternative title to use for link
* @return   string                      Social bookmarks code
*/

function generate_social_bookmarks( $add_paras = '' , $style = '' , $url = '', $shorturl = '', $title = '' ) {

    // Work out required URL and title

    global $post;

    if ( ( $url == '' ) or ( $title = '' ) ) { $title = get_the_title( $post -> ID ); }
    if ( $url == '' ) { $url = get_permalink( $post -> ID ); }

    // Get cache details and attempt to retrieve. If no cache, build the code from scratch

    $cache_time = strtolower( asb_get_parameters( $add_paras, 'cache' ) );
    if ( $cache_time == '' ) { $cache_time = 24; }

    $cache_key = 'asb_' . md5( $add_paras . $style . $url . $shorturl . $title );

    if ( $cache_time !== false ) { $echoout = get_transient( $cache_key ); }

    if ( $echoout == '' ) {

        // Get parameters

        $icon_folder = asb_get_parameters( $add_paras, 'iconfolder' );
        $default = strtolower( asb_get_parameters( $add_paras, 'default' ) );
        $nofollow = strtolower( asb_get_parameters( $add_paras, 'nofollow' ) );
        $target = strtolower( asb_get_parameters( $add_paras, 'target' ) );
        $priority = asb_get_parameters( $add_paras, 'priority' );
        $separator = strtolower( asb_get_parameters( $add_paras, 'separator' ) );
        $unique_id = strtolower( asb_get_parameters( $add_paras, 'id' ) );

        // Set up Shareaholic & AddThis URLs

        $shareaholic_url = 'http://www.shareaholic.com/api/share/?v=1&amp;apitype=1&amp;apikey=15770959566489cc042799dbc40c7cda4&amp;service=[service]&amp;title=[title]&amp;link=[url]';
        $addthis_url = 'http://api.addthis.com/oexchange/0.8/forward/[service]/offer?url=[url]&amp;title=[title]';
        $addtoany_url = 'http://www.addtoany.com/add_to/[service]?linkurl=[url]&amp;linkname=[title]';

        // Set default parameters values

        $plugin_folder = WP_PLUGIN_URL . '/simple-social-bookmarks/';

        if ( $default == '' ) { $default = 'basic'; }
        if ( $nofollow == 'no' ) { $nofollow = ''; } else { $nofollow = ' rel="nofollow"'; }
        if ( $style != '' ) { $style = ' style="' . $style . '"';  }
        if ( $target != '' ) { $target = ' target="' . $target . '"'; }
        if ( $icon_folder == '' ) {
            $icon_folder = $plugin_folder . 'images/';
        } else {
            $icon_folder = content_url() . '/' . $icon_folder . '/';
        }

        // Set up the short URL

        if ( strtolower( $shorturl ) == 'no' ) {
            $shorturl = '';
        } else {
            if ( substr( $shorturl, 0, 4 ) != 'http' ) { $shorturl = ''; }
            if ( $shorturl == '' ) {
                $post_id = get_the_ID();
                if ( $post_id != '' ) { $shorturl = site_url() . '/?p=' . $post_id; } else { $shorturl = $url; }
            }
        }

        if ( ( $priority != '123' ) && ( $priority != '132' ) && ( $priority != '213' ) && ( $priority != '231' ) && ( $priority != '312' ) && ( $priority != '321' ) ) { $priority = '123'; }

        // Encode the title and get the blog URL

        $email_title = rawurlencode( html_entity_decode( $title, ENT_QUOTES, 'UTF-8' ) );
        $email_text = rawurlencode( $url );

        // Build the services array and output plugin information as an HTML comment

        $social_sites = asb_setup_social_sites();
        $echoout = "\n<!-- Social Bookmarks v" . artiss_social_bookmarks_version . " -->\n";
        $echoout .= "<!-- " . __( 'Using icon folder at ', 'simple-social-bookmarks' ) . $icon_folder . " -->\n";

        $tools = false;
        $first_tool = false;

        // Loop through the services array and output each that has been selected

        foreach ( $social_sites as $social_data ) {

            if ( ( $social_data[ 0 ] != '' ) or ( $social_data[ 1 ] != '' ) or ( $social_data[ 2 ] != '' ) or ( $social_data[ 3 ] != '' ) ) {

                // Extract individual fields for current service

                if ( substr( $social_data[ 0 ], 0, 1 ) == '#' ) {
                    $basic = true;
                    $service_name = substr( $social_data[ 0 ], 1 );
                } else {
                    $basic = false;
                    $service_name = $social_data[ 0 ];
                }
                $alt_text = "Share '" . $title . "' on " . $service_name;

                if ( substr( $social_data[ 1 ], 0, 1 ) == '#' ) {
                    $shorten = true;
                    $social_data[ 1 ] = substr( $social_data[ 1 ], 1 );
                } else {
                    $shorten = false;
                }

                $service_name = $social_data[ 1 ];
                $icon_name = $social_data[ 1 ];
                $addthis_service = $social_data[ 2 ];
                $shareaholic_service = $social_data[ 3 ];
                $addtoany_service = $social_data[ 4 ];
                $service_url = $social_data[ 5 ];

                // Determine which service to use (or supplied URL)

                $loop = 0;
                $service_found = false;
                while ( ( $loop < 3 ) && ( !$service_found ) ) {
                    $service = substr( $priority, $loop, 1 );
                    if ( ( $service == 1 ) && ( $addthis_service != '' ) ) {
                        $service_url = str_replace( '[service]', $addthis_service, $addthis_url );
                        $service_found = true;
                    }
                    if ( ( $service == 2 ) && ( $shareaholic_service != '' ) ) {
                        $service_url = str_replace( '[service]', $shareaholic_service, $shareaholic_url );
                        $service_found = true;
                    }
                    if ( ( $service == 3 ) && ( $addtoany_service != '' ) ) {
                        $service_url = str_replace( '[service]', $addtoany_service, $addtoany_url );
                        $service_found = true;
                    }
                    $loop ++;
                }
                if ( $shorten ) { $service_url = str_replace( '[url]', '[shorturl]', $service_url ); }

                // Look to see if a parameter exists for the current service

                $option = strtolower( asb_get_parameters( $add_paras, $service_name ) );

                // Decide if service should be displayed

                $switch = false;
                if ( ( ( $basic === false ) && ( $default == 'on' ) ) or ( ( $basic === true ) && ( $default != 'off' ) ) ) { $switch = true; }

                // Add service to output (if appropriate)

                if ( ( $option == 'on' ) or ( ( $switch === true ) && ( $option != 'off' ) ) ) {

                    // If we are displaying tools and a separator has been requested then display it
                    // Switch tools flag off so the separator is not shown again

                    if ( $first_tool ) {
                        if ( $separator == 'yes' ) { $echoout .= '<img src="' . $icon_folder . 'separator.png" alt="' . __( 'Separator', 'simple-social-bookmarks' ) . '" title="' . __( 'Separator', 'simple-social-bookmarks' ) . '" class="ssb_sep"' . $style . '/>'; }
                        $first_tool = false;
                    }

                    // Now generate the XHTML for the social bookmark

                    $echoout .= asb_output_bookmark_code( $service_url, $target, $nofollow, $unique_id, $icon_folder, $icon_name, $style, $alt_text, $service_name );


                }
            } else {

                // Blank record found, indicating a change from bookmarks to tools

                $first_tool = true;
            }
        }

        // Replace all the possible parameters within the URL

        $echoout = str_replace( '[url]', $url, $echoout );
        $echoout = str_replace( '[shorturl]', $shorturl, $echoout );
        $echoout = str_replace( '[title]', urlencode( html_entity_decode( $title, ENT_QUOTES, 'UTF-8' ) ), $echoout );
        $echoout = str_replace( '[email_title]', $email_title, $echoout );
        $echoout = str_replace( '[email_text]', $email_text, $echoout );

        $echoout .= '<!-- ' . __( 'End of Social Bookmarks code', 'simple-social-bookmarks' ) . " -->\n";

        if ( $cache_time !== false) { set_transient( $cache_key, $echoout, 3600 * $cache_time ); }
    }

    return $echoout;
}

/**
* Output bookmark code
*
* Generate the XHTML for a specific bookmark
*
* @since	3.2
*
* @param    string      $service_url    The URL of the service being used
* @param    string      $target         The link's target
* @param    string      $nofollow       The link's nofollow attribute
* @param    string      $unique_id      A unique ID
* @param    string      $icon_folder    The folder containing the icons
* @param    string      $icon_name      The name of the icon
* @param    string      $style          The stylesheet definitions
* @param    string      $alt_text       Alternative text for the image
* @param    string      $service_name   The name of the service being used
* @return   string                      Social bookmarks code
*/

function asb_output_bookmark_code( $service_url = '', $target = '', $nofollow = '', $unique_id = '', $icon_folder = '', $icon_name = '', $style = '', $alt_text = '', $service_name = '' ) {

    $echoout = '<a href="' . $service_url . '" class="ssb"' . $target . $nofollow;

    // Add the code for animation, if required

    if ( $unique_id != '' ) {
        $image_id = $service_name . '_' . $unique_id;
        $mouseover = " document.getElementById('" . $image_id . "').src='" . $icon_folder . $icon_name . "_hov.png';";
        $mouseout = " document.getElementById('" . $image_id . "').src='" . $icon_folder . $icon_name . ".png';";
        $echoout .= ' onmouseover="' . $mouseover . '"';
        $echoout .= ' onmouseout="' . $mouseout . '"';
    }

    // Add remainder of code

    $echoout .= ' onclick="javascript:_gaq.push([\'_trackEvent\',\'outbound-article\',\'' . $service_name . '\']);"><img src="' . $icon_folder . $icon_name . '.png" ';
    if ( $unique_id != '' ) { $echoout .= 'id="' . $image_id . '" '; }
    $echoout .= 'alt="' . $alt_text . '" title="' . $alt_text . '" class="ssb"' . $style . ' />';
    $echoout .= "</a>\n";

    return $echoout;
}
?>