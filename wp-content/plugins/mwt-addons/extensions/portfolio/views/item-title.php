<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget Portfolio - title item layout
 */

//wrapping in div for carousel layout
?>
<div class="widget_portfolio-item">
	<div class="vertical-item gallery-title-item content-absolute">
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
	</div>
	<div class="item-title text-center">
		<h5 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>
		<div class="mb-0">
			<?php if ( function_exists( 'weldo_the_excerpt' ) ) {
				weldo_the_categories( array(
					'items_separator' => ' ',
				) );
			}
			?>
		</div>
	</div><!-- eof vertical-item -->
</div><!-- eof widget item -->