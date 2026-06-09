<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$events = fw()->extensions->get( 'events' );
if ( empty( $events ) ) {
	return;
}


$cfg = array(
	'page_builder' => array(
		'title'       => esc_html__( 'Events', 'weldo' ),
		'description' => esc_html__( 'Events regular', 'weldo' ),
		'tab'         => esc_html__( 'Widgets', 'weldo' )
	)
);