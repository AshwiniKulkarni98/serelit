<?php

if ( ! function_exists( '_filter_mwt_unyson_additional_extensions' ) ) :
	/**
	 * @internal
	 */
	function _filter_mwt_unyson_additional_extensions($locations) {
		$locations[ dirname(__FILE__) . '/extensions' ]
			=
			plugin_dir_url( __FILE__ ) . 'extensions';

		return $locations;
	}
endif; //_filter_mwt_unyson_additional_extensions
add_filter('fw_extensions_locations', '_filter_mwt_unyson_additional_extensions');

/*
 * Helpers for all mwt Unyson extensions that ships with this plugin
 *
*/

if ( ! function_exists( 'fw_ext_extension_get_listing_categories' ) ) :
	/**
	 * @param int|array $term_ids
	 *
	 * @return array|WP_Error
	 */
	function fw_ext_extension_get_listing_categories( $term_ids, $extension_name ) {

		$args = array(
			'hide_empty'    => false
		);

		if ( ! empty( $term_ids ) ) {
			if ( is_numeric( $term_ids ) ) {
				$args['parent'] = $term_ids;
			} elseif ( is_array( $term_ids ) ) {
				$args['include'] = $term_ids;
			}
		}

		$ext_extension_settings = fw()->extensions->get( $extension_name )->get_settings();
		$taxonomy               = $ext_extension_settings['taxonomy_name'];

		$categories = get_terms( $taxonomy, $args );

		if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {

			foreach ( $categories as $key => $category ) {
				$children                     = get_term_children( $category->term_id, $taxonomy );
				$categories[ $key ]->children = $children;

				//remove empty categories
				if ( ( $category->count == 0 ) && ( is_wp_error( $children ) || empty( $children ) ) ) {
					unset( $categories[ $key ] );
				}
			}

			return $categories;
		}

		return array();
	}

endif; //fw_ext_extension_get_listing_categories

if ( ! function_exists( 'fw_ext_extension_get_sort_classes' ) ) :

	/**
	 * @param WP_Post[] $items
	 * @param array $categories
	 * @param string $prefix
	 *
	 * @return array
	 */
	function fw_ext_extension_get_sort_classes( array $items, array $categories, $prefix = '', $extension_name ) {

		$ext_extension_settings = fw()->extensions->get( $extension_name )->get_settings();
		$taxonomy = $ext_extension_settings['taxonomy_name'];
		$classes            = array();
		$categories_classes = array();
		foreach ( $items as $key => $item ) {
			$class_name = '';
			$terms      = wp_get_post_terms( $item->ID, $taxonomy );

			if ( ( ! empty( $terms ) ) && ! empty ( $categories ) ) {
				foreach ( $terms as $term ) {
					foreach ( $categories as $category ) {
						if ( $term->term_id == $category->term_id ) {
							$class_name .= $prefix . $category->slug . ' ';
							$categories_classes[ $term->term_id ] = true;
						} else {
							if ( in_array( $term->term_id, $category->children, true ) ) {
								$class_name .= $prefix . $category->slug . ' ';
								$categories_classes[ $term->term_id ] = true;
							}
						}
						$classes[ $item->ID ] = $class_name;
					}
				}
				//if no terms
			} else {
				$classes[ $item->ID ] = '';
			}
		}
		return $classes;
	}
endif; //fw_ext_extension_get_sort_classes

if ( ! function_exists( 'fw_ext_extension_get_columns_classes' ) ) :
	function fw_ext_extension_get_columns_classes( $full_width = false ) {

		//additional classes to columns
		$main_column_class = ' column-main';
		$sidebar_class = ' column-sidebar';

		//default values
		$column_classes = array(
			'main_column_class' => 'col-12 col-xs-12 col-md-7 col-xl-8' . $main_column_class,
			'sidebar_class'     => 'col-12 col-xs-12 col-md-5 col-xl-4' . $sidebar_class,
			'position'          => 'right'
		);
		if ( is_page() ) {
			$column_classes['main_column_class'] = "col-12"  . $main_column_class;
			$column_classes['sidebar_class']     = false;
			$column_classes['position']          = 'full';

			//if no Unyson installed - return - no sidebar on pages by default
			if ( ! function_exists( 'fw_ext_sidebars_show' ) ) {
				return $column_classes;
			}
		}

		//check for unyson
		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {

			//full width
			if ( in_array( fw_ext_sidebars_get_current_position(), array( 'full' ) ) ) {

				$column_classes['main_column_class'] = "col-12"  . $main_column_class;
				$column_classes['sidebar_class']     = false;
				$column_classes['position']          = 'full';
				//making 10 columns width on single post if no sidebar
				if ( is_single() ) {
					$column_classes['main_column_class'] = "col-12 col-xs-12 col-xl-10 offset-xl-1" . $main_column_class;
					$column_classes['sidebar_class']     = false;
					$column_classes['position']          = 'full';
				}

				//left sidebar
			} elseif ( in_array( fw_ext_sidebars_get_current_position(), array( 'left' ) ) ) {

				$column_classes['main_column_class'] = "col-12 col-xs-12 col-lg-7 col-xl-8 order-lg-2" . $main_column_class;
				$column_classes['sidebar_class']     = "col-12 col-xs-12 col-lg-5 col-xl-4 order-lg-1" . $sidebar_class;
				$column_classes['position']          = 'left';

			} elseif ( in_array( fw_ext_sidebars_get_current_position(), array( 'right' ) ) ) {

				$column_classes['main_column_class'] = "col-12 col-xs-12 col-lg-7 col-xl-8" . $main_column_class;
				$column_classes['sidebar_class']     = "col-12 col-xs-12 col-lg-5 col-xl-4" . $sidebar_class;
				$column_classes['position']          = 'right';

			}
			//no catching right sidebar. Right sidebar is default
			else {
				//default - right sid
				//ebar
				$column_classes['main_column_class'] = "col-12 col-xs-12 col-lg-7 col-xl-8" . $main_column_class;
				$column_classes['sidebar_class']     = "col-12 col-xs-12 col-lg-5 col-xl-4" . $sidebar_class;
				$column_classes['position']          = 'right';

				//default for page is fullwidth - do we need this?
				if ( is_page() ) {
					$column_classes['main_column_class'] = "col-12" . $main_column_class;
					$column_classes['sidebar_class']     = false;
					$column_classes['position']          = 'full';
				}

			}
		}

		if ( $full_width ) {
			$column_classes['main_column_class'] = "col-12" . $main_column_class;
			$column_classes['sidebar_class']     = false;
			$column_classes['position']          = 'full';
		}

		return $column_classes;
	}

endif; //fw_ext_extension_get_columns_classes

if ( ! function_exists( 'mwt_posted_on' ) ) : /**
 * Print HTML with meta information for the current post-date/time and author.
 */
	function mwt_posted_on( $short = false, $only_date = false ) {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post"><i class="fa fa-thumb-tack"></i>' . esc_html__( ' Sticky ', 'mwt' ) . '</span>';
		}
		if ( ! $short ) {

			// Set up and print post meta information.
			printf( '<span class="links-darkgrey">%1$s<span class="author vcard"><a class="url fn n" href="%2$s" rel="author">%3$s</a></span> %4$s<span class="entry-date"><a href="%5$s" rel="bookmark"><time class="entry-date" datetime="%6$s">%7$s</time></a></span></span>',
				esc_html_x( '', 'Used before post author name.', 'mwt' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author(),
				esc_html_x( 'on ', 'Used before post date.', 'mwt' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		}
		if ( $only_date ) {

			// Set up and print post meta information.
			printf( '<span class="links-darkgrey entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span>',
				esc_url( get_permalink() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		}
	}

endif; //mwt_posted_on
