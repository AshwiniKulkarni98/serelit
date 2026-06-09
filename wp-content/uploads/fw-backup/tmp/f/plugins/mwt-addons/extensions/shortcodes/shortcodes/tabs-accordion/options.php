<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

//get accordion to add in tab:
$accordion_shortcode = fw_ext( 'shortcodes' )->get_shortcode( 'accordion' );

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
			$accordion_shortcode->get_options(),
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