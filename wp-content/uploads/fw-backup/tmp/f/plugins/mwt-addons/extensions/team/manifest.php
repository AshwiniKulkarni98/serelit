<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['name']        = __( 'Team', 'mwt' );
$manifest['description'] = __(
	'This extension will add a fully fledged team module that will let you display your team using the built in team pages.', 'mwt'
);
$manifest['version'] = '1.0.0';
$manifest['display'] = true;
$manifest['standalone'] = true;
$manifest['thumbnail'] = 'fa fa-user-o';
