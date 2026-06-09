<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$button         = fw_ext( 'shortcodes' ) -> get_shortcode( 'button' );
$button_options = $button -> get_options();

$options = array(
	'slide_image'              => array(
		'type'  => 'upload',
		'label' => esc_html__( 'Choose Slide Image', 'weldo' ),
		'desc'  => esc_html__( 'Appears to the left of the slider', 'weldo' )
	),
	'slide_background'         => array(
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
	'slide_align'              => array(
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
	'slide_vertical_align'     => array(
		'type'        => 'select',
		'value'       => '',
		'label'       => esc_html__( 'Slide vertical alignment', 'weldo' ),
		'desc'        => esc_html__( 'Select vertcial alignment for slider layers', 'weldo' ),
		'choices'     => array(
			''                  => esc_html__( 'Middle (default)', 'weldo' ),
			'intro_text_top'    => esc_html__( 'Top', 'weldo' ),
			'intro_text_bottom' => esc_html__( 'Bottom', 'weldo' ),
		),
		/**
		 * Allow save not existing choices
		 * Useful when you use the select to populate it dynamically from js
		 */
		'no-validate' => false,
	),
	'slide_layers'             => array(
		'type'            => 'addable-box',
		'value'           => '',
		'label'           => esc_html__( 'Slide Layers', 'weldo' ),
		'desc'            => esc_html__( 'Choose a tag and text inside it', 'weldo' ),
		'box-options'     => array_merge(
			array(
				'layer_tag'            => array(
					'type'    => 'select',
					'value'   => 'h3',
					'label'   => esc_html__( 'Layer tag', 'weldo' ),
					'desc'    => esc_html__( 'Select a tag for your ', 'weldo' ),
					'choices' => array(
						'h3' => esc_html__( 'H tag(heading)', 'weldo' ),
						'p'  => esc_html__( 'P tag(paragraph)', 'weldo' ),
					),
				),
				'layer_text'           => array(
					'type'  => 'textarea',
					'value' => '',
					'label' => esc_html__( 'Layer text', 'weldo' ),
					'desc'  => esc_html__( 'Text to appear in slide layer', 'weldo' ),
				),
				'layer_font_size'      => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Layer font size below 767px', 'weldo' ),
					'value'   => 'fs-16',
					'choices' => array(
						''       => esc_html__( 'Inherit', 'weldo' ),
						'fs-14'  => esc_html__( '14px', 'weldo' ),
						'fs-16'  => esc_html__( '16px', 'weldo' ),
						'fs-20'  => esc_html__( '20px', 'weldo' ),
						'fs-30'  => esc_html__( '30px', 'weldo' ),
						'fs-40'  => esc_html__( '40px', 'weldo' ),
						'fs-50'  => esc_html__( '50px', 'weldo' ),
						'fs-60'  => esc_html__( '60px', 'weldo' ),
						'fs-80'  => esc_html__( '80px', 'weldo' ),
						'fs-100' => esc_html__( '100px', 'weldo' ),
						'fs-160' => esc_html__( '160px', 'weldo' ),
					),
				),
				'layer_font_size_md'   => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Layer font size above 768px', 'weldo' ),
					'value'   => 'fs-md-40',
					'choices' => array(
						''          => esc_html__( 'Inherit', 'weldo' ),
						'fs-md-14'  => esc_html__( '14px', 'weldo' ),
						'fs-md-16'  => esc_html__( '16px', 'weldo' ),
						'fs-md-20'  => esc_html__( '20px', 'weldo' ),
						'fs-md-30'  => esc_html__( '30px', 'weldo' ),
						'fs-md-40'  => esc_html__( '40px', 'weldo' ),
						'fs-md-50'  => esc_html__( '50px', 'weldo' ),
						'fs-md-60'  => esc_html__( '60px', 'weldo' ),
						'fs-md-80'  => esc_html__( '80px', 'weldo' ),
						'fs-md-100' => esc_html__( '100px', 'weldo' ),
						'fs-md-160' => esc_html__( '160px', 'weldo' ),
					),
				),
				'layer_font_size_xl'   => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Layer font size above 1200px', 'weldo' ),
					'value'   => 'fs-xl-60',
					'choices' => array(
						''          => esc_html__( 'Inherit', 'weldo' ),
						'fs-xl-14'  => esc_html__( '14px', 'weldo' ),
						'fs-xl-16'  => esc_html__( '16px', 'weldo' ),
						'fs-xl-20'  => esc_html__( '20px', 'weldo' ),
						'fs-xl-30'  => esc_html__( '30px', 'weldo' ),
						'fs-xl-40'  => esc_html__( '40px', 'weldo' ),
						'fs-xl-50'  => esc_html__( '50px', 'weldo' ),
						'fs-xl-60'  => esc_html__( '60px', 'weldo' ),
						'fs-xl-80'  => esc_html__( '80px', 'weldo' ),
						'fs-xl-100' => esc_html__( '100px', 'weldo' ),
						'fs-xl-160' => esc_html__( '160px', 'weldo' ),
					),
				),
				'layer_text_color'     => array(
					'type'    => 'select',
					'value'   => '',
					'label'   => esc_html__( 'Layer text color', 'weldo' ),
					'desc'    => esc_html__( 'Select a color for your text in layer', 'weldo' ),
					'choices' => array(
						''               => esc_html__( 'Inherited', 'weldo' ),
						'color-main'     => esc_html__( 'First theme main color', 'weldo' ),
						'color-main2'    => esc_html__( 'Second theme main color', 'weldo' ),
						'color-darkgrey' => esc_html__( 'Dark grey theme color', 'weldo' ),
						'color-dark'     => esc_html__( 'Dark theme color', 'weldo' ),
						'bordered-text'  => esc_html__( 'Bordered text', 'weldo' ),
					
					),
				),
				'layer_text_weight'    => array(
					'type'    => 'select',
					'value'   => 'fw-400',
					'label'   => esc_html__( 'Layer text weight', 'weldo' ),
					'desc'    => esc_html__( 'Select a weight for your text in layer', 'weldo' ),
					'choices' => array(
						'fw-100' => esc_html__( 'Thin', 'weldo' ),
						'fw-300' => esc_html__( 'Light', 'weldo' ),
						'fw-400' => esc_html__( 'Regular', 'weldo' ),
						'fw-500' => esc_html__( 'Medium', 'weldo' ),
						'fw-600' => esc_html__( 'Semi Bold', 'weldo' ),
						'fw-700' => esc_html__( 'Bold', 'weldo' ),
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
				'layer_letter_spacing' => array(
					'type'    => 'select',
					'value'   => '',
					'label'   => esc_html__( 'Layer letter spacing', 'weldo' ),
					'desc'    => esc_html__( 'Select a letter spacing for your heading', 'weldo' ),
					'choices' => array(
						''         => esc_html__( 'None', 'weldo' ),
						'big-ls'   => esc_html__( 'Big', 'weldo' ),
						'small-ls' => esc_html__( 'Small', 'weldo' ),
					),
				),
				'layer_animation'      => array(
					'type'    => 'select',
					'value'   => 'fadeIn',
					'label'   => esc_html__( 'Animation type', 'weldo' ),
					'desc'    => esc_html__( 'Select one of predefined animations', 'weldo' ),
					'choices' => weldo_unyson_option_animations(),
				),
				'class'                => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Additional Layer CSS class', 'weldo' ),
				),
			)
		),
		'template'        => esc_html__( 'Slider Layer', 'weldo' ),
		'limit'           => 5, // limit the number of boxes that can be added
		'add-button-text' => esc_html__( 'Add', 'weldo' ),
	),
	'class'                    => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Additional Slide CSS class', 'weldo' ),
	),
	'buttons'                  => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Buttons', 'weldo' ),
		'popup-title'   => esc_html__( 'Add/Edit Button', 'weldo' ),
		'desc'          => esc_html__( 'Create your buttons', 'weldo' ),
		'template'      => '{{=label}}',
		'popup-options' => array(
			$button_options,
		)
	),
	'button_animation'         => array(
		'type'    => 'select',
		'value'   => 'fadeIn',
		'label'   => esc_html__( 'Button animation type', 'weldo' ),
		'desc'    => esc_html__( 'Select one of predefined animations', 'weldo' ),
		'choices' => weldo_unyson_option_animations(),
	),
	'id'                       => array( 'type' => 'unique' ),
);