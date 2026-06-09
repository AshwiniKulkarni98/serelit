<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - extended item layout
 */

$terms               = get_the_terms( get_the_ID(), 'category' );
$media_position      = ! empty( $atts['side_media_position'] ) ? 'right' : 'left';
$class               = ! empty( $atts['class'] ) ? $atts['class'] : '';
$button              = $atts['button']['button'];
$show_button         = ( ! empty( $atts['button']['show_button'] ) && ! empty( $button['label'] ) ) ? true : false;
$button_custom_class = ( ! empty( $button['custom_class'] ) ) ? $button['custom_class'] : '';
$filter_classes = '';
if( ! empty( $terms ) ) :
	foreach ( $terms as $term ) {
		$filter_classes .= ' filter-' . $term->slug;
	}
endif;
while ( $posts->have_posts() ) : $posts->the_post();
	$pID = get_the_ID();
	$option = fw_get_db_post_option($pID);

switch ( $atts['layout'] ) :
    case '2':
?>
    <article class="service-item horizontal-item row align-items-center service-single2 <?php echo esc_attr( $filter_classes . ' ' . $atts['side_media_position']  . ' ' . $class ); ?>">
	<div class="col-12 col-lg-7">
		<?php if ( get_the_post_thumbnail() ) : ?>
            <div class="item-media">
                <?php the_post_thumbnail( 'weldo-full-width' ); ?>
                <div class="media-links">
                    <a class="abs-link" href="<?php the_permalink(); ?>"></a>
                </div>
            </div>
        <?php endif; //eof thumbnail check ?>
	</div>
	<div class="col-12 col-lg-5">
		<div class="item-content">
			<h4 class="special-heading service-title links-maincolor">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h4>
			<?php if ( ! empty( $option['subheading'] ) ) : ?>
                <p class="special-heading subheading with-line">
					<?php echo esc_html( $option['subheading'] ); ?>
				</p>
			<?php endif; //subheading
			if ( ! empty( $option['service_content'] ) ) : ?>
                <div class="divider-30 divider-xl-40"></div>
                <div class="service-content">
					<?php echo wp_kses_post( $option['service_content'] ); ?>
				</div>
			<?php endif; //service_content
			if ( $show_button ) : ?>
                <div class="fw-divider-space divider-30 divider-lg-43"></div>
                <a href="<?php the_permalink() ?>"
                   class="<?php echo esc_attr( $button['color'] . ' ' .  $button['size'] . ' ' .  $button['wide_button'] . ' ' . $button_custom_class ); ?>">
                    <?php echo esc_html( $button['label'] ); ?>
                </a>
			<?php endif; ?>
		</div>
	</div>
</article><!-- eof vertical-item -->
<?php
    break;
default :
?>
    <article <?php post_class( "service-item horizontal-item row align-items-center" . $filter_classes . ' ' . $atts['side_media_position']  . ' ' . $class ); ?>>
        <div class="col-12 col-lg-7">
            <?php if ( get_the_post_thumbnail() ) :
                if ( ! empty( $option['back_image']['url'] ) ) : ?>
                    <div class="images-wrap-item img-<?php echo esc_attr( $media_position ) ?>">
                        <?php the_post_thumbnail( 'weldo-service-width' ); ?>
                        <img class="image-back" src="<?php echo esc_url( $option['back_image']['url'] ); ?>"
                             alt="<?php the_title(); ?>"/>
                        <div class="media-links">
                            <a class="abs-link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="item-media">
                        <?php the_post_thumbnail( 'weldo-service-width' ); ?>
                        <div class="media-links">
                            <a class="abs-link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>
                <?php endif;
            endif; //eof thumbnail check ?>
        </div>
        <div class="col-12 col-lg-5">
            <div class="item-content">
                <div class="divider-40 divider-xl-105"></div>
                <h4 class="big special-heading service-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>
                <?php if ( ! empty( $option['subheading'] ) ) : ?>
                    <p class="special-heading subheading with-line">
                        <?php echo esc_html( $option['subheading'] ); ?>
                    </p>
                <?php endif; //subheading
                if ( ! empty( $option['service_content'] ) ) : ?>
                    <div class="divider-30 divider-xl-45"></div>
                    <div class="service-content">
                        <?php echo wp_kses_post( $option['service_content'] ); ?>
                    </div>
                <?php endif; //service_content
                if ( $show_button ) : ?>
                    <div class="fw-divider-space divider-40"></div>
                    <a href="<?php the_permalink() ?>"
                       class="<?php echo esc_attr( $button['color'] . ' ' .  $button['size'] . ' ' .  $button['wide_button'] . ' ' . $button_custom_class ); ?>">
                        <?php echo esc_html( $button['label'] ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </article><!-- eof vertical-item -->
<?php endswitch;
endwhile;