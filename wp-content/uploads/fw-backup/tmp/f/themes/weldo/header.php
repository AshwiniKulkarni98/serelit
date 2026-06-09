<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till main content section
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<?php
$options = weldo_get_options();
//if is page and Unyson is installed - overriding global header options from page settings
if	( function_exists( 'fw_get_db_post_option' ) && is_page() )  {
	$page_options = fw_get_db_post_option( get_the_ID(), 'header_page' );
	if ( ! empty( $page_options['header_page_styles'] ) ) {
		$options = array_merge( $options, $page_options['header_page_custom_styles'] );
	}
}
?>
<body <?php body_class(); ?>>
<?php
if( function_exists( 'wp_body_open' ) ) :
	wp_body_open();
endif;
//wide or boxed layout
$layout            = $options['layout'];
$canvas_class      = '';
$box_wrapper_class = '';
if ( ! empty ( $layout['boxed'] ) ) {
	$canvas_class          = 'boxed';
	$box_wrapper_class     = 'container';
	$body_background_image = $layout['boxed_options']['body_background_image'];
	$body_cover            = $layout['boxed_options']['body_cover'];
	$boxed_extra_margins   = $layout['boxed_options']['boxed_extra_margins'];
	if ( $body_cover ) {
		$canvas_class .= ' s-parallax';
	}
	if ( $boxed_extra_margins ) {
		$box_wrapper_class .= ' top-bottom-margins';
	}
}

//page preloader
$preloader_type = $options['preloader']['preloader_type'];

if ( ! ( $preloader_type === 'disabled' ) ) :
	$preloader_class_suffix = is_bool( strpos( $preloader_type, 'image' ) ) ? 'css' : 'image';
	$preloader_image = ( $preloader_type == 'image_custom' ) ? $options['preloader']['image_custom']['options'] : false;
	?>
	<!-- page preloader -->
	<div class="preloader">
		<div class="preloader_<?php echo esc_attr( $preloader_class_suffix . ' ' . $options['preloader_custom_class'] ); ?>"<?php echo ( ! empty( $preloader_image ) ) ? ' style="background-image: url(' . esc_url( $preloader_image['url'] ) . ')"' : '' ?>></div>
	</div>
<?php endif; //preloader_enabled ?>

<!-- search modal -->
<div class="modal fade modal-search" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">×</span>
				<i class="ico ico-close"></i>
			</button>
			<div class="widget widget_search">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>

<?php if ( defined( 'FW' ) && class_exists('UserRegistration') ) : ?>
<div class="modal fade login-form" id="login-form">
	<div class="modal-dialog modal-dialog-centered text-center text-md-left">
		<div class="modal-content ls">
			<button type="button" class="close" data-dismiss="modal">
				<i class="ico ico-close"></i>
			</button>
			<div class="modal-body">
				<h4 class="modal-title text-center mb-25"><?php echo esc_html__('Sign In','weldo') ?></h4>
				<?php echo do_shortcode('[user_registration_my_account]') ?>
			</div>
			<?php
			if ( $options['meta_image_login'] ) :
				$image = fw_resize( $options['meta_image_login']['url'], '', '', true );
			?>
			<div class="modal-image item-media cover-image d-none d-md-block">
				<img src="<?php echo esc_url($image) ?>" alt="<?php esc_attr__('image-login', 'weldo') ?>">
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<!-- wrappers for visual page editor and boxed version of template -->
<div id="canvas" class="<?php echo esc_attr( $canvas_class ); ?>"
	<?php echo ( ! empty( $body_background_image ) ) ? ' style="background-image:url(' . esc_url( $body_background_image['url'] ) . ');"' : ''; ?>>
	<div id="box_wrapper" class="<?php echo esc_attr( $box_wrapper_class ); ?>">
		<!-- template sections -->
		<?php
		//header_absolute wrapper
		if ( ! empty( $options['header_absolute']['enabled'] ) ) : ?>
		<div class="header_absolute cover-background s-overlay <?php echo esc_attr( $options['header_absolute']['yes']['header_absolute_background_color'] ); ?>"
			<?php
			if ( ! empty( $options['header_absolute']['yes']['header_absolute_background_image']['data']['icon'] ) ) : ?>
				style="background-image: url('<?php echo esc_url( $options['header_absolute']['yes']['header_absolute_background_image']['data']['icon'] ); ?>')"
			<?php endif; //header_absolute_background_image ?>
		><!-- .header_absolute open -->
			<?php endif; //header_absolute

			do_action( 'weldo_slider' );

			$header = weldo_get_predefined_template_part( 'header' );
			get_template_part( 'template-parts/header/' . esc_attr( $header ) );

			if ( ! is_front_page() && ! is_404()) {
				$title = weldo_get_predefined_template_part( 'title' );
				get_template_part( 'template-parts/title/' . esc_attr( $title ) );
			}

			if ( ! empty( $options['header_absolute']['enabled'] ) ) {
				echo '</div>';
			}

			//not opening section if is single post with video format
			//and if this is not full width page template
			//and if not 404 page
			if (
				! is_page_template( 'page-templates/full-width.php' )
				&& ! is_page_template( 'page-templates/home-page.php' )
				&& ! is_404()
				&& ! is_singular( 'fw-team' )
				&& ! is_singular( 'fw-services' )
				) :
			?>
			<section class="<?php echo esc_attr( $options['version'] ); ?> page_content s-pt-60 s-pb-55 s-pt-lg-100 s-pb-lg-95 c-gutter-70">
				<div class="container">
					<div class="row">
<?php if ( is_home() ) {
	$blog_slider_options = weldo_get_option( 'blog_slider_switch', '' );
	$blog_slider_enabled = false;
	if ( ! empty( $blog_slider_options ) ) {
		$blog_slider_enabled = $blog_slider_options['blog_slider_enabled'];
	}
	$blog_posts_widget_option = weldo_get_option( 'blog_posts_widget_switch', '' );
	if ( $blog_slider_enabled ) {
		do_action( 'weldo_blog_slider' );
	}
	if ( $blog_posts_widget_option ) {
		do_action( 'weldo_posts_widget' );
	}
}
endif; //!full-width ?>