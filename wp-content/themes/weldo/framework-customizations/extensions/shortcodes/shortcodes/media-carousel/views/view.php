<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $atts The shortcode attributes
 */

$items         = $atts['items'];
$loop          = $atts['loop'];
$nav           = $atts['nav'];
$autoplay      = $atts['autoplay'];
$responsive_lg = $atts['responsive_lg'];
$responsive_md = $atts['responsive_md'];
$responsive_sm = $atts['responsive_sm'];
$responsive_xs = $atts['responsive_xs'];
$margin        = $atts['margin'];

?>

<div class="owl-carousel card-carousel"
	 data-items="<?php echo esc_attr( $responsive_lg ); ?>"
	 data-loop="<?php echo esc_attr( $loop ); ?>"
	 data-nav="<?php echo esc_attr( $nav ); ?>"
	 data-autoplay="<?php echo esc_attr( $autoplay ); ?>"
	 data-responsive-lg="<?php echo esc_attr( $responsive_lg ); ?>"
	 data-responsive-md="<?php echo esc_attr( $responsive_md ); ?>"
	 data-responsive-sm="<?php echo esc_attr( $responsive_sm ); ?>"
	 data-responsive-xs="<?php echo esc_attr( $responsive_xs ); ?>"
	 data-margin="<?php echo esc_attr( $margin ); ?>"
>
	<?php
	if ( ! empty( $items ) ) :
		foreach ( $items as $item ) :
            $bg_color = !empty( $item['background_color'] ) ? $item['background_color'] : 'box-shadow ls';
            $overlay = !empty( $item['image_overlay'] ) ? 'has-image-overlay' : '';
            $class = !empty( $item['additional_class'] ) ? $item['additional_class'] : '';
        ?>
			<div class="card text-center <?php echo esc_attr( $overlay . ' ' . $class ) ?>">
				<?php if ( ! empty( $item['image']['url'] ) ) : ?>
					<div class="item-media">
						<img src="<?php echo esc_url( $item['image']['url'] ); ?>"
							 alt="<?php echo esc_attr( $item['image_title'] ); ?>">
							<div class="media-links">
							<?php if( ! empty( $item['url'] ) ) : ?>
								<a href="<?php echo esc_url( $item['url'] ); ?>" class="abs-link"></a>
							<?php endif; //url ?>
						</div>
					</div>
				<?php endif; //image url ?>
				<?php if( ! empty( $item['image_title'] || $item['image_excerpt'] ) ) : ?>
					<div class="card-body <?php echo esc_attr( $bg_color ) ?>">
						<?php if( ! empty( $item['url'] ) ) : ?>
							<a href="<?php echo esc_url( $item['url'] ); ?>">
						<?php endif; //url ?>
							<?php if( ! empty( $item['image_title'] ) ) : ?>
							<h4 class="card-title <?php echo esc_attr( $item['title_size'] ); ?>">
								<?php echo wp_kses_post( $item['image_title'] ); ?>
							</h4>
							<?php endif;
						if( ! empty( $item['url'] ) ) : ?>
							</a>
						<?php endif; //url
						 if( ! empty( $item['image_excerpt'] ) ) : ?>
							<p class="card-text fs-20"><?php echo wp_kses_post( $item['image_excerpt'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
		endforeach;
	endif;
	?>
</div>
