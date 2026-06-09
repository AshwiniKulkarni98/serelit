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
$unique_id = uniqid();
echo wp_kses_post( $before_widget );
if ( !empty ( $params['title'] ) ) {
	echo wp_kses_post( $before_title . $params['title'] . $after_title );
}
if ( !empty ( $params['url'] ) ) : ?>
	<a href="<?php echo esc_url( $params['url'] ); ?>" target="_blank">
<?php endif; //url
if ( !empty( $params['image'] ) ) : ?>
	<img src="<?php echo esc_url( $params['image']['url'] ); ?>" alt="<?php echo ( ! empty( $params['title'] ) ? esc_attr( $params['title'] ) : '' ); ?>">
<?php endif; //image
if ( !empty( $params['url'] ) ) : ?>
	</a>
<?php endif; //url ?>
<?php echo wp_kses_post( $after_widget );