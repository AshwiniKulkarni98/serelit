<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'tab_main_options' => array(
		'type'    => 'tab',
		'title'   => esc_html__( 'Main Options', 'weldo' ),
		'options' => array(
			'column_align'            => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Text alignment in column', 'weldo' ),
				'desc'    => esc_html__( 'Select text alignment inside your column', 'weldo' ),
				'choices' => array(
					''            => esc_html__( 'Inherit', 'weldo' ),
					'text-left'   => esc_html__( 'Left', 'weldo' ),
					'text-center' => esc_html__( 'Center', 'weldo' ),
					'text-right'  => esc_html__( 'Right', 'weldo' ),
				),
			),
			'column_padding'          => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Column padding', 'weldo' ),
				'desc'    => esc_html__( 'Select optional internal column paddings', 'weldo' ),
				'choices' => array(
					''              => esc_html__( 'No padding', 'weldo' ),
					'p-10'          => esc_html__( '10px', 'weldo' ),
					'p-15'          => esc_html__( '15px', 'weldo' ),
					'p-20'          => esc_html__( '20px', 'weldo' ),
					'p-30'          => esc_html__( '30px', 'weldo' ),
					'p-40'          => esc_html__( '40px', 'weldo' ),
					'p-50'          => esc_html__( '50px', 'weldo' ),
					'p-60'          => esc_html__( '60px', 'weldo' ),
					'p-40 p-lg-85' => esc_html__( '85px', 'weldo' ),
					'px-50'         => esc_html__( 'Left and right 50px', 'weldo' ),
				
				),
			),
			'center_column'           => array(
				'type'         => 'switch',
				'value'        => '',
				'label'        => esc_html__( 'Centered column', 'weldo' ),
				'left-choice'  => array(
					'value' => '',
					'label' => esc_html__( 'No', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'centered-content',
					'label' => esc_html__( 'Yes', 'weldo' ),
				),
			),
			'background_color'        => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Background color', 'weldo' ),
				'desc'    => esc_html__( 'Select background color', 'weldo' ),
				'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
				'choices' => weldo_unyson_option_get_backgrounds_array(),
			),
			'background_image'        => array(
				'type'        => 'upload',
				'value'       => array(),
				'label'       => esc_html__( 'Column Background Image', 'weldo' ),
				'desc'        => esc_html__( 'Choose the background image for column', 'weldo' ),
				'images_only' => true,
			),
			'column_animation'        => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Animation type', 'weldo' ),
				'desc'    => esc_html__( 'Select one of predefined animations', 'weldo' ),
				'choices' => weldo_unyson_option_animations(),
			),
			'column_additional_class' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Additional CSS class', 'weldo' ),
				'desc'  => esc_html__( 'Add your custom CSS class to column. Useful for Customization', 'weldo' ),
			),
		),
	),
	'tab_responsive'   => array(
		'type'    => 'tab',
		'title'   => esc_html__( 'Responsive', 'weldo' ),
		'options' => array(
			'responsive_alignment'  => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Alignment', 'weldo' ),
				'options' => array(
					'text_align_sm' => array(
						'type'    => 'select',
						'value'   => '',
						'label'   => esc_html__( 'Text align above 576px screen', 'weldo' ),
						'choices' => array(
							''               => esc_html__( 'Inherit', 'weldo' ),
							'text-sm-left'   => esc_html__( 'Left', 'weldo' ),
							'text-sm-center' => esc_html__( 'Center', 'weldo' ),
							'text-sm-right'  => esc_html__( 'Right', 'weldo' ),
						),
					),
					'text_align_md' => array(
						'type'    => 'select',
						'value'   => '',
						'label'   => esc_html__( 'Text align above 768px screen', 'weldo' ),
						'choices' => array(
							''               => esc_html__( 'Inherit', 'weldo' ),
							'text-md-left'   => esc_html__( 'Left', 'weldo' ),
							'text-md-center' => esc_html__( 'Center', 'weldo' ),
							'text-md-right'  => esc_html__( 'Right', 'weldo' ),
						),
					),
					'text_align_lg' => array(
						'type'    => 'select',
						'value'   => '',
						'label'   => esc_html__( 'Text align above 992px screen', 'weldo' ),
						'choices' => array(
							''               => esc_html__( 'Inherit', 'weldo' ),
							'text-lg-left'   => esc_html__( 'Left', 'weldo' ),
							'text-lg-center' => esc_html__( 'Center', 'weldo' ),
							'text-lg-right'  => esc_html__( 'Right', 'weldo' ),
						),
					),
					'text_align_xl' => array(
						'type'    => 'select',
						'value'   => '',
						'label'   => esc_html__( 'Text align above 1200px screen', 'weldo' ),
						'choices' => array(
							''               => esc_html__( 'Inherit', 'weldo' ),
							'text-xl-left'   => esc_html__( 'Left', 'weldo' ),
							'text-xl-center' => esc_html__( 'Center', 'weldo' ),
							'text-xl-right'  => esc_html__( 'Right', 'weldo' ),
						),
					),
				),
			),
			'responsive_visibility' => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Visibility', 'weldo' ),
				'options' => weldo_unyson_option_responsive_options_array(),
			),
		),
	),
);
