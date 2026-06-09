<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options  = weldo_get_options();

if ( empty( $options['meta_address'] ) && empty( $options['meta_email'] ) && empty( $options['meta_phone'] ) && empty( $options['social_icons'] ) ) {
	return;
}

$section  = weldo_get_section_options( $options, 'topline_' );
$meta_col = ! empty( $options['social_icons'] ) ? 'col-md-8' : 'col-md-12 hide-soc-icons';

//topline section with contact info and search button
?>

<section class="page_topline inline-includes s-py-3 s-py-md-10 s-py-xl-15 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-12 <?php echo esc_attr( $meta_col ) ?>">
				<ul class="top-includes">
					<?php if ( ! empty ( $options['meta_address'] ) ) : ?>
                        <li class="icon-inline meta_address">
                            <span>
                                <i class="color-main2 fs-20 ico ico-pin"></i>
                                <span><?php echo esc_html( $options['meta_address'] ); ?></span>
                            </span>
						</li>
					<?php endif;
					if ( ! empty ( $options['meta_email'] ) ) : ?>
                        <li class="icon-inline meta_email">
                            <span>
                                <i class="color-main2 fs-20 ico ico-envelope2"></i>
                                <a href="mailto:<?php echo esc_attr( $options['meta_email'] ); ?>">
                                    <span><?php echo esc_html( $options['meta_email'] ); ?></span>
                                </a>
                            </span>
						</li>
					<?php endif;
					if ( ! empty ( $options['meta_phone'] ) ) : ?>
                        <li class="icon-inline meta_phone">
                         <span>
                            <i class="color-main2 fs-20 ico ico-phone-alt"></i>
                             <a href="tel:<?php echo esc_html( ucfirst( str_replace( array( ' ' ), '-', $options['meta_phone'] ) ) ); ?>">
                                <span><?php echo esc_html( $options['meta_phone'] ); ?></span>
                            </a>
                         </span>
						</li>
					<?php endif;
					?>
				</ul>
			</div>
            <?php
            $shortcodes_extension = fw()->extensions->get( 'shortcodes' );
            if ( ! empty( $shortcodes_extension ) && ! empty( $options['social_icons'] ) ) : ?>
                <div class="col-12 col-md-4 text-lg-right">
                    <?php echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_social' )->render( array( 'social_icons' => $options['social_icons'] ) ); ?>
                </div>
            <?php endif; ?>
		</div>
	</div>
</section><!-- .page_topline -->
