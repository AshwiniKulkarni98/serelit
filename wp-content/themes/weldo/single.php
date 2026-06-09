<?php
/**
 * The Template for displaying all single posts
 */

get_header();
$column_classes = weldo_get_columns_classes();
$options = weldo_get_options();
$hide_date = $options['blog_hide_date'];
$hide_like = $options['blog_hide_like'];

$show_post_thumbnail = ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) ? false : true;
?>
	<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
	<?php
	// Start the Loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the post format-specific template for the content. If you want to
		 * use this in a child theme, then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('vertical-item content-padding hero-bg'); ?>>
	<?php
		weldo_post_thumbnail();
	?>
		<div class="item-content entry-content">
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
							'comments' => 'comments',
							'comment' => 'comment',
						)
					);
					if ( function_exists( 'mwt_post_like_count' ) && ( ! $hide_like ) ) : ?>
						<span class="likes-count links-grey">
	                        <?php
							weldo_post_like_button( get_the_ID() );
							weldo_post_like_count( get_the_ID() );
							?>
	                    </span>
					<?php endif; ?>
				</span>
			</div><!-- .entry-meta -->
			<div class="entry-content">
				<?php
				the_content( '');
				?>
			</div><!-- .entry-content -->

			<div class="entry-footer">
				<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weldo_categorized_blog() &&  ! weldo_get_option( 'blog_hide_categories' ) ) :
					weldo_the_categories();
				endif; //categories
				if ( ! empty( get_the_tags() ) && !weldo_get_option( 'blog_hide_tags' ) ) : ?>
					<div class="tag-links">
						<?php the_tags(); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'weldo' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div>
	</article><!-- #post-## -->
	<?php
        //print author bio
        weldo_list_authors();
    ?>

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