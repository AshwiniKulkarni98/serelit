    <?php if ( ! defined( 'FW' ) ) {
        die( 'Forbidden' );
    }

    /**
     * @var $atts The shortcode attributes
     */

    $items         = $atts['items'];
    $loop          = $atts['loop'];
    $nav           = $atts['nav'];
    $dots          = $atts['dots'];
    $center        = $atts['center'];
    $autoplay      = $atts['autoplay'];
    $responsive_lg = $atts['responsive_lg'];
    $responsive_md = $atts['responsive_md'];
    $responsive_sm = $atts['responsive_sm'];
    $responsive_xs = $atts['responsive_xs'];
    $margin        = $atts['margin'];
    $class         = ! empty( $atts['class'] ) ? $atts['class'] : '';
    ?>
    <div class="owl-carousel <?php echo esc_attr( $class ); ?>"
         data-items="<?php echo esc_attr( $responsive_lg ); ?>"
         data-loop="<?php echo esc_attr( $loop ); ?>"
         data-nav="<?php echo esc_attr( $nav ); ?>"
         data-dots="<?php echo esc_attr( $dots ); ?>"
         data-center="<?php echo esc_attr( $center ); ?>"
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
                ?>
                <div>
				<?php if ( $item['url'] ):
                    $oembed = wp_oembed_get( $item['url'] );
                    $oembed_url = strtok( substr( $oembed, strpos( $oembed, '"http')+1 ), '"');
                    ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>"<?php
				if( ! empty( $item['lightbox'] ) && ! empty( $oembed ) ) : ?>
					class="photoswipe-link"
					data-width="800"
					data-height="800"
					data-iframe="<?php echo esc_url( $oembed_url ) ?>"
                    <?php
                    endif; //lightbox
                    ?>>
                        <?php endif; //url ?>
                        <img src="<?php echo esc_url( $item['image']['url'] ); ?>"
                             alt="<?php echo esc_attr( $item['title'] ); ?>">
					<?php if ( $item['url'] ): ?>
                    </a>
                <?php endif; //url ?>
                </div>
            <?php
            endforeach;
        endif;
        ?>
    </div>
