<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'header_' );
$col_class = ! empty( $options['meta_phone'] ) ? 'col-lg-6' : 'col-lg-9';

get_template_part( 'template-parts/topline/topline-4' )

?>

<header class="page_header header7 sf-arrows justify-nav-center <?php echo esc_attr( $section['section_class']  ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
    <div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-lg-3 col-md-6 col-8 order-1">
				<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
			</div>
			<div class="<?php echo esc_attr( $col_class ); ?> col-1 order-3 order-lg-2">
				<div class="nav-wrap">
					<!-- main nav start -->
					<nav class="top-nav">
					<?php
					if( has_nav_menu( 'primary' ) ) :
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'sf-menu nav',
							'container'      => 'ul'
						) );
					endif;
					?>
					</nav>
				</div>
			</div>
            <?php if ( ! empty( $options['meta_phone'] ) ) : ?>
                <div class="col-lg-3 col-md-5 col-2 text-sm-right order-2 order-lg-3 d-none d-md-block">
                    <div class="meta-phone-centered">
                        <i class="color-main fs-20 ico ico-phone-alt"></i>
                         <a href="tel:<?php echo esc_html( ucfirst( str_replace( array( ' ' ), '-', $options['meta_phone'] ) ) ); ?>">
                            <span><?php echo esc_html( $options['meta_phone'] ); ?></span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
	</div>
	<!-- header toggler -->
	<span class="toggle_menu"><span></span></span>
</header>
