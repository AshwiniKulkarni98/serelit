<?php
/**
 * The template for default displaying portfolio taxonomy
 */
get_header();
//no columns on this page - giving true as a parameter to get column classes function
$column_classes = fw_ext_extension_get_columns_classes( true );

//getting taxonomy name
$ext_team_settings = fw()->extensions->get( 'team' )->get_settings();
$taxonomy_name = $ext_team_settings['taxonomy_name'];

$categories = fw_ext_extension_get_listing_categories( array(), 'team' );
global $wp_query;
$sort_classes = fw_ext_extension_get_sort_classes( $wp_query->posts, $categories, '', 'team' );

$unique_id = uniqid();
?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		if ( count( $categories ) > 1 ) : ?>
			<div class="filters isotope_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
				<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'mwt' ); ?></a>
				<?php foreach ( $categories as $category ) : ?>
					<a href="#"
					   data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endforeach; ?>
			</div><!-- eof isotope_filters -->
		<?php endif; //count subcategories check ?>
		<?php if ( have_posts() ) : ?>
			<div class="isotope-wrapper isotope row masonry-layout"
				<?php if ( count( $categories ) > 1 ) { ?>
					data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>"
				<?php } ?>
			>
				<?php
				while ( have_posts() ) : the_post();

					?>
					<div
						class="isotope-item col-lg-4 col-md-6 col-sm-12 <?php echo esc_attr( $sort_classes[get_the_ID()] ); ?>">
						<?php
						include( fw()->extensions->get( 'team' )->locate_view_path( 'loop-item' ) );
						?>
					</div>
				<?php endwhile; ?>
			</div><!-- eof isotope-wrapper -->
			<?php
		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		<?php // Pagination.
			$pagination = paginate_links( array(
				'prev_text' => __( 'Prev', 'mwt' ),
				'next_text' => __( 'Next', 'mwt' ),
				'type'      => 'list',
			));
			if ($pagination) {
				echo '<nav class="pagination-nav">' . wp_kses_post( str_replace( 'page-numbers', 'page-numbers pagination', $pagination ) ) . '</nav>';
			}
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