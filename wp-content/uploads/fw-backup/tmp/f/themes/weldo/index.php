<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Used for blog page
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

get_header();

$options        = weldo_get_options();
$column_classes = weldo_get_columns_classes(); ?>

    <div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		if ( have_posts() ) :
			if ( $options['blog_layout'] === 'grid' ) :
				?>
				<div class="row isotope-wrapper masonry-layout c-gutter-30 c-mb-30">
			<?php
			endif;

			// Start the Loop.
			while ( have_posts() ) : the_post();

				if ( $options['blog_layout'] === 'grid' ) :
					$isotipe_item_class = $column_classes['sidebar_class'] ? 'col-xl-6 col-lg-12 col-md-6' : 'col-xl-4 col-md-6';
				?>
					<div class="isotope-item <?php echo esc_attr( $isotipe_item_class ); ?>">
				<?php
				endif; //grid
				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				//all post formats except of 'status' , 'quote' , 'aside' and 'link' has
				$format = get_post_format();
				if ( ( $format === 'status' ) || ( $format === 'quote' ) || ( $format === 'link' ) ) :
					get_template_part( 'template-parts/content', $format );
				else:
					get_template_part( 'template-parts/blog/' . esc_attr( $options['blog_layout'] ) . '/content', $format );
				endif; //post_format status and quote

				if ( $options['blog_layout'] === 'grid' ) :
					$isotipe_item_class = $column_classes['sidebar_class'] ? 'col-xl-6 col-lg-12 col-md-6' : 'col-xl-4 col-md-6';
					?>
					</div><!-- .isotope-item -->
				<?php

				endif; //grid
			endwhile;
			if ( $options['blog_layout'] === 'grid' ) :
			?>
				</div><!-- .isotope-wrapper -->
			<?php
			endif;
			// Previous/next post navigation.
			the_posts_pagination( weldo_get_default_pagination_args_array() );
		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</div><!--eof #content -->
<?php if ( $column_classes['sidebar_class'] ): ?>
	<!-- main aside sidebar -->
	<aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
	</aside>
	<!-- eof main aside sidebar -->
<?php
endif;
get_footer();