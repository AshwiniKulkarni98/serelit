<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - extended item layout
 */

$terms          = get_the_terms( get_the_ID(), 'category' );
$ext_services_settings = fw()->extensions->get( 'portfolio' )->get_settings();
$post_type = $ext_services_settings['post_type'];
$show_button = ( ! empty( $atts['button']['show_button'] ) ) ? true : false;
$show_video = ( ! empty( $atts['show_video'] ) ) ? true : false;
$filter_classes = '';
$additional_class = ! empty( $atts['square_item'] ) ? 'square-item' : '';
if( ! empty( $terms ) ) :
	foreach ( $terms as $term ) {
		$filter_classes .= ' filter-' . $term->slug;
	}
endif;
while ( $posts->have_posts() ) : $posts->the_post();
	$pID = get_the_ID();
	$portfolio_options = fw_get_db_post_option( $pID );
	?>

	<?php if ( $show_video ) : ?>
		<article <?php post_class( "single-portfolio-item with-video horizontal-item h-100" . $filter_classes . ' ' . $atts['custom_class'] ); ?>>
			<?php if ( get_the_post_thumbnail() ) : ?>
				<div class="cover-image s-overlay <?php echo esc_attr( $atts['background_color'] ) ?>">
					<?php echo get_the_post_thumbnail('','',''); ?>
					<?php if ( ! empty( $portfolio_options['portfolio-featured-video'] ) ) : ?>
						<a href="" class="video-link photoswipe-link"
						   data-iframe="<?php echo esc_html( $portfolio_options['portfolio-featured-video'] ); ?>"
						   data-index="1">
						</a>
					<?php endif; ?>
				</div>
			<?php endif; //eof thumbnail check ?>
		</article><!-- eof vertical-item -->
	<?php else: ?>
		<article <?php post_class( "single-portfolio-item horizontal-item padding-small row h-100 text-center text-md-left" . $filter_classes . ' ' . $atts['background_color']  . ' ' . $atts['image_first'] . ' ' . $atts['custom_class'] . ' ' . $additional_class ); ?>>
			<div class="col-12 col-md-6 order-2 order-md-1 align-md-center with-triangle">
				<div class="item-content">
					<h4 class="mb-18">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h4>
					<div class="entry-content mb-0">
						<?php
						if ( ! empty( $portfolio_options['excerpt'] ) ) {
							echo esc_attr( $portfolio_options['excerpt'] );
						} else {
							the_excerpt();
						}
						?>
					</div>
					<?php if ( $show_button ) : ?>
				        <a href="<?php the_permalink(); ?>"
				           class="mt-25 btn-small <?php echo esc_attr( $atts['button']['button']['color'] ); ?>"><?php echo esc_html( $atts['button']['button']['label'] ); ?></a>
				    <?php endif; ?>
				</div>
			</div>
			<div class="col-12 col-md-6 order-1 order-md-2">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php  the_post_thumbnail('weldo-square'); ?>
                    <div class="media-links">
                        <a class="abs-link" href="<?php the_permalink(); ?>"></a>
                    </div>
                <?php endif; //eof thumbnail check ?>
			</div>
		</article><!-- eof vertical-item -->
	<?php endif; ?>
<?php endwhile;