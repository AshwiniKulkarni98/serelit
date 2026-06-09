<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$portfolio = fw()->extensions->get( 'portfolio' );
if ( empty( $portfolio ) ) {
	return;
}
/**
 * @var array $atts
 * @var array $posts
 */
$counter = '1';
$unique_id = uniqid();

if ( $atts['show_filters'] ) {
	//get all terms for filter
	$all_categories = array();
	$categories     = array();
	// Start the Loop.
	while ( $posts->have_posts() ) : $posts->the_post();
		$post_categories = get_the_terms( get_the_ID(), 'fw-portfolio-category' );
		if ( ! empty( $post_categories ) ) {
			$all_categories[] = $post_categories;
		}
	endwhile;
	$posts->wp_reset_postdata();
	if ( ! empty( $all_categories ) ) {
		foreach ( $all_categories as $post_categories ) :
			foreach ( $post_categories as $category ) :
				$categories[] = $category;
			endforeach;
		endforeach;
	}
	$categories = array_unique( $categories, SORT_REGULAR );
	if ( count( $categories ) > 1 ) : ?>
        <div class="filters isotope_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
			<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'weldo' ); ?></a>
			<?php foreach ( $categories as $category ) : ?>
                <a href="#"
                   data-filter=".<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
			
			<?php endforeach; ?>
		</div><!-- eof isotope_filters -->
	<?php endif; //count subcategories check
} //count subcategories check
?>

<div class="isotope-wrapper isotope row masonry-layout c-mb-10 c-gutter-10"
     data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>">
	<?php while ( $posts->have_posts() ) : $posts->the_post();
		$post_terms       = get_the_terms( get_the_ID(), 'fw-portfolio-category' );
		$post_terms_class = '';
		if ( ! empty ( $post_terms ) ) :
			foreach ( $post_terms as $post_term ) :
				$post_terms_class .= $post_term->slug . ' ';
			endforeach;
		endif;
		$column_class = ( $counter == 2 || $counter == 7 || $counter == 12 ) ? 'col-lg-4' : 'col-lg-4';
		?>
        <div class="isotope-item <?php echo esc_attr( 'item-layout-tile ' . ' ' . $column_class . ' ' . $post_terms_class ); ?>">
			<?php
			//include item layout view file
			if ( has_post_thumbnail() ) { ?>
                <div class="vertical-item item-gallery content-absolute text-center ds ms">
					<div class="item-media">
						<?php
						$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						if ( $counter == 2 || $counter == 5 || $counter == 6 ) {
							the_post_thumbnail( 'weldo-full-width' );
						} else {
							the_post_thumbnail( 'weldo-service-width' );
						}
						?>
                        <div class="media-links">
							<a class="abs-link" href="<?php the_permalink(); ?>"></a>
						</div>
					</div>
					<div class="item-content">
						<h6 class="fs-30">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h6>
					</div>
				</div>
				<?php
			} else {
				include( fw()->extensions->get( 'portfolio' )->locate_view_path( 'item-extended' ) );
			}
			?>
		</div>
		<?php $counter++;
		if ( $counter === 7) {
			$counter = 1;
		}
		?>
	<?php endwhile; ?>
	<?php //removed reset the query ?>
</div><!-- eof .isotope-wrapper -->
