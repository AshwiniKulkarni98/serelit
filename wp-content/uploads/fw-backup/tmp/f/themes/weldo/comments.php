<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$options =weldo_get_options();

$title_reply = wp_kses_post( esc_html__( ' Leave A Comment', 'weldo') );
$req = get_option( 'require_name_email' );
$html_req = ( $req ? " required='required'" : '' );

$args = array(
	'comment_field'        => is_user_logged_in() ? '<p class="has-placeholder comment-form-comment"><label for="comment">' . esc_html_x( 'Comment', 'noun', 'weldo' ) . '</label> <textarea id="comment"  class="form-control" name="comment" cols="45" rows="8"  aria-required="true" required="required"  placeholder="' . esc_attr__( 'Comment', 'weldo' ) . '"></textarea></p>' : '',
	'fields'               =>  array(
		'author'  => '<p class="has-placeholder comment-form-author form-group ">' . '<label for="author">' . esc_html__( 'Name', 'weldo' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> <i class="ico-user color-main"></i> ' .
			'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . '   placeholder="' . esc_attr__( 'Name', 'weldo' ) . '"/></p>',
		'email'   => '<p class="has-placeholder comment-form-email form-group "><label for="email">' . esc_html__( 'Email', 'weldo' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> <i class="ico-envelope color-main"></i> ' .
			'<input id="email" name="email"  type="email" class="form-control"  value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" ' . $html_req . '   placeholder="' . esc_attr__( 'E-mail', 'weldo' ) . '" /></p>',
		'comment_field'        => '<p class="has-placeholder comment-form-comment form-group "><label for="comment">' . esc_html_x( 'Comment', 'noun', 'weldo' ) . '</label><i class="ico-comment color-main"></i><textarea id="comment"  class="form-control" name="comment" cols="45" rows="7"  aria-required="true" required="required"  placeholder="' . esc_attr__( 'Comment', 'weldo' ) . '"></textarea></p>',
	),

	'logged_in_as'         => '<p class="logged-in-as">' .
		sprintf(
			esc_html__( 'Logged in as ', 'weldo' ) . '<a href="%1$s" aria-label="%2$s">%3$s' .  '</a>. <a href="%4$s">' . esc_html__( 'Log out?', 'weldo' ) . '</a>',
			get_edit_user_link(),
			/* translators: %s: user name */
			esc_attr( sprintf( esc_html__( 'Logged in as %s. Edit your profile.', 'weldo' ), $user_identity ) ),
			$user_identity,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) )
		) . '</p>',
	'comment_notes_before' => '',
	'class_form'           => 'comment-form',
	'cancel_reply_link'    => esc_html__( 'Cancel reply', 'weldo' ),
	'label_submit'         => esc_html__( 'Submit a Comment', 'weldo' ),
	'title_reply'          => $title_reply,
	'title_reply_before'   => '<div class="ms p-50 ' . esc_attr( $options['version'] ) . '"><h4 class="comments-title"><span>',
	'title_reply_after'    => '</span></h4>',
	'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="btn btn-maincolor btn-small %3$s">%4$s</button>',
	'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
	'format'               => 'html5',
);
add_action( 'comment_form_after', 'weldo_echo_closing_div' );

?>

<div id="comments" class="post-comments comments-area">

	<div class="comment-respond <?php echo esc_attr( $options['version'] ); ?>">
		<div class="ls">
			<?php comment_form( $args ); ?>
		</div>
	</div>
	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="nav-links" role="navigation">
				<?php paginate_comments_links( array(
					'prev_text' => '<i class="fa fa-chevron-left"></i>',
					'next_text' => '<i class="fa fa-chevron-right"></i>',
				) ); ?>
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'walker'      =>weldo_return_comments_walker(),
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 80,
			) );
			?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="nav-links" role="navigation">
				<?php paginate_comments_links( array(
						'prev_text' => '<i class="fa fa-chevron-left"></i>',
						'next_text' => '<i class="fa fa-chevron-right"></i>',
					)
				); ?>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'weldo' ); ?></p>
		<?php endif; //comments_open() ?>

	<?php endif; // have_comments() ?>
</div><!-- #comments -->