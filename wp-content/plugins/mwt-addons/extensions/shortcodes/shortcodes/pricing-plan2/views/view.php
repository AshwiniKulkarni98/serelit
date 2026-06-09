<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $atts The shortcode attributes
 */

$class = ! empty( $atts['additional_class'] ) ? $atts['additional_class'] : '';
$button = $atts['button'];

?>

<div class="pricing-plan2 <?php echo esc_attr( $atts['background_color'] . ' ' .  $atts['featured'] . ' ' . $class ); ?>">
	<?php if( ! empty( $atts['title'] ) ) : ?>
		<h3 class="plan-name mb-20 <?php echo esc_attr( $atts['title_color'] ) ?>">
			<?php echo wp_kses_post( $atts['title'] ); ?>
		</h3>
	<?php endif; ?>
	<?php if( ! empty( $atts['description'] ) ) : ?>
	<div class="plan-description">
		<?php echo wp_kses_post( $atts['description'] ); ?>
	</div>
	<?php endif; ?>
	<?php if( ! empty( $atts['features'] ) ) : ?>
	<div class="plan-features">
		<ul>
		<?php foreach( ( $atts['features'] ) as $feature ) : ?>
			<li class="<?php echo esc_attr( $feature['feature_checked'] ); ?>">
				<span><?php echo wp_kses_post( $feature['feature_name'] ); ?></span>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
	<hr>
	<?php if ( ! empty($atts['price'] ) ) : ?>
		<div class="price-wrap <?php echo esc_attr( $atts['price_color'] ) ?>">
			<h4 class="mb-0 d-inline-block">
				<?php if( ! empty( $atts['currency'] ) ) : ?>
					<span class="plan-sign"><?php echo wp_kses_post( $atts['currency'] ); ?></span>
				<?php endif; ?>
				<?php if( ! empty( $atts['price'] ) ) : ?>
					<span class="plan-price"><?php echo wp_kses_post( $atts['price'] ); ?></span>
				<?php endif; ?>
			</h4>
			<?php if( ! empty( $atts['price_after'] ) ) : ?>
				<span class="plan-decimals fs-20"><?php echo wp_kses_post( $atts['price_after'] ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="plan-button mt-25 mt-lg-45">
		<?php if ( $button['show_button'] ) {
			echo fw() -> extensions -> get( 'shortcodes' ) -> get_shortcode( 'button' ) -> render( $button['button'] );
		} ?>
	</div>
</div>