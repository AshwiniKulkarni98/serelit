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
<article <?php post_class( "vertical-item item-post content-padding hero-bg " . $filter_classes ); ?>>
	<?php if ( get_the_post_thumbnail() ) : ?>
		<div class="item-media">
			<?php
			echo get_the_post_thumbnail('','weldo-full-width','');
			?>
			<div class="media-links">
				<a class="abs-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
	<?php endif; //eof thumbnail check ?>
	<div class="item-content">
		<?php
		if ( function_exists( 'weldo_the_tags' ) ) {
			weldo_the_tags(
				array(
					'before' => '<div class="post-tags"><span class="cat-links">',
					'after'  => '</span></div>',
				) );
		}
		?>
		<h5 class="item-title special-heading with-line mt-0 mb-10 mb-lg-20">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>
		<?php if ( function_exists( 'weldo_the_excerpt' ) ) {
			weldo_the_excerpt( array(
				'length' => 10,
				'before' => '<div class="excerpt"><p>',
				'after'  => '</p></div>',
				'more'   => '',
			) );
		}
		?>
	</div>
	<div class="entry-meta">
        <span class="byline">
            <?php if ( function_exists( 'weldo_the_date' ) ) {
                weldo_the_date( array(
                    'before'          => '<span class="post-date"><i class="fs-14 fa fa-clock-o mr-2"></i>',
                    'after'           => '</span>',
                    'link_attributes' => 'rel="bookmark"',
                    'time_tag_class'  => 'entry-date'
                ) );
            }
            ?>
            <?php
            if ( function_exists( 'mwt_post_like_count' ) ) : ?>
                <span class="like-count">
                    <?php
                    weldo_post_like_button( get_the_ID() );
                    weldo_post_like_count( get_the_ID() );
                    ?>
                </span> <!-- eof .post-adds -->
            <?php endif;
            ?>
        </span>
	</div><!-- .entry-meta -->
</article><!-- eof vertical-item -->

