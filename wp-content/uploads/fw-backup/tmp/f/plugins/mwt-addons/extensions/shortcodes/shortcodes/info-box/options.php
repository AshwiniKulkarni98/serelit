<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

//get icon to add in icon row:
$icon = fw_ext( 'shortcodes' )->get_shortcode( 'icon' );

$options = array(
	'background_color' => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Background color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => weldo_unyson_option_get_backgrounds_array(),
	),
	'image' => array(
		'label' => esc_html__( 'Author Image', 'weldo' ),
		'desc'  => esc_html__( 'Either upload a new, or choose an existing image from your media library', 'weldo' ),
		'type'  => 'upload'
	),
	'rounded_image' => array(
		'type'  => 'switch',
		'value' => '',
		'label' => esc_html__('Rounded Image', 'weldo'),
		'desc'  => esc_html__( 'Making image rounded', 'weldo' ),
		'left-choice' => array(
			'value' => '',
			'label' => esc_html__(' No', 'weldo'),
		),
		'right-choice' => array(
			'value' => 'rounded-circle',
			'label' => esc_html__(' Yes', 'weldo'),
		),
	),
	'name'  => array(
		'label' => esc_html__( 'Author Name', 'weldo' ),
		'desc'  => esc_html__( 'Name of the author', 'weldo' ),
		'type'  => 'text',
		'value' => ''
	),
	'position'   => array(
		'label' => esc_html__( 'Author Position', 'weldo' ),
		'desc'  => esc_html__( 'Position of the author', 'weldo' ),
		'type'  => 'text',
		'value' => ''
	),
	'icons' => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Icons in list', 'weldo' ),
		'popup-title'   => esc_html__( 'Add/Edit Icons in list', 'weldo' ),
		'desc'          => esc_html__( 'Add your icons with descriptions', 'weldo' ),
		'template'      => '{{=text}}',
		'popup-options' => $icon->get_options(),
	),
);