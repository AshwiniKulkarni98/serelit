<?php

namespace WP_Social\Lib\Provider\Counter;

require_once( WSLU_LOGIN_PLUGIN . 'lib/composer/vendor/autoload.php' );

use TikTok\User\User;
use TikTok\Request\Params;

class Tiktok_Counter extends Counter {

	public static $provider_key = 'tiktok';
	private $global_options;

	/**
	 * If we need to call legacy function
	 * 
	 * @return bool
	 */
	public function need_to_call_legacy_function() {

		return false;
	}

	/**
	 * Get transient key
	 * 
	 * @return string
	 */
	public static function get_transient_key() {

		return '_xs_social_tiktok_count_';
	}

	/**
	 * Get transient timeout key
	 * 
	 * @return string
	 */
	public static function get_transient_timeout_key() {

		return 'timeout_' . self::get_transient_key();
	}

	/**
	 * Get last cache key
	 * 
	 * @return string
	 */
	public static function get_last_cache_key() {

		return '_xs_social_'.self::$provider_key.'_last_cached';
	}

	/**
	 * Set config data
	 * 
	 * @param array $conf_array
	 * 
	 * @return $this
	 */
	public function set_config_data( $conf_array ) {

		$this->global_options = $conf_array;

		return $this;
	}

	/**
	 * Get cached count
	 * 
	 * @return int
	 */
	public function get_cached_count() {

		return $this->get_count( $this->cache_time );
	}

	/**
	 * Get default count
	 * 
	 * @return int
	 */
	public function get_default_fan_count() {

		return empty($this->global_options['data']['value']) ? 0 : $this->global_options['data']['value'];
	}

	/**
	 * Get follwers count from API
	 * 
	 * @param int $global_cache_time
	 * 
	 * @return int
	 */
	public function get_count( $global_cache_time = 43200 ) {

		if( empty( $this->global_options['api'] ) ) {

			// Client does not set up his credential, so just show defaults value
			return empty($this->global_options['data']['value']) ? 0 : $this->global_options['data']['value'];
		}

		$access_token = isset( $this->global_options['api'] ) ? $this->global_options['api'] : '';
		$tran_key = self::get_transient_key( md5( $access_token ) );
		$trans_value = get_transient( $tran_key );
		
		if( false === $trans_value ) {

			$config = array( // instantiation config params
				'access_token' => $access_token
			);
	
			// instantiate the user
			$user = new User( $config );
	
			$params = Params::getFieldsParam(
				array(
					'follower_count', 	// scope user.info.stats
				)
			);
	
			// get user info
			$userInfo = $user->getSelf( $params );
			$followers_count = isset($userInfo['data']['user']['follower_count']) ? $userInfo['data']['user']['follower_count'] : 0;

			//Updating transient cache
			$expiration_time = empty( $global_cache_time ) ? 43200: intval( $global_cache_time );

			set_transient( $tran_key, $followers_count, $expiration_time );
			update_option( self::get_last_cache_key(), time() );
			
		}

		return $trans_value;
	}
}
