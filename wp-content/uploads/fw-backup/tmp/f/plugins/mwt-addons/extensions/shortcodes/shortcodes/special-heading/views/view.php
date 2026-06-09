<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var $atts
 */
if ( ! $atts['headings'] ) {
	return;
}

foreach ( $atts['headings'] as $key => $heading ) :
	$heading_text_color       = !empty( $heading['heading_text_color'] ) ? $heading['heading_text_color'] : '';
	$heading_text_weight      = !empty( $heading['heading_text_weight'] ) ? $heading['heading_text_weight'] : '';
	$heading_text_transform   = !empty( $heading['heading_text_transform'] ) ? $heading['heading_text_transform'] : '';
	$heading_letter_spacing   = !empty( $heading['heading_letter_spacing'] ) ? $heading['heading_letter_spacing'] : '';
	$heading_line_height      = !empty( $heading['heading_line_height'] ) ? $heading['heading_line_height'] : '';
	$heading_font_family      = !empty( $heading['heading_font_family'] ) ? $heading['heading_font_family'] : '';
	$heading_line             = !empty( $heading['heading_line'] ) ? $heading['heading_line'] : '';
	$heading_link             = !empty( $heading['heading_text_link'] ) ? $heading['heading_text_link'] : '';
	$heading_custom_class     = !empty( $heading['heading_custom_class'] ) ? $heading['heading_custom_class'] : '';
	$heading_tag_size         = !empty( $heading['heading_tag_size'] ) ? $heading['heading_tag_size'] : '';
	$class = '';
	//for headings
	if ( $heading['heading_tag'] ) :
		$class .= 'special-heading';
	else:
		$class .= 'color-darkgrey';
	endif;
	//for paragraph
	$icon_array = weldo_get_unyson_icon_type_v2_array_for_special_heading( $atts, $key );
	?>
	<<?php echo esc_html( $heading['heading_tag'] ); ?> class="<?php echo esc_attr( $class . ' ' . $atts['heading_align']  . ' ' . $heading_tag_size ); ?>">
        <?php if ( !empty( $icon_array ) ) :
            echo wp_kses_post( $icon_array['icon_html'] );
        endif; ?>
        <?php if( $heading_link ) : ?>
            <a href="<?php echo esc_url( $heading_link ); ?>">
        <?php endif; ?>
        <span class="<?php echo esc_attr( trim (
            $heading_text_color
            . ' ' .
            $heading_text_weight
            . ' ' .
            $heading_text_transform
            . ' ' .
            $heading_letter_spacing
            . ' ' .
            $heading_line_height
            . ' ' .
            $heading_font_family
            . ' ' .
            $heading_line
            . ' ' .
            $heading_custom_class
    
        ) );
    
        ?>">
            <?php echo wp_kses_post( $heading['heading_text'] ) ?>
        </span>
        <?php if( $heading_link ) : ?>
            </a>
        <?php endif; ?>
    
    </<?php echo esc_html( $heading['heading_tag'] ); ?>>

<?php endforeach; ?>

