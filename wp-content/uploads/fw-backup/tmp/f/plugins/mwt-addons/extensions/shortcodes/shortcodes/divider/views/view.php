<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/** Responsive Visibility **/
$extra_class = weldo_unyson_options_get_responsive_css_classes( $atts );

if ( 'line' === $atts['style']['ruler_type'] ): ?>
	<div class="fw-divider-line <?php echo esc_attr( $extra_class ); ?>"><hr/></div>
<?php endif; ?>

<?php if ( 'space' === $atts['style']['ruler_type'] ): ?>
	<div class="fw-divider-space <?php echo esc_attr( $extra_class ); ?>" style="margin-top: <?php echo (int) $atts['style']['space']['height']; ?>px;"></div>
<?php endif; ?>