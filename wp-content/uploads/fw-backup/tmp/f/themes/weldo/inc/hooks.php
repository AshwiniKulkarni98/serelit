<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Filters and Actions
 */

if ( ! function_exists( 'weldo_action_setup' ) ) :
	/**
	 * Theme setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 * @internal
	 */
	function weldo_action_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'weldo', WELDO_THEME_PATH . '/languages' );

		add_editor_style( array( 'css/main.css' ) );

		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );

		//Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		set_post_thumbnail_size( 830, 400, true );
		add_image_size( 'weldo-full-width', 1170, 780, true );
		add_image_size( 'weldo-square', 1000, 1000, true );
		add_image_size( 'weldo-service-width', 601, 716, true );
		add_image_size( 'weldo-blog-width', 860, 505, true );

		//content width
		$GLOBALS['content_width'] = apply_filters( 'weldo_filter_content_width', 891 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
            'style'
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'standard',
			'aside',
			'chat',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
		) );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );
	} //weldo_action_setup()

endif;
add_action( 'after_setup_theme', 'weldo_action_setup' );


/**
 * Register widget areas.
 * @internal
 */

if ( !function_exists( 'weldo_action_widgets_init' ) ) :
	function weldo_action_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Main Widget Area', 'weldo' ),
			'id'            => 'sidebar-main',
			'description'   => esc_html__( 'Appears in the content section of the site.', 'weldo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		$blog_posts_widget_option = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog_posts_widget_switch' ) : '';
		if ( $blog_posts_widget_option ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Before Posts Widget Area', 'weldo' ),
				'id'            => 'sidebar-before-posts',
				'description'   => esc_html__( 'Appears before blog feed on blog page', 'weldo' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		//footer widget areas
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area #1', 'weldo' ),
			'id'            => 'sidebar-footer-1',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'weldo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area #2', 'weldo' ),
			'id'            => 'sidebar-footer-2',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'weldo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area #3', 'weldo' ),
			'id'            => 'sidebar-footer-3',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'weldo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area #4', 'weldo' ),
			'id'            => 'sidebar-footer-4',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'weldo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Header Widget Area', 'weldo' ),
			'id'            => 'sidebar-top-header',
			'description'   => esc_html__( 'Appears in the header section of the site.', 'weldo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	} //weldo_action_widgets_init()
endif;
add_action( 'widgets_init', 'weldo_action_widgets_init' );


/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 * @internal
 */
if ( !function_exists( 'weldo_filter_body_classes' ) ) :
	function weldo_filter_body_classes( $classes ) {
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( get_header_image() ) {
			$classes[] = 'header-image';
		} else {
			$classes[] = 'masthead-fixed';
		}

		if ( is_archive() || is_search() || is_home() ) {
			$classes[] = 'archive-list-view';
		}

		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {
			$current_position = fw_ext_sidebars_get_current_position();
			if ( in_array( $current_position, array( 'full', 'left' ) )
			     || empty( $current_position )
			     || is_page_template( 'page-templates/full-width.php' )
			     || is_attachment()
			) {
				$classes[] = 'full-width';
			}
		} else {
			$classes[] = 'full-width';
		}

		if ( is_active_sidebar( 'sidebar-footer' ) ) {
			$classes[] = 'footer-widgets';
		}

		if ( is_singular() && ! is_front_page() ) {
			$classes[] = 'singular';
		}

		if ( is_front_page()
		     && 'slider' == get_theme_mod( 'featured_content_layout' )
		) {
			$classes[] = 'slider';
		} elseif ( is_front_page() ) {
			$classes[] = 'grid';
		}

		$options = weldo_get_options();

		if ( ! empty( $options['header_show_all_menu_items'] ) ) {
			$classes[] = 'header_show_all_menu_items';
		}

		if ( ! empty( $options['header_disable_affix_xl'] ) ) {
			$classes[] = 'header_disable_affix_xl';
		}

		if ( ! empty( $options['header_disable_affix_xs'] ) ) {
			$classes[] = 'header_disable_affix_xs';
		};

		return $classes;
	} //weldo_filter_body_classes()
endif;
add_filter( 'body_class', 'weldo_filter_body_classes' );

if( ! function_exists( 'weldo_pingback_header') ) :
	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function weldo_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
endif;
add_action( 'wp_head', 'weldo_pingback_header' );

//changing default comment form
if ( ! function_exists( 'weldo_filter_weldo_contact_form_fields' ) ) :
	function weldo_filter_weldo_contact_form_fields( $fields ) {
		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$req           = get_option( 'require_name_email' );
		$aria_req      = ( $req ? " aria-required='true'" : '' );
		$html_req      = ( $req ? " required='required'" : '' );
		$html5         = 'html5';
		$fields        = array(
			'author'        => '<div class="col-sm-6"><p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'weldo' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' placeholder="' . esc_attr__( 'Full Name', 'weldo' ) . '"></p></div>',
			'email'         => '<div class="col-sm-6"><p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'weldo' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . $html_req . ' placeholder="' . esc_attr__( 'Email Address', 'weldo' ) . '"/></p></div>',
			'comment_field' => '<div class="col-12 col-sm-12"><p class="comment-form-comment"><label for="comment">' . esc_html_x( 'Comment', 'noun', 'weldo' ) . '</label> <textarea id="comment"  class="form-control" name="comment" cols="45" rows="8"  aria-required="true" required="required"  placeholder="' . esc_attr__( 'Comment', 'weldo' ) . '"></textarea></p></div>',
		);

		return $fields;
	} //weldo_filter_weldo_contact_form_fields()

endif;


//changing gallery thumbnail size for entry-thumbnail display
if ( ! function_exists( 'weldo_filter_fw_shortcode_atts_gallery' ) ) :
	function weldo_filter_fw_shortcode_atts_gallery( $out, $pairs, $atts ) {
		$out['size'] = 'post-thumbnail';
		$options = weldo_get_options();
		if ( $options['blog_layout'] === 'grid' || $options['blog_layout'] === '4' ) {
			$out['size'] = 'weldo-square';
		}
		return $out;
	} //weldo_filter_fw_shortcode_atts_gallery()
endif;

if ( ! function_exists( 'weldo_shortcode_atts_gallery_trigger' ) ) :
	function weldo_shortcode_atts_gallery_trigger( $add_filter = true ) {
		if ( $add_filter ) {
			add_filter( 'shortcode_atts_gallery', 'weldo_filter_fw_shortcode_atts_gallery', 10, 3 );
		} else {
			false;
		}
	} //weldo_shortcode_atts_gallery_trigger()
endif;

//changing events slug
if ( ! function_exists( 'weldo_filter_fw_ext_events_post_slug' ) ) :
	function weldo_filter_fw_ext_events_post_slug( $slug ) {
		// 'fw-event-slug' change to 'events'
		return 'events';
	} //weldo_filter_fw_ext_events_post_slug()
endif;
add_filter( 'fw_ext_events_post_slug', 'weldo_filter_fw_ext_events_post_slug' );

if ( ! function_exists( 'weldo_filter_fw_ext_events_taxonomy_slug' ) ) :
	function weldo_filter_fw_ext_events_taxonomy_slug( $slug ) {
        // 'fw-event-taxonomy-slug' change to 'event-category'
		return 'event-category';
	} //weldo_filter_fw_ext_events_taxonomy_slug()
endif;
add_filter( 'fw_ext_events_taxonomy_slug', 'weldo_filter_fw_ext_events_taxonomy_slug' );

//wrapping in a span categories and archives items count
if ( !function_exists('weldo_filter_add_span_to_arhcive_widget_count') ) :
	function weldo_filter_add_span_to_arhcive_widget_count( $links ) {
		//for categories widget
		$links = str_replace( '</a> (', '</a> <span class="color-main">(', $links );
		//for archive widget
		$links = str_replace( '&nbsp;(', ' <span class="color-main">(', $links );
		$links = preg_replace( '/([0-9]+)\)/', '$1)</span>', $links );

		return $links;
	} //weldo_filter_add_span_to_arhcive_widget_count()
endif;

//categories
add_filter( 'wp_list_categories', 'weldo_filter_add_span_to_arhcive_widget_count' );
//arhcive
add_filter( 'get_archives_link', 'weldo_filter_add_span_to_arhcive_widget_count' );

//filter calendar widget to fix validation errors
if ( !function_exists('weldo_filter_widget_calendar_html') ) :
	function weldo_filter_widget_calendar_html( $html ) {
		//get tfoot
		$tfoot = preg_match('/<tfoot>(.|\n)*<\/tfoot>/', $html, $match);
		//remove tfoot from table
		$html = preg_replace('/<tfoot>(.|\n)*<\/tfoot>/', '', $html);
		//attach tfoot after tbody
		if( ! empty( $match[0] ) ) {
			$html = str_replace( '</tbody>', "</tbody>\n\t" . $match[0], $html );
		}

		return $html;
	}
endif;//weldo_filter_widget_calendar_html()

add_filter( 'get_calendar', 'weldo_filter_widget_calendar_html' );


if ( !function_exists( 'weldo_filter_monster_widget_text' ) ) :
	function weldo_filter_monster_widget_text( $text ) {
		$text = str_replace( 'name="monster-widget-just-testing"', 'name="monster-widget-just-testing" class="form-control"', $text );

		return $text;
	}
endif;
add_filter( 'monster-widget-get-text', 'weldo_filter_monster_widget_text' );


/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 *
 * @return array The filtered post class list.
 * @internal
 */
if ( !function_exists( 'weldo_filter_post_classes' ) ) :
	function weldo_filter_post_classes( $classes ) {
		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}
		return $classes;
	} //weldo_filter_post_classes()
endif;
add_filter( 'post_class', 'weldo_filter_post_classes' );


/**
 * Wrap first word followed by colon with span.
 *
 *
 * @param string $string content
 *
 * @return string new content.
 * @internal
 */
if ( !function_exists( 'weldo_filter_the_content_chat_first_word' ) ) :
	function weldo_filter_the_content_chat_first_word( $content ) {
		if ( 'chat' === get_post_format() ) :
			$content = preg_replace('/(<p>.*:)/', '<p><strong>$1</strong>', $content);
			$content = str_replace('<p><strong><p>', '<p><strong>', $content);
		endif;
		return $content;
	} //weldo_filter_the_content_chat_first_word()
endif;
add_filter( 'the_content', 'weldo_filter_the_content_chat_first_word' );


/**
 * Add bootstrap CSS classes to default password protected form.
 *
 *
 * @return string HTML code of password form
 * @internal
 */
if ( !function_exists( 'weldo_filter_password_form' ) ) :
	function weldo_filter_password_form( $html ) {
		$label = esc_html__( 'Password', 'weldo' );
		$html  = str_replace( 'input name="post_password"', 'input class="form-control" name="post_password" placeholder="'  . esc_attr( $label ) . '"', $html );
		$html  = str_replace( 'input type="submit"', 'input class="btn btn-dark btn-big" type="submit"', $html );

		return $html;
	} //weldo_filter_password_form()
endif;
add_filter( 'the_password_form', 'weldo_filter_password_form' );


/**
 * Add bootstrap CSS class to readmore blog feed anchor.
 *
 *
 * @return string HTML code of password form
 * @internal
 */
if ( !function_exists( 'weldo_filter_gallery_post_style_owl') ) :
	function weldo_filter_gallery_post_style_owl( $gallery_html ) {
		if ( $gallery_html && ! is_admin() ) {
			$gallery_html = str_replace( 'gallery ', 'gallery ', $gallery_html );
		}

		return $gallery_html;
	} //weldo_filter_gallery_post_style_owl()
endif;
add_filter( 'gallery_style', 'weldo_filter_gallery_post_style_owl' );

/**
 * Flush out the transients used in weldo_categorized_blog.
 * @internal
 */
if ( !function_exists( 'weldo_action_category_transient_flusher' ) ) :
	function weldo_action_category_transient_flusher() {
		delete_transient( 'weldo_category_count' );
	} //weldo_action_category_transient_flusher()
endif;
add_action( 'edit_category', 'weldo_action_category_transient_flusher' );
add_action( 'save_post', 'weldo_action_category_transient_flusher' );



/**
 * Processing google fonts customizer options
 */

if ( ! function_exists( 'weldo_action_process_google_fonts' ) ) :
	function weldo_action_process_google_fonts() {
		$google_fonts        = fw_get_google_fonts();
		$include_from_google = array();

		$font_body     = fw_get_db_customizer_option( 'main_font' );
		$font_headings = fw_get_db_customizer_option( 'h_font' );

		// if is google font
		if ( isset( $google_fonts[ $font_body['family'] ] ) ) {
			$include_from_google[ $font_body['family'] ] = $google_fonts[ $font_body['family'] ];
		}

		if ( isset( $google_fonts[ $font_headings['family'] ] ) ) {
			$include_from_google[ $font_headings['family'] ] = $google_fonts[ $font_headings['family'] ];
		}

		$google_fonts_links = weldo_get_remote_fonts( $include_from_google );
		// set a option in db for save google fonts link
		update_option( 'weldo_google_fonts_link', $google_fonts_links );
	} //weldo_action_process_google_fonts()

endif;
add_action( 'customize_save_after', 'weldo_action_process_google_fonts', 999, 2 );

if ( ! function_exists( 'weldo_get_remote_fonts' ) ) :
	function weldo_get_remote_fonts( $include_from_google ) {
		/**
		 * Get remote fonts
		 *
		 * @param array $include_from_google
		 */
		if ( ! sizeof( $include_from_google ) ) {
			return '';
		}

		$html = "<link href='//fonts.googleapis.com/css?family=";

		foreach ( $include_from_google as $font => $styles ) {
			$html .= str_replace( ' ', '+', $font ) . ':' . implode( ',', $styles['variants'] ) . '|';
		}

		$html = substr( $html, 0, - 1 );
		$html .= "' rel='stylesheet' type='text/css'>";

		return $html;
	} //weldo_get_remote_fonts()
endif;

if ( ! function_exists( 'weldo_action_add_login_page_script_and_styles' ) ) :
	function weldo_action_add_login_page_script_and_styles( $page ) {
		wp_enqueue_style(
			'weldo-login-page-style',
			WELDO_THEME_URI . '/css/login-page.css',
			array(),
			WELDO_THEME_VERSION
		);
		wp_enqueue_script(
			'weldo-login-page-script',
			WELDO_THEME_URI . '/js/login-page.js',
			array( 'jquery' ),
			WELDO_THEME_VERSION,
			false
		);
	}
endif;
add_action( 'login_enqueue_scripts', 'weldo_action_add_login_page_script_and_styles' );


//admin dashboard styles and scripts
if ( ! function_exists( 'weldo_action_load_custom_wp_admin_style' ) ) :
	function weldo_action_load_custom_wp_admin_style() {
		wp_register_style( 'weldo-custom-wp-admin-css', WELDO_THEME_URI . '/css/admin-style.css', false, WELDO_THEME_VERSION );
		wp_enqueue_style( 'weldo-custom-wp-admin-css' );

		$screen = get_current_screen();

		if( 'nav-menus' === $screen->base ) {
			wp_register_style( 'weldo-custom-wp-admin-icon-fonts-for-menu-flaticon', WELDO_THEME_URI . '/css/flaticon.css', false, WELDO_THEME_VERSION );
			wp_enqueue_style( 'weldo-custom-wp-admin-icon-fonts-for-menu-flaticon' );
			wp_register_style( 'weldo-custom-wp-admin-icon-fonts-for-menu-icomoon', WELDO_THEME_URI . '/css/icomoon.css', false, WELDO_THEME_VERSION );
			wp_enqueue_style( 'weldo-custom-wp-admin-icon-fonts-for-menu-icomoon' );
		}

	} //weldo_action_load_custom_wp_admin_style()
endif;
add_action( 'admin_enqueue_scripts', 'weldo_action_load_custom_wp_admin_style' );


// removing woo styles
// Remove each style one by one
if ( !function_exists('weldo_filter_weldo_dequeue_styles')) :
	function weldo_filter_weldo_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] );        // Remove the layout
		unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
		return $enqueue_styles;
	} //weldo_filter_weldo_dequeue_styles()
endif;
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

//this action defined in functions.php
add_action( 'tgmpa_register', 'weldo_action_register_required_plugins' );

if ( !function_exists('weldo_filter_wrap_cat_title_before_colon_in_span')) :
	function weldo_filter_wrap_cat_title_before_colon_in_span($title) {
		return preg_replace('/^.*: /', '<span class="taxonomy-name-title">${0}</span>', $title );
	}
endif;
add_filter('get_the_archive_title', 'weldo_filter_wrap_cat_title_before_colon_in_span');


//if Unyson installed - managing main slider and contact form scripts, sidebars, breadcrumbs
if ( defined( 'FW' ) ):
	//display main slider
	if ( ! function_exists( 'weldo_action_slider' ) ):

		function weldo_action_slider() {
			if(is_search()) {
				return;
			}
			$slider_id = fw_get_db_post_option( get_the_ID(), 'slider_id', false );
			if ( fw_ext( 'slider' ) ) {
				echo fw()->extensions->get( 'slider' )->render_slider( $slider_id, false );
			}

		}

		add_action( 'weldo_slider', 'weldo_action_slider' );

	endif;


	//display blog slider
	if ( ! function_exists( 'weldo_action_blog_slider' ) ):

		function weldo_action_blog_slider() {

			$blog_slider_options = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog_slider_switch' ) : '';
			$blog_slider_enabled = $blog_slider_options['yes'];
			if( $blog_slider_enabled ) {
				$slider_id= $blog_slider_enabled['slider_id'];
				if ( fw_ext( 'slider' ) ) {
					$slider_html = fw()->extensions->get( 'slider' )->render_slider( $slider_id, false );
					if( !empty( $slider_html ) ) {
					?>
					<div class="blog-slider col-sm-12">
					<?php
						echo wp_kses_post( $slider_html );
					?>
					</div>
					<?php
					}
				}
			}
		}

		add_action( 'weldo_blog_slider', 'weldo_action_blog_slider' );
	endif;

	//display blog posts widget
	if ( ! function_exists( 'weldo_blog_posts_widget' ) ) :

		function weldo_blog_posts_widget() {

			$blog_posts_widget_option = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'blog_posts_widget_switch' ) : '';
			if( $blog_posts_widget_option ) {
				if (  is_active_sidebar( 'sidebar-before-posts' ) ) {
			?>
				<div class="blog-posts-widget col-sm-12">
					<?php dynamic_sidebar( 'sidebar-before-posts' ); ?>
				</div>
			<?php
				}
			}
		}
		add_action( 'weldo_posts_widget', 'weldo_blog_posts_widget' );

	endif;

	/**
	 * Display current submitted FW_Form errors
	 * @return array
	 */
	if ( ! function_exists( 'weldo_action_display_form_errors' ) ):
		function weldo_action_display_form_errors() {
			$form = FW_Form::get_submitted();

			if ( ! $form || $form->is_valid() ) {
				return;
			}

			wp_enqueue_script(
				'weldo-show-form-errors',
				WELDO_THEME_URI . '/js/form-errors.js',
				array( 'jquery' ),
				WELDO_THEME_VERSION,
				true
			);

			wp_localize_script( 'weldo-show-form-errors', '_localized_form_errors', array(
				'errors'  => $form->get_errors(),
				'form_id' => $form->get_id()
			) );
		}
	endif;
	add_action( 'wp_enqueue_scripts', 'weldo_action_display_form_errors' );


	//removing standard sliders from Unyson - we use our theme slider
	if ( !function_exists( 'weldo_filter_disable_sliders' ) ) :
		function weldo_filter_disable_sliders( $sliders ) {
			foreach ( array( 'owl-carousel', 'bx-slider', 'nivo-slider' ) as $name ) {
				$key = array_search( $name, $sliders );
				unset( $sliders[ $key ] );
			}

			return $sliders;
		}
	endif;

	add_filter( 'fw_ext_slider_activated', 'weldo_filter_disable_sliders' );

	//removing standard fields from Unyson slider - we use our own slider fields
	if ( !function_exists( 'weldo_slider_population_method_custom_options' ) ) :
		function weldo_slider_population_method_custom_options( $arr ) {
			/**
			 * Filter for disable standard slider fields for carousel slider
			 *
			 * @param array $arr
			 */
			unset(
				$arr['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['title'],
				$arr['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['desc']
			);

			return $arr;
		}
	endif;
	add_filter( 'fw_ext_theme_slider_population_method_custom_options', 'weldo_slider_population_method_custom_options' );

	//Predefined Form Builder Templates
	if ( ! function_exists( 'weldo_filter_theme_page_builder_predefined_templates_contact_forms' ) ) :
		function weldo_filter_theme_page_builder_predefined_templates_contact_forms( $templates ) {
			$variables = fw_get_variables_from_file(
				WELDO_THEME_PATH . '/inc/builder-templates/forms.php',
				array( 'templates' => array() )
			);

			return array_merge( $templates, $variables['templates'] );
		}
	endif;
	add_filter( 'fw_ext_builder:predefined_templates:form-builder:full', 'weldo_filter_theme_page_builder_predefined_templates_contact_forms' );

	//Predefined Page Builder Templates
	if ( ! function_exists( 'weldo_filter_theme_page_builder_predefined_templates_pages' ) ) :
		function weldo_filter_theme_page_builder_predefined_templates_pages( $templates ) {
			$variables = fw_get_variables_from_file(
				WELDO_THEME_PATH . '/inc/builder-templates/pages.php',
				array( 'templates' => array() )
			);

			return array_merge( $templates, $variables['templates'] );
		}
	endif;
	add_filter( 'fw_ext_builder:predefined_templates:page-builder:full', 'weldo_filter_theme_page_builder_predefined_templates_pages' );


	if ( ! function_exists( 'weldo_filter_theme_page_builder_predefined_templates_sections' ) ) :
		function weldo_filter_theme_page_builder_predefined_templates_sections( $templates ) {
			$variables = fw_get_variables_from_file(
				WELDO_THEME_PATH . '/inc/builder-templates/sections.php',
				array( 'templates' => array() )
			);

			return array_merge( $templates, $variables['templates'] );
		}
	endif;
	add_filter( 'fw_ext_builder:predefined_templates:page-builder:section', 'weldo_filter_theme_page_builder_predefined_templates_sections' );

	if ( ! function_exists( 'weldo_filter_theme_page_builder_predefined_templates_columns' ) ) :
		function weldo_filter_theme_page_builder_predefined_templates_columns( $templates ) {
			$variables = fw_get_variables_from_file(
				WELDO_THEME_PATH . '/inc/builder-templates/columns.php',
				array( 'templates' => array() )
			);

			return array_merge( $templates, $variables['templates'] );

		}
	endif;
	add_filter( 'fw_ext_builder:predefined_templates:page-builder:column', 'weldo_filter_theme_page_builder_predefined_templates_columns' );


	//adding custom sidebar for shop page if WooCommerce active
	if ( class_exists( 'WooCommerce' ) ) :
		if ( !function_exists( 'weldo_filter_fw_ext_sidebars_add_conditional_tag' ) ) :
			function weldo_filter_fw_ext_sidebars_add_conditional_tag($conditional_tags) {
				$conditional_tags['is_archive_page_slug'] = array(
					'order_option' => 2,
					'check_priority' => 'last', // (optional: default is last, can be changed to 'first') use it to change priority checking conditional tag
					'name' => esc_html__('Products Type - Shop', 'weldo'), // conditional tag title
					'conditional_tag' => array(
						'callback' => 'is_shop', // existing callback
						'params' => array('products') //parameters for callback
					)
				);

				return $conditional_tags;
			}
		endif;
		add_filter('fw_ext_sidebars_conditional_tags', 'weldo_filter_fw_ext_sidebars_add_conditional_tag' );

	endif; //WooCommerce

	//theme icon fonts
	if ( ! function_exists( 'weldo_filter_custom_packs_list' ) ) :
		function weldo_filter_custom_packs_list($current_packs) {
			/**
			 * $current_packs is an array of pack names.
			 * You should return which one you would like to show in the picker.
			 */
			return array('weldo_icons', 'font-awesome', 'weldo_theme_icons');
}
	endif;
	add_filter('fw:option_type:icon-v2:filter_packs', 'weldo_filter_custom_packs_list');

	if ( ! function_exists( 'weldo_filter_add_my_icon_pack' ) ) :
		function weldo_filter_add_my_icon_pack($default_packs) {
			/**
			 * No fear. Defaults packs will be merged in back. You can't remove them.
			 * Changing some flags for them is allowed.
			 */
			return array(
				'weldo_icons' => array(
					'name'             => 'weldo_icons', // same as key
					'title'            => esc_html__('Weldo Flat Icons', 'weldo'),
					'css_class_prefix' => 'flaticon',
					'css_file'         => WELDO_THEME_PATH . '/css/flaticon.css',
					'css_file_uri'     => WELDO_THEME_URI . '/css/flaticon.css',
				),
				'weldo_theme_icons' => array(
					'name'             => 'weldo_theme_icons', // same as key
					'title'            => esc_html__('Weldo Theme Icons', 'weldo'),
					'css_class_prefix' => 'ico',
					'css_file'         => WELDO_THEME_PATH . '/css/icomoon.css',
					'css_file_uri'     => WELDO_THEME_URI . '/css/icomoon.css',
				)
			);
		}
	endif;
	add_filter('fw:option_type:icon-v2:packs', 'weldo_filter_add_my_icon_pack');

	if ( ! function_exists( 'weldo_breadcrumbs_blank_search_query_fix' ) ) :
		/**
		 * Breadcrumbs modifications
		 */
		function weldo_breadcrumbs_blank_search_query_fix( $items ) {

			if ( is_search() ) {
				if (  trim( get_search_query() ) == false  ) {
					$items[ sizeof( $items ) - 1 ]['name'] = esc_html__( 'Search', 'weldo' );
				}
			}

			return $items;
		}
	endif;

	add_filter( 'fw_ext_breadcrumbs_build', 'weldo_breadcrumbs_blank_search_query_fix' );

	//enable tags for events
	if ( ! function_exists( 'weldo_add_tags_for_events_unyson_extension' ) ) :
		function weldo_add_tags_for_events_unyson_extension() {
			return true;
		}
	endif;

	add_filter('fw:ext:events:enable-tags', 'weldo_add_tags_for_events_unyson_extension');

	//enable comments for events
		if ( ! function_exists( 'weldo_add_comments_support_for_fw_events' ) ) :
			function weldo_add_comments_support_for_fw_events() {
				add_post_type_support( 'fw-event', 'comments' );
			}
	endif;
	add_action( 'init', 'weldo_add_comments_support_for_fw_events' );

	//changing event tags name
	if ( ! function_exists( 'weldo_fw_ext_events_tag_name' ) ) :
		function weldo_fw_ext_events_tag_name( $array  ) {
			return array(
				'singular' => esc_html__( 'Event Tag', 'weldo' ),
				'plural'   => esc_html__( 'Event Tags', 'weldo' )
			);

		} //weldo_filter_fw_ext_events_post_slug()
	endif;
	add_filter( 'fw_ext_events_tag_name', 'weldo_fw_ext_events_tag_name' );

endif; //defined('FW')

//adding custom styles to TinyMCE
if ( ! function_exists( 'weldo_filter_mce_theme_format_insert_button' ) ) :
	function weldo_filter_mce_theme_format_insert_button( $buttons ) {
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	} //weldo_filter_mce_theme_format_insert_button()
endif;
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'weldo_filter_mce_theme_format_insert_button' );
// Callback function to filter the MCE settings
if ( ! function_exists( 'weldo_filter_mce_theme_format_add_styles' ) ) :
	function weldo_filter_mce_theme_format_add_styles( $init_array ) {
		// Define the style_formats array
		$style_formats = array(
			// Each array child is a format with it's own settings
			array(
				'title'   => esc_html__( 'Excerpt', 'weldo' ),
				'block'   => 'p',
				'classes' => 'entry-excerpt',
				'wrapper' => false,
			),
			array(
				'title'   => esc_html__( 'Paragraph with dropcap', 'weldo' ),
				'block'   => 'p',
				'classes' => 'big-first-letter',
				'wrapper' => false,
			),
			array(
				'title'   => esc_html__( 'Main theme color', 'weldo' ),
				'inline'  => 'span',
				'classes' => 'color-main',
				'wrapper' => false,
			),

		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );

		return $init_array;

	} //weldo_filter_mce_theme_format_add_styles()
endif;
add_filter( 'tiny_mce_before_init', 'weldo_filter_mce_theme_format_add_styles', 1 );


//demo content on remote hosting
/**
 * @param FW_Ext_Backups_Demo[] $demos
 *
 * @return FW_Ext_Backups_Demo[]
 */
if ( ! function_exists( 'weldo_filter_theme_fw_ext_backups_demos' ) ) :

	function weldo_filter_theme_fw_ext_backups_demos( $demos ) {

		if ( class_exists( 'FW_Ext_Backups_Demo' ) ) :
			$demos_array = array(
				'weldo-demo' => array (
					'title'        => esc_html__( 'Weldo Demo', 'weldo' ),
					'screenshot'   => esc_url('//webdesign-finder.com/weldo/demo/screenshot.png'),
					'preview_link' => esc_url('//webdesign-finder.com/weldo/'),
				),
			);

            $secret_demo_id = WELDO_REMOTE_DEMO_ID;

            // Demo ( Colorized )
            $demo_colorized_id = 'weldo-demo-colorized-' . $secret_demo_id;
            if ( $secret_demo_id ) {
                $demos_array[ $demo_colorized_id ] = array(
                    'title'         => esc_html__('Weldo Demo (Colorized)', 'weldo'),
                    'screenshot'    => esc_url( 'http://webdesign-finder.com/weldo/demo/screenshot.png' ),
                    'preview_link'  => esc_url( 'http://webdesign-finder.com/weldo/' ),
                );
            }
            foreach ( array( 'grandbox', 'precaster', 'fency', 'stairy', 'sheety', 'fabrico' ) as $demo_variant ) {
                // Demo Variants ( Blurred )
                $demo_id = 'weldo-' . $demo_variant . '-demo';
	            $demos_array[ $demo_id ] = array(
                    'title'        => ucwords( str_replace( array( '-', '_' ), ' ', $demo_variant ) ) . esc_html__( ' Demo', 'weldo' ),
                    'screenshot'    => esc_url( 'http://webdesign-finder.com/weldo/demo/screenshot-' . $demo_variant . '.png' ),
                    'preview_link'  => esc_url( 'http://webdesign-finder.com/weldo-' . $demo_variant ),
                );

                // Demo Variants ( Colorized )
                if ( $secret_demo_id ) {
                    $demo_colorized_id = 'weldo-' . $demo_variant . '-demo-colorized-' . $secret_demo_id;
                    $demos_array[ $demo_colorized_id ] = array(
                        'title'        => ucwords( str_replace( array( '-', '_' ), ' ', $demo_variant ) ) . esc_html__( ' Demo (Colorized)', 'weldo' ),
                        'screenshot'    => esc_url( 'http://webdesign-finder.com/weldo/demo/screenshot-' . $demo_variant . '.png' ),
                        'preview_link'  => esc_url( 'http://webdesign-finder.com/weldo-' . $demo_variant ),
                    );
                }
            }

			$download_url = esc_url('http://webdesign-finder.com/weldo/demo/');

			foreach ( $demos_array as $id => $data ) {
				$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
					'url'     => $download_url,
					'file_id' => $id,
				) );
				$demo->set_title( $data['title'] );
				$demo->set_screenshot( $data['screenshot'] );
				$demo->set_preview_link( $data['preview_link'] );

				$demos[ $demo->get_id() ] = $demo;

				unset( $demo );
			}
			return $demos;
		endif; //class_exists
	} //weldo_filter_theme_fw_ext_backups_demos()
endif;
add_filter( 'fw:ext:backups-demo:demos', 'weldo_filter_theme_fw_ext_backups_demos' );

//////////
//Booked//
//////////
//Remove Booked plugin front-end color theme (color-theme.php)
if( class_exists('booked_plugin')) {
	remove_action( 'wp_enqueue_scripts', array('booked_plugin', 'front_end_color_theme'));
}//Booked

