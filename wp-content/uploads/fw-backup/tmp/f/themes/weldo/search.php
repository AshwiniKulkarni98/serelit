<?php
/**
 * The template for displaying Search Results pages
 */

get_header();
$column_classes = weldo_get_columns_classes(); ?>
	<div id="content"
		 class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<div class="widget widget_search mb-60">
			<?php get_search_form(); ?>
		</div>
		<?php
		if ( have_posts() ) :
			$css_classes = 'search-item post hero-bg p-40';
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>
				<article
						id="post-<?php the_ID(); ?>" <?php post_class( $css_classes ); ?>>
					<?php
					//excerpt with Unyson for pages
					if ( 'page' === get_post_type() ) { ?>
						<div class="entry-summary">
							<?php
							the_title( '<h3><a href="'
							           . esc_url( get_permalink() )
							           . '" rel="bookmark">', '</a></h3>' );
							if ( weldo_get_excerpt_for_page_with_unyson_builder() ) : ?>
								<?php echo wp_kses_post( weldo_get_excerpt_for_page_with_unyson_builder() ); ?>
							<?php endif; ?>
						</div><!-- .entry-summary -->
						<?php
						//other post types
					} else {
						?>
						<div class="entry-summary">
							<?php
							the_title( '<h3><a href="'
							           . esc_url( get_permalink() )
							           . '" rel="bookmark">', '</a></h3>' );
							the_excerpt();
							?>
						</div><!-- .entry-summary -->
					<?php } ?>
				</article> <!-- #post-## -->
			<?php endwhile;
			// Previous/next post navigation.
			the_posts_pagination( weldo_get_default_pagination_args_array() );
		else :
			// If no content, include the "No posts found" template.
			esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
				'weldo' );

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