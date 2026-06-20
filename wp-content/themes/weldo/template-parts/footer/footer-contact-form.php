<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'weldo_render_footer_contact_form' ) ) {
	return;
}

$form_html = weldo_render_footer_contact_form();
if ( empty( $form_html ) ) {
	return;
}
?>
<div class="footer-contact-form-widget">
	<h4 class="footer-form-heading">
		Brauchen Sie <mark>Unterschützen?</mark>?
	</h4>
	<p class="footer-form-subtitle">
		ZÖGERN SIE BITTE NICHT, UNS ZU KONTAKTIEREN.
	</p>
	<div class="footer-form-fields">
		<?php echo $form_html; ?>
	</div>
</div>