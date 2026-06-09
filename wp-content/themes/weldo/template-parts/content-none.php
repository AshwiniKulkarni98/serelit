<?php
/**
 * The template for displaying a "No posts found" message
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post?', 'weldo') . '<a href="%1$s">' . esc_html__( 'Get started here', 'weldo' ). '</a>.', admin_url( 'post-new.php' ) ); ?></p>
<?php else : ?>
	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'weldo' ); ?></p>
	<div class="widget widget_search">
		<?php get_search_form(); ?>
	</div>
<?php endif;