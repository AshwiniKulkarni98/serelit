<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var string $before_widget
 * @var string $after_widget
 * @var array $recent_posts
 * @var array $popular_posts
 */
$unique_id = uniqid();

echo wp_kses_post( $before_widget );
?>
<div class="tabs small-tabs">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a href="#popular_posts_<?php echo esc_attr( $unique_id ); ?>"
				role="tab"
				data-toggle="tab"
                class="nav-link active"
                 aria-selected="true"
			>
				<?php esc_html_e( 'Popular', 'mwt' ); ?>
			</a>
		</li>
		<li class="nav-item">
			<a href="#recent_<?php echo esc_attr( $unique_id ); ?>"
				role="tab"
				data-toggle="tab"
				class="nav-link"
			>
					<?php esc_html_e( 'Recent', 'mwt' ); ?>
			</a>
		</li>
	</ul>
</div>
<div class="tab-content">
	<div id="popular_posts_<?php echo esc_attr( $unique_id ); ?>" class="tab-pane fade active show">
		<?php while ( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>
			<div <?php post_class( 'vertical-item' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail( get_the_ID() ); ?>
					</a>
				<?php endif; //has_post_thumbnail ?>
				<h6 class="mt-10"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				<p>
					<span>
					<i class="fa fa-heart-o color-main"></i>
					<?php
						if ( function_exists( 'mwt_post_like_count' ) ) :
							mwt_post_like_count( get_the_ID() );
						endif;
					?>
					</span>
				</p>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query ?>
	</div>
	<div id="recent_<?php echo esc_attr( $unique_id ); ?>" class="tab-pane fade">
		<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
			<div <?php post_class( 'vertical-item' ); ?> id="widget-post-tabs-post-<?php the_ID(); ?>">
				<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail( get_the_ID() ); ?>
					</a>
				<?php endif; //has_post_thumbnail ?>
				<h6 class="mt-10"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				<p>
				<span>
					<i class="fa fa-heart-o color-main"></i>
					<?php
					if ( function_exists( 'mwt_post_like_count' ) ) :
						mwt_post_like_count( get_the_ID() );
					endif;
					?>
					</span>
				</p>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query ?>
	</div>
</div>
<?php echo wp_kses_post( $after_widget ); ?>
