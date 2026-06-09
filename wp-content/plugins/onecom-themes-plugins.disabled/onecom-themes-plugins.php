<?php
/**
 * Plugin Name: one.com
 * Plugin URI:  https://help.one.com/hc/en-us/articles/115005593945
 * Plugin Info:  https://one.com
 * Version:        5.1.5
 * Text Domain:    onecom-wp
 * Domain Path:    /languages
 * Description:    Integrate your WordPress site with the one.com control panel to get improved performance, security and feature updates.
 * Network: true
 * Author:        one.com
 * Author URI:    https://one.com/
 * License:        GPL v2 or later
 *
 *
 *    Copyright 2017-2025 one.com
 *
 *    This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 */
defined( 'ABSPATH' ) or die( 'Cheating Huh!' ); // Security.

if ( ! defined( 'ONECOM_WP_VERSION' ) ) {
	define( 'ONECOM_WP_VERSION', '5.1.5' );
}


if ( ! defined( 'ONECOM_PLUGIN_API_VERSION' ) ) {
	define( 'ONECOM_PLUGIN_API_VERSION', '1' );
}


if ( ! defined( 'OCIPID' ) ) {
	define( 'OCIPID', 'one' );
}

if ( ! defined( 'ONECOM_WP_PATH' ) ) {
	define( 'ONECOM_WP_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'ONECOM_WP_URL' ) ) {
	define( 'ONECOM_WP_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'OCL_FILE_PATH' ) ) {
	define( 'OCL_FILE_PATH', '/modules/authenticator/authenticator.php' );
}

if( !defined( 'MARKETPLACE_PAGE_SLUG' ) ) {
	define( 'MARKETPLACE_PAGE_SLUG' , 'onecom-marketplace' );
}

if ( ! defined( 'MIDDLEWARE_URL' ) ) {
	$api_version = 'v1.0';
	if ( isset( $_SERVER['ONECOM_DOMAIN_NAME'] ) && substr( $_SERVER['ONECOM_DOMAIN_NAME'], -17 ) === '-testwp.1test.one' ) {
		$ONECOM_WP_ADDONS_API = 'https://wpapi-test.one.com/';
	}
	elseif (
		isset( $_SERVER['ONECOM_DOMAIN_NAME'] ) &&
		substr( $_SERVER['ONECOM_DOMAIN_NAME'], -10 ) === '.1test.one'
	) {
		$ONECOM_WP_ADDONS_API = 'https://wpapi-next.one.com/';
	} elseif (
		isset( $_SERVER['ONECOM_DOMAIN_NAME'] ) &&
		substr( $_SERVER['ONECOM_DOMAIN_NAME'], -9 ) === '.1stg.one'
	) {
		$ONECOM_WP_ADDONS_API = 'https://wpapi-test.one.com/';
	} elseif ( isset( $_SERVER['ONECOM_WP_ADDONS_API'] ) && $_SERVER['ONECOM_WP_ADDONS_API'] != '' ) {
		$ONECOM_WP_ADDONS_API = $_SERVER['ONECOM_WP_ADDONS_API'];
	} elseif ( defined( 'ONECOM_WP_ADDONS_API' ) && ONECOM_WP_ADDONS_API != '' && ONECOM_WP_ADDONS_API != false ) {
		$ONECOM_WP_ADDONS_API = ONECOM_WP_ADDONS_API;
	} else {
		$ONECOM_WP_ADDONS_API = 'http://wpapi.one.com/';
	}
	$ONECOM_WP_ADDONS_API = rtrim( $ONECOM_WP_ADDONS_API, '/' );
	define( 'MIDDLEWARE_URL', $ONECOM_WP_ADDONS_API . '/api/' . $api_version );
}
if ( ! defined( 'WP_API_URL' ) ) {
	$api_version = '1.0';
	define( 'WP_API_URL', 'https://api.wordpress.org/plugins/info/' . $api_version . '/' );
}
if ( ! defined( 'ONECOM_WP_CORE_VERSION' ) ) {
	global $wp_version;
	define( 'ONECOM_WP_CORE_VERSION', $wp_version );
}
if ( ! defined( 'ONECOM_PHP_VERSION' ) ) {
	define( 'ONECOM_PHP_VERSION', phpversion() );
}
if ( ! defined( 'OC_PLUGIN_DOMAIN' ) ) {
	define( 'OC_PLUGIN_DOMAIN', 'onecom-wp' );
}


if ( ! defined( 'OC_HTTP_HOST' ) ) {
	$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
	define( 'OC_HTTP_HOST', $host );
}

if ( ! defined( 'OC_CP_LOGIN_URL' ) ) {
	$domain = $_SERVER['ONECOM_DOMAIN_NAME'] ?? '';
	define( 'OC_CP_LOGIN_URL', sprintf( 'https://one.com/admin/select-admin-domain.do?domain=%s&targetUrl=/admin/managedwp/%s/managed-wp-dashboard.do', $domain, OC_HTTP_HOST ) );
}


/*  Plugins REST API  */
add_action(
	'rest_api_init',
	function () {
		$oc_api_class = ONECOM_WP_PATH . '/modules/api/class-onecom-plugins-api.php';
		if ( file_exists( $oc_api_class ) ) {
			require_once $oc_api_class;
			$oc_api = new OnecomPluginsApi();
			$oc_api->register_routes();
		}
		if ( ! class_exists( 'OCLAUTH' ) && file_exists( ONECOM_WP_PATH . OCL_FILE_PATH ) ) {
			require_once ONECOM_WP_PATH . OCL_FILE_PATH;
		}
	}
);


/* Validator */
if ( ! ( class_exists( 'OTPHP\TOTP' ) && class_exists( 'ParagonIE\ConstantTime\Base32' ) ) ) {
	require_once ONECOM_WP_PATH . '/inc/lib/validator.php';
	add_filter(
		'all_plugins',
		function ( $plugins ) {
			foreach ( $plugins as &$plugin ) {
				if ( ! in_array( strtolower( $plugin['Author'] ), array( 'one.com', 'onecom' ) ) ) {
					continue;
				}
				$plugin['update-supported'] = 1;
			}

			return $plugins;
		},
		99999
	);

	add_filter(
		'wp_prepare_themes_for_js',
		function ( $themes ) {
			foreach ( $themes as &$theme ) {
				if ( ! in_array( strtolower( $theme['author'] ), array( 'one.com', 'onecom' ) ) ) {
					continue;
				}
				$theme['autoupdate']['supported'] = 1;
			}

			return $themes;
		},
		99999
	);

}

// WP Rocket CP purchase URL
if ( ! defined( 'OC_WPR_BUY_URL' ) ) {
	$domain        = $_SERVER['ONECOM_DOMAIN_NAME'] ?? '';
	define( 'OC_WPR_BUY_URL', sprintf( "https://one.com/admin/wprocket-prepare-buy.do?directToDomainAfterPurchase=%s&amp;domain=%s", OC_HTTP_HOST, $domain ) );
}

/**
 * Include stats script file
 **/

require_once ONECOM_WP_PATH . '/inc/lib/OCPushStats.php';
/**
 * Include API hook file
 **/
require_once ONECOM_WP_PATH . '/inc/api-hooks.php';


require_once ONECOM_WP_PATH . '/inc' . DIRECTORY_SEPARATOR . 'class-onecom-shortcuts.php';

add_action( 'admin_init', 'onecom_shortcut_call' );
function onecom_shortcut_call() {
	if ( ! is_multisite() ) {
		$shortcuts = new Onecom_Shortcuts();
	}
}

add_action( 'admin_init', 'onecom_walkthrough' );
function onecom_walkthrough() {
	if ( ! is_multisite() ) {
		include_once ONECOM_WP_PATH . 'inc' . DIRECTORY_SEPARATOR . 'class-onecom-walkthrough.php';

		$walkthrough = new Onecom_Walkthrough();

	}
}

/** s
 * Plugin activation hook
 **/
if ( ! function_exists( 'onecom_plugin_activation' ) ) {
	function onecom_plugin_activation() {

		// Call to the features endpoint for restoring transient value.
		oc_set_premi_flag( true );

		// Schedule Health Monitor scan after 10 minutes.
		onecom_schedule_single_events();
	}
}
register_activation_hook( __FILE__, 'onecom_plugin_activation' );

/**
 * Plugin upgradation hook
 */
if ( ! function_exists( 'onecom_plugin_upgradation' ) ) {
	function onecom_plugin_upgradation( $upgrader_object, $options ) {
		if ( 'onecom-themes-plugins.php' !== plugin_basename( __FILE__ ) ) {
			return;
		}
		update_site_option( 'oc_tp_version', ONECOM_WP_VERSION, 'no' );

		//remove old checks from previous scan
		oc_unset_removed_checks();

		// Schedule Health Monitor scan after 10 minutes.
		onecom_schedule_single_events();
	}
}
add_action( 'upgrader_process_complete', 'onecom_plugin_upgradation', 10, 2 );
add_action( 'admin_init', 'onecom_check_for_get_request', - 1 );
if ( ! function_exists( 'onecom_check_for_get_request' ) ) {
	function onecom_check_for_get_request() {
		/**
		 * Deactivate plugin
		 **/
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'deactivate_plugin' ) {
			if ( isset( $_POST['plugin'] ) && trim( $_POST['plugin'] ) != '' ) {
				$network_wide = false;
				$silent       = false;
				if ( is_multisite() && is_network_admin() ) {
					$network_wide = true;
				}
				$is = deactivate_plugins( $_POST['plugin'], $silent, $network_wide );
				wp_safe_redirect( wp_get_referer() );
			}
		}

		/**
		 * Delete site transient
		 **/
		if ( isset( $_GET['request'] ) && $_GET['request'] != '' ) {
			if ( $_GET['request'] == 'recommended_plugins' ||
				$_GET['request'] == 'discouraged_plugins' ||
				$_GET['request'] == 'plugins' ) {
				delete_site_transient( 'onecom_' . $_GET['request'] );
				$url = ( is_network_admin() && is_multisite() ) ? network_admin_url( 'admin.php' ) : admin_url( 'admin.php' );
				$url = add_query_arg(
					array(
						'page' => 'onecom-wp-themes',
					),
					$url
				);
				wp_safe_redirect( $url );
				die();
			}
		}

		return;
	}
}

add_action( 'init', 'onecom_wp_load_textdomain', - 1 );
if ( ! function_exists( 'onecom_wp_load_textdomain' ) ) {
	function onecom_wp_load_textdomain() {
// moved here to prevent warnings
		if ( ! defined( 'OC_INLINE_LOGO' ) ) {
			define( 'OC_INLINE_LOGO', sprintf( '<img src="%s" alt="%s" />', ONECOM_WP_URL . 'assets/images/one.com.black.svg', __( 'One.com', 'onecom-wp' ) ) );
		}

		$current_locale           = get_locale();
		$locales_with_translation = array(
			'da_DK',
			'de_DE',
			'es_ES',
			'fr_FR',
			'it_IT',
			'pt_PT',
			'nl_NL',
			'sv_SE',
		);

		// Locales fallback and load english translations [as] if selected unsupported language in WP-Admin.
		if ( $current_locale === 'fi' ) {
			load_textdomain( OC_PLUGIN_DOMAIN, __DIR__ . '/languages/onecom-wp-fi_FI.mo' );
		} elseif ( $current_locale === 'nb_NO' ) {
			load_textdomain( OC_PLUGIN_DOMAIN, __DIR__ . '/languages/onecom-wp-no_NO.mo' );
		} elseif ( in_array( get_locale(), $locales_with_translation ) ) {
			load_plugin_textdomain( OC_PLUGIN_DOMAIN, false, basename( __DIR__ ) . '/languages' );
		} else {
			load_textdomain( OC_PLUGIN_DOMAIN, __DIR__ . '/languages/onecom-wp-en_GB.mo' );
		}
	}
}

/**
 * Limit load of resources on only specific admin pages to optimize loading time
 */
/* Add hook to following array where you want to enquque your resources */
global $load_onecom_wp_resources_slugs;
$load_onecom_wp_resources_slugs = array(
	'one-com_page_onecom-wp-themes',
	'toplevel_page_onecom-wp',
	'one-com_page_onecom-wp-themes', //Remove plugin entry
	'_page_onecom-wp-recommended-plugins',
	'admin_page_onecom-wp-recommended-plugins',
	'admin_page_onecom-wp-discouraged-plugins',
	'one-com_page_onecom-wp-staging',
	'one-com_page_onecom-wp-staging-blocked',
	'one-com_page_onecom-wp-cookie-banner',
	'one-com_page_onecom-wp-error-page',
	'one-com_page_onecom-home',
	'index.php',
	'one-com_page_onecom-wp-rocket'
);

$vcache_slug = 'onecom-vcache/vcaching.php';
//Remove one-com_page_onecom-wp-rocket key when performance cache plugin is active, so that only single one.min.css add on the page
if(is_plugin_active($vcache_slug)){
	$load_onecom_wp_resources_slugs = array_values(array_diff($load_onecom_wp_resources_slugs, array('one-com_page_onecom-wp-rocket')));
}

$load_onecom_wp_resources_slugs = apply_filters( 'load_onecom_wp_resources_slugs', $load_onecom_wp_resources_slugs );

add_action( 'limit_enqueue_resources', 'limit_enqueue_resources_callback', 10, 3 );
if ( ! function_exists( 'limit_enqueue_resources_callback' ) ) {
	function limit_enqueue_resources_callback( $handle, $hook, $type ) {
		global $load_onecom_wp_resources_slugs;
		$alreadyEnqueued = false;
		if ( in_array( $hook, $load_onecom_wp_resources_slugs ) ) { // Checking hook with provided array to be allowed.
			if ( $type == 'style' ) {
				$alreadyEnqueued = true;
				wp_enqueue_style( $handle ); // If allowed, enqueue the style.
			} elseif ( $type == 'script' ) {
				wp_enqueue_script( $handle ); // If allowed, enqueue the script.
			}
		}

		//List of pages where duplicate one.min.css should not be enqueued, and must be enqueued only once from specific plugins
		$pageShouldNotHave = array(
			'toplevel_page_onecom-vcache-plugin',
			'one-com_page_onecom-cdn',
			'one-com_page_onecom-marketplace',
			'one-com_page_onecom-marketplace-products',
			'toplevel_page_onecom-wp-under-construction',
			'one-com_page_onecom-wp-rocket'
		);

		//Enqueue one.min.css on other pages and not on $pageShouldNotHave from one.com plugin
		if(!$alreadyEnqueued && $handle === 'onecom-gravity-styles' && !in_array($hook, $pageShouldNotHave)){
			wp_enqueue_style( $handle );
		}
	}
}

add_action( 'wp_head', 'add_onecom_branding_css' );
add_action( 'admin_head', 'add_onecom_branding_css' );
if ( ! function_exists( 'add_onecom_branding_css' ) ) {
	function add_onecom_branding_css() {
		echo "<style>[class*=\" icon-oc-\"],[class^=icon-oc-]{speak:none;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.icon-oc-one-com-white-32px-fill:before{content:\"\e901\"}.icon-oc-one-com:before{content:\"\e900\"}#one-com-icon,.toplevel_page_onecom-wp .wp-menu-image{speak:none;display:flex;align-items:center;justify-content:center;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.onecom-wp-admin-bar-item>a,.toplevel_page_onecom-wp>.wp-menu-name{font-size:16px;font-weight:400;line-height:1}.toplevel_page_onecom-wp>.wp-menu-name img{width:69px;height:9px;}.wp-submenu-wrap.wp-submenu>.wp-submenu-head>img{width:88px;height:auto}.onecom-wp-admin-bar-item>a img{height:7px!important}.onecom-wp-admin-bar-item>a img,.toplevel_page_onecom-wp>.wp-menu-name img{opacity:.8}.onecom-wp-admin-bar-item.hover>a img,.toplevel_page_onecom-wp.wp-has-current-submenu>.wp-menu-name img,li.opensub>a.toplevel_page_onecom-wp>.wp-menu-name img{opacity:1}#one-com-icon:before,.onecom-wp-admin-bar-item>a:before,.toplevel_page_onecom-wp>.wp-menu-image:before{content:'';position:static!important;background-color:rgba(240,245,250,.4);border-radius:102px;width:18px;height:18px;padding:0!important}.onecom-wp-admin-bar-item>a:before{width:14px;height:14px}.onecom-wp-admin-bar-item.hover>a:before,.toplevel_page_onecom-wp.opensub>a>.wp-menu-image:before,.toplevel_page_onecom-wp.wp-has-current-submenu>.wp-menu-image:before{background-color:#76b82a}.onecom-wp-admin-bar-item>a{display:inline-flex!important;align-items:center;justify-content:center}#one-com-logo-wrapper{font-size:4em}#one-com-icon{vertical-align:middle}.imagify-welcome{display:none !important;}</style>";
	}
}

add_action( 'admin_enqueue_scripts', 'register_one_core_resources' );
if ( ! function_exists( 'register_one_core_resources' ) ) {
	function register_one_core_resources( $hook ) {

		$resource_extension = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true' ) ? '' : '.min'; // Adding .min extension if SCRIPT_DEBUG is enabled.
		$resource_min_dir   = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true' ) ? '' : 'min-'; // Adding min- as a minified directory of resources if SCRIPT_DEBUG is enabled.

		wp_register_style(
			OC_PLUGIN_DOMAIN,
			ONECOM_WP_URL . 'assets/' . $resource_min_dir . 'css/style' . $resource_extension . '.css',
			null,
			ONECOM_WP_VERSION,
			'all'
		);

		wp_register_script(
			OC_PLUGIN_DOMAIN,
			ONECOM_WP_URL . 'assets/' . $resource_min_dir . 'js/script' . $resource_extension . '.js',
			array( 'jquery', 'thickbox', 'jquery-ui-dialog' ),
			ONECOM_WP_VERSION,
			true
		);
		wp_localize_script(
			OC_PLUGIN_DOMAIN,
			'onecom_vars',
			array(
				'network' => ( is_network_admin() && is_multisite() ) ? true : false,
				'nonce'    => base64_encode('onboarding-revamp'),
				'customizeURL' => admin_url('customize.php'),
				'activationMsg' => __('Theme %s% successfully activated.',OC_PLUGIN_DOMAIN),
				'installMsg' => __('Theme %s% successfully installed.',OC_PLUGIN_DOMAIN),
				'activateProgress'=> __('Activating %s% theme',OC_PLUGIN_DOMAIN),
				'installProgress' => __('Installing %s% theme',OC_PLUGIN_DOMAIN),
				'themeActivationErr'=> __('Couldn’t activate theme %s%.',OC_PLUGIN_DOMAIN),
				'democontentErr'=> __('Couldn’t import demo content.',OC_PLUGIN_DOMAIN),
				'installTheme'=> __('Install theme',OC_PLUGIN_DOMAIN),
			)
		);

		wp_register_style(
			'onecom-promo',
			ONECOM_WP_URL . 'assets/' . $resource_min_dir . 'css/promo' . $resource_extension . '.css',
			null,
			ONECOM_WP_VERSION,
			'all'
		);

		wp_register_script(
			'onecom-promo',
			ONECOM_WP_URL . 'assets/' . $resource_min_dir . 'js/promo' . $resource_extension . '.js',
			array( 'jquery' ),
			ONECOM_WP_VERSION
		);

		/**
		 * Hooking resource into limit utilization
		 **/
		do_action( 'limit_enqueue_resources', 'onecom-wp', $hook, 'style' );
		do_action( 'limit_enqueue_resources', 'onecom-wp', $hook, 'script' );

		/* Google fonts */
		wp_register_style(
			'onecom-wp-fonts',
			ONECOM_WP_URL . 'assets/css/onecom-fonts.css',
			null,
			null,
			'all'
		);
		do_action( 'limit_enqueue_resources', 'onecom-wp-fonts', $hook, 'style' );

		/* ---Gravity CSS--- */
		wp_register_style(
			'onecom-gravity-styles',
			ONECOM_WP_URL . 'assets/min-css/one.min.css',
			null,
			ONECOM_WP_VERSION,
			'all'
		);

		do_action( 'limit_enqueue_resources', 'onecom-gravity-styles', $hook, 'style' );

		$allow = array( 'one-com_page_onecom-wp-health-monitor', 'toplevel_page_onecom-wp-spam-protection');
		if ( function_exists( 'get_current_screen' ) && in_array($hook, $allow)) {
			wp_enqueue_style('onecom-gravity-styles');
		}

	}
}



add_action( 'admin_menu', 'one_core_admin', - 1 );
add_action( 'network_admin_menu', 'one_core_admin', - 1 );
if ( ! function_exists( 'one_core_admin' ) ) {
	function one_core_admin() {
		if ( ! is_network_admin() && is_multisite() ) {
			return false;
		}
		$position = onecom_get_free_menu_position( '2.1' );

		// Save for other one.com plugins and themes.
		global $onecom_generic_menu_position;
		$onecom_generic_menu_position = $position;

		add_menu_page(
			__( 'One.com', 'onecom-wp' ),
			'<span class="onecom-top-menu-item">one.com</span>',
			'manage_options',
			OC_PLUGIN_DOMAIN,
			'one_core_admin_callback',
			'dashicons-admin-generic',
			$position
		);

		add_submenu_page(
			OC_PLUGIN_DOMAIN,
			__( 'Themes', 'onecom-wp' ),
			'<span id="onecom_themes">' . __( 'Themes', 'onecom-wp' ) . '</span>',
			'manage_options',
			'onecom-wp-themes',
			'one_core_theme_listing_callback'
		);

		remove_submenu_page( OC_PLUGIN_DOMAIN, 'onecom-wp' ); // Remove admin duplicate menu item.
		remove_submenu_page( OC_PLUGIN_DOMAIN, 'onecom-wp-themes' );
	}
}

add_action( 'admin_bar_menu', 'add_one_bar_items', 100, 100 );
if ( ! function_exists( 'add_one_bar_items' ) ) {
	function add_one_bar_items( $admin_bar ) {
		if ( ! is_network_admin() && is_multisite() ) {
			return false;
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$args = array(
			'id'    => OC_PLUGIN_DOMAIN,
			//'parent' => 'top-secondary',
			'title' => OC_INLINE_LOGO,
			'href'  => ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-wp' ) : admin_url( 'admin.php?page=onecom-wp' ),
			'meta'  => array(
				'title' => __( 'One.com', 'onecom-wp' ),
				'class' => 'onecom-wp-admin-bar-item',
			),
		);
		$admin_bar->add_menu( $args );

		$args = array(
			'id'     => 'onecom-wp-themes',
			'parent' => OC_PLUGIN_DOMAIN,
			'title'  => __( 'Themes', 'onecom-wp' ),
			'href'   => ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-wp-themes' ) : admin_url( 'admin.php?page=onecom-wp-themes' ),
			'meta'   => array(
				'title' => __( 'Themes', 'onecom-wp' ),
			),
		);
		$admin_bar->add_menu( $args );

		//Toolbar one.com Plugins menu link
		$args = array(
			'id'     => 'onecom-marketplace',
			'parent' => OC_PLUGIN_DOMAIN,
			'title'  => __( 'Plugins', 'onecom-wp' ),
			'href'   => ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page='.MARKETPLACE_PAGE_SLUG ) : admin_url( 'admin.php?page='.MARKETPLACE_PAGE_SLUG ),
			'meta'   => array(
				'title' => __( 'Plugins', 'onecom-wp' ),
			),
		);
		$admin_bar->add_menu( $args );

		$args = array(
			'id'     => 'onecom-wp-staging',
			'parent' => OC_PLUGIN_DOMAIN,
			'title'  => __( 'Staging', 'onecom-wp' ),
			'href'   => ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-wp-staging' ) : admin_url( 'admin.php?page=onecom-wp-staging' ),
			'meta'   => array(
				'title' => __( 'Plugins', 'onecom-wp' ),
			),
		);
		$admin_bar->add_menu( $args );

		/*
		* Account link to Control Panel
		*/
		$args = array(
			'id'     => 'one-cp',
			'parent' => OC_PLUGIN_DOMAIN,
			'title'  => __( 'One.com Control Panel', 'onecom-wp' ),
			'href'   => OC_CP_LOGIN_URL,
			'meta'   => array(
				'title'  => __( 'Go to Control Panel at One.com', 'onecom-wp' ),
				'target' => '_blank',
			),
		);
		$admin_bar->add_menu( $args );

		/*
		* WordPress support
		*/
		$locale = get_locale();

		$args = array(
			'id'     => 'one-wp-support',
			'parent' => OC_PLUGIN_DOMAIN,
			'title'  => __( 'One.com Guides & FAQ', 'onecom-wp' ),
			'href'   => onecom_generic_locale_link( $request = 'main_guide', $locale ),
			'meta'   => array(
				'title'  => __( 'Go to Guides & FAQ at One.com', 'onecom-wp' ),
				'target' => '_blank',
			),
		);
		$admin_bar->add_menu( $args );
	}
}

if ( ! function_exists( 'one_core_admin_callback' ) ) {
	function one_core_admin_callback() {
		$network = ( is_network_admin() && is_multisite() ) ? 'network/' : '';
		include_once 'templates/' . $network . 'theme-listing.php';
	}
}

if ( ! function_exists( 'one_core_theme_listing_callback' ) ) {
	function one_core_theme_listing_callback() {
		$network = ( is_network_admin() && is_multisite() ) ? 'network/' : '';
		include_once 'templates/' . $network . 'theme-listing.php';
	}
}

//Removed plugin listing


/**
 * Function to get free position for menu
 **/
if ( ! function_exists( 'onecom_get_free_menu_position' ) ) {
	function onecom_get_free_menu_position( $start, $increment = 0.3 ) {
		foreach ( $GLOBALS['menu'] as $key => $menu ) {
			$menus_positions[] = $key;
		}

		if ( ! in_array( $start, $menus_positions ) ) {
			return $start;
		}

		/* the position is already reserved find the closet one */
		while ( in_array( $start, $menus_positions ) ) {
			$start += $increment;
		}

		return (string) $start;
	}
}


/**
 * one.com updater
 **/
if ( ! class_exists( 'ONECOMUPDATER' ) ) {
	require_once ONECOM_WP_PATH . '/inc/update.php';
}

// Clean onboarding files if exists
add_action( 'admin_init', 'onecom_admin_init_callback' );
if ( ! function_exists( 'onecom_admin_init_callback' ) ) {
	function onecom_admin_init_callback() {
		require_once ONECOM_WP_PATH . '/inc/functions.php';
		onecom_cleanup_onboarding_files();
	}
}

/**
 * one.com staging
 **/
if ( ! class_exists( 'OneStaging\\OneStaging' ) && is_admin() ) {
	include_once 'staging/one_staging.php';
	\OneStaging\OneStaging::getInstance()->run();
}


/**
 * oci entry point
 **/
// Get POST or PUT request body to check if it is a POST call or GET call.
$entityBody = file_get_contents( 'php://input' );
// If POST content length is 0, then it is most probably a GET call.
if ( ! strlen( trim( $entityBody ) ) ) {
	// Handle authentication request.
	add_action(
		'init',
		function () {
			if ( ! class_exists( 'OCLAUTH' ) &&
				isset( $_GET['onecom-auth'] ) &&
				! empty( $_GET['onecom-auth'] ) &&
				file_exists( ONECOM_WP_PATH . OCL_FILE_PATH ) ) {
				require_once ONECOM_WP_PATH . OCL_FILE_PATH;

				$oclObj = OCLAUTH::getInstance();
				$oclObj = null; // Destruct object.
			}
		}
	);
}

/**
 * oci show message on login page
 * THIS FUNCTION IS CAUSING ISSUES ON LOGIN PAGE
 **/
/*add_filter( 'login_message', function ( $message ) {

	if ( ! is_user_logged_in() && ! class_exists( 'OCLAUTH' ) &&
		isset( $_GET['redirect_to'] ) &&
		file_exists( ONECOM_WP_PATH . OCL_FILE_PATH ) ) {
		require_once ONECOM_WP_PATH . OCL_FILE_PATH;

		$oclObj = OCLAUTH::getInstance();

		$redirectto = $_GET['redirect_to'];
		$query      = parse_url( $redirectto, PHP_URL_QUERY );
		$queries    = array();

		parse_str( $query, $queries );

		if ( isset( $queries[ $oclObj::TOKENKEY ] ) && ! empty( $queries[ $oclObj::TOKENKEY ] ) ) {
			$jwtPassVal = $queries[ $oclObj::TOKENKEY ];
			$oclObj->checkToken( $jwtPassVal );

			if ( ! $oclObj->tokenStatus ) {
				$message = $oclObj->tokenMessage;
				$oclObj  = null;//destruct object

				return '<div id="login_error">  ' . __( $message, 'ocl' ) . '<br>
				</div>';
			}
		}

	}

	return $message;
} );*/

add_action( 'init', function() {

	if ( file_exists( ONECOM_WP_PATH . '/modules/health-monitor/health-monitor.php' ) ) {
		require_once ONECOM_WP_PATH . '/modules/health-monitor/health-monitor.php';
	}
	if ( file_exists( ONECOM_WP_PATH . '/modules/vulnerability-monitor/vulnerability-monitor.php' ) ) {
		require_once ONECOM_WP_PATH . '/modules/vulnerability-monitor/vulnerability-monitor.php';
	}
});


if ( file_exists( ONECOM_WP_PATH . '/modules/advanced-login-protection/advanced-login-protection.php' ) ) {
	require_once ONECOM_WP_PATH . '/modules/advanced-login-protection/advanced-login-protection.php';
}

if ( file_exists( ONECOM_WP_PATH . '/modules/cookie-banner/cookie-banner.php' ) ) {
	require_once ONECOM_WP_PATH . '/modules/cookie-banner/cookie-banner.php';
}

if ( file_exists( ONECOM_WP_PATH . '/modules/error-page/error-page.php' ) ) {
	require_once ONECOM_WP_PATH . '/modules/error-page/error-page.php';
}

if ( file_exists( ONECOM_WP_PATH . '/modules/wp-rocket/wp-rocket.php' ) ) {
	require_once ONECOM_WP_PATH . '/modules/wp-rocket/wp-rocket.php';
}

//marketplace module loading
if ( file_exists( ONECOM_WP_PATH . '/modules/marketplace/marketplace.php' ) ) {
	require_once ONECOM_WP_PATH . '/modules/marketplace/marketplace.php';
}

/**
 * Include nested menu
 **/
if ( ! class_exists( 'Onecom_Nested_Menu' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/inc/lib/onecom-nested-menu.php';
	$onecom_menu = new Onecom_Nested_Menu();
	$onecom_menu->init();
}

/* Add "View Details" link for all One.com plugins, if not already exist */

add_filter( 'plugin_row_meta', 'onecom_generic_plugin_row_meta', 20, 2 );
function onecom_generic_plugin_row_meta( $links, $file ) {

	// Skip all non-one.com plugin entries.
	if ( $file != plugin_basename( __FILE__ ) ) {
		return $links;
	}

	$health_url = ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-wp-health-monitor' ) : admin_url( 'admin.php?page=onecom-wp-health-monitor' );

	$stg_url = ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-wp-staging' ) : admin_url( 'admin.php?page=onecom-wp-staging' );

	$themes_url = ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-wp-themes' ) : admin_url( 'admin.php?page=onecom-wp-themes' );

	$plugin_url = ( is_multisite() && is_network_admin() ) ? network_admin_url( 'admin.php?page=onecom-marketplace' ) : admin_url( 'admin.php?page=onecom-marketplace' );

	// Add new link - "View Details".
	$anchor = '<a href="%s">%s</a>';

	$new_links = array(
		'oc-health'  => sprintf( $anchor, $health_url, __( 'Health Monitor', 'onecom-wp' ) ),
		'oc-staging' => sprintf( $anchor, $stg_url, __( 'Staging', 'onecom-wp' ) ),
		'oc-themes'  => sprintf( $anchor, $themes_url, __( 'Themes' ) ),
		'oc-plugins' => sprintf( $anchor, $plugin_url, __( 'Plugins' ) ),
	);

	// Club the new link with existing links.
	return array_merge( $links, $new_links );
}

/**
 * Switch to GD Image editor as default.
 */
add_filter( 'wp_image_editors', 'oc_default_to_gd' );
if ( ! function_exists( 'oc_default_to_gd' ) ) {
	function oc_default_to_gd( $editors ) {
		$gd            = 'WP_Image_Editor_GD';
		$editors_array = array_diff( $editors, array( $gd ) );
		array_unshift( $editors_array, $gd );

		return $editors_array;
	}
}

register_uninstall_hook( __FILE__, 'oc_plugin_uninstall' );
function oc_plugin_uninstall() {
	// required since the file above is loaded on init
	if ( ! class_exists( 'OCVMHistoryLog' ) ) {
		require_once ONECOM_WP_PATH . '/modules/vulnerability-monitor/vulnerability-monitor.php';
	}
	// Delete VM log table upon uninstall.
	$vm_log = new OCVMHistoryLog();
	$vm_log->vm_log_delete();

	// Delete data consent status
	delete_site_option( 'onecom_data_consent_status' );

	// Send stats.
	( class_exists( 'OCPushStats' ) ? \OCPushStats::push_stats_event_themes_and_plugins( 'delete', 'plugin', dirname( plugin_basename( __FILE__ ) ), 'plugins_page' ) : '' );
}

function onecom_schedule_single_events() {
	do_action( 'onecom_hm_scan' );
}

/**
 * @return void
 * function to unset all the removed checks from previous HM scan
 * @todo remove it after next major update i.e 5.0
 */
if ( ! function_exists( 'oc_unset_removed_checks' ) ) {

	function oc_unset_removed_checks() {
		$prev_scan      = get_site_transient( 'ocsh_site_previous_scan' );
		$removed_checks = array(
			'DB',
			'vulnerability_exists',
			'login_recaptcha',
			'asset_minification',
			'logout_duration',
			'login_protection',
		);
		if ( $prev_scan && is_array( $prev_scan ) ) {
			foreach ( $prev_scan as $check => $status ) {
				if ( in_array( $check, $removed_checks ) ) {
					unset( $prev_scan[ $check ] );
				}
			}
			set_site_transient( 'ocsh_site_previous_scan', $prev_scan );
		}
	}
}

/**
 * Entrypoint for stg login
 */
if ( isset( $_GET['timelog'] ) && isset( $_GET['stgUrl'] ) ) {
	add_action( 'init', 'staging_login_callback' );
}
if ( isset( $_GET['redirect_to'] ) ) {
	add_filter( 'login_message', 'onecom_wp_login_error_callback' );
}
/**
 * Handling stg token and login
 */
if ( ! function_exists( 'staging_login_callback' ) ) {
	function staging_login_callback() {
		// If already logged in then return.
		if ( is_user_logged_in() ) {
			wp_redirect( admin_url() );
			exit;
		}
		// Check timelog is not empty.
		if ( ! empty( $_GET['timelog'] ) && ! empty( $_GET['stgUrl'] ) ) {

			$timelog  = trim( $_GET['timelog'] );
			$stg_url  = $_GET['stgUrl'];
			$site_url = site_url();

			// Check if both url is valid.
			if ( ! filter_var( $stg_url, FILTER_VALIDATE_URL ) && ! filter_var( $site_url, FILTER_VALIDATE_URL ) ) {
				return;
			}
			// Check for equal url.
			// Extra slash trimmed from stg_url to prevent failed logins.
			if ( $site_url !== rtrim( $stg_url, '/' ) ) {
				return;
			}

			$decryptedKey = validateStgToken( $timelog );
			global $wpdb;
			if ( $decryptedKey !== false ) {

				$user_id = getStgUserIds( $wpdb->prefix );

				if ( $user_id > 0 && ! is_user_logged_in() ) {
					$user      = get_user_by( 'ID', $user_id );
					$loginuser = $user->data->user_login;

					wp_set_current_user( $user_id, $loginuser );
					wp_set_auth_cookie( $user_id );
					do_action( 'wp_login', $loginuser, $user );

					if ( is_user_logged_in() ) {
						wp_redirect( admin_url() );
						exit;
					}
				}
			}
		}
	}
}

/**
 * Show loggin error message
 */
if ( ! function_exists( 'onecom_wp_login_error_callback' ) ) {
	function onecom_wp_login_error_callback( $message ) {

		if ( ! isset( $_GET['redirect_to'] ) && empty( $_GET['redirect_to'] ) ) {
			return $message;
		}

		$redirectto = $_GET['redirect_to'];
		$query      = parse_url( $redirectto, PHP_URL_QUERY );
		$queries    = array();
		if ( $query !== null ) {
			parse_str( $query, $queries );
		}

		if ( isset( $queries['timelog'] ) && ! empty( $queries['timelog'] ) ) {
			$tokenPassVal = $queries['timelog'];
			$tokenStatus  = validateStgToken( $tokenPassVal );

			if ( ! $tokenStatus ) {
				return '<div id="login_error">Invalid Token!<br>
                </div>';
			}
		}
		return $message;
	}
}


/**
 * @param $timelog
 * @return false|string
 *
 * Validate stg token
 */
if ( ! function_exists( 'validateStgToken' ) ) {
	function validateStgToken( $timelog ) {
		global $wpdb;
		$getLiveDetails = get_site_option( 'onecom_staging_existing_live', true );

		$encrypt_method = 'AES-256-CBC';
		$stgHash        = getStgHash( $wpdb->prefix );
		$secret_key     = $getLiveDetails->prefix . '__' . $wpdb->prefix . $stgHash;
		$secret_iv      = $wpdb->prefix . '__' . $getLiveDetails->prefix;
		$key            = hash( 'sha256', $secret_key );
		$iv             = substr( hash( 'sha256', $secret_iv ), 0, 16 );

		return openssl_decrypt( base64_decode( $timelog ), $encrypt_method, $key, 0, $iv );
	}
}
/**
 * @param $stgPrefix
 * @return int|mixed
 * Get admin ids
 */
if ( ! function_exists( 'getStgUserIds' ) ) {
	function getStgUserIds( $stgPrefix ) {
		global $wpdb;
		$getAdminQuery = 'SELECT u.ID, u.user_login, u.user_email,u.user_nicename FROM ' . $stgPrefix . 'users u, ' . $stgPrefix . 'usermeta m WHERE u.ID = m.user_id AND m.meta_key LIKE "' . $stgPrefix . 'capabilities" AND m.meta_value LIKE "%administrator%" order by ID ASC';
		// Get all admin users ids from DB.
		$wpAuthUser = $wpdb->get_results( $getAdminQuery );
		// Return first found user id.
		if ( ! empty( $wpAuthUser ) ) {
			return $wpAuthUser[0]->ID;
		}
		return 0;
	}
}

/**
 * @param $stgPrefix
 * @return int|mixed
 * Get stg user hash
 */
function getStgHash( $stgPrefix ) {
	global $wpdb;
	$getAdminQuery = 'SELECT u.user_pass FROM ' . $stgPrefix . 'users u, ' . $stgPrefix . 'usermeta m WHERE u.ID = m.user_id AND m.meta_key LIKE "' . $stgPrefix . 'capabilities" AND m.meta_value LIKE "%administrator%" order by ID ASC';
	// Get admin hash.
	$wpAuthUser = $wpdb->get_results( $getAdminQuery );
	// Return found admin hash.
	if ( ! empty( $wpAuthUser ) ) {
		return $wpAuthUser[0]->user_pass;
	}
	return 0;
}
if ( ! class_exists( 'ONECOM_HOME' ) ) {
	require_once ONECOM_WP_PATH . '/modules/home/index.php';
}

if ( ! class_exists( 'Onecom_Themes_Loader' ) ) {
	require_once ONECOM_WP_PATH . '/inc/class-onecom-themes-loader.php';
	// Instantiate the class
	new Onecom_Themes_Loader();
}

/**
 * @return void
 * Update a staging path for migrated oneHop domains
 */
add_action('wp_loaded','ohStagingPathFix', 10);
if ( ! function_exists( 'ohStagingPathFix' ) ) {
	function ohStagingPathFix(): void
	{
		try{

			global $wpdb;
			$option_name = 'onecom_staging_existing_staging';
			$cluster_id = $_SERVER['ONECOM_CLUSTER_ID'] ?? '';
			$staging_data = get_site_option($option_name, true);
			$onecom_stg_path_fixed = get_site_option('onecom_stg_path_fixed');

			//Check is staging updated for migrated v3 domain
			if(!empty($onecom_stg_path_fixed)){
				return;
			}

			//Return if anyone is empty
			if (
				empty($cluster_id) ||
				empty($staging_data) ||
				!is_array($staging_data)
			) {
				return;
			}

			$staging_prefix = array_key_first($staging_data);

			//Return if a staging path is missing
			if (
				empty($staging_prefix) ||
				!isset($staging_data[$staging_prefix]['path'])
			) {
				return;
			}


			//Update the path as per oneHoP absolute path
			$staging_data[$staging_prefix]['path'] = ABSPATH . $staging_prefix;

			$wpdb->query(
				$wpdb->prepare(
					"UPDATE {$wpdb->prefix}options SET option_value = %s WHERE option_name = 'onecom_staging_existing_staging'",
					serialize( $staging_data )
				)
			);
			delete_site_option('staging_broken');
			update_site_option('onecom_stg_path_fixed', time());

		} catch (Exception $e){
			error_log("Staging error during oneHoP db update: " . $e->getMessage());
			( class_exists( 'OCPushStats' ) ? \OCPushStats::push_stats_misc_events( 'stgfix', '', 'staging', '', '', ['error'=> $e->getMessage()]): '');
		}
	}
}

add_action('init', 'onecom_boot_marketplace', 10);
if(!function_exists('onecom_boot_marketplace')){
	function onecom_boot_marketplace(): void
	{
		// Make $oc_stats_data global so domain and subdomain can be accessed for API URL query params
		global $oc_stats_data;
		$oc_stats_data = OCPushStats::stats_base_parametres();

		if ( ! function_exists( 'get_mixpanel_props' ) ) {
			function get_mixpanel_props( $mixpanel_props = [] ): array {
				global $oc_stats_data;
				$oc_validate_domain = oc_validate_domain();

				//Mixpanel sandbox mode, true for sandbox, false for production
				$is_sandbox = true;
				if (str_contains(MIDDLEWARE_URL, 'wpapi.one.com')) {
					$is_sandbox = false;
				}

				// your base props
				$default_props = [
					"user_id"                => is_array($oc_validate_domain) && isset($oc_validate_domain['uuid']) ? $oc_validate_domain['uuid'] : '',
					"customer_country"       => (is_array($oc_validate_domain) && isset($oc_validate_domain['country'])) ? $oc_validate_domain['country'] : '',
					"domain"                 => isset($oc_stats_data['domain']) ? hash('sha256', $oc_stats_data['domain']) : $_SERVER['HTTP_HOST'],
					"env"                    => str_contains(MIDDLEWARE_URL, "wpapi.one.com") ? "production" : "development",
					"generic_plugin_version" => $oc_stats_data['generic_plugin_version'] ?? null,
					"hosting_package"        => $oc_stats_data['hosting_package'] ?? null,
					"is_mwp"                 => is_array($oc_validate_domain) && isset($oc_validate_domain['data']) && in_array("MWP_ADDON", $oc_validate_domain['data']),
					"is_one_hop"             => function_exists('is_cluster_domain') && is_cluster_domain(),
					"package_features"       => $oc_stats_data['package_features'] ?? null,
					"php_version"            => $oc_stats_data['php_version'] ?? null,
					"subdomain"              => isset($oc_stats_data['subdomain']) ? hash('sha256', $oc_stats_data['subdomain']): '',
					"page_opened_at"		 => current_time('timestamp'),
					"is_sandbox"			 => $is_sandbox,
				];

				if (isset($oc_stats_data['cluster']) && !empty($oc_stats_data['cluster'])) {
					$default_props['cluster'] = $oc_stats_data['cluster'];
					$default_props['fqdn'] = isset($oc_stats_data['fqdn']) ? hash('sha256', $oc_stats_data['fqdn']) : $_SERVER['HTTP_HOST'];
					$default_props['webroot'] = $oc_stats_data['webroot'] ?? null;
				}

				// merge incoming props with default
				return array_merge( $default_props, $mixpanel_props );

			}
		}

		$mixpanel_props = get_mixpanel_props();

		// Composer autoloader registers both your plugin classes and the Mozart-prefixed dependencies
		require_once __DIR__ . '/vendor/autoload.php';
		try {

		//	// Using the Mozart-prefixed class name after Composer autoload is registered
			$base_url = MIDDLEWARE_URL .'/marketplace/products/catalog';
			$api_url = add_query_arg([
				'locale' => get_locale(),
				'php' => ONECOM_PHP_VERSION,
				'wp' => ONECOM_WP_CORE_VERSION,
				'domain'=> $oc_stats_data['domain'],
				'subdomain'=> $oc_stats_data['subdomain'],
			], $base_url);

			// Extract distinct_id (UUID) from mixpanel_props
			$distinct_id = isset($mixpanel_props['user_id']) ? $mixpanel_props['user_id'] : '';
			$data_consent_status     = get_site_option( 'onecom_data_consent_status', false );
			\WPMarketplace\Dependencies\Groupone\Marketplace\Marketplace::run([
				'parent_menu_slug' => 'onecom-wp',
				'page_title' => 'Plugin Marketplace',
				'menu_title' => 'Marketplace',
				'menu_slug' => 'onecom-marketplace',
				'addons_menu_slug' => 'onecom-marketplace-products',
				'addons_page_title' => 'Your add-ons',
				'addons_menu_title' => 'Your add-ons',
				'api_url' => $api_url,
				'brand' => 'onecom', // Optional: brand identifier for API filtering
				// Optional: Explicitly set assets path if auto-detection doesn't work
				'assets_path' => __DIR__ . '/inc/Dependencies/WPMarketplace/Groupone/Marketplace/',
				'mixp_props' =>  $mixpanel_props ,
				'mixp_distinct_id' => $distinct_id ,
				'data_consent_status' => $data_consent_status
			]);
		}catch ( \Throwable $e ) {
			error_log("Error loading Marketplace: " . $e->getMessage());
			// Avoid breaking the admin; vendor-test will still show load status.
		}
	}
}

// Remove one.com submenu plugin from everywhere
add_action('admin_menu', 'remove_onecom_plugin_submenu', 99);
if(!function_exists('remove_onecom_plugin_submenu')){
	function remove_onecom_plugin_submenu(): void
	{
		global $submenu;

		foreach ((array) $submenu as $parent_slug => $submenus) {
			foreach ((array) $submenus as $index => $submenu_item) {
				if (isset($submenu_item[2]) && $submenu_item[2] === 'onecom-wp-plugins') {
					unset($submenu[$parent_slug][$index]);
				}
			}
		}
	}
}

// Force redirect old one.com plugins page to marketplace page
add_action('admin_page_access_denied', 'handle_onecom_plugins_redirection', 10, 2); ;
if(!function_exists('handle_onecom_plugins_redirection')){
	function handle_onecom_plugins_redirection(): void
	{
		if (isset($_GET['page']) && $_GET['page'] === 'onecom-wp-plugins' && is_admin()) {
			wp_safe_redirect(admin_url('admin.php?page=onecom-marketplace'));
			exit;
		}
	}
}