<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $atts
 * @var array $posts
 */


$lg_class = '';
switch ( $atts['responsive_lg'] ) :
	case ( 1 ) :
		$lg_class = 'col-lg-12';
		break;

	case ( 2 ) :
		$lg_class = 'col-lg-6';
		break;

	case ( 3 ) :
		$lg_class = 'col-lg-4';
		break;

	case ( 4 ) :
		$lg_class = 'col-lg-3';
		break;
	default:
		$lg_class = 'col-lg-2';
endswitch;

$md_class = '';
switch ( $atts['responsive_md'] ) :
	case ( 1 ) :
		$md_class = 'col-md-12';
		break;

	case ( 2 ) :
		$md_class = 'col-md-6';
		break;

	case ( 3 ) :
		$md_class = 'col-md-4';
		break;

	case ( 4 ) :
		$md_class = 'col-md-3';
		break;
	default:
		$md_class = 'col-md-2';
endswitch;

$sm_class = '';
switch ( $atts['responsive_sm'] ) :
	case ( 1 ) :
		$sm_class = 'col-sm-12';
		break;

	case ( 2 ) :
		$sm_class = 'col-sm-6';
		break;

	case ( 3 ) :
		$sm_class = 'col-sm-4';
		break;

	case ( 4 ) :
		$sm_class = 'col-sm-3';
		break;
	default:
		$sm_class = 'col-sm-2';
endswitch;

$xs_class = '';
switch ( $atts['responsive_xs'] ) :
	case ( 1 ) :
		$xs_class = 'col-xs-12';
		break;

	case ( 2 ) :
		$xs_class = 'col-xs-6';
		break;

	case ( 3 ) :
		$xs_class = 'col-xs-4';
		break;

	case ( 4 ) :
		$xs_class = 'col-xs-3';
		break;
	default:
		$xs_class = 'col-xs-2';
endswitch;

$margin_class = '';
$columns_class = '';
switch ( $atts['margin'] ) :
	case ( 0 ) :
		$margin_class = 'c-gutter-0';
		$columns_class = 'c-mb-0';
		break;

	case ( 1 ) :
		$margin_class = 'c-gutter-1';
		$columns_class = 'c-mb-1';
		break;

	case ( 2 ) :
		$margin_class = 'c-gutter-2';
		$columns_class = 'c-mb-2';
		break;

	case ( 10 ) :
		$margin_class = 'c-gutter-5';
		$columns_class = 'c-mb-5';
		break;
	default:
		$margin_class = 'c-gutter-15';
		$columns_class = 'c-mb-15';
endswitch;

$unique_id = uniqid();

//getting subcategories for filters
$subcategories = get_term_children( $queried_object->term_taxonomy_id, $queried_object->taxonomy );

if ( $atts['show_filters'] ) :
	$categories = array();
	// Start the Loop.
	while ( have_posts() ) : the_post();
		$project_categories = get_the_terms( get_the_ID(), $queried_object->taxonomy );
		foreach ( $project_categories as $category ) :
			if ( in_array( $category->term_id, $subcategories ) ) :
				$categories[] = $category;
			endif;
		endforeach;
	endwhile;
	wp_reset_postdata();

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
	?>
<?php endif; //show filters check ?>
<div class="isotope-wrapper isotope row masonry-layout <?php echo esc_attr( $margin_class . ' ' . $columns_class ); ?>"
	 data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>">
	<?php while ( have_posts() ) : the_post();
		$post_terms       = get_the_terms( get_the_ID(), $queried_object->taxonomy );
		$post_terms_class = '';
		if ( ! empty ( $post_terms ) ) :
			foreach ( $post_terms as $post_term ) :
				$post_terms_class .= $post_term->slug . ' ';
			endforeach;
		endif;
		?>
		<div
			class="isotope-item <?php echo esc_attr( 'item-layout-' . $atts['item_layout'] . ' ' . $lg_class . ' ' . $md_class . ' ' . $sm_class . ' ' . $xs_class . ' ' . $post_terms_class ); ?>">
			<?php
			//include item layout view file
			if ( has_post_thumbnail() ) {
				include( fw()->extensions->get( 'portfolio' )->locate_view_path( esc_attr( $atts['item_layout'] ) ) );
			} else {
				include( fw()->extensions->get( 'portfolio' )->locate_view_path( 'item-extended' ) );
			}
			?>
		</div>
	<?php endwhile; ?>
</div><!-- eof .isotope-wrapper -->
