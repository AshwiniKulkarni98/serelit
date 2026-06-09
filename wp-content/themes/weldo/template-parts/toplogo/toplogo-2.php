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
<section class="page_toplogo c-my-10 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">

		<div class="row align-items-center">
			<div class="col-12">

				<div class="d-lg-flex justify-content-lg-end align-items-lg-center">

					<div class="mr-auto">
						<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
					</div>

					<div class="d-sm-flex justify-lg-content-end justify-content-sm-between align-items-center">
						<ul class="top-includes border-divided">
							<?php if ( ! empty ( $options['meta_address'] ) ) : ?>
								<li class="icon-inline d-none d-md-inline-block">
									<div class="meta-address">
										<i class="color-main fs-14 ico ico-map-marker mr-2"></i>
										<span><?php echo esc_html( $options['meta_address'] ); ?></span>
									</div>
								</li>
							<?php endif;
							if ( ! empty ( $options['meta_email'] ) ) : ?>
								<li class="icon-inline meta-email">
									<a href="mailto:<?php echo esc_attr( $options['meta_email'] ); ?>">
										<i class="color-main fs-14 ico ico-envelope-alt mr-2"></i>
										<span><?php echo esc_html( $options['meta_email'] ); ?></span>
									</a>
								</li>
							<?php endif;
							if ( ! empty ( $options['meta_phone'] ) ) : ?>
								<li class="icon-inline d-block d-lg-inline-block ">
									<div class="meta-phone">
										<a href="callto:<?php echo esc_html( ucfirst( str_replace( array( ' ' ), '-', $options['meta_phone'] ) ) ); ?>">
											<i class="ico ico-phone color-main fs-14 pr-2"></i>
											<span><?php echo esc_html( $options['meta_phone'] ); ?></span>
										</a>
									</div>
								</li>
					<?php endif; ?>
						</ul>
					</div><!-- .d-none -->
				</div><!-- .d-lg-flex -->
			</div>
		</div>
	</div>
</section><!-- .page_toplogo -->
