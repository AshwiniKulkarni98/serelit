<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 *  Portfolio - regular item layout
 */
?>
<div class="vertical-item item-gallery content-absolute text-center ds ms">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="item-media">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			the_post_thumbnail('weldo-square');
			?>
			<div class="media-links">
				<div class="links-wrap">
					<a class="link-zoom photoswipe-link"
					   href="<?php echo esc_attr( $full_image_src ); ?>"></a>
				</div>
			</div>
		</div>
	<?php endif; //has_post_thumbnail ?>
	<div class="item-content gradientdarken-background">
		<h6 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
	</div>
</div>