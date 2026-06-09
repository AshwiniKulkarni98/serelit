<?php

declare(strict_types=1);
defined( 'WPINC' ) or die(); // No Direct Access

/**
 * Class Onecom_Wp_Rocket
 *
 */
#[\AllowDynamicProperties]
class Onecom_Wp_Rocket {

	const WR_ADDON_API = MIDDLEWARE_URL . '/features/addon/WP_ROCKET/status';

	const WR_MARKETPLACE_PRICES_API = MIDDLEWARE_URL . '/marketplace/prices';

	const WR_ADDON_CLUSTER_API = MIDDLEWARE_URL . '/features/addon/WP_ROCKET/status/cluster';
	const WR_ICON      = ONECOM_WP_URL . 'modules/wp-rocket/assets/images/wp-rocket-icon.svg';
	const WR_SLUG      = 'wp-rocket/wp-rocket.php';

	const EXPIRATION_TIME_IN_MINUTES = 5; // 5-minute
	// Class Constructor
	public function __construct() {}

	public $guide_links = array(
		'en' => 'https://help.one.com/hc/en-us/articles/5927991871761-What-is-WP-Rocket-',
		'da' => 'https://help.one.com/hc/da/articles/5927991871761-Hvad-er-WP-Rocket-',
		'de' => 'https://help.one.com/hc/de/articles/5927991871761-Was-ist-WP-Rocket-',
		'es' => 'https://help.one.com/hc/es/articles/5927991871761--Qu%C3%A9-es-WP-Rocket-',
		'fr' => 'https://help.one.com/hc/fr/articles/5927991871761-Que-est-ce-que-WP-Rocket-',
		'fi' => 'https://help.one.com/hc/fi/articles/5927991871761-Mik%C3%A4-on-WP-Rocket-',
		'it' => 'https://help.one.com/hc/it/articles/5927991871761-Cos-%C3%A8-WP-Rocket-',
		'nl' => 'https://help.one.com/hc/nl/articles/5927991871761-Wat-is-WP-Rocket-',
		'no' => 'https://help.one.com/hc/no/articles/5927991871761-Hva-er-WP-Rocket-',
		'pt' => 'https://help.one.com/hc/pt/articles/5927991871761-O-que-%C3%A9-o-WP-Rocket-',
		'sv' => 'https://help.one.com/hc/sv/articles/5927991871761-Vad-%C3%A4r-WP-Rocket-',
	);

	// Initiatize actions
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_on_reload_plugin_activate', array( $this, 'on_reload_plugin_activate_check' ) );
		add_action( 'wp_ajax_activate_onclick_wp_plugin', array( $this, 'onclick_plugin_activate' ) );
		add_action( 'wp_ajax_check_addon_purchase_status', array( $this, 'check_addon_purchase_status' ) );
		add_action( 'wp_ajax_check_addon_purchase_status_onload', array( $this, 'on_reload_addon_status_check' ) );
		add_action( 'activate_wp-rocket/wp-rocket.php', array( $this, 'wp_rocket_activation_action' ) );
	}

	// Load scripts on relevant page(s) only
	public function enqueue_scripts( $hook_suffix ) {
		if ( $hook_suffix !== 'one-com_page_onecom-wp-rocket') {
			return;
		}

		wp_enqueue_style( 'oc_wpr_style', ONECOM_WP_URL . 'modules/wp-rocket/assets/css/wp-rocket.css', array(), ONECOM_WP_VERSION );

		// Load JS on both pages
		wp_enqueue_script( 'oc_wpr_script', ONECOM_WP_URL . 'modules/wp-rocket/assets/js/wp-rocket.js', array( 'jquery' ), ONECOM_WP_VERSION, true );
	}

	/**
	 * WP Rocket activation hooks
	 */
	public function wp_rocket_activation_action(): void {
		/**
		 * Call to the features endpoint for restoring transient value
		 * Why? So that wp-rocket page and its plugin entry shows latest state in plugins list after activation immediately
		 */
		oc_set_premi_flag( true );
	}

	// WP-Rocket translated guide link with en fallback
	public function wp_rocket_translated_guide() {
		$locale = explode( '_', get_locale() )[0];
		if ( ! array_key_exists( $locale, $this->guide_links ) ) {
			$locale = 'en';
		}
		return $this->guide_links[ $locale ];
	}

	/**
	 * Plugin activates on the button click
	 * @return void
	 */
	public function onclick_plugin_activate() {
		$addon_slug = $_POST['addon_slug'];
		$transient_key = "{$addon_slug}_activation_button_clicked_at";
		set_site_transient( $transient_key, current_time( 'timestamp' ), self::EXPIRATION_TIME_IN_MINUTES * MINUTE_IN_SECONDS );

		$this->activate_wp_plugin( $addon_slug );
	}

	/**
	 * Addon status check on the button click
	 * @return void
	 */
	public function check_addon_purchase_status() {
		$addon_slug = $_POST['addon_slug'];
		$transient_key = "{$addon_slug}_select_button_clicked_at";
		set_site_transient( $transient_key, current_time( 'timestamp' ), self::EXPIRATION_TIME_IN_MINUTES * MINUTE_IN_SECONDS );

		$this->addon_status_check( $addon_slug );
	}


	/**
	 * Check plugin activation on reload
	 * @return void
	 */
	public function on_reload_addon_status_check() {
		$addon_slug = $_POST['addon_slug'];
		$this->addon_status_check( $addon_slug );
	}

	/**
	 * Check plugin activation on reload
	 * @return void
	 */
	public function on_reload_plugin_activate_check() {
		$addon_slug = $_POST['addon_slug'];
		$this->activate_wp_plugin( $addon_slug );
	}

	public function check_addon_purchase_response($getAddonStatus){
		if (is_array($getAddonStatus) && array_key_exists('success', $getAddonStatus) && $getAddonStatus['success']) {
			if (array_key_exists('data', $getAddonStatus) && array_key_exists('source', $getAddonStatus['data']) && $getAddonStatus['data']['source'] === 'PURCHASED' && array_key_exists('product', $getAddonStatus['data']) && $getAddonStatus['data']['product'] === 'WP_ROCKET') {
				return true;
			} else {
				return false;
			}
		} else {
			error_log("Error fetching addon status from features endpoint: " . (is_array($getAddonStatus) && array_key_exists('error', $getAddonStatus) ? $getAddonStatus['error'] : 'Unknown error'));
			return false;
		}
	}
	/**
	 * onclick and reload check
	 * Addon purchase status
	 */
	public function addon_status_check($addon_slug) {
		$start_time_key     = "{$addon_slug}_purchase_button_start_at";
		$btn_transient_key  = "{$addon_slug}_select_button_clicked_at";
		$timeout_limit      = self::EXPIRATION_TIME_IN_MINUTES * MINUTE_IN_SECONDS;
		$current_time       = current_time('timestamp');

		$plugin_slug        = self::WR_SLUG;
		// Ensure the activation button was clicked
		if ( ! get_site_transient($btn_transient_key) ) {
			wp_send_json(['status' => 'normal_reload']);
		}

		// Common success response
		$send_success = function() use ($addon_slug) {
			error_log("Addon purchased successfully from WP-admin: {$addon_slug}");
			$this->clear_addon_status_queue($addon_slug);
			//set status for activation plugin
			$this->set_transient_for_addon_activation($addon_slug);
			//addon purchased, now set transient for activation plugin

			wp_send_json([
				'status'   => 'addon_purchased'
			]);
		};

		// If the plugin is already active, respond immediately
		if (is_plugin_active($plugin_slug)) {
			error_log("Plugin already active: {$plugin_slug}, skipping purchase check");
			wp_send_json([
				'status'   => 'already_plugin_active'
			]);
		}

		$start_time = get_site_transient($start_time_key);

		// Case 1: First time select click attempt
		if (!$start_time) {
			set_site_transient($start_time_key, $current_time, $timeout_limit);

			wp_send_json(['status' => 'added_in_queue']);
		}

		//get addon purchase status, force refresh feature endpoint
		//call feature endpoint to get latest addon status
		$getAddonStatus = $this->wp_rocket_addon_info(true);
		$addon_purchased = $this->check_addon_purchase_response($getAddonStatus);

		if ($addon_purchased) {
			$send_success();
		}

		$elapsed_time = $current_time - (int) $start_time;
		$time_left    = $timeout_limit - $elapsed_time;

		// Case 2: Stop polling early if less than 30 seconds left
		if ($time_left <= 30) {

			if ($addon_purchased) {
				$send_success();
			}

			error_log("Polling stopped early (time left: {$time_left}s) for {$addon_slug}");
			$this->clear_addon_status_queue($addon_slug);
			wp_send_json(['status' => 'expired_queue']);
		}

		// Case 3: Queue expired after timeout
		if ($elapsed_time >= $timeout_limit) {

			if ($addon_purchased) {
				$send_success();
			}

			error_log("Addon not purchased and timed out: {$plugin_slug}");
			$this->clear_addon_status_queue($addon_slug);
			wp_send_json(['status' => 'expired_queue']);
		}

		// Case 3: Queue still in progress
		error_log("Addon purchase in progress: {$plugin_slug}");
		wp_send_json(['status' => 'already_in_queue']);
	}

	/**
	 * onclick and reload check
	 * Activate a plugin
	 */
	public function activate_wp_plugin($addon_slug) {
		$start_time_key     = "{$addon_slug}_activation_start_at";
		$btn_transient_key  = "{$addon_slug}_activation_button_clicked_at";
		$plugin_slug        = self::WR_SLUG;
		$admin_url          = admin_url('options-general.php?page=wprocket');
		$plugin_btn_text    = __('Go to WP Rocket plugin', 'onecom-wp');
		$timeout_limit      = self::EXPIRATION_TIME_IN_MINUTES * MINUTE_IN_SECONDS;
		$current_time       = current_time('timestamp');

		// Ensure the activation button was clicked
		if ( ! get_site_transient($btn_transient_key) ) {
			wp_send_json(['status' => 'normal_reload']);
		}

		// Common success response
		$send_success = function() use ($addon_slug, $plugin_slug, $admin_url, $plugin_btn_text) {
			error_log("Plugin activated successfully from WP-admin: {$plugin_slug}");
			$this->clear_activation_queue($addon_slug);
			wp_send_json([
				'status'   => 'activated',
				'url'      => $admin_url,
				'btn_text' => $plugin_btn_text,
			]);
		};

		// If the plugin is already active, respond immediately
		if (is_plugin_active($plugin_slug)) {
			$send_success();
		}

		$start_time = get_site_transient($start_time_key);

		// Case 1: First time activation attempt
		if (!$start_time) {
			set_site_transient($start_time_key, $current_time, $timeout_limit);

			if ($this->is_wp_rocket_installed()) {
				$result = activate_plugin($plugin_slug);

				if (is_wp_error($result)) {
					error_log("Plugin activation failed from WP-admin: {$plugin_slug}");
					$this->clear_activation_queue($addon_slug);
					wp_send_json_error([
						'status'  => 'activation_failed',
						'message' => $result->get_error_message(),
					]);
				}

				$send_success();
			}

			// If not active, trigger provisioner
			if (!is_plugin_active($plugin_slug)) {
				$status = $this->call_wp_api_provisioner($addon_slug);
				error_log('PP status: ' . $status);
				wp_send_json(['status' => $status]);
			}
		}

		// Case 2: Existing queue, check timeout
		if (($current_time - (int) $start_time) >= $timeout_limit) {
			if (is_plugin_active($plugin_slug)) {
				$send_success();
			}

			error_log("Plugin not activated and timed out: {$plugin_slug}");
			$this->clear_activation_queue($addon_slug);
			wp_send_json(['status' => 'expired_queue']);
		}

		// Case 3: Queue still in progress
		error_log("Plugin activation in progress: {$plugin_slug}");
		wp_send_json(['status' => 'already_in_queue']);
	}


	public function set_transient_for_addon_activation($addon_slug) {
		$activation_start_at = "{$addon_slug}_activation_start_at";
		$activation_button_clicked_at = "{$addon_slug}_activation_button_clicked_at";
		$pp_activation_start_at = "$addon_slug-pp-activation-start-at";
		$timeout_limit      = self::EXPIRATION_TIME_IN_MINUTES * MINUTE_IN_SECONDS;
		$current_time       = current_time('timestamp');

		set_site_transient( $activation_start_at, $current_time, $timeout_limit );
		set_site_transient( $activation_button_clicked_at, $current_time, $timeout_limit
		);
		set_site_transient( $pp_activation_start_at, $current_time, $timeout_limit );
	}


	public function clear_activation_queue($addon_slug) {
		delete_site_transient( "{$addon_slug}_activation_start_at" );
		delete_site_transient( "{$addon_slug}_activation_button_clicked_at" );
		delete_site_transient( "$addon_slug-pp-activation-start-at" );

		//clear cache
		if ( function_exists( 'wp_cache_flush' ) ) {
			wp_cache_flush();
		}
	}

	public function clear_addon_status_queue($addon_slug) {

		delete_site_transient( "{$addon_slug}_purchase_button_start_at" );
		delete_site_transient( "{$addon_slug}_select_button_clicked_at" );

		//clear cache
		if ( function_exists( 'wp_cache_flush' ) ) {
			wp_cache_flush();
		}
	}

	/**
	 * Function to include WP-Rocket admin page template
	 */
	public static function wp_rocket_page() {
		require_once plugin_dir_path( __DIR__ ) . '/templates/wp-rocket-admin-page.php';
	}

	// Fetch wp rocket addon info via feature endpoint
	public function wp_rocket_addon_info( $force = false, $domain = '' ) {
		// check transient
		$wp_rocket_addon_info = get_site_transient( 'onecom_wp_rocket_addon_info' );
		if ( ! empty( $wp_rocket_addon_info ) && false === $force ) {
			return $wp_rocket_addon_info;
		}
		if ( ! $domain ) {
			$domain = isset( $_SERVER['ONECOM_DOMAIN_NAME'] ) ? $_SERVER['ONECOM_DOMAIN_NAME'] : false;
		}
		if ( ! $domain ) {
			return array(
				'data'    => null,
				'error'   => 'Empty domain',
				'success' => false,
			);
		}
		$totp = oc_generate_totp();

		// headers and api url based on cluster domain or not
		if ( is_cluster_domain() ) {
			//create header for cluster model
			$curl_url = self::WR_ADDON_CLUSTER_API;

			$http_header = array(
				'Cache-Control: no-cache',
				'X-Onecom-Client-Domain: ' . $domain,
				'X-TOTP: ' . $totp,
				'cache-control: no-cache',
			);

			$http_header[] = 'X-ONECOM-CLUSTER-ID: ' . OC_CLUSTER_ID;
			$http_header[] = 'X-ONECOM-WEBCONFIG-NAME: ' . $_SERVER['HTTP_X_GROUPONE_WEBCONFIG_NAME'];

		} else {
			//prepare headers for domain model
			$curl_url = self::WR_ADDON_API;
			$http_header = array(
				'Cache-Control: no-cache',
				'X-Onecom-Client-Domain: ' . $domain, //need to use from wp-config if available otherwise use domain parse
				'X-TOTP: ' . $totp,
				'cache-control: no-cache',
			);
		}

		$curl = curl_init();
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => $curl_url,

				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST  => 'GET',
				CURLOPT_HTTPHEADER     => $http_header
			)
		);
		$response = curl_exec( $curl );
		$response = json_decode( $response, true );
		$err      = curl_error( $curl );
		curl_close( $curl );

		if ( $err ) {
			return array(
				'data'    => null,
				'error'   => __( 'Some error occurred, please reload the page and try again.', 'validator' ),
				'success' => false,
			);
		} else {
			// save transient for next calls, & return latest response
			set_site_transient( 'onecom_wp_rocket_addon_info', $response, 12 * HOUR_IN_SECONDS );
			return $response;
		}
	}

	public function get_marketplace_prices(array $addons = array(), $force = false){
		$countryCode = $this->get_cu_country_code();

		$addons_param = rawurlencode(implode(', ', $addons));

		// check transient
		$wp_marketplace_price = get_site_transient( 'onecom_marketplace_prices' );
		if ( ! empty( $wp_marketplace_price ) && false === $force ) {
			error_log('Using transient marketplace prices');
			return $wp_marketplace_price;
		}

		$curl_url = self::WR_MARKETPLACE_PRICES_API . '?addons=' . $addons_param . '&countryCode=' . rawurlencode($countryCode);

		$domain = isset( $_SERVER['ONECOM_DOMAIN_NAME'] ) ? $_SERVER['ONECOM_DOMAIN_NAME'] : false;
		$totp = function_exists('oc_generate_totp') ? oc_generate_totp() : '';

		// Build headers similar to wp_rocket_addon_info
		$http_header = array(
			'Cache-Control: no-cache',
		);

		if($domain){
			$http_header[] = 'X-Onecom-Client-Domain: ' . $domain;
		}

		if($totp){
			$http_header[] = 'X-TOTP: ' . $totp;
		}

		if ( function_exists('is_cluster_domain') && is_cluster_domain() ) {
			if(defined('OC_CLUSTER_ID')){
				$http_header[] = 'X-ONECOM-CLUSTER-ID: ' . OC_CLUSTER_ID;
			}
			if(isset($_SERVER['HTTP_X_GROUPONE_WEBCONFIG_NAME'])){
				$http_header[] = 'X-ONECOM-WEBCONFIG-NAME: ' . $_SERVER['HTTP_X_GROUPONE_WEBCONFIG_NAME'];
			}
		}

		$curl = curl_init();
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => $curl_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST  => 'GET',
				CURLOPT_HTTPHEADER     => $http_header
			)
		);
		$response = curl_exec( $curl );
		$err      = curl_error( $curl );
		curl_close( $curl );
		// Handle curl error
		if ( $err ) {
			return array(
				'data'    => null,
				'error'   => __( 'Some error occurred, please reload the page and try again.', 'validator' ),
				'success' => false,
			);
		}

		$response_arr = json_decode($response, true);
		if(!is_array($response_arr)){
			return array(
				'data'    => null,
				'error'   => __( 'Invalid response from marketplace prices API.', 'onecom-wp' ),
				'success' => false,
			);
		}

		//set transient for next calls and return the latest response
		set_site_transient( 'onecom_marketplace_prices', $response_arr, 12 * HOUR_IN_SECONDS );
		return $response_arr;
	}

	public function get_wpr_price(array $addons = array('WP_ROCKET')){
		// Fetch prices from marketplace API for the requested addons and aggregate all valid ones.
		$api_resp = $this->get_marketplace_prices($addons);

		if (is_array($api_resp) && isset($api_resp['success']) && $api_resp['success'] && isset($api_resp['data']['prices']) && is_array($api_resp['data']['prices'])) {
			// Build an index of prices by addon for an easier lookup
			$prices_by_addon = array();
			foreach ($api_resp['data']['prices'] as $price_entry) {
				if (!isset($price_entry['addon'])) {
					continue;
				}
				$prices_by_addon[$price_entry['addon']] = $price_entry;
			}

			$result = array('success' => true);
			$found_any = false;
			// Respect the order of requested addons. Collect all valid ones.

			foreach ($addons as $addon_name) {

				if (!isset($prices_by_addon[$addon_name])) {
					continue;
				}

				$price_entry = $prices_by_addon[$addon_name];
				// Only include if a result is a valid array
				if (isset($price_entry['result']) && is_array($price_entry['result'])) {
					$r = $price_entry['result'];
					$result[$addon_name] = $r;
					$found_any = true;
				}
			}

			if ($found_any) {
				return $result;
			}
		}

		// If we reach here, no valid pricing available for requested addons; return error with success false as per requirement.
		return array(
			'success' => false,
			'error' => __( 'Requested addon price not available at the moment. Please try again later.', 'onecom-wp' ),
		);
	}

	public function get_cu_country_code(){
		$default = 'US';
		$status = $this->wp_rocket_addon_info();

		$country_code = $default;
		if(is_array($status) &&
		   isset($status['data']) &&
		   is_array($status['data']) &&
		   !empty($status['data']['country'])) {
			$country_code = $status['data']['country'];
		}

		error_log("Country code use for addon price: $country_code");
		return $country_code;
	}
	public function call_wp_api_provisioner($addon_slug)
	{
		if (empty($addon_slug)) {
			return;
		}

		//skip provisioner call if addon not subscribed
		if(!$this->is_wp_rocket_addon_purchased()){
			error_log('addon_not_subscribed, skipping WP API Provisioner call: ' . $addon_slug);
			return 'addon_not_subscribed';
		}

		error_log("Request plugin activation from wp-admin: $addon_slug");

		//Just add the below key in onboarding also for sync
		$pp_start_at = "$addon_slug-pp-activation-start-at";
		$start_time = get_site_transient( $pp_start_at );

		if($start_time){
			error_log("The provisioning request has already been sent; skipping the re-request: " . $addon_slug);
			return 'already_in_queue';
		}

		error_log("Calling WP API Provisioner for plugin:" . $addon_slug);

		if (is_cluster_domain()) {
			$url = MIDDLEWARE_URL . '/plugin-provisioner/cluster';
		} else {
			$url = onecom_query_check(MIDDLEWARE_URL . '/plugin-provisioner');
		}

		add_filter('http_request_args', 'oc_add_http_headers', 10, 2);
		wp_remote_post(
			$url,
			array(
				'body' => json_encode(array(
					'subdomain' => OCPushStats::get_subdomain(),
					'domain' => OCPushStats::get_domain(),
					'addon_slug' => $addon_slug
				))
			)
		);

		remove_filter('http_request_args', 'oc_add_http_headers');

		// Push installed plugins with activation status
		( class_exists( 'OCPUSHSTATS' ) ? \OCPushStats::push_stats_event_themes_and_plugins( 'plugin_install', 'blog', 'plugin_selector', "wpapi_provisoner" ) : '' );

		return 'added_to_queue';
	}

	/**
	 * Check if wp_rocket plugin addon purchased
	 */
	public function is_wp_rocket_addon_purchased(): bool {
		$this->wp_rocket_addon_info = $this->wp_rocket_addon_info();

		return (
			is_array( $this->wp_rocket_addon_info ) &&
			array_key_exists( 'success', $this->wp_rocket_addon_info ) &&
			$this->wp_rocket_addon_info['success'] &&
			array_key_exists( 'data', $this->wp_rocket_addon_info ) &&
			array_key_exists( 'source', $this->wp_rocket_addon_info['data'] ) &&
			$this->wp_rocket_addon_info['data']['source'] === 'PURCHASED' &&
			array_key_exists( 'product', $this->wp_rocket_addon_info['data'] ) &&
			$this->wp_rocket_addon_info['data']['product'] === 'WP_ROCKET'
		);
	}

	// Check if WP Rocket is provisioned/installed via one.com
	public function is_oc_wp_rocket_flag_exists() {
		return get_site_option( 'oc-wp-rocket-activation' );
	}

	// Check if WP Rocket plugin is active
	public function is_wp_rocket_active(): bool {
		return is_plugin_active( self::WR_SLUG );
	}

	// Check if WP Rocket is installed
	public function is_wp_rocket_installed(): bool {
		wp_clean_plugins_cache();
		$plugins = get_plugins();
		return array_key_exists( self::WR_SLUG, $plugins );
	}

	// WP-Rocket plugin json for entry in one.com plugins
	public function wp_rocket_plugin_info(): array {
		$plugins = onecom_fetch_plugins();

		return array(
			'id'             => count( $plugins ) + 1,
			'name'           => 'WP Rocket',
			'slug'           => 'wp-rocket',
			'description'    => __( 'Speed up your site, improve loading times, and boost your search rankings with one of the most popular performance optimisation plugins.' ),
			'new'            => '1656829808',
			'thumbnail'      => self::WR_ICON,
			'thumbnail_name' => 'thumbnail.svg',
			'redirect'       => 'options-general.php?page=wprocket',
			'type'           => 'external',
		);
	}


	/**
	 * Section 3: Pricing + Features
	 * @return void
	 */
	public function wp_rocket_pricing_table() {
		$wpr_features = [
			__('Page and browser caching', 'onecom-wp'),
			__('GZIP compression', 'onecom-wp'),
			__('Cross-Origin support for web fonts', 'onecom-wp'),
			__('Detection and support of various third-party plugins, themes', 'onecom-wp'),
			__('Combination of inline and 3rd party scripts', 'onecom-wp'),
			__('WooCommerce Refresh Cart Fragments Cache', 'onecom-wp'),
			__('Optimise Google Fonts files', 'onecom-wp'),
			__('Optimise database and emojis', 'onecom-wp'),
		];

		//The default params will be WP_ROCKET
		$wpr_price = $this->get_wpr_price();

		$addon_key = 'WP_ROCKET';
		$has_price = (is_array($wpr_price) && isset($wpr_price['success']) && $wpr_price['success'] && isset($wpr_price[$addon_key]) && is_array($wpr_price[$addon_key]));
		$priceInclVat = $has_price ? $wpr_price[$addon_key]['fullPriceInclVat'] : '';
		$currencySymbol = $has_price ? $wpr_price[$addon_key]['currency'] : '';
		?>
		<section class="gv-product-table gv-features-table gv-products-1 gv-area-table">
			<div class="gv-table-container">
				<div class="gv-table" role="table">
					<div class="gv-table-header" role="rowgroup">
						<div class="gv-table-row" role="row">
							<div class="gv-product" role="columnheader">
								<div class="gv-content wpr-pricing-content">
									<h3 class="gv-title"><?php echo __('WP Rocket add-on', 'onecom-wp'); ?></h3>
									<p class="gv-text-on-alternative gv-text-md"><?php echo __('The most powerful web performance plugin in the world', 'onecom-wp'); ?></p>
								</div>
								<?php
								//Select for addon purchase
								if(!$this->is_wp_rocket_addon_purchased()){?>
   						<div class="gv-bottom wpr-pricing">
   						<div class="gv-price-container">
   							<?php if ($has_price): ?>
   								<div class="gv-price">
   									<span class="gv-price-text"><?php echo __("$currencySymbol $priceInclVat,-", 'onecom-wp'); ?></span>
   									<span class="gv-period"><?php echo __('/mo', 'onecom-wp'); ?></span>
   								</div>
   								<span class="gv-caption-lg gv-text-on-alternative">
   									<?php echo __("1year [$priceInclVat]/mo.", 'onecom-wp'); ?>
   								</span>
   							<?php endif; ?>
   						</div>

   						<a href="<?php echo OC_WPR_BUY_URL; ?>" target="_blank" class="gv-button gv-button-secondary ocwp_ocpc_wpr_get_wp_rocket_cta_clicked_event get-wpr-btn">
										<?php echo __('Select', 'onecom-wp'); ?>
										<img src="<?php echo ONECOM_WP_URL . "modules/wp-rocket/assets/images/new-tab.svg";?>" height="17px" width="17px" class="gv-pl-xs" />
									</a>
								</div>
								<?php } ?>
								<?php
								//Go to wp-rocket plugin
								if($this->is_wp_rocket_active() && $this->is_wp_rocket_addon_purchased()){
									?>
									<div class="gv-bottom wpr-pricing">
										<a class="gv-button gv-button-secondary goto-wpr wpr-btn" href="<?php echo admin_url( 'options-general.php?page=wprocket' ); ?>">
											<?php echo __('Go to WP Rocket plugin', 'onecom-wp'); ?>
										</a>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="gv-section" role="rowgroup">
						<div class="gv-section-header gv-table-row" role="row">
							<div class="gv-cell" role="cell">
								<h4 class="gv-title"><?php echo __('Key features', 'onecom-wp'); ?></h4>
							</div>
						</div>
						<?php foreach ($wpr_features as $key => $wpr_feature) : ?>
							<div class="gv-table-row" role="row">
								<div class="gv-cell" role="cell">
									<span class="gv-cell-text"><?php echo __($wpr_feature, 'onecom-wp'); ?></span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	/**
	 * Displays a success notification for WP Rocket activation.
	 *
	 * @return void
	 */
	public function get_wpr_success_notice() {
		?>
		<!-- Notice success -->
		<div class="gv-notice gv-notice-success gv-p-lg gv-max-mob-pt-lg gv-mb-0 gv-mt-lg wpr-notice gv-hidden">
			<img class="gv-notice-icon" src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/success.svg" />
			<div class="gv-notice-content">
				<div class="gv-notice-title"><?php echo __('WP Rocket activated', 'onecom-wp');?></div>
				<p><?php echo __('WP Rocket was successfully activated on this installation.', 'onecom-wp');?></p>
			</div>
			<a href="<?php echo admin_url( 'options-general.php?page=wprocket' ); ?>"
			   class="gv-action gv-button gv-button-neutral"><?php echo __( 'Go to WP Rocket plugin', 'onecom-wp' ); ?></a>
			<button class="gv-notice-close">
				<img src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/close.svg" height="24px" width="24px" />
			</button>
		</div>
		<!-- Notice success End -->
		<?php
	}

	/**
	 * Displays an error notice when the WP Rocket plugin activation fails.
	 *
	 * @return void
	 */
	public function get_wpr_error_notice() {
		?>
		<!-- Notice error -->
		<div class="gv-notice gv-notice-alert gv-p-lg gv-max-mob-pt-lg gv-mb-0 gv-mt-lg wpr-notice gv-hidden">
			<img class="gv-notice-icon" src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/error.svg" />
			<div class="gv-notice-content">
				<div class="gv-notice-title"><?php echo __('Oops, something went wrong', 'onecom-wp');?></div>
				<p><?php echo __("Unfortunately, we were unable to activate the WP Rocket plugin. Please try again later or contact support for help.", 'onecom-wp')?></p>
			</div>
			<a href="javascript:void(0)"
			   class="gv-button gv-button-primary ocwp_ocpc_wpr_try_again_clicked_event oc-activate-wp-rocket-btn wpr-try-again"><?php echo __( 'Try again', 'onecom-wp' ); ?></a>
			<a href="https://help.one.com/hc/en-us/requests/new"
			   class="gv-action gv-button ocwp_ocpc_wpr_contact_support_clicked_event" target="_blank"><?php echo __( 'Contact support', 'onecom-wp' ); ?></a>
			<button class="gv-notice-close">
				<img src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/close.svg" height="24px" width="24px" />
			</button>
		</div>
		<!-- Notice error End -->
		<?php
	}

	/**
	 * Displays a notice prompting the user to activate WP Rocket.
	 *
	 * This notification informs the user about their WP Rocket subscription
	 * and encourages them to activate the plugin to enhance site performance.
	 *
	 * @return void
	 */
	public function get_wpr_activate_info() {
		?>
		<!-- Notice Warning -->
		<div class="gv-notice gv-notice-info gv-p-lg gv-max-mob-pt-lg gv-mb-0 gv-mt-lg wpr-notice">
			<img class="gv-notice-icon" src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/info.svg" />
			<div class="gv-notice-content">
				<div class="gv-notice-title"><?php echo __('Activate WP Rocket', 'onecom-wp');?></div>
				<p><?php
					$domain = OCPushStats::get_domain() ?? 'localhost';
					$value = "<strong>$domain</strong>";
					echo sprintf(
						__("You have a WP Rocket subscription for %s, but you still need to activate it for this installation. Activate the plugin to boost your site's performance.", 'onecom-wp'), $value);
					?>
				</p>
			</div>
			<a href="javascript:void(0)"
			   class="gv-button gv-button-neutral ocwp_ocpc_activate_wpr_clicked_event oc-activate-wp-rocket-btn"><?php echo __( 'Activate WP Rocket', 'onecom-wp' ); ?></a>
			<button class="gv-notice-close">
				<img src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/close.svg" height="24px" width="24px" />
			</button>
		</div>
		<!-- Notice Warning End -->
		<?php
	}

	/**
	 * Displays a notice indicating that the WP Rocket activation process is in progress.
	 *
	 * @return void
	 */
	public function get_wpr_in_progress_notice(){
		?>
		<!-- Notice in-progress -->
		<div class="gv-notice gv-notice-warning gv-p-lg gv-max-mob-pt-lg gv-mb-0 gv-hidden gv-mt-lg wpr-notice">
			<img class="gv-notice-icon" src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/warning-orange.svg" />
			<div class="gv-notice-content">
				<div class="gv-notice-title"><?php echo __('Activating may take a few minutes', 'onecom-wp');?></div>
				<p><?php echo __("We will inform you once it’s done. You can keep working and use the dashboard as usual.", 'onecom-wp')?></p>
			</div>
			<a href="javascript:void(0)"
			   class="gv-button gv-button-neutral gv-disabled"><img src="<?php echo ONECOM_WP_URL; ?>modules/wp-rocket/assets/images/spinner2.svg" class="custom-spinner" /><?php echo __( 'Activating', 'onecom-wp' ); ?></a>
		</div>
		<!-- Notice in-progress End -->
		<?php
	}
}