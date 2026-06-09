<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_post_thumbnail = ( post_password_required()
						 || is_attachment()
                         || ! has_post_thumbnail() ) ? false : true;
$image_wrap_class    = $show_post_thumbnail
	? 'col-xl-6 col-lg-6 col-md-6 col-xs-12 col-12' : '';
$content_wrap_class  = $show_post_thumbnail
	? 'col-xl-6 col-lg-6 col-md-6 col-xs-12 col-12' : 'col-12';
$options = weldo_get_options();
$hide_like = $options['blog_hide_like'];
?>
<article
		id="post-<?php the_ID(); ?>" <?php post_class( 'side-item no-content-padding' ); ?>>
	<div class="row align-items-center">
		<?php weldo_post_thumbnail( 'col-xl-6 col-lg-6 col-md-6 col-xs-12 col-12','','','weldo-square' ); ?>

		<div class="<?php echo esc_attr( $content_wrap_class ); ?>">
			<div class="item-content entry-content">
                <header class="entry-header">
                    <?php the_title( '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h6>' ); ?>
                </header><!-- .entry-header -->
                <div class="entry-meta">
                    <span class="byline">
                        <?php
                        if ( 'post' == get_post_type() ) :
                            weldo_posted_on();
                        endif;
                        
                        weldo_comments_counter(
                            array(
                                'before'              => '<span class="comments-link"><i class="fa fa-comments"></i>',
                                'after'               => '</span>',
                                'password_protected'  => false,
                                'comments_are_closed' => false,
                                'comments'            => 'comments',
                                'comment'             => 'comment',
                                'live_a_comment'     => '0',
                            )
                        );
                        
                        if ( function_exists( 'mwt_post_like_count' ) && ( ! $hide_like ) ) : ?>
                            <span class="likes-count links-grey">
                                <?php
                                weldo_post_like_button( get_the_ID() );
                                weldo_post_like_count( get_the_ID() );
                                ?>
                            </span>
                        <?php endif;
                        
                        if ( ! empty( get_the_tags() ) && ! weldo_get_option( 'blog_hide_tags' ) ) :
                            the_tags( '<span class="tag-links"><i class="fa fa-tag"></i>', ', ', '</span>' );
                        endif;
                        
                        ?>
                    </span>
                </div><!-- .entry-meta -->
        
              
                <div class="entry-content">
                    <?php
                    //hidding "more link" in content
                    the_content( '' );
                    ?>
                    <div class="entry-footer">
        
                        <?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weldo_categorized_blog() && ! weldo_get_option( 'blog_hide_categories' ) ) :
                            weldo_the_categories(
                                array (
                                    'before'  => '<div class="post-cat"><span class="cat-links">',
                                    'after'   => '</span></div>',
                                ));
                        endif; //categories ?>
                        <a href="<?php echo get_permalink(); ?>" class="btn btn-outline-maincolor read-more-button">
                            <span><?php echo esc_html__( 'Read more', 'weldo' ); ?></span>
                        </a>
                    </div> <!-- eof .post-meta -->
                    <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'weldo' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                    ?>
                </div><!-- .entry-content -->
            </div><!-- eof .item-content -->
		</div><!-- .col -->
	</div><!-- .row -->
</article><!-- #post-## -->
