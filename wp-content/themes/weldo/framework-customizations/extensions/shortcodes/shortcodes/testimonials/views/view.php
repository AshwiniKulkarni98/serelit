<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id               = uniqid( 'testimonials-' );
$additional_class = ! empty( $atts['additional_class'] ) ? $atts['additional_class'] : '';

?>

<?php if ( ! empty( $atts['title'] ) ): ?>
    <h3 class="fw-testimonials-title text-center"><?php echo esc_html( $atts['title'] ); ?></h3>
<?php endif;

switch ( $atts['layout'] ) :
    case '2':
?>
    <div class="testimonials-slider2 owl-carousel <?php echo esc_attr( $additional_class ) ?>"
         data-loop="true"
         data-responsive-lg="3"
         data-responsive-md="2"
         data-responsive-sm="2"
         data-center="true"
         data-nav="false"
         data-dots="false"
    >
        <?php foreach ( $atts['testimonials'] as $testimonial ): ?>
            <div class="quote-item2 text-center hero-bg">
                <div class="quote-image">
                <?php
                $author_image_url = ! empty( $testimonial['author_avatar']['url'] )
                    ? $testimonial['author_avatar']['url']
                    : fw_get_framework_directory_uri( '/static/img/no-image.png' );
                ?>
                    <img src="<?php echo esc_attr( $author_image_url ); ?>"
                         alt="<?php echo esc_attr( $testimonial['author_name'] ); ?>"/>
                </div>
                <div class="quote-content <?php echo esc_attr( $atts['quote_mark_style'] ); ?>">
                    <?php if ( $testimonial['content'] ) : ?>
                        <p>
                            <?php echo esc_html( $testimonial['content'] ); ?>
                        </p>
                    <?php endif; //content ?>
                    <div class="author-meta">
                        <?php if ( !empty( $testimonial['author_name'] ) ) : ?>
                            <p class="author-name"><?php echo esc_html( $testimonial['author_name'] ); ?></p>
                        <?php endif;
                        if ( !empty( $testimonial['author_job'] ) ) : ?>
                            <p><?php echo esc_html( $testimonial['author_job'] ); ?></p>
                        <?php endif; ?>
                    </div>
	                <?php if ( ! empty( $testimonial['author_name'] ) ) : ?>
                        <p class="fw-400 color-darkgrey">
			                <?php if ( $testimonial['site_url'] ) : ?>
                                <a href="<?php echo esc_attr( $testimonial['site_url'] ); ?>">
                            <?php endif; //site_url
                            echo esc_html( $testimonial['site_name'] );
                            if ( $testimonial['site_url'] ) : ?>
                                </a>
                            <?php endif; //site_url ?>
                        </p>
	                <?php endif; //author_name ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div> <!-- .testimonials-slider.owl-carousel -->
<?php
//3
break;
    default:
?>
    <div class="testimonials-slider owl-carousel <?php echo esc_attr( $additional_class ) ?>"
         data-loop="true"
         data-responsive-lg="1"
         data-responsive-md="1"
         data-responsive-sm="1"
         data-nav="true"
         data-dots="false"
    >
        <?php foreach ( $atts['testimonials'] as $testimonial ): ?>
            <div class="quote-item text-center text-md-left">
                <div class="quote-image <?php echo esc_attr( $atts['quote_mark_style'] ); ?>">
                <?php
                $author_image_url = ! empty( $testimonial['author_avatar']['url'] )
                ? $testimonial['author_avatar']['url']
                : fw_get_framework_directory_uri( '/static/img/no-image.png' );
                ?>
                    <img src="<?php echo esc_attr( $author_image_url ); ?>"
                         alt="<?php echo esc_attr( $testimonial['author_name'] ); ?>"/>
                </div>
                <div class="quote-content">
                    <?php if ( ! empty( $testimonial['author_name'] ) ) : ?>
                        <p class="fw-400 color-darkgrey">
                            <?php echo esc_html( $testimonial['author_name'] ); ?> <?php echo esc_html( $testimonial['author_job'] || $testimonial['site_name'] ) ? ',' : ''; ?>
                            <span>
                                <?php echo esc_html( $testimonial['author_job'] ); ?>
                            </span>
                            <?php echo esc_html( $testimonial['author_job'] && $testimonial['site_name'] ) ? ',' : ''; ?>
                            <?php if ( $testimonial['site_url'] ) : ?>
                                <a href="<?php echo esc_attr( $testimonial['site_url'] ); ?>">
                            <?php endif; //site_url ?>
                                <?php echo esc_html( $testimonial['site_name'] ); ?>
                            <?php if ( $testimonial['site_url'] ) : ?>
                                </a>
                            <?php endif; //site_url ?>
                        </p>
                    <?php endif; //author_name ?>
                    <?php if ( $testimonial['content'] ) : ?>
                        <p>
                            <?php echo esc_html( $testimonial['content'] ); ?>
                        </p>
                    <?php endif; //content ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div> <!-- .testimonials-slider.owl-carousel -->
<?php endswitch;