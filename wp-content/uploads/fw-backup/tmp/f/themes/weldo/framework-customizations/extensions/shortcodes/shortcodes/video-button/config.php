<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Video Button', 'weldo' ),
	'description' => esc_html__( 'Add a button with linked video', 'weldo' ),
	'tab'         => esc_html__( 'Media Elements', 'weldo' )
);