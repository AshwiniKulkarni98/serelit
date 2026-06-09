<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$button         = fw_ext( 'shortcodes' ) -> get_shortcode( 'button' );
$button_options = $button -> get_options();


$options = array(
	
	'items'         => array(
		'type'            => 'addable-popup',
		'value'           => '',
		'label'           => esc_html__( 'Carousel items', 'weldo' ),
		'popup-options'   => array(
			'image'            => array(
				'type'        => 'upload',
				'value'       => '',
				'label'       => esc_html__( 'Image', 'weldo' ),
				'images_only' => true,
			),
			'url'              => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Image link', 'weldo' ),
			),
			'image_title'      => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Title Image', 'weldo' ),
				'desc'  => esc_html__( 'Add title below image', 'weldo' ),
			),
			'title_size'       => array(
				'type'    => 'select',
				'value'   => 'fs-30',
				'label'   => esc_html__( 'Title Size', 'weldo' ),
				'desc'    => esc_html__( 'Select a size for title', 'weldo' ),
				'choices' => array(
					''      => esc_html__( 'Inherit', 'weldo' ),
					'fs-16' => esc_html__( '16px', 'weldo' ),
					'fs-20' => esc_html__( '20px', 'weldo' ),
					'fs-30' => esc_html__( '30px', 'weldo' ),
					'fs-40' => esc_html__( '40px', 'weldo' ),
					'fs-50' => esc_html__( '50px', 'weldo' ),
				),
			),
			'image_excerpt'    => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__( 'Text After Title', 'weldo' ),
				'desc'  => esc_html__( 'Add text below title', 'weldo' ),
			),
			'background_color' => array(
				'type'    => 'select',
				'value'   => 'ls box-shadow',
				'label'   => esc_html__( 'Background Color', 'weldo' ),
				'desc'    => esc_html__( 'Select background color', 'weldo' ),
				'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
				'choices' => array(
					'ls'            => esc_html__( 'Light', 'weldo' ),
					'ds'            => esc_html__( 'Dark', 'weldo' ),
					'ds ms'         => esc_html__( 'Dark Grey', 'weldo' ),
					'cs'            => esc_html__( 'Main Color', 'weldo' ),
					'cs cs2'        => esc_html__( 'Second Main Color', 'weldo' ),
					'ls box-shadow' => esc_html__( 'Light With Shadow', 'weldo' ),
				)
			),
			'image_overlay' => array(
				'type'         => 'switch',
				'value'        => true,
				'label'        => esc_html__( 'Show Image Overlay', 'weldo' ),
				'desc'         => esc_html__( 'Show/hide image overlay', 'weldo' ),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__( 'No', 'weldo' ),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__( 'Yes', 'weldo' ),
				),
			),
			'additional_class' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Additional CSS class', 'weldo' ),
				'desc'  => esc_html__( 'Add your custom CSS class. Useful for Customization', 'weldo' ),
			),
		),
		'template'        => '{{=image_title}}',
		'limit'           => 0, // limit the number of popupes that can be added
		'add-button-text' => esc_html__( 'Add', 'weldo' ),
		'sortable'        => true,
	),
	'loop'          => array(
		'type'         => 'switch',
		'value'        => 'false',
		'label'        => esc_html__( 'Loop carousel', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'nav'           => array(
		'type'         => 'switch',
		'value'        => 'false',
		'label'        => esc_html__( 'Show Arrows', 'weldo' ),
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
		'value'        => 'false',
		'label'        => esc_html__( 'Autoplay', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'responsive_lg' => array(
		'type'        => 'select',
		'value'       => '4',
		'label'       => esc_html__( 'Items count on ', 'weldo' ) . '<' . esc_html__( '1200px', 'weldo' ),
		'choices'     => array(
			'4' => '4',
			'3' => '3',
			'2' => '2',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'1' => '1',
		
		),
		'no-validate' => false,
	),
	'responsive_md' => array(
		'type'        => 'select',
		'value'       => '4',
		'label'       => esc_html__( 'Items count on 992px-1200px', 'weldo' ),
		'choices'     => array(
			'3' => '3',
			'4' => '4',
			'2' => '2',
			'5' => '5',
			'6' => '6',
			'1' => '1',
		
		),
		'no-validate' => false,
	),
	'responsive_sm' => array(
		'type'        => 'select',
		'value'       => '3',
		'label'       => esc_html__( 'Items count on 768px-992px', 'weldo' ),
		'choices'     => array(
			'3' => '3',
			'2' => '2',
			'1' => '1',
			'4' => '4',
			'5' => '5',
			'6' => '6',
		
		),
		'no-validate' => false,
	),
	'responsive_xs' => array(
		'type'        => 'select',
		'value'       => '2',
		'label'       => esc_html__( 'Items count on ', 'weldo' ) . '>' . esc_html__( '768px', 'weldo' ),
		'choices'     => array(
			'2' => '2',
			'1' => '1',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
		
		),
		'no-validate' => false,
	),
	'margin'        => array(
		'type'        => 'select',
		'value'       => '30',
		'label'       => esc_html__( 'Margin between items', 'weldo' ),
		'choices'     => array(
			'0'  => '0px',
			'5'  => '5px',
			'10' => '10px',
			'15' => '15px',
			'20' => '20px',
			'30' => '30px',
			'40' => '40px',
			'50' => '50px',
		
		),
		'no-validate' => false,
	),

);