<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {

	/**
	 * @var FW_Extension_Team $team
	 */
	$team = fw()->extensions->get( 'team' );

	//put your addition static assets here
}



