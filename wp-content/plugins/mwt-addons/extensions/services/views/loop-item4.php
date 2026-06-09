<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Single service loop item layout
 * also using as a default service view in a shortcode
 */

$ext_services_settings = fw()->extensions->get( 'services' )->get_settings();
$taxonomy_name = $ext_services_settings['taxonomy_name'];

$icon_array = fw_ext_services_get_icon_array();
$bg_class = ! empty( $atts['content_padding'] ) ? 'hero-bg' : '';
?>

<div class="service-item vertical-item text-center <?php echo esc_attr( $atts['content_padding'] . ' ' . $bg_class ) ?>">
	<div class="item-content">
        <?php if ( $icon_array['icon_type'] && $atts['hide_image'] )  : ?>
            <a href="<?php the_permalink(); ?>">
                <div class="icon-styled color-main fs-60">
                    <?php echo wp_kses_post( $icon_array['icon_html'] ); ?>
                </div>
            </a>
        <?php endif; //has_post_thumbnail ?>
		<h6 class="step-part">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
	</div>
</div><!-- eof .teaser -->
