<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( class_exists( 'Weldo_Comments_Walker' ) ) {
	return;
}

/**
 * Walker for comments
 */
class Weldo_Comments_Walker extends Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 *
	 * @see   wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children
			? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta d-md-flex justify-content-between">
				<div class="fw-400 comment-author vcard">

					<?php
					/* translators: %s: comment author link */
					printf( __( '%s', 'weldo' ),
						sprintf( '<b class="fn">%s</b>',
							get_comment_author_link( $comment ) )
					);
					?>
				</div><!-- .comment-author -->
				<?php if ( 0 != $args['avatar_size'] ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				} ?>

			</footer><!-- .comment-meta -->
			<span class="comment-data">
				<i class="fa fa-calendar"></i>
				<a href="<?php echo esc_url( get_comment_link( $comment,
					$args ) ); ?>">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
						printf( __( '%1$s ', 'weldo' ),
							get_comment_date( '', $comment ) );
						?>
					</time>
				</a>
			</span>
			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
			<div class="comment-metadata fw-400">
				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<span class="reply"><i class="fa fa-share"></i>',
					'after'     => '</span>'
				) ) );
				?>
				<?php edit_comment_link( esc_html__( 'Edit', 'weldo' ),
				'<span class="edit-link"><i class="fa fa-pencil"></i>', '</span>' ); ?>
			</div><!-- .comment-metadata -->
		</article><!-- .comment-body -->
		<?php if ( '0' == $comment->comment_approved ) : ?>
			<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'weldo' ); ?></p>
		<?php endif; ?>
		<?php
	}
}