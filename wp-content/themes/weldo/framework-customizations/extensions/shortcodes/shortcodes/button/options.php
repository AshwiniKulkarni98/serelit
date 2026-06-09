<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'label'        => array(
		'label' => esc_html__( 'Button Label', 'weldo' ),
		'desc'  => esc_html__( 'This is the text that appears on your button', 'weldo' ),
		'type'  => 'text',
		'value' => esc_html__( 'Submit', 'weldo' ),
	),
	'link'         => array(
		'label' => esc_html__( 'Button Link', 'weldo' ),
		'desc'  => esc_html__( 'Where should your button link to', 'weldo' ),
		'type'  => 'text',
		'value' => '#'
	),
	'target'       => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Open Link in New Window', 'weldo' ),
		'desc'         => esc_html__( 'Select here if you want to open the linked page in a new window', 'weldo' ),
		'right-choice' => array(
			'value' => '_blank',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
		'left-choice'  => array(
			'value' => '_self',
			'label' => esc_html__( 'No', 'weldo' ),
		),
	),
	'color'        => array(
		'label'   => esc_html__( 'Button Color', 'weldo' ),
		'desc'    => esc_html__( 'Choose a type for your button', 'weldo' ),
		'value'   => 'btn btn-maincolor',
		'type'    => 'select',
		'choices' => array(
			'btn btn-maincolor'          => esc_html__( 'Color Main', 'weldo' ),
			'btn btn-maincolor2'         => esc_html__( 'Color Main 2', 'weldo' ),
			'btn btn-grey'               => esc_html__( 'Color Grey', 'weldo' ),
			'btn btn-dark'               => esc_html__( 'Color Dark', 'weldo' ),
			'btn btn-outline-maincolor'  => esc_html__( 'Outline Color Main', 'weldo' ),
			'btn btn-outline-maincolor2' => esc_html__( 'Outline Color Main 2', 'weldo' ),
			'btn btn-outline-grey'       => esc_html__( 'Outline Grey', 'weldo' ),
			'btn btn-outline-dark'       => esc_html__( 'Outline Dark', 'weldo' ),
			'btn-link'                   => esc_html__( 'Just Link', 'weldo' ),
			'btn-link2'                  => esc_html__( 'Just Link 2', 'weldo' ),
		
		)
	),
	'size'         => array(
		'label'   => esc_html__( 'Button Size', 'weldo' ),
		'desc'    => esc_html__( 'Choose a size for your button', 'weldo' ),
		'value'   => 'btn-small',
		'type'    => 'select',
		'choices' => array(
			'btn-small'  => esc_html__( 'Small', 'weldo' ),
			'btn-medium' => esc_html__( 'Medium', 'weldo' ),
			'btn-big'    => esc_html__( 'Big', 'weldo' ),
		)
	),
	'wide_button'  => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Wide Button', 'weldo' ),
		'desc'         => esc_html__( 'Switch to create wider button', 'weldo' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'btn-wide',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'custom_class' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Button Custom Class', 'weldo' ),
		'desc'  => esc_html__( 'Add button custom css class', 'weldo' ),
	),
);