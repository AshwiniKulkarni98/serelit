<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title'               => array(
		'label' => esc_html__( 'Title', 'weldo' ),
		'desc'  => esc_html__( 'Optional Testimonials Title', 'weldo' ),
		'type'  => 'text',
	),
	'layout' => array(
		'label'   => esc_html__('Testimonials Layout', 'weldo'),
		'type'    => 'select',
		'value'   => '1',
		'choices' => array(
			'1'  => esc_html__('Default', 'weldo'),
			'2' => esc_html__('Second', 'weldo'),
		),
	),
	'testimonials'        => array(
		'label'         => esc_html__( 'Testimonials', 'weldo' ),
		'popup-title'   => esc_html__( 'Add/Edit Testimonial', 'weldo' ),
		'desc'          => esc_html__( 'Here you can add, remove and edit your Testimonials.', 'weldo' ),
		'type'          => 'addable-popup',
		'template'      => '{{=author_name}}',
		'popup-options' => array(
			'content'       => array(
				'label' => esc_html__( 'Quote', 'weldo' ),
				'desc'  => esc_html__( 'Enter the testimonial here', 'weldo' ),
				'type'  => 'textarea',
			),
			'author_avatar' => array(
				'label' => esc_html__( 'Image', 'weldo' ),
				'desc'  => esc_html__( 'Either upload a new, or choose an existing image from your media library', 'weldo' ),
				'type'  => 'upload',
			),
			'author_name'   => array(
				'label' => esc_html__( 'Name', 'weldo' ),
				'desc'  => esc_html__( 'Enter the Name of the Person to quote', 'weldo' ),
				'type'  => 'text'
			),
			'author_job'    => array(
				'label' => esc_html__( 'Position', 'weldo' ),
				'desc'  => esc_html__( 'Can be used for a job description', 'weldo' ),
				'type'  => 'text'
			),
			'site_name'     => array(
				'label' => esc_html__( 'Website Name', 'weldo' ),
				'desc'  => esc_html__( 'Linktext for the above Link', 'weldo' ),
				'type'  => 'text'
			),
			'site_url'      => array(
				'label' => esc_html__( 'Website Link', 'weldo' ),
				'desc'  => esc_html__( 'Link to the Persons website', 'weldo' ),
				'type'  => 'text'
			)
		)
	),
	'quote_mark_style' => array(
		'type'    => 'select',
		'value'   => 'fill-mark',
		'label'   => esc_html__( 'Quote Mark Style', 'weldo' ),
		'choices' => array(
			'fill-mark'     => esc_html__( 'Fill', 'weldo' ),
			'bordered-mark' => esc_html__( 'Bordered', 'weldo' ),
		),
	),
	'additional_class' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Additional CSS class', 'weldo' ),
		'desc'  => esc_html__( 'Add your custom CSS class. Useful for Customization', 'weldo' ),
	),
);