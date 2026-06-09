<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<div class="custom_shortcode <?php echo esc_attr( $atts['custom_class'] ) ?>">
	<?php echo do_shortcode( $atts['title'] );?>
</div>
