<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */

$icon_array = weldo_get_unyson_icon_type_v2_array( $atts, 'icon' );
$icon_styled_class = weldo_get_unyson_icon_styled_class( $atts );

$title = $atts['title'];
$content = $atts['content'];
$link = $atts['link'];
$button = $atts['button']['button'];
$show_button = ( ! empty( $link ) && ! empty( $atts['button']['show_button'] ) && ! empty( $button['label'] ) ) ? true : false;
$button_custom_class = ( ! empty( $button['custom_class'] ) ) ? $button['custom_class'] : '';
switch ($atts['style']) :
    case 'top':
?>
<div class="icon-box <?php echo esc_attr( trim( $atts['background_color'] . ' ' . $atts['text_align'] . ' ' . $atts['class'] ) ); ?>">
<?php if( $link ) : ?>
    <a href="<?php echo esc_url( $link ); ?>">
<?php endif; ?>
    <div class="icon-styled <?php echo esc_attr( $icon_styled_class ); ?>">
        <?php echo wp_kses_post( $icon_array['icon_html'] ); ?>
    </div>
<?php if( $link ) : ?>
    </a>
<?php endif; ?>
<?php if( $title ) : ?>
	<h6 class="<?php echo esc_attr(  $atts['title_size'] . ' ' . $atts['title_text_transform'] . ' ' . $atts['title_text_color'] ); ?>">
    <?php if( $link ) : ?>
        <a href="<?php echo esc_url( $link ); ?>">
    <?php endif; ?>
        <?php echo wp_kses_post( $atts['title'] ); ?>
    <?php if( $link ) : ?>
        </a>
    <?php endif; ?>
    </h6>
<?php endif; ?>
<?php if( $content ) : ?>
    <p><?php echo wp_kses_post( $atts['content'] ); ?></p>
<?php endif; ?>
<?php if ( $show_button ) : ?>
    <a href="<?php echo esc_url( $link ); ?>"
       class="<?php echo esc_attr( $button['color'] . ' ' .  $button['size'] . ' ' .  $button['wide_button'] . ' ' . $button_custom_class ); ?>"><?php echo esc_html( $button['label'] ); ?></a>
<?php endif; ?>
</div><!-- .icon-box -->
<?php
    break;
    case 'left':
?>
<div class="media <?php echo esc_attr( trim( $atts['background_color'] . ' ' . $atts['text_align'] . ' ' . $atts['class'] ) ); ?>">
    <?php if( $link ) : ?>
    <a href="<?php echo esc_url( $link ); ?>">
        <?php endif; ?>
        <div class="icon-styled <?php echo esc_attr( $icon_styled_class ); ?>">
            <?php echo wp_kses_post( $icon_array['icon_html'] ); ?>
        </div>
        <?php if( $link ) : ?>
    </a>
<?php endif; ?>
    <div class="media-body">
    <?php if( $title ) : ?>
        <h6 class="<?php echo esc_attr(  $atts['title_size'] . ' ' . $atts['title_text_transform'] . ' ' . $atts['title_text_color'] ); ?>">
        <?php if( $link ) : ?>
            <a href="<?php echo esc_url( $link ); ?>">
        <?php endif; ?>
                <?php echo wp_kses_post( $atts['title'] ); ?>
        <?php if( $link ) : ?>
            </a>
        <?php endif; ?>
        </h6>
    <?php endif; ?>
    <?php if( $content ) : ?>
        <p><?php echo wp_kses_post( $atts['content'] ); ?></p>
    <?php endif; ?>
    <?php if ( $show_button ) : ?>
        <a href="<?php echo esc_url( $link ); ?>"
           class="<?php echo esc_attr( $button['color'] . ' ' .  $button['size'] . ' ' .  $button['wide_button'] . ' ' . $button_custom_class ); ?>"><?php echo esc_html( $button['label'] ); ?></a>
    <?php endif;
    ?>
    </div>
</div><!-- .media -->
<?php
    break;
	case 'right':
?>
<div class="media <?php echo esc_attr( trim( $atts['background_color'] . ' ' . $atts['text_align'] . ' ' . $atts['class'] ) ); ?>">
    <div class="media-body">
        <?php if( $title ) : ?>
			<h6 class="<?php echo esc_attr(  $atts['title_size'] . ' ' . $atts['title_text_transform'] . ' ' . $atts['title_text_color'] ); ?>">
                <?php if( $link ) : ?>
                <a href="<?php echo esc_url( $link ); ?>">
                    <?php endif; ?>
                    <?php echo wp_kses_post( $atts['title'] ); ?>
                    <?php if( $link ) : ?>
                </a>
            <?php endif; ?>
            </h6>
        <?php endif; ?>
        <?php if( $content ) : ?>
            <p><?php echo wp_kses_post( $atts['content'] ); ?></p>
        <?php endif; ?>
        <?php if ( $show_button ) : ?>
            <a href="<?php echo esc_url( $link ); ?>"
               class="<?php echo esc_attr( $button['color'] . ' ' .  $button['size'] . ' ' .  $button['wide_button'] . ' ' . $button_custom_class ); ?>"><?php echo esc_html( $button['label'] ); ?></a>
        <?php endif; ?>
    </div>
<?php if( $link ) : ?>
    <a href="<?php echo esc_url( $link ); ?>">
<?php endif; ?>
    <div class="icon-styled <?php echo esc_attr( $icon_styled_class ); ?>">
        <?php echo wp_kses_post( $icon_array['icon_html'] ); ?>
    </div>
<?php if( $link ) : ?>
    </a>
<?php endif; ?>
</div><!-- .media -->
<?php
    break;
    endswitch;