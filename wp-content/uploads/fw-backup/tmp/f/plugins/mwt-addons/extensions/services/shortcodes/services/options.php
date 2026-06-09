<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext_services_settings = fw() -> extensions -> get( 'services' )->get_settings();
$taxonomy              = $ext_services_settings['taxonomy_name'];

$options = array(
	'number'             => array(
		'type'       => 'slider',
		'value'      => 6,
		'properties' => array(
			'min'  => 1,
			'max'  => 120,
			'step' => 1, // Set slider step. Always > 0. Could be fractional.
		
		),
		'label'      => esc_html__( 'Items number', 'mwt' ),
		'desc'       => esc_html__( 'Number of posts to display', 'mwt' ),
	),
	'nav'                => array(
		'type'         => 'switch',
		'value'        => 'true',
		'label'        => esc_html__( 'Show Navigation', 'mwt' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'autoplay'           => array(
		'type'         => 'switch',
		'value'        => 'true',
		'label'        => esc_html__( 'Items Autoplay', 'mwt' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'loop'               => array(
		'type'         => 'switch',
		'value'        => 'true',
		'label'        => esc_html__( 'Items Loop', 'mwt' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'gutter_margins'     => array(
		'label'   => esc_html__( 'Gutter (padding)', 'mwt' ),
		'desc'    => esc_html__( 'Select padding between item', 'mwt' ),
		'value'   => '30',
		'type'    => 'select',
		'choices' => array(
			'c-gutter-0'  => esc_html__( '0', 'mwt' ),
			'c-gutter-10' => esc_html__( '10px', 'mwt' ),
			'c-gutter-20' => esc_html__( '20px', 'mwt' ),
			'c-gutter-30' => esc_html__( '30px', 'mwt' ),
			'c-gutter-45' => esc_html__( '45px', 'mwt' ),
			'c-gutter-50' => esc_html__( '50px', 'mwt' ),
			'c-gutter-60' => esc_html__( '60px', 'mwt' ),
			'c-gutter-70' => esc_html__( '70px', 'mwt' ),
			'c-gutter-90' => esc_html__( '90px', 'mwt' ),
		)
	),
	'vertical_margins'   => array(
		'type'    => 'select',
		'label'   => esc_html__( 'Column vertical margins', 'mwt' ),
		'value'   => '30',
		'help'    => esc_html__( 'Choose columns vertical margins value',
			'mwt' ),
		'choices' => array(
			'0'  => esc_html__( '0', 'mwt' ),
			'1'  => esc_html__( '1px', 'mwt' ),
			'2'  => esc_html__( '2px', 'mwt' ),
			'10' => esc_html__( '10px', 'mwt' ),
			'30' => esc_html__( '30px', 'mwt' ),
			'40' => esc_html__( '40px', 'mwt' ),
			'45' => esc_html__( '45px', 'mwt' ),
			'50' => esc_html__( '50px', 'mwt' ),
			'60' => esc_html__( '60px', 'mwt' ),
		),
	),
	'layout'             => array(
		'label'   => esc_html__( 'Layout', 'mwt' ),
		'desc'    => esc_html__( 'Choose layout', 'mwt' ),
		'value'   => 'carousel',
		'type'    => 'select',
		'choices' => array(
			'carousel' => esc_html__( 'Carousel', 'mwt' ),
			'isotope'  => esc_html__( 'Masonry Grid', 'mwt' ),
		)
	),
	'layout_item'        => array(
		'label'   => esc_html__( 'Choose Layout Content', 'mwt' ),
		'type'    => 'select', // or 'short-select'
		'value'   => '',
		'choices' => array(
			''  => esc_html__( 'Service Image', 'mwt' ),
			'3' => esc_html__( 'Service Image 2', 'mwt' ),
			'5' => esc_html__( 'Service Image 3', 'mwt' ),
			'2' => esc_html__( 'Service Icons', 'mwt' ),
			'4' => esc_html__( 'Service Icons 2', 'mwt' ),
		),
	),
	'show_service_count' => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show Service Count', 'mwt' ),
		'desc'         => esc_html__( 'Show or hide number of service', 'mwt' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => 'item-steps',
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'content_padding'    => array(
		'type'         => 'switch',
		'value'        => 'service-padding',
		'label'        => esc_html__( 'Service Padding', 'mwt' ),
		'desc'         => esc_html__( 'Use default service padding', 'mwt' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => 'service-padding',
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'hide_image'         => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Hide Service Image/Icon', 'mwt' ),
		'desc'         => esc_html__( 'Show or hide service image/icon', 'mwt' ),
		'left-choice'  => array(
			'value' => true,
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => false,
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'responsive_lg'      => array(
		'label'   => esc_html__( 'Columns on large screens', 'mwt' ),
		'desc'    => esc_html__( 'Select items number on wide screens (>1200px)', 'mwt' ),
		'value'   => '4',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'mwt' ),
			'2' => esc_html__( '2', 'mwt' ),
			'3' => esc_html__( '3', 'mwt' ),
			'4' => esc_html__( '4', 'mwt' ),
			'6' => esc_html__( '6', 'mwt' ),
		)
	),
	'responsive_md'      => array(
		'label'   => esc_html__( 'Columns on middle screens', 'mwt' ),
		'desc'    => esc_html__( 'Select items number on middle screens (>992px)', 'mwt' ),
		'value'   => '3',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'mwt' ),
			'2' => esc_html__( '2', 'mwt' ),
			'3' => esc_html__( '3', 'mwt' ),
			'4' => esc_html__( '4', 'mwt' ),
			'6' => esc_html__( '6', 'mwt' ),
		)
	),
	'responsive_sm'      => array(
		'label'   => esc_html__( 'Columns on small screens', 'mwt' ),
		'desc'    => esc_html__( 'Select items number on small screens (>768px)', 'mwt' ),
		'value'   => '2',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'mwt' ),
			'2' => esc_html__( '2', 'mwt' ),
			'3' => esc_html__( '3', 'mwt' ),
			'4' => esc_html__( '4', 'mwt' ),
			'6' => esc_html__( '6', 'mwt' ),
		)
	),
	'responsive_xs'      => array(
		'label'   => esc_html__( 'Columns on extra small screens', 'mwt' ),
		'desc'    => esc_html__( 'Select items number on extra small screens (<767px)', 'mwt' ),
		'value'   => '1',
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html__( '1', 'mwt' ),
			'2' => esc_html__( '2', 'mwt' ),
			'3' => esc_html__( '3', 'mwt' ),
			'4' => esc_html__( '4', 'mwt' ),
			'6' => esc_html__( '6', 'mwt' ),
		)
	),
	'show_filters'       => array(
		'type'         => 'switch',
		'value'        => false,
		'label'        => esc_html__( 'Show filters', 'mwt' ),
		'desc'         => esc_html__( 'Hide or show categories filters', 'mwt' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'mwt' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'mwt' ),
		),
	),
	'cat'                => array(
		'type'        => 'multi-select',
		'label'       => esc_html__( 'Select categories', 'mwt' ),
		'desc'        => esc_html__( 'You can select one or more categories', 'mwt' ),
		'population'  => 'taxonomy',
		'source'      => $taxonomy,
		'prepopulate' => 10,
		'limit'       => 100,
	)
);