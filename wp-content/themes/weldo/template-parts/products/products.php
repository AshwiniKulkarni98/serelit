<?php
/**
 * Products section template - dynamic products from JSON data
 * Now displays reference/project showcase items
 */

// Load products from JSON
$products_file = get_template_directory() . '/data/products.json';
$products = array();
if ( file_exists( $products_file ) ) {
    $products_json = file_get_contents( $products_file );
    $products = json_decode( $products_json, true );
}

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
                                <img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo esc_attr( $product['image'] ); ?>" alt="<?php echo esc_attr( $product['title'] ); ?>">
                            </div>
                            <div class="product_info reference_info">
                                <h3 class="product_title reference_title"><?php echo esc_html( $product['title'] ); ?></h3>
                                <p class="product_description"><?php echo esc_html( $product['description'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <button class="carousel_nav carousel_nav_next"><i class="fa fa-chevron-down"></i></button>
        </div>
        
        <div class="products_action">
            <a href="<?php echo get_permalink( get_page_by_title( 'References' ) ); ?>" class="view_all_button">View All References</a>
        </div>
    </div>
</section>
