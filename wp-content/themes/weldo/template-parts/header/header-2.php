<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'header_' );

?>

<header class="page_header justify-nav-end s-py-5 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-xl-3 col-lg-4 col-9">
				<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
			</div>
			<div class="col-xl-9 col-lg-8 col-1">
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
		</div>
	</div>
	<!-- header toggler -->
	<span class="toggle_menu"><span></span></span>
</header>