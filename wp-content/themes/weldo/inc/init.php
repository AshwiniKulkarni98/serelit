<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Theme Includes
 *
 * https://github.com/ThemeFuse/Theme-Includes
 */
class Weldo_Theme_Includes {
	private static $rel_path = null;

	private static $include_isolated_callable;

	private static $initialized = false;

	public static $template_directory = '';

	public static $template_directory_uri = '';

	public static function init() {
		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}

		//theme path
		self::$template_directory = WELDO_THEME_PATH;

		self::$template_directory_uri = WELDO_THEME_URI;

		/**
		 * Include a file isolated, to not have access to current context variables
		 */
		self::$include_isolated_callable = function( $path ) {
			return include $path;
		};

		/**
		 * Both frontend and backend
		 */
		{
            // color manipulation
            self::include_child_first( '/sub-includes/class-theme-colors.php' );
			//theme options
			self::include_child_first( '/options.php' );
			//helper functions
			self::include_child_first( '/helpers.php' );
			//theme hooks
			self::include_child_first( '/hooks.php' );
            //dynamic colors static files
            self::include_child_first( '/colors.php' );

			//no following constant. Temporary removing widget adds
			if( defined('WELDO_ENABLE_WIDGET_ADDS' ) ) {
				//additional fields for widgets
				self::include_child_first( '/sub-includes/mods/mod-widget-adds.php' );
			}

			//for quick plugins editing
			if ( ! empty( WELDO_DEV_MODE ) && file_exists( WELDO_THEME_PATH . '/ONLY_FOR_BITBUCKET/mwt-addons/mwt-addons.php' ) ) {
    include_once( WELDO_THEME_PATH . '/ONLY_FOR_BITBUCKET/mwt-addons/mwt-addons.php' );
}
			
			//helpers that are used in template views
				self::include_child_first( '/sub-includes/helpers-template.php' );
				//advanced template tags and kses array
				self::include_child_first( '/sub-includes/custom-kses.php' );
				self::include_child_first( '/sub-includes/template-tags.php' );
			// mods
				//wrapper for mwt post likes
				self::include_child_first( '/sub-includes/mods/mod-post-likes.php' );
				//wrapper for mwt post views
				self::include_child_first( '/sub-includes/mods/mod-post-views.php' );
				//share buttons
				self::include_child_first( '/sub-includes/mods/mod-post-share-buttons.php' );
				//widget background
				self::include_child_first( '/sub-includes/mods/mod-widget-adds.php' );
				// unyson events
				self::include_child_first( '/sub-includes/fw-events.php' );


			//theme icons - font awesome and social (font awesome based)
			self::include_child_first( '/sub-includes/icons/icons-theme.php' );
			self::include_child_first( '/sub-includes/icons/icons-social.php' );
			//required plugins
			self::include_child_first( '/plugins.php' );
			//WooCommerce files only if WooComemrce plugin is active
			if ( class_exists( 'WooCommerce' ) ) :
				self::include_child_first( '/sub-includes/woocommerce.php' );
			endif;

			add_action( 'init', array( __CLASS__, '_action_init' ) );
		}

		/**
		 * Only frontend
		 */
		if ( ! is_admin() ) {

			//comments theme template
			self::include_child_first( '/sub-includes/class-theme-comments-walker.php' );

			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ),
				20
			);
		}
	}

	private static function get_rel_path( $append = '' ) {
		if ( self::$rel_path === null ) {
			self::$rel_path = '/inc';
		}

		return self::$rel_path . $append;
	}

	/**
	 * @param string $dirname 'foo-bar'
	 *
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname( $dirname ) {
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}

	public static function get_parent_path( $rel_path ) {
		return WELDO_THEME_PATH . self::get_rel_path( $rel_path );
	}

	public static function get_child_path( $rel_path ) {
		if ( ! is_child_theme() ) {
			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path( $rel_path );
	}

	public static function include_isolated( $path ) {
		call_user_func( self::$include_isolated_callable, $path );
	}

	public static function include_child_first( $rel_path ) {
		if ( is_child_theme() ) {
			$path = self::get_child_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}

		{
			$path = self::get_parent_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}
	}

	/**
	 * @internal
	 */
	public static function _action_enqueue_scripts() {
		self::include_child_first( '/static.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_init() {
		self::include_child_first( '/menus.php' );
		self::include_child_first( '/posts.php' );
	}
}

Weldo_Theme_Includes::init();