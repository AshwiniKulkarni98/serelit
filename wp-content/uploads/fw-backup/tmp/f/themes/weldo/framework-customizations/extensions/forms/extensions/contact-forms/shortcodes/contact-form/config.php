<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Contact form', 'weldo' ),
	'description' => esc_html__( 'Build contact forms', 'weldo' ),
	'tab'         => esc_html__( 'Content Elements', 'weldo' ),
	'popup_size'  => 'large',
	'type'        => 'special'
);