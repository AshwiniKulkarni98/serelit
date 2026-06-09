<?php

/**
 * -------------------------
 * The Template Tags Library
 * -------------------------
 *
 * Formatted output for:
 *
 * 1.  Excerpt.
 *
 *          Outputs:     weldo_the_excerpt();            // Post excerpt cropped to manually specified length in 'words'(default) or 'symbols'   // does not break words by default
 *
 *          Getters:     weldo_get_the_excerpt();        // Post excerpt cropped to manually specified length
 *
 *
 * 2.  Categories, Tags, Terms.
 *
 *          Outputs:     weldo_the_categories();         // Categories List      // also works for predefined post types ( see: weldo_auto_taxonomy(); )
 *                       weldo_the_tags();               // Tags List            // also works for predefined post types ( see: weldo_auto_taxonomy(); )
 *                       weldo_the_terms();              // Terms List           // !  not recommended use directly
 *
 *                       weldo_featured_category();      // Featured Category    // can be more than one     // also works for predefined post types ( see: weldo_auto_taxonomy(); )
 *                       weldo_featured_tag();           // Featured Tag         // can be more than one     // also works for predefined post types ( see: weldo_auto_taxonomy(); )
 *                       weldo_featured_term();          // Featured Term        // ! not recommended to use directly
 *
 *          Getters:     weldo_get_the_categories();     // Categories List
 *                       weldo_get_the_tags();           // Tags List
 *                       weldo_get_the_terms();          // Terms List           // ! not recommended to use directly    // ! Arguments list ( defaults )
 *
 *                       weldo_get_featured_category();  // Featured Category
 *                       weldo_get_featured_tag();       // Featured Tag
 *                       weldo_get_featured_term();      // Featured Term        // ! not recommended to use directly
 *
 *          Admin:       weldo_get_term_choices();       // Array of terms for Unyson Post Options
 *
 *
 * 3.  Date, Time.
 *
 *          Outputs:     weldo_the_date();               // Post Date    // works for all post_types     // uses date format from Admin Settings
 *                       weldo_the_time();               // Post Time    // works for all post_types     // uses time format from Admin Settings
 *                       weldo_comment_date();           // Comment Date     // uses date format from Admin Settings
 *                       weldo_comment_time();           // Comment Time     // uses time format from Admin Settings
 *
 *          Getters:     weldo_get_the_date();           // Post Date
 *                       weldo_get_the_time();           // Post Time
 *                       weldo_get_comment_date();       // Comment Date
 *                       weldo_get_comment_time();       // Comment Time
 *
 *                       weldo_get_object_time();        // Base Function     // ! not recommended to use directly
 *
 *
 * 4.  Comments Counter
 *
 *          Outputs:     weldo_comments_counter();       // Multivariant String like: 1 Comment / 2 Comments / Leave a comment / Comments are closed
 *
 *          Getters:     weldo_get_comments_counter();
 *
 *
 * 5.  Author
 *
 *          Outputs:     weldo_the_author();             // Post Author  // works for all post_types
 *
 *          Getters:     weldo_get_the_author();         // Post Author
 *
 *
 * 6.  Sticky Marker
 *
 *          Outputs:     weldo_sticky_marker();          // Marker for Sticky posts ( example: <i class="sticky-marker fa fa-paperclip"></i> )
 *
 *          Getters:     weldo_get_sticky_marker();      // Marker for Sticky posts
 *
 *
 * 7.  More Button
 *
 *          Outputs:     weldo_more_button();            // 'Read More' button ( do not confuse with excerpt more link )
 *
 *          Getters:     weldo_get_more_button();        // 'Read More' button
 *
 *
 * 8.  Post Navigation Panels   ( ! Experimental. Will be totally refactored )
 *
 *          Outputs:     weldo_post_nav_panels();        // Navigation Panels to next/previous post  // ! requires _template_tags.scss
 *
 *
 * 9.  Page Links   ( ! Experimental. Will be totally refactored )
 *
 *          Outputs:     weldo_page_links();             // Post Page Links
 *
 *
 * 10. Related Posts    ( ! Experimental. Will be totally refactored )
 *
 *          Outputs:     weldo_related_posts();         // Related Posts based on Tags
 *
 *
 * Usage Examples:
 *
 *      [code]:
 *
 *          weldo_the_categories();
 *
 *      [output]:
 *
 *          <a href="http://weldo.com/category/category-1/">Category 1</a>
<span class="terms-separator">, </span>
<a href="http://weldo.com/category/category-2/">Category 2</a>
<span class="terms-separator">, </span>
<a href="http://weldo.com/category/category-3/">Category 3</a>
<span class="terms-separator">, </span>
<a href="http://weldo.com/category/category-4/">Category 4</a>
 *
 *
 *      [code]:  ! see weldo_get_the_terms() for defaults and arguments documentation
 *
 *          weldo_the_categories( array(
'before'            => '<span class="post-categories">Categories: ',
'after'             => '</span>',
'before_singular'   => '<span class="post-categories">Category: ',
'item_before'       => '<span class="item">',
'item_after'        => '</span>',
'link_class'        => 'link',
'link_attributes'   => 'attr="attr_value"',
'link_before'       => '_',
'link_after'        => '_',
'max_items'         => 3,
'items_separator'   => '<span class="terms-separator"> | </span>',
'kses_atts'         => array( 'attr' => true ),
) );
 *
 *      [output if multiple]:
 *
 *          <span class="post-categories">
Categories:
<span class="item">
<a class="link" attr="attr_value" href="http://weldo.com/category/category-1/">_Category 1_</a>
</span>
<span class="terms-separator"> | </span>
<span class="item">
<a class="link" attr="attr_value" href="http://weldo.com/category/category-2/">_Category 2_</a>
</span>
<span class="terms-separator"> | </span>
<span class="item">
<a class="link" attr="attr_value" href="http://weldo.com/category/category-3/">_Category 3_</a>
</span>
</span>
 *
 *      [output if single]:
 *
 *          <span class="post-categories">
Category:
<span class="item">
<a class="link" attr="attr_value" href="http://weldo.com/category/category-1/">_Category 1_</a>
</span>
</span>
 */


if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

/**
 * Tools
 */

if ( ! function_exists( 'weldo_auto_taxonomy' ) ) :
    /**
     * Return taxonomy of given type for given post_type.
     */
    function weldo_auto_taxonomy( $args = array() ) {

        $post_type = array_key_exists( 'post_type', $args )
            ? $args['post_type']
            : ( array_key_exists( 'post_id', $args )
                ? get_post_type( $args['post_id'] )
                : get_post_type() );

        $type = array_key_exists( 'type', $args ) ? $args['type'] : 'category';

        $out = '';

        $taxonomies = array(
            'post'         => array(
                'category' => 'category',
                'tag'      => 'post_tag',
            ),
            'fw-portfolio' => array(
                'category' => 'fw-portfolio-category',
            ),
            'fw-event'     => array(
                'category' => 'fw-event-taxonomy-name',
            ),
            'fw-services'  => array(
                'category' => 'fw-services-category',
            ),
            'fw-team'  => array(
                'category' => 'fw-team-category',
            ),
            'product'      => array(
                'category' => 'product_cat',
                'tag'      => 'product_tag',
            ),
        );

        $taxonomies = array_merge( $taxonomies, apply_filters( 'weldo_auto_taxonomy_list', array() ) );

        if ( array_key_exists( $post_type, $taxonomies ) ) {
            if ( array_key_exists( $type, $taxonomies[ $post_type ] ) ) {
                $out = $taxonomies[ $post_type ][ $type ];
            }
        }

        return $out;
    }
endif;


if ( ! function_exists( 'weldo_tt_kses_list' ) ) :
    /**
     * Return array of allowed tags for template tags functions.
     */
    function weldo_tt_kses_list( $args = array() ) {

        $kses_tags = array();
        $kses_atts = array();
        if ( array_key_exists( 'kses_tags', $args ) ) {
            $kses_tags = $args[ 'kses_tags' ];
        }
        if ( array_key_exists( 'kses_atts', $args ) ) {
            $kses_atts = $args[ 'kses_atts' ];
        }
        $out = function_exists( 'weldo_kses_list' ) ? weldo_kses_list( $kses_tags, $kses_atts ) : 'post';
        $out = apply_filters( 'weldo_tt_kses_list', $out );

        return $out;
    }
endif;


/**
 * Excerpt.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_the_excerpt' ) ) :
    /**
     * Retrieve excerpt with custom length in characters or words and custom more link.
     */
    function weldo_get_the_excerpt( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */           /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]           = true;

        /* @var $post_id int|false */    /** Post ID */
        $defaults[ 'post_id' ]         = get_the_ID();


        /* @var $use_summary bool */
        $defaults[ 'use_summary' ]                  = true;

        /* @var $use_content bool */
        $defaults[ 'use_content' ]                  = true;

        /* @var $content_part string */
        $defaults[ 'content_part' ]                 = 'whole-post';

        /* @var $respect_pages string */
        $defaults[ 'respect_pages' ]                = 'all-pages';


        /* @var $strip_shortcodes bool */
        $defaults[ 'strip_shortcodes' ]             = true;

        /* @var $use_the_content_filters bool */
        $defaults[ 'use_the_content_filters' ]      = true;

        /* @var $escape_cdata_closing bool */
        $defaults[ 'escape_cdata_closing' ]         = true;

        /* @var $strip_tags bool */
        $defaults[ 'strip_tags' ]                   = true;

        /* @var $merge_spaces bool */
        $defaults[ 'merge_spaces' ]                 = true;


        /* @var $length int */
        $defaults[ 'length' ]                       = 55;

        /* @var $crop_type string */
        $defaults[ 'crop_type' ]                    = 'words';

        /* @var $respect_words bool */
        $defaults[ 'respect_words' ]                = true;


        /* @var $before string */
        $defaults[ 'before' ]                       = '';

        /* @var $after string */
        $defaults[ 'after' ]                        = '';


        /* @var $more string */
        $defaults[ 'more' ]                         = esc_html__( '[...]', 'weldo' );

        /* @var $more_only_if_cropped bool */
        $defaults[ 'more_only_if_cropped' ]         = true;

        /* @var $more_before string */
        $defaults[ 'more_before' ]                  = '';

        /* @var $more_after string */
        $defaults[ 'more_after' ]                   = '';

        /* @var $use_link bool */
        $defaults[ 'use_link' ]                     = false;

        /* @var $link_class string */
        $defaults[ 'link_class' ]                   = '';

        /* @var $link_attributes string */
        $defaults[ 'link_attributes' ]              = '';

        /* @var $link_before string */
        $defaults[ 'link_before' ]                  = '';

        /* @var $link_after string */
        $defaults[ 'link_after' ]                   = '';

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_the_excerpt_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        // print switcher for output function(s)
        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        // get excerpt
        $post = get_post( $post_id );
        if ( ! empty( $post ) ) {

            if ( post_password_required( $post ) ) {

                // if password protected
                $out = esc_html__( 'There is no excerpt because this is a protected post.', 'weldo' );
            } else {

                // use summary
                if ( $use_summary ) {

                    // raw data
                    $out = $post->post_excerpt;

                    // shortcodes
                    if ( $strip_shortcodes ) {
                        $out = strip_shortcodes( $out );
                    }
                }

                // use content  ( also if summary is empty )
                if ( '' == $out && $use_content ) {

                    // raw data
                    $out = get_extended( $post->post_content );

                    // pages   ( all / first / current )
                    if ( 'before-more' != $content_part ) {

                        // raw data
                        global $pages;

                        switch ( $respect_pages ) {

                            case 'first-page':
                                $out['extended'] = $pages[0];
                                break;

                            case 'current-page':
                                global $page;
                                $out['extended'] = $pages[ $page - 1 ];
                                break;

                            case 'all-pages':
                            default:
                                $out['extended'] = implode( ' ', $pages );
                                break;
                        }
                    }

                    switch ( $content_part ) {

                        case 'before-more':
                            $out = $out['main'];
                            break;

                        case 'after-more':
                            $out = $out['extended'];
                            break;

                        case 'whole-post':
                        default:
                            $out = implode( ' ', $out );
                            break;
                    }

                    // shortcodes
                    if ( $strip_shortcodes ) {
                        $out = strip_shortcodes( $out );
                    }

                    // the_content filters
                    if ( $use_the_content_filters ) {
                        $out = apply_filters( 'the_content', $out );
                    }

                    // escape CDATA closing tag
                    if ( $escape_cdata_closing ) {
                        $out = str_replace( ']]>', ']]&gt;', $out );
                    }
                }

            }

        }

        if ( '' != $out ) {
            //removing from excerpt invisible heading for section if page builder is used for post
            $out = preg_replace( '+<h6 class=\"d-none\">.*</h6>+', '', $out );

            // strip all tags
            if ( $strip_tags ) {
                $out = strip_tags( $out );
            }

            // merge spaces
            if ( $merge_spaces ) {
                $out = trim( preg_replace( '/\s+/', ' ', $out ) );
            }

            // crop
            $cropped = false;
            if ( $length > - 1 ) {

                // cropping needs strip tags
                if ( ! $strip_tags ) {
                    $out = strip_tags( $out );
                }

                $words_array = array();
                if ( 'words' == $crop_type || $respect_words ) {
                    $words_array = preg_split( "/[\n\r\t ]+/", $out, - 1, PREG_SPLIT_NO_EMPTY );
                }

                // words or symbols
                switch ( $crop_type ) {

                    case 'symbols':

                        if ( $length < strlen( $out ) ) {

                            if ( $respect_words ) {
                                $counter = 0;
                                $sum     = 0;
                                $lengths = array_map( 'strlen', $words_array );
                                for ( $i = 1; $i < count( $lengths ) - 1; $i ++ ) {
                                    $lengths[ $i ] ++;
                                }
                                foreach ( $lengths as $cur ) {
                                    $sum += $cur;
                                    if ( $sum > $length ) {
                                        break;
                                    }
                                    $counter ++;
                                }

                                $out = implode( ' ', array_slice( $words_array, 0, $counter ) );

                            } else {
                                $out = substr( $out, 0, $length );
                            }
                            $cropped = true;
                        }

                        break;

                    case 'words':
                    default:
                        if ( $length < count( $words_array ) ) {
                            $out     = implode( ' ', array_slice( $words_array, 0, $length ) );
                            $cropped = true;
                        }
                        break;
                }

                if ( $cropped && ( 'words' == $crop_type || $respect_words ) ) {
                    $more = ' ' . $more;
                }
            }

            // output
            $out = $before . $out;

            if ( '' != $more && ! ( $more_only_if_cropped && ! $cropped ) ) {

                $out .= $more_before;

                if ( $use_link ) {

                    $out .= sprintf( '<a%s%s%s>%s%s%s</a>',
                        '' != $link_class ? ' ' . 'class="' . $link_class . '"' : '',
                        ' ' . 'href="' . get_permalink( $post_id ) . '"',
                        '' != $link_attributes ? ' ' . $link_attributes : '',
                        $link_before,
                        $more,
                        $link_after
                    );

                } else {
                    $out .= $more;
                }

                $out .= $more_after;
            }

            $out .= $after;
        }

        return apply_filters( 'weldo_get_the_excerpt', $out );
    }
endif;


if ( ! function_exists( 'weldo_the_excerpt' ) ) :
    /**
     * Echo excerpt with custom length in characters or words and custom more link.
     */
    function weldo_the_excerpt( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_excerpt( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * Categories, Tags, Terms.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_term_choices' ) ) :
    /**
     * Retrieve associative array of "term_id => term_name" pairs.
     */
    function weldo_get_term_choices( $post_id, $taxonomy ) {

        $terms = get_the_terms( $post_id, $taxonomy );

        $out = array();

        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $out[ $term->term_id ] = $term->name;
            }
        }

        return $out;
    }
endif;


if ( ! function_exists( 'weldo_get_the_terms' ) ) :
    /**
     * Retrieve formatted terms.
     */
    function weldo_get_the_terms( $args = array() ) {

        $defaults = array();



        /* @var $print bool */           /** 'to print' switcher for output function(s) */
        $defaults[ 'print' ]           = true;

        /* @var $post_id int|false */    /** Post ID */
        $defaults[ 'post_id' ]         = get_the_ID();

        /* @var $taxonomy string */      /** Taxonomy */

        $defaults[ 'taxonomy' ]        = 'category';


        /* @var $featured_ids array */   /** Use only terms with this IDs */

        $defaults[ 'featured_ids' ]    = array();

        /* @var $empty_featured bool */  /** Use any terms if there are no featured */
        $defaults[ 'empty_featured' ]  = true;

        /* @var $max_items int */        /** Limit items number. -1 is not limited */
        $defaults[ 'max_items' ]       = - 1;

        /* @var $return_type string */   /** What will be returned */

        $defaults[ 'return_type' ]     = 'html';


        /* @var $before string */        /** Goes before all items */
        $defaults[ 'before' ]          = '';

        /* @var $after string */         /** Goes after all items */
        $defaults[ 'after' ]           = '';

        /* @var $before_singular string */ /** Overrides 'before', if there is only one item after all operations */
        $defaults[ 'before_singular' ] = '';

        /* @var $after_singular string */  /** Overrides 'after', if there is only one item after all operations */
        $defaults[ 'after_singular' ]  = '';

        /* @var $output_multiple bool */ /** Get items, if there is more then one item after all operations */
        $defaults[ 'output_multiple' ] = true;

        /* @var $output_singular bool */ /** Get items, if there is one item after all operations */
        $defaults[ 'output_singular' ] = true;


        /* @var $item_before string */   /** Goes before each item outside of the link */
        // Works, no matter if link is used or not.
        $defaults[ 'item_before' ]     = '';

        /* @var $item_after string */    /** Goes after each item outside of the link */
        //Works, no matter if link is used or not.
        $defaults[ 'item_after' ]      = '';

        /* @var $use_link bool */        /** Use link for each item. */
        $defaults[ 'use_link' ]        = true;

        /* @var $link_class string */    /** Class for each item's link */
        // Works, only if link is used.
        $defaults[ 'link_class' ]      = '';

        /* @var $link_attributes string */ /** Additional tag attributes for each item's link */
        // Works, only if link is used.
        $defaults[ 'link_attributes' ] = '';

        /* @var $link_before string */   /** Goes before each item inside of the link */
        // Works, only if link is used.
        $defaults[ 'link_before' ]     = '';

        /* @var $link_after string */    /** Goes after each item inside of the link. Works, only if link is used. */
        $defaults[ 'link_after' ]      = '';


        /* @var $screen_reader string */ /** Screen Reader html */
        // Goes between 'before' and items list.
        $defaults[ 'screen_reader' ]   = '';

        /* @var $items_separator string */ /** Goes between items */
        $defaults[ 'items_separator' ] = '<span class="terms-separator">'
            . esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'weldo' )
            . '</span>';


        // end of ARGUMENTS LIST

        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_the_terms_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        $crop = array_key_exists( 'crop', $args ) ? $args[ 'crop' ] : - 1;

        // print switcher for output function(s)
        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        // get terms
        $terms_raw = get_the_terms( $post_id, $taxonomy );
        $terms     = array();

        if ( ! empty( $terms_raw ) && ! is_wp_error( $terms_raw ) ) {

            // featured filter
            if ( is_string( $featured_ids ) ) {
                $featured_ids = function_exists( 'fw_get_db_post_option' )
                    ? fw_get_db_post_option( $post_id, $featured_ids, '' ) : '';
            }
            if ( ! is_array( $featured_ids ) ) {
                $featured_ids = array();
            }
            if ( ! empty( $featured_ids ) ) {
                foreach ( $terms_raw as $term ) {
                    if ( in_array( $term->term_id, $featured_ids ) ) {
                        $terms[] = $term;
                    }
                }
            }

            // use any terms if there are no featured
            if ( empty( $terms ) && $empty_featured ) {
                $terms = $terms_raw;
            }

            // crop terms array to $max_items
            if ( ! empty( $terms ) ) {
                if ( - 1 != $max_items ) {
                    $terms = array_slice( $terms, 0, $max_items );
                }
            }

            if ( ! empty( $terms ) ) {

                // crop terms array to $max_items
                if ( - 1 != $max_items ) {
                    $terms = array_slice( $terms, 0, $max_items );
                }

                // sanitize $return_type
                if ( ! in_array( $return_type, array( 'objects-array', 'html-array', 'html' ) ) ) {

                    $return_type = 'html';
                }

                if ( 'objects-array' != $return_type ) {

                    if ( $crop > - 1 && count( $terms ) > 0 ) {

                        $terms_length     = 0;
                        $terms_new_length = 0;
                        $separator_length = strlen( $items_separator );
                        $crop             = false;

                        foreach ( $terms as $key => &$term ) {

                            $terms_length += strlen( $term->name );

                            $terms_length += $separator_length;

                            if ( $crop ) {
                                unset( $terms[ $key ] );
                            } elseif ( $terms_length > $crop ) {
                                $crop             = true;
                                $terms_new_length = $terms_length;
                            }
                        }

                        $terms_new_length -= strlen( end( $terms )->name ) + $separator_length;
                        $terms_new_length = $crop - $terms_new_length;

                        if ( $terms_new_length > 0 ) {
                            end( $terms )->name = substr( end( $terms )->name, 0, $terms_new_length );
                        } else {
                            array_pop( $terms );
                        }
                    }
                }

                // Multiple or Singular
                if ( count( $terms ) == 1 ) {
                    $has_output = $output_singular;

                    if ( '' != $before_singular ) {
                        $before = $before_singular;
                    }
                    if ( '' != $after_singular ) {
                        $after = $after_singular;
                    }
                } else {
                    $has_output = $output_multiple;
                }

                // Output
                if ( $has_output ) {

                    if ( 'objects-array' == $return_type ) {
                        $out = $terms;
                    } else {

                        // term items array
                        $term_items = array();
                        foreach ( $terms as $term ) {

                            $term_item = '';

                            $term_item .= $item_before;

                            // term item content

                            if ( $use_link ) {

                                // with link
                                $term_item .= sprintf( '<a%s%s%s>%s%s%s</a>',
                                    '' != $link_class ? ' ' . 'class="' . $link_class . '"' : '',
                                    ' ' . 'href="' . get_term_link( $term ) . '"',
                                    '' != $link_attributes ? ' ' . $link_attributes : '',
                                    $link_before,
                                    $term->name,
                                    $link_after
                                );
                            } else {

                                // without link
                                $term_item .= $term->name;
                            }

                            $term_item .= $item_after;

                            $term_items[] = $term_item;
                        }

                        // array or list output
                        switch ( $return_type ) {

                            // array
                            case 'html-array':
                                $out = $term_items;
                                break;

                            // html
                            case 'html':

                                $out .= $before;
                                $out .= $screen_reader;
                                $out .= implode( $items_separator, $term_items );
                                $out .= $after;
                                break;
                        }
                    }
                }
            }
        }

        return apply_filters( 'weldo_get_the_terms', $out );
    }
endif;


if ( ! function_exists( 'weldo_the_terms' ) ) :
    /**
     * Echo formatted terms.
     */
    function weldo_the_terms( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_terms( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_featured_term' ) ) :
    /**
     * Retrieve featured term.
     */
    function weldo_get_featured_term( $args = array() ) {

        if ( ! array_key_exists( 'max_items', $args ) ) {
            $args['max_items'] = 1;
        }

        return weldo_get_the_terms( $args );
    }
endif;


if ( ! function_exists( 'weldo_featured_term' ) ) :
    /**
     * Echo featured term.
     */
    function weldo_featured_term( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_featured_term( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_the_categories' ) ) :
    /**
     * Retrieve formatted categories.
     */
    function weldo_get_the_categories( $args = array() ) {

        if ( ! array_key_exists( 'taxonomy', $args ) ) {
            $args['taxonomy'] = 'category';

            if ( apply_filters( 'weldo_use_auto_taxonomy_for_template_tags', true ) ) {
                $args['taxonomy'] = weldo_auto_taxonomy( array( 'type' => 'category' ) );
            }
        }

        return weldo_get_the_terms( $args );
    }
endif;


if ( ! function_exists( 'weldo_the_categories' ) ) :
    /**
     * Echo formatted categories.
     */
    function weldo_the_categories( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_categories( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_featured_category' ) ) :
    /**
     * Retrieve featured category.
     */
    function weldo_get_featured_category( $args = array() ) {

        if ( ! array_key_exists( 'max_items', $args ) ) {
            $args['max_items'] = 1;
        }

        if ( ! array_key_exists( 'featured_ids', $args ) ) {
            $args['featured_ids'] = 'featured-category';
        }

        return weldo_get_the_categories( $args );
    }
endif;


if ( ! function_exists( 'weldo_featured_category' ) ) :
    /**
     * Echo featured category.
     */
    function weldo_featured_category( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_featured_category( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_the_tags' ) ) :
    /**
     * Retrieve formatted tags.
     */
    function weldo_get_the_tags( $args = array() ) {

        if ( ! array_key_exists( 'taxonomy', $args ) ) {
            $args['taxonomy'] = 'post_tag';

            if ( apply_filters( 'weldo_use_auto_taxonomy_for_template_tags', true ) ) {
                $args['taxonomy'] = weldo_auto_taxonomy( array( 'type' => 'tag' ) );
            }
        }

        return weldo_get_the_terms( $args );
    }
endif;


if ( ! function_exists( 'weldo_the_tags' ) ) :
    /**
     * Echo formatted tags.
     */
    function weldo_the_tags( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_tags( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_featured_tag' ) ) :
    /**
     * Retrieve featured tag.
     */
    function weldo_get_featured_tag( $args = array() ) {

        if ( ! array_key_exists( 'max_items', $args ) ) {
            $args['max_items'] = 1;
        }

        if ( ! array_key_exists( 'featured_ids', $args ) ) {
            $args['featured_ids'] = 'featured-tag';
        }

        return weldo_get_the_tags( $args );
    }
endif;


if ( ! function_exists( 'weldo_featured_tag' ) ) :
    /**
     * Echo featured tag.
     */
    function weldo_featured_tag( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_featured_tag( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * Date, Time.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_object_time' ) ) :
    /**
     * Retrieve formatted object time.
     */
    function weldo_get_object_time( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */                  /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]                    = true;


        /* @var $object_type string */
        $defaults[ 'object_type' ]              = 'post';

        /* @var $comment_args array */
        $defaults[ 'comment_args' ]             = array();


        /* @var $format */
        $defaults[ 'format' ]                   = 'F d, Y \a\t H:i a';

        /* @var $time_variant string */
        $defaults[ 'time_variant' ]             = 'published';

        /* @var $return_type string */
        $defaults[ 'return_type' ]              = 'time-tag';

        /* @var $screen_reader string */
        $defaults[ 'screen_reader' ]            = '';


        /* @var $before string */
        $defaults[ 'before' ]                   = '';

        /* @var $after string */
        $defaults[ 'after' ]                    = '';


        /* @var $use_link bool */
        $defaults[ 'use_link' ]                 = true;

        /* @var $link_variant string */
        $defaults[ 'link_variant' ]             = 'day';

        /* @var $link_class string */
        $defaults[ 'link_class' ]               = '';

        /* @var $link_attributes string */
        $defaults[ 'link_attributes' ]          = '';


        /* @var $time_tag_class string */
        $defaults[ 'time_tag_class' ]           = '';

        /* @var $time_tag_attributes string */
        $defaults[ 'time_tag_attributes' ]      = '';


        /* @var $days_ago bool */
        $defaults[ 'days_ago' ]                 = false;

        /* @var $days_ago_max_days int */
        $defaults[ 'days_ago_max_days' ]        = - 1;

        /* @var $days_ago_text string */
        $defaults[ 'days_ago_text' ]            = esc_html__( 'days ago', 'weldo' );

        /* @var $today string */
        $defaults[ 'today' ]                    = esc_html__( 'Today', 'weldo' );

        /* @var $yesterday string */
        $defaults[ 'yesterday' ]                = esc_html__( 'Yesterday', 'weldo' );

        /* @var $week_ago string */
        $defaults[ 'week_ago' ]                 = esc_html__( 'Week ago', 'weldo' );

        /* @var $weeks_ago string */
        $defaults[ 'weeks_ago' ]                = esc_html__( 'weeks ago', 'weldo' );

        /* @var $month_ago string */
        $defaults[ 'month_ago' ]                = esc_html__( 'Month ago', 'weldo' );

        /* @var $months_ago string */
        $defaults[ 'months_ago' ]               = esc_html__( 'months ago', 'weldo' );

        /* @var $year_ago string */
        $defaults[ 'year_ago' ]                 = esc_html__( 'Year ago', 'weldo' );

        /* @var $years_ago string */
        $defaults[ 'years_ago' ]                = esc_html__( 'years ago', 'weldo' );


        /* @var $no_title bool */
        $defaults[ 'no_title' ]                 = false;

        /* @var $is_new_day bool */
        $defaults[ 'is_new_day' ]               = false;

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_object_time_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        // print switcher for output function(s)
        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        // Whether the publish date of the current post in the loop is different from the publish date of the previous post in the loop
        if ( $is_new_day ) {
            if ( is_new_day() ) {
                global $currentday, $previousday;
                $previousday = $currentday;
            } else {
                return $out;
            }
        }

        // if not post or comment, return
        if ( ! in_array( $object_type, array( 'post', 'comment' ) ) ) {
            return $out;
        }

        // published time by default
        if ( ! in_array( $time_variant, array( 'published', 'updated' ) ) || 'comment' == $object_type ) {
            $time_variant = 'published';
        }

        $object_id = '';
        $time      = '';
        $time_diff = '';

        // post time
        if ( 'post' == $object_type ) {

            $object_id = isset( $post_id ) ? $post_id : get_the_ID();

            // published time
            if ( 'published' == $time_variant ) {
                $time      = get_the_date( $format, $object_id );
                $time_diff = new DateTime( get_the_date( 'Y-n-d', $object_id ) . 'T' . get_the_time( 'H:i', $object_id ) );

            }

            // updated time
            if ( 'updated' == $time_variant ) {
                $time      = get_the_modified_date( $format, $object_id );
                $time_diff = new DateTime( get_the_modified_date( 'Y-n-d', $object_id ) . 'T' . get_the_modified_time( 'H:i', $object_id ) );
            }
        }

        // comment time
        if ( 'comment' == $object_type ) {

            $object_id = isset( $comment_id ) ? $comment_id : get_comment_ID();

            $time      = get_comment_date( $format, $object_id );
            $time_diff = new DateTime( get_comment_date( 'Y-n-d', $object_id ) . 'T' . get_comment_date( 'H:i', $object_id ) );
        }

        if ( '' != $time ) {

            // for 'days ago' output
            if ( '' != $time_diff && $days_ago ) {

                //calc difference
                $time_diff   = $time_diff->diff( new DateTime( 'NOW' ) );
                $time_days   = $time_diff->days;
                $time_months = $time_diff->m;
                $time_years  = $time_diff->y;

                // max days difference for using 'days ago' output
                if ( $days_ago_max_days > 0 ) {
                    $days_ago = ( $days_ago_max_days >= $time_days );
                }

                // difference output type
                if ( $days_ago ) {

                    if ( $time_years > 0 ) {

                        switch ( $time_years ) {
                            case 1:
                                $time = $year_ago;
                                break;
                            default:
                                $time = $time_years . ' ' . $years_ago;
                                break;
                        }

                    } elseif ( $time_months > 0 ) {

                        switch ( $time_months ) {
                            case 1:
                                $time = $month_ago;
                                break;
                            default:
                                $time = $time_months . ' ' . $months_ago;
                                break;
                        }

                    } else {

                        switch ( $time_days ) {
                            case 0:
                                $time = $today;
                                break;
                            case 1:
                                $time = $yesterday;
                                break;
                            case $time_days > 1 && $time_days < 7:
                                $time = $time_days . ' ' . $days_ago_text;
                                break;
                            case $time_days >= 7 && $time_days < 14:
                                $time = $week_ago;
                                break;
                            case $time_days >= 14 && $time_days < 30:
                                $time = floor( $time_days / 7 ) . ' ' . $weeks_ago;
                                break;
                            default:
                                $time = $time_days . ' ' . $days_ago_text;
                                break;
                        }
                    }
                }
            }

            $time_iso = '';

            if ( 'post' == $object_type ) {
                $time_iso = get_the_date( 'c' );
            }

            if ( 'comment' == $object_type ) {
                $time_iso = get_comment_date( 'c' );
            }

            if ( ! in_array( $return_type, array( 'time-tag', 'simple' ) ) ) {
                $return_type = 'time-tag';
            }

            // Output

            $time_string = '';

            if ( 'time-tag' == $return_type ) {

                $time_string = sprintf( '<time class="%s%s" datetime="%s"%s>%s</time>',
                    $time_variant,
                    ( '' != $time_tag_class ) ? ' ' . $time_tag_class : '',
                    $time_iso,
                    ( '' != $time_tag_attributes ) ? ' ' . $time_tag_attributes : '',
                    $time
                );
            }

            if ( 'simple' == $return_type ) {
                $time_string = $time;
            }

            $out .= $before;

            // screen reader text
            if ( '' != $screen_reader ) {
                $out .= '<span class="screen-reader-text">' . $screen_reader . '</span>';
            }

            // output for time with link
            if ( $use_link ) {

                $time_url = '';

                // url for post
                if ( 'post' == $object_type ) {

                    if ( $no_title && '' == get_the_title( $object_id ) ) {

                        // post without title case
                        $time_url = get_the_permalink( $object_id );

                    } else {

                        // post url destination

                        if ( ! in_array( $link_variant, array( 'year', 'month', 'day' ) ) ) {
                            $link_variant = 'day';
                        }

                        switch ( $link_variant ) {
                            case 'year':
                                $time_url = esc_url( get_year_link(
                                    get_the_date( 'Y', $object_id )
                                ) );
                                break;
                            case 'month':
                                $time_url = esc_url( get_month_link(
                                    get_the_date( 'Y', $object_id ),
                                    get_the_date( 'm', $object_id )
                                ) );
                                break;
                            case 'day':
                            default:
                                $time_url = esc_url( get_day_link(
                                    get_the_date( 'Y', $object_id ),
                                    get_the_date( 'm', $object_id ),
                                    get_the_date( 'd', $object_id )
                                ) );
                                break;
                        }
                    }
                }

                // url for comment
                if ( 'comment' == $object_type ) {
                    $time_url = esc_url( get_comment_link( $object_id, $comment_args ) );
                }

                // link output
                $out .= sprintf( '<a%s href="%s"%s>%s</a>',
                    ( '' != $link_class ) ? ' ' . 'class="' . $link_class . '"' : '',
                    esc_url( $time_url ),
                    ( '' != $link_attributes ) ? ' ' . $link_attributes : '',
                    $time_string
                );

                // output for time without link
            } else {
                $out .= $time_string;
            }

            $out .= $after;
        }

        return apply_filters( 'weldo_get_object_time', $out );
    }
endif;


if ( ! function_exists( 'weldo_get_the_date' ) ) :
    /**
     * Retrieve formatted post date.
     */
    function weldo_get_the_date( $args = array() ) {

        if ( ! array_key_exists( 'object_type', $args ) ) {
            $args['object_type'] = 'post';
        }

        if ( ! array_key_exists( 'format', $args ) ) {
            $args['format'] = get_option( 'date_format' );
        }

        return weldo_get_object_time( $args );
    }
endif;


if ( ! function_exists( 'weldo_the_date' ) ) :
    /**
     * Echo formatted post date.
     */
    function weldo_the_date( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_date( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_the_time' ) ) :
    /**
     * Retrieve formatted post time.
     */
    function weldo_get_the_time( $args = array() ) {

        if ( ! array_key_exists( 'object_type', $args ) ) {
            $args['object_type'] = 'post';
        }

        if ( ! array_key_exists( 'format', $args ) ) {
            $args['format'] = get_option( 'time_format' );
        }

        return weldo_get_object_time( $args );
    }
endif;


if ( ! function_exists( 'weldo_the_time' ) ) :
    /**
     * Echo formatted post time.
     */
    function weldo_the_time( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_time( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_comment_date' ) ) :
    /**
     * Retrieve formatted comment date.
     */
    function weldo_get_comment_date( $args = array() ) {

        if ( ! array_key_exists( 'object_type', $args ) ) {
            $args['object_type'] = 'comment';
        }

        if ( ! array_key_exists( 'format', $args ) ) {
            $args['format'] = get_option( 'date_format' );
        }

        return weldo_get_object_time( $args );
    }
endif;


if ( ! function_exists( 'weldo_comment_date' ) ) :
    /**
     * Echo formatted comment date.
     */
    function weldo_comment_date( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_comment_date( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


if ( ! function_exists( 'weldo_get_comment_time' ) ) :
    /**
     * Retrieve formatted comment time.
     */
    function weldo_get_comment_time( $args = array() ) {

        if ( ! array_key_exists( 'object_type', $args ) ) {
            $args['object_type'] = 'comment';
        }

        if ( ! array_key_exists( 'format', $args ) ) {
            $args['format'] = get_option( 'time_format' );
        }

        return weldo_get_object_time( $args );
    }
endif;


if ( ! function_exists( 'weldo_comment_time' ) ) :
    /**
     * Echo formatted comment time.
     */
    function weldo_comment_time( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_comment_time( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * Comments Counter.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_comments_counter' ) ) :
    /**
     * Retrieve formatted post comments counter.
     */
    function weldo_get_comments_counter( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */                  /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]                    = true;

        /* @var $post_id int|false */           /** Post ID */
        $defaults[ 'post_id' ]                  = get_the_ID();


        /* @var $output_counter bool */
        $defaults[ 'output_counter' ]           = true;

        /* @var $screen_reader string */
        $defaults[ 'screen_reader' ]            = '';


        /* @var $before string */
        $defaults[ 'before' ]                   = '';

        /* @var $after string */
        $defaults[ 'after' ]                    = '';


        /* @var $use_link bool */
        $defaults[ 'use_link' ]                 = true;

        /* @var $link_class string */
        $defaults[ 'link_class' ]               = '';

        /* @var $link_attributes string */
        $defaults[ 'link_attributes' ]          = '';


        /* @var $comment string */
        $defaults[ 'comment' ]                  = esc_html__( '', 'weldo' );

        /* @var $comments string */
        $defaults[ 'comments' ]                 = esc_html__( '', 'weldo' );

        /* @var $live_a_comment string */
        $defaults[ 'live_a_comment' ]           = esc_html__( 'Leave a comment', 'weldo' );

        /* @var $comments_are_closed string */
        $defaults[ 'comments_are_closed' ]      = esc_html__( 'Comments are closed', 'weldo' );

        /* @var $password_protected string */
        $defaults[ 'password_protected' ]       = esc_html__( 'Enter your password to view comments', 'weldo' );

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_comments_counter_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        // print switcher for output function(s)
        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        $comments_num = get_comments_number( $post_id );

        $comment_string = '';
        $comment_url    = '';

        $counter = $output_counter ? $comments_num : '';

        if ( post_password_required()  ) {
            if ( ! ( $password_protected === false ) ) {
                $comment_string = $password_protected;
            }

        } elseif ( $comments_num ) {

            if ( $comments_num == 1 ) {
                if ( ! ( $comment === false ) ) {

                    $comment_string = $counter;
                    if ( '' != $comment_string &&  '' != $comment ) { $comment_string .= ' '; }
                    $comment_string .= $comment;

                    $comment_url    = get_comments_link( $post_id );
                }
            } else {
                if ( ! ( $comments === false ) ) {

                    $comment_string = $counter;
                    if ( '' != $comment_string &&  '' != $comment ) { $comment_string .= ' '; }
                    $comment_string .= $comments;

                    $comment_url    = get_comments_link( $post_id );
                }
            }

        } elseif ( comments_open() && ! ( $live_a_comment === false )  ) {
            $comment_string = $live_a_comment;
            $comment_url    = get_comments_link( $post_id );

        } elseif ( ! ( $comments_are_closed === false )  ) {
            $comment_string = $comments_are_closed;
        }

        $screen_reader = '<span class="screen-reader-text">'
            . $screen_reader . $comment_string . '</span>';

        if ( '' != $comment_string ) {

            $out .= $before;

            $out .= $screen_reader;

            if ( $use_link && '' != $comment_url ) {

                $out .= sprintf( '<a%s href="%s"%s>%s</a>',
                    ( '' != $link_class ) ? ' ' . 'class="' . $link_class . '"' : '',
                    esc_url( $comment_url ),
                    ( '' != $link_attributes ) ? ' ' . $link_attributes : '',
                    $comment_string
                );
            } else {
                $out .= $comment_string;
            }

            $out .= $after;
        }

        return apply_filters( 'weldo_get_comments_counter', $out );
    }
endif;


if ( ! function_exists( 'weldo_comments_counter' ) ) :
    /**
     * Echo formatted post comments counter.
     */
    function weldo_comments_counter( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_comments_counter( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * Author.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_the_author' ) ) :
    /**
     * Retrieve formatted author vcard.
     */
    function weldo_get_the_author( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */              /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]                = true;


        /* @var $before string */
        $defaults[ 'before' ]               = '';

        /* @var $after string */
        $defaults[ 'after' ]                = '';


        /* @var $crop int */
        $defaults[ 'crop' ]                 = - 1;


        /* @var $use_link bool */
        $defaults[ 'use_link' ]             = true;

        /* @var $link_class string */
        $defaults[ 'link_class' ]           = '';

        /* @var $link_attributes string */
        $defaults[ 'link_attributes' ]      = '';

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_the_author_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        // print switcher for output function(s)
        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        $author = get_the_author();

        if ( $crop > - 1 ) {
            $author = substr( $author, 0, $crop );
        }

        if ( '' != $author ) {

            $out .= $before;

            if ( $use_link ) {

                $out .= sprintf( '<a%s href="%s"%s>%s</a>',
                    ( '' != $link_class ) ? ' ' . 'class="' . $link_class . '"' : '',
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    ( '' != $link_attributes ) ? ' ' . $link_attributes : '',
                    $author
                );
            } else {
                $out .= $author;
            }

            $out .= $after;
        }

        return apply_filters( 'weldo_get_the_author', $out );
    }
endif;


if ( ! function_exists( 'weldo_the_author' ) ) :
    /**
     * Echo formatted author vcard.
     */
    function weldo_the_author( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_the_author( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * Sticky Marker.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_sticky_marker' ) ) :
    /**
     * Retrieve formatted sticky marker.
     */
    function weldo_get_sticky_marker( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */            /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]            = true;


        /* @var $sticky_symbol string */
        $defaults[ 'sticky_symbol' ]    = 'fa fa-paperclip';


        /* @var $before string */
        $defaults[ 'before' ]           = '';

        /* @var $after string */
        $defaults[ 'after' ]            = '';


        /* @var $class string */
        $defaults[ 'class' ]            = 'sticky-marker';

        /* @var $attributes string */
        $defaults[ 'attributes' ]       = '';

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_sticky_marker_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        // print switcher for output function(s)
        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        if ( is_sticky() && is_home() && ! is_paged() ) {

            $out .= $before;

            $out .= sprintf( '<i%s%s></i>',
                ' ' . 'class="' . $sticky_symbol . ( '' != $class ? ' ' . $class : '' ) . '"',
                ( '' != $attributes ) ? ' ' . $attributes : ''
            );

            $out .= $after;
        }

        return apply_filters( 'weldo_get_sticky_marker', $out );
    }
endif;


if ( ! function_exists( 'weldo_sticky_marker' ) ) :
    /**
     * Echo formatted sticky marker.
     */
    function weldo_sticky_marker( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_sticky_marker( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * More Button.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_get_more_button' ) ) :
    /**
     * Retrieve formatted more_button.
     */
    function weldo_get_more_button( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */                /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]                = true;

        /* @var $post_id int|false */         /** Post ID */
        $defaults[ 'post_id' ]              = get_the_ID();


        /* @var $text string */
        $defaults[ 'text' ]                 = esc_attr__( 'Read More', 'weldo' );


        /* @var $before string */
        $defaults[ 'before' ]               = '';

        /* @var $after string */
        $defaults[ 'after' ]                = '';


        /* @var $class string */
        $defaults[ 'class' ]                = 'more-button btn btn-outline-darkgrey';

        /* @var $additional_class string */
        $defaults[ 'additional_class' ]     = '';

        /* @var $attributes string */
        $defaults[ 'attributes' ]           = '';

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_more_button_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }

        if ( '' != $additional_class ) {
            $class = implode( ' ', array( $class, $additional_class ) );
        }

        if ( array_key_exists( 'is_output', $args ) ) {
            if ( $args[ 'is_output' ] ) {
                if ( ! $print ) { return ''; }
            }
        }

        $out = '';

        $out .= $before;

        $out .= sprintf( '<a%s%s%s>%s</a>',
            '' != $class ? ' ' . 'class="' . $class . '"' : '',
            ' ' . 'href="' . esc_url( get_the_permalink( $post_id ) ) . '"',
            ( '' != $attributes ) ? ' ' . $attributes : '',
            $text
        );

        $out .= $after;

        return apply_filters( 'weldo_get_more_button', $out );
    }
endif;


if ( ! function_exists( 'weldo_more_button' ) ) :
    /**
     * Echo formatted more_button.
     */
    function weldo_more_button( $args = array() ) {

        $args[ 'is_output' ] = true;

        echo wp_kses( weldo_get_more_button( $args ), weldo_tt_kses_list( $args ) );
    }
endif;


/**
 * Post Navigation Panels.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_post_nav_panels' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     */
    function weldo_post_nav_panels( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */           /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]           = true;

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_the_terms_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }


        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '',
            true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) { return ''; }

        $has_images = false;
        $both_links = false;
        $prev_post = $next_post = '';
        $prev_image = $next_image = false;

        if ( ! is_attachment() ) {

            $prev_post = get_previous_post();

            $prev_image = get_the_post_thumbnail_url( $prev_post, 'weldo-full-width' );
            if ( ! $prev_image ) {
                $prev_image = get_the_post_thumbnail_url( $prev_post );
            }

            $next_post = get_next_post();

            $next_image = get_the_post_thumbnail_url( $next_post, 'weldo-full-width' );
            if ( ! $next_image ) {
                $next_image = get_the_post_thumbnail_url( $next_post );
            }

            $both_links = $prev_post && $next_post;
            $has_images = $prev_image && $prev_post || $next_image && $next_post;
        } ?>

        <nav class="navigation post-nav-panels<?php
        if ( $both_links ) { echo esc_attr( ' ' . 'both-links' ); }
        if ( $has_images ) { echo esc_attr( ' ' . 'has-images' ); } ?>"><?php

        if ( is_attachment() ) {
            previous_post_link( '%link',
                '<div class="meta-nav text-center">' . esc_html__( 'Published In %title', 'weldo' ) . '</div>' );
        } else {

            if ( $prev_post ) { ?>

                <div class="prev-item nav-item<?php if ( $prev_image ) { echo esc_attr( ' ' . 'has-image' ); } ?>"
                     style="background-image: url('<?php echo esc_url( $prev_image ); ?>')"><?php
                previous_post_link( '%link',
                    '<span class="nav-item-label">' . esc_html__( 'Prev', 'weldo' ) . '</span>' .
                    '<span class="nav-item-title">%title</span>' ); ?>
                </div><?php
            }

            if ( $next_post ) { ?>

                <div class="next-item nav-item<?php if ( $next_image ) { echo esc_attr( ' ' . 'has-image' ); } ?>"
                     style="background-image: url('<?php echo esc_url( $next_image ); ?>')"><?php
                next_post_link( '%link',
                    '<span class="nav-item-label">' . esc_html__( 'Next', 'weldo' ) . '</span>' .
                    '<span class="nav-item-title">%title</span>' ); ?>
                </div><?php
            }
        } ?>

        </nav><?php
    }
endif;


/**
 * Page Links.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_page_links' ) ) :
    /**
     * Echo page links.
     */
    function weldo_page_links( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */                    /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]                    = true;


        /* @var $class string */
        $defaults[ 'class' ]                    = '';

        /* @var $class_default string */
        $defaults[ 'class_default' ]            = 'page-links';

        /* @var $title string */
        $defaults[ 'title' ]                    = esc_html__( 'Pages:', 'weldo' );

        /* @var $title_class string */
        $defaults[ 'title_class' ]              = '';

        /* @var $title_class_default string */
        $defaults[ 'title_class_default' ]      = 'page-links-title';

        /* @var $link_before string */
        $defaults[ 'link_before' ]              = '<span>';

        /* @var $link_after string */
        $defaults[ 'link_after' ]               = '</span>';

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_the_terms_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }


        $class = '' == $class ? $class_default : $class_default . ' ' . $class;
        $title_class = '' == $title_class ? $title_class_default : $title_class_default . ' ' . $title_class;

        // print switcher for output function(s)
        if ( ! $print ) { return ''; }

        wp_link_pages( array(
            'before'      => '<div class="' . esc_attr( $class ) . '">'
                . '<span class="' . esc_attr( $title_class ) . '">'
                . esc_html( $title ) . '</span>',
            'after'       => '</div>',
            'link_before' => wp_kses_post( $link_before ),
            'link_after'  => wp_kses_post( $link_after ),
        ) );
    }
endif;


/**
 * Related Posts.
 * --------------------------------------------------------------------------------------------------------------------
 */


if ( ! function_exists( 'weldo_related_posts' ) ) :
    /**
     * Display related posts.
     */
    // ( ! Experimental. Will be totally refactored )
    function weldo_related_posts( $args = array() ) {

        $defaults = array();


        // ARGUMENTS LIST:

        /* @var $print bool */                /** 'to print' switcher for output function(s) */
        // To output or not.
        $defaults[ 'print' ]                = true;


        /* @var $section_title string */
        $defaults[ 'section_title' ]        = esc_html__( 'Related Posts', 'weldo' );

        /* @var $posts_number int */
        $defaults[ 'posts_number' ]         = 4;

        /* @var $shuffle bool */
        $defaults[ 'shuffle' ]              = false;

        /* @var $use_carousel bool */
        $defaults[ 'use_carousel' ]         = true;

        // end of ARGUMENTS LIST


        // Replace defaults globally
        $defaults = array_merge( $defaults, apply_filters( 'weldo_get_the_terms_defaults', array() ) );

        // Replace defaults locally and init variables
        foreach ( $defaults as $key => $value ) { ${$key} = array_key_exists( $key, $args ) ? $args[ $key ] : $value; }


        // print switcher for output function(s)
        if ( ! $print ) { return ''; }

        if ( weldo_get_option( 'blog_post_show_related', true ) ) {

            global $post;
            $orig_post = $post;
            $related_source = weldo_get_option( 'blog_post_related_source', 'tag' );
            $terms = array();
            $in = 'tag__in';

            if ( 'tag' == $related_source ) {
                $terms      = wp_get_post_tags( $post->ID );

            } elseif ( 'category' == $related_source ) {
                $terms = wp_get_post_categories( $post->ID, array( 'fields' => 'all' ) );
                $in = 'category__in';
            }

            if ( $terms ) {

                $term_ids = array();
                foreach ( $terms as $individual_term ) {
                    $term_ids[] = $individual_term->term_id;
                }

                $args = array(
                    $in                    => $term_ids,
                    'post__not_in'         => array( $post->ID ),
                    'posts_per_page'       => $posts_number,
                    'ignore_sticky_posts ' => true,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array(
                                'post-format-aside',
                                'post-format-gallery',
                                'post-format-link',
                                'post-format-quote',
                                'post-format-status', ),
                            'operator' => 'NOT IN'
                        )
                    )
                );

                if ( $shuffle ) {
                    $args += array(
                        'orderby'=> 'rand',
                    );
                }

                $my_query = new wp_query( $args );

                if ( ! empty( $my_query->posts ) ) { ?>

                    <?php
                    $sidebar_columns = weldo_get_columns_classes();
                    $hasSidebar  = 'full' != $sidebar_columns[ 'position' ];
                    $columns_lg = 2;
                    $columns_md = 1;
                    $columns_sm = 1;
                    if ( ! $hasSidebar ) {
                        $columns_lg = 3;
                        $columns_md = 2;
                        $columns_sm = 2;
                    }
                    $main_class[] = 'related-posts';
                    $main_class[] = $use_carousel ? 'use-carousel' : 'no-carousel';
                    $columns_class = 'related-posts-columns';
                    ?>

                <div class="<?php echo esc_attr( implode( ' ', $main_class ) ); ?>">

                    <h4 class="related-posts-title"><?php echo esc_html( $section_title ); ?> </h4>

                    <?php if ( $use_carousel ) : ?>
                    <div class="<?php echo esc_attr( $columns_class ); ?> owl-carousel"
                         data-responsive-lg="<?php echo esc_attr( $columns_lg ); ?>"
                         data-responsive-md="<?php echo esc_attr( $columns_md ); ?>"
                         data-responsive-sm="<?php echo esc_attr( $columns_sm ); ?>"
                         data-responsive-xs="1"
                         data-nav="true"
                         data-loop="true"
                         data-margin="30"
                         data-autoplay="false">
                        <?php else: ?>
                        <div class="<?php echo esc_attr( $columns_class ); ?> columns-<?php echo esc_attr( $columns_lg ); ?>"><?php
                            endif; //use_carousel
                            while ( $my_query->have_posts() ) {
                                $my_query->the_post(); ?>
                                <div class="related-post"><?php
                                get_template_part( 'template-parts/content-related', get_post_format() ); ?>
                                </div><?php
                            } ?>
                        </div> <!-- <?php echo esc_attr( $columns_class ); ?>  -->
                    </div><!-- .related-posts --> <?php
                }
            }

            $post = $orig_post;
            wp_reset_postdata();
        }
    }
endif;