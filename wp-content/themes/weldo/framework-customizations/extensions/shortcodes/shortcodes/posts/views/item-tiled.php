<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - extended item layout
 */

$terms          = get_the_terms( get_the_ID(), 'category' );
$filter_classes = '';
foreach ( $terms as $term ) {
	$filter_classes .= ' filter-' . $term->slug;
}

?>
<article <?php post_class( "side-item vertical-item row item-post-tiled w-100 " . $filter_classes ); ?>>
	<?php if ( get_the_post_thumbnail() ) : ?>
		<div class="col-12 col-md-6">
			<div class="item-media cover-image">
				<?php
				echo get_the_post_thumbnail('','weldo-full-width','');
				?>
				<div class="media-links">
					<a class="abs-link" href="<?php the_permalink(); ?>"></a>
				</div>
			</div>
		</div>
		<?php endif; //eof thumbnail check ?>
	<div class="col-12 col-md-6">
		<div class="item-content">
			<?php if ( function_exists( 'weldo_the_date' ) ) {
				weldo_the_date( array(
					'before'          => '<div class="post-date mb-10"><i class="fs-14 fa fa-clock-o mr-2"></i>',
					'after'           => '</div>',
					'link_attributes' => 'rel="bookmark"',
					'time_tag_class'  => 'entry-date'
				) );
			}
			?>
			<h5 class="item-title mt-0">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h5>
			<div class="entry-meta mb-2">
				<span class="byline">
					<?php
					if ( function_exists( 'mwt_post_like_count' ) ) : ?>
						<span class="like-count">
							<?php
							weldo_post_like_button( get_the_ID() );
							weldo_post_like_count( get_the_ID() );
							?>
						</span> <!-- eof .post-adds -->
					<?php endif; //is_search
					if ( function_exists( 'weldo_comments_counter' ) ) {
						weldo_comments_counter( array(
							'before'              => '<span class="comments-link"><i class="fs-14 ico ico-comments"></i>',
							'after'               => '</span>',
							'comment'             => 'comment',
							'comments'            => 'comments',
							'live_a_comment'      => '0 comment',
							'password_protected'  => false,
							'comments_are_closed' => false,
						) );
					}
					?>
				</span>
			</div><!-- .entry-meta -->
			<a class="mt-15 mt-xl-40 btn btn-maincolor btn-small read-more" href="<?php the_permalink(); ?>"> <?php esc_html_e( 'Read More', 'weldo' ); ?></a>
		</div>
	</div>
</article><!-- eof vertical-item -->

