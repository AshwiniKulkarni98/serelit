<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options  = weldo_get_options();
$section  = weldo_get_section_options( $options, 'topline_' );

if ( empty( $options['meta_phone'] ) ) {
	return;
}
?>

<section class="page_topline ds s-py-10 d-md-none">
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-12">
                <div class="meta-phone-centered">
                    <i class="color-main fs-20 ico ico-phone-alt"></i>
                     <a href="tel:<?php echo esc_html( ucfirst( str_replace( array( ' ' ), '-', $options['meta_phone'] ) ) ); ?>">
                        <span><?php echo esc_html( $options['meta_phone'] ); ?></span>
                    </a>
                </div>
			</div>
		</div>
	</div>
</section><!-- .page_topline -->
