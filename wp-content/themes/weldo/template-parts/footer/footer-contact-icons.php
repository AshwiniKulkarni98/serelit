<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = weldo_get_options();
?>
<div class="widget widget_icons_list">
	<h3 class="widget-title">Kontakt</h3>
	<ul class="list-unstyled">
		<?php if ( ! empty( $options['meta_phone'] ) ) : ?>
			<li class="icon-inline">
				<a href="callto:<?php echo esc_attr( ucfirst( str_replace( ' ', '-', $options['meta_phone'] ) ) ); ?>">
					<i class="ico ico-phone color-main fs-14 pr-2"></i>
					<span><?php echo esc_html( $options['meta_phone'] ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $options['meta_address'] ) ) : ?>
			<li class="icon-inline">
				<i class="color-main fs-14 ico ico-map-marker mr-2"></i>
				<span><?php echo esc_html( $options['meta_address'] ); ?></span>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $options['meta_email'] ) ) : ?>
			<li class="icon-inline">
				<a href="mailto:<?php echo esc_attr( $options['meta_email'] ); ?>">
					<i class="color-main fs-14 ico ico-envelope-alt mr-2"></i>
					<span><?php echo esc_html( $options['meta_email'] ); ?></span>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</div>