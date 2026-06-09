<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Shortcode_Service extends FW_Shortcode {
	protected function _render( $atts, $content = null, $tag = '' ) {

		//get post type dynamically
		$ext_services_settings = fw()->extensions->get( 'services' )->get_settings();
		$post_type = $ext_services_settings['post_type'];
		$taxonomy_name = $ext_services_settings['taxonomy_name'];
		$in = ( ! empty( $atts['service'][0] ) ) ? array( $atts['service'][0] ) : array();

		$posts = $this->fw_get_posts_with_info( array(
			'post_type'      => $post_type,
			'orderby'        => 'post_date',
			'post__in'      => $in
		) );

		$view_path = $this->locate_path( '/views/view.php' );

		return fw_render_view( $view_path, array(
				'atts'  => $atts,
				'posts' => $posts
			)
		);

	}

	/**
	 * @param array $args
	 *
	 * @return 'WP_Query'
	 */
	public function fw_get_posts_with_info( $args = array() ) {
		$defaults = array(
			'orderby'        => 'post_date',
			'posts_per_page' => 1,
			'post_type'      => 'post',
		);

		$query = new WP_Query( wp_parse_args( $args, $defaults ) );

		//removed wp reset query

		return $query;
	}

	private function get_error_msg() {
		return '<p>' . esc_html__( 'No view found', 'mwt' ) . '</p>';
	}
}