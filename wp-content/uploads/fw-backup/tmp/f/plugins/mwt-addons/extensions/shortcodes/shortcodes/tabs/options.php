<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'tabs'       => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Tabs', 'weldo' ),
		'popup-title'   => esc_html__( 'Add/Edit Tabs', 'weldo' ),
		'desc'          => esc_html__( 'Create your tabs', 'weldo' ),
		'template'      => '{{=tab_title}}',
		'popup-options' => array(
			'tab_title'          => array(
				'type'  => 'text',
				'label' => esc_html__( 'Tab Title', 'weldo' )
			),
			'tab_content'        => array(
				'type'  => 'wp-editor',
				'label' => esc_html__( 'Tab Content', 'weldo' ),
			),
			'tab_featured_image' => array(
				'type'        => 'upload',
				'value'       => '',
				'label'       => esc_html__( 'Tab Featured Image', 'weldo' ),
				'image'       => esc_html__( 'Featured image for your tab', 'weldo' ),
				'help'        => esc_html__( 'Image for your tab. It appears on the top of your tab content', 'weldo' ),
				'images_only' => true,
			),
			'tab_icon'           => array(
				'type'  => 'icon',
				'label' => esc_html__( 'Icon in tab title', 'weldo' ),
				'set'   => 'theme-fa-icons',
			),
		),
	),
	'small_tabs' => array(
		'type'         => 'switch',
		'value'        => '',
		'label'        => esc_html__( 'Small Tabs', 'weldo' ),
		'desc'         => esc_html__( 'Decrease tabs size', 'weldo' ),
		'left-choice'  => array(
			'value' => '',
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => 'small-tabs',
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'id'         => array( 'type' => 'unique' ),
);