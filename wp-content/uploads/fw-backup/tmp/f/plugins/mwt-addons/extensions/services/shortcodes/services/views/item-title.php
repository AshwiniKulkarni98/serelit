<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - title item layout
 */

$terms          = get_the_terms( get_the_ID(), 'category' );
$filter_classes = '';
if( ! empty( $terms ) ) :
	foreach ( $terms as $term ) {
		$filter_classes .= ' filter-' . $term->slug;
	}
endif;

//wrapping in div for carousel layout
?>
<article class="widget_blog-post-item <?php echo esc_attr( $filter_classes ); ?>">
	<div <?php post_class( "vertical-item gallery-title-item" ); ?>>
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
						<a class="link-anchor" href="<?php the_permalink(); ?>"></a>
					</div>
				</div>
			</div>
		<?php endif; //eof thumbnail check ?>
	</div>
	<div class="item-title text-center">
		<h3>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<div class="cat-links">
        <?php
			echo get_the_term_list( get_the_ID(), 'category', '', ' ', '' );
        ?>
		</div>
	</div><!-- eof vertical-item -->
</article><!-- eof blog-post-item -->