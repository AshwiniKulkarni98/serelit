<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'header_' );

get_template_part( 'template-parts/topline/topline-1' )
?>

<header class="page_header justify-nav-end s-py-5 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
    <div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-xl-3 col-lg-4 col-10">
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
					<?php if ( is_active_sidebar( 'sidebar-top-header' ) ) : ?>
						<span class="toggle_menu toggle_menu_side header_widget header-slide d-none d-lg-block"><span></span></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- header toggler -->
	<span class="toggle_menu"><span></span></span>
</header>


<?php if ( is_active_sidebar( 'sidebar-top-header' ) ) : ?>
    <div class="page_header_side header_slide header_side_right ms d-none d-lg-block <?php echo esc_attr( $options['version'] ) ?>">
		<div class="scrollbar-macosx">
			<?php dynamic_sidebar( 'sidebar-top-header' ); ?>
		</div>
	</div>
<?php endif; ?>

