<?php

//Main theme options class
class Weldo_Options {
	public $self;
	public $customizer_options;
	public $default_fonts_array;

	public function __construct() {

		//singleton
		if( $this->self ) {
			return $this->self;
		} else {
			$this->self = $this;
		}

		//set default fonts property
		$this->default_fonts_array = $this->set_default_fonts_array();

		//all customizer options here
		//default values needs for theme without unyson istalled
		$default_options = $this->get_default_options_array();
		$customizer_options = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option() : array();

		//additional option array keys that we are using in theme for check
		//if Unyson installed
		$customizer_options['fw'] = defined( 'FW' ) ? true : false;
		//if WooCommerce installed
		$customizer_options['woo'] = class_exists( 'WooCommerce' ) ? true : false;

		//customizer options overwriting default options
		$this->customizer_options = wp_parse_args( $customizer_options, $default_options );
		// Force SERELIT header/footer layout site-wide (code override — wins over DB).
$this->customizer_options['page_header'] = '1';
$this->customizer_options['page_footer'] = '1';
$this->customizer_options['meta_phone']   = '+49 01622361442';
$this->customizer_options['meta_email']   = 'info@serelit.de';
$this->customizer_options['meta_address'] = 'Wielandstrasse 3, 65187 Wiesbaden';
$this->customizer_options['footer_columns_padding'] = 'c-gutter-100';
	}

	//get option value from whole options array
	public function get_customizer_option( $option_name, $default_value = '' ) {
		return ( !empty( $this->customizer_options[$option_name] ) ) ? $this->customizer_options[$option_name] : $default_value;
	}

	//theme default fonts for include
	public function set_default_fonts_array() {
		//put default google fonts here
		return array(
			'Anton' => array(
				'google_font'    => true,
				'subset'         => 'latin',
				'variation'      => '400',
				'variants'       => array( '400' ),
				'family'         => 'Anton',
				'style'          => false,
			),
			'Roboto' => array(
				'google_font'    => true,
				'subset'         => 'latin-ext',
				'variation'      => '300',
				'variants'       => array( '100', '300', '400', '500', '700', '900' ),
				'family'         => 'Roboto',
				'style'          => false,
				'weight'         => false,
				'size'           => '16',
				'line-height'    => '24',
				'letter-spacing' => '0',
				'color'          => false,
			)
		);
	}

	//theme default configuration options
	public function get_default_options_array() {
		return array (
			'logo_image' =>
				array (
					'attachment_id' => '2247',
					'url' =>  WELDO_THEME_URI . '/img/logo.png',
				),
			'logo_text' => 'weldo',
			'logo_image_breadcrumbs' =>
				array (
				),
			'page_header' => '1',
			'header_absolute' => false,
			'header_is_fluid' => false,
			'header_background_color' => 'ds ms',
			'header_background_image' => '',
			'header_background_cover' => false,
			'header_parallax' => true,
			'header_background_overlay' => false,
			'header_background_gradientradial' => false,
			'header_border_top' => '',
			'header_border_bottom' => '',
			'header_section_class' => '',
			'header_section_id' => '',
			'topline_is_fluid' => true,
			'topline_background_color' => 'ds ms',
			'topline_background_image' => '',
			'topline_background_cover' => false,
			'topline_parallax' => true,
			'topline_background_overlay' => true,
			'topline_background_gradientradial' => false,
			'topline_border_top' => '',
			'topline_border_bottom' => 's-borderbottom',
			'topline_section_class' => '',
			'topline_section_id' => '',
			'toplogo_is_fluid' => false,
			'toplogo_background_color' => 'ls',
			'toplogo_background_image' => '',
			'toplogo_background_cover' => false,
			'toplogo_parallax' => false,
			'toplogo_background_overlay' => false,
			'toplogo_background_gradientradial' => false,
			'toplogo_border_top' => '',
			'toplogo_border_bottom' => 's-borderbottom',
			'toplogo_section_class' => '',
			'toplogo_section_id' => '',
			'page_title' => '5',
			'hide_term_title' => true,
			'title_is_fluid' => false,
			'title_background_color' => 'ds',
			'title_top_padding' => 's-pt-60',
			'title_bottom_padding' => 's-pb-50',
			'title_background_image' => '',
			'title_background_cover' => true,
			'title_parallax' => true,
			'title_background_overlay' => true,
			'title_background_gradientradial' => false,
			'title_border_top' => '',
			'title_border_bottom' => '',
			'title_section_class' => '',
			'title_section_id' => '',
			'page_footer' => '1',
			'footer_is_fluid' => false,
			'footer_background_color' => 'ds ms',
			// 'footer_top_padding' => 's-pt-55',
			'footer_top_padding' => 's-pt-30',
			// 'footer_bottom_padding' => 's-pb-10',
			'footer_bottom_padding' => 's-pb-0',
			'footer_columns_padding' => 'c-gutter-60',
			'footer_columns_vertical_margins' => '',
			'footer_background_image' => '',
			'footer_background_cover' => false,
			'footer_parallax' => false,
			'footer_background_overlay' => false,
			'footer_background_gradientradial' => false,
			'footer_border_top' => '',
			'footer_border_bottom' => '',
			'footer_is_align_vertical' => false,
			'footer_section_class' => '',
			'footer_section_id' => '',
			'page_copyright' => '2',
			'copyright_text' => '© Copyright Weldo Metal Works',
			'copyright_is_fluid' => false,
			'copyright_background_color' => 'ls',
			'copyright_top_padding' => 's-pt-10',
			'copyright_bottom_padding' => 's-pb-0',
			'copyright_columns_padding' => '',
			'copyright_columns_vertical_margins' => '',
			'copyright_background_image' => '',
			'copyright_background_cover' => false,
			'copyright_parallax' => false,
			'copyright_background_overlay' => false,
			'copyright_background_gradientradial' => false,
			'copyright_border_top' => '',
			'copyright_border_bottom' => '',
			'copyright_is_align_vertical' => false,
			'copyright_section_class' => '',
			'copyright_section_id' => '',
			'body_font_picker_switch' =>
				array (
					'main_font_enabled' => '',
					'main_font_options' =>
						array (
							'main_font' =>
								array (
									'google_font' => true,
									'subset' => 'greek',
									'variation' => '500',
									'family' => 'Roboto',
									'style' => false,
									'weight' => false,
									'size' => '14',
									'line-height' => '24',
									'letter-spacing' => '0',
									'color' => false,
								),
						),
				),
			'h_font_picker_switch' =>
				array (
					'h_font_enabled' => '',
					'h_font_options' =>
						array (
							'h_font' =>
								array (
									'google_font' => true,
									'subset' => 'latin-ext',
									'variation' => '900',
									'family' => 'Roboto',
									'style' => false,
									'weight' => false,
									'size' => false,
									'line-height' => false,
									'letter-spacing' => '0',
									'color' => false,
								),
						),
				),
			'meta_phone' => '+1 234 056 78 90',
			'meta_email' => 'info@weldo.com',
			'social_icons' =>
				array (
					0 =>
						array (
							'icon' => 'fa fa-facebook',
							'icon_class' => '',
							'icon_url' => 'https://facebook.com/',
						),
					1 =>
						array (
							'icon' => 'fa fa-twitter',
							'icon_class' => '',
							'icon_url' => 'https://twitter.com/',
						),
					2 =>
						array (
							'icon' => 'fa fa-linkedin',
							'icon_class' => '',
							'icon_url' => 'https://www.linkedin.com/',
						),
					3 =>
						array (
							'icon' => 'fa fa-instagram',
							'icon_class' => '',
							'icon_url' => 'https://instagram.com/',
						),
					4 =>
						array (
							'icon' => 'fa fa-youtube-play',
							'icon_class' => '',
							'icon_url' => 'https://youtube.com/',
						),
				),
			'layout' =>
				array (
					'boxed' => '',
					'boxed_options' =>
						array (
							'body_background_image' => '',
							'body_cover' => '',
							'boxed_extra_margins' => '',
						),
				),
			'version' => 'ls',
			'color_scheme_number' => '',
			'accent_color_1' => '',
			'accent_color_2' => '',
			'accent_color_3' => '',
			'accent_color_4' => '',
			'blog_slider_switch' =>
				array (
					'blog_slider_enabled' => '',
					'yes' =>
						array (
							'slider_id' => '0',
						),
				),
			'blog_posts_widget_switch' => 'yes',
			'preloader' =>
				array (
					'preloader_type' => 'image_custom',
					'css' =>
						array (
							'options' => 'css',
						),
					'image' =>
						array (
							'options' => 'image',
						),
					'image_custom' =>
						array (
							'options' =>
								array (
									'attachment_id' => '2951',
									'url' =>  WELDO_THEME_URI . '/img/preloader.gif',
								),
						),
					'disabled' =>
						array (
							'options' => '',
						),
				),
			'preloader_custom_class' => '',
			'meta_address' => '2231 Johnstown Road Bensenville, IL 60106 ',
			'copyright_text2' => 'Theme: Weldo',
			'copyright_logo' => '',
			'blog_layout' => '1',
			'blog_hide_categories' => false,
			'blog_hide_author' => false,
			'blog_hide_date' => false,
			'blog_hide_comments_link' => false,
			'logo_image_inverse' =>
				array (
					'attachment_id' => '2247',
					'url' =>  WELDO_THEME_URI . '/img/logo.png',
				),
			'404_background_color' => 'ds',
			'404_background_image' =>
				array (
					'type' => 'custom',
					'custom' => '',
					'predefined' => '',
					'data' =>
						array (
							'icon' => '',
							'css' =>
								array (
								),
						),
				),
			'404_background_overlay' => true,
			'404_top_padding_lg' => 's-pt-lg-95',
			'404_bottom_padding_lg' => 's-pb-lg-100',
			'blog_hide_tags' => false,
			'share_facebook' => '0',
			'footer_top_padding_lg' => 's-pt-lg-100',
			'footer_bottom_padding_lg' => 's-pb-lg-45',
			'footer_top_padding_xl' => 's-pt-xl-150',
			'footer_bottom_padding_xl' => 's-pb-xl-100',
			'404_top_padding' => 's-pt-55',
			'404_bottom_padding' => 's-pb-60',
			'header_buttons' => '',
			'title_top_padding_lg' => 's-pt-lg-100',
			'title_bottom_padding_lg' => 's-pb-lg-90',
			'title_top_padding_xl' => 's-pt-xl-100',
			'header_show_all_menu_items' => true,
			'header_disable_affix_xl' => false,
			'header_disable_affix_xs' => false,
			'topline_is_content_between' => false,
			'toplogo_is_content_between' => false,
			'title_is_content_between' => false,
			'title_horizontal_padding' => '',
			'title_top_padding_sm' => '',
			'title_bottom_padding_sm' => '',
			'title_top_padding_md' => '',
			'title_bottom_padding_md' => '',
			'title_bottom_padding_xl' => '',
			'footer_is_content_between' => false,
			'footer_horizontal_padding' => '',
			'footer_top_padding_sm' => '',
			'footer_bottom_padding_sm' => '',
			'footer_top_padding_md' => '',
			'footer_bottom_padding_md' => '',
			'copyright_is_content_between' => false,
			'copyright_horizontal_padding' => '',
			'copyright_top_padding_sm' => '',
			'copyright_bottom_padding_sm' => '',
			'copyright_top_padding_md' => '',
			'copyright_bottom_padding_md' => '',
			'copyright_top_padding_lg' => '',
			'copyright_bottom_padding_lg' => '',
			'copyright_top_padding_xl' => '',
			'copyright_bottom_padding_xl' => '',
			'404_is_fluid' => false,
			'404_background_cover' => false,
			'404_parallax' => false,
			'404_background_gradientradial' => false,
			'404_border_top' => '',
			'404_border_bottom' => '',
			'404_is_content_between' => false,
			'404_section_class' => '',
			'404_section_id' => '',
			'404_horizontal_padding' => '',
			'404_top_padding_sm' => '',
			'404_bottom_padding_sm' => '',
			'404_top_padding_md' => '',
			'404_bottom_padding_md' => '',
			'404_top_padding_xl' => 's-pt-xl-150',
			'404_bottom_padding_xl' => 's-pb-xl-145',
			'share_twitter' => '1',
			'share_google_plus' => '1',
			'share_pinterest' => '1',
			'share_linkedin' => '1',
			'share_tumblr' => '1',
			'share_reddit' => '1',
			'error_text' => 'error',
			'first_line_text' => 'Sorry, the page you were looking for doesn’t exist! ',
			'second_line_text' => 'Dont worry, just have coffee and come back.',
			'404_image' =>
				array (
					'attachment_id' => '2712',
					'url' =>  WELDO_THEME_URI . '/img/404-img.png',
				),
			'404_button_label' => 'Go Home',
			'post_hide_author' => false,
			'blog_hide_like' => false,
			'meta_image_login' =>
				array (
					'attachment_id' => '2966',
					'url' =>  WELDO_THEME_URI . '/img/register-img.jpg',
				),
			'hide_shopping_cart' => false,
			'hide_search' => false,
			'hide_login_form' => false,
			'woo_title' => 'Related Products',
			'woo_subtitle' => '',
			'meta_image_register' => '',
			'404_button_link' => '#',
		);
	}
}


///////////////////
//options helpers//
///////////////////
if ( !function_exists( 'weldo_get_options' ) ) :
	/**
	 * Get all theme options in one array
	 * @return array
	 */
	function weldo_get_options() {
		$options = new Weldo_Options();
		$options = $options->customizer_options;
		return $options;
	}
endif; //weldo_get_options

if ( !function_exists( 'weldo_get_option' ) ) :
	/**
	 * Get single option
	 * @param $option_name
	 * @param string $default_value
	 *
	 * @return mixed|string
	 */
	function weldo_get_option( $option_name, $default_value = '' ) {
		$options = new Weldo_Options();
		$option_value = $options->get_customizer_option( $option_name, $default_value );
		return $option_value;
	}
endif; //weldo_get_option


if ( !function_exists( 'weldo_get_default_section_option_value' ) ) :
	/**
	 * Get default section option value for customizer options
	 * used in weldo_get_section_options_array
	 * @param string $option_name
	 * @param string $default_value
	 *
	 * @return mixed|string
	 */
	function weldo_get_default_section_option_value( $option_name, $default_value = '' ) {
		$options_class = new Weldo_Options();
		$defaults = $options_class->get_default_options_array();
		$option_value = ( !empty ( $defaults[$option_name] ) ) ? $defaults[$option_name] : $default_value;
		return $option_value;
	}
endif; //weldo_get_default_section_option_value

if ( !function_exists( 'weldo_get_switch_option_type' ) ) :
	function weldo_get_switch_option_type( $switch_array, $option_name, $value = false ) {
		$value = weldo_get_default_section_option_value( $option_name, $value );

		return array_merge($switch_array, array(
			'value' => $value,
			'left-choice' => array(
				'value' => false,
				'label' => esc_html__('No', 'weldo'),
				'color' => '', // #HEX
			),
			'right-choice' => array(
				'value' => true,
				'label' => esc_html__('Yes', 'weldo'),
				'color' => '', // #HEX
			),
		) );
	}
endif; //weldo_get_switch_option_type

//check if header absolute enabled
if ( ! function_exists( 'weldo_check_header_absolute_enabled' ) ) :

	function weldo_check_header_absolute_enabled() {
		$options = weldo_get_options();
		if( $options['header_absolute']['enabled'] == 'yes' ) {
			return false;
		} else {
			return true;
		}
	}

endif;

//section options array for any section
if ( !function_exists( 'weldo_get_section_options_array' ) ) :
	/**
	 * Get any section options
	 * @param string $prefix
	 * @param array $excluded_keys
	 *
	 * @return array
	 */
	function weldo_get_section_options_array( $prefix = '', $excluded_keys = array() ) {

		$weldo_check_header_absolute_enabled = ( 'header_' == $prefix ) ? 'weldo_check_header_absolute_enabled' : '__return_true';


		$options = array(
			$prefix . 'is_fluid' => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Full Width', 'weldo' ),
				'type'  => 'switch',
			), $prefix . 'is_fluid'
			),
			$prefix . 'background_color' => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value( $prefix . 'background_color', 'ls' ),
				'label'   => esc_html__( 'Background color', 'weldo' ),
				'help'    => esc_html__( 'Select one of predefined background colors',
					'weldo' ),
				'choices' => array(
					'ls'     => esc_html__( 'Light', 'weldo' ),
					'ls ms'  => esc_html__( 'Light Grey', 'weldo' ),
					'ds'     => esc_html__( 'Dark Grey', 'weldo' ),
					'ds ms'  => esc_html__( 'Dark Muted', 'weldo' ),
					'ds bs'  => esc_html__( 'Dark Blue', 'weldo' ),
					'cs'     => esc_html__( 'Main color', 'weldo' ),
					'cs cs2' => esc_html__( 'Second Main color', 'weldo' ),
				),
				'wp-customizer-args' => array(
					'active_callback' => $weldo_check_header_absolute_enabled,
				),
			),

			$prefix . 'columns_padding'  => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value($prefix . 'columns_padding', '' ),
				'label'   => esc_html__( 'Columns gutter (padding)', 'weldo' ),
				'help'    => esc_html__( 'Choose columns horizontal padding value (gutter)',
					'weldo' ),
				'choices' => array(
					'' => esc_html__( 'Inherited - default', 'weldo' ),
					'c-gutter-0'  => esc_html__( '0', 'weldo' ),
					'c-gutter-1'  => esc_html__( '1px', 'weldo' ),
					'c-gutter-2'  => esc_html__( '2px', 'weldo' ),
					'c-gutter-5'  => esc_html__( '5px', 'weldo' ),
					'c-gutter-10' => esc_html__( '10px', 'weldo' ),
					'c-gutter-20' => esc_html__( '20px', 'weldo' ),
					'c-gutter-25' => esc_html__( '25px', 'weldo' ),
					'c-gutter-30' => esc_html__( '30px', 'weldo' ),
					'c-gutter-40' => esc_html__( '40px', 'weldo' ),
					'c-gutter-45' => esc_html__( '45px', 'weldo' ),
					'c-gutter-50' => esc_html__( '50px', 'weldo' ),
					'c-gutter-60' => esc_html__( '60px', 'weldo' ),
					'c-gutter-70' => esc_html__( '70px', 'weldo' ),
					'c-gutter-80' => esc_html__( '80px', 'weldo' ),
					'c-gutter-100' => esc_html__( '100px', 'weldo' ),
					'c-gutter-130' => esc_html__( '130px', 'weldo' ),
				),
			),
			$prefix . 'columns_vertical_margins'  => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value( $prefix . 'columns_vertical_margins', '' ),
				'label'   => esc_html__( 'Column vertical margins', 'weldo' ),
				'help'    => esc_html__( 'Choose columns vertical margins value',
					'weldo' ),
				'choices' => array(
					''  => esc_html__( 'Top and bottom: 0 - default ', 'weldo' ),
					'c-my-1'  => esc_html__( 'Top and bottom: 1px', 'weldo' ),
					'c-my-2'  => esc_html__( 'Top and bottom: 2px', 'weldo' ),
					'c-my-5'  => esc_html__( 'Top and bottom: 5px', 'weldo' ),
					'c-my-10' => esc_html__( 'Top and bottom: 10px', 'weldo' ),
					'c-my-15' => esc_html__( 'Top and bottom: 15px', 'weldo' ),
					'c-my-20' => esc_html__( 'Top and bottom: 20px', 'weldo' ),
					'c-my-25' => esc_html__( 'Top and bottom: 25px', 'weldo' ),
					'c-my-30' => esc_html__( 'Top and bottom: 30px', 'weldo' ),
					'c-my-40' => esc_html__( 'Top and bottom: 30px', 'weldo' ),
					'c-my-50' => esc_html__( 'Top and bottom: 50px', 'weldo' ),
					'c-my-60' => esc_html__( 'Top and bottom: 60px', 'weldo' ),
					'c-mb-1'  => esc_html__( 'Bottom: 1px', 'weldo' ),
					'c-mb-2'  => esc_html__( 'Bottom: 2px', 'weldo' ),
					'c-mb-5'  => esc_html__( 'Bottom: 5px', 'weldo' ),
					'c-mb-10' => esc_html__( 'Bottom: 10px', 'weldo' ),
					'c-mb-15' => esc_html__( 'Bottom: 15px', 'weldo' ),
					'c-mb-20' => esc_html__( 'Bottom: 20px', 'weldo' ),
					'c-mb-25' => esc_html__( 'Bottom: 25px', 'weldo' ),
					'c-mb-30' => esc_html__( 'Bottom: 30px', 'weldo' ),
					'c-mb-40' => esc_html__( 'Bottom: 40px', 'weldo' ),
					'c-mb-50' => esc_html__( 'Bottom: 50px', 'weldo' ),
					'c-mb-60' => esc_html__( 'Bottom: 60px', 'weldo' ),
					'c-mt-1'  => esc_html__( 'Top: 1px', 'weldo' ),
					'c-mt-2'  => esc_html__( 'Top: 2px', 'weldo' ),
					'c-mt-5'  => esc_html__( 'Top: 5px', 'weldo' ),
					'c-mt-10' => esc_html__( 'Top: 10px', 'weldo' ),
					'c-mt-15' => esc_html__( 'Top: 15px', 'weldo' ),
					'c-mt-20' => esc_html__( 'Top: 20px', 'weldo' ),
					'c-mt-25' => esc_html__( 'Top: 25px', 'weldo' ),
					'c-mt-30' => esc_html__( 'Top: 30px', 'weldo' ),
					'c-mt-40' => esc_html__( 'Top: 30px', 'weldo' ),
					'c-mt-50' => esc_html__( 'Top: 50px', 'weldo' ),
					'c-mt-60' => esc_html__( 'Top: 60px', 'weldo' ),
				),
			),
			$prefix . 'background_image' => array(
				'label'   => esc_html__( 'Background Image', 'weldo' ),
				'help'    => esc_html__( 'Choose the background image for section', 'weldo' ),
				'type'    => 'background-image',
				'choices' => array(//	in future may will set predefined images
				)
			),
			$prefix . 'background_cover' => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Background Cover', 'weldo' ),
				'desc'    => esc_html__( 'Stretch the image', 'weldo' ),
				'help'    => esc_html__( 'Adds "background-size:cover" CSS rule', 'weldo' ),
				'type'  => 'switch'
			), $prefix . 'background_cover'
			),
			$prefix . 'parallax'  => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Parallax', 'weldo' ),
				'help'    => esc_html__( 'Adds background parallax effect on section background image', 'weldo' ),
				'type'  => 'switch',
			),
				$prefix . 'parallax'

			),
			$prefix . 'background_overlay' => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Background Color Overlay', 'weldo' ),
				'help'    => esc_html__( 'Adds semitransparent color overlay on section', 'weldo' ),
				'type'  => 'switch',
			),
				$prefix . 'background_overlay'

			),
			$prefix . 'background_gradientradial' => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Background Radial Overlay', 'weldo' ),
				'help'    => esc_html__( 'Adds semitransparent light radial overlay on section', 'weldo' ),
				'type'  => 'switch',
			),
				$prefix . 'background_gradientradial'
			),
			$prefix . 'border_top'      => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value( $prefix . 'border_top', '' ),
				'label'   => esc_html__( 'Top border', 'weldo' ),
				'desc'    => esc_html__( 'Will be hidden if overlay option is used','weldo' ),
				'help'    => esc_html__( 'Top border will be hidden if overlay option is used', 'weldo' ),
				'choices' => array(
					''   => esc_html__( 'None', 'weldo' ),
					's-bordertop'   => esc_html__( 'Full Width','weldo' ),
					's-bordertop-container'  => esc_html__( 'Container Width', 'weldo' ),
				),
			),
			$prefix . 'border_bottom'      => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value( $prefix . 'border_bottom' ,'' ),
				'label'   => esc_html__( 'Bottom border', 'weldo' ),
				'choices' => array(
					''   => esc_html__( 'None', 'weldo' ),
					's-borderbottom'   => esc_html__( 'Full Width','weldo' ),
					's-borderbottom-container'  => esc_html__( 'Container Width', 'weldo' ),
				),
			),
			$prefix . 'is_align_vertical'  => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Vertical align content', 'weldo' ),
				'help'  => esc_html__( 'Align columns content vertically on wide screens', 'weldo' ),
				'type'  => 'switch',
			),
				$prefix . 'is_align_vertical'

			),
			$prefix . 'is_content_between'  => weldo_get_switch_option_type( array(
				'label' => esc_html__( 'Align content between', 'weldo' ),
				'help'  => esc_html__( 'Align column between column', 'weldo' ),
				'type'  => 'switch',
			),
				$prefix . 'is_content_between'

			),
			$prefix . 'section_class' => array(
				'type'  => 'text',
				'value' => weldo_get_default_section_option_value( $prefix . 'section_class', '' ),
				'label' => esc_html__( 'Additional CSS class', 'weldo' ),
				'desc'  => esc_html__( 'Add your custom CSS class to section. Useful for Customization', 'weldo' ),
			),
			$prefix . 'section_id' => array(
				'type'  => 'text',
				'value' => weldo_get_default_section_option_value( $prefix . 'section_id', '' ),
				'label' => esc_html__( 'ID attribute', 'weldo' ),
				'desc'  => esc_html__( 'Add ID attribute to section. Useful for single page menu', 'weldo' ),
			),
		);

		if ( $excluded_keys ) {
			foreach ( $excluded_keys as $key ) {
				unset( $options[$prefix . $key] );
			}
		}

		return $options;
	}
endif; //weldo_get_section_options_array

if ( !function_exists( 'weldo_get_section_options' ) ) :
	/**
	 * Prepare section HTML attributes
	 * @param array $options
	 * @param string $prefix
	 *
	 * @return array
	 */
	function weldo_get_section_options( $options, $prefix = '') {
		$section_class_values = array(
			$prefix . 'background_color'         => $prefix . 'background_color',
			$prefix . 'horizontal_padding'       => $prefix . 'horizontal_padding',
			$prefix . 'top_padding'              => $prefix . 'top_padding',
			$prefix . 'bottom_padding'           => $prefix . 'bottom_padding',
			$prefix . 'columns_padding'          => $prefix . 'columns_padding',
			$prefix . 'columns_vertical_margins' => $prefix . 'columns_vertical_margins',
			$prefix . 'border_top'               => $prefix . 'border_top',
			$prefix . 'border_bottom'            => $prefix . 'border_bottom',
			$prefix . 'columns_vertical_margins' => $prefix . 'columns_vertical_margins',
			$prefix . 'section_class'            => $prefix . 'section_class',
			//responsive options
			$prefix . 'hidden_xs'                => $prefix . 'hidden_xs',
			$prefix . 'hidden_sm'                => $prefix . 'hidden_sm',
			$prefix . 'hidden_md'                => $prefix . 'hidden_md',
			$prefix . 'hidden_lg'                => $prefix . 'hidden_lg',
			$prefix . 'hidden_xl'                => $prefix . 'hidden_xl',
			$prefix . 'top_padding_sm'           => $prefix . 'top_padding_sm',
			$prefix . 'bottom_padding_sm'        => $prefix . 'bottom_padding_sm',
			$prefix . 'top_padding_md'           => $prefix . 'top_padding_md',
			$prefix . 'bottom_padding_md'        => $prefix . 'bottom_padding_md',
			$prefix . 'top_padding_lg'           => $prefix . 'top_padding_lg',
			$prefix . 'bottom_padding_lg'        => $prefix . 'bottom_padding_lg',
			$prefix . 'top_padding_xl'           => $prefix . 'top_padding_xl',
			$prefix . 'bottom_padding_xl'        => $prefix . 'bottom_padding_xl',
		);

		//array with section attributes
		$array = array(
			'section_class' => '',
			'section_container_class_suffix' => '',
			'section_row_class_suffix' => '',
			'section_id' => '',
			'section_background_image' => '',
		);

		//skip top border if color overlay or radial gradient is active
		if( !empty( $options[$prefix . 'background_overlay'] ) || !empty( $options[$prefix . 'background_gradientradial'] ) ) {
			unset( $section_class_values[$prefix . 'border_top'] );
		}
		//if background is set for absolute header - making topline, toplogo, header and title section with same background
		$header = weldo_get_predefined_template_part( 'header' );
		$topline = $header === 'header-5' ? '' : 'topline_'; //remove same background with header 5
		if(
			( $prefix === $topline || $prefix === 'toplogo_' || $prefix === 'header_' || $prefix === 'title_' )
			&&
			( !empty( $options['header_absolute']['enabled'] ) )
		) {
			$options[$prefix . 'background_color'] = $options['header_absolute']['yes']['header_absolute_background_color'];
		}

		//if is page and Unyson is installed - overriding global header and footer options from page settings
		if	( is_page() )  {
			if( $prefix === 'header_' && function_exists( 'fw_get_db_post_option' ) ) {
				$page_options = fw_get_db_post_option( get_the_ID(), 'header_page' );
				if ( ! empty( $page_options['header_page_styles'] ) ) {
					$options = array_merge( $options, $page_options['header_page_custom_styles'] );
				}
			}
			if( $prefix === 'footer_' && function_exists( 'fw_get_db_post_option' ) ) {
				$page_options = fw_get_db_post_option( get_the_ID(), 'footer_page' );
				if ( ! empty( $page_options['footer_page_styles'] ) ) {
					$options = array_merge( $options, $page_options['footer_page_custom_styles'] );
				}
			}
		}

		//building CSS class
		foreach ( $options as $key => $value ) {
			if( in_array( $key, $section_class_values ) ) {
				$array['section_class'] .= ' ' . $value;
			}
		}

		//additional CSS classes
		$array['section_class'] .= ( !empty( $options[$prefix . 'parallax'] ) ) ? ' s-parallax' : '';
		$array['section_class'] .= ( !empty( $options[$prefix . 'background_cover'] ) ) ? ' cover-background' : '';
		$array['section_class'] .= ( !empty( $options[$prefix . 'background_overlay'] ) ) ? ' s-overlay' : '';
		$array['section_class'] .= ( !empty( $options[$prefix . 'background_gradientradial'] ) ) ? ' gradientradial-background' : '';

		//container CSS class
		$array['section_container_class_suffix'] .= ( !empty( $options[$prefix . 'is_fluid'] ) ) ? '-fluid' : '';

		//row CSS class
		$array['section_row_class_suffix'] .= ( !empty( $options[$prefix . 'is_align_vertical'] ) ) ? ' align-items-center' : '';
		$array['section_row_class_suffix'] .= ( !empty( $options[$prefix . 'is_content_between'] ) ) ? ' justify-content-between' : '';

		//ID attribute
		$array['section_id'] .= ( !empty( $options[$prefix . 'section_id'] ) ) ? $options[$prefix . 'section_id'] : '';

		//bg image
		if ( !empty( $options[$prefix . 'background_image'] ) && !empty( $options[$prefix . 'background_image']['data']['icon'] ) ) {
			$array['section_background_image'] = 'background-image:url(' . $options[$prefix . 'background_image']['data']['icon'] . ');';
		}

		return $array;
	}
endif; //weldo_get_section_options


//default padding values that are set in variables_template SCSS file
if ( !function_exists( 'weldo_unyson_option_section_padding_choices ' ) ) :
	function weldo_unyson_option_section_padding_choices ( $prefix = '' ) {
		$padding_values = array( 0, 1, 2, 3, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 105, 110, 115, 120, 125, 120, 130, 135, 140, 145, 150, 170, 175, 195 );
		$breakpoins = array('xs', 'sm', 'md', 'lg', 'xl');

		$array = array( '' => esc_html__( 'Inherit', 'weldo' ) );
		foreach ( $padding_values as $value ) {
			$array[ $prefix . $value ] = esc_html__( $value . 'px', 'weldo' );
		}
		return $array;
	}
endif; //weldo_unyson_option_section_padding_choices

//background options
if ( !function_exists( 'weldo_unyson_option_get_section_padding_array' ) ) :
	function weldo_unyson_option_get_section_padding_array( $prefix = '' ) {
		return array(
			$prefix . 'horizontal_padding'      => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value($prefix . 'horizontal_padding', '' ),
				'label'   => esc_html__( 'Horizontal padding', 'weldo' ),
				'help'    => esc_html__( 'Choose horizontal padding value for section',
					'weldo' ),
				'choices' => array(
					' '                => esc_html__( 'Default', 'weldo' ),
					'container-px-0'   => esc_html__( '0', 'weldo' ),
					'container-px-10'   => esc_html__( '10px', 'weldo' ),
				),
			),
			$prefix . 'top_padding'      => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value($prefix . 'top_padding', 's-pt-50' ),
				'label'   => esc_html__( 'Top padding', 'weldo' ),
				'help'    => esc_html__( 'Choose top padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pt-' ),
			),
			$prefix . 'bottom_padding'   => array(
				'type'    => 'select',
				'value'   => weldo_get_default_section_option_value( $prefix . 'bottom_padding', 's-pb-50' ),
				'label'   => esc_html__( 'Bottom padding', 'weldo' ),
				'help'    => esc_html__( 'Choose bottom padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pb-' ),
			),
			$prefix . 'top_padding_sm' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Top padding above 576px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose top padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pt-sm-' ),
			),
			$prefix . 'bottom_padding_sm' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Bottom padding above 576px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose bottom padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pb-sm-' ),
			),
			$prefix . 'top_padding_md' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Top padding above 768px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose top padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pt-md-' ),
			),
			$prefix . 'bottom_padding_md' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Bottom padding above 768px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose bottom padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pb-md-' ),
			),
			$prefix . 'top_padding_lg' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Top padding above 992px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose top padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pt-lg-' ),
			),
			$prefix . 'bottom_padding_lg' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Bottom padding above 992px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose bottom padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pb-lg-' ),
			),
			$prefix . 'top_padding_xl' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Top padding above 1200px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose top padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pt-xl-' ),
			),
			$prefix . 'bottom_padding_xl' => array(
				'type'    => 'select',
				'value'   => '',
				'label'   => esc_html__( 'Bottom padding above 1200px screen', 'weldo' ),
				'help'    => esc_html__( 'Choose bottom padding value for section',
					'weldo' ),
				'choices' => weldo_unyson_option_section_padding_choices( 's-pb-xl-' ),
			),
		);
	}
endif; //weldo_unyson_option_get_section_padding_array



//animations
if ( !function_exists( 'weldo_unyson_option_animations' ) ) :
	function weldo_unyson_option_animations() {
		return array(
			''               => esc_html__( 'None', 'weldo' ),
			'slideDown'      => esc_html__( 'slideDown', 'weldo' ),
			'scaleAppear'    => esc_html__( 'scaleAppear', 'weldo' ),
			'fadeInLeft'     => esc_html__( 'fadeInLeft', 'weldo' ),
			'fadeInUp'       => esc_html__( 'fadeInUp', 'weldo' ),
			'fadeInRight'    => esc_html__( 'fadeInRight', 'weldo' ),
			'fadeInDown'     => esc_html__( 'fadeInDown', 'weldo' ),
			'fadeIn'         => esc_html__( 'fadeIn', 'weldo' ),
			'slideRight'     => esc_html__( 'slideRight', 'weldo' ),
			'slideUp'        => esc_html__( 'slideUp', 'weldo' ),
			'slideLeft'      => esc_html__( 'slideLeft', 'weldo' ),
			'expandUp'       => esc_html__( 'expandUp', 'weldo' ),
			'slideExpandUp'  => esc_html__( 'slideExpandUp', 'weldo' ),
			'expandOpen'     => esc_html__( 'expandOpen', 'weldo' ),
			'bigEntrance'    => esc_html__( 'bigEntrance', 'weldo' ),
			'hatch'          => esc_html__( 'hatch', 'weldo' ),
			'tossing'        => esc_html__( 'tossing', 'weldo' ),
			'pulse'          => esc_html__( 'pulse', 'weldo' ),
			'floating'       => esc_html__( 'floating', 'weldo' ),
			'bounce'         => esc_html__( 'bounce', 'weldo' ),
			'pullUp'         => esc_html__( 'pullUp', 'weldo' ),
			'pullDown'       => esc_html__( 'pullDown', 'weldo' ),
			'stretchLeft'    => esc_html__( 'stretchLeft', 'weldo' ),
			'stretchRight'   => esc_html__( 'stretchRight', 'weldo' ),
			'fadeInUpBig'    => esc_html__( 'fadeInUpBig', 'weldo' ),
			'fadeInDownBig'  => esc_html__( 'fadeInDownBig', 'weldo' ),
			'fadeInLeftBig'  => esc_html__( 'fadeInLeftBig', 'weldo' ),
			'fadeInRightBig' => esc_html__( 'fadeInRightBig', 'weldo' ),
			'slideInDown'    => esc_html__( 'slideInDown', 'weldo' ),
			'slideInLeft'    => esc_html__( 'slideInLeft', 'weldo' ),
			'slideInRight'   => esc_html__( 'slideInRight', 'weldo' ),
			'moveFromLeft'   => esc_html__( 'moveFromLeft', 'weldo' ),
			'moveFromRight'  => esc_html__( 'moveFromRight', 'weldo' ),
			'moveFromBottom' => esc_html__( 'moveFromBottom', 'weldo' ),
		);
	}
endif; //weldo_unyson_option_animations

//responsive options
if ( !function_exists( 'weldo_unyson_option_responsive_options_array' ) ) :
	function weldo_unyson_option_responsive_options_array() {
		return array(
			'hidden-xs' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Extra small screens (below 576px)', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'hidden-xs',
					'label' => esc_html__('Hide', 'weldo'),
				),
			),
			'hidden-sm' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Small screens (between 576px and 767px)', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'hidden-sm',
					'label' => esc_html__('Hide', 'weldo'),
				),
			),
			'hidden-md' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Medium screens (between 768px and 991px)', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'hidden-md',
					'label' => esc_html__('Hide', 'weldo'),
				),
			),
			'hidden-lg' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Large screens (between 992px and 1199px)', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'hidden-lg',
					'label' => esc_html__('Hide', 'weldo'),
				),
			),
			'hidden-xl' => array(
				'type'  => 'switch',
				'value' => '',
				'label' => esc_html__('Hide on Extra Large screens (above 1200px)', 'weldo'),
				'left-choice' => array(
					'value' => '',
					'label' => esc_html__('Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => 'hidden-xl',
					'label' => esc_html__('Hide', 'weldo'),
				),
			),
		);
	}
endif; //weldo_unyson_option_responsive_options_array

//background options
if ( !function_exists( 'weldo_unyson_option_get_backgrounds_array' ) ) :
	function weldo_unyson_option_get_backgrounds_array() {
		return array(
			''                   => esc_html__( 'Transparent (No Background)', 'weldo' ),
			'ls'                 => esc_html__( 'Light', 'weldo' ),
			'ds'                 => esc_html__( 'Dark', 'weldo' ),
			'ds ms'              => esc_html__( 'Dark Grey', 'weldo' ),
			'cs'                 => esc_html__( 'Main color', 'weldo' ),
			'cs cs2'             => esc_html__( 'Second Main color', 'weldo' ),
			'hero-bg'            => esc_html__( 'Highlight', 'weldo' ),
			'bordered'           => esc_html__( 'Transparent background with border', 'weldo' ),
			'box-shadow'         => esc_html__( 'Transparent background with shadow', 'weldo' ),
			'hero-bg box-shadow' => esc_html__( 'Highlight background with shadow', 'weldo' ),
		);
	}
endif; //weldo_unyson_option_get_backgrounds_array

//get responsive CSS classes from options array
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

//get divider class
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

//detecting is topline is visible
if ( !function_exists( 'weldo_topline_is_visible' ) ) :
	function weldo_topline_is_visible() {
		$header = weldo_get_option( 'page_header' );
		//array with headers where topline is not shown
		return ( ! in_array( $header, array( '2', '3', '4', '7', '100', '101', '102', '103' ) ) );
	}
endif; //weldo_topline_is_visible

//detecting is toplogo is visible
if ( !function_exists( 'weldo_toplogo_is_visible' ) ) :
	function weldo_toplogo_is_visible() {
		$header = weldo_get_option( 'page_header' );
		return ( ! in_array( $header, array( '1', '2', '4', '5', '6', '7', '100', '101', '102', '103' ) ) );
	}
endif; //weldo_toplogo_is_visible

//detecting is copyright secondary text option is visible
if ( !function_exists( 'weldo_copyright_secondary_text_is_visible' ) ) :
	function weldo_copyright_secondary_text_is_visible() {
		$copyright = weldo_get_option( 'page_copyright' );
		//array with copyright where secondary text is visible
		return ( in_array( $copyright, array( '2' ) ) );
	}
endif; //weldo_copyright_secondary_text_is_visible

//detecting is copyright logo option is visible
if ( !function_exists( 'weldo_copyright_logo_is_visible' ) ) :
	function weldo_copyright_logo_is_visible() {
		$copyright = weldo_get_option( 'page_copyright' );
		return ( in_array( $copyright, array( '3' ) ) );
	}
endif; //weldo_copyright_logo_is_visible

//detecting if shared buttons section is visible
if ( !function_exists( 'weldo_shared_buttons_options_is_visible' ) ) :
	function weldo_shared_buttons_options_is_visible() {
		return function_exists( 'mwt_share_this' );
	}
endif; //weldo_shared_buttons_options_is_visible

//predefined headers array
if ( !function_exists( 'weldo_get_predefined_headers_array' ) ) :
	function weldo_get_predefined_headers_array() {
		return array(
			'1'  => esc_html__( 'Default - Header with logo, menu and topline', 'weldo' ),
			'2'  => esc_html__( 'Simple header with menu', 'weldo' ),
			'7'  => esc_html__( 'Header with logo, centered menu, and phone', 'weldo' ),
			'3'  => esc_html__( 'Narrow header with top logo and info', 'weldo' ),
			'4'  => esc_html__( 'Header with logo, menu and buttons ', 'weldo' ),
			'5'  => esc_html__( 'Header with logo, menu, icons and top info', 'weldo' ),
			'6'  => esc_html__( 'Colored header with logo, menu, icons and top info', 'weldo' ),
			'100' => esc_html__( 'Left push header', 'weldo' ),
			'101' => esc_html__( 'Left slide header', 'weldo' ),
			'102' => esc_html__( 'Right push header', 'weldo' ),
			'103' => esc_html__( 'Right slide header', 'weldo' ),
		);
	}
endif; //weldo_get_predefined_headers_array

//header options array for customizer and for page options

if ( !function_exists( 'weldo_get_header_options_array_for_customizer_and_page' ) ) :
	function weldo_get_header_options_array_for_customizer_and_page( $defaults ) {
		$shortcodes_extension = fw()->extensions->get( 'shortcodes' );
		$header_buttons  = array();
		if ( ! empty( $shortcodes_extension ) ) {
			$header_buttons = $shortcodes_extension->get_shortcode( 'button' )->get_options();
		}
		return array(
			'header_layout'           => array(
				'title'   => esc_html__( 'Header Layout', 'weldo' ),
				//type tab for page options
				'type' => 'tab',
				'options' => array(
					'page_header' => array(
						'type'    => 'select',
						'value'   => $defaults['page_header'],
						'label'   => esc_html__( 'Template Header', 'weldo' ),
						'desc'    => esc_html__( 'Select one of predefined theme headers', 'weldo' ),
						'help'    => esc_html__( 'You can select one of predefined theme headers', 'weldo' ),
						'choices' => weldo_get_predefined_headers_array(),
						'blank'   => false,
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'header_absolute' => array(
						'label' => false,
						'desc'  => false,
						'type'  => 'multi-picker',
						'picker' => array(
							'enabled' => array(
								'label' => esc_html__('Position Absolute', 'weldo'),
								'type'  => 'switch',
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__('Enabled', 'weldo')
								),
								'left-choice' => array(
									'value' => '',
									'label' => esc_html__('Disabled', 'weldo')
								),
								'desc'  => esc_html__( 'Make header transparent and positioned inside slider or title section', 'weldo' ),
								'help'  => esc_html__( 'Adds "position:absolute" CSS rule on header', 'weldo' ),
								'wp-customizer-args' => array(
									'active_callback' => '__return_true',
								),
							),

						),
						'choices' => array(
							'yes' => array(
								'header_absolute_background_color' => array(
									'type'    => 'select',
									'value'   => 'ls',
									'label'   => esc_html__( 'Background color', 'weldo' ),
									'desc'    => esc_html__( 'This value will override selected background for Header and Title sections', 'weldo' ),
									'help'    => esc_html__( 'Select one of predefined background colors',
										'weldo' ),
									'choices' => array(
										'ls'     => esc_html__( 'Light', 'weldo' ),
										'ls ms'  => esc_html__( 'Light Grey', 'weldo' ),
										'ds'     => esc_html__( 'Dark Grey', 'weldo' ),
										'ds ms'  => esc_html__( 'Dark Muted', 'weldo' ),
										'cs'     => esc_html__( 'Main color', 'weldo' ),
										'cs cs2' => esc_html__( 'Second Main color', 'weldo' ),
									),
									'wp-customizer-args' => array(
										'active_callback' => '__return_true',
									),
								),
								'header_absolute_background_image' => array(
									'label'   => esc_html__( 'Background Image', 'weldo' ),
									'help'    => esc_html__( 'Choose the background image for section', 'weldo' ),
									'type'    => 'background-image',
									'choices' => array(//	in future may will set predefined images
									),
									'wp-customizer-args' => array(
										'active_callback' => '__return_true',
									),
								),
							),
						),
					),
					'header_show_all_menu_items' => array(
						'type'    => 'switch',
						'value'   => false,
						'label'   => esc_html__( 'Always show all menu items', 'weldo' ),
						'desc'    => esc_html__( 'Prevent hiding menu items that do not feet in menu width to sub-menus', 'weldo' ),
						'help'    => esc_html__( 'This option will not work if header with centered logo layout used', 'weldo' ),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__( 'Yes', 'weldo' )
						),
						'left-choice'  => array(
							'value' => false,
							'label' => esc_html__( 'No', 'weldo' )
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'header_disable_affix_xl' => array(
						'type'    => 'switch',
						'value'   => false,
						'label'   => esc_html__( 'Prevent sticky header on wide screens', 'weldo' ),
						'desc'    => esc_html__( 'Prevent header to be fixed on wide screens', 'weldo' ),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__( 'Yes', 'weldo' )
						),
						'left-choice'  => array(
							'value' => false,
							'label' => esc_html__( 'No', 'weldo' )
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'header_disable_affix_xs' => array(
						'type'    => 'switch',
						'value'   => false,
						'label'   => esc_html__( 'Prevent sticky header on small screens', 'weldo' ),
						'desc'    => esc_html__( 'Prevent header to be fixed on small screens', 'weldo' ),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__( 'Yes', 'weldo' )
						),
						'left-choice'  => array(
							'value' => false,
							'label' => esc_html__( 'No', 'weldo' )
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
				),
			),
			'header_section_options'  => array(
				'title'   => esc_html__( 'Header Section Options', 'weldo' ),
				//type tab for page options
				'type' => 'tab',
				'options' => weldo_get_section_options_array( 'header_', array(
					'top_padding',
					'bottom_padding',
					'top_padding_sm',
					'bottom_padding_sm',
					'top_padding_md',
					'bottom_padding_md',
					'top_padding_lg',
					'bottom_padding_lg',
					'top_padding_xl',
					'bottom_padding_xl',
					'columns_padding',
					'columns_vertical_margins',
					'is_align_vertical',
					'is_content_between',

				) ),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
		);
	}
endif; //weldo_get_header_options_array_for_customizer_and_page

//predefined footers array
if ( !function_exists( 'weldo_get_predefined_footers_array' ) ) :
	function weldo_get_predefined_footers_array() {
		return array(
			'1' => esc_html__( '4 columns footer', 'weldo' ),
			'2' => esc_html__( '3 columns footer', 'weldo' ),
			'3' => esc_html__( '2 columns footer', 'weldo' ),
			'4' => esc_html__( '1 column footer', 'weldo' ),
		);
	}
endif; //weldo_get_predefined_footers_array

//footer options array for customizer and for page options
if ( !function_exists( 'weldo_get_footer_options_array_for_customizer_and_page' ) ) :
	function weldo_get_footer_options_array_for_customizer_and_page( $defaults ) {
		return array(
			'footer_layout' => array(
				'title'                  => esc_html__( 'Footer Section Layout', 'weldo' ),
				//type tab for page options
				'type' => 'tab',
				'options'                => array(
					'page_footer' => array(
						'type'    => 'select',
						'value'   => $defaults['page_footer'],
						'label'   => esc_html__( 'Page footer', 'weldo' ),
						'desc'    => esc_html__( 'Select one of predefined page footers.', 'weldo' ),
						'help'    => esc_html__( 'You can select one of predefined theme footers', 'weldo' ),
						'choices' => weldo_get_predefined_footers_array(),
						'blank'   => false,
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'footer_section_options' => array(
				'title'   => esc_html__( 'Footer Section Options', 'weldo' ),
				//type tab for page options
				'type' => 'tab',
				'options' => weldo_get_section_options_array( 'footer_' ),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'footer_section_padding' => array(
				'title'   => esc_html__( 'Footer Section Padding', 'weldo' ),
				//type tab for page options
				'type' => 'tab',
				'options' => weldo_unyson_option_get_section_padding_array( 'footer_'),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
		);
	}
endif; //weldo_get_footer_options_array_for_customizer_and_page


//categories list default markup
add_filter( 'weldo_get_the_terms_defaults', function ( $args ) {
	$args['before'] = '<span class="cat-links">';
	$args['after'] = '</span>';

	return $args;
} );

add_filter( 'weldo_get_comments_counter_defaults', function ( $args ) {

	$options = weldo_get_options();
	if ( ! empty( $options['blog_hide_comments_link'] ) ) {
		$args['print'] = false;
	}

	return $args;
} );
