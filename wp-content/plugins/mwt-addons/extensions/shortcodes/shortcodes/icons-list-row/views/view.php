<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$path = $atts['columns_width']['type'];

?>

<div class="row icon-list-row">
	<?php if ( !empty ( $atts['columns_width'][$path]['icons'] ) ) { ?>
		<div class="<?php echo esc_attr( $path); ?>">
			<div class="<?php echo esc_attr( $atts['background_color'] ); ?>">
				<?php if ( !empty ( $atts['columns_width'][$path]['heading_text'] ) ) : ?>
					<h4 class="row-title">
						<?php echo( esc_attr( $atts['columns_width'][$path]['heading_text'] ) ); ?>
					</h4>
				<?php endif; ?>
				<ul class="list-icons">
					<?php foreach ( $atts['columns_width'][$path]['icons'] as $icon ): ?>
						<li>
							<?php echo fw_ext( 'shortcodes' )->get_shortcode( 'icon' )->render( $icon ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php } ?>

	<?php if ( !empty ( $atts['columns_width'][$path]['icons2'] ) ) { ?>
		<div class="<?php echo esc_attr( $path); ?>">
			<div class="<?php echo esc_attr( $atts['background_color'] ); ?>">
				<?php if ( !empty ( $atts['columns_width'][$path]['heading_text2'] ) ) : ?>
					<h4 class="row-title">
						<?php echo( esc_attr( $atts['columns_width'][$path]['heading_text2'] ) ); ?>
					</h4>
				<?php endif; ?>
				<ul class="list-icons">
					<?php foreach ( $atts['columns_width'][$path]['icons2'] as $icon ): ?>
						<li>
							<?php echo fw_ext( 'shortcodes' )->get_shortcode( 'icon' )->render( $icon ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php } ?>
</div>