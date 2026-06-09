<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$extra_class = weldo_unyson_options_get_divider_css_classes( $atts );
?>
<div class="fw-divider-space <?php echo esc_attr( $extra_class ); ?>"></div>
