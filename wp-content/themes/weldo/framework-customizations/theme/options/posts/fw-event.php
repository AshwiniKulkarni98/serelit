<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'post-featured-gallery-section' => array(
		'title'   => esc_html__( 'Featured Gallery', 'weldo' ),
		'type'    => 'box',
		'context' => 'side',

		'options' => array(
			'post-featured-gallery' => array(
				'type'  => 'multi-upload',
				'value' => array(),
				'label' => esc_html__('Images for featured gallery', 'weldo'),
				'desc'  => esc_html__('Display gallery carousel on single event', 'weldo'),
				/**
				 * If set to `true`, the option will allow to upload only images, and display a thumb of the selected one.
				 * If set to `false`, the option will allow to upload any file from the media library.
				 */
				'images_only' => true,
				/**
				 * An array with allowed files extensions what will filter the media library and the upload files.
				 */
			),
		),
	)
);

/** Add Unyson Events Excerpt */
if ( ! function_exists( 'weldo_filter_fw_ext_events_excerpt' ) ) :
	function weldo_filter_fw_ext_events_excerpt( $options ) {
		return array_merge( $options, array(
			'events_excerpt_tab' => array(
				'title'   => esc_html__( 'Event Excerpt', 'weldo' ),
				'type'    => 'tab',
				'options' => array(
					'excerpt_text_id' => array(
						'type'  => 'textarea',
						'label' => esc_html__( 'Excerpt Text', 'weldo' ),
						'desc'  => false,
					)
				)
			)
		) );
	}
endif;
add_filter( 'fw_ext_events_post_options', 'weldo_filter_fw_ext_events_excerpt' );