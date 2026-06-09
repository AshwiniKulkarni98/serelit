<?php if (!defined('FW')) {
	die('Forbidden');
}
/**
 * Framework options
 *
 * @var array $options Fill this array with options to generate framework settings form in WordPress customizer
 */

//theme defaults
$options_class = new Weldo_Options();
$defaults      = $options_class->get_default_options_array();

// color defaults
$current_colors = weldo_get_theme_current_colors();

//find fw_ext
$shortcodes_extension = fw()->extensions->get('shortcodes');
$meta_social_icons    = array();
if (!empty($shortcodes_extension)) {
	$meta_social_icons = $shortcodes_extension->get_shortcode('icons_social')->get_options();
}

$slider_extension    = fw()->extensions->get('slider');
$choices_blog_slider = array();
if (!empty($slider_extension)) {
	$choices_blog_slider = $slider_extension->get_populated_sliders_choices();
}
$header_buttons = array();
if (!empty($shortcodes_extension)) {
	$header_buttons = $shortcodes_extension->get_shortcode('button')->get_options();
}
//
//adding empty value to disable slider
$choices_blog_slider[0] = esc_html__('No Slider', 'weldo');

$options = array(
	'meta_section'          => array(
		'title'   => esc_html__('Theme Meta', 'weldo'),
		'options' => array(
			'meta_phone'         => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__('Phone number', 'weldo'),
				'desc'  => esc_html__('Number to appear in header', 'weldo'),
				'help'  => esc_html__('Not all headers display this info', 'weldo'),
			),
			'meta_email'         => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__('Email', 'weldo'),
				'desc'  => esc_html__('Email to appear in header', 'weldo'),
				'help'  => esc_html__('Not all headers display this info', 'weldo'),
			),
			'meta_address'       => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__('Address', 'weldo'),
				'desc'  => esc_html__('Address to appear in header', 'weldo'),
				'help'  => esc_html__('Not all headers display this info', 'weldo'),
			),
			'meta_image_login'   => array(
				'label' => esc_html__('Image for login form', 'weldo'),
				'desc'  => esc_html__('Either upload a new, or choose an existing image from your media library', 'weldo'),
				'type'  => 'upload'
			),
			//'social_icons'
			$meta_social_icons,
			'hide_shopping_cart' => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__('Hide Shopping Cart', 'weldo'),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__(' Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__(' Hide', 'weldo'),
				),
			),
			'hide_search'        => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__('Hide Search Widget', 'weldo'),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__(' Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__(' Hide', 'weldo'),
				),
			),
			'hide_login_form'    => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__('Hide Login Form', 'weldo'),
				'left-choice'  => array(
					'value' => false,
					'label' => esc_html__(' Show', 'weldo'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__(' Hide', 'weldo'),
				),
			),
			'header_buttons'     => array(
				'label'         => esc_html__('Buttons', 'weldo'),
				'popup-title'   => esc_html__('Add/Edit Buttons', 'weldo'),
				'desc'          => esc_html__('Add button for header', 'weldo'),
				'help'          => esc_html__('Buttons Limit 2 used in header 2,3 and 4', 'weldo'),
				'type'          => 'addable-popup',
				'limit'         => 2, // limit the number of boxes that can be added
				'template'      => '{{=label}}',
				'popup-options' => array(
					$header_buttons,
				)
			),
		),

		'wp-customizer-args' => array(
			'active_callback' => '__return_true',
			'priority'        => 150,
		),
	),
	'header_section'        => array(
		'title'   => esc_html__('Theme Header Section', 'weldo'),
		'options' => array(
			'logo_section'            => array(
				'title'   => esc_html__('Logo', 'weldo'),
				'options' => array(
					'logo_image'         => array(
						'type'               => 'upload',
						'value'              => array(),
						'attr'               => array(
							'class'           => 'logo_image-class',
							'data-logo_image' => 'logo_image'
						),
						'label'              => esc_html__('Main logo image that appears in header', 'weldo'),
						'desc'               => esc_html__('Select your logo', 'weldo'),
						'help'               => esc_html__('Choose image to display as a site logo', 'weldo'),
						'images_only'        => true,
						'files_ext'          => array('png', 'jpg', 'jpeg', 'gif'),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'logo_image_inverse' => array(
						'type'               => 'upload',
						'value'              => array(),
						'attr'               => array(
							'class'           => 'logo_image-class',
							'data-logo_image' => 'logo_image'
						),
						'label'              => esc_html__('Main inverse logo image that appears in dark header', 'weldo'),
						'desc'               => esc_html__('Select your inverse logo', 'weldo'),
						'help'               => esc_html__('Choose image to display as a site inverse logo', 'weldo'),
						'images_only'        => true,
						'files_ext'          => array('png', 'jpg', 'jpeg', 'gif'),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'logo_text'          => array(
						'type'               => 'text',
						'value'              => 'weldo',
						'attr'               => array('class' => 'logo_text-class', 'data-logo_text' => 'logo_text'),
						'label'              => esc_html__('Logo Text', 'weldo'),
						'desc'               => esc_html__('Text that appears near logo image', 'weldo'),
						'help'               => esc_html__('Type your text to show it in logo', 'weldo'),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'logo_size' => array(
						'type'         => 'switch',
						'value'        => false,
						'label'        => esc_html__('Logo Full Size ', 'weldo'),
						'desc'         => esc_html__('Use full size of logo', 'weldo'),
						'right-choice' => array(
							'value' => false,
							'label' => esc_html__('No', 'weldo')
						),
						'left-choice'  => array(
							'value' => 'logo-full-width',
							'label' => esc_html__('Yes', 'weldo')
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
				),
			),
			weldo_get_header_options_array_for_customizer_and_page($defaults),
			'topline_section_options' => array(
				'title'              => esc_html__('Topline Section Options', 'weldo'),
				'options'            => weldo_get_section_options_array('topline_', array(
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

				)),
				'wp-customizer-args' => array(
					'active_callback' => 'weldo_topline_is_visible',
				),
			),
			'toplogo_section_options' => array(
				'title'              => esc_html__('Toplogo Section Options', 'weldo'),
				'options'            => weldo_get_section_options_array('toplogo_', array(
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

				)),
				'wp-customizer-args' => array(
					'active_callback' => 'weldo_toplogo_is_visible',
				),
			),
		),
	),
	'title_section'         => array(
		'title'   => esc_html__('Theme Title Section', 'weldo'),
		'options' => array(
			'title_layout'          => array(
				'title'   => esc_html__('Title Section Layout', 'weldo'),
				'options' => array(
					'page_title'      => array(
						'type'               => 'select',
						'value'              => $defaults['page_title'],
						'attr'               => array(
							'class' => 'breadcrumbs-thumbnail',
						),
						'label'              => esc_html__('Page title sections with optional breadcrumbs', 'weldo'),
						'desc'               => esc_html__('Select one of predefined page title sections. Install Unyson Breadcrumbs extension to display breadcrumbs', 'weldo'),
						'help'               => esc_html__('You can select one of predefined theme title sections', 'weldo'),
						'choices'            => array(
							'1' => esc_html__('Default - title above breadcrumbs', 'weldo'),
							'2' => esc_html__('Left title with right breadcrumbs', 'weldo'),
							'3' => esc_html__('Left title with inline breadcrumbs', 'weldo'),
							'4' => esc_html__('Centered title with bottom right breadcrumbs', 'weldo'),
							'5' => esc_html__('Left  title with bottom breadcrumbs', 'weldo'),
							'6' => esc_html__('Centered small title with bottom small breadcrumbs', 'weldo'),

						),
						'blank'              => false,
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'hide_term_title' => array(
						'type'               => 'switch',
						'value'              => true,
						'label'              => esc_html__('Hide Term Name', 'weldo'),
						'desc'               => esc_html__('May to hide Archive or Taxonomy Name, such as \'Archives: \', \'Category: \', \'Tag: \', etc. ', 'weldo'),
						'right-choice'       => array(
							'value' => false,
							'label' => esc_html__('Show', 'weldo')
						),
						'left-choice'        => array(
							'value' => true,
							'label' => esc_html__('Hide', 'weldo')
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
				),
			),
			'title_section_options' => array(
				'title'              => esc_html__('Title Section Options', 'weldo'),
				'options'            => weldo_get_section_options_array('title_', array(
					'columns_padding',
					'columns_vertical_margins',
					'is_align_vertical',
				)),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'title_section_padding' => array(
				'title'              => esc_html__('Title Section Padding', 'weldo'),
				'options'            => weldo_unyson_option_get_section_padding_array('title_'),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
		),
	),
	'footer_section'        => array(
		'title'   => esc_html__('Theme Footer Section', 'weldo'),
		'options' => array(
			weldo_get_footer_options_array_for_customizer_and_page($defaults)
		),
	),
	'copyright_section'     => array(
		'title'   => esc_html__('Theme Copyright Section', 'weldo'),
		'options' => array(
			'copyright_layout'          => array(
				'title'   => esc_html__('Copyright Section Layout', 'weldo'),
				'options' => array(
					'page_copyright' => array(
						'type'               => 'select',
						'value'              => $defaults['page_copyright'],
						'label'              => esc_html__('Page copyright', 'weldo'),
						'desc'               => esc_html__('Select one of predefined page copyright sections.', 'weldo'),
						'help'               => esc_html__('You can select one of predefined theme copyright section', 'weldo'),
						'choices'            => array(
							'1' => esc_html__('One centered column', 'weldo'),
							'2' => esc_html__('Two columns', 'weldo'),
							'3' => esc_html__('Three columns with logo and menu', 'weldo'),
							'4' => esc_html__('Two columns with menu', 'weldo'),
						),
						'blank'              => false,
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'copyright_text' => array(
						'type'               => 'textarea',
						'value'              => '&copy; Weldo <span class="copyright_year">2020</span> - All Rights Reserved',
						'label'              => esc_html__('Copyright text', 'weldo'),
						'desc'               => esc_html__('Please type your copyright text', 'weldo'),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'copyright_logo' => array(
						'type'               => 'upload',
						'value'              => '',
						'label'              => esc_html__('Copyright logo', 'weldo'),
						'desc'               => esc_html__('Appears in certain copyright layouts', 'weldo'),
						'wp-customizer-args' => array(
							'active_callback' => 'weldo_copyright_logo_is_visible',
						),
					),
				),
			),
			'copyright_section_options' => array(
				'title'              => esc_html__('Copyright Section Options', 'weldo'),
				'options'            => weldo_get_section_options_array('copyright_'),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'copyright_section_padding' => array(
				'title'              => esc_html__('Copyright Section Padding', 'weldo'),
				'options'            => weldo_unyson_option_get_section_padding_array('copyright_'),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
		),
	),
	'404_panel'             => array(
		'title'   => esc_html__('Theme 404 page', 'weldo'),
		'options' => array(
			'404_section_content' => array(
				'title'              => esc_html__('404 Section Content', 'weldo'),
				'options'            => array(
					'error_text'       => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('Error Text', 'weldo'),
						'desc'  => esc_html__('Text to appear above 404', 'weldo'),
					),
					'first_line_text'  => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('First Line Text', 'weldo'),
						'desc'  => esc_html__('Text to appear under 404', 'weldo'),
					),
					'second_line_text' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('Second Line Text', 'weldo'),
						'desc'  => esc_html__('Text to appear after first line text', 'weldo'),
					),
					'404_image'        => array(
						'type'        => 'upload',
						'value'       => '',
						'label'       => esc_html__('404 image', 'weldo'),
						'desc'        => esc_html__('Either upload a new, or choose an existing image from your media library', 'weldo'),
						'images_only' => true,
					),
					'404_button_label' => array(
						'label' => esc_html__('Button Label', 'weldo'),
						'desc'  => esc_html__('This is the text that appears on your button', 'weldo'),
						'type'  => 'text',
						'value' => esc_html__('Submit', 'weldo'),
					),
					'404_button_link'  => array(
						'label' => esc_html__('Button Link', 'weldo'),
						'desc'  => esc_html__('Where should your button link to', 'weldo'),
						'type'  => 'text',
						'value' => '#'
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'404_section_options' => array(
				'title'              => esc_html__('404 Section Options', 'weldo'),
				'options'            => weldo_get_section_options_array('404_', array(
					'columns_padding',
					'columns_vertical_margins',
					'is_align_vertical',
				)),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'404_section_padding' => array(
				'title'              => esc_html__('404 Section Padding', 'weldo'),
				'options'            => weldo_unyson_option_get_section_padding_array('404_'),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
		)
	),
	'fonts_section'         => array(
		'title'   => esc_html__('Theme Fonts', 'weldo'),
		'options' => array(
			'body_fonts_section' => array(
				'title'              => esc_html__('Font for body', 'weldo'),
				'options'            => array(
					'body_font_picker_switch' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'main_font_enabled' => array(
								'type'         => 'switch',
								'value'        => '',
								'label'        => esc_html__('Enable', 'weldo'),
								'desc'         => esc_html__('Enable custom body font', 'weldo'),
								'left-choice'  => array(
									'value' => '',
									'label' => esc_html__('Disabled', 'weldo'),
								),
								'right-choice' => array(
									'value' => 'main_font_options',
									'label' => esc_html__('Enabled', 'weldo'),
								),
							),
						),
						'choices' => array(
							'main_font_options' => array(
								'main_font' => array(
									'type'       => 'typography-v2',
									'value'      => array(
										'family'         => 'Roboto',
										'subset'         => 'latin-ext',
										'variation'      => 'regular',
										'size'           => 14,
										'line-height'    => 24,
										'letter-spacing' => 0,
										'color'          => '#0000ff'
									),
									'components' => array(
										'family'         => true,
										'size'           => true,
										'line-height'    => true,
										'letter-spacing' => true,
										'color'          => false
									),
									'label'      => esc_html__('Custom font', 'weldo'),
									'desc'       => esc_html__('Select custom font for headings', 'weldo'),
									'help'       => esc_html__('You should enable using custom heading fonts above at first', 'weldo'),
								),
							),
						),
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),

			'headings_fonts_section' => array(
				'title'              => esc_html__('Font for headings', 'weldo'),
				'options'            => array(
					'h_font_picker_switch' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'h_font_enabled' => array(
								'type'         => 'switch',
								'value'        => '',
								'label'        => esc_html__('Enable', 'weldo'),
								'desc'         => esc_html__('Enable custom heading font', 'weldo'),
								'left-choice'  => array(
									'value' => '',
									'label' => esc_html__('Disabled', 'weldo'),
								),
								'right-choice' => array(
									'value' => 'h_font_options',
									'label' => esc_html__('Enabled', 'weldo'),
								),
							),
						),
						'choices' => array(
							'h_font_options' => array(
								'h_font' => array(
									'type'       => 'typography-v2',
									'value'      => array(
										'family'         => 'Roboto',
										'subset'         => 'latin-ext',
										'variation'      => 'regular',
										'size'           => 28,
										'line-height'    => '100%',
										'letter-spacing' => 0,
										'color'          => '#0000ff'
									),
									'components' => array(
										'family'         => true,
										'size'           => false,
										'line-height'    => false,
										'letter-spacing' => true,
										'color'          => false
									),
									'label'      => esc_html__('Custom font', 'weldo'),
									'desc'       => esc_html__('Select custom font for headings', 'weldo'),
									'help'       => esc_html__('You should enable using custom heading fonts above at first', 'weldo'),
								),
							),
						),
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),

		),
	),
	'theme_options_section' => array(
		'title'   => esc_html__('Theme Options', 'weldo'),
		'options' => array(
			'layout_section'       => array(
				'title'              => esc_html__('Theme Layout', 'weldo'),
				'options'            => array(
					'layout' => array(
						'type'    => 'multi-picker',
						'value'   => 'wide',
						'attr'    => array('class' => 'theme-layout-class', 'data-theme-layout' => 'layout'),
						'label'   => esc_html__('Theme layout', 'weldo'),
						'desc'    => esc_html__('Wide or Boxed layout', 'weldo'),
						'picker'  => array(
							'boxed' => array(
								'type'         => 'switch',
								'value'        => '',
								'label'        => false,
								'desc'         => false,
								'left-choice'  => array(
									'value' => '',
									'label' => esc_html__('Wide', 'weldo'),
								),
								'right-choice' => array(
									'value' => 'boxed_options',
									'label' => esc_html__('Boxed', 'weldo'),
								),
							),
						),
						'choices' => array(
							'boxed_options' => array(
								'body_background_image' => array(
									'type'        => 'upload',
									'value'       => '',
									'label'       => esc_html__('Body background image', 'weldo'),
									'help'        => esc_html__('Choose body background image if needed.', 'weldo'),
									'images_only' => true,
								),
								'body_cover'            => array(
									'type'         => 'switch',
									'value'        => '',
									'label'        => esc_html__('Parallax background', 'weldo'),
									'desc'         => esc_html__('Enable full width background for body', 'weldo'),
									'left-choice'  => array(
										'value' => '',
										'label' => esc_html__('No', 'weldo'),
									),
									'right-choice' => array(
										'value' => 'yes',
										'label' => esc_html__('Yes', 'weldo'),
									),
								),
								'boxed_extra_margins'   => array(
									'type'         => 'switch',
									'value'        => '',
									'label'        => esc_html__('Additional margins', 'weldo'),
									'desc'         => esc_html__('Enable additional margins for boxed container', 'weldo'),
									'left-choice'  => array(
										'value' => '',
										'label' => esc_html__('No', 'weldo'),
									),
									'right-choice' => array(
										'value' => 'yes',
										'label' => esc_html__('Yes', 'weldo'),
									),
								),
							),
						),

					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_false',
				),
			),
			'version_section'      => array(
				'title'   => esc_html__('Theme Variant', 'weldo'),
				'options' => array(
					'version' => array(
						'type'               => 'radio',
						'value'              => 'light',
						'attr'               => array(
							'class'             => 'theme-layout-class',
							'data-theme-layout' => 'layout'
						),
						'label'              => esc_html__('Theme Version', 'weldo'),
						'desc'               => esc_html__('Light or dark version', 'weldo'),
						'help'               => esc_html__('Select one of predefined versions', 'weldo'),
						'choices'            => array(
							'ls' => esc_html__('Light', 'weldo'),
							'ds' => esc_html__('Dark', 'weldo'),
						),
						'inline'             => true,
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'skin'    => array(
						'label'              => esc_html__('Choose Theme Skin', 'weldo'),
						'help'               => esc_html__('Select one of predefined theme skins', 'weldo'),
						'type'               => 'select',
						'value'              => '',
						'choices'            => array(
							''      => esc_html__('Default', 'weldo'),
							'skin1' => esc_html__('Skin 1', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
				),
			),
			'color_scheme_section' => array(
				'title'              => esc_html__('Theme Color Scheme', 'weldo'),
				'options'            => array(
					'accent_color_1'      => array(
						'label'                      => esc_html__('Override default color scheme', 'weldo'),
						'desc'                       => esc_html__('Accent Color 1', 'weldo'),
						'help'                       => esc_html__('This colors are used for regenerate predefined "css/main.css" file. Remove custom color values for reset color scheme to defaults.', 'weldo'),
						'type'                       => 'color-picker',
						'value'                      => $current_colors['accent_color_1'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
					'accent_color_2'      => array(
						'label'                      => false,
						'desc'                       => esc_html__('Accent Color 2', 'weldo'),
						'type'                       => 'color-picker',
						'value'                      => $current_colors['accent_color_2'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
					'darkgrey_color' => array(
						'label' => false,
						'desc'  => esc_html__('Dark Color', 'weldo'),
						'type'  => 'color-picker',
						'value' => $current_colors['darkgrey_color'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
					'dark_color' => array(
						'label' => false,
						'desc'  => esc_html__('Dark Grey Color', 'weldo'),
						'type'  => 'color-picker',
						'value' => $current_colors['dark_color'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
					'darkblue_color' => array(
						'label' => false,
						'desc'  => esc_html__('Dark Blue Color', 'weldo'),
						'type'  => 'color-picker',
						'value' => $current_colors['darkblue_color'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
					'grey_color' => array(
						'label' => false,
						'desc'  => esc_html__('Grey Color', 'weldo'),
						'type'  => 'color-picker',
						'value' => $current_colors['grey_color'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
					'font_color' => array(
						'label' => false,
						'desc'  => esc_html__('Font Color', 'weldo'),
						'type'  => 'color-picker',
						'value' => $current_colors['font_color'],
						'wp-customizer-setting-args' => array(
							'transport' => 'postMessage',
						)
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'blog_section'         => array(
				'title'              => esc_html__('Theme Blog Options', 'weldo'),
				'options'            => array(
					'blog_layout'             => array(
						'type'               => 'select',
						'value'              => '1',
						'label'              => esc_html__('Blog layout', 'weldo'),
						'desc'               => esc_html__('Select one of predefined blog layouts', 'weldo'),
						'choices'            => array(
							'1'    => '1',
							'2'    => '2',
							'3'    => '3',
							'4'    => '4',
							'grid' => 'Grid',
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_hide_categories'    => array(
						'type'               => 'switch',
						'value'              => false,
						'label'              => esc_html__('Hide categories in blog feed', 'weldo'),
						'left-choice'        => array(
							'value' => false,
							'label' => esc_html__(' Show', 'weldo'),
						),
						'right-choice'       => array(
							'value' => true,
							'label' => esc_html__(' Hide', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_hide_tags'          => array(
						'type'               => 'switch',
						'value'              => false,
						'label'              => esc_html__('Hide tags in blog feed', 'weldo'),
						'left-choice'        => array(
							'value' => false,
							'label' => esc_html__(' Show', 'weldo'),
						),
						'right-choice'       => array(
							'value' => true,
							'label' => esc_html__(' Hide', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_hide_author'        => array(
						'type'               => 'switch',
						'value'              => false,
						'label'              => esc_html__('Hide author in blog feed', 'weldo'),
						'left-choice'        => array(
							'value' => false,
							'label' => esc_html__(' Show', 'weldo'),
						),
						'right-choice'       => array(
							'value' => true,
							'label' => esc_html__(' Hide', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_hide_date'          => array(
						'type'               => 'switch',
						'value'              => false,
						'label'              => esc_html__('Hide date in blog feed', 'weldo'),
						'left-choice'        => array(
							'value' => false,
							'label' => esc_html__(' Show', 'weldo'),
						),
						'right-choice'       => array(
							'value' => true,
							'label' => esc_html__(' Hide', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_hide_comments_link' => array(
						'type'               => 'switch',
						'value'              => false,
						'label'              => esc_html__('Hide comments link in blog feed', 'weldo'),
						'left-choice'        => array(
							'value' => false,
							'label' => esc_html__(' Show', 'weldo'),
						),
						'right-choice'       => array(
							'value' => true,
							'label' => esc_html__(' Hide', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_hide_like'          => array(
						'type'               => 'switch',
						'value'              => false,
						'label'              => esc_html__('Hide like count in blog feed', 'weldo'),
						'left-choice'        => array(
							'value' => false,
							'label' => esc_html__(' Show', 'weldo'),
						),
						'right-choice'       => array(
							'value' => true,
							'label' => esc_html__(' Hide', 'weldo'),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'blog_slider_switch'      => array(
						'type'               => 'multi-picker',
						'label'              => false,
						'desc'               => false,
						'picker'             => array(
							'blog_slider_enabled' => array(
								'type'         => 'switch',
								'value'        => '',
								'label'        => esc_html__('Blog slider', 'weldo'),
								'desc'         => esc_html__('Enable slider on blog page', 'weldo'),
								'left-choice'  => array(
									'value' => '',
									'label' => esc_html__('No', 'weldo'),
								),
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__('Yes', 'weldo'),
								),
							),
						),
						'choices'            => array(
							'yes' => array(
								'slider_id' => array(
									'type'    => 'select',
									'value'   => '',
									'label'   => esc_html__('Select Slider', 'weldo'),
									'choices' => $choices_blog_slider
								),
							),
						),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_true',
				),
			),
			'preloader_panel'      => array(
				'title'   => esc_html__('Theme Preloader', 'weldo'),
				'options' => array(
					'preloader'              => array(
						'type'               => 'multi-picker',
						'label'              => false,
						'desc'               => false,
						'value'              => array(
							'css' => 'css',
						),
						'picker'             => array(
							'preloader_type' => array(
								'label'   => esc_html__('Choose preloader type', 'weldo'),
								'type'    => 'select',
								'value'   => 'css',
								'choices' => array(
									'css'          => esc_html__('Default', 'weldo'),
									'image'        => esc_html__('Default Image', 'weldo'),
									'image_custom' => esc_html__('Custom Image', 'weldo'),
									'disabled'     => esc_html__('Disabled', 'weldo'),
								),
								'help'    => esc_html__('You can use default CSS or Image preloader, use your own image or disable preloader', 'weldo'),
							)
						),
						'choices'            => array(
							'css'          => array(
								'options' => array(
									'type'  => 'hidden',
									'value' => 'css',
								)
							),
							'image'        => array(
								'options' => array(
									'type'  => 'hidden',
									'value' => 'image',
								),
							),
							'image_custom' => array(
								'options' => array(
									'type'        => 'upload',
									'value'       => '',
									'label'       => esc_html__('Custom preloader image', 'weldo'),
									'help'        => esc_html__('GIF image recommended. Recommended maximum preloader width 150px, maximum preloader height 150px.', 'weldo'),
									'images_only' => true,
								),
							),
							'disabled'     => array(
								'options' => array(
									'type'  => 'hidden',
									'value' => false,
								),
							),
						),
						/**
						 * (optional) if is true, the borders between choice options will be shown
						 */
						'show_borders'       => false,
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					),
					'preloader_custom_class' => array(
						'type'               => 'text',
						'label'              => esc_html__('Additional CSS class', 'weldo'),
						'wp-customizer-args' => array(
							'active_callback' => '__return_true',
						),
					)
				),
			),
			'share_buttons'        => array(
				'title' => esc_html__('Theme Share Buttons', 'weldo'),

				'options'            => array(
					'share_facebook'    => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable Facebook Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
					'share_twitter'     => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable Twitter Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
					'share_google_plus' => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable Google+ Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
					'share_pinterest'   => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable Pinterest Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
					'share_linkedin'    => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable LinkedIn Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
					'share_tumblr'      => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable Tumblr Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
					'share_reddit'      => array(
						'type'         => 'switch',
						'value'        => '1',
						'label'        => esc_html__('Enable Reddit Share Button', 'weldo'),
						'left-choice'  => array(
							'value' => '1',
							'label' => esc_html__('Enabled', 'weldo'),
						),
						'right-choice' => array(
							'value' => '0',
							'label' => esc_html__('Disabled', 'weldo'),
						),
					),
				),
				'wp-customizer-args' => array(
					'active_callback' => '__return_false',
				),
			),
		),
	),
	'woocommerce'           => array(
		'title'   => esc_html__('WooCommerce', 'weldo'),
		'options' => array(
			'related_products' => array(
				'title'   => esc_html__('Related Products', 'weldo'),
				'options' => array(
					'woo_title'    => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('Related Products Title', 'weldo'),
					),
					'woo_subtitle' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__('Related Products Subtitle', 'weldo'),
					),
				),
			),
		),
	),
);
