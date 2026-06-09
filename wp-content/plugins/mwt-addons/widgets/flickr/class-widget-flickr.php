<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( class_exists( 'MWT_Widget_Flickr' ) ) {
	return;
}

class MWT_Widget_Flickr extends WP_Widget {

	/**
	 * @internal
	 */
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_flickr',
			'description' => esc_html__( 'Add linked image with text', 'mwt' ),
		);
		parent::__construct( false, esc_html__( 'Theme - Flickr', 'mwt' ), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$flickr_id = esc_attr( $instance['flickr_id'] );
		$title     = esc_attr( $instance['title'] );
		$number    = ( (int) ( esc_attr( $instance['number'] ) ) > 0 ) ? esc_attr( $instance['number'] ) : 8;
		$title     = $before_title  . $title . $after_title;

		wp_enqueue_script(
			'theme-flickr-widget',
			plugin_dir_url(__FILE__ ) . 'static/js/jflickrfeed.min.js',
			array( 'jquery' ),
			'1.0'
		);

		$filepath = MWT_WIDGETS_PLUGIN_PATH . '/widgets/flickr/views/widget.php';

		if ( file_exists( $filepath ) ) {
			include( $filepath );
		} else {
			esc_html_e( 'View not found', 'mwt' );
		}

	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'flickr_id' => '', 'number' => '', 'title' => '' ) );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'mwt' ); ?> </label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"
			       id="<?php $this->get_field_id( 'title' ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>"><?php esc_html_e( 'Flickr ID', 'mwt' ); ?> (<a
					href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'flickr_id' ) ); ?>"
			       value="<?php echo esc_attr( $instance['flickr_id'] ); ?>" class="widefat"
			       id="<?php $this->get_field_id( 'flickr_id' ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'mwt' ); ?>
				:</label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
			       value="<?php echo esc_attr( $instance['number'] ); ?>" class="widefat"
			       id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"/>
		</p>
	<?php
	}
}
