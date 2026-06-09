<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'items'         => array(
		'type'            => 'addable-popup',
		'value'           => '',
		'label'           => esc_html__( 'Carousel items', 'weldo' ),
		'popup-options'     => array(
			'image' => array(
				'type'        => 'upload',
				'value'       => '',
				'label'       => esc_html__( 'Image', 'weldo' ),
				'images_only' => true,
			),
			'url'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Image link', 'weldo' ),
			),
			'lightbox' => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__( 'Open link in lightbox', 'weldo' ),
				'desc'         => esc_html__( 'If your link is a video link you can open it in lightbox', 'weldo' ),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__( 'Yes', 'weldo' )
				),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__( 'No', 'weldo' )
				),
			),
			'title' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Title and Alt text', 'weldo' ),
			),
		),
		'template'        => '{{=image.url}}',
		'limit'           => 0, // limit the number of boxes that can be added
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
	'dots'          => array(
		'type'         => 'switch',
		'value'        => 'false',
		'label'        => esc_html__( 'Show Nav', 'weldo' ),
		'left-choice'  => array(
			'value' => 'false',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'center'        => array(
		'type'         => 'switch',
		'value'        => 'false',
		'label'        => esc_html__( 'Center carousel', 'weldo' ),
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
			'30' => '30px',
			'0'  => '0px',
			'5'  => '5px',
			'10' => '10px',
			'15' => '15px',
			'20' => '20px',

		),
		'no-validate' => false,
	),
	'class'   => array(
		'type'  => 'text',
		'label' => esc_html__( 'Optional additional CSS class', 'weldo' ),
	),
);