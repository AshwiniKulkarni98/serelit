<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Single service loop item layout
 * also using as a default service view in a shortcode
 */

$ext_services_settings = fw()->extensions->get( 'services' )->get_settings();
$taxonomy_name = $ext_services_settings['taxonomy_name'];

$thumbnail = has_post_thumbnail() && $atts['hide_image'] ? 'content-absolute ds' : '';

?>

<div class="service-item vertical-item text-center <?php echo esc_attr( $thumbnail ) ?>">
	<?php if ( has_post_thumbnail() && $atts['hide_image'] )  : ?>
        <div class="item-media">
			<?php the_post_thumbnail('weldo-full-width'); ?>
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
	</div>
</div><!-- eof .teaser -->
