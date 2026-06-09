<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - regular item layout
 */

//has thumbnail layout
if ( get_the_post_thumbnail() ) :
	?>
	<article <?php post_class( 'vertical-item gallery-item content-absolute text-center cs' ) ?>">
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
	<div class="item-content">
		<h4 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
	</div>
	</article>
	<?php
//no featured image
else :
	?>
	<article <?php post_class( 'vertical-item gallery-item item-no-image text-center display_table' ) ?>">
	<div class="item-content display_table_cell">
		<h4 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h4>
	</div>
	</article>
	<?php
endif;
?>