<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'box_id' => array(
		'type'    => 'box',
		'title'   => esc_html__( 'Options for child categories', 'weldo' ),
		'options' => array(
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
					'item-regular'  => esc_html__( 'Regular (just image)', 'weldo' ),
					'item-title'    => esc_html__( 'Image with title', 'weldo' ),
					'item-extended' => esc_html__( 'Image with title and excerpt', 'weldo' ),
				)
			),
			'full_width'    => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__( 'Full width gallery', 'weldo' ),
				'desc'         => esc_html__( 'Enable full width container for gallery', 'weldo' ),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__( 'No', 'weldo' ),
				),
				'right-choice' => array(
					'value' => true,
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
			'show_filters'  => array(
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
			'items_per_page' => array(
				'type'  => 'select',
				'value' => '12',
				'label' => esc_html__( 'Items Per Page', 'weldo' ),
				'choices' => array(
					'2' =>  esc_html__('2 Items', 'weldo'),
					'3' =>  esc_html__('3 Items', 'weldo'),
					'4' =>  esc_html__('4 Items', 'weldo'),
					'6' =>  esc_html__('6 Items', 'weldo'),
					'8' =>  esc_html__('8 Items', 'weldo'),
					'9' =>  esc_html__('9 Items', 'weldo'),
					'12' =>  esc_html__('12 Items', 'weldo'),
					'16' =>  esc_html__('16 Items', 'weldo'),
					'24' =>  esc_html__('24 Items', 'weldo'),
					'30' =>  esc_html__('30 Items', 'weldo'),
					'40' =>  esc_html__('40 Items', 'weldo'),
					'50' =>  esc_html__('50 Items', 'weldo'),
				),
			)

		)
	)
);