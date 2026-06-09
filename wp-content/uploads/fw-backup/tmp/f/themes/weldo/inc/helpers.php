<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
 * Register Theme Google font.
 *
 * @return string
 */

if (!function_exists('weldo_google_font_url')) :
    function weldo_google_font_url()
    {
        $options = new Weldo_Options();
        // Default Theme Fonts
        $fonts = $options->default_fonts_array;


        //checking fonts from customizer if Unyson exists
        if (function_exists('fw_get_google_fonts')) {
            //grabbing all available fonts
            $google_fonts = fw_get_google_fonts();

            $font_body_options = fw_get_db_customizer_option('body_font_picker_switch');
            $font_body_enabled = (boolean)$font_body_options['main_font_enabled'];
            $font_body = $font_body_options['main_font_options']['main_font'];

            $font_headings_options = fw_get_db_customizer_option('h_font_picker_switch');
            $font_headings_enabled = (boolean)$font_headings_options['h_font_enabled'];
            $font_headings = $font_headings_options['h_font_options']['h_font'];

            //including fonts from theme in main fonts array
            if ($font_body_enabled) {
                $fonts[$font_body['family']] = $font_body;
                // adding font variations to main fonts array to create link to Google Fonts below
                if (isset($google_fonts[$font_body['family']])) {
                    $fonts[$font_body['family']]['variants'] = $google_fonts[$font_body['family']]['variants'];
                }
            }
            if ($font_headings_enabled) {
                $fonts[$font_headings['family']] = $font_headings;
                if (isset($google_fonts[$font_headings['family']])) {
                    $fonts[$font_headings['family']]['variants'] = $google_fonts[$font_headings['family']]['variants'];
                }
            }
        }

        $fonts_url = '//fonts.googleapis.com/css?family=';
        $subsets = array();
        foreach ($fonts as $font => $styles) {
            if (!empty ($styles['variants'])) {

                $fonts_url .= str_replace(' ', '+', $font) . ':' . implode(',', $styles['variants']) . '|';
                $subsets[] = $styles['subset'];
            }

        }
        $fonts_url = substr($fonts_url, 0, -1);
        $fonts_url .= '&subset=' . implode(',', array_unique($subsets));

        return urldecode($fonts_url);
    }
endif;

if (!function_exists('weldo_add_font_styles_in_head')) :
    function weldo_add_font_styles_in_head()
    {
        if (function_exists('fw_get_db_customizer_option')) {

            $font_body_options = fw_get_db_customizer_option('body_font_picker_switch');
            $font_body_enabled = (boolean)$font_body_options['main_font_enabled'];
            $font_body = $font_body_options['main_font_options']['main_font'];

            $font_headings_options = fw_get_db_customizer_option('h_font_picker_switch');
            $font_headings_enabled = (boolean)$font_headings_options['h_font_enabled'];
            $font_headings = $font_headings_options['h_font_options']['h_font'];

            $output = "";
            if ($font_body_enabled) {
                $output .= "body {
								font-family : \"{$font_body['family']}\", sans-serif;
								font-weight: {$font_body['variation']};
								font-size: {$font_body['size']}px;
								line-height: {$font_body['line-height']}px;
								letter-spacing: {$font_body['letter-spacing']}px;
							}";
            }
            if ($font_headings_enabled) {

                $output .= "h1, h2, h3, h4, h5, h6 {
								font-family : \"{$font_headings['family']}\", sans-serif;
								letter-spacing: {$font_headings['letter-spacing']}px;
								font-weight: {$font_headings['variation']};

							}";
            }

            return (wp_kses($output, false));

        } else {
            return false;
        }
    }
endif; //weldo_add_font_styles_in_head()

if (!function_exists('weldo_custom')) :
    function weldo_custom()
    {
        if (function_exists('fw_get_db_customizer_option')) {
            $option = fw_get_db_customizer_option('hide_term_title');
            $output = '/* Customizer options */ ';
            if (fw_get_db_customizer_option('hide_term_title')) {
                $output .= ' span.taxonomy-name-title { display: none; }';
            }
            return (wp_kses($output, false));
        } else {
            return false;
        }
    }
endif; // weldo_custom()


if (!function_exists('weldo_is_active_widgets_in_main_sidebar_exists')) :
    /**
     * Define is sidebar that must be shown has active widgets
     */
    function weldo_is_active_widgets_in_main_sidebar_exists()
    {
        //default value
        $return = true;

        //if Unyson exists
        if (function_exists('fw_ext_sidebars_show')) {
            //if custom sidebar is set for current page
            if (fw_ext_sidebars_show('blue')) {
                if (fw_ext_sidebars_show('blue') !== '1') {
                    $return = true;
                } else {
                    $return = false;
                }
                //if no custom sidebar but Unyson exists
            } else {
                //if no default sidebar
                if (!is_active_sidebar('sidebar-main')) {
                    $return = false;
                } else {
                    $return = true;
                }
            }
            //no Unyson and empty sidebar
        } else {
            if (!is_active_sidebar('sidebar-main')) {
                $return = false;
            } else {
                $return = true;
            }
        }
        return $return;
    }
endif; //weldo_is_active_widgets_in_main_sidebar_exists

if (!function_exists('weldo_get_columns_classes')) :
    /**
     * Define a sidebar position for manage main column CSS class, sidebar CSS class and visibility of sidebar.
     * return array
     */
    function weldo_get_columns_classes($full_width = false)
    {
        //additional classes to columns
        $main_column_class = ' column-main';
        $sidebar_class = ' column-sidebar';

        //default values
        $column_classes = array(
            'main_column_class' => 'col-12 col-xs-12 col-lg-7 col-xl-8' . $main_column_class,
            'sidebar_class' => 'col-12 col-xs-12 col-lg-5 col-xl-4' . $sidebar_class,
            'position' => 'right'
        );
        if (is_page()) {
            $column_classes['main_column_class'] = "col-12" . $main_column_class;
            $column_classes['sidebar_class'] = false;
            $column_classes['position'] = 'full';

            //if no Unyson installed - return - no sidebar on pages by default
            if (!function_exists('fw_ext_sidebars_show')) {
                return $column_classes;
            }
        }

        //check for unyson
        if (function_exists('fw_ext_sidebars_get_current_position')) {

            //full width
            if (in_array(fw_ext_sidebars_get_current_position(), array('full'))) {

                $column_classes['main_column_class'] = "col-12" . $main_column_class;
                $column_classes['sidebar_class'] = false;
                $column_classes['position'] = 'full';
                //making 10 columns width on single post if no sidebar
                if (is_single()) {
                    $column_classes['main_column_class'] = "col-12 col-xs-12 col-xl-10 offset-xl-1" . $main_column_class;
                    $column_classes['sidebar_class'] = false;
                    $column_classes['position'] = 'full';
                }

                //left sidebar
            } elseif (in_array(fw_ext_sidebars_get_current_position(), array('left'))) {

                $column_classes['main_column_class'] = "col-12 col-xs-12 col-lg-7 col-xl-8 order-lg-2" . $main_column_class;
                $column_classes['sidebar_class'] = "col-12 col-xs-12 col-lg-5 col-xl-4 order-lg-1" . $sidebar_class;
                $column_classes['position'] = 'left';

            } elseif (in_array(fw_ext_sidebars_get_current_position(), array('right'))) {

                $column_classes['main_column_class'] = "col-12 col-xs-12 col-lg-7 col-xl-8" . $main_column_class;
                $column_classes['sidebar_class'] = "col-12 col-xs-12 col-lg-5 col-xl-4" . $sidebar_class;
                $column_classes['position'] = 'right';

            } //no catching right sidebar. Right sidebar is default
            else {

                //default - right sidebar
                $column_classes['main_column_class'] = "col-12 col-xs-12 col-lg-7 col-xl-8" . $main_column_class;
                $column_classes['sidebar_class'] = "col-12 col-xs-12 col-lg-5 col-xl-4" . $sidebar_class;
                $column_classes['position'] = 'right';

                //default for page is fullwidth - do we need this?
                if (is_page()) {
                    $column_classes['main_column_class'] = "col-12" . $main_column_class;
                    $column_classes['sidebar_class'] = false;
                    $column_classes['position'] = 'full';
                }

            }
        }

        if ($full_width || !weldo_is_active_widgets_in_main_sidebar_exists()) {
            $column_classes['main_column_class'] = "col-12" . $main_column_class;
            $column_classes['sidebar_class'] = false;
            $column_classes['position'] = 'full';
        }

        return $column_classes;

    }

endif; //weldo_get_columns_classes()

if (!function_exists('weldo_get_columns_classes_for_unyson_extended')) :
    /**
     * Define a sidebar position for manage main column CSS class, sidebar CSS class and visibility of sidebar.
     * return array
     */
    function weldo_get_columns_classes_for_unyson_extended($full_width = false)
    {

        // Sidebar Position

        // default
        $sidebar_position = apply_filters('weldo_default_sidebar_position', 'right');

        // get position
        if (function_exists('fw_ext_sidebars_get_current_position')) {
            $unyson_position = fw_ext_sidebars_get_current_position();
            if (null != $unyson_position) {
                $sidebar_position = $unyson_position;
            }
        }

        // is unyson sidebar
        $unyson_sidebar = false;
        if (function_exists('fw_ext_sidebars_get_current_preset')) {
            $unyson_sidebar = fw_ext_sidebars_get_current_preset();
        }

        // is sidebar empty ( no widgets )
        $empty = false;
        if (apply_filters('weldo_check_for_widgets', true)) {
            if (is_array($unyson_sidebar)) {
                if (array_key_exists('sidebars', (array)$unyson_sidebar)) {
                    if (array_key_exists('blue', $unyson_sidebar['sidebars'])) {
                        $sidebars_widgets = wp_get_sidebars_widgets();
                        if (is_array($sidebars_widgets)) {
                            if (empty($sidebars_widgets[$unyson_sidebar['sidebars']['blue']])) {
                                $empty = true;
                            }
                        }
                    }
                }
            } elseif (!is_active_sidebar('sidebar-main')) {
                $empty = true;
            }
        }

        // URL parameter
        if (isset($_GET['sidebar_position']) && !$empty) {
            $sidebar_position = esc_attr($_GET['sidebar_position']);
        }

        // direct forbidden
        if ($empty || is_page() || $full_width || 'attachment' == get_post_type()) {
            $sidebar_position = 'full';
        }


        // Content/Sidebar width

        $s = apply_filters('weldo_sidebar_width', 4);             // sidebar width

        $c = 12 - $s;       // content width


        // Content/Sidebar Classes

        // Sidebar Right
        $column_classes['main_column_class'] = 'col-sm-7 col-md-' . $c . ' col-lg-' . $c;
        $column_classes['sidebar_class'] = 'col-sm-5 col-md-' . $s . ' col-lg-' . $s;

        // Sidebar Left
        if ('left' == $sidebar_position) {
            $column_classes['main_column_class'] = 'col-sm-7 col-md-' . $c . ' col-lg-' . $c . ' col-sm-push-5 col-md-push-' . $s . ' col-lg-push-' . $s;
            $column_classes['sidebar_class'] = 'col-sm-5 col-md-' . $s . ' col-lg-' . $s . ' col-sm-pull-7 col-md-pull-' . $c . ' col-lg-pull-' . $c;
        }

        // No Sidebar
        if ('full' == $sidebar_position) {
            $column_classes['main_column_class'] = 'col-sm-12';
            $column_classes['sidebar_class'] = false;
        }

        return $column_classes;

    }

endif; //weldo_get_columns_classes_for_unyson_extended()


/**
 * Find out if blog has more than one category.
 *
 * @return boolean true if blog has more than 1 category
 */
if (!function_exists('weldo_categorized_blog')) :
    function weldo_categorized_blog()
    {
        if (false === ($all_categories = get_transient('weldo_category_count'))) {
            // Create an array of all the categories that are attached to posts
            $all_categories = get_categories(array(
                'hide_empty' => 1,
            ));

            // Count the number of categories that are attached to the posts
            $all_categories = count($all_categories);

            set_transient('weldo_category_count', $all_categories);
        }

        if (1 !== (int)$all_categories) {
            // This blog has more than 1 category so weldo_categorized_blog should return true
            return true;
        } else {
            // This blog has only 1 category so weldo_categorized_blog should return false
            return false;
        }
    }
endif; //weldo_categorized_blog()


//get predefined template part from theme options
if (!function_exists('weldo_get_predefined_template_part')) :
    /**
     * Return proper template part from options or default.
     * string $template_part_name
     */
    function weldo_get_predefined_template_part($template_part_name, $default_value = '1')
    {
        $template_part_name = sanitize_title_with_dashes($template_part_name);
        $options = weldo_get_options();

        $option_value = $options['page_' . $template_part_name];
        if ($option_value) {
            $template_part = $template_part_name . '-' . $option_value;
        } else {
            $template_part = $template_part_name . '-' . $default_value;
        }

        //hide breadcrumbs and override header for certain page - for demo and custom pages
        if (is_page() && function_exists('fw_get_db_post_option')) {
            global $post;
            //show or hide breadcrumbs
            if ('title' == $template_part_name && fw_get_db_post_option($post->ID, 'hide_title')) {
                //non-existent part
                $template_part = $template_part_name . '-999';
            }

            //custom header for certain page
            if ('header' == $template_part_name && fw_get_db_post_option($post->ID, 'header')) {
                $template_part = $template_part_name . '-' . fw_get_db_post_option($post->ID, 'header');
            }

            //custom footer for certain page
            if ('footer' == $template_part_name && fw_get_db_post_option($post->ID, 'footer')) {
                $template_part = $template_part_name . '-' . fw_get_db_post_option($post->ID, 'footer');
            }
        }

        //get template part from URL - for demo
        if (isset($_GET[$template_part_name])) {
            $template_part = esc_attr($template_part_name) . '-' . ( int )$_GET[$template_part_name];
        }

        return $template_part;
    }
endif; //weldo_get_predefined_template_part()

//get ids of showing widgets
if (!function_exists('weldo_get_showing_widgets_ids')) :
    /**
     * Return array of id's of all widgets that are showing.
     */

    function weldo_get_showing_widgets_ids()
    {
        $showing_widgets = wp_get_sidebars_widgets();
        $showing_widgets_ids = array();
        foreach ($showing_widgets as $sidebar_name => $sidebar_widgets) {
            foreach ($sidebar_widgets as $sidebar_widget_id) {
                if ($sidebar_name !== 'wp_inactive_widgets') {
                    $showing_widgets_ids[] = $sidebar_widget_id;
                }
            }
        }
        return $showing_widgets_ids;
    }
endif; //weldo_get_showing_widgets_ids

//returning first taxonomy of displayed archive or taxonomy
if (!function_exists('weldo_get_posts_single_taxonomy_name')) :
    function weldo_get_posts_single_taxonomy_name()
    {
        $queried_object = get_queried_object();
        $taxonomy_name = '';
        if (is_tax()) {
            $taxonomy_name = $queried_object->taxonomy;
        } elseif (is_singular()) {
            $taxonomies_array = get_object_taxonomies($queried_object);
            $taxonomy_name = $taxonomies_array[0];
        } else {
            $taxonomies_array = get_object_taxonomies($queried_object->name);
            $taxonomy_name = $taxonomies_array[0];
        }
        return $taxonomy_name;
    }
endif; //weldo_get_posts_single_taxonomy_name

//get all unique categories for all showing posts
if (!function_exists('weldo_get_post_categories')) :
    function weldo_get_post_categories($taxonomy_name = 'category')
    {
        //get all terms for filter
        if (have_posts()) :

            $all_categories = array();
            $categories = array();
            // Start the Loop.
            while (have_posts()) : the_post();
                $all_categories[] = get_the_terms(get_the_ID(), $taxonomy_name);
            endwhile;
            wp_reset_postdata();

            foreach ($all_categories as $post_categories) :
                foreach ($post_categories as $category) :
                    $categories[] = $category;
                endforeach;
            endforeach;

            $categories = array_unique($categories, SORT_REGULAR);

            return $categories;

        endif; //have_posts
    }
endif; //weldo_get_post_categories

//get all taxonomies slug for single post. Used inside loop
if (!function_exists('weldo_get_categories_slugs_for_single_post')) :
    function weldo_get_categories_slugs_for_single_post($taxonomy_name = 'category')
    {
        $term_objects = get_the_terms(get_the_ID(), $taxonomy_name);
        $item_filter_class = '';
        foreach ($term_objects as $term_object) {
            $item_filter_class .= ' ' . $term_object->slug;
        }

        return $item_filter_class;
    }
endif; //weldo_get_categories_slugs_for_single_post

//get icon styled css class
if (!function_exists('weldo_get_unyson_icon_styled_class')) :
    function weldo_get_unyson_icon_styled_class($atts)
    {
        if (!defined('FW')) {
            return '';
        }
        $class = $atts['icon_font_size'];
        $style_cololr_divider = ' ';

        if (strstr($atts['icon_style'], 'bg-')) {
            //main colors
            $atts['icon_color'] = str_replace('color-main', 'maincolor', $atts['icon_color']);
            //darkgrey colors
            $atts['icon_color'] = str_replace('color-', '', $atts['icon_color']);

            $style_cololr_divider = '';
        }

        return trim($class . ' ' . $atts['icon_style'] . $style_cololr_divider . $atts['icon_color']);
    }
endif; //weldo_get_unyson_icon_styled_class


//get icon array for special header for Unyson builder
if (!function_exists('weldo_get_unyson_icon_type_v2_array')) :
    function weldo_get_unyson_icon_type_v2_array($atts, $key)
    {
        if (!defined('FW')) {
            return array(
                'icon_html' => '',
                'icon_type' => false,
            );
        }
        $icon_array = $atts[$key];
        $icon_html = '';
        $icon_type = false;
        if ($icon_array['type'] === 'icon-font') {
            if ($icon_array['icon-class'] !== '') {
                $icon_html = '<i class="' . $icon_array['icon-class'] . '"></i>';
                $icon_type = 'icon';
            }
        } elseif ($icon_array['type'] === 'custom-upload') {
            $icon_html = '<img src="' . $icon_array['url'] . '" alt="' . esc_attr($icon_array['type']) . '" class="special-heading-image">';
            $icon_type = 'image';
        }
        return array(
            'icon_html' => $icon_html,
            'icon_type' => $icon_type,
        );
    }
endif; //weldo_get_unyson_icon_type_v2_array

if (!function_exists('weldo_get_unyson_icon_type_v2_array_for_special_heading')) :
    function weldo_get_unyson_icon_type_v2_array_for_special_heading($atts, $key)
    {

        if (!defined('FW')) {
            return false;
        }
        if (empty($atts['headings'][$key]['heading_icon'])) {
            return false;
        }
        $icon_array = $atts['headings'][$key]['heading_icon'];
        $icon_html = '';
        $icon_type = false;
        if ($icon_array['type'] === 'icon-font') {
            if ($icon_array['icon-class'] !== '') {
                $icon_html = '<i class="' . $icon_array['icon-class'] . '"></i>';
                $icon_type = 'icon';
            }
        } elseif ($icon_array['type'] === 'custom-upload') {
            $icon_html = '<img src="' . $icon_array['url'] . '" alt="' . esc_attr($atts['headings'][$key]['heading_text']) . '" class="special-heading-image">';
            $icon_type = 'image';
        }
        return array(
            'icon_html' => $icon_html,
            'icon_type' => $icon_type,
        );
    }
endif; //weldo_get_unyson_icon_type_v2_array_for_special_heading

//get the excerpt for page on search page even if only Unyson builder used - using in loop
if (!function_exists('weldo_get_excerpt_for_page_with_unyson_builder')) :
    function weldo_get_excerpt_for_page_with_unyson_builder()
    {
        $excerpt = apply_filters('the_excerpt', get_the_excerpt());
        if (empty($excerpt)) {
            $content = get_the_content();
            $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content));
            $content = preg_replace('+<h6 class=\"d-none\">.*</h6>+', '', $content);
            $content = str_replace(array('</p>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'), ' ', apply_filters('the_content', $content));
            $content = strip_tags($content);
            $excerpt = substr($content, 0, 200) . ' [...]';
        }
        return $excerpt;
    }
endif; //weldo_get_excerpt_for_page_with_unyson_builder

if (!function_exists('weldo_is_shop')) :
    function weldo_is_shop()
    {
        $res = false;
        if (class_exists('WooCommerce')) {
            if (is_shop()) {
                $res = true;
            }
        }
        return $res;
    }
endif; //weldo_is_shop

// check if is WooCommerce Products Page. Need for Customizer setting.
if (!function_exists('weldo_is_woocommerce_page')) :
    function weldo_is_woocommerce_page()
    {
        $res = false;
        if (class_exists('WooCommerce')) {
            if (is_woocommerce() || is_product_category() || is_product_tag()) {
                $res = true;
            }
        }
        return $res;
    }
endif; //weldo_is_woocommerce_page

if (!function_exists('weldo_var_export')) :
    function weldo_var_export($var)
    {
        echo '<pre>';
        var_export($var);
        echo '</pre>';
    }
endif; //weldo_var_export

if (!function_exists('weldo_get_root_colors_inline_styles_string')) {
    /**
     * Get ":root" colors inline styles string.
     */
    function weldo_get_root_colors_inline_styles_string(){
        $options = weldo_get_options();

        $color_defaults = array(
            'accent_color_1' => '#f2c014',
            'accent_color_2' => '#f23e14',
            'darkgrey_color' => '#23222d',
            'dark_color' => '#303849',
            'darkblue_color' => '#1a202e',
            'grey_color' => '#f7f8f8',
            'font_color' => '#303849',
        );
        $options['accent_color_1'] = !empty ($options['accent_color_1']) ? $options['accent_color_1'] : $color_defaults['accent_color_1'];
        $options['accent_color_2'] = !empty ($options['accent_color_2']) ? $options['accent_color_2'] : $color_defaults['accent_color_2'];
        $options['darkgrey_color'] = !empty ($options['darkgrey_color']) ? $options['darkgrey_color'] : $color_defaults['darkgrey_color'];
        $options['dark_color'] = !empty ($options['dark_color']) ? $options['dark_color'] : $color_defaults['dark_color'];
        $options['darkblue_color'] = !empty ($options['darkblue_color']) ? $options['darkblue_color'] : $color_defaults['darkblue_color'];
        $options['grey_color'] = !empty ($options['grey_color']) ? $options['grey_color'] : $color_defaults['grey_color'];
        $options['font_color'] = !empty ($options['font_color']) ? $options['font_color'] : $color_defaults['font_color'];

        $weldo_colors_string = '';

        // Accent colors from customizer
        $colorMain = sanitize_hex_color($options['accent_color_1']);
        $colorMain2 = sanitize_hex_color($options['accent_color_2']);
        $colorGrey = sanitize_hex_color($options['grey_color']);
        $fontColor = sanitize_hex_color($options['font_color']);
        $darkgreyColor = sanitize_hex_color($options['darkgrey_color']);
        $greyColor = sanitize_hex_color($options['grey_color']);
        $darkColor = sanitize_hex_color($options['dark_color']);

        $weldo_colors_string .= '--colorMain:' . sanitize_hex_color($options['accent_color_1']) . ';';
        $weldo_colors_string .= '--colorMain2:' . sanitize_hex_color($options['accent_color_2']) . ';';
        $weldo_colors_string .= '--darkgreyColor:' . sanitize_hex_color($options['darkgrey_color']) . ';';
        $weldo_colors_string .= '--darkColor:' . sanitize_hex_color($options['dark_color']) . ';';
        $weldo_colors_string .= '--darkBlueColor:' . sanitize_hex_color($options['darkblue_color']) . ';';
        $weldo_colors_string .= '--greyColor:' . sanitize_hex_color($options['grey_color']) . ';';
        $weldo_colors_string .= '--fontColor:' . sanitize_hex_color($options['font_color']) . ';';

        // fontColorDarker7
        $fontColorDarker7 = new Weldo_Color( $fontColor );
        $fontColorDarker7->darken( 7);
        $weldo_colors_string .= '--fontColorDarker7:#' . $fontColorDarker7->hex . ';';

        // fontColorDarker10
        $fontColorDarker10 = new Weldo_Color( $fontColor );
        $fontColorDarker10->darken( 10);
        $weldo_colors_string .= '--fontColorDarker10:#' . $fontColorDarker10->hex . ';';

        // greyColorDarker6
        $greyColorDarker6 = new Weldo_Color( $greyColor );
        $greyColorDarker6->darken( 6);
        $weldo_colors_string .= '--greyColorDarker6:#' . $greyColorDarker6->hex . ';';

        // colorMainLighten10
        $colorMainLighten10 = new Weldo_Color( $colorMain );
        $colorMainLighten10->lighten( 10);
        $weldo_colors_string .= '--colorMainLighten10:#' . $colorMainLighten10->hex . ';';


        $colorMainRgb     = new Weldo_Color( $colorMain );
        $fontColorRgb     = new Weldo_Color( $fontColor );
        $darkgreyColorRgb     = new Weldo_Color( $darkgreyColor );
        $darkColorRgb     = new Weldo_Color( $darkColor );
        // colorMainRgba05
        $weldo_colors_string .= '--colorMainRgba1:rgba(' . $colorMainRgb->rgbString() . ', 1);';
        $weldo_colors_string .= '--colorMainRgba06:rgba(' . $colorMainRgb->rgbString() . ', 0.6);';

        $weldo_colors_string .= '--colorMain2Rgba1:rgba(' . $colorMainRgb->rgbString() . ', 1);';

        $weldo_colors_string .= '--fontColorRgba02:rgba(' . $fontColorRgb->rgbString() . ', 0.2);';
        $weldo_colors_string .= '--fontColorRgba04:rgba(' . $fontColorRgb->rgbString() . ', 0.4);';

        $weldo_colors_string .= '--darkgreyColorRgba01:rgba(' . $darkgreyColorRgb->rgbString() . ', 0.1);';
        $weldo_colors_string .= '--darkgreyColorRgba02:rgba(' . $darkgreyColorRgb->rgbString() . ', 0.2);';
        $weldo_colors_string .= '--darkgreyColorRgba006:rgba(' . $darkgreyColorRgb->rgbString() . ', 0.06);';
        $weldo_colors_string .= '--darkgreyColorRgba019:rgba(' . $darkgreyColorRgb->rgbString() . ', 0.19);';
        $weldo_colors_string .= '--darkgreyColorRgba07:rgba(' . $darkgreyColorRgb->rgbString() . ', 0.7);';
        $weldo_colors_string .= '--darkgreyColorRgba08:rgba(' . $darkgreyColorRgb->rgbString() . ', 0.8);';

        $weldo_colors_string .= '--darkColorRgba01:rgba(' . $darkColorRgb->rgbString() . ', 0.1);';
        $weldo_colors_string .= '--darkColorRgba02:rgba(' . $darkColorRgb->rgbString() . ', 0.2);';
        $weldo_colors_string .= '--darkColorRgba09:rgba(' . $darkColorRgb->rgbString() . ', 0.9);';

        return $weldo_colors_string;
    }
}