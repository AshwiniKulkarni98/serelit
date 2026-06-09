<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'title' => array(
		'type'       => 'text',
		'value'      => '',
		'label'      => esc_html__( 'Progress Bar title', 'weldo' ),
	),
	'percent' => array(
		'type'       => 'slider',
		'value'      => 80,
		'properties' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'label'      => esc_html__( 'Count To', 'weldo' ),
		'desc'       => esc_html__( 'Choose percent to count to', 'weldo' ),
	),
	'background_class' => array(
		'type'    => 'select',
		'value'   => 'progress-bar-success',
		'label'   => esc_html__( 'Context background color', 'weldo' ),
		'desc'    => esc_html__( 'Select one of predefined background colors', 'weldo' ),
		'choices' => array(
			'bg-maincolor' => esc_html__( 'Color Main', 'weldo' ),
			'bg-maincolor2' => esc_html__( 'Color Main 2', 'weldo' ),
			'bg-success' => esc_html__( 'Success', 'weldo' ),
			'bg-info'    => esc_html__( 'Info', 'weldo' ),
			'bg-warning' => esc_html__( 'Warning', 'weldo' ),
			'bg-danger'  => esc_html__( 'Danger', 'weldo' ),

		),
	),
);