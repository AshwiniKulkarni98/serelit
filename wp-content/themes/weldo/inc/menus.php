<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Register menus
 */

register_nav_menus( array(
	'primary' => esc_html__( 'Top primary menu', 'weldo' ),
	'topline' => esc_html__( 'Topline secondary menu', 'weldo' ),
	'copyright' => esc_html__( 'Copyright secondary menu', 'weldo' ),
) );