<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads   = content_url( '/uploads' );
$theme_img = get_template_directory_uri() . '/img';

/*
 * Katalog page — uniform image grid (3 per row).
 * Edit the $images array to add, remove, or reorder catalog photos.
 *
 * Uploads: wp-content/uploads/2026/06/
 * Theme:   wp-content/themes/weldo/img/
 */
// $images = array(
// 	array(
// 		'image' => $uploads . '/2026/06/slide_3.jpeg',
// 		'title' => 'ALUMINUM PERGOLA',
// 	),
// 	array(
// 		'image' => $uploads . '/2026/06/reference_4.jpg',
// 		'title' => 'GLASS ROOF',
// 	),
// 	array(
// 		'image' => $uploads .  '/2026/06/slide_2.jpeg',
// 		'title' => 'OUTDOOR KITCHEN',
// 	),
// );
$images = array(
	$uploads . '/2026/06/4.jpeg',
	$uploads . '/2026/06/slide_3.jpeg',
	$uploads . '/2026/06/slide_4.jpeg',
	$uploads . '/2026/06/reference_4.jpg',
	$uploads . '/2026/06/reference_1.jpg',
	$uploads . '/2026/06/reference_2.jpeg',
	$uploads . '/2026/06/reference_3.jpg',
	$uploads . '/2026/06/slide_2.jpeg',
	$theme_img . '/catalog-glass-bg.jpeg',
);

if ( empty( $images ) ) {
	return;
}
?>
<section class="weldo-katalog-grid s-pt-30 s-pb-60">
	<div class="container">
		<div class="row c-mb-30 c-gutter-30">
			<?php foreach ( $images as $image_url ) : ?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12">
					<div class="katalog-grid-card">
						<div class="katalog-grid-image-wrap">
							<a href="<?php echo esc_url( $image_url ); ?>"
							   class="katalog-grid-link photoswipe-link"
							   title="<?php esc_attr_e( 'Catalog image', 'weldo' ); ?>">
								<img src="<?php echo esc_url( $image_url ); ?>"
								     alt="<?php esc_attr_e( 'Catalog image', 'weldo' ); ?>">
							</a>
							<a href="#"
							   class="btn btn-maincolor btn-small katalog-more-btn">
								<?php esc_html_e( 'Mehr', 'weldo' ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
