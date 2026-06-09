<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
get_header();
global $post;
$options        = fw_get_db_post_option( $post->ID, fw()->extensions->get( 'events' )->get_event_option_id() );
$column_classes = weldo_get_columns_classes();
$option_events =  fw_get_db_post_option( $post->ID );
$gallery_images =  $option_events['post-featured-gallery'];
?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post(); ?>
			<article
				id="post-<?php the_ID(); ?>" <?php post_class( 'post box-shadow vertical-item content-padding' ); ?>>
					<?php if ( ! empty( $gallery_images ) ) : ?>
						<div class="item-media entry-thumbnail">
							<div class="owl-carousel"
							     data-items="1"
							     data-responsive-xs="1"
							     data-responsive-sm="1"
							     data-responsive-md="1"
							     data-responsive-lg="1"
							     data-nav="true"
							     data-dots="true"
							>

							<?php foreach ( $gallery_images as $image ) : ?>
								<div>
									<img src="<?php echo esc_url($image['url']) ?>" alt="<?php echo esc_attr($post->title); ?>">
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<?php
						else:
							weldo_post_thumbnail();
						endif;
					?>
				<div class="item-content">
					<header class="entry-header">
						<?php echo get_the_term_list( $post->ID, 'fw-event-taxonomy-name', '<span class="cat-links">', ' ', '</span>' ); ?>
						<div class="entry-meta item-meta">
							<?php
							weldo_the_author( array(
								'before' => '<span class="author vcard"><i class="fa fa-user"></i>',
								'after' => '</span>',
								'link_class' => 'url fn n',
								'link_attributes' => 'rel="author"',
							) );
							?>
							<span class="event-info">
								<?php

								foreach ( $options['event_children'] as $key => $row ) : ?>
									<?php if ( empty( $row['event_date_range']['from'] ) or empty( $row['event_date_range']['to'] ) ) : ?>
										<?php continue; ?>
									<?php endif; ?>

									<span>
									<i class="ico ico-calendar color-main"></i><?php echo wp_kses_post ( $row['event_date_range']['from'] ); ?> -
									<?php echo wp_kses_post ( $row['event_date_range']['to'] ); ?>

									</span>
								<?php endforeach; ?>
								<span class="event-place">
									<?php
									if ( $options['event_location']['location'] ) : ?>
										<i class="ico ico-maps color-main"></i>
										<?php
										echo esc_html( $options['event_location']['location'] );
									endif;

									if ( $options['event_location']['venue'] ) :
										echo esc_html( ', ' . $options['event_location']['venue'] );
									endif;
									?>
								</span><!-- .event-place-->

							</span>
							<!-- .additional information about event -->
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">

						<?php the_content(); ?>

						<?php
						$map = fw_ext_events_render_map();
						if ( $map ):
							?>
							<div class="event-map">
								<?php echo fw_ext_events_render_map(); ?>
							</div>
							<?php endif; //map ?>

						<?php do_action( 'weldo_ext_events_after_content' ); ?>
					</div><!-- .entry-content -->
				</div><!-- .item-content -->
			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile; ?>

	</div><!--eof #content -->
<?php if ( $column_classes['sidebar_class'] ): ?>
	<!-- main aside sidebar -->
	<aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
	</aside>
	<!-- eof main aside sidebar -->
	<?php
endif;
get_footer();