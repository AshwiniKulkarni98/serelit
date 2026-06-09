<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>
<div class="bootstrap-tabs <?php echo esc_attr( $atts['small_tabs'] ); ?>">
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach ( $atts['tabs'] as $index => $tab ) : ?>
			<li class="nav-item">
				<a
					id="tab_link-<?php echo esc_attr( $atts['id'] ) . '-' . $index ?>"
					class="nav-link<?php echo ( 0 === $index ) ? ' active' : '' ?>"
					href="#tab-<?php echo esc_attr( $atts['id'] ) . '-' . $index ?>"
					role="tab"
					data-toggle="tab"
					aria-controls="tab-<?php echo esc_attr( $atts['id'] . '-' . $index ); ?>"
					aria-expanded="<?php echo( 0 === $index ) ? 'true' : 'false' ?>"
				>
					<?php if ( $tab['tab_icon'] ) : ?>
						<i class="<?php echo esc_attr( $tab['tab_icon'] ); ?>"></i>
					<?php endif; //tab icon ?>
					<?php echo esc_html( $tab['tab_title'] ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="tab-content">
		<?php foreach ( $atts['tabs'] as $index => $tab ) : ?>
			<div class="tab-pane fade <?php echo ( 0 === $index ) ? 'show active' : '' ?>"
			 	id="tab-<?php echo esc_attr( $atts['id'] . '-' . $index ); ?>"
				role="tabpanel"
				aria-labelledby="tab_link-<?php echo esc_attr( $atts['id'] ) . '-' . $index ?>"
			>
				<?php if ( $tab['tab_featured_image'] ) : ?>
					<p class="featured-tab-image">
						<img src="<?php echo esc_url( $tab['tab_featured_image']['url'] ); ?>"
						     alt="<?php echo esc_attr( $tab['tab_title'] ); ?>">
					</p>
				<?php endif; //tab featured image ?>
				<?php echo wp_kses_post( $tab['tab_content'] ); ?>
			</div><!-- .eof tab-pane -->
		<?php endforeach; ?>
	</div>
</div>