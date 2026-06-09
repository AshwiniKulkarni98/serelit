<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'image'            => array(
		'type'  => 'upload',
		'label' => esc_html__( 'Choose Image', 'weldo' ),
		'desc'  => esc_html__( 'Either upload a new, or choose an existing image from your media library', 'weldo' )
	),
    'image2'            => array(
        'type'  => 'upload',
        'label' => esc_html__( 'Choose Image 2', 'weldo' ),
        'desc'  => esc_html__( 'If you choose second image in layout', 'weldo' )
    ),
	'size'             => array(
		'type'    => 'group',
		'options' => array(
			'width'  => array(
				'type'  => 'text',
				'label' => esc_html__( 'Width', 'weldo' ),
				'desc'  => esc_html__( 'Set image width', 'weldo' ),
				'value' => 300
			),
			'height' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Height', 'weldo' ),
				'desc'  => esc_html__( 'Set image height', 'weldo' ),
				'value' => 200
			)
		)
	),
    'image_layout' => array(
        'type'    => 'select',
        'value'   => '',
        'label'   => esc_html__( 'Second image to:', 'weldo' ),
        'choices' => array(
            ''           => esc_html__( 'Default', 'weldo' ),
            'img-right'  => esc_html__( 'Right', 'weldo' ),
            'img-left'   => esc_html__( 'Left', 'weldo' ),
        ),
    ),
	'class'   => array(
		'type'  => 'text',
		'label' => esc_html__( 'Optional additional CSS class', 'weldo' ),
	),
	'image-link-group' => array(
		'type'    => 'group',
		'options' => array(
			'link'   => array(
				'type'  => 'text',
				'label' => esc_html__( 'Image Link', 'weldo' ),
				'desc'  => esc_html__( 'Where should your image link to?', 'weldo' )
			),
			'target' => array(
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
		)
	),

);

