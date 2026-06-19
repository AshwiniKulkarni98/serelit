<?php
/**
 * Products section template - dynamic products from JSON data
 * Now displays reference/project showcase items
 */

// $products           = weldo_get_featured_references( 4 );
$uploads = content_url( '/uploads' );

$products = array(
	array(
		'title'       => 'MAI 2024 - KOALA CAFÉ IN WIESBADEN',
		'image'       => $uploads . '/2026/06/reference_1.jpg',
		'description' => '',
	),
	array(
		'title'       => 'INNENPOOL - 2026',
		'image'       => $uploads . '/2026/06/reference_2.jpeg',
		'description' => '',
	),
	array(
		'title'       => 'MAI 2024 - KOALA CAFÉ IN WIESBADEN',
		'image'       => $uploads . '/2026/06/reference_3.jpg',
		'description' => '',
	),
	array(
		'title'       => 'MAI 2024 - KOALA CAFÉ IN WIESBADEN',
		'image'       => $uploads . '/2026/06/reference_4.jpg',
		'description' => '',
	),
);

$katalog_page = get_page_by_path( 'katalog' );
$references_page_url = $katalog_page
	? get_permalink( $katalog_page )
	: home_url( '/katalog/' );
?>
<section class="products_section s-pt-60 s-pb-60" id="products">
    <div class="container">
        <h2 class="section_title">Unsere ausgewählten Referenzen</h2>
        
        <div class="products_carousel">
            <div class="products_list">
            <?php if ( ! empty( $products ) ) : ?>
                    <?php foreach ( $products as $product ) : ?>
                        <div class="product_card reference_card">
                            <div class="product_image">
                                <a href="<?php echo esc_url( $product['image'] ); ?>"
                                   class="photoswipe-link"
                                   title="<?php echo esc_attr( $product['title'] ); ?>">
                                    <img src="<?php echo esc_url( $product['image'] ); ?>" alt="<?php echo esc_attr( $product['title'] ); ?>">
                                </a>
                            </div>
                            <div class="product_info reference_info">
                                <h3 class="product_title reference_title"><?php echo esc_html( $product['title'] ); ?></h3>
                                <?php if ( ! empty( $product['description'] ) ) : ?>
                                    <p class="product_description"><?php echo esc_html( $product['description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="products_action">
            <a href="<?php echo esc_url( $references_page_url ); ?>" class="view_all_button">Sehen Sie sich unseren Katalog an</a>
        </div>
    </div>
</section>
