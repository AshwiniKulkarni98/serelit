<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget Posts - title item layout
 */

//wrapping in div for carousel layout
?>
<div class="widget_portfolio-item">
	<div class="vertical-item gallery-title-item">
		<?php if ( get_the_post_thumbnail() ) : ?>
			<div class="item-media">
				<?php
				$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				echo get_the_post_thumbnail();
				?>
				<div class="media-links">
					<div class="links-wrap">
						<a class="link-zoom photoswipe-link"
						   href="<?php echo esc_attr( $full_image_src ); ?>"></a>
					</div>
				</div>
			</div>
		<?php endif; //eof thumbnail check ?>
	</div>
	<div class="item-title text-center">
		<h6>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
		<div class="cat-links">
			<?php
			echo get_the_term_list( get_the_ID(), 'category', '', ' ', '' );
			?>
		</div>
	</div><!-- eof vertical-item -->
</div><!-- eof widget item -->