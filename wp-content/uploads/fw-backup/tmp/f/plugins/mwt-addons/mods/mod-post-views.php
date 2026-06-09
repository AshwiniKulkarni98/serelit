<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( ! function_exists( 'mwt_set_post_views' ) ) :
	/**
	 * Counter incrementor
	 *
	 * @param int $postID ID of the post.
	 */
	function mwt_set_post_views( $postID ) {
		$count_key = 'mwt_post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '1' );
		} else {
			//this fires twice for some unknown reason so we increase count by one half
			$count = $count + 0.5;
			update_post_meta( $postID, $count_key, $count );
		}
	} //mwt_set_post_views()
endif;

if ( ! function_exists( 'mwt_action_track_post_views' ) ) :
	/**
	 * Post views tracker
	 *
	 * @param int $post_id ID of the post.
	 */
	function mwt_action_track_post_views( $post_id = '' ) {
		if( ! is_singular('post' ) ) {
			return;
		}
		if ( empty ( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		mwt_set_post_views( $post_id );
	} //mwt_action_track_post_views()
endif;
add_action( 'shutdown', 'mwt_action_track_post_views' );

if ( ! function_exists( 'mwt_get_post_views' ) ) :
	/**
	 * Get counter value
	 *
	 * @param int $postID ID of the post.
	 */
	function mwt_get_post_views( $post_id ) {
		$count_key = 'mwt_post_views_count';
		$count     = get_post_meta( $post_id, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );

			return "0";
		}

		return number_format( $count, 0, ".", "," );
	} //mwt_action_track_post_views()
endif;

if ( ! function_exists( 'mwt_filter_post_column_views' ) ) :
	//Function that Adds a 'Views' Column to your Posts tab in WordPress Dashboard.
	function mwt_filter_post_column_views( $newcolumn ) {
		//Retrieves the translated string, if translation exists, and assign it to the 'default' array.
		$newcolumn['post_views'] = esc_html__( 'Views', 'mwt' );

		return $newcolumn;
	} //mwt_filter_post_column_views()
endif;

if ( ! function_exists( 'mwt_action_post_custom_column_views' ) ) :

	function mwt_action_post_custom_column_views( $column_name, $id ) {

		if ( $column_name === 'post_views' ) {

			echo mwt_get_post_views( get_the_ID() );
		}
	}
endif;

add_filter( 'manage_posts_columns', 'mwt_filter_post_column_views' );

add_action( 'manage_posts_custom_column', 'mwt_action_post_custom_column_views', 10, 2 );


if ( ! function_exists( 'mwt_show_post_views_count' ) ) :
	function mwt_show_post_views_count() {

		$id     = get_the_ID();
		$number = mwt_get_post_views( $id );
		$html   = '';

		if ( ! $number ) {
			$html = '<span class="item-views-count">0</span> <span class="item-views-word">' . esc_html__( 'Views', 'mwt' ) . '</span>';
		}

		if ( $number == 1 ) {
			$html = '<span class="item-views-count">1</span> <span class="item-views-word">' . esc_html__( 'View', 'mwt' ) . '</span>';
		}

		if ( $number > 1 ) {
			$html = '<span class="item-views-count">' . $number . '</span> <span class="item-views-word">' . esc_html__( 'Views', 'mwt' ) . '</span>';
		}

		echo wp_kses_post( $html );
	} //mwt_show_post_views_count()
endif;
