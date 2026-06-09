<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

//custom template parts

	//header
$headers_array = array();
$current_header_customizer = weldo_get_option('page_header', '1' );
//first element - inherit from customizer
$headers_array[0] = esc_html__( 'Default - Global Header from customizer', 'weldo' );
$headers_default_array = weldo_get_predefined_headers_array();
//pushing all default headers
foreach( $headers_default_array as $key => $value ) {
	$headers_array[ $key ] = $value;
}

	//footer
$footers_array = array();
$current_footer_customizer = weldo_get_option('page_footer', '1' );
//first element - inherit from customizer
$footers_array[0] = esc_html__( 'Default - Global Footer from customizer', 'weldo' );
$footers_default_array = weldo_get_predefined_footers_array();
//pushing all default footers
foreach( $footers_default_array as $key => $value ) {
	$footers_array[ $key ] = $value;
}

$options_class = new Weldo_Options();
$defaults = $options_class->get_default_options_array();
$page_header_options = weldo_get_header_options_array_for_customizer_and_page( $defaults );
$page_footer_options = weldo_get_footer_options_array_for_customizer_and_page( $defaults );
//page header layout is separate option - unset it
unset( $page_header_options['header_layout']['options']['page_header'] );
//page footer layout is separate option - unset it
unset( $page_footer_options['footer_layout'] );

$options = array(
	'page-options-section' => array(
		'title'   => esc_html__( 'Featured Additional Options', 'weldo' ),
		'type'    => 'box',
		'context' => 'normal',
		'options' => array(
			'hide_title' => array(
				'type'  => 'switch',
				'value' => false,
				'label' => esc_html__('Hide Title section', 'weldo'),
				'desc'  => esc_html__('You can hide title section with breadcrumbs', 'weldo'),
				'left-choice' => array(
					'value' => false,
					'label' => esc_html__('Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__('Hide', 'weldo'),
				),
			),
			'header' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Override Default Header', 'weldo' ),
				'desc'    => esc_html__( 'Select one of predefined theme headers for this page', 'weldo' ),
				'help'    => esc_html__( 'You can override chosen header from customizer here', 'weldo' ),
				'choices' => $headers_array,
				'blank'   => false,
			),
			'header_page' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'header_page_styles' => array(
						'type'         => 'switch',
						'value'        => '',
						'label'        => esc_html__( 'Custom header options', 'weldo' ),
						'desc'         => esc_html__( 'Enable custom header layout styles for page', 'weldo' ),
						'left-choice'  => array(
							'value' => '',
							'label' => esc_html__( 'Disabled', 'weldo' ),
						),
						'right-choice' => array(
							'value' => 'header_page_custom_styles',
							'label' => esc_html__( 'Enabled', 'weldo' ),
						),
					),
				),
				'choices' => array(
					'header_page_custom_styles' => $page_header_options
				),
			),
			'footer' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Override Default Footer', 'weldo' ),
				'desc'    => esc_html__( 'Select one of predefined theme footers for this page', 'weldo' ),
				'help'    => esc_html__( 'You can override chosen footer from customizer here', 'weldo' ),
				'choices' => $footers_array,
				'blank'   => false,
			),
			'footer_page' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'footer_page_styles' => array(
						'type'         => 'switch',
						'value'        => '',
						'label'        => esc_html__( 'Custom footer options', 'weldo' ),
						'desc'         => esc_html__( 'Enable custom footer layout styles for page', 'weldo' ),
						'left-choice'  => array(
							'value' => '',
							'label' => esc_html__( 'Disabled', 'weldo' ),
						),
						'right-choice' => array(
							'value' => 'footer_page_custom_styles',
							'label' => esc_html__( 'Enabled', 'weldo' ),
						),
					),
				),
				'choices' => array(
					'footer_page_custom_styles' => $page_footer_options
				),
			),
		),
	),
);


//page slider
$slider_extension = fw()->extensions->get( 'slider' );
//returning if no slider - only options for page is slider options
if ( empty ( $slider_extension ) ) {
	return;
}

$choices = '';
if ( ! empty ( $slider_extension ) ) {
	$choices = $slider_extension->get_populated_sliders_choices();
}

if ( ! empty( $choices ) ) {
	$choices_no_slider = array( 0 => esc_html__( 'No Slider', 'weldo' ) );

	array_push( $options['page-options-section']['options'], array(
			'slider_id' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Select Slider', 'weldo' ),
				'choices' => $choices_no_slider + $choices
			),
		)
	);
} else {
	array_push( $options['page-options-section']['options'], array(
			'slider_id' => array(
				'type' => 'hidden',
			),
			'no-forms'  => array(
				'type'  => 'html-full',
				'label' => false,
				'desc'  => false,
				'html'  =>
					'<div>' .
					'<h1 style="font-weight:100; text-align:center;">' . esc_html__( 'No Sliders Available', 'weldo' ) . '</h1>' .
					'<p style="text-align:center">' .
					'<em>' .
					str_replace(
						array(
							'{br}',
							'{add_slider_link}'
						),
						array(
							'<br/>',
							fw_html_tag( 'a', array(
								'href'   => admin_url( 'post-new.php?post_type=' . fw()->extensions->get( 'slider' )->get_post_type() ),
								'target' => '_blank',
							), esc_html__( 'create a new Slider', 'weldo' ) )
						),
						esc_html__( 'No Sliders created yet. Please go to the {br}Sliders page and {add_slider_link}.', 'weldo' )
					) .
					'</em>' .
					'</p>' .
					'</div>'
			)
		)
	);
}
