<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$line_align  = ! empty( $atts['show_line'] ) ? 'text-center' : false;

?>

<div class="fw-signature <?php echo esc_html( $line_align ); ?>">
	<?php if ( $atts['show_line'] ) : ?>
		<div class="signature-line">
	<?php endif; ?>
		<?php if ( !empty( $atts['image']['url'] ) ) : ?>
			<img src="<?php echo esc_url( $atts['image']['url'] ); ?>" alt="<?php echo esc_attr( $atts['image']['url'] ); ?>">
		<?php endif; ?>
	<?php if ( $atts['show_line'] ) : ?>
	</div>
	<?php endif; ?>
</div>