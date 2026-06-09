<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
	if ( isset( $data['slides'] ) ):
	$class = ( ! empty ($data['settings']['extra']['class'] ) ) ? $data['settings']['extra']['class'] : '';
	$dots = ( ! empty ($data['settings']['extra']['dots'] ) ) ? $data['settings']['extra']['dots'] : '';
	$nav = ( ! empty ($data['settings']['extra']['nav'] ) ) ? $data['settings']['extra']['nav'] : '';
	$speed = ( ! empty ($data['settings']['extra']['speed'] ) ) ? $data['settings']['extra']['speed'] : '';
?>
<section class="intro_section page_slider <?php echo esc_attr( $class ); ?>">
	<div class="flexslider"
		<?php if ( ! empty( $dots) ) : ?>
			data-dots="<?php echo esc_attr( $dots ) ?>"
		<?php endif; ?>
		<?php if ( ! empty( $nav) ) : ?>
			data-nav="<?php echo esc_attr( $nav ) ?>"
		<?php endif; ?>
		<?php if ( ! empty( $speed) ) : ?>
			data-speed="<?php echo esc_attr( $speed ) ?>"
		<?php endif; ?>
	>
		<ul class="slides">
			<?php foreach ( $data['slides'] as $id => $slide ):
			$slide_background = isset( $slide['extra']['slide_background'] ) ? $slide['extra']['slide_background'] : false;
			$slide_align      = isset( $slide['extra']['slide_align'] ) ? $slide['extra']['slide_align'] : '';
			$slide_vertical_align      = isset( $slide['extra']['slide_vertical_align'] ) ? $slide['extra']['slide_vertical_align'] : '';
			$slide_class       = isset( $slide['extra']['class'] ) ? $slide['extra']['class'] : '';
			$slide_layers      = isset( $slide['extra']['slide_layers'] ) ? $slide['extra']['slide_layers'] : false;
			$shadow_heading    = isset( $slide['extra']['shadow_heading_text'] ) ? $slide['extra']['shadow_heading_text'] : '';
			$button            = ! empty( $slide['extra']['button'] ) ? $slide['extra']['button'] : false;
			$show_button       = ! empty( $button['show_button'] ) ? true : false;
			$show_arrow        = ! empty( $slide['extra']['arrow']['show_arrow'] ) ? true : false;
			$arrow_atts        = $slide['extra']['arrow']['arrow'];
			$shadow_text       = false;
			?>
			<li class="cover-image <?php echo esc_attr( $slide_background . ' ' . $slide_align . ' ' . $slide_class ); ?>">
				<?php if ( $slide['multimedia_type'] == 'video' ) :
						preg_match( '/(embed\/|v=|\.be\/|\/v\/)([0-9a-zA-Z_-]*)/i', trim( $slide['src'] ), $matches );
						$youtube_video_id = !empty($matches[2]) ? $matches[2] : '';
					?>
					<div class="embed-responsive embed-responsive-16by9">
					<?php
						$iframe = wp_oembed_get( $slide['src'] );
						echo str_replace('feature=oembed', 'feature=oembed&showinfo=0&autoplay=1&controls=0&mute=1&loop=1&playlist=' . $youtube_video_id, $iframe );
					?>
					</div>
				<?php else: ?>
					<img src="<?php echo esc_attr( $slide['src'] ); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>">
				<?php endif;
				if ( $slide['extra']['slide_background_overlay']  ) : ?>
					<span class="flexslider-overlay"></span>
				<?php endif; ?>
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12">
							<div class="intro_layers_wrapper <?php echo esc_attr( $slide_vertical_align ); ?>">
								<div class="intro_layers">
									<?php if ( $slide_layers || $button ) : ?>
										<?php foreach ( $slide_layers as $layer ):
											$layer_class =  ! empty( $layer['class'] ) ? $layer['class'] : '';
										?>
										<div class="intro-layer <?php echo esc_attr( $layer_class ); ?>"
											 data-animation="<?php echo esc_attr( $layer['layer_animation'] ); ?>"
										>
											<<?php echo esc_html( $layer['layer_tag'] ); ?> class="<?php echo( 'p' == $layer['layer_tag'] ) ? 'big' : ''; ?> <?php echo esc_attr( $layer['layer_text_color'] . ' ' . $layer['layer_text_weight'] . ' ' . $layer['layer_text_transform'] ); ?>">
											<?php echo wp_kses_post( $layer['layer_text'] ) ?>
										</<?php echo esc_html( $layer['layer_tag'] ); ?>>
										<?php
										if ( ! empty( esc_html( $shadow_heading ) ) && empty( $shadow_text ) ) : ?>
										<h2 class="intro_shadow_word">
											<?php echo wp_kses_post( $shadow_heading ); ?>
										</h2>
										<?php
											$shadow_text = true;
										endif;
										?>
								</div>
								<?php endforeach; //$slide_layers
									if ( $show_button ) :
										$button_animation =  ! empty( $button['button']['button_animation'] ) ? $button['button']['button_animation'] : '';
										?>
										<div class="intro-layer"
											data-animation="<?php echo esc_attr( $button_animation ); ?>"
										>
											<a href="<?php echo esc_url( $button['button']['link'] ); ?>"
											   target="<?php echo esc_attr( $button['button']['target'] ); ?>"
											   class="<?php echo esc_attr( $button['button']['color'] ); ?>">
												<?php echo esc_html( $button['button']['label'] ); ?>
											</a>
										</div>
									<?php endif; //$slide_button
								endif; //$slide_layers || $slide_button ?>
								<?php if ( $show_arrow ) : ?>
									<div
										class="intro_layer scroll-link intro-arrow <?php echo esc_attr( $arrow_atts['arrow_custom_class'] ) ?> animate"
										data-animation="fadeInDown">
										<div class="animate" data-animation="floating">
											<?php if ( ! empty( $arrow_atts['link'] ) ) : ?>
												<a href="<?php echo esc_url( $arrow_atts['link'] ); ?>">
											<?php endif; ?>
											<i class="ico ico-arrow-down fs-30 <?php echo esc_attr( $arrow_atts['arrow_color'] ) ?>"></i>
											<?php if ( ! empty( $arrow_atts['link'] ) ) : ?>
												</a>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>
							</div> <!-- eof .intro_layers -->
						</div> <!-- eof .intro_layers_wrapper -->
					</div> <!-- eof .col-* -->
				</div><!-- eof .row -->
			</div><!-- eof .container -->
		</li>
		<?php endforeach; ?>
		</ul>
	</div> <!-- eof flexslider -->
</section> <!-- eof intro_section -->
<?php endif; ?>