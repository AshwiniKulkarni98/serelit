<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'unique_id' => array(
		'type' => 'unique',
		'length' => 7
	),
	'style' => array(
		'type'     => 'multi-picker',
		'label'    => false,
		'desc'     => false,
		'picker' => array(
			'ruler_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Divider Type', 'weldo' ),
				'desc'    => esc_html__( 'Here you can set the styling and size of the Divider element', 'weldo' ),
				'choices' => array(
					'line'  => esc_html__( 'Line', 'weldo' ),
					'space' => esc_html__( 'Whitespace', 'weldo' ),
				)
			)
		),
		'choices'     => array(
			'space' => array(
				'height' => array(
					'label' => esc_html__( 'Height', 'weldo' ),
					'desc'  => esc_html__( 'How much whitespace do you need? Enter a pixel value. Positive value will increase the whitespace, negative value will reduce it. eg: \'50\', \'-25\', \'200\'', 'weldo' ),
					'type'  => 'text',
					'value' => '50'
				)
			)
		)
	),
	'responsive' => array(
		'type' => 'box',
		'options' => weldo_unyson_option_responsive_options_array(),
	)
);
