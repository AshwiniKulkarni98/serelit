<?php
namespace WPMarketplace\Dependencies\Groupone\Marketplace\Models;

/**
 * Handles fetching data from external API.
 */

class MarketplaceModel {
	protected $api_url;

	public function __construct( string $api_url ) {
		$this->api_url = $api_url;
	}

	public function fetch_plugins( array $payload = [] ): array {
		$args = [
			'timeout' => 30,
		];

		if ( ! empty( $payload ) ) {
			$args['body'] = $payload;
		}

		$response = wp_remote_get( $this->api_url, $args );

		if ( is_wp_error( $response ) ) {
			return [];
		}

		$body = wp_remote_retrieve_body( $response );

		// Handle null or empty body to avoid PHP 8.1+ deprecation warning
		if ( empty( $body ) ) {
			return [];
		}

		$data = json_decode( $body, true );
		return is_array( $data ) ? $data : [];
	}
}
