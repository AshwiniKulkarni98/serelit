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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-item post-grid-item hero-bg masonry-layout ' ); ?>>
	<?php weldo_post_thumbnail('','','','weldo-square'); ?>
    <div class="item-content entry-content">
		<div class="entry-meta">
			<span class="byline">
				<?php
				if ( function_exists( 'weldo_posted_on' ) ) {
					if ( 'post' == get_post_type() ) :
						weldo_posted_on();
					endif;
				}
				if ( function_exists( 'weldo_comments_counter' ) ) {
					weldo_comments_counter( array(
                        'before'              => '<span class="comments-link"><i class="fa fa-comments"></i>',
                        'after'               => '</span>',
                        'password_protected'  => false,
                        'comments_are_closed' => false,
                        'comments'            => 'comments',
                        'comment'             => 'comment',
                        'live_a_comment'      => '0',
                    ) );
                }
				if ( function_exists( 'weldo_post_like_button' ) && ( ! $hide_like ) ) : ?>
                    <span class="likes-count links-grey">
                        <?php
                        weldo_post_like_button( get_the_ID() );
                        weldo_post_like_count( get_the_ID() );
                        ?>
                    </span>
                <?php endif;
				if ( function_exists( 'weldo_get_option' ) ) {
					if ( ! empty( get_the_tags() ) && ! weldo_get_option( 'blog_hide_tags' ) ) {
						the_tags( '<span class="tag-links"><i class="fa fa-tag"></i>', ', ', '</span>' );
					}
                }
				?>
			</span>
		</div><!-- .entry-meta -->
		<header class="entry-header">
			<?php the_title( '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h6>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			//hidding "more link" in content
			the_content( '' );
			?>
            <div class="entry-footer">
                <?php
                if ( 'weldo_the_categories' ) {
	                if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weldo_categorized_blog() && ! weldo_get_option( 'blog_hide_categories' ) ) {
		                weldo_the_categories( array(
			                'before' => '<div class="post-cat"><span class="cat-links">',
			                'after'  => '</span></div>',
		                ) );
	                } //categories
                } ?>
			</div> <!-- eof .post-meta -->
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'weldo' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
            <a href="<?php echo get_permalink(); ?>" class="btn btn-outline-maincolor read-more-button">
                <span><?php echo esc_html__( 'Read more', 'weldo' ); ?></span>
            </a>
		</div><!-- .entry-content -->
	</div><!-- eof .item-content -->
</article><!-- #post-## -->
