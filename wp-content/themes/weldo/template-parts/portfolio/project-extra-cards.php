<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads   = content_url( '/uploads' );
$theme_img = get_template_directory_uri() . '/img';

/*
 * IMAGE REFERENCE — copy a path into the 'image' field below.
 *
 * Uploads folder (wp-content/uploads/2026/06/):
 *   $uploads . '/2026/06/4.jpeg'           — screen / door close-up
 *   $uploads . '/2026/06/reference_1.jpg'
 *   $uploads . '/2026/06/reference_2.jpeg'
 *   $uploads . '/2026/06/reference_3.jpg'
 *   $uploads . '/2026/06/reference_4.jpg'
 *   $uploads . '/2026/06/slide_2.jpeg'
 *   $uploads . '/2026/06/slide_3.jpeg'
 *   $uploads . '/2026/06/slide_4.jpeg'
 *
 * Theme folder (wp-content/themes/weldo/img/):
 *   $theme_img . '/catalog-glass-bg.jpeg'  — glass / sunroom (katalog hero style)
 *   $theme_img . '/reference_image.jpeg'
 *
 * Layout: 3 cards per row on desktop (col-lg-4), 2 on tablet, 1 on mobile.
 * Add/remove array entries — each entry = one card.
 */
$cards = array(
	array(
		'image' => $uploads . '/2026/06/4.jpeg',
		'title' => 'ALUMINUM PERGOLA',
	),
	array(
		'image' => $uploads . '/2026/06/reference_1.jpg',
		'title' => 'GLASS ROOF',
	),
	array(
		'image' => $uploads . '/2026/06/reference_2.jpeg',
		'title' => 'OUTDOOR KITCHEN',
	),
);

if ( empty( $cards ) ) {
	return;
}
?>
<div class="isotope-wrapper isotope row c-mb-30 c-gutter-30 weldo-project-extra-cards">
	<?php foreach ( $cards as $card ) : ?>
		<div class="isotope-item item-layout-regular col-lg-4 col-md-4 col-sm-6 col-12">
			<div class="vertical-item item-gallery content-absolute text-center ds ms">
				<div class="item-media">
					<img src="<?php echo esc_url( $card['image'] ); ?>"
					     alt="<?php echo esc_attr( $card['title'] ); ?>">
					<div class="media-links">
						<div class="links-wrap">
							<a class="link-zoom photoswipe-link"
							   href="<?php echo esc_url( $card['image'] ); ?>"
							   title="<?php echo esc_attr( $card['title'] ); ?>"></a>
						</div>
					</div>
				</div>
				<div class="item-content gradientdarken-background">
					<h6 class="item-meta">
						<span><?php echo esc_html( $card['title'] ); ?></span>
					</h6>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
