<?php
/**
 * The template for displaying the footer and copyrights
 *
 * Contains footer content and the closing of the main container, row and section. Also closing #canvas and #box_wrapper
 */
if ( ! is_page_template( 'page-templates/full-width.php' )
	&& ! is_page_template( 'page-templates/home-page.php' )
	&& ! is_singular( 'fw-team' )
	&& ! is_singular( 'fw-services' ) ) : ?>
				</div><!-- eof .row-->

			</div><!-- eof .container -->
		</section><!-- eof .page_content -->
	<?php
endif;


if(! is_404()) {

	if (
		is_active_sidebar( 'sidebar-footer-1' )
		|| is_active_sidebar( 'sidebar-footer-2' )
		|| is_active_sidebar( 'sidebar-footer-3' )
		|| is_active_sidebar( 'sidebar-footer-4' )
	)
	{
		$footer = weldo_get_predefined_template_part( 'footer' );
		get_template_part( 'template-parts/footer/' . esc_attr( $footer ) );
	} //is_active_sidebar


}
$copyright = weldo_get_predefined_template_part( 'copyright' );
get_template_part( 'template-parts/copyright/' . esc_attr( $copyright ) );

?>
	</div><!-- eof #box_wrapper -->
</div><!-- eof #canvas -->
<?php wp_footer(); ?>
</body>
</html>