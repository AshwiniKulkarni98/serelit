<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/product-category/views/' . $atts['layout'] . '.php';
if ( file_exists( $filepath ) ) {
	include( $filepath );
} else {
	esc_html_e( 'View not found', 'weldo' );
}

?>