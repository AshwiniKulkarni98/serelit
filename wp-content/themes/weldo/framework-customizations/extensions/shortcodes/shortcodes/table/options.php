<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'table'      => array(
		'type'  => 'table',
		'label' => false,
		'desc'  => false,
	),
	'table_type' => array(
		'type'    => 'select',
		'value'   => 'table',
		'label'   => esc_html__( 'Tabular table style', 'weldo' ),
		'choices' => array(
			'table'                => esc_html__( 'Bootstrap Default', 'weldo' ),
			'table table-striped'  => esc_html__( 'Bootstrap Striped', 'weldo' ),
			'table table-bordered' => esc_html__( 'Bootstrap Bordered', 'weldo' ),
			''  => esc_html__( 'No style', 'weldo' ),

		),
	),
	'price_sign' => array(
		'type'    => 'text',
		'value'   => '$',
		'label'   => esc_html__( 'Pricing currency sign', 'weldo' ),
	),
);