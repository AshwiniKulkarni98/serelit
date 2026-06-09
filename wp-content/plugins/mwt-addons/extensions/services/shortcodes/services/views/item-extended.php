<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Shortcode Posts - extended item layout
 */

$terms          = get_the_terms( get_the_ID(), 'category' );
$filter_classes = '';
if( ! empty( $terms ) ) :
	foreach ( $terms as $term ) {
		$filter_classes .= ' filter-' . $term->slug;
	}
endif;

?>
<article <?php post_class( "vertical-item content-padding hero-bg text-center" . $filter_classes ); ?>>
	<?php if ( get_the_post_thumbnail() ) : ?>
		<div class="item-media">
			<?php
			echo get_the_post_thumbnail();
			?>
			<div class="media-links">
				<a class="abs-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
	<?php endif; //eof thumbnail check ?>
	<div class="item-content">
		<h3 class="item-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php mwt_posted_on(); ?>
		<?php if ( get_the_term_list( get_the_ID(), 'category', '', ' ', '' ) ) : ?>
			<div class="cat-links">
				<?php
				echo get_the_term_list( get_the_ID(), 'category', '', ' ', '' );
				?>
			</div>
		<?php endif; //terms check ?>
		<?php the_excerpt(); ?>
	</div>
	<div class="item-icons links-grey">
		<div>
			<?php if ( function_exists( 'mwt_show_post_views_count' ) ) : ?>
			<i class="fa fa-eye color-main"></i>
			<?php
				mwt_show_post_views_count();
			endif; //mwt_show_post_views_count
			?>
		</div>
		<?php
		// Set up and print post meta information.
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<div>
				<span class="comments-link">
					<i class="fa fa-comment-o color-main"></i>
					<?php comments_popup_link( esc_html__( '0', 'mwt' ), esc_html__( '1', 'mwt' ), esc_html__( '%', 'mwt' ) ); ?>
				</span>
			</div>
			<?php
		endif; //password
		?>
		<div>
			<?php
			//if plugin 'mwt-addons is installed, displaying addons bar
			if( function_exists( 'mwt_share_this' ) ): ?>
			<i class="fa fa-heart color-main"></i>
			<?php
			mwt_post_like_button( get_the_ID() );
			mwt_post_like_count( get_the_ID() );
			endif;
			?>
		</div>
	</div>
</article><!-- eof vertical-item -->
