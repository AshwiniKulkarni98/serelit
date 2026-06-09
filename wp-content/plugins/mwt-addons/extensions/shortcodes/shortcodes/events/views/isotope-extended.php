<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! fw()->extensions->get( 'events' ) ) {
	return;
}
/**
 * @var object $srortcode
 * @var array $atts
 * @var array $posts
 */

$unique_id = uniqid();
$nav = $atts['nav'];


//get all terms for filter
$terms = get_terms( array( 'post_type ' => 'fw-event-taxonomy-name' ) );

?>

<div>

	<?php
	foreach ( $posts as $key => $post ) :
		//get categories slugs for isotope filters
		$post_terms       = get_the_terms( $post->ID, 'fw-event-taxonomy-name' );
		$post_terms_class = '';
		if ( ! empty ( $post_terms ) ) :
			foreach ( $post_terms as $post_term ) :
				$post_terms_class .= $post_term->slug . ' ';
			endforeach;
		endif;

		$event_place = $shortcode->fw_get_event_place_by_id( $post->ID );
		$event_place_location = $shortcode->fw_get_event_place_location_by_id( $post->ID );
		$event_dates = $shortcode->fw_get_event_dates_by_id( $post->ID ); ?>
		<article class="<?php echo esc_attr( 'fw-event fw-post-event side-item text-center text-md-left content-padding box-shadow ' . ' ' . $post_terms_class . ' id-' . $unique_id . '-' . $post->ID); ?>">
			<div
					class="<?php echo esc_attr( 'row'); ?>">
				<?php
				include $shortcode->locate_path( '/views/item-regular.php' );
				?>
			</div>
		</article>

	<?php endforeach; ?>
	<?php //removed reset the query ?>
</div>


