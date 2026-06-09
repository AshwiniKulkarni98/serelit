<?php

namespace WP_Social\Lib\Onboard\Classes;

defined( 'ABSPATH' ) || exit;

class Ajax {

	private $utils;

	public function __construct() {
		add_action( 'wp_ajax_wp_social_admin_action', [ $this, 'wp_social_admin_action' ] );
		add_action( 'wp_ajax_wp_social_onboard_plugins', array( $this, 'wp_social_onboard_plugins' ) );
		$this->utils = Utils::instance();
	}

	public function wp_social_admin_action() {
		// Check for nonce security
		if (!isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_POST['user_data'] ) ) {
			$this->utils->save_option( 'user_data', empty( $_POST['user_data'] ) ? [] : sanitize_text_field(wp_unslash($_POST['user_data'])));
		}

		if ( isset( $_POST['settings'] ) ) {
			//phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- Sanitized using map_deep
			$this->utils->save_settings( map_deep($_POST['settings'],function($data){
				return sanitize_text_field(wp_unslash($data));
			}));
		}


		do_action( 'wpsocial/admin/after_save' );

		$response = array(
			'message' => self::plugin_activate_message( 'setup_configurations' )
		);

		$plugins = !empty($_POST['our_plugins']) && is_array($_POST['our_plugins']) ? $_POST['our_plugins'] : [];
		if($plugins) {
			$total_plugins = count($plugins);
			$total_steps   = 1 + $total_plugins;
			$percentage = ($total_steps > 0) ? (1 / $total_steps) * 100 : 100;
			$percentage = round($percentage);

			$response['progress'] = $percentage;
			$response['plugins'] = $plugins;
		}

		wp_send_json($response);

		wp_die(); // this is required to terminate immediately and return a proper response
	}

	public function wp_social_onboard_plugins() {
		// Check for nonce security
		if (!isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'ajax-nonce' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$plugin_slug = isset( $_POST['plugin_slug'] ) ? sanitize_text_field(wp_unslash($_POST['plugin_slug'])) : '';
		if ( isset( $plugin_slug ) && current_user_can('install_plugins') ) {
			$status = \WP_Social\Lib\Onboard\Classes\Plugin_Installer::single_install_and_activate( $plugin_slug );
			if ( is_wp_error( $status ) ) {
				wp_send_json_error( array( 'status' => false ) );
			} else {
				wp_send_json_success(
					array(
						'message' => self::plugin_activate_message( $plugin_slug )
					)
				);
			}
		}
	}


	public static function plugin_activate_message($plugin_slug) {
		$plugins_message = [
			'setup_configurations' => esc_html__('Setup Configurations', 'wp-social'),
			'elementskit-lite/elementskit-lite.php' => esc_html__('Page Builder Elements Activated', 'wp-social'),
			'getgenie/getgenie.php' => esc_html__('AI Content & SEO Tool Activated', 'wp-social'),
			'shopengine/shopengine.php' => esc_html__('WooCommerce Builder Activated', 'wp-social'),
			'metform/metform.php' => esc_html__('Form Builder Activated', 'wp-social'),
			'emailkit/EmailKit.php' => esc_html__('Email Customizer Activated', 'wp-social'),
			'wp-social/wp-social.php' => esc_html__('Social Integration Activated', 'wp-social'),
			'wp-ultimate-review/wp-ultimate-review.php' => esc_html__('Review Management Activated', 'wp-social'),
			'wp-fundraising-donation/wp-fundraising.php' => esc_html__('Fundraising & Donations', 'wp-social'),
			'gutenkit-blocks-addon/gutenkit-blocks-addon.php' => esc_html__('Page Builder Blocks Activated', 'wp-social'),
			'popup-builder-block/popup-builder-block.php' => esc_html__('Popup Builder Activated', 'wp-social'),
			'table-builder-block/table-builder-block.php' => esc_html__('Table Builder Activated', 'wp-social'),
		];

		if ( array_key_exists( $plugin_slug, $plugins_message ) ) {
			return esc_html( $plugins_message[$plugin_slug] );
		} else {
			return esc_html__( 'Plugin Activated', 'wp-social' );
		}
	}

	public function return_json( $data ) {
		if ( is_array( $data ) || is_object( $data ) ) {
			return json_encode( $data );
		} else {
			return $data;
		}
	}

}