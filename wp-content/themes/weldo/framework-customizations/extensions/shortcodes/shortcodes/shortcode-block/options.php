<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title'  => array(
		'label' => esc_html__( 'Shortcode Code', 'weldo' ),
		'type'  => 'text',
		'value' => ''
	),
	'custom_class'  => array(
		'label' => esc_html__( 'Shortcode Custom Class', 'weldo' ),
		'type'  => 'text',
		'value' => ''
	),
);