<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$button         = fw_ext( 'shortcodes' )->get_shortcode( 'button' );
$button_options = $button->get_options();
$button_options['button_animation'] = array(
	'type'    => 'select',
	'value'   => 'fadeIn',
	'label'   => esc_html__( 'Animation type', 'weldo' ),
	'desc'    => esc_html__( 'Select one of predefined animations', 'weldo' ),
	'choices' => weldo_unyson_option_animations(),
);

$options = array(
	'slide_background' => array(
		'type'        => 'select',
		'value'       => 'ls',
		'label'       => esc_html__( 'Slide background', 'weldo' ),
		'desc'        => esc_html__( 'Select slide background color', 'weldo' ),
		'choices'     => array(
			'ls'    => esc_html__( 'Light', 'weldo' ),
			'ls ms' => esc_html__( 'Light Muted', 'weldo' ),
			'ds'    => esc_html__( 'Dark', 'weldo' ),
			'ds ms' => esc_html__( 'Dark Muted', 'weldo' ),
			'cs'    => esc_html__( 'Color', 'weldo' ),
		),
		/**
		 * Allow save not existing choices
		 * Useful when you use the select to populate it dynamically from js
		 */
		'no-validate' => false,
	),
	'slide_background_overlay' => array(
		'type'         => 'switch',
		'label'        => esc_html__( 'Show Color overlay', 'weldo' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	),
	'slide_align'      => array(
		'type'        => 'select',
		'value'       => 'text-left',
		'label'       => esc_html__( 'Slide text alignment', 'weldo' ),
		'desc'        => esc_html__( 'Select slide text alignment', 'weldo' ),
		'choices'     => array(
			'text-left'   => esc_html__( 'Left', 'weldo' ),
			'text-center' => esc_html__( 'Center', 'weldo' ),
			'text-right'  => esc_html__( 'Right', 'weldo' ),
		),
		/**
		 * Allow save not existing choices
		 * Useful when you use the select to populate it dynamically from js
		 */
		'no-validate' => false,
	),
	'slide_vertical_align'      => array(
		'type'        => 'select',
		'value'       => '',
		'label'       => esc_html__( 'Slide vertical alignment', 'weldo' ),
		'desc'        => esc_html__( 'Select vertcial alignment for slider layers', 'weldo' ),
		'choices'     => array(
			''   => esc_html__( 'Middle (default)', 'weldo' ),
			'intro_text_top' => esc_html__( 'Top', 'weldo' ),
			'intro_text_bottom'  => esc_html__( 'Bottom', 'weldo' ),
		),
		/**
		 * Allow save not existing choices
		 * Useful when you use the select to populate it dynamically from js
		 */
		'no-validate' => false,
	),
	'shadow_heading_text'           => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Shadow Heading Text', 'weldo' ),
		'desc'  => esc_html__( 'Heading to appear in slide layer behind the text', 'weldo' ),
	),
	'slide_layers'     => array(
		'type'        => 'addable-box',
		'value'       => '',
		'label'       => esc_html__( 'Slide Layers', 'weldo' ),
		'desc'        => esc_html__( 'Choose a tag and text inside it', 'weldo' ),

		'box-options' => array_merge( array(
			'layer_tag'            => array(
				'type'    => 'select',
				'value'   => 'h3',
				'label'   => esc_html__( 'Layer tag', 'weldo' ),
				'desc'    => esc_html__( 'Select a tag for your ', 'weldo' ),
				'choices' => array(
					'h2' => esc_html__( 'H2 tag', 'weldo' ),
					'h3' => esc_html__( 'H3 tag', 'weldo' ),
					'h4' => esc_html__( 'H4 tag', 'weldo' ),
					'h5' => esc_html__( 'H5 tag', 'weldo' ),
					'h6' => esc_html__( 'H6 tag', 'weldo' ),
					'p'  => esc_html__( 'P tag', 'weldo' ),

				),
			),
			'layer_animation'      => array(
				'type'    => 'select',
				'value'   => 'fadeIn',
				'label'   => esc_html__( 'Animation type', 'weldo' ),
				'desc'    => esc_html__( 'Select one of predefined animations', 'weldo' ),
				'choices' => weldo_unyson_option_animations(),
			),
			'layer_text'           => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Layer text', 'weldo' ),
				'desc'  => esc_html__( 'Text to appear in slide layer', 'weldo' ),
			),
			'layer_text_color'     => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Layer text color', 'weldo' ),
				'desc'    => esc_html__( 'Select a color for your text in layer', 'weldo' ),
				'choices' => array(
					''           => esc_html__( 'Inherited', 'weldo' ),
					'color-main'  => esc_html__( 'First theme main color', 'weldo' ),
					'color-main2' => esc_html__( 'Second theme main color', 'weldo' ),
					'color-darkgrey'       => esc_html__( 'Dark grey theme color', 'weldo' ),
					'color-dark'      => esc_html__( 'Dark theme color', 'weldo' ),

				),
			),
			'layer_text_weight'    => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Layer text weight', 'weldo' ),
				'desc'    => esc_html__( 'Select a weight for your text in layer', 'weldo' ),
				'choices' => array(
					''     => esc_html__( 'Normal', 'weldo' ),
					'bold' => esc_html__( 'Bold', 'weldo' ),
					'thin' => esc_html__( 'Thin', 'weldo' ),

				),
			),
			'layer_text_transform' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Layer text transform', 'weldo' ),
				'desc'    => esc_html__( 'Select a text transformation for your layer', 'weldo' ),
				'choices' => array(
					''                => esc_html__( 'None', 'weldo' ),
					'text-lowercase'  => esc_html__( 'Lowercase', 'weldo' ),
					'text-uppercase'  => esc_html__( 'Uppercase', 'weldo' ),
					'text-capitalize' => esc_html__( 'Capitalize', 'weldo' ),

				),
			),
			'class' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Additional Layer CSS class', 'weldo' ),
			),  )
		),
		'template'    => esc_html__( 'Slider Layer', 'weldo' ),
		'limit'           => 5, // limit the number of boxes that can be added
		'add-button-text' => esc_html__( 'Add', 'weldo' ),
	),
	'class'           => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Additional Slide CSS class', 'weldo' ),
	),
	'arrow' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'value'   => false,
		'picker'  => array(
			'show_arrow' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Show Arrow', 'weldo' ),
				'left-choice'  => array(
					'value' => '',
					'label' => esc_html__( 'No', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'arrow',
					'label' => esc_html__( 'Yes', 'weldo' ),
				),
			),
		),
		'choices' => array(
			''       => array(),
			'arrow'  => array(
				'link'        => array(
					'label' => esc_html__( 'Scroll To:', 'weldo' ),
					'desc'  => esc_html__( 'Where should your arrow scroll to', 'weldo' ),
					'type'  => 'text',
				),
				'arrow_color'       => array(
					'label'   => esc_html__( 'Arrow Color', 'weldo' ),
					'value'   => 'btn btn-maincolor',
					'type'    => 'select',
					'choices' => array(
						'light-color'    => esc_html__( 'Color Light', 'weldo' ),
						'dark-color'     => esc_html__( 'Color Dark', 'weldo' ),
						'color-main'     => esc_html__( 'Color Main', 'weldo' ),
						'color-main2'    => esc_html__( 'Color Main 2', 'weldo' ),
					)
				),
				'arrow_custom_class' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Arrow custom class', 'weldo' ),
					'desc'  => esc_html__( 'Add button custom css class', 'weldo' ),
				),
			),
		),
	),
	'button' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'value'   => false,
		'picker'  => array(
			'show_button' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Show button', 'weldo' ),
				'left-choice'  => array(
					'value' => '',
					'label' => esc_html__( 'No', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'button',
					'label' => esc_html__( 'Yes', 'weldo' ),
				),
			),
		),
		'choices' => array(
			''       => array(),
			'button' => $button_options,
		),
	),
);