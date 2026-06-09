<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/* Disable rest api */
if ( ! function_exists( 'mwt_remove_api_link_from_header' ) ) :
	//remove <link rel='https://api.w.org/' ... from header for clean validation
	function mwt_remove_api_link_from_header() {
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	}
endif;

if ( ! function_exists( 'mwt_return_memory_size' ) ) :
	/**
	 * print theme requirements page
	 *
	 * @param string $size
	 */
	function mwt_return_memory_size( $size ) {
		$symbol = substr( $size, -1 );
		$return = (int)$size;
		switch ( strtoupper( $symbol ) ) {
			case 'P':
				$return *= 1024;
			case 'T':
				$return *= 1024;
			case 'G':
				$return *= 1024;
			case 'M':
				$return *= 1024;
			case 'K':
				$return *= 1024;
		}
		return $return;
	}
endif;

/* MWT Helpers main class */
class mwt_helpers_info {

	public static function mwt_helpers_styles() {
		wp_enqueue_style( 'mwt-helpers-styles', get_bloginfo( 'url' ) . '/wp-content/plugins/mwt-helpers/assets/css/style.css' );
	}

	public static function mwt_helpers_admin_actions()
	{
		$data = array(
			'capability'   => 'manage_options',
			'page_title'   => esc_html__( 'MWT System Info', 'mwt' ),
			'menu_title'   => esc_html__( 'MWT System Info', 'mwt' )
		);
		add_theme_page(
			$data['page_title'],
			$data['menu_title'],
			$data['capability'],
			'server_info_display',
			array('mwt_helpers_info', 'display_mwt_helpers_page')
		);

	}

	public static function display_mwt_helpers_page() {
		// get globals
		global $wpdb;
		global $wp_version;

		$theme['name']                = wp_get_theme();
		$theme['requirements']        = array(
			'wordpress' => array(
				'min_version' => '4.0',
				/*'max_version' => '100.0.0'*/
			),
			/*'framework'  => array(
				'min_version' => '0.0.0',
				'max_version' => '100.0.0'
			),*/
			/*'extensions' => array(
				'extension_name' => array(
					'min_version' => '0.0.0',
					'max_version' => '100.0.0'
				)
			)*/
		);
		$theme['server_requirements'] = array(
			'server' => array(
				'wp_memory_limit'          => '256M', // use M for MB, G for GB
				'php_version'              => '5.2.4',
				'post_max_size'            => '8M',
				'php_time_limit'           => '1500',
				'php_max_input_vars'       => '4000',
				'suhosin_post_max_vars'    => '3000',
				'suhosin_request_max_vars' => '3000',
				'mysql_version'            => '5.0',
				'max_upload_size'          => '8M',
			),
		);

		$theme_requirements  = $theme['requirements'];
		$server_requirements = $theme['server_requirements']['server'];

		$theme_wp_required_version = $theme_requirements['wordpress']['min_version'];
		if ( version_compare( $wp_version, $theme_wp_required_version, '<=' ) ) {
			$theme_wp_version_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i>' . '<strong>' . $wp_version . '</strong>';
			$theme_wp_version_description_text = '<span class="mwt-error-message">' . esc_html__( "The version of WordPress installed on your site.", "mwt" ) . ' ' . esc_html__( 'We recommend you update WordPress to the latest version. The minimum required version for this theme is:', 'mwt' ) . ' <strong>' . $theme_wp_required_version . '</strong>. <a target="_blank" href="' . esc_url( admin_url( 'update-core.php' ) ) . '">' . esc_html__( 'Do that right now', 'mwt' ) . '</a></span>';
		} else {
			$theme_wp_version_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . $wp_version . '</strong>';
			$theme_wp_version_description_text = esc_html__( "The version of WordPress installed on your site", "mwt" );
		}

		// wp multisite
		if ( is_multisite() ) {
			$theme_multisite_text = '<i class="mwt-no-icon dashicons dashicons-info"></i>' . '<strong>' . esc_html__( 'Yes', 'mwt' ) . '</strong>';
		} else {
			$theme_multisite_text = '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . esc_html__( 'No', 'mwt' ) . '</strong>';
		}

		// wp debug mode
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$theme_debug_url                      = esc_url( 'https://codex.wordpress.org/WP_DEBUG' );
			$theme_wp_debug_mode_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i>' . '<strong>' . esc_html__( 'Yes', 'mwt' ) . '</strong>';
			$theme_wp_debug_mode_description_text = '<span class="mwt-error-message">' . esc_html__( 'Displays whether or not WordPress is in Debug Mode. This mode is used by developers to test the theme. We recommend you turn it off for an optimal user experience on your website.', 'mwt' ) . ' <a href="' . $theme_debug_url . '" target="_blank">' . esc_html__( 'Learn how to do it', 'mwt' ) . '</a></span>';
		} else {
			$theme_wp_debug_mode_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . esc_html__( 'No', 'mwt' ) . '</strong>';
			$theme_wp_debug_mode_description_text = esc_html__( 'Displays whether or not WordPress is in Debug Mode', 'mwt' );
		}

		// wp memory limit
		$theme_memory                       = mwt_return_memory_size( WP_MEMORY_LIMIT );
		$theme_requirements_wp_memory_limit = mwt_return_memory_size( $server_requirements['wp_memory_limit'] );
		if ( $theme_memory < $theme_requirements_wp_memory_limit ) {
			$theme_wp_memory_limit_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i>' . '<strong>' . size_format( $theme_memory ) . '</strong>';
			$theme_wp_memory_limit_description_text = '<span class="mwt-error-message">' . esc_html__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'mwt' ) . ' ' . wp_kses_post( 'We recommend setting memory to at least <strong>256MB</strong>. Please define memory limit in <strong>wp-config.php</strong> file.' ) . ' <a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . esc_html__( 'Learn how to do it', 'mwt' ) . '</a></span>';
		} else {
			$theme_wp_memory_limit_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . size_format( $theme_memory ) . '</strong>';
			$theme_wp_memory_limit_description_text = esc_html__( 'The maximum amount of memory (RAM) that your site can use at one time', 'mwt' );
		}

		// wp active plugins list
		if ( ! function_exists( 'mwt_active_plugins_list' ) ) :
			function mwt_active_plugins_list() {
				$active_plugins = get_option('active_plugins');
				$str = "";
				foreach($active_plugins as $key => $value) {
					$string = explode('/',$value);
					$str .= '<li>'.$string[0] .','.'</li>';
				}
				return '<ul>'. $str .'</ul>';
			}
		endif;

		// php version
		if ( function_exists( 'phpversion' ) ) {
			if ( version_compare( phpversion(), $server_requirements['php_version'], '<=' ) ) {
				$theme_php_version_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . esc_html( phpversion() ) . '</strong>';
				$theme_php_version_description_text = '<span class="mwt-error-message">' . esc_html__( 'The version of PHP installed on your hosting server.', 'mwt' ) . ' ' . esc_html__( 'We recommend you update PHP to the latest version. The minimum required version for this theme is:', 'mwt' ) . ' <strong>' . $server_requirements['php_version'] . '</strong>. ' . esc_html__( 'Contact your hosting provider, they can install it for you.', 'mwt' ) . '</span>';
			} else {
				$theme_php_version_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . esc_html( phpversion() ) . '</strong>';
				$theme_php_version_description_text = esc_html__( 'The version of PHP installed on your hosting server', 'mwt' );
			}
		} else {
			$theme_php_version_text = esc_html__( 'No PHP Installed', 'mwt' );
		}

		// php post max size
		$theme_requirements_post_max_size = mwt_return_memory_size( $server_requirements['post_max_size'] );
		if ( mwt_return_memory_size( ini_get( 'post_max_size' ) ) < $theme_requirements_post_max_size ) {
			$theme_php_post_max_size_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . size_format( mwt_return_memory_size( ini_get( 'post_max_size' ) ) ) . '</strong>';
			$theme_php_post_max_size_description_text = '<span class="mwt-error-message">' . esc_html__( 'The largest file size that can be contained in one post.', 'mwt' ) . ' ' . esc_html__( 'We recommend setting the post maximum size to at least:', 'mwt' ) . ' <strong>' . size_format( $theme_requirements_post_max_size ) . '</strong></span>';
		} else {
			$theme_php_post_max_size_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . size_format( mwt_return_memory_size( ini_get( 'post_max_size' ) ) ) . '</strong>';
			$theme_php_post_max_size_description_text = esc_html__( 'The largest file size that can be contained in one post', 'mwt' );
		}

		// php time limit
		$theme_time_limit              = ini_get( 'max_execution_time' );
		$theme_required_php_time_limit = (int) $server_requirements['php_time_limit'];
		if ( $theme_time_limit < $theme_required_php_time_limit && $theme_time_limit != 0 ) {
			$theme_php_time_limit_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i>' . '<strong>' . $theme_time_limit . '</strong>';
			$theme_php_time_limit_description_text = '<span class="mwt-error-message">' . esc_html__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups).', 'mwt' ) . ' ' . esc_html__( 'We recommend setting the maximum execution time to at least', 'mwt' ) . ' <strong>' . $theme_required_php_time_limit . '</strong>' . '. <a href="https://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank">' . esc_html__( 'Learn how to do it', 'mwt' ) . '</a></span>';
		} else {
			$theme_php_time_limit_description_text = esc_html__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'mwt' );
			$theme_php_time_limit_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . $theme_time_limit . '</strong>';
		}

		// php max input vars
		$theme_max_input_vars      = ini_get( 'max_input_vars' );
		$theme_required_input_vars = $server_requirements['php_max_input_vars'];
		if ( $theme_max_input_vars < $theme_required_input_vars ) {
			$theme_php_max_input_vars_description_text = '<span class="mwt-error-message">' . esc_html__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'mwt' ) . ' ' . esc_html__( 'Please increase the maximum input variables limit to:', 'mwt' ) . ' <strong>' . $theme_required_input_vars . '</strong></span>';
			$theme_php_max_input_vars_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . $theme_max_input_vars . '</strong>';
		} else {
			$theme_php_max_input_vars_description_text = esc_html__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'mwt' );
			$theme_php_max_input_vars_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . $theme_max_input_vars . '</strong>';
		}

		// suhosin
		if ( extension_loaded( 'suhosin' ) ) {
			$theme_suhosin_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . esc_html__( 'Yes', 'mwt' ) . '</strong>';
			$theme_suhosin_description_text = '<span class="mwt-error-message">' . esc_html__( 'Suhosin is an advanced protection system for PHP installations and may need to be configured to increase its data submission limits', 'mwt' ) . '</span>';
			$theme_max_input_vars           = ini_get( 'suhosin.post.max_vars' );
			$theme_required_input_vars      = $server_requirements['suhosin_post_max_vars'];
			if ( $theme_max_input_vars < $theme_required_input_vars ) {
				$theme_suhosin_description_text .= '<span class="mwt-error-message">' . sprintf( __( '%s - Recommended Value is: %s. <a href="%s" target="_blank">Increasing max input vars limit.</a>', 'mwt' ), $theme_max_input_vars, '<strong>' . ( $theme_required_input_vars ) . '</strong>', 'http://docs.themefuse.com/mwt/your-theme/theme-settings/how-to-increase-the-maximum-input-variables-limit' ) . '</span>';
			}
		} else {
			$theme_suhosin_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . esc_html__( 'No', 'mwt' ) . '</strong>';
			$theme_suhosin_description_text = esc_html__( 'Suhosin is an advanced protection system for PHP installations.', 'mwt' );
		}

		// mysql version
		global $wpdb;
		if ( version_compare( $wpdb->db_version(), $server_requirements['mysql_version'], '<=' ) ) {
			$theme_mysql_version_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . $wpdb->db_version() . '</strong>';
			$theme_mysql_version_description_text = '<span class="mwt-error-message">' . esc_html__( 'The version of MySQL installed on your hosting server.', 'mwt' ) . ' ' . esc_html__( 'We recommend you update MySQL to the latest version. The minimum required version for this theme is:', 'mwt' ) . ' <strong>' . $server_requirements['mysql_version'] . '</strong> ' . esc_html__( 'Contact your hosting provider, they can install it for you.', 'mwt' ) . '</span>';
		} else {
			$theme_mysql_version_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . $wpdb->db_version() . '</strong>';
			$theme_mysql_version_description_text = esc_html__( 'The version of MySQL installed on your hosting server', 'mwt' );
		}

		// max upload size
		$theme_requirements_max_upload_size = mwt_return_memory_size( $server_requirements['max_upload_size'] );
		if ( wp_max_upload_size() < $theme_requirements_max_upload_size ) {
			$theme_fie_max_size_url                 = 'http://docs.themefuse.com/mwt/your-theme/theme-settings/how-to-set-a-maximum-file-upload-size';
			$theme_max_upload_size_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . size_format( wp_max_upload_size() ) . '</strong>';
			$theme_max_upload_size_description_text = '<span class="mwt-error-message">' . esc_attr__( 'The largest file size that can be uploaded to your WordPress installation.', 'mwt' ) . ' ' . esc_html__( 'We recommend setting the maximum upload file size to at least:', 'mwt' ) . ' <strong>' . size_format( $theme_requirements_max_upload_size ) . '</strong>. <a href="' . $theme_fie_max_size_url . '" target="_blank">' . esc_html__( 'Learn how to do it', 'mwt' ) . '</a></span>';
		} else {
			$theme_max_upload_size_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . size_format( wp_max_upload_size() ) . '</strong>';
			$theme_max_upload_size_description_text = esc_attr__( 'The largest file size that can be uploaded to your WordPress installation', 'mwt' );
		}

		// fsockopen
		if ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
			$theme_fsockopen_text             = '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . esc_html__( 'Yes', 'mwt' ) . '</strong>';
			$theme_fsockopen_description_text = esc_html__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services', 'mwt' );
		} else {
			$theme_fsockopen_text             = '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . esc_html__( 'No', 'mwt' ) . '</strong>';
			$theme_fsockopen_description_text = '<span class="mwt-error-message">' . wp_kses_post( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services. Your server does not have <strong>fsockopen</strong> or <strong>cURL</strong> enabled thus PayPal IPN and other scripts which communicate with other servers will not work. Contact your hosting provider, they can install it for you.' ) . '</span>';
		}

?>
        <div class="wrap mwt-helpers-wrap">
            <h2 class="mwt-helpers-title"><?php echo esc_html__( 'System Info', 'mwt' ); ?></h2>

            <!--WordPress Environment-->
            <div class="mwt-helpers-box wordpress-environment-box">
                <h3 class="hndle"><?php echo esc_html__( 'WordPress Environment', 'mwt' ); ?></h3>
                <div class="inside">
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
	                        <?php echo esc_html__( 'Home URL', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
	                            <?php echo '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . esc_url( home_url( '/' ) ) . '</strong>'; ?>
                            </div>
                            <div class="input-desc">
	                            <?php echo esc_html__( "The URL of your site's homepage", "mwt" ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Site URL', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo '<i class="mwt-yes-icon dashicons dashicons-yes"></i>' . '<strong>' . esc_url( site_url() ) . '</strong>'; ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( "The root URL of your site", "mwt" ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'WP Version', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
		                        <?php echo wp_kses_post($theme_wp_version_text); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post($theme_wp_version_description_text); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'WP Multisite', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post($theme_multisite_text); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( 'Whether or not you have WordPress Multisite enabled', 'mwt' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'WP Debug Mode', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post($theme_wp_debug_mode_text); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_wp_debug_mode_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'WP Memory Limit', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_wp_memory_limit_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_wp_memory_limit_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Active Theme', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme['name']); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( 'Active theme name', 'mwt' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Active Plugins', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post(mwt_active_plugins_list()); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( 'Active plugins list', 'mwt' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Database Hostname', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo DB_HOST; ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( 'WordPress database hostname', 'mwt' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Database Name', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo DB_NAME; ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( 'WordPress database name', 'mwt' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Database Username', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo DB_USER; ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( 'WordPress database username', 'mwt' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Server Environment-->
            <div class="mwt-helpers-box server-environment-box">
                <h3 class="hndle"><?php echo esc_html__( 'Server Environment', 'mwt' ); ?></h3>
                <div class="inside">
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Operating System', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
	                            <?php echo php_uname('s'); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( "Server operating system", "mwt" ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Server IP', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
	                            <?php echo $_SERVER['SERVER_ADDR']; ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( "Server IP address", "mwt" ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'CGI Version', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
	                            <?php echo $_SERVER['GATEWAY_INTERFACE']; ?>
                            </div>
                            <div class="input-desc">
				                <?php echo esc_html__( "Server CGI version", "mwt" ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
					        <?php echo esc_html__( 'Server Info', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
	                            <?php echo wp_kses_post( '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . esc_html( $_SERVER['SERVER_SOFTWARE'] ) . '</strong>' ); ?>
                            </div>
                            <div class="input-desc">
						        <?php echo esc_html__( "Information about the web server that is currently hosting your site", "mwt" ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'PHP Version', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_php_version_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_php_version_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'PHP Post Max Size', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_php_post_max_size_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_php_post_max_size_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'PHP Time Limit', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_php_time_limit_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_php_time_limit_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'PHP Max Input Vars', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_php_max_input_vars_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_php_max_input_vars_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'SUHOSIN Installed', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_suhosin_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_suhosin_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'ZipArchive', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
	                            <?php echo wp_kses_post( class_exists( 'ZipArchive' ) ? '<i class="mwt-yes-icon dashicons dashicons-yes"></i><strong>' . __( 'Yes', 'mwt' ) . '</strong>' : '<i class="mwt-no-icon dashicons dashicons-info"></i><strong>' . __( 'No', 'mwt' ) . '</strong>' ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( class_exists( 'ZipArchive' ) ? __( 'ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders', 'mwt' ) : '<span class="mwt-error-message">' . __( 'ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'mwt' ) . ' ' . __( 'Contact your hosting provider, they can install it for you.', 'mwt' ) . '</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'MySQL Version', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_mysql_version_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_mysql_version_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'Max Upload Size', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_max_upload_size_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_max_upload_size_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo esc_html__( 'fsockopen/cURL', 'mwt' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                            <div class="input-title">
				                <?php echo wp_kses_post( $theme_fsockopen_text ); ?>
                            </div>
                            <div class="input-desc">
				                <?php echo wp_kses_post( $theme_fsockopen_description_text ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mwt-backend-option">
                        <div class="mwt-backend-option-label">
			                <?php echo wp_kses_post( '<i class="mwt-yes-icon dashicons dashicons-yes"></i><span class="mwt-success-message">' . __( 'Meets minimum requirements', 'mwt' ) . '</span><br><i class="mwt-no-icon dashicons dashicons-info"></i><span class="mwt-error-message">' . __( "We have some improvements to suggest", "mwt" ) . '</span>' ); ?>
                        </div>
                        <div class="mwt-backend-option-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
	}
}

/* Add actions */
add_action( 'after_setup_theme', 'mwt_remove_api_link_from_header' );
add_action( 'admin_head', array('mwt_helpers_info', 'mwt_helpers_styles' ));
add_action( 'admin_menu', array('mwt_helpers_info', 'mwt_helpers_admin_actions' ));