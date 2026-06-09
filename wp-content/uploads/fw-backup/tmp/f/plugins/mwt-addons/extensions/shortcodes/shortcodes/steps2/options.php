<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'steps'      => array(
		'type'            => 'addable-popup',
		'value'           => '',
		'label'           => esc_html__( 'Steps', 'weldo' ),
		'popup-options'   => array(
			'step_background_color' => array(
				'type'    => 'select',
				'value'   => 'ls',
				'label'   => esc_html__( 'Background color', 'weldo' ),
				'desc'    => esc_html__( 'Select background color', 'weldo' ),
				'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
				'choices' => array(
					''       => esc_html__( 'None', 'weldo' ),
					'ls'     => esc_html__( 'Light', 'weldo' ),
					'ls ms'  => esc_html__( 'Light Grey', 'weldo' ),
					'ds'     => esc_html__( 'Dark Grey', 'weldo' ),
					'ds ms'  => esc_html__( 'Dark Muted', 'weldo' ),
					'cs'     => esc_html__( 'Main Color', 'weldo' ),
					'cs cs2' => esc_html__( 'Second Main Color', 'weldo' ),
				),
			),
			'step_title'            => array(
				'type'  => 'text',
				'label' => esc_html__( 'Step Title', 'weldo' ),
			),
			'title_line'            => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__( 'Show Title Line', 'weldo' ),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__( 'Hide', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'with-line',
					'label' => esc_html__( 'Show', 'weldo' ),
				),
			),
			'title_text_transform'  => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Title text transform', 'weldo' ),
				'desc'    => esc_html__( 'Select a weight for your title', 'weldo' ),
				'choices' => array(
					''                => esc_html__( 'None', 'weldo' ),
					'text-lowercase'  => esc_html__( 'Lowercase', 'weldo' ),
					'text-uppercase'  => esc_html__( 'Uppercase', 'weldo' ),
					'text-capitalize' => esc_html__( 'Capitalize', 'weldo' ),
				),
			),
			'title_letter_spacing'  => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Title letter spacing', 'weldo' ),
				'desc'    => esc_html__( 'Select a letter spacing for your title', 'weldo' ),
				'choices' => array(
					''                     => esc_html__( 'None', 'weldo' ),
					'big-letter-spacing'   => esc_html__( 'Big', 'weldo' ),
					'small-letter-spacing' => esc_html__( 'Small', 'weldo' ),
				),
			),
			'step_text'             => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__( 'Step Text', 'weldo' ),
			),
			'text_color'           => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Text Color', 'weldo' ),
				'choices' => array(
					''            => esc_html__( 'Default', 'weldo' ),
					'color-main'  => esc_html__( 'Color Main', 'weldo' ),
					'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
					'color-light' => esc_html__( 'Light Color', 'weldo' ),
					'color-dark'  => esc_html__( 'Dark Color', 'weldo' ),
				),
			),
			'step_custom_class'     => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Custom class', 'weldo' ),
				'desc'  => esc_html__( 'Add step custom css class', 'weldo' ),
			),
		),
		'template'        => '{{- step_title }}',
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
);

