<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * The template for displaying Events Category pages
 *
 */

get_header();
$column_classes = weldo_get_columns_classes();
;
?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
		<?php
		// Start the taxonomy.
		while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'fw-event fw-post-event side-item text-center text-md-left content-padding box-shadow' ); ?>>
			<div class="row">
				<div class="col-xl-3 col-lg-5 col-md-5">
					<div class="item-media cover-image">
						<?php the_post_thumbnail('weldo-square'); ?>
						<div class="media-links">
							<a class="abs-link" href="<?php the_permalink(); ?>"></a>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-7 col-md-7 text-center text-md-left">
					<div class="item-content">
						<header class="entry-header">
							<?php echo get_the_term_list( $post->ID, 'fw-event-tag', '<div class="tagcloud">', ' ', '</div>' ); ?>
							<?php
							the_title( '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h6>' );
							?>
							<div class="entry-meta item-meta">
								<?php
								weldo_the_author( array(
									'before' => '<span class="author vcard"><i class="fa fa-user"></i>',
									'after' => '</span>',
									'link_class' => 'url fn n',
									'link_attributes' => 'rel="author"',
								) );
								weldo_the_date( array(
									'before' => '<span><i class="fa fa-calendar"></i>',
									'after' => '</span>',
									'link_attributes' => 'rel="bookmark"',
									'time_tag_class' => 'entry-date'
								) );
								weldo_comments_counter(
									array(
										'before' => '<span class="comments-link"><i class="color-main color-main ico-comment-alt"></i>',
										'after' => '</span>',
										'password_protected' => false,
										'comments_are_closed' => false,
									) );
								?>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content( esc_html__( 'Read More', 'weldo' ) ); ?>
						</div><!-- .entry-content -->
					</div><!-- eof .item-content -->
				</div>
			</div>
		</article><!-- #post-## -->
		<?php endwhile; ?>
		<div class="divider-5"></div>
	</div><!--eof #content -->
	<!-- /tc: achive -->
<?php if ( $column_classes['sidebar_class'] ): ?>
	<!-- main aside sidebar -->
	<aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
	</aside>
	<!-- eof main aside sidebar -->
<?php
endif;
get_footer();