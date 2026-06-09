<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$var           = get_term( $cat );
$thumbnail_id  = get_term_meta( $var -> term_id, 'thumbnail_id', true );
$icon          = get_term_meta( $var -> term_id, 'fw_options', true );
$image         = wp_get_attachment_url( $thumbnail_id );
$category_link = get_category_link( $var -> term_id );
?>

<article class="vertical-item woo-product-category layout-<?php echo esc_attr( $atts['item_layout'] . ' ' . $atts['background_color'] . ' ' . $atts['text_align'] ) ?>">
    <?php
    if ( $atts['item_layout'] === 'item-icon' ) {
	    if ( ! empty( $icon ) ) : ?>
            <a href="<?php echo esc_url( $category_link ); ?>">
                <div class="icon-styled mb-25 <?php echo esc_attr( $atts['icon_color'] ); ?>">
                    <i class="<?php echo esc_attr( $icon['icon']['icon-class'] ) ?>"></i>
                </div>
            </a>
	    <?php endif;
    } else {
	    if ( ! empty( $image ) ) : ?>
            <div class="item-media">
                <a href="<?php echo esc_attr( $category_link ); ?>">
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image ); ?>">
                </a>
            </div>
	    <?php endif;
    }
    ?>
    <div class="item-content">
		<h5 class="category-title">
			<a href="<?php echo esc_url( $category_link ); ?>">
				<?php echo esc_attr( $var -> name ); ?>
			</a>
		</h5>
		<?php if ( ! empty( $var -> description ) ) : ?>
            <p class="description">
				<?php echo esc_attr( $var -> description ); ?>
			</p>
		<?php endif; ?>
	</div>
</article>