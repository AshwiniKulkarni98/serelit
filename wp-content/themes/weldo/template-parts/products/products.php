<?php
/**
 * Products section template - dynamic products from JSON data
 * Now displays reference/project showcase items
 */

// $products           = weldo_get_featured_references( 4 );
$uploads = content_url( '/uploads' );

$products = array(
	array(
		'title'       => 'FLIEGENGITTERSYSTEME',
		'image'       => $uploads . '/2026/06/reference_1.jpg',
		'description' => '',
	),
	array(
		'title'       => 'ALUMINIUMPERGOLA',
		'image'       => $uploads . '/2024/05/IMG-20240526-WA0004-1024x768.jpg',
		'description' => '',
	),
	array(
		'title'       => 'WINTERGÄRTEN',
		'image'       => $uploads . '/2026/06/reference_3.jpg',
		'description' => '',
	),
	array(
		'title'       => 'Your 4th Title',
		'image'       => $uploads . '/2026/06/reference_4.jpg',
		'description' => 'Optional short description here',
	),
);

$references_page     = weldo_get_references_page();
$references_page_url = $references_page ? get_permalink( $references_page ) : home_url( '/' );
?>
<section class="products_section s-pt-60 s-pb-60" id="products">
    <div class="container">
        <h2 class="section_title">Our Featured References</h2>
        
        <div class="products_carousel">
            <button class="carousel_nav carousel_nav_prev"><i class="fa fa-chevron-down"></i></button>
            
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
            
            <button class="carousel_nav carousel_nav_next"><i class="fa fa-chevron-down"></i></button>
        </div>
        
        <div class="products_action">
            <a href="<?php echo esc_url( $references_page_url ); ?>" class="view_all_button">View All References</a>
        </div>
    </div>
</section>
