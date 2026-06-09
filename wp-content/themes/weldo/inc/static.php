<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Include static files: javascript and css
 */

//removing default font awesome css style - we using our "font-awesome.css" file which contain font awesome
wp_deregister_style( 'fw-font-awesome' );
wp_deregister_style( 'font-awesome' );

//Add Theme Fonts
wp_enqueue_style(
	'font-awesome',
	WELDO_THEME_URI . '/css/font-awesome.css',
	array(),
	WELDO_THEME_VERSION
);

//Add Flaticon Fonts
wp_enqueue_style(
	'flaticon',
	WELDO_THEME_URI . '/css/flaticon.css',
	array(),
	WELDO_THEME_VERSION
);

//Add Icomoon Fonts
wp_enqueue_style(
	'icomoon',
	WELDO_THEME_URI . '/css/icomoon.css',
	array(),
	WELDO_THEME_VERSION
);

if ( is_admin_bar_showing() ) {
	//Add Frontend admin styles
	wp_register_style(
		'weldo-admin_bar',
		WELDO_THEME_URI . '/css/admin-frontend.css',
		array(),
		WELDO_THEME_VERSION
	);
	wp_enqueue_style( 'weldo-admin_bar' );
}

//styles and scripts below only for frontend: if in dashboard - exit
if ( is_admin() ) {
	return;
}

/**
 * Enqueue scripts and styles for the front end.
 */
// Add theme google font, used in the main stylesheet.
wp_enqueue_style(
	'weldo-google-font',
	weldo_google_font_url(),
	array(),
	WELDO_THEME_VERSION
);

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

if ( is_singular() && wp_attachment_is_image() ) {
	wp_enqueue_script(
		'weldo-keyboard-image-navigation',
		WELDO_THEME_URI . '/js/keyboard-image-navigation.js',
		array( 'jquery' ),
		WELDO_THEME_VERSION
	);
}

//plugins theme script
wp_enqueue_script(
	'weldo-modernizr',
	WELDO_THEME_URI . '/js/vendor/modernizr-custom.js',
	false,
	'3.6.0',
	false
);

///plugins theme script
wp_enqueue_script( 'bootstrap-bundle', WELDO_THEME_URI . '/js/vendor/bootstrap.bundle.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'affix', WELDO_THEME_URI . '/js/vendor/affix.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-appear', WELDO_THEME_URI . '/js/vendor/jquery.appear.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-cookie', WELDO_THEME_URI . '/js/vendor/jquery.cookie.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-easing', WELDO_THEME_URI . '/js/vendor/jquery.easing.1.3.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-hoverintent', WELDO_THEME_URI . '/js/vendor/jquery.hoverIntent.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'superfish', WELDO_THEME_URI . '/js/vendor/superfish.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'bootstrap-progressbar', WELDO_THEME_URI . '/js/vendor/bootstrap-progressbar.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-countdown', WELDO_THEME_URI . '/js/vendor/jquery.countdown.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-countto', WELDO_THEME_URI . '/js/vendor/jquery.countTo.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-easypiechart', WELDO_THEME_URI . '/js/vendor/jquery.easypiechart.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-scrollbar', WELDO_THEME_URI . '/js/vendor/jquery.scrollbar.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-localscroll', WELDO_THEME_URI . '/js/vendor/jquery.localScroll.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-scrollto', WELDO_THEME_URI . '/js/vendor/jquery.scrollTo.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-ui-totop', WELDO_THEME_URI . '/js/vendor/jquery.ui.totop.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-parallax', WELDO_THEME_URI . '/js/vendor/jquery.parallax-1.1.3.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'isotope-pkgd', WELDO_THEME_URI . '/js/vendor/isotope.pkgd.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'jquery-flexslider', WELDO_THEME_URI . '/js/vendor/jquery.flexslider-min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'owl-carousel', WELDO_THEME_URI . '/js/vendor/owl.carousel.min.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'photoswipe', WELDO_THEME_URI . '/js/vendor/photoswipe.js', array('jquery'), WELDO_THEME_VERSION, true );
wp_enqueue_script( 'photoswipe-ui-default', WELDO_THEME_URI . '/js/vendor/photoswipe-ui-default.min.js', array('jquery'), WELDO_THEME_VERSION, true );

//getting theme color scheme number
$color_scheme_number = weldo_get_option('color_scheme_number', '' );

if ( class_exists( 'WooCommerce' ) ) :

	// Add Theme Woo Styles and Scripts
	wp_enqueue_style(
		'weldo-woo',
		WELDO_THEME_URI . '/css/shop' . esc_attr( $color_scheme_number ) . '.css',
		array(),
		WELDO_THEME_VERSION
	);

	//you can include Woo related scripts here

endif; //WooCommerce

if ( class_exists( 'WooCommerce' ) ) :

	// Add Theme Woo Styles and Scripts
	wp_enqueue_style(
		'weldo-woo',
		WELDO_THEME_URI . '/css/booked' . esc_attr( $color_scheme_number ) . '.css',
		array(),
		WELDO_THEME_VERSION
	);

	//you can include Woo related scripts here

endif; //WooCommerce


//main theme script
wp_enqueue_script(
	'weldo-main',
	WELDO_THEME_URI . '/js/main.js',
	array( 'jquery' ),
	WELDO_THEME_VERSION,
	true
);

//if AccessPress is active
if ( class_exists( 'SC_Class' ) ) :
	wp_deregister_style( 'fontawesome-css' );
	wp_deregister_style( 'apsc-frontend-css' );
	wp_enqueue_style(
		'weldo-accesspress',
		WELDO_THEME_URI . '/css/accesspress.css',
		array(),
		WELDO_THEME_VERSION
	);
endif; //AccessPress

//Add Theme Booked Styles
if( class_exists('booked_plugin')) {
	wp_dequeue_style('booked-styles');
	wp_dequeue_style('booked-responsive');
	wp_enqueue_style(
		'weldo-booked',
		WELDO_THEME_URI . '/css/booked' . esc_attr( $color_scheme_number ) . '.css',
		array(),
		WELDO_THEME_VERSION
	);
}//Booked

// Add Bootstrap Style
wp_enqueue_style(
	'bootstrap',
	WELDO_THEME_URI . '/css/bootstrap.min.css',
	array(),
	WELDO_THEME_VERSION
);

// Add Animations Style
wp_enqueue_style(
	'weldo-animations',
	WELDO_THEME_URI . '/css/animations.css',
	array(),
	WELDO_THEME_VERSION
);

// Add Theme Style
wp_enqueue_style(
	'weldo-main',
	WELDO_THEME_URI . '/css/main' . esc_attr( $color_scheme_number ) . '.css',
	array(),
	WELDO_THEME_VERSION
);
// Add ":root" colors inline styles string
$weldo_colors_string = weldo_get_root_colors_inline_styles_string();
if ( ! empty( $weldo_colors_string ) )
{
    wp_add_inline_style
    (
        'weldo-main',
        wp_kses
        (
            ':root{' . $weldo_colors_string . '}',
            false
        )
    );
}

// Add Theme stylesheet.
wp_enqueue_style( 'weldo-style', get_stylesheet_uri(), array(), WELDO_THEME_VERSION );

wp_add_inline_style( 'weldo-main', weldo_add_font_styles_in_head() );
wp_add_inline_style( 'weldo-main', weldo_custom() );

//Theme Skin
$skin = weldo_get_option('skin', '' );
if( ! empty( $skin ) ) {
	wp_enqueue_style(
		'weldo-skin',
		WELDO_THEME_URI . '/css/' . esc_attr( $skin ) . '.css',
		array(),
		WELDO_THEME_VERSION
	);
}

if( defined('FW') ) :

	//function for enqueue styles and scripts for section video background
	if (! function_exists( 'weldo_unyson_enqueue_section_video_background_scripts' ) ) :
		function weldo_unyson_enqueue_section_video_background_scripts() {

			// fixes https://github.com/ThemeFuse/Unyson/issues/1552
			{
				global $is_safari;

				if ($is_safari) {
					wp_enqueue_script('youtube-iframe-api', 'https://www.youtube.com/iframe_api');
				}
			}

			wp_enqueue_style(
				'weldo-shortcode-section-background-video',
				WELDO_THEME_URI . '/framework-customizations/extensions/shortcodes/shortcodes/section/static/css/background.css'
			);

			wp_enqueue_script(
				'weldo-shortcode-section-formstone-core',
				WELDO_THEME_URI . '/framework-customizations/extensions/shortcodes/shortcodes/section/static/js/core.js',
				array( 'jquery' ),
				false,
				true
			);
			wp_enqueue_script(
				'weldo-shortcode-section-formstone-transition',
				WELDO_THEME_URI . '/framework-customizations/extensions/shortcodes/shortcodes/section/static/js/transition.js',
				array( 'jquery' ),
				false,
				true
			);
			wp_enqueue_script(
				'weldo-shortcode-section-formstone-background',
				WELDO_THEME_URI . '/framework-customizations/extensions/shortcodes/shortcodes/section/static/js/background.js',
				array( 'jquery' ),
				false,
				true
			);
			wp_enqueue_script(
				'weldo-shortcode-section',
				WELDO_THEME_URI . '/framework-customizations/extensions/shortcodes/shortcodes/section/static/js/background.init.js',
				array(
					'weldo-shortcode-section-formstone-core',
					'weldo-shortcode-section-formstone-transition',
					'weldo-shortcode-section-formstone-background'
				),
				false,
				true
			);
		}
	endif;
endif;

