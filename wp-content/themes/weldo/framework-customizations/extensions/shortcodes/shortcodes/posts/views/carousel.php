<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $atts The shortcode attributes
 */

$nav = $atts['nav'];

/**
 * @var array $atts
 * @var array $posts
 */

$unique_id = uniqid();
$additional_class = !empty( $atts['additional_class'] ) ? $atts['additional_class'] : '';
if ( $atts['show_filters'] ) :

	//get unique terms only for posts that are showing
	$showing_terms = array();
	foreach ( $posts->posts as $post ) {
		foreach ( get_the_terms( $post->ID, 'category' ) as $post_term ) {
			$showing_terms[ $post_term->term_id ] = $post_term;
		}
	}
	?>
	<div class="filters carousel_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
		<a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'weldo' ); ?></a>
		<?php
		foreach ( $showing_terms as $term_key => $term_id ) {
			$current_term = get_term( $term_id, 'category' );
			?>
			<a href="#"
			   data-filter=".<?php echo esc_attr( $current_term->slug ); ?>"><?php echo esc_html( $current_term->name ); ?></a>
			<?php
		}
		?>
	</div>
	<?php
endif; //showfilters check

?>

<div
	class="owl-carousel <?php echo esc_attr( $additional_class ) ?>"
	data-nav="<?php echo esc_attr( $nav ); ?>"
	data-loop="true"
	data-autoplay="true"
	data-margin="<?php echo esc_attr( $atts['margin'] ); ?>"
	data-responsive-xs="<?php echo esc_attr( $atts['responsive_xs'] ); ?>"
	data-responsive-sm="<?php echo esc_attr( $atts['responsive_sm'] ); ?>"
	data-responsive-md="<?php echo esc_attr( $atts['responsive_md'] ); ?>"
	data-responsive-lg="<?php echo esc_attr( $atts['responsive_lg'] ); ?>"
	<?php if ( $atts['show_filters'] ) : ?>
		data-filters=".carousel_filters-<?php echo esc_attr( $unique_id ); ?>"
	<?php endif; // filters ?>
>
	<?php while ( $posts->have_posts() ) : $posts->the_post();
		$post_terms       = get_the_terms( get_the_ID(), 'category' );
		$post_terms_class = '';
		if ( ! empty ( $post_terms ) ) :
			foreach ( $post_terms as $post_term ) :
				$post_terms_class .= $post_term->slug . ' ';
			endforeach;
		endif;
	?>
	<div class="owl-carousel-item <?php echo esc_attr( 'item-layout-' . $atts['item_layout'] . ' ' . $post_terms_class ); ?>">
		<?php
		$filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/posts/views/' . $atts['item_layout'] . '.php';
		if ( ! ( has_post_thumbnail() ) ) {
			$filepath  = get_template_directory() . '/framework-customizations/extensions/shortcodes/shortcodes/posts/views/item-extended.php';
		}
		if ( file_exists( $filepath ) ) {
			include( $filepath );
		} else {
			$filepath = plugin_dir_path( __FILE__ ) . $atts['item_layout'] . '.php';
			if ( ! ( has_post_thumbnail() ) ) {
				$filepath = plugin_dir_path( __FILE__ ) . 'item-extended.php';
			}
			if ( file_exists( $filepath ) ) {
				include( $filepath );
			} else {
				esc_html_e( 'View not found', 'weldo' );
			}
		}
		?>
	</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); // reset the query ?>
</div>