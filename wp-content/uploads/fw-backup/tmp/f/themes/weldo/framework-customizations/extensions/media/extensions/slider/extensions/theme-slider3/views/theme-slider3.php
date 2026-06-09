<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
if ( isset( $data['slides'] ) ):
	$class = ( ! empty ( $data['settings']['extra']['class'] ) ) ? $data['settings']['extra']['class'] : '';
	$dots = ( ! empty ( $data['settings']['extra']['dots'] ) ) ? $data['settings']['extra']['dots'] : '';
	$nav_data = $data['settings']['extra']['nav'];
	$nav = ( ! empty ( $nav_data['show_nav'] ) ) ? true : false;
	$speed = ( ! empty ( $data['settings']['extra']['speed'] ) ) ? $data['settings']['extra']['speed'] : '';
	?>
    <section class="intro_section page_slider theme_slider2 theme_slider3 <?php echo esc_attr( $class . ' ' . $nav_data['nav']['nav_style'] ); ?>">
        <div class="flexslider"
            <?php if ( ! empty( $dots) ) : ?>
                data-dots="<?php echo esc_attr( $dots ) ?>"
            <?php endif; ?>
                data-nav="<?php echo esc_attr( $nav ) ?>"
            <?php if ( ! empty( $speed) ) : ?>
                data-speed="<?php echo esc_attr( $speed ) ?>"
            <?php endif; ?>
        >
            <ul class="slides">
                <?php foreach ( $data['slides'] as $id => $slide ) :
                    $slide_background     = isset( $slide['extra']['slide_background'] ) ? $slide['extra']['slide_background'] : false;
                    $slide_image          = isset( $slide['extra']['slide_image'] ) ? $slide['extra']['slide_image']['url'] : false;
                    $slide_align          = isset( $slide['extra']['slide_align'] ) ? $slide['extra']['slide_align'] : '';
                    $slide_vertical_align = isset( $slide['extra']['slide_vertical_align'] ) ? $slide['extra']['slide_vertical_align'] : '';
                    $slide_class          = isset( $slide['extra']['class'] ) ? $slide['extra']['class'] : '';
                    $slide_layers         = isset( $slide['extra']['slide_layers'] ) ? $slide['extra']['slide_layers'] : false;
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
                        <?php endif; ?>
                        
                        
                        <?php if ( $data['settings']['extra']['show_slide_count'] ) : ?>
                            <div class="slide-count">
                                <h3 class="current-item">
                                   <?php echo esc_html( $id + 1 >= 10 ? esc_html( $id + 1 ) : '0' . esc_html( $id + 1 ) ); ?>
                                </h3>
                                <h4 class="total-items">
                                    <?php echo esc_html( count( $data['slides'] ) >= 10  ? '/' . esc_html( count( $data['slides'] ) ) : '/0' . esc_html( count( $data['slides'] ) ) ); ?>
                                </h4>
                            </div>
                        <?php endif;
                        if ( !empty( $slide_image ) ) : ?>
                            <div class="intro_layers p-0">
                                <div class="cover-image s-cover-right">
                                    <span class="flexslider-overlay"></span>
                                    <img src="<?php echo esc_attr( $slide_image )?>" alt="<?php echo esc_attr( $slide['title'] ); ?>">
                                </div>
                            </div>
		                <?php endif; ?>
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="intro_layers_wrapper <?php echo esc_attr( $slide_vertical_align ); ?>">
                                        <div class="intro_layers">
                                            <?php if ( $slide_layers ) : ?>
                                                        <?php foreach ( $slide_layers as $layer ) :
                                                        $layer_class = ! empty( $layer['class'] ) ? $layer['class'] : '';
                                                        $layer_text  = ( ! empty( $layer['layer_text_color'] ) ) ? $layer['layer_text_color'] : '';
                                                        $layer_text  .= ( ! empty( $layer['layer_text_weight'] ) ) ? ' ' . $layer['layer_text_weight'] : '';
                                                        $layer_text  .= ( ! empty( $layer['layer_text_transform'] ) ) ? ' ' . $layer['layer_text_transform'] : '';
                                                        $layer_text  .= ( ! empty( $layer['layer_letter_spacing'] ) ) ? ' ' . $layer['layer_letter_spacing'] : '';
                                                        $layer_text  .= ( ! empty( $layer['layer_font_size'] ) ) ? ' ' . $layer['layer_font_size'] : '';
                                                        $layer_text  .= ( ! empty( $layer['layer_font_size_md'] ) ) ? ' ' . $layer['layer_font_size_md'] : '';
                                                        $layer_text  .= ( ! empty( $layer['layer_font_size_xl'] ) ) ? ' ' . $layer['layer_font_size_xl'] : '';
                                                        ?>
                                                        <div class="intro-layer <?php echo esc_attr( $layer_class ); ?>"
                                                             data-animation="<?php echo esc_attr( $layer['layer_animation'] ); ?>"
                                                        >
                                                                <<?php echo esc_html( $layer['layer_tag'] ); ?> class="layer-text <?php echo esc_attr( $layer_text ); ?>">
                                                            <?php echo wp_kses_post( $layer['layer_text'] ) ?>
                                                                </<?php echo esc_html( $layer['layer_tag'] ); ?>>
                                                            </div>
                                                    <?php endforeach; //$slide_layers
                                                    if ( !empty( $slide['extra']['buttons'] ) ) : ?>
                                                        <div class="intro_layers intro_layers_buttons" data-animation="<?php echo esc_attr( $slide['extra']['button_animation'] ); ?>">
                                                                <?php foreach ( $slide['extra']['buttons'] as $button ) : ?>
                                                                    <div class="intro-layer" data-animation="<?php echo esc_attr( $slide['extra']['button_animation'] ); ?>">
                                                                        <?php echo fw_ext( 'shortcodes' ) -> get_shortcode( 'button' ) -> render( $button ); ?>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                    <?php endif;
                                                    endif; //$slide_layers ?>
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