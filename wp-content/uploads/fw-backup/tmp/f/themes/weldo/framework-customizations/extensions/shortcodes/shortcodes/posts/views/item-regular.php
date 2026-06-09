<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - regular item layout
 */

//has thumbnail layout
if ( get_the_post_thumbnail() ) :
	?>
	<article <?php post_class( 'vertical-item item-gallery item-post content-absolute ds ms' ) ?>">
	<div class="item-media">
		<?php
		$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		echo get_the_post_thumbnail();
		?>
		<div class="media-links">
				<a href="<?php echo esc_attr( $full_image_src ); ?>"></a>
		</div>
	</div>
	<div class="item-content">
		<h6 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
	</div>
	</article>
	<?php
//no featured image
else :
	?>
	<article <?php post_class( 'vertical-item gallery-item item-no-image text-center display_table' ) ?>">
	<div class="item-content display_table_cell">
		<h6 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
	</div>
	</article>
	<?php
endif;
?>