<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'message' => array(
		'label' => esc_html__( 'Message', 'weldo' ),
		'desc'  => esc_html__( 'Notification message', 'weldo' ),
		'type'  => 'textarea',
		'value' => esc_html__( 'Message!', 'weldo' ),
	),
	'type'    => array(
		'label'   => esc_html__( 'Type', 'weldo' ),
		'desc'    => esc_html__( 'Notification type', 'weldo' ),
		'type'    => 'select',
		'choices' => array(
			'success' => esc_html__( 'Congratulations', 'weldo' ),
			'info'    => esc_html__( 'Information', 'weldo' ),
			'warning' => esc_html__( 'Alert', 'weldo' ),
			'danger'  => esc_html__( 'Error', 'weldo' ),
		)
	),
);