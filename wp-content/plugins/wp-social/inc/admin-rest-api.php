<?php

defined('ABSPATH') || exit;

require_once( WSLU_LOGIN_PLUGIN . 'lib/composer/vendor/autoload.php' );
require_once( WSLU_LOGIN_PLUGIN . 'helper/helper.php' );

use TikTok\Authentication\Authentication;
use WP_Social\Helper\Helper;

/**
 * Function Name : xs_return_call_back_login_function();
 * Function Details : WP Rest API.
 *
 * @params : void
 *
 * @return : array()
 *
 * @since : 1.0
 */
if(!function_exists('xs_return_call_back_login_function')) {

	function xs_return_call_back_login_function(WP_REST_Request $request) {

		$param = $request['data'];
		$code = $request['code'];
		if(is_null($param)) {
			$typeSocial = '';
		}

		$typeSocial  = $param;
		$socialType  = '';
		$callBackUrl = '';

		require_once(WSLU_LOGIN_PLUGIN . '/inc/admin-create-user.php');
		die();
	}
}

/**
 * wp rest api add action
 */
add_action('rest_api_init', function() {

	//https://dev.finesttheme.com/social/wp-json/wslu-social-login/type/google
	register_rest_route('wslu-social-login', '/type/(?P<data>\w+)/',
		array(
			'methods'  => 'GET',
			'callback' => 'xs_return_call_back_login_function',
			'permission_callback' => '__return_true',
		)
	);


	register_rest_route('wslu/v1', '/check_cache/(?P<type>\w+)/',
		array(
			'methods'  => 'POST',
			'callback' => 'post_check_counter_cache',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route('wslu/v1', '/save_cache/(?P<type>\w+)/',
		array(
			'methods'  => 'POST',
			'callback' => 'post_save_instagram_counter_cache',
			'permission_callback' => '__return_true',
		)
	);

	register_rest_route('wslu-social-counter', '/type/(?P<data>\w+)/',
		array(
			'methods'  => 'GET',
			'callback' => 'xs_return_call_back_counter_function',
			'permission_callback' => '__return_true',
		)
	);
});


if( !function_exists('xs_return_call_back_counter_function') ) {
	function xs_return_call_back_counter_function( WP_REST_Request $request ) {
		
		$data = $request->get_params();
		$client_key = get_option( 'xs_counter_tiktok_app_id' );
		$client_secret = get_option( 'xs_counter_tiktok_app_secret' );
		
		$authentication = new Authentication( array( 
			'client_key' => $client_key, 
			'client_secret' => $client_secret
		));
		
		$redirect_url =  site_url() . '/wp-json/wslu-social-counter/type/tiktok';
		$code = isset( $data['code'] ) ? $data['code'] : '';
		$token_from_code = $authentication->getAccessTokenFromCode( $code, $redirect_url );
		$user_token = isset( $token_from_code['access_token'] ) ? $token_from_code['access_token'] : '';

		// Set proper content type
		header('Content-Type: text/html; charset=UTF-8');
		
		if( $user_token ) {
			Helper::tiktok_access_token_display_page_success_message( $user_token );
		} else {
			Helper::tiktok_access_token_display_page_error_message();
		}
		die();
	}
}


function post_save_instagram_counter_cache(WP_REST_Request $request) {

	if (!current_user_can('manage_options')) {
		return new \WP_Error('rest_forbidden', esc_html__('You do not have permission to perform this action.', 'wp-social'), array('status' => 401));
	}

	$data = $request->get_params();

	$ins = new \WP_Social\Lib\Counter\Instagram_Counter();

	$ins->cache_instagram_return($data['content']['count'], \WP_Social\App\Settings::get_counter_cache_time());

	return array(
		'success' => true,
		'msg'     => 'successfully fetched and cached',
		//'result' => $data,
	);
}


function post_check_counter_cache(WP_REST_Request $request) {

	if (!current_user_can('manage_options')) {
		return new \WP_Error('rest_forbidden', esc_html__('You do not have permission to perform this action.', 'wp-social'), array('status' => 401));
	}

	$data = $request->get_params();

	if($data['type'] == 'instagram') {

		$ins = new \WP_Social\Lib\Counter\Instagram_Counter();

		$ins->load();

		if($ins->cache_expired) {

			return array(
				'msg'     => 'Successfull',
				'expired' => true,
				'unm'     => $ins->user_id,
				'success' => true,
			);
		}


		return array(
			'msg'     => 'Successfull',
			'expired' => false,
			'success' => true,
		);
	}

	return array(
		'msg'     => 'error',
		'success' => false,
	);
}

