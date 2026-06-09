<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$options = array(
	'icon'    => array(
		'type'  => 'icon-v2',
		'label' => esc_html__('Choose an Icon', 'weldo'),
	),
);

