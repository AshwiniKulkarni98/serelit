<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$options = weldo_get_options();
$hide_like = $options['blog_hide_like'];
$show_post_thumbnail = ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) ? false : true;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-item content-padding ds ms text-center' ); ?>>
	<?php weldo_post_thumbnail('','',''); ?>
	<div class="item-content entry-content">
		<header class="entry-header">
			<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weldo_categorized_blog() &&  ! weldo_get_option( 'blog_hide_categories' ) ) :
				weldo_the_categories();
			endif; //categories ?>

			<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			//hidding "more link" in content
			the_content('');
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'weldo' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->
		<div class="entry-meta mt-20 mt-lg-50 mb-0">
			<span class="byline justify-content-center">
				<?php
				if ( 'post' == get_post_type() ) :
					weldo_posted_on();

				endif; //'post' == get_post_type()

				if ( function_exists( 'mwt_post_like_count' ) && ! $hide_like ) : ?>
					<span class="like-count">
					<?php
					weldo_post_like_button( get_the_ID() );
					weldo_post_like_count( get_the_ID() );
					?>
				</span> <!-- eof .post-adds -->
				<?php endif; //is_search
				weldo_comments_counter( array(
					'before' => '<span class="comments-link"><i class="fs-14 ico ico-comments"></i>',
					'after' => '</span>',
					'live_a_comment' => '0',
					'password_protected' => false,
					'comments_are_closed' => false,
				) );
				if ( ! empty( get_the_tags() ) && ! weldo_get_option( 'blog_hide_tags' ) ) :
					the_tags( '<span class="tag-links"><i class="fa fa-tag"></i>', ', ', '</span>' );
				endif; ?>
			</span>
		</div><!-- .entry-meta -->
	</div><!-- eof .item-content -->
</article><!-- #post-## -->

<?php if ( $options['blog_layout'] === '2' ) {
	echo '<hr>';
} ?>