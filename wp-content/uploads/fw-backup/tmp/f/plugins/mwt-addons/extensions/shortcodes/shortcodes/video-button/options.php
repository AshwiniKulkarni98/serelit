<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'url'       => array(
		'label' => esc_html__( 'Insert Video URL', 'weldo' ),
		'desc'  => esc_html__( 'Insert Video URL to embed this video', 'weldo' ),
		'type'  => 'text',
		'value' => esc_html__('https://www.youtube.com/embed/IUnH83DU11s', 'weldo' ),
	),
	'label'       => array(
		'label' => esc_html__( 'Video Button Label', 'weldo' ),
		'desc'  => esc_html__( 'This is the text that appears near your video button', 'weldo' ),
		'type'  => 'text',
		
	),
	'custom_class' => array(
		'label' => esc_html__('Custom Class', 'weldo'),
		'desc'  => esc_html__('Add custom class', 'weldo'),
		'type'  => 'text',
	)
);