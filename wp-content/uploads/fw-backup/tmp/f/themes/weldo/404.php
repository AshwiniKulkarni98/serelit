<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header();

$options = weldo_get_options();
$section = weldo_get_section_options($options, '404_');
?>
<section class="page_404 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row<?php echo esc_attr( $section['section_row_class_suffix'] ); ?>">
<?php
//true - no sidebar on 404 page
$column_classes = weldo_get_columns_classes( true ); ?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?> text-center">
		<div class="page-header">
			<?php if ( ! empty( $options['error_text'] ) ) : ?>
				<p  class="error_text">
					<?php echo esc_html( $options['error_text'] ); ?>
				</p>
			<?php endif; ?>
			<p class="color-main"><?php esc_html_e( '404', 'weldo' ); ?></p>
		</div>
		<div class="page-content">
			<?php if ( ! empty( $options['first_line_text'] ) ) : ?>
				<p class="first-line-text fs-20 fw-500">
					<?php echo esc_html( $options['first_line_text'] ); ?>
				</p>
			<?php endif;
			if ( ! empty( $options['second_line_text'] ) ) : ?>
				<p class="second-line-text mb-0">
					<?php echo esc_html( $options['second_line_text'] ); ?>
				</p>
			<?php endif;
			if ( ! empty( $options['404_image']['url'] ) ) : ?>
				<div class="mb-35">
					<img src="<?php echo esc_url( $options['404_image']['url'] ) ?>" alt="<?php echo esc_attr__('404 image', 'weldo') ?>">
				</div>
			<?php endif;
			if ( ! empty( $options['404_button_label'] && $options['404_button_link'] ) ) : ?>
				<a href="<?php echo esc_url( $options['404_button_link'] ); ?>" class="btn btn-big btn-wide btn-maincolor mt-35">
					<?php echo esc_html( $options['404_button_label'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div><!--eof #content -->

<?php if ( $column_classes['sidebar_class'] ): ?>
	<!-- main aside sidebar -->
	<aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
	</aside>
	<!-- eof main aside sidebar -->
	<?php
endif;
get_footer();