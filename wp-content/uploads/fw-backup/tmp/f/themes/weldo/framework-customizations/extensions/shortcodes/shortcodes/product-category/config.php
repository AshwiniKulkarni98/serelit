<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Product Categories', 'weldo' ),
		'description' => esc_html__( 'Show available product categories', 'weldo' ),
		'tab'         => esc_html__( 'Widgets', 'weldo' ),
	)
);