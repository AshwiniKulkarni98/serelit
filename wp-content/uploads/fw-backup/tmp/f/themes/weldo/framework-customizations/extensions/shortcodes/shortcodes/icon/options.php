<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$icon = fw_ext( 'shortcodes' )->get_shortcode( 'icon' );

$options = array(
	'icon'       => array(
		'type'  => 'icon',
		'label' => esc_html__( 'Icon', 'weldo' ),
		'set'   => 'theme-fa-icons',
	),
	'icon_style' => array(
		'type'    => 'image-picker',
		'value'   => '',
		'label'   => esc_html__( 'Icon Style', 'weldo' ),
		'desc'    => esc_html__( 'Select one of predefined icon styles.', 'weldo' ),
		'help'    => esc_html__( 'If not set - no icon will appear.', 'weldo' ),
		'choices' => array(
			'' => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon/static/img/icon_teaser_01.png',
			'color-darkgrey' => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon/static/img/icon_teaser_02.png',
			'color-main' => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon/static/img/icon_teaser_03.png',
			'color-main2' => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon/static/img/icon_teaser_04.png',
		),

		'blank' => false, // (optional) if true, images can be deselected
	),
	'title'      => array(
		'type'  => 'text',
		'label' => esc_html__( 'Title', 'weldo' ),
		'desc'  => esc_html__( 'Title near icon', 'weldo' ),
	),
	'text'       => array(
		'type'  => 'text',
		'label' => esc_html__( 'Text', 'weldo' ),
		'desc'  => esc_html__( 'Text near title', 'weldo' ),
	)
);