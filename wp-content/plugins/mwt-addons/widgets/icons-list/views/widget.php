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
$icons_list  = array();
if ( ! empty( $shortcodes_extension ) ) {
	$shortcode_icons_list = $shortcodes_extension->get_shortcode( 'icons_list' );

}

$unique_id = uniqid();

echo wp_kses_post( $before_widget );

if ( ! empty ( $params[ 'title' ] ) ) :
	echo wp_kses_post( $before_title . $params[ 'title' ] . $after_title );
endif; //title

if ( ! empty ( $params['social_icons'] ) ) : ?>
	<div class="widget-socials">
		<?php foreach ( $params['social_icons'] as $icon ): ?>
			<?php if ( ! empty ( $icon['icon_class'] ) && ! empty ( $icon['icon_link'] )  ): ?>
				<a href="<?php echo esc_url( $icon['icon_link'] ); ?>" target="_blank" class="social-icon <?php echo esc_attr( $icon['icon_class'] ); ?>"><span class="icon_title"><?php echo esc_html( $icon['icon_title'] ); ?></span></a>
			<?php endif; //icon	?>
		<?php endforeach; ?>
	</div>
<?php endif; //social-icons

if ( ! empty( $params[ 'icons' ] ) && ( ! empty ( $shortcode_icons_list ) ) ) :
	echo wp_kses_post( $shortcode_icons_list->render( array( 'icons' => $params[ 'icons' ] ) ) );
endif; //icons list


echo wp_kses_post( $after_widget );