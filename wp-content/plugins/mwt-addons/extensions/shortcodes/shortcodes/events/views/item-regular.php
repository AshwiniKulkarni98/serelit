<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! fw()->extensions->get( 'events' ) ) {
	return;
}

/**
 * 				<?php get_terms( array( 'post_type ' => 'fw-event-taxonomy-name' ) ); ?>
@var object $srortcode
 * @var array $atts
 * @var array $posts
 */


if ( has_post_thumbnail( $post->ID ) ) { ?>
	<div class="col-xl-3 col-lg-5 col-md-5">
		<div class="item-media cover-image">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			echo wp_kses_post( get_the_post_thumbnail( $post->ID, 'weldo-square' ) );
			?>
			<div class="media-links">
				<a class="abs-link" href="<?php echo get_permalink( $post->ID ); ?>"></a>
			</div>
		</div>
	</div>
	<div class="col-xl-9 col-lg-7 col-md-7 text-center text-md-left">
		<div class="item-content">

			<div class="entry-header">
				<?php echo get_the_term_list( $post->ID, 'fw-event-tag', '<div class="tagcloud">', ' ', '</div>' ); ?>
				<h6 class="entry-title">
					<a href="<?php echo get_permalink( $post->ID ); ?>">
						<?php echo apply_filters( 'the_title', $post->post_title ); ?>
					</a>
				</h6>
				<div class="entry-meta">
					<?php if ( function_exists( 'weldo_posted_on' ) ) {
						weldo_posted_on();
					} ?>
				</div>
			</div>
			<div class="entry-content">
				<p class="event-content"><?php echo apply_filters( 'post_content', $post->post_content ); ?></p>
				<a class="btn-small btn btn-maincolor"
				   href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo esc_html__('read more', 'weldo'); ?></a>
			</div>
		</div>
	</div>
<?php
//featured post without featured image
} else { ?>
	<div class="item-content">
		<h4 class="item-meta">
			<a href="<?php echo get_permalink( $post->ID ); ?>">
				<?php echo wp_kses_post( $post->post_title ); ?>
			</a>
		</h4>

		<?php if( !empty( $event_place) ) : ?>
		<div class="small-text">
			<i class="fa fa-map-marker color-main"></i>
			<?php echo wp_kses_post( $event_place ); ?>
		</div>
		<?php endif; ?>

		<?php if( !empty( $event_dates) ) : ?>
		<div class="small-text">
			<i class="fa fa-clock-o color-main"></i>
			<?php echo wp_kses_post( $event_dates[0]['from']['date'] ); ?>
			<?php if( !empty( $event_dates[0]['from']['time']) ) : ?>
				<?php echo wp_kses_post( $event_dates[0]['from']['time'] ); ?>
			<?php endif; ?>
			-
			<?php echo wp_kses_post( $event_dates[0]['to']['date'] ); ?>
			<?php if( !empty( $event_dates[0]['to']['time']) ) : ?>
				<?php echo wp_kses_post( $event_dates[0]['to']['time'] ); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php echo wp_kses_post( $shortcode->fw_get_event_excerpt_by_id( $post->ID ) ); ?>

	</div>

<?php
	}
?>