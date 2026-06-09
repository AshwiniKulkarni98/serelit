<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$portfolio = fw()->extensions->get( 'portfolio' );
if ( empty( $portfolio ) ) {
	return;
}


$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Portfolio', 'weldo' ),
		'description' => esc_html__( 'Portfolio project various views', 'weldo' ),
		'tab'         => esc_html__( 'Widgets', 'weldo' )
	)
);