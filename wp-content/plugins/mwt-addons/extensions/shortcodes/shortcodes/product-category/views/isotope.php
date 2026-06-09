<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<?php
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
	//6
	default:
		$lg_class = 'col-lg-2';
endswitch;

//bootstrap col-md-* class
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
	//6
	default:
		$md_class = 'col-md-2';
endswitch;

//bootstrap col-sm-* class
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
	//6
	default:
		$sm_class = 'col-sm-2';
endswitch;

//bootstrap col-xs-* class
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
	//6
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
    case ( 30 ) :
        $margin_class = 'c-gutter-30 c-mb-30';
        break;
    case ( 40 ) :
        $margin_class = 'c-gutter-40 c-mb-40';
        break;
    case ( 50 ) :
        $margin_class = 'c-gutter-50 c-mb-50';
        break;
    case ( 60 ) :
        $margin_class = 'c-gutter-60 c-mb-60';
        break;
	//6
	default:
		$margin_class = 'c-gutter-15 c-mb-15';
endswitch;

$class = ! empty( $atts['class'] ) ? $atts['class'] : '';

?>

<div class="row woo-product-categories <?php echo esc_attr( $margin_class . ' ' . $class ); ?>">
    <?php foreach ( $atts['cat'] as $cat ) { ?>
        <div class="isotope-item <?php echo esc_attr( $lg_class . ' ' . $md_class . ' ' . $sm_class . ' ' . $xs_class ); ?>">
            <?php
            $filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/product-category/views/loop-item.php';
            if ( file_exists( $filepath ) ) {
                include( $filepath );
            } else {
                esc_html_e( 'View not found', 'weldo' );
            }
            ?>
        </div>
    <?php } ?>
</div>


