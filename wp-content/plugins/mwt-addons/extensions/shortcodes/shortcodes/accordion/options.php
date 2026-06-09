<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'tabs'  => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Panels', 'weldo' ),
		'popup-title'   => esc_html__( 'Add/Edit Accordion Panels', 'weldo' ),
		'desc'          => esc_html__( 'Create your accordion panels', 'weldo' ),
		'template'      => '{{=tab_title}}',
		'popup-options' => array(
			'tab_title'          => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'weldo' )
			),
			'tab_content'        => array(
				'type'  => 'textarea',
				'label' => esc_html__( 'Content', 'weldo' )
			),
			'tab_featured_image' => array(
				'type'        => 'upload',
				'value'       => '',
				'label'       => esc_html__( 'Panel Featured Image', 'weldo' ),
				'image'       => esc_html__( 'Image for your panel.', 'weldo' ),
				'help'        => esc_html__( 'It appears to the left from your content', 'weldo' ),
				'images_only' => true,
			),
			'tab_icon'           => array(
				'type'  => 'icon',
				'label' => esc_html__( 'Icon in panel title', 'weldo' ),
				'set'   => 'theme-fa-icons',
			),
		)
	),
	'id'    => array( 'type' => 'unique' ),
	'class' => array(
		'type'  => 'text',
		'label' => esc_html__( 'Optional additional CSS class', 'weldo' ),
	),
);