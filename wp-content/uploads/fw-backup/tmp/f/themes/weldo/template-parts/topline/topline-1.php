<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'topline_' );

$hide_cart   = $options['hide_shopping_cart'];
$hide_search = $options['hide_search'];
$hide_login  = $options['hide_login_form'];

//topline section with contact info and search button
?>
<section class="page_topline with-cart topline-overflow-visible s-pb-10 s-pt-15 s-pb-xl-0 s-pt-xl-0 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-6 text-md-left">
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
					<?php endif; ?>
				</ul>
			</div>
			<div class="col-6">
				<ul class="top-includes border-divided text-right">
					<?php if ( ! empty ( $options['meta_phone'] ) ) : ?>
						<li class="icon-inline d-block d-lg-inline-block ">
							<div class="meta-phone">
								<a href="callto:<?php echo esc_html( ucfirst( str_replace( array( ' ' ), '-', $options['meta_phone'] ) ) ); ?>">
									<i class="ico ico-phone color-main fs-14 pr-2"></i>
									<span><?php echo esc_html( $options['meta_phone'] ); ?></span>
								</a>
							</div>
						</li>
					<?php endif;
					if ( ! $hide_search || ! $hide_cart || ! $hide_login) : ?>
						<li class="d-none d-md-inline-block">
							<?php
							if ( ! $hide_search ) : ?>
								<a href="#" class="search_modal_button">
									<i class="fa fa-search fw-900"></i>
								</a>
							<?php endif; //search
								if ( class_exists( 'WC_Widget_Cart' ) && ! $hide_cart && ! is_cart() && ! is_checkout() ) : ?>
									<div class="dropdown dropdown-card">
										<a class="dropdown-toggle dropdown-shopping-cart" href="#" role="button" id="dropdown-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php
											echo '<span class="badge bg-maincolor cart-count">';
											if (  WC()->cart->get_cart_contents_count() !== 0 ) {
												echo esc_html( WC()->cart->get_cart_contents_count() );
											}
											echo '</span>';
											?>
											<i class="ico ico-shopping-bag"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right ls" aria-labelledby="dropdown-cart">
											<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
										</div>
									</div> <!-- eof woo cart  -->
								<?php endif; //woocommerce

							if ( class_exists('UserRegistration') && ! $hide_login ) : ?>
								<a data-toggle="modal" href="#login-form">
									<i class="fa fa-user"></i>
								</a>
							<?php endif; //login
							?>
						</li>
					<?php endif; ?>
					<li class="d-none d-md-inline-block">
					   <?php $shortcodes_extension = fw()->extensions->get( 'shortcodes' );
					   if ( ! empty( $shortcodes_extension ) ) {
						   echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_social' )->render( array( 'social_icons' => $options['social_icons'] ) );
					   }
					   ?>
					</li>
				</ul>

			</div>
		</div>
	</div>
</section><!-- .page_topline -->
