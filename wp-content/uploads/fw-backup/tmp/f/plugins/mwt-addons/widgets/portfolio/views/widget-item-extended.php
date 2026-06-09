<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget Portfolio - extended item layout
 */

//wrapping in div for carousel layout
?>
<div class="vertical-item text-center">
	<div class="item-media">
		<?php
		$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		if ( function_exists( 'weldo_post_thumbnail' ) ) :
			weldo_post_thumbnail();
		else :
			the_post_thumbnail();
		endif;
		?>
		<div class="media-links">
			<a class="abs-link" href="<?php the_permalink(); ?>"></a>
		</div>
	</div>
	<div class="item-content">
		<h5 class="item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>
		<div class="cat-links">
			<?php
			echo get_the_term_list( get_the_ID(), 'fw-portfolio-category', '', ' ', '' );
			?>
		</div>
		<div>
			<?php
			if ( function_exists( 'weldo_the_excerpt' ) ) {
				weldo_the_excerpt(
					array(
						'length' => 20,
						'more' => '',
					) );
			} else {
				the_excerpt();
			}
			?>
		</div>

	</div>
</div><!-- eof vertical-item -->
