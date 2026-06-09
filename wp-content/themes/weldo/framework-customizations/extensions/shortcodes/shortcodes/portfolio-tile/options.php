<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$portfolio = fw() -> extensions -> get( 'portfolio' );
if ( empty( $portfolio ) ) {
	return;
}

$ext_portfolio_settings = fw() -> extensions -> get( 'portfolio' )->get_settings();
$taxonomy               = $ext_portfolio_settings['taxonomy_name'];

$options = array(
	'layout'       => array(
		'label'   => esc_html__( 'Portfolio Layout', 'weldo' ),
		'desc'    => esc_html__( 'Choose portfolio layout', 'weldo' ),
		'value'   => 'isotope-tile',
		'type'    => 'select',
		'choices' => array(
			'isotope-tile'  => esc_html__( 'Layout 1', 'weldo' ),
			'isotope-tile2' => esc_html__( 'Layout 2', 'weldo' ),
		)
	),
	'number'       => array(
		'type'       => 'slider',
		'value'      => 6,
		'properties' => array(
			'min'  => 1,
			'max'  => 120,
			'step' => 1, // Set slider step. Always > 0. Could be fractional.
		
		),
		'label'      => esc_html__( 'Items number', 'weldo' ),
		'desc'       => esc_html__( 'Number of portfolio projects to display', 'weldo' ),
	),
	'show_filters' => array(
		'type'         => 'switch',
		'value'        => false,
		'label'        => esc_html__( 'Show filters', 'weldo' ),
		'desc'         => esc_html__( 'Hide or show categories filters', 'weldo' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'cat'          => array(
		'type'        => 'multi-select',
		'label'       => esc_html__( 'Select categories', 'weldo' ),
		'desc'        => esc_html__( 'You can select one or more categories', 'weldo' ),
		'population'  => 'taxonomy',
		'source'      => $taxonomy,
		'prepopulate' => 100,
		'limit'       => 100,
	)
);