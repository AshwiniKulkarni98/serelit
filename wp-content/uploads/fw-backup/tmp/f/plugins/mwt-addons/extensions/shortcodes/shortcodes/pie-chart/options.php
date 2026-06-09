<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'size' => array(
		'type'       => 'slider',
		'value'      => 250,
		'properties' => array(
			'min'  => 150,
			'max'  => 350,
			'step' => 10,
		),
		'label'      => esc_html__( 'Chart Size (px)', 'weldo' ),
	),

	'line' => array(
		'type'       => 'slider',
		'value'      => 10,
		'properties' => array(
			'min'  => 1,
			'max'  => 40,
			'step' => 1,
		),
		'label'      => esc_html__( 'Line Width (px)', 'weldo' ),
	),

	'trackcolor' => array(
		'type'  => 'color-picker',
		'value' => '#c14240',
		'label' => esc_html__( 'Bar Color', 'weldo' ),
	),

	'bgcolor' => array(
		'type'  => 'color-picker',
		'value' => '#ffffff',
		'label' => esc_html__( 'Track Color', 'weldo' ),
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
	'speed'   => array(
		'type'       => 'slider',
		'value'      => 1000,
		'properties' => array(
			'min'  => 500,
			'max'  => 5000,
			'step' => 100,
		),
		'label'      => esc_html__( 'Percents Counter Speed', 'weldo' ),
		'desc'       => esc_html__( 'Choose counter speed (in milliseconds)', 'weldo' ),
	),
	'name'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Chart Name', 'weldo' ),
		'desc'  => esc_html__( 'Appears below percents number', 'weldo' ),
	),
);