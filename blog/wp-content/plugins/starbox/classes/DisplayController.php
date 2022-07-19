<?php

/**
 * The class handles the theme part in WP
 */
class ABH_Classes_DisplayController {

    private static $name;
    private static $cache;

    /**
     * echo the css link from theme css directory
     *
     * @param string $uri The name of the css file or the entire uri path of the css file
     * @param string $media
     *
     * @return string
     */
    public static function loadMedia($uri = '', $params = array('trigger' => true), $media = 'all') {
        $css_uri = '';
        $js_uri = '';

        if (ABH_Classes_Tools::isAjax() || ABH_Classes_Tools::isApi())
            return;

        if (isset(self::$cache[$uri]))
            return;

        self::$cache[$uri] = true;

        /* if is a custom css file */
        if (strpos($uri, '//') === false) {
            $name = strtolower($uri);
            if (file_exists(_ABH_THEME_DIR_ . 'css/' . $name . (ABH_DEBUG ? '' : '.min') . '.css')) {
                $css_uri = _ABH_THEME_URL_ . 'css/' . $name . (ABH_DEBUG ? '' : '.min') . '.css?ver=' . ABH_VERSION_ID;
            }
            if (file_exists(_ABH_THEME_DIR_ . 'js/' . $name . (ABH_DEBUG ? '' : '.min') . '.js')) {
                $js_uri = _ABH_THEME_URL_ . 'js/' . $name . (ABH_DEBUG ? '' : '.min') . '.js?ver=' . ABH_VERSION_ID;
            }
        } else {
            $name = strtolower(basename($uri));
            if (strpos($uri, '.css') !== FALSE)
                $css_uri = $uri;
            elseif (strpos($uri, '.js') !== FALSE) {
                $js_uri = $uri;
            }
        }

        if ($css_uri <> '') {

            if (!wp_style_is(_ABH_NAMESPACE_ . $name)) {
                wp_enqueue_style(_ABH_NAMESPACE_ . $name, $css_uri, null, ABH_VERSION, $media);
            }

            if (isset($params['trigger']) && $params['trigger'] === true) {
                wp_print_styles(array(_ABH_NAMESPACE_ . $name));
            }
        }

        if ($js_uri <> '') {

            if (!wp_script_is('jquery')) {
                wp_enqueue_script('jquery');
            }

            if (!wp_script_is(_ABH_NAMESPACE_ . $name)) {
                wp_enqueue_script(_ABH_NAMESPACE_ . $name, $js_uri, null, ABH_VERSION, true);
            }

            if (isset($params['trigger']) && $params['trigger'] === true) {
                wp_print_scripts(array(_ABH_NAMESPACE_ . $name));
            }
        }
    }

    /**
     * Called for any class to show the block content
     *
     * @param string $block the name of the block file in theme directory (class name by default)
     *
     * @return string of the current class view
     */
    public function output($block, $obj) {
        self::$name = $block;
        echo $this->echoBlock($obj);
    }

    /**
     * echo the block content from theme directory
     *
     * @return string
     */
    public static function echoBlock($view) {
        global $post_ID;
        if (file_exists(_ABH_THEME_DIR_ . self::$name . '.php')) {
            ob_start();
            /* includes the block from theme directory */
            include(_ABH_THEME_DIR_ . self::$name . '.php');
            $block_content = ob_get_contents();
            ob_end_clean();

            return $block_content;
        }
    }

}