<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget Posts - regular item layout
 */

//has thumbnail layout
if ( get_the_post_thumbnail() ) :
	?>
	<div class="vertical-item item-gallery content-absolute text-center cs">
		<div class="item-media">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			echo get_the_post_thumbnail();
			?>
			<div class="media-links">
				<a class="abs-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
		<div class="item-content">
			<h6 class="item-meta">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h6>
		</div>
	</div>
	<?php
//no featured image
else :
	?>
	<div class="vertical-item item-no-image text-center display_table">
		<div class="item-content display_table_cell">
			<h6 class="item-meta">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h6>
		</div>
	</div>
	<?php
endif;
?>