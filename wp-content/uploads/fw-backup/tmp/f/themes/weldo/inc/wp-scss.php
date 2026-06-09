<?php
/**
 * Requires the WP-SCSS plugin to be installed and activated.
 */

//current selected colors for customizer.php
if ( ! function_exists( 'weldo_get_theme_current_colors' ) ) :
	function weldo_get_theme_current_colors() {
		/* Colors */
		$current_colors = array(
			'accent_color_1' => weldo_get_option( 'accent_color_1' ),
			'accent_color_2' => weldo_get_option( 'accent_color_2' ),
			'accent_color_3' => weldo_get_option( 'accent_color_3' ),
			'accent_color_4' => weldo_get_option( 'accent_color_4' ),
			'grey_color'     => weldo_get_option( 'grey_color' ),
			'darkgrey_color' => weldo_get_option( 'darkgrey_color' ),
			'darkblue_color' => weldo_get_option( 'darkblue_color' ),
			'dark_color'     => weldo_get_option( 'dark_color' ),
			'font_color'     => weldo_get_option( 'font_color' )
		);
		return apply_filters( 'weldo_theme_current_colors', $current_colors );
	}
endif;

//check for wp_scss plugin activated for options in customizer.php
if ( ! function_exists( 'weldo_wp_scss_is_installed' ) ) :
	function weldo_wp_scss_is_installed() {
		return class_exists('Wp_Scss');
	}
endif;

//following code only if Wp_Scss plugin is active
if ( class_exists('Wp_Scss') ) {
	//load recompile script
	add_action('customize_register', 'weldo_action_customizer_enqueue_scss_compile_script');
	add_action('customize_preview_init', 'weldo_action_customizer_enqueue_scss_compile_script');

	//live preview color scripts - will be loaded only if Wp_Scss class exists below
	if ( ! function_exists( 'weldo_action_customizer_enqueue_scss_compile_script' ) ) :
		function weldo_action_customizer_enqueue_scss_compile_script() {

			wp_register_script(
				'weldo-customizer-scss',
				WELDO_THEME_URI . '/js/theme-customizer-scss.js',
				array( 'jquery','customize-preview' ),
				WELDO_THEME_VERSION,
				true
			);

			wp_localize_script('weldo-customizer-scss', 'weldo_customizer_text', array(
				'button_text' => esc_html__( 'Override first color scheme!', 'weldo' ),
				'button_reset_text' => esc_html__( 'Reset first color scheme', 'weldo' ),
				'error_text' => esc_html__( 'Error. Did you set up your WP SCSS plugin directories correctly?', 'weldo' ),
			));

			wp_enqueue_script(
				'weldo-customizer-scss'
			);
		}
	endif;


	/* weldo_scss_set_variables */
	if ( !function_exists( 'weldo_scss_set_variables' ) ) :
		function weldo_scss_set_variables() {
			/* Colors */
			//default value not needed because they are set in _varialbes_template.scss
			$accent_color_1 = weldo_get_option( 'accent_color_1' );
			$accent_color_2 = weldo_get_option( 'accent_color_2' );
			$accent_color_3 = weldo_get_option( 'accent_color_3' );
			$accent_color_4 = weldo_get_option( 'accent_color_4' );
			$dark_color     = weldo_get_option( 'dark_color' );
			$darkgrey_color = weldo_get_option( 'darkgrey_color' );
			$darkblue_color = weldo_get_option( 'darkblue_color' );
			$grey_color     = weldo_get_option( 'grey_color' );
			$font_color     = weldo_get_option( 'font_color' );

			if ( !empty($_POST['action'])) {
				if ($_POST['action'] == 'weldo_compile_scss' ) {
					$accent_color_1 = esc_attr( $_POST['accent_color_1'] );
					$accent_color_2 = esc_attr( $_POST['accent_color_2'] );
					$accent_color_3 = esc_attr( $_POST['accent_color_3'] );
					$accent_color_4 = esc_attr( $_POST['accent_color_4'] );
					$dark_color     = esc_attr( $_POST['dark_color'] );
					$darkgrey_color = esc_attr( $_POST['darkgrey_color'] );
					$darkblue_color = esc_attr( $_POST['darkblue_color'] );
					$grey_color     = esc_attr( $_POST['grey_color'] );
					$font_color     = esc_attr( $_POST['font_color'] );
				}
			}

			/* Variables */
			$variables = array(
				
				/* Theme color scheme */
				'colorMain'     => $accent_color_1,
				'colorMain2'    => $accent_color_2,
				'colorMain3'    => $accent_color_3,
				'colorMain4'    => $accent_color_4,
				'darkColor'     => $dark_color,
				'darkgreyColor' => $darkgrey_color,
				'darkBlueColor' => $darkblue_color,
				'greyColor'     => $grey_color,
				'fontColor'     => $font_color,

			);

			return $variables;
		}
	endif; //weldo_scss_set_variables
	add_filter( 'wp_scss_variables', 'weldo_scss_set_variables' );

	//ajax customizer compiling SCSS files
	add_action( 'wp_ajax_weldo_compile_scss', 'weldo_compile_scss' );

	//compile scss via ajax
	if ( !function_exists( 'weldo_compile_scss' ) ) :
		function weldo_compile_scss() {

			check_ajax_referer( 'preview-customize_' . get_stylesheet(), 'customize_preview_nonce', true );

			//compiling
			wp_scss_compile();

			//processing errors
			global $wpscss_compiler;
			$error_string = '';
			foreach ( $wpscss_compiler->compile_errors as $error ) {
				$error_string .= $error['file'] . ' - ' . $error['message'];
			}
			if ( ! empty( $error_string ) ) {
				wp_send_json_error( $error_string, 500);
			}
			wp_die();
		}
	endif;


}