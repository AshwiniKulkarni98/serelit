<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

//header products counter ajax refresh
add_filter( 'woocommerce_add_to_cart_fragments', 'weldo_woocommerce_cart_count_fragments', 10, 1 );
if ( ! function_exists( 'weldo_woocommerce_cart_count_fragments' ) ) :
	function weldo_woocommerce_cart_count_fragments( $fragments ) {
		$fragments['span.cart-count'] = '<span class="badge bg-maincolor cart-count">';
		if (! empty( WC()->cart->get_cart_contents_count() ) ) {
			$fragments['span.cart-count'] .= WC()->cart->get_cart_contents_count();
		}
		$fragments['span.cart-count'] .= '</span>';
		return $fragments;
	}
endif;

//remove page title in shop page
add_filter( 'woocommerce_show_page_title', 'weldo_filter_remove_shop_title_in_content' );
if ( ! function_exists( 'weldo_filter_remove_shop_title_in_content' ) ) :
	function weldo_filter_remove_shop_title_in_content() {
		return false;
	}
endif;

//remove wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_shop_loop', 'weldo_action_echo_div_columns_before_shop_loop' );
if ( ! function_exists( 'weldo_action_echo_div_columns_before_shop_loop' ) ) :
	function weldo_action_echo_div_columns_before_shop_loop() {
		$column_classes = weldo_get_columns_classes();
		echo '<div id="content_products" class="' . esc_attr( $column_classes[ 'main_column_class' ] ) . '">';
	}
endif;

//before shop loop - removing breadcrumbs and results count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


//loop pagination
//closing main column and getting sidebar if exist
add_action( 'woocommerce_after_shop_loop', 'weldo_action_echo_div_columns_after_shop_loop' );
if ( ! function_exists( 'weldo_action_echo_div_columns_after_shop_loop' ) ):
	function weldo_action_echo_div_columns_after_shop_loop() {
		echo '</div><!-- eof #content_products -->';
		$column_classes = weldo_get_columns_classes();
		if ( $column_classes[ 'sidebar_class' ] ): ?>
			<!-- main aside sidebar -->
			<aside class="<?php echo esc_attr( $column_classes[ 'sidebar_class' ] ); ?>">
				<?php get_sidebar(); ?>
			</aside>
			<!-- eof main aside sidebar -->
		<?php
		endif;
	}
endif;


remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
add_action( 'woocommerce_after_shop_loop_item', 'weldo_woocommerce_template_loop_add_to_cart', 10 );
if ( ! function_exists( 'weldo_woocommerce_template_loop_add_to_cart' ) ):
	function weldo_woocommerce_template_loop_add_to_cart() {
		echo '<div class="shop-product-button">';
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
	}
endif;

// single product in shop loop
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


add_action( 'woocommerce_before_shop_loop_item', 'weldo_action_echo_markup_before_shop_loop_item' );
if ( ! function_exists( 'weldo_action_echo_markup_before_shop_loop_item' ) ):
	function weldo_action_echo_markup_before_shop_loop_item() {
		echo '<div class="vertical-item content-padding product-inner box-shadow">';
		echo '<div class="item-media-wrap">';
		echo '<div class="item-media">';
		woocommerce_template_loop_product_link_open();
	}
endif;


add_action( 'woocommerce_before_shop_loop_item_title', 'weldo_action_echo_markup_before_shop_loop_item_title' );
if ( ! function_exists( 'weldo_action_echo_markup_before_shop_loop_item_title' ) ):
	function weldo_action_echo_markup_before_shop_loop_item_title() {

		woocommerce_template_loop_product_link_close();
		echo '</div> <!-- eof .item-media -->';
		echo '</div> <!-- eof .item-media-wrap -->';
		echo '<div class="item-content">';
		woocommerce_template_loop_product_link_open();
	}
endif;



add_action( 'woocommerce_after_shop_loop_item_title', 'weldo_action_echo_markup_after_shop_loop_item_title' );
if ( ! function_exists( 'weldo_action_echo_markup_after_shop_loop_item_title' ) ):
	function weldo_action_echo_markup_after_shop_loop_item_title() {
		woocommerce_template_loop_product_link_close();
	}
endif;

//end of loop item
add_action( 'woocommerce_after_shop_loop_item', 'weldo_action_echo_markup_after_shop_loop_item' );
if ( ! function_exists( 'weldo_action_echo_markup_after_shop_loop_item' ) ):
	function weldo_action_echo_markup_after_shop_loop_item() {
		//product short description
		global $post;
		echo '</div> <!-- eof .item-content -->';
		echo '</div> <!-- eof .vertical-item -->';
	}
endif;

//single product view
add_action( 'woocommerce_before_single_product', 'weldo_action_echo_div_columns_before_single_product' );
if ( ! function_exists( 'weldo_action_echo_div_columns_before_single_product' ) ):
	function weldo_action_echo_div_columns_before_single_product() {
		$column_classes = weldo_get_columns_classes();
		echo '<div id="content_product" class="' . esc_attr( $column_classes[ 'main_column_class' ] ) . '">';
	}
endif;

add_action( 'woocommerce_after_single_product', 'weldo_action_echo_div_columns_after_single_product' );
if ( ! function_exists( 'weldo_action_echo_div_columns_after_single_product' ) ):
	function weldo_action_echo_div_columns_after_single_product() {
		echo '</div> <!-- eof .col- -->';
		$column_classes = weldo_get_columns_classes();
		if ( $column_classes[ 'sidebar_class' ] ): ?>
			<!-- main aside sidebar -->
			<aside class="<?php echo esc_attr( $column_classes[ 'sidebar_class' ] ); ?>">
				<?php get_sidebar(); ?>
			</aside>
			<!-- eof main aside sidebar -->
		<?php
		endif;
	}
endif;

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_filter( 'woocommerce_single_product_image_html', 'weldo_filter_put_onsale_span_in_main_image' );
if ( ! function_exists( 'weldo_filter_put_onsale_span_in_main_image' ) ):
	function weldo_filter_put_onsale_span_in_main_image( $html ) {
		return $html . woocommerce_show_product_sale_flash();
	}
endif;


//elements in single product summary
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 1 );


add_action( 'woocommerce_before_add_to_cart_button', 'weldo_action_echo_open_div_before_add_to_cart_button' );
if ( ! function_exists( 'weldo_action_echo_open_div_before_add_to_cart_button' ) ):
	function weldo_action_echo_open_div_before_add_to_cart_button() {
		echo '<div class="add-to-cart">';
	}
endif;

add_action( 'woocommerce_after_add_to_cart_button', 'weldo_action_echo_open_div_after_add_to_cart_button' );
if ( ! function_exists( 'weldo_action_echo_open_div_after_add_to_cart_button' ) ):
	function weldo_action_echo_open_div_after_add_to_cart_button() {
		echo '</div>';
	}
endif;

//account navigation
add_action( 'woocommerce_before_account_navigation', 'weldo_action_woocommerce_before_account_navigation' );
if ( ! function_exists( 'weldo_action_woocommerce_before_account_navigation' ) ):
	function weldo_action_woocommerce_before_account_navigation() {
		echo '<div class="buttons">';
	}
endif;

add_action( 'woocommerce_after_account_navigation', 'weldo_action_woocommerce_after_account_navigation' );
if ( ! function_exists( 'weldo_action_woocommerce_after_account_navigation' ) ):
	function weldo_action_woocommerce_after_account_navigation() {
		echo '</div><!-- eof .buttons -->';
	}
endif;

add_filter( 'gettext', 'wps_translate_words_array' );
add_filter( 'ngettext', 'wps_translate_words_array' );
function wps_translate_words_array( $translated ) {
	$words = array(
		'Related Products' => '',
	);
	$translated = str_ireplace(  array_keys($words),  $words,  $translated );
	return $translated;
}

//add custom titles for related product
add_action( 'woocommerce_after_single_product_summary', 'weldo_title_before_woocommerce_related_products', 19 );
if ( ! function_exists( 'weldo_title_before_woocommerce_related_products' ) ):
	function weldo_title_before_woocommerce_related_products() {
		$options = weldo_get_options();
		if ( ! empty( $options['woo_title'] || $options['woo_subtitle'] ) ) {
			echo '<div class="woo-related-headings mb-35 mb-lg-50 text-center">';
			echo '<h4 class="big special-heading">';
			echo wp_kses_post( $options['woo_title'] );
			echo '</h4>';
			if ( ! empty( $options['woo_subtitle'] ) ) {
				echo '<p class="special-heading subheading with-line">';
				echo wp_kses_post( $options['woo_subtitle'] );
				echo '</p>';
			}
			echo '</div>';
		}
	}


endif;

//mini cart
add_filter( 'woocommerce_cart_item_thumbnail', 'weldo_filter_minicart_thumbnail', 10, 3 );
if ( ! function_exists( 'weldo_filter_minicart_thumbnail') ):
	function weldo_filter_minicart_thumbnail( $product_image,  $cart_item, $cart_item_key  ){
		$link = get_permalink( $cart_item['product_id'] );
		$html = $product_image;
		if ( !empty( $link) ) {
			$html .= '</a>';
		}
		$html .= '<div class="minicart-product-meta">';
		if ( !empty( $link) ) {
			$html .= '<a href="' . esc_url( $link ) . '">';
		}
		return $html;
	}
endif;

add_filter( 'woocommerce_widget_cart_item_quantity', 'weldo_filter_minicart_item_quantity', 10, 3 );
if ( ! function_exists( 'weldo_filter_minicart_item_quantity') ):
	function weldo_filter_minicart_item_quantity( $span,  $cart_item, $cart_item_key  ){
		$link = get_permalink( $cart_item['product_id'] );
		$html = '' ;
		if ( !empty( $link) ) {
			$html .= '</a>';
		}
		$html .= $span . '</div><!-- .minicart-product-meta -->';
		return $html;
	}
endif;

