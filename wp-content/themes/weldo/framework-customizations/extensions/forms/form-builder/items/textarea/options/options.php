<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'rows_number' => array(
		'type' => 'short-text',
		'value' => '7',
		'label' => esc_html__( 'Number of rows', 'weldo' ),
		'desc' => esc_html__( 'Select number of rows for textarea', 'weldo' ),
	),
	'icon'       => array(
		'type'  => 'icon',
		'label' => esc_html__( 'Icon', 'weldo' ),
		'set'   => 'theme-fa-icons',
	),
	'icon_color' => array(
		'type' => 'select',
		'value' => '',
		'label' => esc_html__( 'Icon Color', 'weldo' ),
		'choices' => array(
			'' => esc_html__( 'Dark Color', 'weldo' ),
			'color-main' => esc_html__( 'Color Main', 'weldo' ),
			'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
			'color-light' => esc_html__( 'Light Color', 'weldo' ),
			'color-grey' => esc_html__( 'Grey Color', 'weldo' ),
		),
	),
);