<?php

// share buttons
if ( ! function_exists( 'weldo_share_this' ) ) :
	/**
	 * Share article through social networks.
	 * bool $only_buttons
	 */
	function weldo_share_this( $only_buttons = false ) {
		if ( function_exists( 'mwt_share_this' ) ) {
			mwt_share_this( $only_buttons );
		}
	} //weldo_share_this()
endif; //function_exists