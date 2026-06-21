<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cards = get_query_var( 'weldo_gallery_cards', array() );

if ( empty( $cards ) && function_exists( 'weldo_get_project_gallery_cards' ) ) {
	$cards = weldo_get_project_gallery_cards( get_the_ID() );
}

if ( empty( $cards ) ) {
	return;
}
?>
<div class="isotope-wrapper isotope row c-mb-30 c-gutter-30 weldo-project-extra-cards photoswipe-container">
	<?php foreach ( $cards as $card ) : ?>
		<?php
		$title = isset( $card['title'] ) ? $card['title'] : '';
		$alt   = $title ? $title : __( 'Project image', 'weldo' );
		$zoom  = ! empty( $card['full'] ) ? $card['full'] : $card['image'];
		?>
		<div class="isotope-item item-layout-regular col-lg-4 col-md-4 col-sm-6 col-12">
			<div class="vertical-item item-gallery content-absolute text-center ds ms">
				<div class="item-media">
					<img src="<?php echo esc_url( $card['image'] ); ?>"
					     alt="<?php echo esc_attr( $alt ); ?>">
					<div class="media-links">
						<a class="abs-link photoswipe-link"
						   href="<?php echo esc_url( $zoom ); ?>"
						   title="<?php echo esc_attr( $alt ); ?>"></a>
						<div class="links-wrap">
							<a class="link-zoom photoswipe-link"
							   href="<?php echo esc_url( $zoom ); ?>"
							   title="<?php echo esc_attr( $alt ); ?>"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
