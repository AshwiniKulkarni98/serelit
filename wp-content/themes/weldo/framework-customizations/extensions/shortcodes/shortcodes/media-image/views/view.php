<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

if ( empty( $atts['image'] ) ) {
	return;
}

$width  = ( is_numeric( $atts['width'] ) && ( $atts['width'] > 0 ) ) ? $atts['width'] : '';
$height = ( is_numeric( $atts['height'] ) && ( $atts['height'] > 0 ) ) ? $atts['height'] : '';

if ( ! empty( $width ) && ! empty( $height ) ) {
	$image = fw_resize( $atts['image']['attachment_id'], $width, $height, true );
	if  ( !empty($atts['image2']) ) {
		$image2 = fw_resize( $atts['image2']['attachment_id'], $width, $height, true );
	}
} else {
	$image = $atts['image']['url'];
	if  ( !empty($atts['image2']) ) {
		$image2 = $atts['image2']['url'];
	}
}

$alt = get_post_meta($atts['image']['attachment_id'], '_wp_attachment_image_alt', true);

$img_attributes = array(
	'src' => $image,
	'alt' => $alt ? $alt : $image
);

if  ( !empty($atts['image2']) ) {
	$img_attributes2 = array(
		'class' => 'image-back',
		'src'   => $image2,
		'alt'   => $alt ? $alt : $image,
	);

	if(!empty($width)){
		$img_attributes2['width'] = $width;
	}

	if(!empty($height)){
		$img_attributes2['height'] = $height;
	}
}

if(!empty($width)){
	$img_attributes['width'] = $width;
}

if(!empty($height)){
	$img_attributes['height'] = $height;
}

if ( empty( $atts['link']  ) ) {
	if ( ! empty( $atts['image_layout'] && $atts['image2'] ) )  {
		if ( $atts['image_layout'] == 'img-right' || $atts['image_layout'] == 'img-left' ) {
			echo '<div class="images-wrap-item  ' . $atts['image_layout'] . ' ' . $atts['class'] . ' " >';
		}
		echo fw_html_tag('img', $img_attributes);
		if ( $atts['image_layout'] == 'img-right' || $atts['image_layout'] == 'img-left' ) {
			echo fw_html_tag('img', $img_attributes2);
		}
		if ( $atts['image_layout'] == 'img-right' || $atts['image_layout'] == 'img-left' ) {
			echo '</div >';
		}
	} else {
		echo fw_html_tag('img', $img_attributes);
	}

} else {
	if ( ! empty( $atts['image_layout'] && $atts['image2'] ) )  {
		if ( $atts['image_layout'] == 'img-right' || $atts['image_layout'] == 'img-left' ) {
			echo '<div class="images-wrap-item  ' . $atts['image_layout'] . ' ' . $atts['class'] . ' " >';
		}
		echo '<a href="'.$atts['link'].'" target="'.$atts['target'].'">';
		echo fw_html_tag('img', $img_attributes);
		if ( $atts['image_layout'] == 'img-right' || $atts['image_layout'] == 'img-left' ) {
			echo fw_html_tag('img', $img_attributes2);
		}
		echo '</a>';
		if ( $atts['image_layout'] == 'img-right' || $atts['image_layout'] == 'img-left' ) {
			echo '</div >';

		}
	} else {
		echo fw_html_tag('img', $img_attributes);
	}

}
