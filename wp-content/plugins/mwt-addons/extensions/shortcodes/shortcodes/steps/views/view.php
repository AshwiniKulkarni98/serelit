<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var $atts
 */

if ( ! $atts['steps'] ) {
	return;
}
?>
<?php
$count = '';
if ( count( $atts['steps'] ) == 1 ) {
	$count = 'steps-count-1';
} elseif ( count( $atts['steps'] ) == 2 )
	$count = 'steps-count-2';

$arrow = ! empty( $atts['arrow_style'] ) ? $atts['arrow_style'] : '';

?>

<?php if ( $atts['step_layout'] == '1' ) : ?>
	<div class="steps text-center <?php echo esc_attr( $count . ' ' . $arrow . ' ' . $atts['show_step_count'] . ' ' . $atts['step_background_color'] . ' ' . $atts['show_pattern'] ) ?>">
		<?php foreach ( $atts['steps'] as $step ) : ?>
			<div class="step <?php echo esc_attr( $step['step_custom_class'] ) ?>">
				<?php if ( ! empty( $step['step_image'] ) ) :
					$image = fw_resize( $step['step_image']['attachment_id'], '200', '200', true );
					?>
					<div class="step-image mb-30">
						<span class="step-part">
							<img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr__( 'step image', 'weldo' ) ?>">
						</span>
					</div>
				<?php endif;
 				if ( ! empty( $step['step_title'] ) ) : ?>
                    <h4 class="step-title <?php echo esc_attr( $step['title_color'] ); ?>">
						<?php echo esc_html( $step['step_title'] ) ?>
					</h4>
			    <?php endif;
				if ( !empty($step['step_text']) ) : ?>
					<p><?php echo esc_html($step['step_text'])?></p>
				<?php endif;?>
			</div>
		<?php endforeach;?>
	</div>
<?php elseif ( $atts['step_layout'] == '2' ) : ?>
	<div class="steps-alt text-center <?php echo esc_attr( $count . ' ' . $arrow . ' ' . $atts['show_step_count'] . ' ' . $atts['step_background_color'] . ' ' . $atts['show_pattern'] ) ?>">
		<?php foreach ( $atts['steps'] as $step ) : ?>
		<div class="step <?php echo esc_attr( $step['step_custom_class'] ) ?>">
			<?php if ( ! empty( $step['step_image'] ) ) :
				$image = fw_resize( $step['step_image']['attachment_id'], '200', '200', true );
				?>
				<div class="step-image mb-30">
					<img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr__( 'step image', 'weldo' ) ?>">
				</div>
			<?php endif;
			if ( ! empty( $step['step_title'] ) ) : ?>
				<p class="step-title step-part <?php echo esc_attr( $step['title_color'] ); ?>">
					<?php echo esc_html($step['step_title'])?>
				</p>
			<?php endif;
			if ( !empty($step['step_text']) ) : ?>
				<p><?php echo esc_html($step['step_text'])?></p>
			<?php endif;?>
		</div>
		<?php endforeach;?>
	</div>
<?php endif;?>





