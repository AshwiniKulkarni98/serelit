<?php

/**
 * TGM Plugin Activation
 */
require_once WELDO_THEME_PATH . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

if (!function_exists('weldo_action_register_required_plugins')) :
	/** @internal */
	function weldo_action_register_required_plugins()
	{
		tgmpa(
			array(
				array(
					'name'             => esc_html__('Unyson', 'weldo'),
					'slug'             => 'unyson',
					'source'   		   => esc_url('http://webdesign-finder.com/remote-demo-content/common-plugins-original/unyson-v2.7.28.zip'),
					'required'         => true,
				),
				array(
					'name'             => esc_html__('MWTemplates Theme Addons', 'weldo'),
					'slug'             => 'mwt-addons',
					'source'           => esc_url('http://webdesign-finder.com/weldo/plugins/mwt-addons.zip'),
					'required'         => true,
					'version'          => '1.2',
				),
				array(
					'name'             => esc_html__('MWT Helpers', 'weldo'),
					'slug'             => 'mwt-helpers',
					'source'           => esc_url('http://webdesign-finder.com/weldo/plugins/mwt-helpers.zip'),
					'required'         => true,
					'version'          => '1.0',
				),
				array(
					'name'             => esc_html__('Widget CSS Classes', 'weldo'),
					'slug'             => 'widget-css-classes',
					'required'         => false,
				),
				array(
					'name'             => esc_html__('MailChimp', 'weldo'),
					'slug'             => 'mailchimp-for-wp',
					'required'         => true,
				),
				array(
					'name'             => esc_html__('Classic Editor', 'weldo'),
					'slug'             => 'classic-editor',
					'required'         => false,
				),
				array(
					'name'             =>  esc_html__('User custom avatar', 'weldo'),
					'slug'             => 'wp-user-avatar',
					'required'         => false,
				),
				array(
					'name'             =>  esc_html__('WooCommerce', 'weldo'),
					'slug'             => 'woocommerce',
					'required'         => false,
				),
				array(
					'name'             =>  esc_html__('Unyson WooComerce Shortcodes', 'weldo'),
					'slug'             => 'uws-unyson-woocommerce-shortcodes',
					'required'         => false,
				),
				array(
					'name'             => esc_html__('Envato Market', 'weldo'),
					'slug'             => 'envato-market',
					'source'           => esc_url('https://envato.github.io/wp-envato-market/dist/envato-market.zip'),
					'required'         => true, // please do not turn to false!
				),
				array(
					'name'             => esc_html__('Snazzy Maps', 'weldo'),
					'slug'             => 'snazzy-maps',
					'source'   		   => esc_url('http://webdesign-finder.com/remote-demo-content/common-plugins-original/plugins/snazzy_maps.zip'),
					'required'         => true,
				),
				array(
					'name'             => esc_html__('Booked', 'weldo'),
					'slug'             => 'booked',
					'source'   		   => esc_url('http://webdesign-finder.com/remote-demo-content/common-plugins-original/plugins/booked.zip'),
					'required'         => false,
				),
				array(
					'name'     		   => esc_html__('Font Awesome', 'weldo'),
					'slug'     		   => 'font-awesome',
					'required' 		   => true,
				),
				array(
					'name'             => esc_html__('User Registration', 'weldo'),
					'slug'             => 'user-registration',
					'required'         => false,
				),
				array(
					'name'             =>  esc_html__('Comment Form Js Validation', 'weldo'),
					'slug'             => 'comment-form-js-validation',
					'required'         => false,
				),
				array(
					'name'             => esc_html__('Contact Form 7', 'weldo'),
					'slug'             => 'contact-form-7',
					'required'         => true,
				),
			),
			array(
				'domain'       => 'weldo',
				'dismissable'  => false,
				'is_automatic' => false
			)
		);
	}
endif;
add_action('tgmpa_register', 'weldo_action_register_required_plugins');
