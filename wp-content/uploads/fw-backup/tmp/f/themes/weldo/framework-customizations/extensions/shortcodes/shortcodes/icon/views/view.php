<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
<div class="icon-inline">
    <?php if ( $atts['icon'] ): ?>
        <div class="icon-styled">
            <i class="<?php echo esc_attr( $atts['icon'] . ' ' . $atts['icon_style'] ); ?> fs-14"></i>
        </div>
    <?php endif; //icon
    ?>
    <p>
        <?php if ( ! empty ( $atts['title'] ) ) : ?>
        <span class="fs-20 fw-icon-title">
            <?php echo wp_kses_post( $atts['title'] ); ?>
        </span>
        <?php endif; ?>
        <?php echo wp_kses_post( $atts['text'] ); ?>
    </p>
</div>
