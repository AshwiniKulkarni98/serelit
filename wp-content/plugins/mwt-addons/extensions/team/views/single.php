<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * The template for displaying single service
 *
 */

get_header();
$pID = get_the_ID();

//no columns on single service page
$column_classes = fw_ext_extension_get_columns_classes( true );
$options = weldo_get_options();

//getting taxonomy name
$ext_team_settings = fw()->extensions->get( 'team' )->get_settings();
$taxonomy_name = $ext_team_settings['taxonomy_name'];

$atts = fw_get_db_post_option(get_the_ID());

$shortcodes_extension = fw()->extensions->get( 'shortcodes' );

$unique_id = uniqid();
?>
<section class="<?php echo esc_attr( $options['version'] ); ?> s-pt-60 s-pb-0 s-pt-lg-90 s-pt-xl-100 text-center text-lg-left team-single">
	<div class="container">
		<div class="row">
			<div id="content" class="<?php echo esc_attr( $column_classes['main_column_class'] ); ?>">
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('row align-items-center  c-gutter-30'); ?>>
						<div class="col-lg-6 col-xl-7">
							<?php the_post_thumbnail('weldo-square'); ?>
						</div><!-- eof .col-xl-7 -->
						<div class="ml-auto col-lg-6 col-xl-5">
							<div class="divider-35 d-lg-none"></div>
							<div class="team-info pl-lg-30 pl-xl-0">
								<!-- .entry-header -->
								<h4 class="big team-name position-relative">
									<?php the_title(); ?>
								</h4>
								<?php if ( ! empty( $atts['position'] ) ) : ?>
									<p class="team-position subheading mb-10 mb-lg-25">
										<?php echo esc_html( $atts['position'] ); ?>
									</p>
								<?php endif; //position ?>
								<?php if ( ! empty( $atts['social_icons'] ) ) : ?>
									<p class="team-social-icons with-line">
										<?php
										if ( ! empty( $shortcodes_extension ) ) {
											echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_social' )->render( array( 'social_icons' => $atts['social_icons'] ) );
										}
										?>
									</p><!-- eof social icons -->
								<?php endif; //social icons ?>
								<?php if ( ! empty( $atts['additional_content'] ) ) : ?>
									<div class="member-additional-content mt-20 mt-lg-45">
										<?php echo wp_kses_post( $atts['additional_content'] ); ?>
									</div>
								<?php endif; //additional content ?>
								<?php if ( ! empty( $atts['icons'] ) ) : ?>
									<div class="member-info mt-15">
										<?php if ( ! empty( $shortcodes_extension ) ) {
											echo fw_ext( 'shortcodes' )->get_shortcode( 'icons_list' )->render( array( 'icons' => $atts['icons'] ) );
										} ?>
									</div><!-- eof icons -->
								<?php endif; //icons ?>
								<?php if ( ! empty( json_decode($atts['form']['json'])[1] ) && ( ! empty( $atts['button_label'] ) ) ) :?>
									<div class="divider-30 d-none d-lg-block"></div>
									<a href="#" class="btn btn-maincolor btn-wide team_contact_modal"><?php echo esc_html( $atts['button_label'] ); ?></a>
								<?php endif; ?>
								<?php if ( ! empty( json_decode($atts['form']['json'])[1] ) ) :?><!--Contact form -->
									<div class="modal fade text-center team_contact_form" id="team_contact_modal">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">
												<div class="modal-body">
													<?php echo fw_ext( 'shortcodes' )->get_shortcode( 'contact_form' )->render( $atts ); ?>
												</div>
											</div>
										</div>
									</div>
								<?php endif;?>
							</div><!-- .team-info -->
						</div><!-- eof .col-xl-5 -->
					</article><!-- #post-## -->
				<?php endwhile; ?>
			</div><!--eof #content -->
		</div>
	</div>
</section>
<?php the_content(); ?>

<?php if ( $column_classes['sidebar_class'] ): ?>
	<!-- main aside sidebar -->
	<aside class="<?php echo esc_attr( $column_classes['sidebar_class'] ); ?>">
		<?php get_sidebar(); ?>
	</aside>
	<!-- eof main aside sidebar -->
	<?php
endif;
get_footer();