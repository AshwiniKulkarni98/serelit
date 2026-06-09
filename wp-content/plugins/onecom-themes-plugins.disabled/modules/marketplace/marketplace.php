<?php

// Exit if file accessed directly.
defined('WPINC') or die(); // No Direct Access

/**
 * The core plugin class that is used to define functions,
 * admin-specific hooks, and public-facing site hooks.
 */

// WP Rocket buy CP purchase URL
if ( ! defined( 'OC_WPR_BUY_URL' ) ) {
	$domain        = $_SERVER['ONECOM_DOMAIN_NAME'] ?? '';
	define( 'OC_WPR_BUY_URL', sprintf( "https://one.com/admin/wprocket-prepare-buy.do?directToDomainAfterPurchase=%s&amp;domain=%s", OC_HTTP_HOST, $domain ) );
}

// Rank Math buys CP purchase URL
if ( ! defined( 'OC_RM_PRO_BUY_URL' ) ) {
	$domain        = $_SERVER['ONECOM_DOMAIN_NAME'] ?? '';
	define( 'OC_RM_PRO_BUY_URL', sprintf( "https://one.com/admin/rankmath-prepare-buy.do?directToDomainAfterPurchase=%s&amp;domain=%s", OC_HTTP_HOST, $domain ) );
}

if( !defined( 'MARKETPLACE_PAGE_SLUG' ) ) {
	define( 'MARKETPLACE_PAGE_SLUG' , 'onecom-marketplace' );
}

if( !defined( 'MARKETPLACE_PRODUCTS_PAGE_SLUG' ) ) {
	define( 'MARKETPLACE_PRODUCTS_PAGE_SLUG' , 'onecom-marketplace-products' );
}

require_once plugin_dir_path(__FILE__) . 'classes/class-marketplace.php';

// Load WP-Rocket
if (class_exists('OnecomMarketplace')) {
	$mp_object = new OnecomMarketplace();
	$mp_object->init();
}

require_once plugin_dir_path(__FILE__) . 'classes/class-marketplace-admin-survey.php';

if (class_exists('Marketplace_Admin_Survey')) {
	new Marketplace_Admin_Survey();
}
