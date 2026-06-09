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

?>

<div class="service-item vertical-item <?php echo esc_attr( $atts['content_padding'] ) ?>">
	<?php if ( has_post_thumbnail( ) && $atts['hide_image'] )  : ?>
		<div class="item-media">
			<?php the_post_thumbnail(); ?>

			<div class="media-links">
				<a class="abs-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
		<?php endif; //has_post_thumbnail ?>
	<div class="item-content">
		<h4 class="step-part">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
		<?php the_excerpt(); ?>
	</div>
</div><!-- eof .teaser -->
