<?php

namespace WP_Social\App;

use WP_Social\Traits\Singleton;

defined('ABSPATH') || exit;

class Login_Settings {

	use Singleton;

	const OK_GLOBAL             = 'xs_global_setting_data';
	const OK_STYLES             = 'xs_style_setting_data';
	const OK_PROVIDER           = 'xs_provider_data';
	const OK_PROVIDER_ENABLED   = 'xs_providers_enabled_login';


	private $global;
	private $providers;
	private $enabled;
	private $styles;

	public function __construct() {

		$this->global    = get_option(self::OK_GLOBAL, []);
		$this->enabled   = get_option(self::OK_PROVIDER_ENABLED, []);
		$this->providers = get_option(self::OK_PROVIDER, []);
		$this->styles    = get_option(self::OK_STYLES, []);
	}


	public static function get_login_styles() {

		$free_styles = [
			'style-1' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-1.png',
				'title'   => __('Icon with providers label', 'wp-social'),
				'package' => 'free',
				'unlocked' => true,
			],
			'style-2' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-2.png',
				'title'   => __('Only social icon', 'wp-social'),
				'package' => 'free',
				'unlocked' => true,
			],
			'style-3' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-3.png',
				'title'   => __('Only providers label', 'wp-social'),
				'package' => 'free',
				'unlocked' => true,
			],
		];

		if(\WP_Social::is_pro_active()) {

			return apply_filters('wp_social_pro/login/styles/pro_design', $free_styles);
		}

		$pro_only = [
			'style-4'  => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-4-pro.png',
				'title'   => __('Icon Overlay', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-5'  => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-5-pro.png',
				'title'   => __('Left Slide', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-6'  => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-6-pro.png',
				'title'   => __('Circle Blow', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],

			'style-7'  => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-7-pro.png',
				'title'   => __('Left Slide Overlay', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-8'  => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-8-pro.png',
				'title'   => __('Circle Line Icon', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-9'  => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-9-pro.png',
				'title'   => __('Slide to arrow', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-10' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-10-pro.png',
				'title'   => __('Stroke right radius', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-11' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-11-pro.png',
				'title'   => __('Gradient Icon', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-12' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-12-pro.png',
				'title'   => __('Box Style', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-13' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-13-pro.png',
				'title'   => __('Drop icon', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-14' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-14-pro.png',
				'title'   => __('Minimal Stack Icons', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-15' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-15-pro.png',
				'title'   => __('Capsule Icons', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-16' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-16-pro.png',
				'title'   => __('Dark Dot Icons', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-17' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-17-pro.png',
				'title'   => __('Dark Card Icons', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-18' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-18-pro.png',
				'title'   => __('Dark Ghost Icons ', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-19' => [
				'image'   => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-19-pro.png',
				'title'   => __(' Dark Auth Stack Icons', 'wp-social'),
				'package' => 'pro',
				'unlocked' => false,
			],
			'style-20' => [
				'image'    => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-20-pro.png',
				'title'    => __('Floating Icons', 'wp-social'),
				'package'  => 'pro',
				'unlocked' => false,
			],
			'style-21' => [
				'image'    => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-21-pro.png',
				'title'    => __('Clean Auth Icons', 'wp-social'),
				'package'  => 'pro',
				'unlocked' => false,
			],
			'style-22' => [
				'image'    => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-22-pro.png',
				'title'    => __('Bubble Icons', 'wp-social'),
				'package'  => 'pro',
				'unlocked' => false,
			],
			'style-23' => [
				'image'    => WSLU_LOGIN_PLUGIN_URL . 'assets/images/screenshort/login/style-23-pro.png',
				'title'    => __('Bordered Card Icons', 'wp-social'),
				'package'  => 'pro',
				'unlocked' => false,
			],
		];

		$all_styles = array_merge($free_styles, $pro_only);

		/**
		 * Hook: wp_social_login_styles_list
		 * 
		 * Allows other plugins to access the list of login designs 
		 * and their package information (free/pro).
		 * 
		 * @param array $all_styles Complete array of all login styles
		 * @param array $free_styles Array of free login styles only
		 * @param array $pro_only Array of pro login styles only
		 * 
		 * @since 3.5.0
		 * 
		 * Example usage in another plugin:
		 * 
		 * add_action('wp_social_login_styles_list', function($all_styles, $free_styles, $pro_styles) {
		 *     // Access all styles
		 *     foreach($all_styles as $style_key => $style_data) {
		 *         error_log("Style: {$style_key}, Package: {$style_data['package']}");
		 *     }
		 *     
		 *     // Get only free styles
		 *     $free_style_keys = array_keys($free_styles);
		 *     
		 *     // Get only pro styles
		 *     $pro_style_keys = array_keys($pro_styles);
		 * }, 10, 3);
		 */
		do_action('wp_social_login_styles_list', $all_styles, $free_styles, $pro_only);

		return $all_styles;
	}


	public function load() {

		if(empty($this->global)) {
			$this->global = get_option(self::OK_GLOBAL, []);
		}

		if(empty($this->enabled)) {
			$this->enabled = get_option(self::OK_PROVIDER_ENABLED, []);
		}

		if(empty($this->providers)) {
			$this->providers = get_option(self::OK_PROVIDER, []);
		}

		if(empty($this->styles)) {
			$this->styles = get_option(self::OK_STYLES, []);
		}

		return $this;
	}


	public function get_enabled_providers() {

		return $this->enabled;
	}


	public function update_enabled_providers($val) {

		$this->enabled = $val;

		update_option(self::OK_PROVIDER_ENABLED, $val, true);

		return $this;
	}


	public function get_provider_settings() {

		return $this->providers;
	}


	public function update_provider_settings($val) {

		$this->providers = $val;

		update_option(self::OK_PROVIDER, $val, true);

		return $this;
	}


	public function get_style_settings() {

		return $this->styles;
	}


	public function update_style_settings($val) {

		$this->styles = $val;

		update_option(self::OK_STYLES, $val, true);

		return $this;
	}


	public function get_global_settings() {

		return $this->global;
	}


	public function update_global_settings($val) {

		$this->global = $val;

		update_option(self::OK_GLOBAL, $val, true);

		return $this;
	}


	public function is_custom_url_enabled() {

		return !empty($this->global['custom_login_url']['enable']);
	}


	public function get_custom_url() {

		return empty($this->global['custom_login_url']['data']) ? '#' : $this->global['custom_login_url']['data'];
	}


	public function is_login_page_login_button_enabled() {

		return !empty($this->global['wp_login_page']['enable']);
	}


	public function get_selected_style() {

		return empty($this->styles['login_button_style']) ? 'style-1' : $this->styles['login_button_style'];
	}
}
