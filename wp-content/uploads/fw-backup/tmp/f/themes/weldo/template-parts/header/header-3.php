<?php
/**
 * The template part for selected header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options = weldo_get_options();
$section = weldo_get_section_options( $options, 'header_' );
$hide_search = $options['hide_search'];

//get topline
get_template_part( 'template-parts/toplogo/toplogo-2' );

?>
<header class="page_header nav-narrow sf-arrows s-pb-10 s-pb-lg-0 <?php echo esc_attr( $section['section_class'] ); ?>"
	<?php echo ( !empty( $section['section_id'] ) ) ? 'id="'. esc_attr( $section['section_id'] ) . '"' : ''; ?>
	<?php echo ( !empty( $section['section_background_image'] ) ) ? 'style="'. esc_attr( $section['section_background_image'] ) . '"' : ''; ?>
>
    <div class="container<?php echo esc_attr( $section['section_container_class_suffix'] ); ?>">
		<div class="row align-items-center">
			<div class="col-lg-8">
                <div class="nav-wrap">

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
	                <?php if ( ! $hide_search ) : ?>
						<span class="d-none d-xl-block">
							<a href="#" class="search_modal_button">
								<i class="fa fa-search"></i>
							</a>
						</span>
	                <?php endif; ?>
                </div>
			</div>
			<div class="col-10 col-lg-4">
				<div class="text-left text-lg-right">
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
		</div><!-- header toggler -->
        <span class="toggle_menu"><span></span></span>
    </div>
</header>
