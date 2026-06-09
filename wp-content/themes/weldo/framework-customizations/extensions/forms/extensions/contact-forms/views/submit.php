<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var int $form_id
 * @var string $submit_button_text
 * @var array $extra_data
 */

$submit_button_color = !empty( $extra_data['submit_button_color'] ) ? $extra_data['submit_button_color'] : '';
$submit_button_wide = !empty( $extra_data['submit_button_wide'] ) ? $extra_data['submit_button_wide'] : '';
$submit_button_size = !empty( $extra_data['submit_button_size'] ) ? $extra_data['submit_button_size'] : '';
$submit_button_margin = !empty( $extra_data['submit_button_top_margin'] ) ? $extra_data['submit_button_top_margin'] : '';

?>
<div class="wrap-forms mt-20 <?php echo esc_attr( $submit_button_margin ); ?>">
	<div class="row">
		<div class="col-12 col-sm-12 mb-0">
			<input class="<?php echo esc_attr( $submit_button_color . ' ' . $submit_button_wide . ' ' . $submit_button_size ) ?>" type="submit"
			       value="<?php echo esc_attr( $submit_button_text ) ?>">
			<?php if ( $extra_data['reset_button_text'] ) : ?>
				<input class="btn btn-outline-dark" type="reset"
				       value="<?php echo esc_attr( $extra_data['reset_button_text'] ); ?>">
			<?php endif; ?>
		</div>
	</div>
</div>