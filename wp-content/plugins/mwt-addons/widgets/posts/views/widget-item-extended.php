<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Widget posts - extended item layout
 */

//wrapping in div for carousel layout
?>
<div class="vertical-item">
	<?php if ( get_the_post_thumbnail() ) : ?>
		<div class="item-media">
			<?php echo get_the_post_thumbnail(); ?>
			<div class="media-links">
				<a class="abs-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
	<?php endif; //eof thumbnail check ?>
	<div class="item-content">
		<h6 class="item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
		<?php if ( get_the_term_list( get_the_ID(), 'category', '', ' ',
			'' )
		) : ?>
			<div class="cat-links">
				<?php
				echo get_the_term_list( get_the_ID(), 'category', '', ' ', '' );
				?>
			</div>
		<?php endif; //terms check ?>
		<?php the_excerpt(); ?>
	</div>

</div><!-- eof vertical-item -->
