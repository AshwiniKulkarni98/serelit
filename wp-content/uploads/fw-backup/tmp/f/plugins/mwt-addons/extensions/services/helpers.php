<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

function fw_ext_services_get_icon( $post_id = 0 ) {
	if ( 0 === $post_id && null === ( $post_id = get_the_ID() ) ) {
		return array();
	}

	return fw_get_db_post_option($post_id, 'service_icon', array());
}

function fw_ext_services_get_icon_array() {
	$icon_array = fw_ext_services_get_icon();
	$icon_html  = '';
	$icon_type = false;
	if ( $icon_array['type'] === 'icon-font' ) {
		if($icon_array['icon-class'] !== '') {
			$icon_html = '<i class="' . $icon_array['icon-class'] . '"></i>';
			$icon_type = 'icon';
		}
	} elseif ($icon_array['type'] === 'custom-upload') {
		$icon_html = '<img src="' . $icon_array['url'] . '" alt="' . esc_html__( 'Icon', 'mwt' ) .'">';
		$icon_type = 'image';
	}
	return array(
		'icon_html' => $icon_html,
		'icon_type' => $icon_type,
	);

}
