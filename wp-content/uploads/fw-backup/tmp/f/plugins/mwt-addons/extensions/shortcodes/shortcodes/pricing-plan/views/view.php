<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $atts The shortcode attributes
 */

switch ( $atts['layout'] ) :
	case '2':
?>
<div class="pricing-plan cs <?php echo esc_attr( $atts['featured'] ); ?>">
	<?php if( ! empty( $atts['title'] ) ) : ?>
		<h3 class="plan-name color-main mb-20">
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
			<ul class="list-styled">
				<?php foreach( ( $atts['features'] ) as $feature ) : ?>
					<li class="<?php echo esc_attr( $feature['feature_checked'] ); ?>">
						<?php echo wp_kses_post( $feature['feature_name'] ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<hr>
	<?php if ( ! empty($atts['price'] ) ) : ?>
		<div class="price-wrap ">
			<h4 class="mb-0 d-inline-block color-light">
				<?php if( ! empty( $atts['currency'] ) ) : ?>
					<span class="plan-sign"><?php echo wp_kses_post( $atts['currency'] ); ?></span>
				<?php endif; ?>
				<?php if( ! empty( $atts['price'] ) ) : ?>
					<span class="plan-price"><?php echo wp_kses_post( $atts['price'] ); ?></span>
				<?php endif; ?>
			</h4>
			<?php if( ! empty( $atts['price_after'] ) ) : ?>
				<span class="plan-decimals fs-20 ml-1 color-dark"><?php echo wp_kses_post( $atts['price_after'] ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="plan-button mt-25 mt-lg-45">
		<?php if ( !empty( $atts['price_buttons'] ) ) : ?>
			<?php foreach( $atts['price_buttons'] as $button ) : ?>
				<?php echo fw()->extensions->get('shortcodes')->get_shortcode('button')->render($button); ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<?php
	//2
	break;
	case '3':
?>
<div class="pricing-plan ds ms <?php echo esc_attr( $atts['featured'] ); ?>">
	<?php if( ! empty( $atts['title'] ) ) : ?>
		<h3 class="plan-name color-main mb-20">
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
			<ul class="list-styled">
				<?php foreach( ( $atts['features'] ) as $feature ) : ?>
					<li class="<?php echo esc_attr( $feature['feature_checked'] ); ?>">
						<?php echo wp_kses_post( $feature['feature_name'] ); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<hr>
	<?php if ( ! empty($atts['price'] ) ) : ?>
		<div class="price-wrap color-darkgrey">
			<h4 class="mb-0 d-inline-block">
				<?php if( ! empty( $atts['currency'] ) ) : ?>
					<span class="plan-sign"><?php echo wp_kses_post( $atts['currency'] ); ?></span>
				<?php endif; ?>
				<?php if( ! empty( $atts['price'] ) ) : ?>
					<span class="plan-price"><?php echo wp_kses_post( $atts['price'] ); ?></span>
				<?php endif; ?>
			</h4>
			<?php if( ! empty( $atts['price_after'] ) ) : ?>
				<span class="plan-decimals fs-20 ml-1 color-main"><?php echo wp_kses_post( $atts['price_after'] ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="plan-button mt-25 mt-lg-45">
		<?php if ( !empty( $atts['price_buttons'] ) ) : ?>
			<?php foreach( $atts['price_buttons'] as $button ) : ?>
				<?php echo fw()->extensions->get('shortcodes')->get_shortcode('button')->render($button); ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<?php
	//3
	break;
	default:
?>
<div class="pricing-plan hero-bg <?php echo esc_attr( $atts['featured'] ); ?>">
	<?php if( ! empty( $atts['title'] ) ) : ?>
		<h3 class="plan-name color-main mb-20">
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
		<ul class="list-styled">
		<?php foreach( ( $atts['features'] ) as $feature ) : ?>
			<li class="<?php echo esc_attr( $feature['feature_checked'] ); ?>">
				<?php echo wp_kses_post( $feature['feature_name'] ); ?>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
	<hr>
	<?php if ( ! empty($atts['price'] ) ) : ?>
		<div class="price-wrap color-darkgrey">
			<h4 class="mb-0 d-inline-block">
				<?php if( ! empty( $atts['currency'] ) ) : ?>
					<span class="plan-sign"><?php echo wp_kses_post( $atts['currency'] ); ?></span>
				<?php endif; ?>
				<?php if( ! empty( $atts['price'] ) ) : ?>
					<span class="plan-price"><?php echo wp_kses_post( $atts['price'] ); ?></span>
				<?php endif; ?>
			</h4>
			<?php if( ! empty( $atts['price_after'] ) ) : ?>
				<span class="plan-decimals fs-20 ml-1 color-main"><?php echo wp_kses_post( $atts['price_after'] ); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="plan-button mt-25 mt-lg-45">
		<?php if ( !empty( $atts['price_buttons'] ) ) : ?>
			<?php foreach( $atts['price_buttons'] as $button ) : ?>
				<?php echo fw()->extensions->get('shortcodes')->get_shortcode('button')->render($button); ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<?php endswitch;