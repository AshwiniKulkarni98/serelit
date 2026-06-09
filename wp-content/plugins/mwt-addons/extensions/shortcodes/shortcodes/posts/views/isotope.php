<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
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
switch ( $atts['margin'] ) :
	case ( 0 ) :
		$margin_class = 'c-gutter-0 c-mb-0';
		break;

	case ( 1 ) :
		$margin_class = 'c-gutter-1 c-mb-1';
		break;

	case ( 2 ) :
		$margin_class = 'c-gutter-2 c-mb-2';
		break;

	case ( 10 ) :
		$margin_class = 'c-gutter-10 c-mb-10';
		break;
	default:
		$margin_class = 'c-gutter-15 c-mb-15';
endswitch;

$unique_id = uniqid();
$additional_class = !empty( $atts['additional_class'] ) ? $atts['additional_class'] : '';

if ( $atts['show_filters'] ) :

	$showing_terms = array();
	foreach ( $posts->posts as $post ) {
		foreach ( get_the_terms( $post->ID, 'category' ) as $post_term ) {
			$showing_terms[ $post_term->term_id ] = $post_term;
		}
	}
	?>
	<div class="filters isotope_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
		<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'weldo' ); ?></a>
		<?php
		foreach ( $showing_terms as $term_key => $term_id ) {
			$current_term = get_term( $term_id, 'category' );
			?>
			<a href="#"
			   data-filter=".<?php echo esc_attr( $current_term->slug ); ?>"><?php echo esc_html( $current_term->name ); ?></a>
			<?php
		}
		?>
	</div>
	<?php
endif; //showfilters check
?>
<div class="isotope-wrapper isotope row masonry-layout <?php echo esc_attr( $margin_class . ' ' . $additional_class ); ?>"
	 data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>">
	<?php while ( $posts->have_posts() ) : $posts->the_post();
		$post_terms       = get_the_terms( get_the_ID(), 'category' );
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
			//include item layout view file. If no thumbnail - layout is always extended
			$filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/posts/views/' . $atts['item_layout'] . '.php';
			if ( ! ( has_post_thumbnail() ) ) {
				$filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/posts/views/item-extended.php';
			} else {
				$filepath = plugin_dir_path( __FILE__ ) . $atts['item_layout'] . '.php';
				if ( ! ( has_post_thumbnail() ) ) {
					$filepath = plugin_dir_path( __FILE__ ) . 'item-extended.php';
				}
				if ( file_exists( $filepath ) ) {
					include( $filepath );
				} else {
					esc_html_e( 'View not found', 'weldo' );
				}
			}
			?>
		</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); // reset the query ?>
</div><!-- eof .isotope-wrapper -->
