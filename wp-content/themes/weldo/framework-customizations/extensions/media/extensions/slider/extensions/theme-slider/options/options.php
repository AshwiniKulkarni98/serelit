<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'class'  => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Slider Additional CSS class', 'weldo' ),
		'desc'  => esc_html__( 'Optional CSS class for slider section', 'weldo' ),
	),
	'nav' => array(
		'type'         => 'switch',
		'value'        => 'false',
		'label'        => esc_html__( 'Show slides navigation', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'Hide', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Show', 'weldo' ),
		),
	),
	'dots' => array(
		'type'         => 'switch',
		'value'        => 'false',
		'label'        => esc_html__( 'Show slide dots', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'Hide', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Show', 'weldo' ),
		),
	),
	'speed'  => array(
		'type'  => 'slider',
		'value' => 5000,
		'properties' => array(
			'min' => 2000,
			'max' => 10000,
			'step' => 200,

		),
		'label' => esc_html__('Slider speed', 'weldo'),
		'desc'  => esc_html__('In milliseconds', 'weldo'),
	),

);