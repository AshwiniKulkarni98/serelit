<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Replace the content of the current template with the content of team view
 *
 * @param string $the_content
 *
 * @return string
 */
function _filter_fw_ext_team_the_content( $the_content ) {
	/**
	 * @var FW_Extension_Team $team
	 */
	$team = fw()->extensions->get( 'team' );

	return fw_render_view( $team->locate_view_path( 'content' ), array( 'the_content' => $the_content ) );
}

/**
 * Check if the there are defined views for the team templates, otherwise are used theme templates
 *
 * @param string $template
 *
 * @return string
 */
function _filter_fw_ext_team_template_include( $template ) {

	/**
	 * @var FW_Extension_Team $team
	 */
	$team = fw()->extensions->get( 'team' );

	if ( is_singular( $team->get_post_type_name() ) ) {

		if ( preg_match( '/single-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		if ( $team->locate_view_path( 'single' ) ) {
			return $team->locate_view_path( 'single' );
		} else {
			add_filter( 'the_content', '_filter_fw_ext_team_the_content' );
		}
	} else if ( is_tax( $team->get_taxonomy_name() ) && $team->locate_view_path( 'taxonomy' ) ) {

		if ( preg_match( '/taxonomy-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		return $team->locate_view_path( 'taxonomy' );
	} else if ( is_post_type_archive( $team->get_post_type_name() ) && $team->locate_view_path( 'archive' ) ) {
		if ( preg_match( '/archive-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		return $team->locate_view_path( 'archive' );
	}

	return $template;
}

add_filter( 'template_include', '_filter_fw_ext_team_template_include' );

//team image size
if( ! function_exists( 'mwt_unyson_services_extension_add_image_sizes' ) ) :
	function mwt_unyson_services_extension_add_image_sizes() {
		add_image_size( 'mwt-team-member', 700, 700, true );
	}
endif;
add_action( 'init', 'mwt_unyson_services_extension_add_image_sizes' );
