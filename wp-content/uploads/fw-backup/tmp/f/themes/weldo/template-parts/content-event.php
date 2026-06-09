<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$option_events =  fw_get_db_post_option( $post->ID );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'fw-event fw-post-event side-item text-center text-md-left content-padding box-shadow' ); ?>>
	<div class="row">
		<div class="col-xl-4 col-lg-5 col-md-5">
			<div class="item-media cover-image">
				<?php the_post_thumbnail(''); ?>
				<div class="media-links">
					<a class="abs-link" href="<?php the_permalink(); ?>"></a>
				</div>
			</div>
		</div>
		<div class="col-xl-8 col-lg-7 col-md-6 text-center text-md-left">
			<div class="item-content">
				<?php echo get_the_term_list( $post->ID, 'fw-event-tag', '<div class="tagcloud">', ' ', '</div>' ); ?>
				<header class="entry-header">
					<?php
					the_title( '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h6>' );
					?>
					<div class="entry-meta item-meta">
						<?php
						weldo_posted_on();
						if ( function_exists( 'fw_ext_feedback' ) ) {
							fw_ext_feedback();
						}
						?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
				<div class="entry-content blog-excerpt">
					<?php  the_content( esc_html__( 'Read More', 'weldo' ) ); ?>
				</div><!-- .entry-content -->
			</div><!-- eof .item-content -->
		</div>
	</div>
</article><!-- #post-## -->
