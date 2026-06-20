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
	<?php echo ( ! empty( $section['section_id'] ) ) ? 'id="' . esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( ! empty( $section['section_background_image'] ) ) ? 'style="' . esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
	<div class="row footer-columns-right footer-columns-three<?php echo esc_attr( $section['section_row_class_suffix'] ); ?>">
			<div class="col-xl-4 col-lg-4 col-md-12 footer-col-contact">
				<?php get_template_part( 'template-parts/footer/footer-contact-icons' ); ?>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-12 footer-col-form">
				<?php get_template_part( 'template-parts/footer/footer-contact-form' ); ?>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-12 footer-col-qr">
				<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
			</div>
		</div>
		</div>
	</div>
</footer><!-- .page_footer -->
