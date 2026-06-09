<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( ! function_exists( 'mwt_set_post_likes' ) ) :
	/**
	 * Likes incrementor
	 *
	 * @param int $postID ID of the post.
	 *
	 * @return bool No success if cookies are disabled
	 */
	function mwt_set_post_likes( $postID ) {
		if ( empty( $_COOKIE["$postID"] ) ) {

			$count_key = 'mwt_post_likes_count';
			$count     = get_post_meta( $postID, $count_key, true );
			if ( $count == '' ) {
				$count = 0;
				delete_post_meta( $postID, $count_key );
				add_post_meta( $postID, $count_key, '1' );
			} else {
				$count ++;
				update_post_meta( $postID, $count_key, $count );
			}
			setcookie( "$postID", "voted", strtotime( '+1 day' ), COOKIEPATH, COOKIE_DOMAIN, false ); // 86400 = 1 day
			return true;
		}

		return false;
	} //mwt_set_post_likes()
endif;

if ( ! function_exists( 'mwt_get_post_likes' ) ) :
	/**
	 * Get likes value
	 *
	 * @param int $postID ID of the post.
	 */
	function mwt_get_post_likes( $postID ) {
		$count_key = 'mwt_post_likes_count';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );

			return '0';
		}

		return $count;
	} //mwt_get_post_likes()
endif;

if ( ! function_exists( 'mwt_print_post_likes' ) ) :
	/**
	 * Get likes value
	 *
	 * @param int $count of likes of the post.
	 */
	function mwt_print_post_likes( $count ) {
		$html = '';
		if ( ! $count ) {
			$html = '<span class="item-likes-count">0</span> <span class="item-likes-word">' . esc_html__( 'Likes', 'mwt' ) . '</span>';
		}

		if ( $count == 1 ) {
			$html = '<span class="item-likes-count">1</span> <span class="item-likes-word">' . esc_html__( 'Like', 'mwt' ) . '</span>';
		}

		if ( $count > 1 ) {
			$html = '<span class="item-likes-count">' . $count . '</span> <span class="item-likes-word">' . esc_html__( 'Likes', 'mwt' ) . '</span>';
		}

		return $html;
	} //mwt_print_post_likes()
endif;

if ( ! function_exists( 'mwt_post_likes_scripts' ) ) :
	// Add the JS
	function mwt_post_likes_scripts() {
		// if is plugin
		if( strpos(__FILE__, 'plugins') ) {
			wp_enqueue_script( 'post-likes', plugin_dir_url(__FILE__) . 'static/js/mod-post-likes.js', array( 'jquery' ), '1.0.0', true );
		//theme
		} else {
			wp_enqueue_script( 'post-likes', WELDO_THEME_URI . '/ONLY_FOR_BITBUCKET/mwt-addons/mods/static/js/mod-post-likes.js', array( 'jquery' ), '1.0.0', true );
		}
		wp_localize_script( 'post-likes', 'MyAjax', array(
			'ajaxurl'  => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'increment-post-likes' )//,
		) );
	} //mwt_post_likes_scripts()
endif;
add_action( 'wp_enqueue_scripts', 'mwt_post_likes_scripts' );

if ( ! function_exists( 'mwt_inc_post_like_callback' ) ) :
	// The function that handles the AJAX request
	function mwt_inc_post_like_callback() {
		check_ajax_referer( 'increment-post-likes', 'security' );
		$pID = intval( $_POST['pID'] );
		mwt_set_post_likes( $pID );
		echo mwt_print_post_likes( mwt_get_post_likes( $pID ) );

		die(); // this is required to return a proper result
	} //mwt_inc_post_like_callback()
endif;
add_action( 'wp_ajax_add_like', 'mwt_inc_post_like_callback' );
add_action( 'wp_ajax_nopriv_add_like', 'mwt_inc_post_like_callback' );

if ( ! function_exists( 'mwt_post_like_button' ) ) :
	/**
	 * Print like button
	 */
	function mwt_post_like_button( $postID ) {
		$output = '';
		if ( empty( $_COOKIE["$postID"] ) ) {
			$output = '<span data-id="' . $postID . '"><a href="" class="like_button like_active_button"><i class="fs-14 fw-900 fa fa-heart-o"></i></a></span>';
		} else {
			$output = '<span data-id="' . $postID . '"><span class="like_button"><i class="fs-14 fw-900 fa fa-heart"></i></span></span>';
		}
		echo apply_filters( 'mwt_like_button', $output );
	} //mwt_post_like_button()
endif;
add_action( 'mwt_post_meta', 'mwt_post_like_button', 10, 1 );

if ( ! function_exists( 'mwt_post_like_count' ) ) :
	/**
	 * Print like counter value
	 */
	function mwt_post_like_count( $postID ) {
		echo apply_filters( 'mwt_like_count', '<span class="votes_count votes_count_' . $postID . '">' . mwt_print_post_likes( mwt_get_post_likes( $postID ) ) . '</span>' );
	} //mwt_post_like_count()
endif;
add_action( 'mwt_post_meta', 'mwt_post_like_count', 20, 1 );