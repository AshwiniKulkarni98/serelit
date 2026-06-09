<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Shortcode_Services extends FW_Shortcode {
	protected function _render( $atts, $content = null, $tag = '' ) {
		if ( ! isset( $atts['layout'] ) ) {
			return $this->get_error_msg();
		}

		//get post type dynamically
		$ext_services_settings = fw()->extensions->get( 'services' )->get_settings();
		$post_type = $ext_services_settings['post_type'];
		$taxonomy_name = $ext_services_settings['taxonomy_name'];
		$terms = $atts['cat'];
		$tax_query = false;
		//if some terms are selected in options - creating tax_query
		if ( ! empty( $terms ) ) {
			$tax_query = array(
				array(
					'taxonomy' => $taxonomy_name,
					'terms' => $atts['cat'],
				),
			);
		}
		$posts = $this->fw_get_posts_with_info( array(
			'post_type'      => $post_type,
			'orderby'        => 'post_date',
			'posts_per_page' => $atts['number'],
			'tax_query'      => $tax_query,

		) );

		$view_path = $this->locate_path( '/views/' . $atts['layout'] . '.php' );

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
			'posts_per_page' => 5,
			'post_type'      => 'post',
			'cat'            => false,
		);

		$query = new WP_Query( wp_parse_args( $args, $defaults ) );

		//removed wp reset query

		return $query;
	}

	private function get_error_msg() {
		return '<p>' . esc_html__( 'No view found', 'mwt' ) . '</p>';
	}
}