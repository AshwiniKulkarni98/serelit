<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'header_' );

?>
<header class="page_header justify-nav-center <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
	<div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-xl-2 col-lg-3 col-11">
				<?php get_template_part( 'template-parts/logo/header-logo' ); ?>
			</div>
			<div class="col-xl-7 col-lg-6 col-1 text-sm-center">
				<!-- main nav start -->
				<nav class="top-nav">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'sf-menu nav',
						'container'      => 'ul'
					) );
				?>
				</nav>
			</div>
			<div class="col-xl-3 col-lg-3 text-right d-none d-xl-block">
				<ul class="top-includes">
					<li class="header_buttons-icons">
						<?php foreach ($options['header_buttons'] as $button) :?>
							<a href="<?php echo esc_attr( $button['link'] ) ?>"
							   target="<?php echo esc_attr( $button['target'] ) ?>"
							   class="<?php echo esc_attr( $button['color'] . ' ' . $button['size']); ?>">
								<span><?php echo esc_html( $button['label'] ); ?></span>
							</a>
						<?php endforeach;?>
					</li>
				</ul>
			</div>

		</div>
		<!-- header toggler -->
		<span class="toggle_menu"><span></span></span>
	</div>
</header>
