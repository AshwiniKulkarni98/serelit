<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( empty( $atts['image'] ) ) {
	$image = fw_get_framework_directory_uri( '/static/img/no-image.png' );
} else {
	$image = $atts['image']['url'];
}
$shortcodes_extension = fw()->extensions->get( 'shortcodes' );
?>

<div class="card-bio <?php echo esc_attr( trim( $atts['background_color'] ) ); ?>">
	<div class="media">
		<div class="media-left">
			<?php if ( ! empty( $atts['image'] ) ) : ?>
			<img class="<?php echo esc_attr( $atts['rounded_image'] ); ?>" src="<?php echo esc_url( $atts['image']['url'] ); ?>"
				 alt="<?php echo esc_attr($atts['name']); ?>">
			<?php endif; //image ?>
		</div>
		<div class="media-body">
			<?php if ( ! empty( $atts['name'] ) ) : ?>
				<h6><?php echo wp_kses_post( $atts['name'] ); ?></h6>
			<?php endif; //name ?>
			<?php if ( ! empty( $atts['position'] ) ) : ?>
				<p class="position"><?php echo wp_kses_post( $atts['position'] ); ?></p>
			<?php endif; //position ?>
			<?php if ( ! empty( $atts['desc'] ) ) : ?>
				<p><?php echo wp_kses_post( $atts['desc'] ); ?></p>
			<?php endif; //desc ?>
			<?php if ( ! empty( $atts['icons'] ) ) : ?>
				<div>
					<?php
					if ( ! empty( $shortcodes_extension ) ) {
						echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_list' )->render( array( 'icons' => $atts['icons'] ) );
					}
					?>
				</div><!-- eof icons -->
			<?php endif; //icons ?>
		</div><!-- media-body -->
	</div>

</div><!-- .team-member -->
