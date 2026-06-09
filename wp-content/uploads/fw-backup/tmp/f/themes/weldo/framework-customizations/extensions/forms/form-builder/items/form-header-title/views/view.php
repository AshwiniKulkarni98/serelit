<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var string $title
 * @var string $subtitle
 */

if ( empty( $title ) ) {
	return;
}
?>
<div class="col-xs-12 form-builder-item">
	<div class="header title">
		<h2><?php echo wp_kses_post( $title ); ?></h2>
		<?php if ( ! empty( $subtitle ) ) : ?>
			<p><?php echo wp_kses_post( $subtitle ); ?></p>
		<?php endif ?>
	</div>
</div>