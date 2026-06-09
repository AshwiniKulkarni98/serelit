<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

if ( empty( $atts['url'] ) ) {
	return;
}

global $wp_embed;

$iframe = $wp_embed->run_shortcode( '[embed  width="300" height="200"]' . trim( $atts['url'] ) . '[/embed]' );

?>
<div class="fw-video-button">
    <div class="embed-responsive embed-responsive-16by9">
        <a href="#" data-iframe="<?php echo esc_attr( $iframe ) ?>" class="photoswipe-link">
            <i class="ico ico-video-play"></i>
            <?php if ( !empty( $atts['label'] ) ) : ?>
                <p class="video-button-label"><?php echo esc_html( $atts['label'] ) ?></p>
            <?php endif; ?>
        </a>
    </div>
</div>
