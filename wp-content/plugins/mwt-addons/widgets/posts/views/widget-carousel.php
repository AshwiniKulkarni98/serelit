<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var int $number
 * @var int $margin
 * @var string $layout
 * @var string $item_layout
 * @var int $responsive_lg
 * @var int $responsive_md
 * @var int $responsive_sm
 * @var int $responsive_xs
 * @var array $posts
 */

$unique_id = uniqid();

echo wp_kses_post( $before_widget );

if ( $title ) {
	echo wp_kses_post( $before_title . $title . $after_title );;
}


if ( $show_filters ) :
	//get unique terms only for posts that are showing
	$showing_terms = array();
	foreach ( $posts->posts as $post ) {
		foreach ( get_the_terms( $post->ID, 'category' ) as $post_term ) {
			$showing_terms[ $post_term->term_id ] = $post_term;
		}
	}
	?>
    <div class="filters carousel_filters-<?php echo esc_attr( $unique_id ); ?> text-center">
        <a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'mwt' ); ?></a>
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
	<div id="widget_portfolio_carousel_<?php echo esc_attr( $unique_id ); ?>"
	     class="owl-carousel"
	     data-margin="<?php echo esc_attr( $margin ); ?>"
	     data-responsive-xs="<?php echo esc_attr( $responsive_xs ); ?>"
	     data-responsive-sm="<?php echo esc_attr( $responsive_sm ); ?>"
	     data-responsive-md="<?php echo esc_attr( $responsive_md ); ?>"
	     data-responsive-lg="<?php echo esc_attr( $responsive_lg ); ?>"
		<?php if ( $show_filters ) { ?>
            data-filters=".carousel_filters-<?php echo esc_attr( $unique_id ); ?>"
		<?php } ?>
    >    <?php while ( $posts->have_posts() ) : $posts->the_post();
			$post_terms       = get_the_terms( get_the_ID(), 'category' );
			$post_terms_class = '';
			foreach ( $post_terms as $post_term ) {
				$post_terms_class .= $post_term->slug . ' ';
			}
			?>
        <div class="owl-carousel-item <?php echo esc_attr( 'item-layout-' . $item_layout . ' ' . $post_terms_class ); ?>">
			<?php
			//include item layout view file. If no thumbnail - layout is always extended
			$filepath  = MWT_WIDGETS_PLUGIN_PATH . '/widgets/posts/views/widget-item-' . $item_layout . '.php';
			if ( ! ( has_post_thumbnail() ) ) {
				$filepath  = MWT_WIDGETS_PLUGIN_PATH . '/widgets/posts/views/widget-item-extended.php';
			}
			if ( file_exists( $filepath ) ) {
				include( $filepath );
			} else {
				esc_html_e( 'View not found', 'mwt' );
			}
			?>
        </div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query ?>
	</div>
<?php echo wp_kses_post( $after_widget ); ?>