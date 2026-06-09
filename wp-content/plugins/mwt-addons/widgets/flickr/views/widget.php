<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * @var $number
 * @var $before_widget
 * @var $after_widget
 * @var $title
 * @var $flickr_id
 */

echo wp_kses_post( $before_widget );
echo wp_kses_post( $title );
?>
	<div class="wrap-flickr">
		<ul class="flickr_ul" data-flickr-number="<?php echo esc_attr( $number ); ?>" data-flickr-id="<?php echo esc_attr( $flickr_id ); ?>"></ul>
	</div>
<?php echo wp_kses_post ( $after_widget );