<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( ! function_exists( 'weldo_post_like_button' ) ) :
	/**
	 * Print like button
	 */
	function weldo_post_like_button( $postID ) {
		if ( function_exists( 'mwt_post_like_button' ) ) {
			mwt_post_like_button( $postID );
		}
	} //weldo_post_like_button()
endif;

if ( ! function_exists( 'weldo_post_like_count' ) ) :
	/**
	 * Print like counter value
	 */
	function weldo_post_like_count( $postID ) {
		if ( function_exists( 'mwt_post_like_count' ) ) {
			mwt_post_like_count( $postID );
		}
	} //weldo_post_like_count()
endif;
