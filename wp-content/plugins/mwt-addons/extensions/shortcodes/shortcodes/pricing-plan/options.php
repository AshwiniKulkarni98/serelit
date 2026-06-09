<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$button         = fw_ext( 'shortcodes' )->get_shortcode( 'button' );
$button_options = $button->get_options();

$options = array(
	'tab_main' => array(
		'type' => 'tab',
		'title' => esc_html__('Info', 'weldo'),
		'options' => array(
			'title'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Pricing plan title', 'weldo' ),
			),
			'description'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Plan description', 'weldo' ),
			),
			'currency'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Currency Sign', 'weldo' ),
			),
			'price'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Whole price', 'weldo' ),
				'desc' => esc_html__( 'Price before decimal divider', 'weldo' ),
			),
			'price_after'   => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Text after price', 'weldo' ),
				'desc' => esc_html__( 'Price after decimal divider, including divider (dot, coma etc.), for example ".99", or text "per month"', 'weldo' ),
			),
			'features'         => array(
				'type'            => 'addable-box',
				'value'           => '',
				'label'           => esc_html__( 'Pricing plan features', 'weldo' ),
				'box-options'     => array(
					'feature_name'   => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Feature name', 'weldo' ),
					),
					'feature_checked' => array(
						'type'        => 'select',
						'value'       => '',
						'label'       => esc_html__( 'Default, checked or unchecked', 'weldo' ),
						'choices'     => array(
							'default' => esc_html__( 'Default', 'weldo' ),
							'enabled' => esc_html__( 'Enabled', 'weldo' ),
							'disabled' => esc_html__( 'Disabled', 'weldo'),
						),
						'no-validate' => false,
					),
				),
				'template'        => '{{=feature_name}}',
				'limit'           => 0, // limit the number of boxes that can be added
				'add-button-text' => esc_html__( 'Add', 'weldo' ),
				'sortable'        => true,
			),
			'featured' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Default or featured plan', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__(' Default', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'plan-featured',
					'label' => esc_html__(' Featured', 'weldo'),
				),
			),
			'layout' => array(
				'label'   => esc_html__('Choose layout', 'weldo'),
				'type'    => 'select',
				'value'   => '1',
				'choices' => array(
					'1'  => esc_html__('Default', 'weldo'),
					'2' => esc_html__('Second', 'weldo'),
					'3' => esc_html__('Third', 'weldo'),
				),
			)
		),
	),
	'tab_button' => array(
		'type' => 'tab',
		'options' => array(
			'price_buttons'     => array(
				'type'        => 'addable-box',
				'value'       => '',
				'label'       => esc_html__( 'Price Buttons', 'weldo' ),
				'desc'        => esc_html__( 'Add a button, to price table', 'weldo' ),
				'template'    => 'Button',
				'box-options' => array(
					$button_options
				),
				'limit'           => 1, // limit the number of boxes that can be added
				'add-button-text' => esc_html__( 'Add', 'weldo' ),
			),
		),
		'title' => esc_html__('Button', 'weldo'),
	),


);