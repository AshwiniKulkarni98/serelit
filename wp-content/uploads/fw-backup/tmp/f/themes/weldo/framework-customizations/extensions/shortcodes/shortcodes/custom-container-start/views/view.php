<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */

$class = '';
$class .= ( $atts['custom_class']['add_custom_class'] && isset( $atts['custom_class']['custom']['class'] ) ) ? ' ' .  $atts['custom_class']['custom']['class'] : '';
?>

<div class="<?php echo esc_attr( $class ); ?>">
