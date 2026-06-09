<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var array $popular_posts
 */
$unique_id = uniqid();

if ( $r->have_posts() ) :
	?>
	<?php echo wp_kses_post($args['before_widget']); ?>
	<?php if ( $title ) {
	echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
} ?>
	<ul id="recent_posts_<?php echo esc_attr( $unique_id ); ?>" class="list-unstyled">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li <?php post_class( 'media' ); ?>>
				<?php if ( has_post_thumbnail() && $show_media ) : ?>
					<a href="<?php the_permalink(); ?>" class="media-left">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
					</a>
				<?php endif; //has_post_thumbnail ?>
				<div class="media-body">
					<h6 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					<?php
						if ( $show_excerpt ) :
							the_excerpt();
						endif;
					?>
					<div class="item-meta">
						<?php if ( $show_date ) : ?>
							<span class="widget-post-date">
								<?php echo get_the_date(); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>
	<?php echo wp_kses_post($args['after_widget']); ?>
	<?php
	// Reset the global $the_post as this query will have stomped on it
	wp_reset_postdata();

endif;
?>
