<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext_services_settings = fw()->extensions->get( 'portfolio' )->get_settings();
$post_type = $ext_services_settings['post_type'];

$options = array(
	'portfolio' => array(
		'type'  => 'multi-select',
		'value' => array(),
		'label' => esc_html__('Project', 'weldo'),
		'desc'  => esc_html__('Select project to display', 'weldo'),
		'population' => 'posts',
		'source' => $post_type,
		'limit' => 1,
	),
	'background_color' => array(
		'type'    => 'select',
		'value'   => 'ls',
		'label'   => esc_html__( 'Background color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => array(
			'ls'     => esc_html__( 'Light', 'weldo' ),
			'ls ms'  => esc_html__( 'Light Grey', 'weldo' ),
			'ds'     => esc_html__( 'Dark Grey', 'weldo' ),
			'ds ms'  => esc_html__( 'Dark Muted', 'weldo' ),
			'cs'     => esc_html__( 'Main color', 'weldo' ),
			'cs cs2' => esc_html__( 'Second Main color', 'weldo' ),
		),
	),
	'image_first' => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show Image First', 'weldo' ),
		'desc'        => esc_html__( 'Show image first then text', 'weldo' ),
		'left-choice'  => array(
			'value' => 'triangle-right',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'row-reverse triangle-left',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'show_video' => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show as Video', 'weldo' ),
		'desc'        => esc_html__( 'Show portfolio item as video', 'weldo' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'button' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'value'   => false,
		'picker'  => array(
			'show_button' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Show button', 'weldo' ),
				'left-choice'  => array(
					'value' => '',
					'label' => esc_html__( 'No', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'button',
					'label' => esc_html__( 'Yes', 'weldo' ),
				),
			),
		),
		'choices' => array(
			''       => array(),
			'button' => array(
				'label'       => array(
					'label' => esc_html__( 'Button Label', 'weldo' ),
					'desc'  => esc_html__( 'This is the text that appears on your button', 'weldo' ),
					'type'  => 'text',
					'value' => esc_html__('Submit', 'weldo' ),
				),
				'color'       => array(
					'label'   => esc_html__( 'Button Color', 'weldo' ),
					'desc'    => esc_html__( 'Choose a type for your button', 'weldo' ),
					'value'   => 'btn btn-maincolor',
					'type'    => 'select',
					'choices' => array(
						'btn btn-maincolor'   => esc_html__( 'Color Main', 'weldo' ),
						'btn btn-maincolor2'   => esc_html__( 'Color Main 2', 'weldo' ),
						'btn btn-grey'        => esc_html__( 'Color Grey', 'weldo' ),
						'btn btn-dark'        => esc_html__( 'Color Dark', 'weldo' ),
						'btn btn-outline-maincolor'   => esc_html__( 'Outline Color Main', 'weldo' ),
						'btn btn-outline-maincolor2'   => esc_html__( 'Outline Color Main 2', 'weldo' ),
						'btn btn-outline-grey' => esc_html__( 'Outline Grey', 'weldo' ),
						'btn btn-outline-dark' => esc_html__( 'Outline Dark', 'weldo' ),
						'btn-link'             => esc_html__( 'Just link', 'weldo' ),

					)
				),
			),
		),
	),
	'custom_class' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Custom Class', 'weldo' ),
		'desc'  => esc_html__( 'Add custom css class', 'weldo' ),
	),
);