<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var $atts
 */

if ( ! $atts['steps'] ) {
	return;
}

$col = 'col-lg-12';
if ( count( $atts['steps'] ) == 2 ) {
	$col = 'col-md-6';
} elseif ( count( $atts['steps'] ) == 3 ) {
	$col = 'col-md-6 col-lg-4';
} elseif ( count( $atts['steps'] ) == 4 ) {
	$col = 'col-md-6 col-lg-3';
}
?>

<div class="steps2 row c-gutter-0 text-center <?php echo esc_attr( $atts['show_step_count'] ) ?>">
    <?php foreach ( $atts['steps'] as $step ) :
	    $text_color = ! empty( $step['text_color'] ) ? $step['text_color'] : '';
	    $has_padding = ! empty( $step['step_background_color'] ) ? 'step-padding' : '';
	    ?>
        <div class="col-12 <?php echo esc_attr( $col ) ?>">
            <div class="step <?php echo esc_attr( $step['step_custom_class'] . ' ' . $has_padding . ' ' . $step['step_background_color'] ) ?>">
                <?php
                if ( ! empty( $step['step_title'] ) ) : ?>
                    <h6 class="step-title special-heading step-part <?php echo esc_attr( $text_color . ' ' . $step['title_line'] ); ?>">
                        <span class="<?php echo esc_attr( $step['title_text_transform'] . ' ' . $step['title_letter_spacing'] ); ?>">
                            <?php echo esc_html( $step['step_title'] ) ?>
                        </span>
                    </h6>
                <?php endif;
                if ( ! empty( $step['step_text'] ) ) : ?>
                    <p class="<?php echo esc_attr( $text_color ); ?>">
                        <?php echo esc_html( $step['step_text'] ) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>