<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
<span class="social-icons">
	<?php
	if ( is_array( $atts['social_icons'] ) ) {
		foreach ($atts['social_icons'] as $icon) :
			?>
			<a href="<?php echo esc_url($icon['icon_url']) ?>"
			   class="<?php echo esc_attr($icon['icon']); ?> <?php echo esc_attr($icon['icon_class']); ?>"></a>
		<?php
		endforeach;
	}
	?>
</span>
