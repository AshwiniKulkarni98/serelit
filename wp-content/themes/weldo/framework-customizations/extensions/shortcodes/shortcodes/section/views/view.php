<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$section = weldo_get_section_options( $atts );
$section_overflow_visible_class = ( ! empty( $atts['overflow_visible'] ) ) ? 'overflow-visible' : '';

//if side media layout
$link = $atts['side_media_link'];
$video_side = $atts['side_media_video'];
$video_frame = $video_side ? wp_oembed_get( $video_side ) : false;
if ( $video_side ) {
	$link = $video_side;
}

//video background
$bg_video_data_attr = '';
//load static files only in frontend
if ( ( ! empty( $atts['background_video']['type'] ) && ! is_admin() ) ) {

	weldo_unyson_enqueue_section_video_background_scripts();

	$type = $atts['background_video']['type'];
	$video_url = ( $type == 'video_oembed' ) ? $atts['background_video'][$type]['video'] : $atts['background_video'][$type]['video']['url'];
	$poster = false;
	if( ! empty($atts['background_video'][$type]['poster']['data']['icon']) ) {
		$poster = $atts['background_video'][$type]['poster']['data']['icon'];
	}
	$loop = ( !empty($atts['background_video'][$type]['loop_video']) && $atts['background_video'][$type]['loop_video'] == 'no' ) ? false : true;

	$filetype  = wp_check_filetype( $video_url );
	$filetypes = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype  = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$bg_video_data_attr = 'data-background-options="' . fw_htmlspecialchars( json_encode( array( 'loop' => $loop, 'source' => array( $filetype => $video_url, 'poster' => $poster ) ) ) ) . '"';
	$section['section_class'] .= ' background-video';
}

/* Set section id */
$section_id = ( ! empty( $section['section_id'] ) ) ? $section['section_id']  : 'section-'. $atts['unique_id'];
$section_name = ( ! empty( $atts['section_name'] ) ) ? $atts['section_name'] : $section_id;
?>

<section class="<?php echo esc_attr( trim( $section_overflow_visible_class . ' ' . $section['section_class'] ) ); ?>"
	id="<?php echo esc_attr( $section_id ); ?>"
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
	<?php echo wp_kses_post( $bg_video_data_attr ); ?>
>
	<h6 class="d-none"><?php echo esc_html($section_name); ?></h6>
	<?php
	//one half side image
	if ( ! empty( $atts['side_media_image'] ) ) : ?>
		<div class="cover-image <?php echo ( ! empty( $atts['side_media_position'] ) ) ? esc_attr( 's-cover-' . $atts['side_media_position'] . ' ' . $atts['side_media_size'] ) : '' ; ?>">
			<?php if ( $link ): ?>
			<a href="<?php echo esc_url( $link ); ?>" <?php echo ( !empty( $video_frame ) ) ? ' class="photoswipe-link embed-placeholder" data-iframe="' . esc_attr( $video_frame ) . '"' : '' ?>></a>
			<?php endif; ?>
			<img src="<?php echo esc_attr($atts['side_media_image']['url'] )?>" alt="<?php echo esc_attr( $section_name ); ?>">
		</div>
	<?php
	endif;
	?>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row<?php echo esc_attr( $section['section_row_class_suffix'] ); ?>">
			<?php echo do_shortcode( $content ); ?>
		</div>

	</div>
</section>
