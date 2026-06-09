<?php
/**
 * Dynamic colors
 */

//current selected colors for customizer.php
if ( ! function_exists( 'weldo_get_theme_current_colors' ) ) :
    function weldo_get_theme_current_colors() {
        /* Colors */
        $current_colors = array(
            'accent_color_1' => weldo_get_option( 'accent_color_1' ),
            'accent_color_2' => weldo_get_option( 'accent_color_2' ),
            'darkgrey_color' => weldo_get_option( 'darkgrey_color' ),
            'dark_color'     => weldo_get_option( 'dark_color' ),
            'darkblue_color' => weldo_get_option( 'darkblue_color' ),
            'grey_color'     => weldo_get_option( 'grey_color' ),
            'font_color'     => weldo_get_option( 'font_color' ),
        );
        return apply_filters( 'weldo_theme_current_colors', $current_colors );
    }
endif;

add_action('customize_controls_enqueue_scripts', 'weldo_action_customizer_enqueue_css_variables_script');
//live preview color scripts
if ( ! function_exists( 'weldo_action_customizer_enqueue_css_variables_script' ) ) :
    function weldo_action_customizer_enqueue_css_variables_script() {

        wp_register_script(
            'weldo-customizer-scss',
            WELDO_THEME_URI . '/js/theme-customizer-scss.js',
            array( 'jquery','customize-preview' ),
            WELDO_THEME_VERSION,
            true
        );

        wp_enqueue_script(
            'weldo-customizer-scss'
        );
    }
endif;