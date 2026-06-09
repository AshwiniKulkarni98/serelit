<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'social_icons' => array(
		'type'            => 'addable-popup',
		'value'           => '',
		'label'           => esc_html__( 'Social Buttons', 'weldo' ),
		'desc'            => esc_html__( 'Optional social buttons appear in copyright section and header', 'weldo' ),
		'template'        => '{{=icon}}',
		'popup-options'     => array(
			'icon'       => array(
				'type'  => 'icon',
				'label' => esc_html__( 'Social Icon', 'weldo' ),
				'set'   => 'social-icons',
			),
			'icon_class' => array(
				'type'        => 'select',
				'value'       => '',
				'label'       => esc_html__( 'Icon type', 'weldo' ),
				'desc'        => esc_html__( 'Select one of predefined social button types', 'weldo' ),
				'choices'     => array(
					''                                    => esc_html__( 'Default', 'weldo' ),
					'border-icon'                         => esc_html__( 'Simple Bordered Icon', 'weldo' ),
					'border-icon rounded-icon'            => esc_html__( 'Rounded Bordered Icon', 'weldo' ),
					'bg-icon'                             => esc_html__( 'Simple Background Icon', 'weldo' ),
					'bg-icon rounded-icon'                => esc_html__( 'Rounded Background Icon', 'weldo' ),
					'color-icon bg-icon'                  => esc_html__( 'Color Light Background Icon', 'weldo' ),
					'color-icon bg-icon rounded-icon'     => esc_html__( 'Color Light Background Rounded Icon', 'weldo' ),
					'color-icon'                          => esc_html__( 'Color Icon', 'weldo' ),
					'color-icon border-icon'              => esc_html__( 'Color Bordered Icon', 'weldo' ),
					'color-icon border-icon rounded-icon' => esc_html__( 'Rounded Color Bordered Icon', 'weldo' ),
					'color-bg-icon'                       => esc_html__( 'Color Background Icon', 'weldo' ),
					'color-bg-icon rounded-icon'          => esc_html__( 'Rounded Color Background Icon', 'weldo' ),

				),
				/**
				 * Allow save not existing choices
				 * Useful when you use the select to populate it dynamically from js
				 */
				'no-validate' => false,
			),
			'icon_url'   => array(
				'type'  => 'text',
				'value' => '#',
				'label' => esc_html__( 'Icon Link', 'weldo' ),
				'desc'  => esc_html__( 'Provide a URL to your icon', 'weldo' ),
			)
		),
		'limit'           => 0, // limit the number of boxes that can be added
		'add-button-text' => esc_html__( 'Add', 'weldo' ),
		'sortable'        => true,
	)
);