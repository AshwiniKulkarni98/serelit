<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

?>
<div class="alert alert-<?php echo esc_attr( $atts['type'] ); ?>">
	<?php
	echo wp_kses_post( $atts['message'] );
	?>
</div>