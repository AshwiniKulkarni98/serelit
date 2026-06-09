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
switch ( $atts['vertical_margins'] ) :
	case ( 0 ) :
		$margin_class = 'c-mb-0';
		break;

	case ( 1 ) :
		$margin_class = 'c-mb-1';
		break;

	case ( 2 ) :
		$margin_class = 'c-mb-2';
		break;

	case ( 10 ) :
		$margin_class = 'c-mb-10';
		break;

	case ( 40 ) :
		$margin_class = 'c-mb-20 c-mb-lg-40';
		break;

	case ( 45 ) :
		$margin_class = 'c-mb-45';
		break;

	case ( 50 ) :
		$margin_class = 'c-mb-50';
		break;

	case ( 60 ) :
		$margin_class = 'c-mb-40 c-mb-lg-60';
		break;

	default:
		$margin_class = 'c-mb-30';
endswitch;


$unique_id    = uniqid();
$loop_item    = $atts['layout_item'];
$categories   = fw_ext_extension_get_listing_categories( $atts['cat'], 'services' );
$sort_classes = fw_ext_extension_get_sort_classes( $posts -> posts, $categories, '', 'services' );
$gutter       = $atts['gutter_margins'];
$layout       = ! empty( $atts['layout_item'] ) ? $atts['layout_item'] : 1;

if ( $atts['show_filters'] ) : ?>
	<div class="filters isotope_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
		<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'mwt' ); ?></a>
		<?php
		foreach ( $categories as $category ) {
			?>
			<a href="#"
			   data-filter=".<?php echo esc_attr( $catesgory->slug ); ?>"><?php echo esc_html( $category->name ); ?></a>
			<?php
		}
		?>
	</div>
	<?php
endif; //showfilters check

?>

<div class="isotope-wrapper isotope row masonry-layout <?php echo esc_attr( $margin_class . ' ' . $gutter . ' ' . $atts['show_service_count'] ); ?>"
    <?php if ( $atts['show_filters'] ) : ?>
        data-filters=".isotope_filters-<?php echo esc_attr( $unique_id ); ?>"
    <?php endif; // filters ?>
>
    <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
        <div
            class="isotope-item service-layout-<?php echo esc_attr( $layout . ' ' .  $lg_class . ' ' . $md_class . ' ' . $sm_class . ' ' . $xs_class . ' ' . $sort_classes[get_the_ID()] ); ?>">
            <?php
                include( fw()->extensions->get( 'services' )->locate_view_path( 'loop-item' . $loop_item ) );
            ?>
        </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); // reset the query ?>
</div><!-- eof .isotope-wrapper -->
