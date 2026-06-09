<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$dividers_height = array( '-5', '-30', '-60', '-130', '-150', '0', '5', '10', '20', '25', '30', '35', '40', '45', '50', '55', '60', '65', '70', '75', '80', '90', '95', '100', '105', '120', '145', '150' );

$breakpoints = array( 'sm', 'md', 'lg', 'xl' );

$choices = array( '' => '-' );
foreach ( $dividers_height as $height ) {
	$choices[$height] = $height . esc_html__( 'px', 'weldo' );
}

$height_options = array(
	'all' => array(
		'type' => 'select',
		'value' => '',
		'label' => esc_html__( 'Height', 'weldo' ),
		'choices' => $choices,
	)
);

foreach ( $breakpoints as $breakpoint) {
	$choices = array( '' => '-' );
	foreach ( $dividers_height as $height ) {
		$choices[$height] = $height . esc_html__( 'px', 'weldo' );
	}
	$height_options[$breakpoint] = array(
		'type' => 'select',
		'value' => '',
		'label' => esc_html__( 'Height on ', 'weldo' ) . strtoupper( $breakpoint ) . esc_html__( ' screens', 'weldo' ),
		'choices' => $choices,
	);
}

$options = array_merge( array(
	'unique_id' => array(
		'type' => 'unique',
		'length' => 7
	),
), $height_options );
