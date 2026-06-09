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
	'layout'        => array(
		'label'   => esc_html__( 'Portfolio Layout', 'weldo' ),
		'desc'    => esc_html__( 'Choose projects layout', 'weldo' ),
		'value'   => 'isotope',
		'type'    => 'select',
		'choices' => array(
			'carousel' => esc_html__( 'Carousel', 'weldo' ),
			'isotope'  => esc_html__( 'Masonry Grid', 'weldo' ),
		)
	),
	'item_layout'   => array(
		'label'   => esc_html__( 'Item layout', 'weldo' ),
		'desc'    => esc_html__( 'Choose Item layout', 'weldo' ),
		'value'   => 'item-regular',
		'type'    => 'select',
		'choices' => array(
			'item-regular'   => esc_html__( 'Regular (just image)', 'weldo' ),
			'item-regular2'  => esc_html__( 'Regular 2 (just image)', 'weldo' ),
			'item-regular3'  => esc_html__( 'Regular 3 (just image)', 'weldo' ),
			'item-title'     => esc_html__( 'Image with title', 'weldo' ),
			'item-title2'    => esc_html__( 'Image with title 2', 'weldo' ),
			'item-title3'    => esc_html__( 'Image with title 3', 'weldo' ),
			'item-extended'  => esc_html__( 'Image with title and excerpt', 'weldo' ),
			'item-extended2' => esc_html__( 'Image with title and excerpt 2', 'weldo' ),
			'item-extended3' => esc_html__( 'Image with title and excerpt 3', 'weldo' ),
		)
	),
	'number'        => array(
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
	'margin'        => array(
		'label'   => esc_html__( 'Horizontal item margin (px)', 'weldo' ),
		'desc'    => esc_html__( 'Select horizontal item margin', 'weldo' ),
		'value'   => '30',
		'type'    => 'select',
		'choices' => array(
			'0'  => esc_html__( '0', 'weldo' ),
			'1'  => esc_html__( '1px', 'weldo' ),
			'2'  => esc_html__( '2px', 'weldo' ),
			'10' => esc_html__( '10px', 'weldo' ),
			'30' => esc_html__( '30px', 'weldo' ),
		)
	),
	'responsive_lg' => array(
		'label'   => esc_html__( 'Columns on wide screens', 'weldo' ),
		'desc'    => esc_html__( 'Select items number on wide screens (>1200px)', 'weldo' ),
		'value'   => '4',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'weldo' ),
			'2' => esc_html__( '2', 'weldo' ),
			'3' => esc_html__( '3', 'weldo' ),
			'4' => esc_html__( '4', 'weldo' ),
			'6' => esc_html__( '6', 'weldo' ),
		)
	),
	'responsive_md' => array(
		'label'   => esc_html__( 'Columns on middle screens', 'weldo' ),
		'desc'    => esc_html__( 'Select items number on middle screens (>992px)', 'weldo' ),
		'value'   => '3',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'weldo' ),
			'2' => esc_html__( '2', 'weldo' ),
			'3' => esc_html__( '3', 'weldo' ),
			'4' => esc_html__( '4', 'weldo' ),
			'6' => esc_html__( '6', 'weldo' ),
		)
	),
	'responsive_sm' => array(
		'label'   => esc_html__( 'Columns on small screens', 'weldo' ),
		'desc'    => esc_html__( 'Select items number on small screens (>768px)', 'weldo' ),
		'value'   => '2',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'weldo' ),
			'2' => esc_html__( '2', 'weldo' ),
			'3' => esc_html__( '3', 'weldo' ),
			'4' => esc_html__( '4', 'weldo' ),
			'6' => esc_html__( '6', 'weldo' ),
		)
	),
	'responsive_xs' => array(
		'label'   => esc_html__( 'Columns on extra small screens', 'weldo' ),
		'desc'    => esc_html__( 'Select items number on extra small screens (<767px)', 'weldo' ),
		'value'   => '1',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'weldo' ),
			'2' => esc_html__( '2', 'weldo' ),
			'3' => esc_html__( '3', 'weldo' ),
			'4' => esc_html__( '4', 'weldo' ),
			'6' => esc_html__( '6', 'weldo' ),
		)
	),
	'image_overlay' => array(
		'type'         => 'switch',
		'value'        => false,
		'label'        => esc_html__( 'Show Overlay', 'weldo' ),
		'desc'         => esc_html__( 'Show or hide dark image overlay', 'weldo' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'nav'           => array(
		'type'         => 'switch',
		'value'        => 'true',
		'label'        => esc_html__( 'Show Navigation', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'autoplay'      => array(
		'type'         => 'switch',
		'value'        => 'true',
		'label'        => esc_html__( 'Carousel Autoplay', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'loop'          => array(
		'type'         => 'switch',
		'value'        => 'true',
		'label'        => esc_html__( 'Carousel Loop', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'show_filters'  => array(
		'type'         => 'switch',
		'value'        => false,
		'label'        => esc_html__( 'Show Filters', 'weldo' ),
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
	'cat'           => array(
		'type'        => 'multi-select',
		'label'       => esc_html__( 'Select categories', 'weldo' ),
		'desc'        => esc_html__( 'You can select one or more categories', 'weldo' ),
		'population'  => 'taxonomy',
		'source'      => $taxonomy,
		'prepopulate' => 100,
		'limit'       => 100,
	)
);