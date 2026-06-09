<?php
if ( ! defined( 'FW' ) &&  !function_exists('_uws_fw_extensions_locations') ) {
	return;
}

$options = array(
	'unique_id' => array(
		'type' => 'unique'
	),
	'type'      => array(
		'label'   => esc_html__( 'Type', 'weldo' ),
		'desc'    => esc_html__( 'Select the type', 'weldo' ),
		'type'    => 'short-select',
		'value'   => 'default',
		'choices' => array(
			'default'      => 'Default',
			'on_sale'      => 'On Sale',
			'best_selling' => 'Best Selling',
			'top_rated'    => 'Top Rated',
		)
	),
	'limit'     => array(
		'label' => esc_html__( 'Limit', 'weldo' ),
		'desc'  => esc_html__( 'Enter the limit', 'weldo' ),
		'type'  => 'short-text',
		'value' => '12',
	),
	'layout' => array(
		'type'    => 'select',
		'value'   => '',
		'label'   => esc_html__( 'Products Layout', 'weldo' ),
		'choices' => array(
			''             => esc_html__( 'Grid (default)', 'weldo' ),
			'carousel-layout'     => esc_html__( 'Carousel', 'weldo' ),
		),
	),
	'columns'   => array(
		'label'   => esc_html__( 'Columns', 'weldo' ),
		'desc'    => esc_html__( 'Enter the columns', 'weldo' ),
		'type'    => 'short-select',
		'value'   => '4',
		'choices' => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
		)
	),
	'category'  => array(
		'label'      => esc_html__( 'Categories', 'weldo' ),
		'desc'       => esc_html__( 'Select the categories', 'weldo' ),
		'type'       => 'multi-select',
		'value'      => '',
		'population' => 'taxonomy',
		'source'     => 'product_cat',
	),
	'orderby'   => array(
		'label'   => esc_html__( 'Order by', 'weldo' ),
		'desc'    => esc_html__( 'Select the order by', 'weldo' ),
		'type'    => 'short-select',
		'value'   => 'title',
		'choices' => array(
			'title'      => esc_html__( 'Title', 'weldo' ),
			'date'       => esc_html__( 'Date', 'weldo' ),
			'id'         => esc_html__( 'Id', 'weldo' ),
			'menu_order' => esc_html__( 'Menu Order', 'weldo' ),
			'popularity' => esc_html__( 'Popularity', 'weldo' ),
			'rand'       => esc_html__( 'Randomly', 'weldo' ),
			'rating'     => esc_html__( 'Rating', 'weldo' ),
		)
	),
	'order'     => array(
		'label'   => esc_html__( 'Order', 'weldo' ),
		'desc'    => esc_html__( 'Select the order type', 'weldo' ),
		'type'    => 'short-select',
		'value'   => 'title',
		'choices' => array(
			'ASC'  => esc_html__( 'ASC', 'weldo' ),
			'DESC' => esc_html__( 'DESC', 'weldo' ),
		)
	),
	'class'     => array(
		'label' => esc_html__( 'Custom Class', 'weldo' ),
		'desc'  => esc_html__( 'Enter custom CSS class', 'weldo' ),
		'type'  => 'text',
		'value' => '',
	),
);