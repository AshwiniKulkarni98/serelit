<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'layout'        => array(
		'label'   => esc_html__( 'Product Category Layout', 'weldo' ),
		'desc'    => esc_html__( 'Choose product category layout', 'weldo' ),
		'value'   => 'isotope',
		'type'    => 'select',
		'choices' => array(
			'carousel' => esc_html__( 'Carousel', 'weldo' ),
			'isotope'  => esc_html__( 'Masonry Grid', 'weldo' ),
		)
	),
	'item_layout'   => array(
		'label'   => esc_html__( 'Item layout', 'weldo' ),
		'desc'    => esc_html__( 'Choose item layout', 'weldo' ),
		'value'   => 'item-regular',
		'type'    => 'select',
		'choices' => array(
			'item-image'  => esc_html__( 'With Image', 'weldo' ),
			'item-icon'    => esc_html__( 'With Icon', 'weldo' ),
		)
	),
	'icon_color' => array(
		'type'    => 'select',
		'label'   => esc_html__('Icon color', 'weldo'),
		'value' => '',
		'choices' => array(
			''            => esc_html__( 'Default', 'weldo' ),
			'color-main'  => esc_html__( 'Color Main', 'weldo' ),
			'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
			'color-light'  => esc_html__( 'Light Color', 'weldo' ),
			'color-dark'  => esc_html__( 'Dark Color', 'weldo' ),
		),
	),
	'background_color' => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Background color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => weldo_unyson_option_get_backgrounds_array(),
	),
	'text_align' => array(
		'type'    => 'select',
		'label'   => esc_html__('Text alignment', 'weldo'),
		'value'   => 'text-left',
		'choices' => array(
			'text-left' => esc_html__('Left', 'weldo'),
			'text-center' => esc_html__('Center', 'weldo'),
			'text-right' => esc_html__('Right', 'weldo'),
		),
	),
	'cat' => array(
		'type'  => 'multi-select',
		'label' => esc_html__('Select categories', 'weldo'),
		'desc'  => esc_html__('You can select one or more categories', 'weldo'),
		'population' => 'taxonomy',
		'source' => 'product_cat',
		'prepopulate' => 10,
		'limit' => 100,
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
			'40' => esc_html__( '40px', 'weldo' ),
			'50' => esc_html__( '50px', 'weldo' ),
			'60' => esc_html__( '60px', 'weldo' ),
		)
	),
	'responsive_lg' => array(
		'label'   => esc_html__( 'Columns on large screens', 'weldo' ),
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
	'class' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Additional CSS class', 'weldo' ),
		'desc'  => esc_html__( 'Add your custom CSS class. Useful for Customization', 'weldo' ),
	),
);