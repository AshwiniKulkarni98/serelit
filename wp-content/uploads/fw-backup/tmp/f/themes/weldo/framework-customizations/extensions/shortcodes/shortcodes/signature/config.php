<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Signature', 'weldo' ),
	'description' => esc_html__( 'Add a signature', 'weldo' ),
	'tab'         => esc_html__( 'Content Elements', 'weldo' )
);