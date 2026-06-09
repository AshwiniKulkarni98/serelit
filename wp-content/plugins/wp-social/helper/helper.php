<?php

namespace WP_Social\Helper;

defined('ABSPATH') || exit;

class Helper {

	public static function is_true($val1, $val2, $print) {
		return esc_attr($val1 === $val2 ? $print : '');
	}

	public static function sanitize_white_list($val, $def, $white_list) {

		if(in_array($val, $white_list)) {

			return $val;
		}

		return $def;
	}

	public static function get_kses_array(){
		return array(
			'a'                             => array(
				'class'  => array(),
				'href'   => array(),
				'rel'    => array(),
				'title'  => array(),
				'target' => array(),
				'style'  => array(),
				'id'  => array(),
				'onclick'  => array(),
				'data-pid'  => array(),
				'data-uri_hash'  => array(),
				'data-key'  => array(),
				'data-xs-href'  => array(),
			),
			'abbr'                          => array(
				'title' => array(),
			),
			'b'                             => array(
                'class' => array(),
            ),
			'blockquote'                    => array(
				'cite' => array(),
			),
			'cite'                          => array(
				'title' => array(),
			),
			'button'                          => array(
				'data-type' => array(),
				'data-target' => array(),
				'class'  => array(),
			),
			'code'                          => array(),
			'pre'                           => array(),
			'del'                           => array(
				'datetime' => array(),
				'title'    => array(),
			),
			'dd'                            => array(),
			'div'                           => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'dl'                            => array(),
			'dt'                            => array(),
			'em'                            => array(),
			'strong'                        => array(),
			'h1'                            => array(
				'class' => array(),
			),
			'h2'                            => array(
				'class' => array(),
			),
			'h3'                            => array(
				'class' => array(),
			),
			'h4'                            => array(
				'class' => array(),
			),
			'h5'                            => array(
				'class' => array(),
			),
			'h6'                            => array(
				'class' => array(),
			),
			'i'                             => array(
				'class' => array(),
			),
			'img'                           => array(
				'alt'		=> array(),
				'class'		=> array(),
				'height'	=> array(),
				'src'		=> array(),
				'width'		=> array(),
				'style'		=> array(),
				'title'		=> array(),
				'srcset'	=> array(),
				'loading'	=> array(),
				'sizes'		=> array(),
			),
			'figure'                        => array(
				'class'		=> array(),
			),
			'li'                            => array(
				'class' => array(),
			),
			'ol'                            => array(
				'class' => array(),
			),
			'p'                             => array(
				'class' => array(),
			),
			'q'                             => array(
				'cite'  => array(),
				'title' => array(),
			),
			'span'                          => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'iframe'                        => array(
				'width'       => array(),
				'height'      => array(),
				'scrolling'   => array(),
				'frameborder' => array(),
				'allow'       => array(),
				'src'         => array(),
			),
			'strike'                        => array(),
			'br'                            => array(),
			'table'                         => array(),
			'thead'                         => array(),
			'tbody'                         => array(),
			'tfoot'                         => array(),
			'tr'                            => array(),
			'th'                            => array(),
			'td'                            => array(),
			'colgroup'                      => array(),
			'col'                           => array(),
			'strong'                        => array(),
			'data-wow-duration'             => array(),
			'data-wow-delay'                => array(),
			'data-wallpaper-options'        => array(),
			'data-stellar-background-ratio' => array(),
			'ul'                            => array(
				'class' => array(),
			),
			'svg'                           => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
                'preserveaspectratio' => true,
			),
			'g'                             => array( 'fill' => true ),
			'title'                         => array( 'title' => true ),
			'path'                          => array(
				'd'    => true,
				'fill' => true,
			),
			'input'							=> array(
				'class'		=> array(), 
				'type'		=> array(), 
				'value'		=> array()
			)
		);
	}

	/**
	 * Display simple success page for TikTok callback
	 */
	public static function tiktok_access_token_display_page_success_message( $access_token ) {
		$counter_settings_url = admin_url('admin.php?page=wslu_counter_setting&tab=wslu_providers');
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>TikTok Connected Successfully</title>
			<style>
				body {
					font-family: Arial, sans-serif;
					background: #f0f0f1;
					margin: 0;
					padding: 40px 20px;
					display: flex;
					justify-content: center;
					align-items: center;
					min-height: 100vh;
				}
				
				.container {
					background: white;
					padding: 40px;
					border-radius: 8px;
					box-shadow: 0 2px 10px rgba(0,0,0,0.1);
					max-width: 600px;
					width: 100%;
					text-align: center;
				}
				
				h1 {
					color: #2c3e50;
					margin-bottom: 10px;
					font-size: 24px;
				}
				
				.subtitle {
					color: #666;
					margin-bottom: 30px;
					font-size: 16px;
				}
				
				.token-box {
					background: #f8f9fa;
					border: 1px solid #dee2e6;
					border-radius: 6px;
					padding: 20px;
					margin: 20px 0;
					text-align: left;
				}
				
				.token-label {
					font-weight: bold;
					color: #333;
					margin-bottom: 10px;
					font-size: 14px;
				}
				
				.token-value {
					background: white;
					border: 1px solid #ccc;
					padding: 12px;
					border-radius: 4px;
					font-family: monospace;
					font-size: 13px;
					word-break: break-all;
					color: #427EEF;
					position: relative;
				}
				
				.copy-btn {
					position: absolute;
					top: 8px;
					right: 8px;
					background: #427EEF;
					color: white;
					border: none;
					padding: 5px 10px;
					border-radius: 3px;
					font-size: 11px;
					cursor: pointer;
				}
				
				.copy-btn:hover {
					background: #2c5aa0;
				}
				
				.actions {
					margin-top: 30px;
				}
				
				.btn {
					display: inline-block;
					padding: 12px 24px;
					border-radius: 5px;
					text-decoration: none;
					font-weight: 500;
					font-size: 14px;
					border: none;
					cursor: pointer;
				}
				
				.btn-primary {
					background: #427EEF;
					color: white;
				}
				
				.btn-primary:hover {
					background: #2c5aa0;
				}
				
				@media (max-width: 768px) {
					.container {
						padding: 30px 20px;
					}
				}
			</style>
		</head>
		<body>
			<div class="container">
				<h1>TikTok Connected Successfully!</h1>
				<p class="subtitle">Your TikTok account has been connected. Here's your access token:</p>
				
				<div class="token-box">
					<div class="token-label">Access Token:</div>
					<div class="token-value" id="accessToken">
						<?php echo esc_html( $access_token ); ?>
						<button class="copy-btn" onclick="copyToken()">Copy</button>
					</div>
				</div>
				
				<div class="actions">
					<a href="<?php echo esc_url( $counter_settings_url ); ?>" class="btn btn-primary">Go Back to Settings</a>
				</div>
			</div>
			
			<script>
				function copyToken() {
					const tokenElement = document.getElementById('accessToken');
					const tokenText = tokenElement.textContent.replace('Copy', '').trim();
					const copyBtn = document.querySelector('.copy-btn');
					
					// Try modern clipboard API first
					if (navigator.clipboard) {
						navigator.clipboard.writeText(tokenText).then(function() {
							copyBtn.textContent = 'Copied!';
							setTimeout(() => { copyBtn.textContent = 'Copy'; }, 2000);
						});
					} else {
						// Fallback for older browsers
						const textArea = document.createElement('textarea');
						textArea.value = tokenText;
						document.body.appendChild(textArea);
						textArea.select();
						document.execCommand('copy');
						document.body.removeChild(textArea);
						
						copyBtn.textContent = 'Copied!';
						setTimeout(() => { copyBtn.textContent = 'Copy'; }, 2000);
					}
				}
			</script>
		</body>
		</html>
		<?php
	}

	/**
	 * Display simple error page for TikTok callback
	 */
	public static function tiktok_access_token_display_page_error_message() {
		$counter_settings_url = admin_url('admin.php?page=wslu_counter_setting&tab=wslu_providers');
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>TikTok Connection Failed</title>
			<style>
				body {
					font-family: Arial, sans-serif;
					background: #f0f0f1;
					margin: 0;
					padding: 40px 20px;
					display: flex;
					justify-content: center;
					align-items: center;
					min-height: 100vh;
				}
				
				.container {
					background: white;
					padding: 40px;
					border-radius: 8px;
					box-shadow: 0 2px 10px rgba(0,0,0,0.1);
					max-width: 500px;
					width: 100%;
					text-align: center;
				}
				
				h1 {
					color: #d63638;
					margin-bottom: 10px;
					font-size: 24px;
				}
				
				.subtitle {
					color: #666;
					margin-bottom: 20px;
					font-size: 16px;
				}
				
				.error-box {
					background: #fef7f7;
					border: 1px solid #f1a7a7;
					border-radius: 6px;
					padding: 20px;
					margin: 20px 0;
					text-align: left;
				}
				
				.error-title {
					font-weight: bold;
					color: #d63638;
					margin-bottom: 10px;
				}
				
				.error-message {
					color: #666;
					font-size: 14px;
					line-height: 1.5;
				}
				
				.actions {
					margin-top: 30px;
				}
				
				.btn {
					display: inline-block;
					padding: 12px 24px;
					border-radius: 5px;
					text-decoration: none;
					font-weight: 500;
					font-size: 14px;
					border: none;
					cursor: pointer;
				}
				
				.btn-primary {
					background: #427EEF;
					color: white;
				}
				
				.btn-primary:hover {
					background: #2c5aa0;
				}
				
				@media (max-width: 768px) {
					.container {
						padding: 30px 20px;
					}
				}
			</style>
		</head>
		<body>
			<div class="container">
				<h1>Connection Failed</h1>
				<p class="subtitle">Something went wrong while connecting to TikTok.</p>
				
				<div class="error-box">
					<div class="error-title">Error Details:</div>
					<div class="error-message">
						Unable to retrieve access token from TikTok. Please check your app credentials and try again.
					</div>
				</div>
				
				<div class="actions">
					<a href="<?php echo esc_url( $counter_settings_url ); ?>" class="btn btn-primary">Back to Settings</a>
				</div>
			</div>
		</body>
		</html>
		<?php
	}

}
