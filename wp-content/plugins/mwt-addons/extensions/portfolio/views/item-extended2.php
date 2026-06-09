<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Portfolio - extended item layout
 */

$portfolio_options = fw_get_db_post_option( get_the_ID() );

//wrapping in div for carousel layout
?>
<div class="vertical-item text-center gallery-padding hero-bg">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="item-media">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			the_post_thumbnail('weldo-square');
			?>
			<div class="media-links">
				<a class="abs-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
	<?php endif; //has_post_thumbnail ?>
	<div class="item-content">
		<h5 class="item-meta">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>
		<?php if ( !empty( $portfolio_options['excerpt'] ) ) : ?>
        <p class="portfolio-excerpt">
            <?php echo wp_kses_post( $portfolio_options['excerpt'] ); ?>
        </p>
		<?php endif;
		if ( function_exists( 'weldo_the_categories' ) ) {
			weldo_the_categories( array(
				'items_separator' => ' ',
			) );
		}
		?>
	</div>
</div><!-- eof vertical-item -->
