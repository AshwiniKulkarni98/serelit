<?php

if ( !function_exists( 'weldo_unyson_option_responsive_options_array' ) ) :
	function weldo_unyson_option_responsive_options_array() {
		return array(
			'hidden-xs' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Extra small screens (below 576px)', 'mwt'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'mwt'),
				),
				'right-choice' => array(
					'value' => 'hidden-xs',
					'label' => esc_html__('Hide', 'mwt'),
				),
			),
			'hidden-sm' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Small screens (between 576px and 767px)', 'mwt'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'mwt'),
				),
				'right-choice' => array(
					'value' => 'hidden-sm',
					'label' => esc_html__('Hide', 'mwt'),
				),
			),
			'hidden-md' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Medium screens (between 768px and 991px)', 'mwt'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'mwt'),
				),
				'right-choice' => array(
					'value' => 'hidden-md',
					'label' => esc_html__('Hide', 'mwt'),
				),
			),
			'hidden-lg' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Large screens (between 992px and 1199px)', 'mwt'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'mwt'),
				),
				'right-choice' => array(
					'value' => 'hidden-lg',
					'label' => esc_html__('Hide', 'mwt'),
				),
			),
			'hidden-xl' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Extra Large screens (above 1200px)', 'mwt'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'mwt'),
				),
				'right-choice' => array(
					'value' => 'hidden-xl',
					'label' => esc_html__('Hide', 'mwt'),
				),
			),
		);
	}
endif; //weldo_unyson_option_responsive_options_array

if ( !function_exists( 'weldo_unyson_option_get_backgrounds_array' ) ) :
	function weldo_unyson_option_get_backgrounds_array() {
		return array(
			''         => esc_html__( 'Transparent (No Background)', 'mwt' ),
			'hero-bg'  => esc_html__( 'Highlight', 'mwt' ),
			'muted-bg' => esc_html__( 'Muted', 'mwt' ),
			'ds ms'    => esc_html__( 'Dark Grey', 'mwt' ),
			'ds'       => esc_html__( 'Dark', 'mwt' ),
			'cs'       => esc_html__( 'Main color', 'mwt' ),
			'cs cs2'   => esc_html__( 'Second Main color', 'mwt' ),
			'bordered' => esc_html__( 'Transparent background with border', 'mwt' ),
			'box-shadow' => esc_html__( 'Transparent background with shadow', 'mwt' ),
			'hero-bg box-shadow' => esc_html__( 'Highlight background with shadow', 'mwt' ),
		);
	}
endif; //weldo_unyson_option_get_backgrounds_array

if ( !function_exists( 'weldo_unyson_options_get_responsive_css_classes' ) ) :
	function weldo_unyson_options_get_responsive_css_classes( $options ) {
		$css_class = '';
		$css_class .= ( !empty( $options['hidden_xs'] ) ) ? ' ' . $options['hidden_xs'] : '';
		$css_class .= ( !empty( $options['hidden_sm'] ) ) ? ' ' . $options['hidden_sm'] : '';
		$css_class .= ( !empty( $options['hidden_md'] ) ) ? ' ' . $options['hidden_md'] : '';
		$css_class .= ( !empty( $options['hidden_lg'] ) ) ? ' ' . $options['hidden_lg'] : '';
		$css_class .= ( !empty( $options['hidden_xl'] ) ) ? ' ' . $options['hidden_xl'] : '';
		return trim ( $css_class );
	}
endif; //weldo_unyson_options_get_responsive_css_classes

if ( !function_exists( 'weldo_unyson_options_get_divider_css_classes' ) ) :
	function weldo_unyson_options_get_divider_css_classes( $options ) {
		$css_class = '';
		$css_class .= ( $options['all'] !== '' ) ? ' divider-' . $options['all'] : '';
		$css_class .= ( $options['sm'] !== '' ) ? ' divider-sm-' . $options['sm'] : '';
		$css_class .= ( $options['md'] !== '' ) ? ' divider-md-' . $options['md'] : '';
		$css_class .= ( $options['lg'] !== '' ) ? ' divider-lg-' . $options['lg'] : '';
		$css_class .= ( $options['xl'] !== '' ) ? ' divider-xl-' . $options['xl'] : '';

		return trim ( $css_class );
	}
endif; //weldo_unyson_options_get_responsive_css_classes

if ( ! function_exists( 'weldo_get_unyson_icon_type_v2_array_for_special_heading' ) ) :
	function weldo_get_unyson_icon_type_v2_array_for_special_heading( $atts, $key ) {

		if ( !defined( 'FW' ) ) {
			return false;
		}
		if ( empty( $atts['headings'][$key]['heading_icon'] ) ) {
			return false;
		}
		$icon_array = $atts['headings'][$key]['heading_icon'];
		$icon_html  = '';
		$icon_type = false;
		if ( $icon_array['type'] === 'icon-font' ) {
			if($icon_array['icon-class'] !== '') {
				$icon_html = '<i class="' . $icon_array['icon-class'] . '"></i>';
				$icon_type = 'icon';
			}
		} elseif ($icon_array['type'] === 'custom-upload') {
			$icon_html = '<img src="' . $icon_array['url'] . '" alt="' . esc_attr( $atts['headings'][$key]['heading_text'] ) . '" class="special-heading-image">';
			$icon_type = 'image';
		}
		return array(
			'icon_html' => $icon_html,
			'icon_type' => $icon_type,
		);
	}
endif; //weldo_get_unyson_icon_type_v2_array_for_special_heading

if ( ! function_exists( 'weldo_get_unyson_icon_styled_class' ) ) :
	function weldo_get_unyson_icon_styled_class( $atts ) {
		if ( !defined( 'FW' ) ) {
			return '';
		}
		$class = $atts['icon_font_size'];
		$style_cololr_divider = ' ';

		if( strstr( $atts['icon_style'], 'bg-' ) ) {
			//main colors
			$atts['icon_color'] = str_replace( 'color-main', 'maincolor', $atts['icon_color'] );
			//darkgrey colors
			$atts['icon_color'] = str_replace( 'color-', '', $atts['icon_color'] );

			$style_cololr_divider = '';
		}

		return trim( $class . ' ' . $atts['icon_style'] . $style_cololr_divider . $atts['icon_color'] );
	}
endif; //weldo_get_unyson_icon_styled_class

if ( ! function_exists( 'weldo_get_unyson_icon_type_v2_array' ) ) :
	function weldo_get_unyson_icon_type_v2_array( $atts, $key ) {
		if ( !defined( 'FW' ) ) {
			return array(
				'icon_html' => '',
				'icon_type' => false,
			);
		}
		$icon_array = $atts[$key];
		$icon_html  = '';
		$icon_type = false;
		if ( $icon_array['type'] === 'icon-font' ) {
			if($icon_array['icon-class'] !== '') {
				$icon_html = '<i class="' . $icon_array['icon-class'] . '"></i>';
				$icon_type = 'icon';
			}
		} elseif ($icon_array['type'] === 'custom-upload') {
			$icon_html = '<img src="' . $icon_array['url'] . '" alt="' . esc_attr( $icon_array['type'] ) . '" class="special-heading-image">';
			$icon_type = 'image';
		}
		return array(
			'icon_html' => $icon_html,
			'icon_type' => $icon_type,
		);
	}
endif; //weldo_get_unyson_icon_type_v2_array

//set option for wp-scss plugin
if ( !function_exists( 'weldo_action_after_switch_theme_set_wp_scss_directories_options' ) ) :
	function weldo_action_after_switch_theme_set_wp_scss_directories_options() {
		$my_theme = wp_get_theme();
		$my_theme_name = $my_theme->get('Name');
		if ( $my_theme_name !== 'weldo' ) {
			$wpscss_options = array(
				'scss_dir' => '',
				'css_dir' => '/css/'
			);
			update_option( 'wpscss_options', $wpscss_options );
		}

	}
endif;
add_action('after_switch_theme', 'weldo_action_after_switch_theme_set_wp_scss_directories_options');