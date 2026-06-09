<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext_services_settings = fw()->extensions->get( 'services' )->get_settings();
$post_type = $ext_services_settings['post_type'];
$button         = fw_ext( 'shortcodes' )->get_shortcode( 'button' );
$button_options = $button->get_options();
unset( $button_options['link'] );
unset( $button_options['target'] );

$options = array(
	'layout' => array(
		'label'   => esc_html__('Choose Service Layout', 'mwt'),
		'type'    => 'select',
		'value'   => '1',
		'choices' => array(
			'1'  => esc_html__('Default', 'mwt'),
			'2' => esc_html__('Second', 'mwt'),
		),
	),
	'service' => array(
		'type'  => 'multi-select',
		'value' => array(),
		'label' => esc_html__('Service', 'mwt'),
		'desc'  => esc_html__('Select service to display', 'mwt'),
		'population' => 'posts',
		'source' => $post_type,
		'limit' => 1,
	),
	'side_media_position'  => array(
		'type'  => 'switch',
		'value' => '',
		'label' => esc_html__('Media Position', 'mwt'),
		'desc'  => esc_html__('Left or right media position', 'mwt'),
		'left-choice' => array(
			'value' => '',
			'label' => esc_html__('Left', 'mwt'),
		),
		'right-choice' => array(
			'value' => 'media-right',
			'label' => esc_html__('Right', 'mwt'),
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
				'label'        => esc_html__( 'Show Button', 'mwt' ),
				'left-choice'  => array(
					'value' => '',
					'label' => esc_html__( 'No', 'mwt' ),
				),
				'right-choice' => array(
					'value' => 'button',
					'label' => esc_html__( 'Yes', 'mwt' ),
				),
			),
		),
		'choices' => array(
			''       => array(),
			'button' => $button_options,
		),
	),
	'class' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__( 'Additional CSS Class', 'mwt' ),
		'desc'  => esc_html__( 'Add your custom CSS class. Useful for Customization', 'mwt' ),
	),
);