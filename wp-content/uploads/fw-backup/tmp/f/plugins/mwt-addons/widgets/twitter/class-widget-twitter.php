<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( defined( 'FW' ) && function_exists( 'fw_ext_social_twitter_get_connection' ) && function_exists( 'curl_exec' ) ) {

	class MWT_Widget_Twitter extends WP_Widget {

		/**
		 * @internal
		 */
		function __construct() {
			$widget_ops = array( 'description' => esc_html__('Twitter Feed', 'mwt' ) );
			parent::__construct( false, esc_html__( 'Theme - Twitter', 'mwt' ), $widget_ops );
		}

		/**
		 * @param array $args
		 * @param array $instance
		 */
		function widget( $args, $instance ) {
			extract( $args );

			$user          = esc_attr( $instance['user'] );
			$title         = esc_attr( $instance['title'] );
			$number        = ( (int) ( esc_attr( $instance['number'] ) ) > 0 ) ? esc_attr( $instance['number'] ) : 5;
			$title         = $before_title . $title . $after_title;


			$tweets = get_site_transient( 'scratch_tweets_' . $user . '_' . $number );

			if ( empty( $tweets ) ) {
				/* @var $connection TwitterOAuth */
				$connection = fw_ext_social_twitter_get_connection();
				$tweets     = $connection->get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $user . "&count=" . $number );
				set_site_transient( 'scratch_tweets_' . $user . '_' . $number, $tweets, 12 * HOUR_IN_SECONDS );
			}
			$widget_tweets = array();

			if ( empty( $tweets->errors ) ) {

				foreach ( $tweets as $key => $tweet ) :
					$widget_tweets[ $key ][ 'text' ]              = make_clickable( $tweet->text );
					$widget_tweets[ $key ][ 'created_at' ]        = mysql2date( 'F j, Y g:i a', $tweet->created_at );
					$widget_tweets[ $key ][ 'profile_image_url' ] = $tweet->user->profile_image_url;
					$widget_tweets[ $key ][ 'name' ]              = $tweet->user->name;
				endforeach;

				$filepath = MWT_WIDGETS_PLUGIN_PATH . '/widgets/twitter/views/widget.php';

				if ( file_exists( $filepath ) ) {
					include( $filepath );
				} else {
					esc_html_e( 'View not found', 'mwt' );
				}
			} else {
				esc_html_e( 'Twitter in Social Extension not configured', 'mwt' );
			}

		} //widget

		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'user' => '', 'number' => '', 'title' => '' ) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'mwt' ); ?> </label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				       value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"
				       id="<?php $this->get_field_id( 'title' ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'user' ) ); ?>"><?php esc_html_e( 'User', 'mwt' ); ?> :</label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'user' ) ); ?>"
				       value="<?php echo esc_attr( $instance['user'] ); ?>" class="widefat"
				       id="<?php $this->get_field_id( 'user' ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of tweets', 'mwt' ); ?>
					:</label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
				       value="<?php echo esc_attr( $instance['number'] ); ?>" class="widefat"
				       id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"/>
			</p>
		<?php
		}
	} //class
}