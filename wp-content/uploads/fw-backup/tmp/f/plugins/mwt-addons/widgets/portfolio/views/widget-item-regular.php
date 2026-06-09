<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget Portfolio - regular item layout
 */
?>
<div class="vertical-item gallery-item content-absolute text-center cs">
	<div class="item-media">
		<?php
		$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			the_post_thumbnail('weldo-square');
		?>
		<div class="media-links">
			<a class="abs-link"  href="<?php echo esc_url( get_permalink() ); ?>"></a>
		</div>
	</div>
</div>