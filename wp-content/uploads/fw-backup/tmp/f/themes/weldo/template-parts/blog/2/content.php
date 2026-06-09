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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-item ' ); ?>>
	<?php weldo_post_thumbnail('','',''); ?>
	<div class="item-content entry-content">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weldo_categorized_blog() &&  ! weldo_get_option( 'blog_hide_categories' ) ) :
			weldo_the_categories();
		endif; //categories ?>
		<div class="entry-meta">
			<span class="byline">
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
				?>
			</span>
		</div><!-- .entry-meta -->
		<header class="entry-header">
			<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			//hidding "more link" in content
			the_content( esc_html__( 'Read More', 'weldo' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'weldo' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->
		<?php if ( ! empty( get_the_tags() ) && !weldo_get_option( 'blog_hide_tags' ) ) : ?>
			<div class="tagcloud post-tagcloud mt-20">
				<?php the_tags( '', '', '' ); ?>
			</div>
		<?php endif; ?>
	</div><!-- eof .item-content -->
</article><!-- #post-## -->
<hr>