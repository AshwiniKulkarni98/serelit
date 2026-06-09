<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
//get teaser to add in teasers row:
$icon = fw_ext( 'shortcodes' )->get_shortcode( 'icon' );

$options = array(
	'background_color' => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Background color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => array(
			''         => esc_html__( 'Transparent (No Background)', 'weldo' ),
			'hero-bg'  => esc_html__( 'Highlight', 'weldo' ),
			'ds'       => esc_html__( 'Dark', 'weldo' ),
			'ds ms'    => esc_html__( 'Dark Grey', 'weldo' ),
			'cs'       => esc_html__( 'Main color', 'weldo' ),
			'bordered' => esc_html__( 'Transparent background with border', 'weldo' ),
			'box-shadow' => esc_html__( 'Transparent background with shadow', 'weldo' ),
			'hero-bg box-shadow' => esc_html__( 'Highlight background with shadow', 'weldo' ),
		),
	),
	'columns_width' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Column width for icon boxes row', 'weldo' ),
				'desc'    => esc_html__( 'Choose icon box width inside icon boxes row', 'weldo' ),
				'value'   => 'col-md-12',
				'choices' => array(
					'col-md-12'                  => esc_html__( '1/1', 'weldo' ),
					'col-12 col-md-6'            => esc_html__( '1/2', 'weldo' ),
				)
			)
		),
		'choices' => array(
			'col-md-12'    => array(
				'heading_text'           => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Heading text', 'weldo' ),
					'desc'  => esc_html__( 'Text to appear in slide layer', 'weldo' ),
				),
				'icons' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Icons in list', 'weldo' ),
					'popup-title'   => esc_html__( 'Add/Edit Icons in list', 'weldo' ),
					'desc'          => esc_html__( 'Add your icons with descriptions', 'weldo' ),
					'template'      => '{{=text}}',
					'popup-options' => $icon->get_options(),
				),

			),
			'col-12 col-md-6' => array(
				'heading_text'           => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Heading text', 'weldo' ),
					'desc'  => esc_html__( 'Text to appear in slide layer', 'weldo' ),
				),
				'icons' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Icons in list', 'weldo' ),
					'popup-title'   => esc_html__( 'Add/Edit Icons in list', 'weldo' ),
					'desc'          => esc_html__( 'Add your icons with descriptions', 'weldo' ),
					'template'      => '{{=text}}',
					'popup-options' => $icon->get_options(),
				),

				'heading_text2'           => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Heading text', 'weldo' ),
					'desc'  => esc_html__( 'Text to appear in slide layer', 'weldo' ),
				),
				'icons2' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Icons in list', 'weldo' ),
					'popup-title'   => esc_html__( 'Add/Edit Icons in list', 'weldo' ),
					'desc'          => esc_html__( 'Add your icons with descriptions', 'weldo' ),
					'template'      => '{{=text}}',
					'popup-options' => $icon->get_options(),
				),
			),
		),
	),
);