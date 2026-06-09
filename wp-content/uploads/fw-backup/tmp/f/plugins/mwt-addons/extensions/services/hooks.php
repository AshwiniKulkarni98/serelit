<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Replace the content of the current template with the content of services view
 *
 * @param string $the_content
 *
 * @return string
 */
function _filter_fw_ext_services_the_content( $the_content ) {
	/**
	 * @var FW_Extension_Services $services
	 */
	$services = fw()->extensions->get( 'services' );

	return fw_render_view( $services->locate_view_path( 'content' ), array( 'the_content' => $the_content ) );
}

/**
 * Check if the there are defined views for the services templates, otherwise are used theme templates
 *
 * @param string $template
 *
 * @return string
 */
function _filter_fw_ext_services_template_include( $template ) {

	/**
	 * @var FW_Extension_Services $services
	 */
	$services = fw()->extensions->get( 'services' );

	if ( is_singular( $services->get_post_type_name() ) ) {

		if ( preg_match( '/single-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		if ( $services->locate_view_path( 'single' ) ) {
			return $services->locate_view_path( 'single' );
		} else {
			add_filter( 'the_content', '_filter_fw_ext_services_the_content' );
		}
	} else if ( is_tax( $services->get_taxonomy_name() ) && $services->locate_view_path( 'taxonomy' ) ) {

		if ( preg_match( '/taxonomy-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		return $services->locate_view_path( 'taxonomy' );
	} else if ( is_post_type_archive( $services->get_post_type_name() ) && $services->locate_view_path( 'archive' ) ) {
		if ( preg_match( '/archive-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		return $services->locate_view_path( 'archive' );
	}

	return $template;
}

add_filter( 'template_include', '_filter_fw_ext_services_template_include' );