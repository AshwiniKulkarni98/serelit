<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$class = ! empty( $atts['class'] ) ? $atts['class'] : '';

?>

<div id="accordion-<?php echo esc_attr( $atts['id'] ); ?>" role="tablist" class="<?php echo esc_attr( $class ); ?>">
    <?php foreach ( $atts['tabs'] as $index => $tab ) : ?>
        <div class="card">
            <div class="card-header" role="tab" id="collapse_header_<?php echo esc_attr( $index . '-' . $atts['id'] ); ?>">
                <p>
                    <a
                        class="<?php echo( 0 === $index ) ? '' : 'collapsed' ?>"
                        data-toggle="collapse"
                        href="#collapse-<?php echo esc_attr( $atts['id'] . '-' . $index ); ?>"
                        aria-expanded="<?php echo( 0 === $index ) ? 'true' : 'false' ?>"
                        aria-controls="collapse-<?php echo esc_attr( $atts['id'] . '-' . $index ); ?>"
                    >
                        <?php if ( $tab['tab_icon'] ) : ?>
                            <i class="<?php echo esc_attr( $tab['tab_icon'] ); ?>"></i>
                        <?php endif; //tab icon ?>
                        <?php echo esc_html( $tab['tab_title'] ); ?>
                    </a>
                </p>
            </div>
            <div id="collapse-<?php echo esc_attr( $atts['id']  . '-' . $index ); ?>"
                class="collapse <?php echo( 0 === $index ) ? 'show' : '' ?>"
                role="tabpanel"
                data-parent="#accordion-<?php echo esc_attr( $atts['id'] ); ?>"
                aria-labelledby="collapse_header_<?php echo esc_attr( $index . '-' . $atts['id'] ); ?>"
            >
                <div class="card-body">
                    <?php if ( $tab['tab_featured_image'] ): ?>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img src="<?php echo esc_url( $tab['tab_featured_image']['url'] ); ?>"
                                         alt="<?php echo esc_attr( $tab['tab_title'] ); ?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <?php echo wp_kses_post( $tab['tab_content'] ); ?>
                            </div>
                        </div>
                    <?php else : //no featured image ?>
                        <?php echo wp_kses_post( $tab['tab_content'] ); ?>
                    <?php endif; //featured image ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
