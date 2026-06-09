<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'class'            => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Slider Additional CSS class', 'weldo' ),
		'desc'  => esc_html__( 'Optional CSS class for slider section', 'weldo' ),
	),
	'nav'              => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'value'   => false,
		'picker'  => array(
			'show_nav' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Show slides navigation', 'weldo' ),
				'left-choice'  => array(
					'value' => '',
					'label' => esc_html__( 'Hide', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'nav',
					'label' => esc_html__( 'Show', 'weldo' ),
				),
			),
		),
		'choices' => array(
			''    => array(),
			'nav' => array(
				'nav_style' => array(
					'type'        => 'select',
					'value'       => 'nav-arrow',
					'label'       => esc_html__( 'Slides navigation style', 'weldo' ),
					'choices'     => array(
						'nav-text'  => esc_html__( 'Text', 'weldo' ),
						'nav-arrow' => esc_html__( 'Arrows', 'weldo' ),
					),
					/**
					 * Allow save not existing choices
					 * Useful when you use the select to populate it dynamically from js
					 */
					'no-validate' => false,
				),
			),
		),
	),
	'dots'             => array(
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
	'show_slide_count' => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show slide count', 'weldo' ),
		'desc'         => esc_html__( 'Show number on slide "01, 02, 03, etc."', 'weldo' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'Hide', 'weldo' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Show', 'weldo' ),
		),
	),
	'speed'            => array(
		'type'       => 'slider',
		'value'      => 5000,
		'properties' => array(
			'min'  => 2000,
			'max'  => 10000,
			'step' => 200,
		
		),
		'label'      => esc_html__( 'Slider speed', 'weldo' ),
		'desc'       => esc_html__( 'In milliseconds', 'weldo' ),
	),

);