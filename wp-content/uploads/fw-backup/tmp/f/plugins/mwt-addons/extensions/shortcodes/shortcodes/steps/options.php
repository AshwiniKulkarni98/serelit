<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'step_layout'           => array(
		'type'    => 'select',
		'value'   => '1',
		'label'   => esc_html__( 'Step Layout', 'weldo' ),
		'choices' => array(
			'1' => esc_html__( 'Layout 1', 'weldo' ),
			'2' => esc_html__( 'Layout 2', 'weldo' ),
		),
	),
	'arrow_style'           => array(
		'type'    => 'select',
		'value'   => 'arrow-dashed',
		'label'   => esc_html__( 'Arrow Style', 'weldo' ),
		'desc'    => esc_html__( 'Only for 1 step layout', 'weldo' ),
		'choices' => array(
			'arrow-dashed' => esc_html__( 'Dashed Arrow', 'weldo' ),
			'arrow-solid'  => esc_html__( 'Solid Arrow', 'weldo' ),
		),
	),
	'steps'                 => array(
		'type'            => 'addable-popup',
		'value'           => '',
		'label'           => esc_html__( 'Steps', 'weldo' ),
		'popup-options'   => array(
			'step_title'       => array(
				'type'  => 'text',
				'label' => esc_html__( 'Step Title', 'weldo' ),
			),
			'title_color' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Title Text Color', 'weldo' ),
				'choices' => array(
					''            => esc_html__( 'Default', 'weldo' ),
					'color-main'  => esc_html__( 'Color Main', 'weldo' ),
					'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
					'color-light' => esc_html__( 'Light Color', 'weldo' ),
					'color-dark'  => esc_html__( 'Dark Color', 'weldo' ),
				),
			),
			'step_text'        => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__( 'Step Text', 'weldo' ),
			),
			
			'step_image'        => array(
				'type'  => 'upload',
				'label' => esc_html__( 'Choose Image', 'weldo' ),
				'desc'  => esc_html__( 'Either upload a new, or choose an existing image from your media library', 'weldo' )
			),
			'step_custom_class' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Custom class', 'weldo' ),
				'desc'  => esc_html__( 'Add step custom css class', 'weldo' ),
			),
		),
		'template'        => '{{- step_title }}',
		'limit'           => 3, // limit the number of boxes that can be added
		'add-button-text' => esc_html__( 'Add', 'weldo' ),
	),
	'show_step_count'       => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show Step Count', 'weldo' ),
		'desc'         => esc_html__( 'Show or hide number of step', 'weldo' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'item-steps',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'step_background_color' => array(
		'type'    => 'select',
		'value'   => 'ls',
		'label'   => esc_html__( 'Background color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => array(
			''             => esc_html__( 'None', 'weldo' ),
			'ls'             => esc_html__( 'Light', 'weldo' ),
			'ls ms step-bg'  => esc_html__( 'Light Grey', 'weldo' ),
			'ds step-bg'     => esc_html__( 'Dark Grey', 'weldo' ),
			'ds ms step-bg'  => esc_html__( 'Dark Muted', 'weldo' ),
			'ds bs step-bg'  => esc_html__( 'Dark Blue', 'weldo' ),
			'cs step-bg'     => esc_html__( 'Main color', 'weldo' ),
			'cs cs2 step-bg' => esc_html__( 'Second Main color', 'weldo' ),
		),
	),
	'show_pattern'          => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show Pattern', 'weldo' ),
		'desc'         => esc_html__( 'Show step background image', 'weldo' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'step-pattern',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
);

