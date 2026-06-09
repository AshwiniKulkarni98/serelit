<?php if ( ! defined( 'ABSPATH' ) ) {
	die();
}
if ( ! defined( 'FW' ) ) {
	return;
}
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var array $params
 */

//unyson theme shortcodes
$shortcodes_extension = fw()->extensions->get( 'shortcodes' );
$social_icons  = array();
$icons_list  = array();
if ( ! empty( $shortcodes_extension ) ) {
	$shortcode_icons_social = $shortcodes_extension->get_shortcode( 'icons_social' );
	$shortcode_icons_list = $shortcodes_extension->get_shortcode( 'icons_list' );

}

$unique_id = uniqid();

echo wp_kses_post( $before_widget );

if ( ! empty ( $params[ 'title' ] ) ) :
	echo wp_kses_post( $before_title . $params[ 'title' ] . $after_title );
endif; //title

if ( ! empty ( $params['url'] ) ) : ?>
	<a class="logo blog-info-logo" href="<?php echo esc_url( $params['url'] ); ?>"
	   target="_blank">
<?php endif; //url
if ( ! empty( $params['image'] ) ) : ?>
	<img src="<?php echo esc_url( $params['image']['url'] ); ?>"
		 alt="<?php esc_attr_e( 'Logo', 'mwt' ); ?>">
<?php endif; //image
if ( ! empty( $params['url'] ) ) : ?>
		<div class="d-flex flex-column">
			<?php if ( ! empty( $params['logo_text'] ) ) : ?>
				<h4 class="logo-text color-main">
					<?php echo esc_html( $params['logo_text'] ); ?>
				</h4>
			<?php endif; //logo_text ?>
		</div>
	</a>
<?php endif; //url
if ( ! empty ( $params[ 'description' ] ) ) : ?>
<div class="description mb-20">
	<?php echo wp_kses_post( $params[ 'description' ] ); ?>
</div>
<?php endif;// description
if ( ! empty( $params[ 'icons' ] ) && ( ! empty ( $shortcode_icons_list ) ) ) :
	echo wp_kses_post( $shortcode_icons_list->render( array( 'icons' => $params[ 'icons' ] ) ) );
endif; //icons list
if ( ! empty( $params[ 'social_icons' ] ) && ( ! empty ( $shortcode_icons_social ) ) ) :
	//get icons-social shortcode to render icons in widget
	echo wp_kses_post( $shortcode_icons_social->render( array ( 'social_icons' => $params[ 'social_icons' ] ) ) );
endif; //social icons

echo wp_kses_post( $after_widget );