<?php

define('MWT_WIDGETS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );


if (!function_exists( 'mwt_widgets_dirname_to_classname' ) ) {
	function mwt_widgets_dirname_to_classname( $dirname ) {
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}
}

add_action( 'widgets_init', 'mwt_action_widgets_init' );
if (!function_exists( 'mwt_action_widgets_init' ) ) {
	function mwt_action_widgets_init() {
		$dirs = array(
			'banner',
			'bloginfo',
			'author-bio',
			'icons-list',
			'facebook-page-stream',
			'flickr',
			'portfolio',
			'post-tabs',
			'posts',
			'recent',
			'theme-posts',
			'twitter',
		);


		foreach ( $dirs as $dir ) {

			$dirname = $dir;

			if ( isset( $included_widgets[ $dirname ] ) ) {
				// this happens when a widget in child theme wants to overwrite the widget from parent theme
				continue;
			} else {
				$included_widgets[ $dirname ] = true;
			}


			//checking that file exists in provided dirs
			$full_path_to_widget_class = MWT_WIDGETS_PLUGIN_PATH . '/widgets/'. $dirname . '/class-widget-' . $dirname . '.php';
			if ( file_exists( $full_path_to_widget_class ) ) {
				require_once $full_path_to_widget_class;

				$widget_class = 'MWT_Widget_' . mwt_widgets_dirname_to_classname( $dirname );
				if ( class_exists( $widget_class ) ) {
					register_widget( $widget_class );
				}
			}
		}
	}
}


//widgets template tags

if ( ! function_exists( 'mwt_posted_on' ) ) : /**
 * Print HTML with meta information for the current post-date/time and author.
 */
	function mwt_posted_on( $short = false, $only_date = false ) {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post"><i class="fa fa-thumb-tack" aria-hidden="true"></i>' . esc_html__( ' Sticky ', 'mwt' ) . '</span>';
		}
		if ( ! $short ) {

			// Set up and print post meta information.
			printf( '<span class="links-grey">%1$s<span class="author vcard"><a class="url fn n" href="%2$s" rel="author">%3$s</a></span> %4$s<span class="entry-date"><a href="%5$s" rel="bookmark"><time class="entry-date" datetime="%6$s">%7$s</time></a></span></span>',
				esc_html_x( 'By ', 'Used before post author name.', 'mwt' ),
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
			printf( '<span class="links-grey entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span>',
				esc_url( get_permalink() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		}
	}

endif; //mwt_posted_on

//admin dashboard styles and scripts
if ( ! function_exists( 'mwt_action_widgets_load_custom_wp_admin_style' ) ) :
	function mwt_action_widgets_load_custom_wp_admin_style() {
		if ( defined( 'FW' ) ) {
			$prefix = stristr(__FILE__, 'only_' ) ? WELDO_THEME_URI . '/ONLY_FOR_BITBUCKET/mwt-addons/' : plugin_dir_url(__FILE__) ;
			wp_enqueue_script(
				'mwt-dashboard-widget-script',
				$prefix . 'js/dashboard-widget-script.js',
				array( 'jquery' ),
				'1.0.0',
				false
			);
		}
	} //mwt_action_widgets_load_custom_wp_admin_style()
endif;
add_action( 'admin_enqueue_scripts', 'mwt_action_widgets_load_custom_wp_admin_style' );
