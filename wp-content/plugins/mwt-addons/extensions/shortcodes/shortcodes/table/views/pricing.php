<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

$class_width = 'col-md-' . ceil( 12 / count( $atts['table']['cols'] ) );
?>

<div class="row fw-pricing">
	<?php foreach ( $atts['table']['cols'] as $col_key => $col ): ?>
	<div class="fw-package-wrap <?php echo esc_attr( $class_width . ' ' . $col['name'] ); ?> ">
    <?php if ( $col['name'] === 'desc-col' ) : //description column main div ?>
		<div class="fw-package text-right pricing-plan">
    <?php else: //price table col div ?>
        <div class="fw-package pricing-plan box-shadow <?php echo esc_attr( $col['name'] == 'highlight-col' ? 'plan-featured' : '' ); ?>">
    <?php endif; // desc-col ?>
        <?php foreach ( $atts['table']['rows'] as $row_key => $row ): ?>
            <?php if ( $row['name'] === 'heading-row' ): ?>
                <div class="fw-heading-row plan-name">
                    <?php $value = $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
                    <h3>
                        <?php echo ( empty( $value ) && $col['name'] === 'desc-col' ) ? '&nbps;' : $value; ?>
                    </h3>
                </div>
            <?php elseif ( $row['name'] === 'pricing-row' ): ?>
                <div class="fw-pricing-row price-wrap color-darkgrey">
                    <?php
                    if ( $col['name'] == 'desc-col' ) : ?>
                        <?php $value = $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
                        <span class="plan-price">
                            &nbsp;
                        <?php echo wp_kses_post( $value ); ?>
                        </span>
                    <?php else: ?>
                        <?php $amount = $atts['table']['content'][ $row_key ][ $col_key ]['amount'] ?>
                        <?php $desc = $atts['table']['content'][ $row_key ][ $col_key ]['description']; ?>
                        <span class="price-sign"><?php echo esc_html( $atts['price_sign'] ); ?></span>
                        <span class="plan-price"><?php echo ( empty( $value ) && $col['name'] === 'desc-col' ) ? '&nbps;' : $amount; ?></span>
                        <p><?php echo ( empty( $value ) && $col['name'] === 'desc-col' ) ? '&nbps;' : $desc; ?></p>
                    <?php endif; //desc-col ?>
                </div><!-- .price-wrap -->
                <div class="divider-40"></div>
            <?php elseif ( $row['name'] == 'button-row' ) : ?>
                <div class="fw-button-row plan-button">
                    <?php if ( $col['name'] == 'desc-col' ) : ?>
                </div><!-- .fw-button-row -->
                        <?php continue; ?>
                    <?php else: ?>
                        <?php $button = fw_ext( 'shortcodes' )->get_shortcode( 'button' ); ?>

                        <?php if ( false === empty( $atts['table']['content'][ $row_key ][ $col_key ]['button'] ) and false === empty( $button ) ) : ?>
                            <?php echo wp_kses_post( $button->render( $atts['table']['content'][ $row_key ][ $col_key ]['button'] ) ); ?>
                        <?php else : ?>
                            <span>&nbsp;</span>
                        <?php endif; ?>

                    <?php endif; ?>
                </div><!-- .fw-button-row -->
            <?php elseif ( $row['name'] === 'switch-row' ) : ?>
                <div class="fw-switch-row">
                    <?php if ( $col['name'] == 'desc-col' ) : ?>
                        <?php $value = $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
                        <?php echo wp_kses_post( $value ); ?>
                    <?php else: ?>

                        <?php $value = ( $atts['table']['content'][ $row_key ][ $col_key ]['switch'] == 'yes' ) ? 'fa fa-check' : 'fa fa-remove'; ?>
                        <span>
                            <i class="color-darkgrey <?php echo esc_attr( $value ) ?>"></i>
                        </span>
                    <?php endif; ?>
                </div><!-- .fw-switch-row -->
            <?php elseif ( $row['name'] === 'default-row' ) : ?>
                <div class="fw-default-row">
                    <?php if ( $col['name'] == 'desc-col' ) : ?>
                        <?php $value = $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
                        <?php echo wp_kses_post( $value ); ?>
                    <?php else: ?>

                        <?php $value = $atts['table']['content'][ $row_key ][ $col_key ]['textarea']; ?>
                        <?php echo wp_kses_post( $value ); ?>

                    <?php endif; ?>
                    <hr>
                </div><!-- .fw-default-row -->
            <?php endif; ?>
        <?php endforeach; //row ?>
			</div><!-- .fw-package -->
		</div><!-- .fw-package-wrap -->
    <?php endforeach; //col ?>
</div><!-- .row.fw-pricing -->
