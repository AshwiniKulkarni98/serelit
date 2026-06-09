<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	
	'heading_align' => array(
		'type'    => 'select',
		'value'   => 'text-left',
		'label'   => esc_html__( 'Text alignment', 'weldo' ),
		'desc'    => esc_html__( 'Select heading text alignment', 'weldo' ),
		'choices' => array(
			''            => esc_html__( 'Default', 'weldo' ),
			'text-left'   => esc_html__( 'Left', 'weldo' ),
			'text-center' => esc_html__( 'Center', 'weldo' ),
			'text-right'  => esc_html__( 'Right', 'weldo' ),
		),
	),
	'headings'      => array(
		'type'        => 'addable-box',
		'value'       => '',
		'label'       => esc_html__( 'Headings', 'weldo' ),
		'desc'        => esc_html__( 'Choose a tag and text inside it', 'weldo' ),
		'box-options' => array(
			'heading_icon'           => array(
				'type'         => 'icon-v2',
				'preview_size' => 'medium',
				'modal_size'   => 'medium',
				'label'        => esc_html__( 'Optional icon', 'weldo' ),
			),
			'heading_tag'            => array(
				'type'    => 'select',
				'value'   => 'h3',
				'label'   => esc_html__( 'Heading tag', 'weldo' ),
				'desc'    => esc_html__( 'Select a tag for your', 'weldo' ),
				'choices' => array(
					'h3' => esc_html__( 'H3 tag', 'weldo' ),
					'h4' => esc_html__( 'H4 tag', 'weldo' ),
					'h5' => esc_html__( 'H5 tag', 'weldo' ),
					'h6' => esc_html__( 'H6 tag', 'weldo' ),
					'p'  => esc_html__( 'P tag', 'weldo' ),
				
				),
			),
			'heading_tag_size'       => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading size', 'weldo' ),
				'desc'    => esc_html__( 'Override default font size of heading', 'weldo' ),
				'choices' => array(
					''    => esc_html__( 'Default', 'weldo' ),
					'big' => esc_html__( 'Big Size', 'weldo' ),
				),
			),
			'heading_text'           => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__( 'Heading text', 'weldo' ),
			),
			'heading_font_family'    => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading font family', 'weldo' ),
				'desc'    => esc_html__( 'Select a font family for your heading', 'weldo' ),
				'choices' => array(
					''            => esc_html__( 'Default', 'weldo' ),
					'anton-font'  => esc_html__( 'Anton', 'weldo' ),
					'roboto-font' => esc_html__( 'Roboto', 'weldo' ),
				),
			),
			'heading_text_color'     => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading text color', 'weldo' ),
				'desc'    => esc_html__( 'Select a color for your heading', 'weldo' ),
				'choices' => array(
					''            => esc_html__( 'Inherited', 'weldo' ),
					'color-main'  => esc_html__( 'Color Main', 'weldo' ),
					'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
					'color-dark'  => esc_html__( 'Dark Color', 'weldo' ),
					'color-grey'  => esc_html__( 'Grey Color', 'weldo' ),
				),
			),
			'heading_text_weight'    => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading text weight', 'weldo' ),
				'desc'    => esc_html__( 'Select a weight for your heading', 'weldo' ),
				'choices' => array(
					''       => esc_html__( 'Normal', 'weldo' ),
					'thin'   => esc_html__( 'Thin', 'weldo' ),
					'fw-500' => esc_html__( 'Medium', 'weldo' ),
					'fw-700' => esc_html__( 'Semi Bold', 'weldo' ),
					'bold'   => esc_html__( 'Bold', 'weldo' ),
				),
			),
			'heading_text_transform' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading text transform', 'weldo' ),
				'desc'    => esc_html__( 'Select a weight for your heading', 'weldo' ),
				'choices' => array(
					''                => esc_html__( 'None', 'weldo' ),
					'text-lowercase'  => esc_html__( 'Lowercase', 'weldo' ),
					'text-uppercase'  => esc_html__( 'Uppercase', 'weldo' ),
					'text-capitalize' => esc_html__( 'Capitalize', 'weldo' ),
				),
			),
			'heading_letter_spacing' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading letter spacing', 'weldo' ),
				'desc'    => esc_html__( 'Select a letter spacing for your heading', 'weldo' ),
				'choices' => array(
					''                     => esc_html__( 'None', 'weldo' ),
					'big-letter-spacing'   => esc_html__( 'Big', 'weldo' ),
					'small-letter-spacing' => esc_html__( 'Small', 'weldo' ),
				),
			),
			'heading_line_height'    => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Heading line height', 'weldo' ),
				'desc'    => esc_html__( 'Select a line height for your heading', 'weldo' ),
				'choices' => array(
					''         => esc_html__( 'Default', 'weldo' ),
					'big-lh'   => esc_html__( 'Big', 'weldo' ),
					'small-lh' => esc_html__( 'Small', 'weldo' ),
				),
			),
			
			'heading_line'         => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__( 'Show heading line', 'weldo' ),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__( 'Hide', 'weldo' ),
				),
				'right-choice' => array(
					'value' => 'with-line',
					'label' => esc_html__( 'Show', 'weldo' ),
				),
			),
			'heading_text_link'    => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Heading link', 'weldo' ),
				'desc'  => esc_html__( 'Add a link to your heading', 'weldo' ),
			),
			'heading_custom_class' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__( 'Heading Custom Class', 'weldo' ),
				'desc'  => esc_html__( 'Add a link to your special heading', 'weldo' ),
			),
		),
		'template'    => '{{- heading_text }}',
	),
);
