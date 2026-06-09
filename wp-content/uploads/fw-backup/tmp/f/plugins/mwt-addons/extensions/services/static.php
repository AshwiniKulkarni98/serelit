<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {

	/**
	 * @var FW_Extension_Services $services
	 */
	$services = fw()->extensions->get( 'services' );

	//put your addition static assets here
}



