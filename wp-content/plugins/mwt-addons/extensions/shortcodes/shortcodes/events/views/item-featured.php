<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! fw()->extensions->get( 'events' ) ) {
	return;
}

if ( has_post_thumbnail( $post->ID ) ) { ?>
	<div class="vertical-item gallery-item content-absolute text-center cs">
		<div class="item-media">
			<?php
			$full_image_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			echo wp_kses_post( get_the_post_thumbnail( $post->ID ) );
			?>
			<div class="media-links">
				<div class="links-wrap">
					<a class="link-zoom photoswipe-link"
					   href="<?php echo esc_attr( $full_image_src ); ?>"></a>
					<a class="link-anchor" href="<?php echo get_permalink( $post->ID ); ?>"></a>
				</div>
			</div>
		</div>
		<div class="item-content">
			<?php 
				if( !empty( $shortcode->fw_get_event_start_timestamp_by_id( $post->ID) ) ) :
			?>
				<div class="event-start-date" data-event-timestamp="<?php echo esc_attr( $shortcode->fw_get_event_start_timestamp_by_id( $post->ID ) ); ?>"></div>
			<?php endif; ?>
			<h4 class="item-meta">
				<a href="<?php echo get_permalink( $post->ID ); ?>">
					<?php echo apply_filters( 'the_title', $post->post_title ); ?>
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
			<i class="fa fa-map-marker color-main"></i>
			<?php echo wp_kses_post( $event_place ); ?>
		<?php endif; ?>

		<?php if( !empty( $event_dates) ) : ?>
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
		<?php endif; ?>

		<?php echo wp_kses_post( $shortcode->fw_get_event_excerpt_by_id( $post->ID ) ); ?>
		
	</div>

<?php
	}
?>
			