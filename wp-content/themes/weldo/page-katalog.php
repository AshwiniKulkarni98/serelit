<?php
/**
 * Template for Katalog page — code-managed uniform image grid.
 *
 * @package Weldo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$column_classes = weldo_get_columns_classes();
?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="item-content entry-content">
					<?php get_template_part( 'template-parts/katalog/katalog-grid' ); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>

<?php
if ( $column_classes['sidebar_class'] ) :
	?>
	<aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
	</aside>
	<?php
endif;

get_footer();
