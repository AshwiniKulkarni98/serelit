<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget Portfolio - title item layout
 */

//wrapping in div for carousel layout
?>
<div class="widget_portfolio-item">
	<div class="vertical-item scaled-item gallery-padding hero-bg">
		<div class="item-media">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			the_post_thumbnail('weldo-square');
			?>
			<div class="media-links">
                <a class="abs-link" href="<?php the_permalink(); ?>"></a>
            </div>
		</div>
        <div class="item-content text-center">
            <h5 class="item-meta">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>
        </div>
	</div><!-- eof vertical-item -->
</div><!-- eof widget item -->