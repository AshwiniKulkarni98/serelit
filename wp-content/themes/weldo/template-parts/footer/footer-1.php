<?php
/**
 * The template part for selected footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'footer_' );

?>
<footer class="page_footer text-center text-md-left <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row<?php echo esc_attr( $section['section_row_class_suffix'] ); ?>">
			<div class="col-xl-4 col-md-6">
				<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
			</div>
			<div class="col-xl-4 col-md-6">
      <?php get_template_part( 'template-parts/footer/footer-contact-icons' ); ?>
    </div>
			<div class="col-xl-4 col-md-6">
				<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
			</div>
			<!-- <div class="col-xl-3 col-md-6">
				<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
			</div> -->
		</div>
	</div>
</footer><!-- .page_footer -->