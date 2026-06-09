<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( class_exists( 'MWT_Widget_Post_Tabs' ) ) {
	return;
}


class MWT_Widget_Post_Tabs extends WP_Widget {

	/**
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_tabs',
			'description' => esc_html__( 'Recent and Popular posts in tabs', 'mwt' ),
		);
		parent::__construct( false, esc_html__( 'Theme - Blog Tabs', 'mwt' ), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$number = ( (int) ( $instance['number'] ) > 0 ) ? esc_attr( $instance['number'] ) : 5;

		$recent_posts = $this->fw_get_posts_with_info( array(
			'sort'  => 'post_date',
			'items' => $number,
		) );

		$popular_posts = $this->fw_get_posts_with_info( array(
			'sort'  => 'comment_count',
			'items' => $number,
		) );


		$filepath = MWT_WIDGETS_PLUGIN_PATH . '/widgets/post-tabs/views/widget.php';

		if ( file_exists( $filepath ) ) {
			include( $filepath );
		} else {
			esc_html_e( 'View not found', 'mwt' );
		}
	}

	/**
	 * @param array $args
	 *
	 * @return array
	 */
	public function fw_get_posts_with_info( $args = array() ) {
		$defaults = array(
			'sort'        => 'recent',
			'items'       => 5,
			'image_post'  => true,
			'date_post'   => true,
			'date_format' => 'F jS, Y',
			'post_type'   => 'post',

		);

		extract( wp_parse_args( $args, $defaults ) );

		$query = new WP_Query( array(
			'post_type'           => $post_type,
			'orderby'             => $sort,
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $items
		) );

		//wp reset query removed

		return $query;
	}


	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'number' => '', 'title' => '' ) );
		$number   = esc_attr( $instance['number'] );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Blog posts', 'mwt' ); ?>
				:</label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $number ); ?>"
			       class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"/>
		</p>
		<?php
	}
}
