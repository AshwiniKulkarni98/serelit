<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$main_options = weldo_get_section_options_array();
$main_options['overflow_visible'] = array(
	'type'  => 'switch',
	'value' => false,
	'label' => esc_html__('Overflow visible', 'weldo'),
	'desc'  => esc_html__('Show content that do not fit in section', 'weldo'),
	'left-choice' => array(
		'value' => false,
		'label' => esc_html__('No', 'weldo'),
	),
	'right-choice' => array(
		'value' => true,
		'label' => esc_html__('Yes', 'weldo'),
	)
);
//adding section name for builder backend view
$main_options['section_name'] = array(
	'type'  => 'text',
	'value' => '',
	'label' => esc_html__('Optional section name', 'weldo'),
);

$options = array(
	'unique_id' => array(
		'type' => 'unique',
		'length' => 7
	),
	'tab_main_options' => array(
		'type' => 'tab',
		'title' => esc_html__('Main Options', 'weldo'),
		'options' => $main_options,
	),
	'tab_padding_options' => array(
		'type' => 'tab',
		'title' => esc_html__('Section Padding', 'weldo'),
		'options' => weldo_unyson_option_get_section_padding_array(),
	),
	'tab_onehalf_media_options' => array(
		'type' => 'tab',
		'title' => esc_html__('Side Media', 'weldo'),
		'options' => array(
			'side_media_image' => array(
				'type'  => 'upload',
				'value' => array(),
				'label' => esc_html__('Side media image', 'weldo'),
				'desc'  => esc_html__('Select image that you want to appear as one half side image', 'weldo'),
				'images_only' => true,
			),
			'side_media_link' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__('Link to your side media', 'weldo'),
				'desc'  => esc_html__('You can add a link to your side media. If YouTube link will be provided, video will play in LightBox', 'weldo'),
			),
			'side_media_video' => array(
				'type'    => 'oembed',
				'value'   => '',
				'label'   => esc_html__( 'Video', 'weldo' ),
				'desc'    => esc_html__( 'Adds video player. Works only when side media image is set', 'weldo' ),
				'help'    => esc_html__( 'Leave blank if no needed', 'weldo' ),
				'preview' => array(
					'width'      => 278, // optional, if you want to set the fixed width to iframe
					'height'     => 185, // optional, if you want to set the fixed height to iframe
					/**
					 * if is set to false it will force to fit the dimensions,
					 * because some widgets return iframe with aspect ratio and ignore applied dimensions
					 */
					'keep_ratio' => true
				),
			),
			'side_media_position'  => array(
				'type'  => 'switch',
				'value' => 'left',
				'label' => esc_html__('Media position', 'weldo'),
				'desc'  => esc_html__('Left or right media position', 'weldo'),
				'left-choice' => array(
					'value' => 'left',
					'label' => esc_html__('Left', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'right',
					'label' => esc_html__('Right', 'weldo'),
				),
			),
			'side_media_size'  => array(
				'type'  => 'switch',
				'value' => 'left',
				'label' => esc_html__('Media Size', 'weldo'),
				'desc'  => esc_html__('Choose the size of side media', 'weldo'),
				'left-choice' => array(
					'value' => 'asdasd',
					'label' => esc_html__('default', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'small-cover',
					'label' => esc_html__('small', 'weldo'),
				),
			),
		),
	),
	'tab_responsive' => array(
		'type' => 'tab',
		'title' => esc_html__('Responsive', 'weldo'),
		'options' => array(
			'responsive_visibility' => array(
				'type' => 'tab',
				'title' => esc_html__('Visibility', 'weldo'),
				'options' => weldo_unyson_option_responsive_options_array(),
			),
		),
	),
	'tab_background_extended' => array(
		'type' => 'tab',
		'title' => esc_html__('Background Video', 'weldo'),
		'options' => array(
			'background_video' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'type' => array(
						'type'    => 'select',
						'label'   => esc_html__( 'Background Type', 'weldo' ),
						'desc'    => esc_html__( 'Here you can choose section background type', 'weldo' ),
						'value'   => '',
						'choices' => array(
							'' => esc_html__( 'None', 'weldo' ),
							'video_oembed'    => esc_html__( 'Video OEmbed', 'weldo' ),
							'video_upload'    => esc_html__( 'Video Upload', 'weldo' ),
						)
					)
				),
				'choices' => array(
					'video_oembed'    => array(
						'video' => array(
							'desc'  => esc_html__( 'Insert your video URL', 'weldo' ),
							'type'  => 'text',
						),
						'poster' => array(
							'label'   => esc_html__( 'Replacement Image', 'weldo' ),
							'type'    => 'background-image',
							'help'    => esc_html__('This image will replace the video on mobile devices that disable background videos', 'weldo'),
						),
						'loop_video'      => array(
							'label'        => esc_html__( 'Loop Video', 'weldo' ),
							'desc'         => esc_html__( 'Enable loop video?', 'weldo' ),
							'type'         => 'switch',
							'right-choice' => array(
								'value' => 'yes',
								'label' => esc_html__( 'Yes', 'weldo' )
							),
							'left-choice'  => array(
								'value' => 'no',
								'label' => esc_html__( 'No', 'weldo' )
							),
							'value'        => 'yes',
						),
					),
					'video_upload' => array(
						'video'  => array(
							'desc'        => esc_html__( 'Upload a video', 'weldo' ),
							'images_only' => false,
							'type'        => 'upload',
						),
						'poster' => array(
							'label'   => esc_html__( 'Replacement Image', 'weldo' ),
							'type'    => 'background-image',
							'help'    => esc_html__('This image will replace the video on mobile devices that disable background videos', 'weldo'),
						),
						'loop_video'      => array(
							'label'        => esc_html__( 'Loop Video', 'weldo' ),
							'desc'         => esc_html__( 'Enable loop video?', 'weldo' ),
							'type'         => 'switch',
							'right-choice' => array(
								'value' => 'yes',
								'label' => esc_html__( 'Yes', 'weldo' )
							),
							'left-choice'  => array(
								'value' => 'no',
								'label' => esc_html__( 'No', 'weldo' )
							),
							'value'        => 'yes',
						),
					),
				)
			),
		),

	),
);
