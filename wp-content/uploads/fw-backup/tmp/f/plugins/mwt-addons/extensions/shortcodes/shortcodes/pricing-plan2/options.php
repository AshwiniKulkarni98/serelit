<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$button         = fw_ext( 'shortcodes' ) -> get_shortcode( 'button' );
$button_options = $button -> get_options();

$options = array(
	'title'            => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Pricing plan title', 'weldo' ),
	),
	'title_color'     => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Title text color', 'weldo' ),
		'desc'    => esc_html__( 'Select a color for your title', 'weldo' ),
		'choices' => array(
			''            => esc_html__( 'Inherited', 'weldo' ),
			'color-main'  => esc_html__( 'Color Main', 'weldo' ),
			'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
			'color-dark'  => esc_html__( 'Dark Color', 'weldo' ),
			'color-grey'  => esc_html__( 'Grey Color', 'weldo' ),
			'color-light'  => esc_html__( 'Light Color', 'weldo' ),
		),
	),
	'description'      => array(
		'type'  => 'textarea',
		'value' => '',
		'label' => esc_html__( 'Plan description', 'weldo' ),
	),
	'currency'         => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Currency sign', 'weldo' ),
	),
	'price'            => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Whole price', 'weldo' ),
		'desc'  => esc_html__( 'Price before decimal divider', 'weldo' ),
	),
	'price_after'      => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Text after price', 'weldo' ),
		'desc'  => esc_html__( 'Price after decimal divider, including divider (dot, coma etc.), for example ".99", or text "per month"', 'weldo' ),
	),
	'price_color'     => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Price text color', 'weldo' ),
		'desc'    => esc_html__( 'Select a color for your price', 'weldo' ),
		'choices' => array(
			''            => esc_html__( 'Inherited', 'weldo' ),
			'color-main'  => esc_html__( 'Color Main', 'weldo' ),
			'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
			'color-dark'  => esc_html__( 'Dark Color', 'weldo' ),
			'color-grey'  => esc_html__( 'Grey Color', 'weldo' ),
			'color-light'  => esc_html__( 'Light Color', 'weldo' ),
		),
	),
	'features'         => array(
		'type'            => 'addable-box',
		'value'           => '',
		'label'           => esc_html__( 'Pricing plan features', 'weldo' ),
		'box-options'     => array(
			'feature_name'    => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Feature name', 'weldo' ),
			),
			'feature_checked' => array(
				'type'        => 'select',
				'value'       => '',
				'label'       => esc_html__( 'Default, checked or unchecked', 'weldo' ),
				'choices'     => array(
					'default'  => esc_html__( 'Default', 'weldo' ),
					'enabled'  => esc_html__( 'Enabled', 'weldo' ),
					'disabled' => esc_html__( 'Disabled', 'weldo' ),
				),
				'no-validate' => false,
			),
		),
		'template'        => '{{=feature_name}}',
		'limit'           => 0, // limit the number of boxes that can be added
		'add-button-text' => esc_html__( 'Add', 'weldo' ),
		'sortable'        => true,
	),
	'background_color' => array(
		'type'    => 'select',
		'value'   => 'hero-bg',
		'label'   => esc_html__( 'Price Background Color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => array(
			'hero-bg'  => esc_html__( 'Highlight', 'weldo' ),
			'muted-bg' => esc_html__( 'Muted', 'weldo' ),
			'ds ms'    => esc_html__( 'Dark Grey', 'weldo' ),
			'ds'       => esc_html__( 'Dark', 'weldo' ),
			'cs'       => esc_html__( 'Main color', 'weldo' ),
			'cs cs2'   => esc_html__( 'Second Main color', 'weldo' ),
		),
	),
	'featured'         => array(
		'type'         => 'switch',
		'value'        => '',
		'label'        => esc_html__( 'Default or featured plan', 'weldo' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( ' Default', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'plan-featured',
			'label' => esc_html__( ' Featured', 'weldo' ),
		),
	),
	'button'           => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'value'   => false,
		'picker'  => array(
			'show_button' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Show Button', 'weldo' ),
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
			'button' => $button_options,
		),
	),
	'additional_class' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Additional CSS class', 'weldo' ),
		'desc'  => esc_html__( 'Add your custom CSS class to column. Useful for Customization', 'weldo' ),
	),

);