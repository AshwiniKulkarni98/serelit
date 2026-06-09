<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( empty( $atts['image'] ) ) {
	$image = fw_get_framework_directory_uri( '/static/img/no-image.png' );
} else {
	$image = $atts['image']['url'];
}
?>
<div class="vertical-item box-shadow content-padding text-center team-member">
    <div class="item-media">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $atts['name'] ); ?>"/>
    </div>
	<div class="item-content">
    <?php if ( ! empty( $atts['name'] ) ) : ?>
        <h4><?php echo wp_kses_post( $atts['name'] ); ?></h4>
    <?php endif; //name ?>
    <?php if ( ! empty( $atts['job'] ) ) : ?>
		<p class="small-text color-main"><?php echo wp_kses_post( $atts['job'] ); ?></p>
    <?php endif; //job ?>
    <?php if ( ! empty( $atts['desc'] ) ) : ?>
        <p><?php echo wp_kses_post( $atts['desc'] ); ?></p>
    <?php endif; //desc ?>
    <?php if ( ! empty( $atts['social_icons'] ) ) : ?>
        <div class="social-icons">
        <?php
            echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_social' )->render( array( 'social_icons' => $atts['social_icons'] ) );
        ?>
        </div>
    <?php endif; //social icons ?>
	</div><!-- .item-content -->
</div><!-- .team-member -->