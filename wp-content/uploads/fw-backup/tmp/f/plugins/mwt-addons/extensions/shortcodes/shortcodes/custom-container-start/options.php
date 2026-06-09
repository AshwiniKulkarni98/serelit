<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'custom_class' => array(
		'type'         => 'multi-picker',
		'label'        => false,
		'desc'         => false,
		'picker'       => array(
			'add_custom_class' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Custom class', 'weldo'),
				'desc'  => esc_html__('Add custom class to container', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('No', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'custom',
					'label' => esc_html__('Yes', 'weldo'),
				),
			),

		),
		'choices'      => array(
			''         => array(),
			'custom'   => array(
				'class' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__('Enter your custom classes', 'weldo'),
				),
			)
		),
	),
);