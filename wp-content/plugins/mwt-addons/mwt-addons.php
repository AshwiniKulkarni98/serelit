<?php
/*
Plugin Name: Modern Web Templates theme addons
Description: Additional functions for theme (post likes, views count, post share buttons).
Version:     1.2.0
Author:      mwtemplates
Author URI:  https://themeforest.net/user/mwtemplates/
License:     GPLv2 or later
*/


$plugin_path = plugin_dir_path(__FILE__ );

// Functions
if( get_template() !== 'weldo' ) {
	include_once( $plugin_path . 'functions.php' );
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//mods
require_once  plugin_dir_path( __FILE__ ) . '/mods/mod-post-likes.php';
require_once  plugin_dir_path( __FILE__ ) . '/mods/mod-post-views.php';
require_once  plugin_dir_path( __FILE__ ) . '/mods/mod-post-share-buttons.php';

//unyson extensions
require_once  plugin_dir_path( __FILE__ ) . '/mwt-unyson-extensions.php';

//custom widgets
require_once  plugin_dir_path( __FILE__ ) . '/mwt-widgets.php';



//adding user social contacts
if ( ! function_exists( 'mwt_filter_modify_user_contact_methods' ) ):
	function mwt_filter_modify_user_contact_methods( $profile_fields ) {

		// Add new fields
		$profile_fields['twitter']     = esc_html__( 'Twitter URL', 'mwt' );
		$profile_fields['facebook']    = esc_html__( 'Facebook URL', 'mwt' );
		$profile_fields['google_plus']    = esc_html__( 'Google Plus URL', 'mwt' );
		$profile_fields['custom_profile_image'] = esc_html__( 'Custom Profile Image', 'mwt' );

		return $profile_fields;

	}
endif; //function_exists
add_filter( 'user_contactmethods', 'mwt_filter_modify_user_contact_methods' );

//admin script for custom profile image
if ( ! function_exists( 'mwt_action_add_custom_profile_image_script' ) ) :
	function mwt_action_add_custom_profile_image_script() {
			$prefix = stristr(__FILE__, 'only_' ) ? WELDO_THEME_URI . '/ONLY_FOR_BITBUCKET/mwt-addons/' : plugin_dir_url(__FILE__) ;
			wp_enqueue_media();
			wp_enqueue_script(
				'mwt-custom-profile-image',
				$prefix . 'js/custom-profile-image.js',
				array( 'jquery' ),
				'1.0.0',
				true
			);
	} //mwt_action_add_custom_profile_image_script()
endif;
add_action( 'admin_enqueue_scripts', 'mwt_action_add_custom_profile_image_script' );

//Unyson Extensions Fix
if ( ! function_exists( '_mwt_fw_filter_github_api_url' ) ) :
  function _mwt_fw_filter_github_api_url( $url ) {
    return 'https://api.github.com';
  }
endif;

add_filter( 'fw_github_api_url', '_mwt_fw_filter_github_api_url', 999 );

