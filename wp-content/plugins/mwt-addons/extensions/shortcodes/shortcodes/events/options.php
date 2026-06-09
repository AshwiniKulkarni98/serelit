<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$events = fw()->extensions->get( 'events' );
if ( empty( $events ) ) {
	return;
}

$options = array(
	'number'        => array(
		'type'       => 'slider',
		'value'      => 6,
		'properties' => array(
			'min'  => 1,
			'max'  => 50,
			'step' => 1,

		),
		'label'      => esc_html__( 'Items number', 'weldo' ),
		'desc'       => esc_html__( 'Number of events to display', 'weldo' ),
	),
    'nav'           => array(
        'type'         => 'switch',
        'value'        => 'true',
        'label'        => esc_html__( 'Show Navigation', 'weldo' ),
        'left-choice'  => array(
            'value' => 'false',
            'label' => esc_html__( 'No', 'weldo' ),
        ),
        'right-choice' => array(
            'value' => 'true',
            'label' => esc_html__( 'Yes', 'weldo' ),
        ),
    ),
    'margin'        => array(
        'label'   => esc_html__( 'Horizontal item margin (px)', 'weldo' ),
        'desc'    => esc_html__( 'Select horizontal item margin', 'weldo' ),
        'value'   => '30',
        'type'    => 'select',
        'choices' => array(
            '0'  => esc_html__( '0', 'weldo' ),
            '1'  => esc_html__( '1px', 'weldo' ),
            '2'  => esc_html__( '2px', 'weldo' ),
            '10' => esc_html__( '10px', 'weldo' ),
            '30' => esc_html__( '30px', 'weldo' ),
        )
    ),
    'responsive_lg' => array(
        'label'   => esc_html__( 'Columns on large screens', 'weldo' ),
        'desc'    => esc_html__( 'Select items number on wide screens (>1200px)', 'weldo' ),
        'value'   => '4',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__( '1', 'weldo' ),
            '2' => esc_html__( '2', 'weldo' ),
            '3' => esc_html__( '3', 'weldo' ),
            '4' => esc_html__( '4', 'weldo' ),
            '6' => esc_html__( '6', 'weldo' ),
        )
    ),
    'responsive_md' => array(
        'label'   => esc_html__( 'Columns on middle screens', 'weldo' ),
        'desc'    => esc_html__( 'Select items number on middle screens (>992px)', 'weldo' ),
        'value'   => '3',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__( '1', 'weldo' ),
            '2' => esc_html__( '2', 'weldo' ),
            '3' => esc_html__( '3', 'weldo' ),
            '4' => esc_html__( '4', 'weldo' ),
            '6' => esc_html__( '6', 'weldo' ),
        )
    ),
    'responsive_sm' => array(
        'label'   => esc_html__( 'Columns on small screens', 'weldo' ),
        'desc'    => esc_html__( 'Select items number on small screens (>768px)', 'weldo' ),
        'value'   => '2',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__( '1', 'weldo' ),
            '2' => esc_html__( '2', 'weldo' ),
            '3' => esc_html__( '3', 'weldo' ),
            '4' => esc_html__( '4', 'weldo' ),
            '6' => esc_html__( '6', 'weldo' ),
        )
    ),
    'responsive_xs' => array(
        'label'   => esc_html__( 'Columns on extra small screens', 'weldo' ),
        'desc'    => esc_html__( 'Select items number on extra small screens (<767px)', 'weldo' ),
        'value'   => '1',
        'type'    => 'select',
        'choices' => array(
            '1' => esc_html__( '1', 'weldo' ),
            '2' => esc_html__( '2', 'weldo' ),
            '3' => esc_html__( '3', 'weldo' ),
            '4' => esc_html__( '4', 'weldo' ),
            '6' => esc_html__( '6', 'weldo' ),
        )
    ),
	'show_filters'  => array(
		'type'         => 'switch',
		'value'        => false,
		'label'        => esc_html__( 'Show filters', 'weldo' ),
		'desc'         => esc_html__( 'Hide or show categories filters', 'weldo' ),
		'left-choice'  => array(
			'value' => false,
			'label' => esc_html__( 'No', 'weldo' ),
		),
		'right-choice' => array(
			'value' => true,
			'label' => esc_html__( 'Yes', 'weldo' ),
		),
	)
);