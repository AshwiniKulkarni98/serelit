<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$class = ! empty( $atts['class'] ) ? $atts['class'] : '';

?>

<div
	class="owl-carousel woo-product-categories <?php echo esc_attr( $class ) ?>"
	data-loop="true"
	data-autoplay="true"
	data-nav="<?php echo esc_attr( $atts['nav'] ); ?>"
	data-margin="<?php echo esc_attr( $atts['margin'] ); ?>"
	data-responsive-xs="<?php echo esc_attr( $atts['responsive_xs'] ); ?>"
	data-responsive-sm="<?php echo esc_attr( $atts['responsive_sm'] ); ?>"
	data-responsive-md="<?php echo esc_attr( $atts['responsive_md'] ); ?>"
	data-responsive-lg="<?php echo esc_attr( $atts['responsive_lg'] ); ?>">

	<?php
	foreach ( $atts['cat'] as $cat ) {
		$filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/product-category/views/loop-item.php';
		if ( file_exists( $filepath ) ) {
			include( $filepath );
		} else {
			esc_html_e( 'View not found', 'weldo' );
		}
	}
?>

</div>