<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'image' => array(
		'type'        => 'upload',
		'value'       => '',
		'label'       => esc_html__( 'Image', 'weldo' ),
		'image'       => esc_html__( 'Signature Image', 'weldo' ),
		'images_only' => true,
	),
	'show_line'   => array(
		'type'  => 'switch',
		'value' => false,
		'label' => esc_html__('Show Line', 'weldo'),
		'desc'  => esc_html__('Hide or show line on signature', 'weldo'),
		'left-choice' => array(
			'value' => false,
			'label' => esc_html__('No', 'weldo'),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__('Yes', 'weldo'),
		)
	)
);