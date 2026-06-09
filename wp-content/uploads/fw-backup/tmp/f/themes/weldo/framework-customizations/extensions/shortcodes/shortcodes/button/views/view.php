<?php
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$custom_class = ( ! empty( $atts['custom_class'] ) ? $atts['custom_class'] : '' );

?>

<a href="<?php echo esc_attr( $atts['link'] ) ?>"
	target="<?php echo esc_attr( $atts['target'] ) ?>"
   class="<?php echo esc_attr( $atts['color'] . ' ' . $atts['size'] . ' ' . $atts['wide_button'] . ' ' . $custom_class ); ?>">
	<span><?php echo esc_html( $atts['label'] ); ?></span>
</a>
