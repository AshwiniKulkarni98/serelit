<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'toplogo_' );

//toplogo section with contact and search button
?>
<section class="page_toplogo ls s-pt-25 s-pb-20 s-py-md-30 s-borderbottom"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">

		<div class="row align-items-center">
			<div class="col-12">

				<div class="d-md-flex justify-content-lg-end align-items-lg-center">

					<div class="d-none d-md-flex  mr-auto">
						<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
					</div>

					<div class="d-flex justify-md-content-end align-items-center">
						<?php foreach ( $options['toplogo-icons'] as $icon ): ?>
							<div class="media align-items-center">
								<?php if ( $icon['icon'] ): ?>
									<div class="icon-styled">
										<i class="<?php echo esc_attr( $icon['icon'] . ' ' . $icon['icon_style'] ); ?> fs-40"></i>
									</div>
								<?php endif; //icon ?>
								<div class="media-body">
									<?php if ( ! empty ( $icon['title'] ) ) : ?>
										<h6>
											<?php echo wp_kses_post( $icon['title'] ); ?>
										</h6>
									<?php endif; ?>
									<?php if ( ! empty ( $icon['text'] ) ) : ?>
										<p>
											<?php echo wp_kses_post( $icon['text'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div><!-- .media -->
						<?php endforeach; ?>
					</div><!-- .d-none -->
				</div><!-- .d-lg-flex -->
			</div>
		</div>
	</div>
</section><!-- .page_toplogo -->
