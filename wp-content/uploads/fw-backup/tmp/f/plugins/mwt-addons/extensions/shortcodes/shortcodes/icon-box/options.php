<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$button         = fw_ext( 'shortcodes' ) -> get_shortcode( 'button' );
$button_options = $button -> get_options();
unset( $button_options['link'] );
unset( $button_options['target'] );

$options = array(
	'style'                => array(
		'type'    => 'select',
		'label'   => esc_html__( 'Box Style', 'weldo' ),
		'choices' => array(
			'top'   => esc_html__( 'Icon above title', 'weldo' ),
			'left'  => esc_html__( 'Icon to the left of title', 'weldo' ),
			'right' => esc_html__( 'Icon to the right of title', 'weldo' )
		)
	),
	'background_color'     => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Background color', 'weldo' ),
		'desc'    => esc_html__( 'Select background color', 'weldo' ),
		'help'    => esc_html__( 'Select one of predefined background types', 'weldo' ),
		'choices' => weldo_unyson_option_get_backgrounds_array(),
	),
	'icon'                 => array(
		'type'  => 'icon-v2',
		'label' => esc_html__( 'Choose an Icon', 'weldo' ),
	),
	'icon_style'           => array(
		'type'    => 'image-picker',
		'value'   => '',
		'label'   => esc_html__( 'Icon Style', 'weldo' ),
		'desc'    => esc_html__( 'Select one of predefined icon styles.', 'weldo' ),
		'choices' => array(
			''                 => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/1.png',
			'bordered'         => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/2.png',
			'rounded bordered' => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/3.png',
			'round bordered'   => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/4.png',
			'bg-'              => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/5.png',
			'rounded bg-'      => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/6.png',
			'round bg-'        => fw_get_template_customizations_directory_uri() . '/extensions/shortcodes/shortcodes/icon-box/static/img/7.png',
		),
		'blank'   => false,
	),
	'icon_color'           => array(
		'type'    => 'select',
		'label'   => esc_html__( 'Icon color', 'weldo' ),
		'value'   => 'color-main',
		'choices' => array(
			''            => esc_html__( 'Dark Color', 'weldo' ),
			'color-main'  => esc_html__( 'Color Main', 'weldo' ),
			'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
			'color-light' => esc_html__( 'Light Color', 'weldo' ),
			'color-grey'  => esc_html__( 'Grey Color', 'weldo' ),
		),
	),
	'icon_font_size'       => array(
		'type'    => 'select',
		'label'   => esc_html__( 'Icon Font Size', 'weldo' ),
		'value'   => 'fs-20',
		'choices' => array(
			''      => esc_html__( 'Inherit', 'weldo' ),
			'fs-12' => esc_html__( '12px', 'weldo' ),
			'fs-14' => esc_html__( '14px', 'weldo' ),
			'fs-16' => esc_html__( '16px', 'weldo' ),
			'fs-18' => esc_html__( '18px', 'weldo' ),
			'fs-20' => esc_html__( '20px', 'weldo' ),
			'fs-24' => esc_html__( '24px', 'weldo' ),
			'fs-28' => esc_html__( '28px', 'weldo' ),
			'fs-32' => esc_html__( '32px', 'weldo' ),
			'fs-36' => esc_html__( '36px', 'weldo' ),
			'fs-40' => esc_html__( '40px', 'weldo' ),
			'fs-50' => esc_html__( '50px', 'weldo' ),
			'fs-56' => esc_html__( '56px', 'weldo' ),
			'fs-60' => esc_html__( '60px', 'weldo' ),
		),
	),
	'title'                => array(
		'type'  => 'text',
		'label' => esc_html__( 'Title of the Box', 'weldo' ),
	),
	'title_text_color'     => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Title Text Color', 'weldo' ),
		'choices' => array(
			''            => esc_html__( 'Dark Color', 'weldo' ),
			'color-main'  => esc_html__( 'Color Main', 'weldo' ),
			'color-main2' => esc_html__( 'Color Main 2', 'weldo' ),
			'color-light' => esc_html__( 'Light Color', 'weldo' ),
			'color-grey'  => esc_html__( 'Grey Color', 'weldo' ),
		),
	),
	'title_size'           => array(
		'type'    => 'select',
		'label'   => esc_html__( 'Title Font Size', 'weldo' ),
		'value'   => 'fs-20',
		'choices' => array(
			''      => esc_html__( 'Inherit', 'weldo' ),
			'fs-16' => esc_html__( '16px', 'weldo' ),
			'fs-18' => esc_html__( '18px', 'weldo' ),
			'fs-20' => esc_html__( '20px', 'weldo' ),
			'fs-30' => esc_html__( '30px', 'weldo' ),
			'fs-40' => esc_html__( '40px', 'weldo' ),
			'fs-50' => esc_html__( '50px', 'weldo' ),
			'fs-60' => esc_html__( '60px', 'weldo' ),
			'fs-70' => esc_html__( '70px', 'weldo' ),
		),
	),
	'title_text_transform' => array(
		'type'    => 'select',
		'value'   => 'text-uppercase',
		'label'   => esc_html__( 'Title Text Transform', 'weldo' ),
		'choices' => array(
			''                => esc_html__( 'Default', 'weldo' ),
			'text-uppercase'  => esc_html__( 'Uppercase', 'weldo' ),
			'text-lowercase'  => esc_html__( 'Lowercase', 'weldo' ),
			'text-capitalize' => esc_html__( 'Capitalize', 'weldo' ),
		),
	),
	'content'              => array(
		'type'  => 'textarea',
		'label' => esc_html__( 'Content', 'weldo' ),
		'desc'  => esc_html__( 'Enter the desired content', 'weldo' ),
	),
	'text_align'           => array(
		'type'    => 'select',
		'label'   => esc_html__( 'Text alignment', 'weldo' ),
		'value'   => 'text-left',
		'choices' => array(
			'text-left'   => esc_html__( 'Left', 'weldo' ),
			'text-center' => esc_html__( 'Center', 'weldo' ),
			'text-right'  => esc_html__( 'Right', 'weldo' ),
		),
	),
	'link'                 => array(
		'type'  => 'text',
		'label' => esc_html__( 'Optional teaser link', 'weldo' ),
	),
	'class'                => array(
		'type'  => 'text',
		'label' => esc_html__( 'Optional additional CSS class', 'weldo' ),
	),
	'button'               => array(
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
	)
);