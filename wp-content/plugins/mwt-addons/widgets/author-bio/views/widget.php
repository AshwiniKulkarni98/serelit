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
if ( ! empty( $shortcodes_extension ) ) {
	$shortcode_icons_social = $shortcodes_extension->get_shortcode( 'icons_social' );

}

$unique_id = uniqid();

echo wp_kses_post( $before_widget );

if ( ! empty ( $params[ 'title' ] ) ) :
	echo wp_kses_post( $before_title . $params[ 'title' ] . $after_title );
endif; //title


if ( ! empty( $params['image'] ) ) : ?>
	<div class="item-media mb-20">
		<img src="<?php echo esc_url( $params['image']['url'] ); ?>"
			 alt="<?php esc_attr_e( 'Author', 'mwt' ); ?>">
	</div>
<?php endif; //image ?>
	<div class="author-bio mt-10">
	<?php if ( ! empty( $params['name'] ) ) : ?>
		<h4 class="author-name">
			<?php echo esc_html( $params['name'] ); ?>
		</h4>
	<?php endif; //logo_text
	if ( ! empty ( $params[ 'info' ] ) ) : ?>
	<div class="author-info font-italic">
		<?php echo wp_kses_post( $params[ 'info' ] ); ?>
	</div>
	<?php endif;// description
	if ( ! empty( $params[ 'social_icons' ] ) && ( ! empty ( $shortcode_icons_social ) ) ) :
		//get icons-social shortcode to render icons in widget
		echo wp_kses_post( $shortcode_icons_social->render( array ( 'social_icons' => $params[ 'social_icons' ] ) ) );
	endif; //social icons ?>
</div>

<?php echo wp_kses_post( $after_widget );