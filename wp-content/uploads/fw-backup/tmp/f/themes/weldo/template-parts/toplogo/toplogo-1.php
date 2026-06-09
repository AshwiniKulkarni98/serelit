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
			<div class="col-lg-4">
				<?php if ( ! empty ( $options['meta_phone'] ) ) : ?>
				<h4 class="mb-0">
					<?php echo esc_html( $options['meta_phone'] ); ?>
				</h4>
				<?php endif; ?>
				<?php if ( ! empty ( $options['meta_email'] ) ) : ?>
				<p>
					<a href="mailto:<?php echo esc_attr( $options['meta_email'] ); ?>">
						<?php echo esc_html( $options['meta_email'] ); ?>
					</a>
				</p>
				<?php endif; ?>
			</div>

			<div class="col-lg-4 text-center">
				<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
			</div>

			<div class="col-lg-4">

				<div class="d-lg-flex justify-content-lg-end align-items-lg-center">
					<ul class="top-includes">
					<?php if ( $options['woo'] ) : ?>
						<li class="dropdown cart-dropdown">
							<a class="header-button" id="cart" data-target="#" href="/" data-toggle="dropdown"
							   aria-haspopup="true" role="button" aria-expanded="false">
								<i class="fa fa-shopping-cart"></i>
								<?php
								if ( WC()->cart->get_cart_contents_count() ) {
									echo '<span class="cart-products-number">' . WC()->cart->get_cart_contents_count() . '</span>';
								}
								?>
							</a>
							<div class="dropdown-menu ls" aria-labelledby="cart">
								<?php the_widget( 'WC_Widget_Cart' ); ?>
							</div>
						</li><!-- eof woo cart -->
					<?php endif; //woocommerce ?>
						<li>
                           <?php $shortcodes_extension = fw()->extensions->get( 'shortcodes' );
                           if ( ! empty( $shortcodes_extension ) ) {
                               echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_social' )->render( array( 'social_icons' => $options['social_icons'] ) );
                           }
                           ?>
						</li>
					</ul>
				</div>
			</div>

			<!-- header toggler

			<span class="toggle_menu"><span></span></span>

			-->

		</div>
	</div>
</section><!-- .page_toplogo -->
