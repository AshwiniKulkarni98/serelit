<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var string $form_id
 * @var string $form_html
 * @var array $extra_data
 */

global $allowedposttags;
$form_tags = $allowedposttags;
$form_tags['input'] = array(
	'type' => true,
	'id' => true,
	'class' => true,
	'name' => true,
	'value' => true,
	'placeholder' => true,
	'required' => true,
	'data-pick-time' => true,
	'data-pick-date' => true,
	'data-language' => true,
	'data-constraint' => true,
);
$form_tags['select'] = array(
	'type' => true,
	'id' => true,
	'class' => true,
	'name' => true,
	'value' => true,
	'placeholder' => true,
	'required' => true,
	'data-pick-time' => true,
	'data-pick-date' => true,
	'data-language' => true,
	'data-constraint' => true,
);
$form_tags['form']['method'] = true;
$form_tags['form']['action'] = true;
$form_tags['form']['class'] = true;
$form_tags['form']['data-fw-form-id'] = true;
$form_tags['form']['data-fw-ext-forms-type'] = true;
$form_tags['form']['data-pick-time'] = true;
$form_tags['form']['data-pick-date'] = true;
$form_tags['form']['data-language'] = true;
$form_tags['textarea']['placeholder'] = true;
$form_tags['textarea']['required'] = true;
$form_tags['option']['value'] = true;

$row_class = '';
$row_class .=  ( ! empty ( $extra_data['columns_padding'] ) ) ? $extra_data['columns_padding'] : '';
$row_class .=  ( !empty ( $extra_data['columns_margin_bottom'] ) ) ? $extra_data['columns_margin_bottom'] : '';
$row_class_replace = '"row ' . $extra_data['columns_padding'] . ' ' . $extra_data['columns_margin_bottom'] . '"';
$form_html = str_replace('"row"', $row_class_replace, $form_html );
$class = ! empty( $extra_data['additional_class'] ) ? $extra_data['additional_class'] : '';

?>

<div class="form-wrapper <?php echo esc_attr( $extra_data['background_color'] . ' ' . $extra_data['small_form'] . ' ' . $class ); ?>">
	<?php echo wp_kses($form_html, $form_tags); ?>
    <div class="form-error-message">
        <?php FW_Flash_Messages::_print_frontend(); ?>
    </div>
</div>