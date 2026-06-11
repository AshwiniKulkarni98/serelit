<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'header_' );
$hide_cart   = $options['hide_shopping_cart'];
$hide_search = $options['hide_search'];
$hide_login  = $options['hide_login_form'];
// get_template_part( 'template-parts/topline/topline-3' )
?>

<header class="page_header header6 sf-arrows justify-nav-center s-py-5 <?php echo esc_attr( $section['section_class']  ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
    <div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-8 col-lg-3 order-1">
				<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
			</div>
			<div class="col-1 col-lg-6 order-3 order-lg-2">
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
				</div>
			</div>
            <div class="col-2 col-lg-3 text-sm-right order-2 order-lg-3">
                <div class="header-includes">
                    <?php
                    if ( ! $hide_search ) : ?>
                        <a href="#" class="search_modal_button d-none d-sm-block">
                            <i class="ico ico-search"></i>
                        </a>
                    <?php endif; //search
                    if ( class_exists( 'WC_Widget_Cart' ) && ! $hide_cart && ! is_cart() && ! is_checkout() ) : ?>
                        <div class="dropdown dropdown-card d-none d-sm-block">
                            <a class="dropdown-toggle dropdown-shopping-cart" href="#" role="button" id="dropdown-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                echo '<span class="badge bg-maincolor cart-count">';
                                if (  WC()->cart->get_cart_contents_count() !== 0 ) {
                                    echo esc_html( WC()->cart->get_cart_contents_count() );
                                }
                                echo '</span>';
                                ?>
                                <i class="ico ico-bag"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right ls" aria-labelledby="dropdown-cart">
                                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                            </div>
                        </div> <!-- eof woo cart  -->
                    <?php endif; //woocommerce
                    if ( class_exists('UserRegistration') && ! $hide_login ) : ?>
                        <a data-toggle="modal" href="#login-form">
                            <i class="ico ico-user-alt"></i>
                        </a>
                    <?php endif; //login
                    
                    if ( is_active_sidebar( 'sidebar-top-header' ) ) : ?>
                    <span class="toggle_menu toggle_menu_side header_widget header-slide d-none d-lg-block">
                        <i class="ico ico-menuburger"></i>
                    </span>
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

