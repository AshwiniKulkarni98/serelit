<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_post_thumbnail = ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) ? false : true;
$options = weldo_get_options();
$hide_like = $options['blog_hide_like'];
$post_thumbnail        = get_the_post_thumbnail( get_the_ID() );
$additional_post_class = ( $post_thumbnail ) ? 'cover-image ds bs cover-image s-overlay' : '';
?>
<article
		id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-item text-center ds bs ' . $additional_post_class ); ?>>
	<?php
	echo empty ( $post_thumbnail ) ? '' : '';
	echo wp_kses_post( $post_thumbnail );
	?>
	<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weldo_categorized_blog() &&  ! weldo_get_option( 'blog_hide_categories' ) ) :
		weldo_the_categories();
	endif; //categories ?>
	<div class="item-content entry-content">
		<header class="entry-header">
			<?php
			global $post; ?>
			<div class="quote-author">
				<?php echo get_avatar( $post->post_author,'100' ); ?>
			</div>
			<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			//hidding "more link" in content
			the_content( esc_html__( '', 'weldo' ) );
			?>
		</div><!-- .entry-content -->
		<div class="entry-meta mt-20 mt-lg-40 mb-0">
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