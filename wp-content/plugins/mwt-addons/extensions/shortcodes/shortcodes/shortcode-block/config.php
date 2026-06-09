<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Shortcode block', 'weldo' ),
		'description' => esc_html__( 'Block for show shortcode', 'weldo' ),
		'tab'         => esc_html__( 'Content Elements', 'weldo' ),
	)
);