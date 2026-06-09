<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * @var $number
 * @var $before_widget
 * @var $after_widget
 * @var $title
 * @var $posts
 */
echo wp_kses_post( $before_widget );
echo wp_kses_post( $title );
?>
<ul class="links-darkgrey">
	<?php
	foreach ( $posts as $post ) {
		if ( isset( $post->message ) ) {
			echo '<li><a href="' . esc_url( 'https://facebook.com/' . $post->id . '/') . '">' . wp_kses_post( wp_trim_words( $post->message, 24 ) ) . '</a></li>';
		}
	}
	?>
</ul>
<?php echo wp_kses_post( $after_widget ); ?>