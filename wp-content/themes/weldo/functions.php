<?php if (!defined('ABSPATH')) {
	die('Direct access forbidden.');
}
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 */

$theme = wp_get_theme('weldo');
define('WELDO_THEME_VERSION', $theme['Version']);

//Since WP v4.7 using new functions
//https://developer.wordpress.org/themes/basics/linking-theme-files-directories/#linking-to-theme-directories
define('WELDO_THEME_URI', get_parent_theme_file_uri());
define('WELDO_THEME_PATH', get_parent_theme_file_path());

// You may request this 'WELDO_REMOTE_DEMO_ID' value from this theme author to get a colorized demo content.
// See the Theme support service contacts information.
define('WELDO_REMOTE_DEMO_ID', '');
define('WELDO_REMOTE_DEMO_VERSION', '1.0.0');
define('WELDO_DEV_MODE', TRUE);

//loading framework only if Unyson plugin is not active
if (!defined('FW') && file_exists(WELDO_THEME_PATH . '/inc/framework/bootstrap.php')) {
	include_once WELDO_THEME_PATH . '/inc/framework/bootstrap.php';
}

/**
 * Theme Includes
 *
 * https://github.com/ThemeFuse/Theme-Includes
 */
require_once WELDO_THEME_PATH . '/inc/init.php';
add_filter( 'body_class', function( $classes ) {
	$classes[] = 'header_show_all_menu_items';
	if ( is_page( 'katalog' ) ) {
		$classes[] = 'page-katalog';
	}
	return $classes;
} );
/**
 * Move "Online Termin" into Kontakt dropdown (below FAQ)
 * and remove it from the Header "Links" sidebar widget.
 */

/**
 * Resolve the Online Termin / Appointment page URL.
 */
function weldo_get_online_termin_url() {
	static $url = null;

	if ( null !== $url ) {
		return $url;
	}

	$slugs = array( 'online-termine', 'appointment', 'online-termin', 'online-terminbuchung' );

	foreach ( $slugs as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page && 'publish' === $page->post_status ) {
			$url = get_permalink( $page );
			return $url;
		}
	}

	$titles = array( 'Online appointments', 'Online Termin', 'Appointment' );

	foreach ( $titles as $title ) {
		$pages = get_posts(
			array(
				'post_type'      => 'page',
				'title'          => $title,
				'posts_per_page' => 1,
				'post_status'    => 'publish',
			)
		);

		if ( ! empty( $pages[0] ) ) {
			$url = get_permalink( $pages[0] );
			return $url;
		}
	}
	$url = home_url( '/online-termine/' );
	return $url;
} 
add_filter( 'wp_nav_menu_objects', 'weldo_move_online_termin_to_kontakt', 10, 2 );

function weldo_move_online_termin_to_kontakt( $items, $args ) {
	$is_primary_menu = ! empty( $args->theme_location ) && 'primary' === $args->theme_location;
	$is_links_widget = ! empty( $GLOBALS['weldo_links_widget_menu'] );

	if ( ! $is_primary_menu && ! $is_links_widget ) {
		return $items;
	}

	// Find Online Termin URL from an existing menu item (if present).
	$online_termin_url = weldo_get_online_termin_url();
	foreach ( $items as $item ) {
		if ( 'Online Termin' === $item->title ) {
			$online_termin_url = $item->url;
			break;
		}
	}
	$online_termin_url = weldo_get_online_termin_url();
	// Fallback: find page by slug/title.
	// if ( ! $online_termin_url ) {
	// 	$page = get_page_by_path( 'online-termin' );
	// 	if ( ! $page ) {
	// 		$page = get_page_by_path( 'online-terminbuchung' );
	// 	}
	// 	if ( ! $page ) {
	// 		$pages = get_posts( array(
	// 			'post_type'      => 'page',
	// 			'title'          => 'Online Termin',
	// 			'posts_per_page' => 1,
	// 		) );
	// 		$page = ! empty( $pages[0] ) ? $pages[0] : null;
	// 	}
	// 	if ( $page ) {
	// 		$online_termin_url = get_permalink( $page );
	// 	}
	// }

	// if ( ! $online_termin_url ) {
	// 	$online_termin_url = home_url( '/online-termin/' );
	// }

	// --- Sidebar Links widget: remove Online Termin ---
	if ( $is_links_widget ) {
		foreach ( $items as $key => $item ) {
			if ( 'Online Termin' === $item->title ) {
				unset( $items[ $key ] );
			}
		}
		return array_values( $items );
	}

	// --- Primary menu: add under Kontakt below FAQ ---
	$kontakt_id = 0;
	$faq_order  = 0;
	$max_id     = 0;
	$already_in_kontakt = false;

	foreach ( $items as $item ) {
		if ( (int) $item->ID > $max_id ) {
			$max_id = (int) $item->ID;
		}

		if ( 'Kontakt' === $item->title && 0 === (int) $item->menu_item_parent ) {
			$kontakt_id = (int) $item->ID;
		}

		if ( 'FAQ' === $item->title && $kontakt_id && (int) $item->menu_item_parent === $kontakt_id ) {
			$faq_order = (int) $item->menu_order;
		}

		if ( 'Online Termin' === $item->title && (int) $item->menu_item_parent === $kontakt_id ) {
			$already_in_kontakt = true;
			$item->url = $online_termin_url; // fix broken /online-termin/ link
		}
	}

	if ( ! $kontakt_id || $already_in_kontakt ) {
		return $items;
	}

	$new_item = (object) array(
		'ID'               => $max_id + 9999,
		'db_id'            => $max_id + 9999,
		'menu_item_parent' => $kontakt_id,
		'object_id'        => $max_id + 9999,
		'post_parent'      => $kontakt_id,
		'object'           => 'custom',
		'type'             => 'custom',
		'type_label'       => 'Custom Link',
		'title'            => 'Online Termin',
		'url'              => $online_termin_url,
		'target'           => '',
		'attr_title'       => '',
		'description'      => '',
		'classes'          => array( 'menu-item', 'menu-item-type-custom', 'menu-item-object-custom' ),
		'xfn'              => '',
		'status'           => '',
		'menu_order'       => $faq_order + 1,
	);

	$items[] = $new_item;

	usort( $items, function( $a, $b ) {
		return (int) $a->menu_order - (int) $b->menu_order;
	} );

	return $items;
}

// Flag when the Header "Links" widget menu is rendering.
add_filter( 'widget_nav_menu_args', function( $nav_menu_args, $nav_menu, $args, $instance ) {
	if ( ! empty( $instance['title'] ) && false !== stripos( $instance['title'], 'links' ) ) {
		$GLOBALS['weldo_links_widget_menu'] = true;
		add_action( 'widget_nav_menu_after', function() {
			unset( $GLOBALS['weldo_links_widget_menu'] );
		}, 999 );
	}
	return $nav_menu_args;
}, 10, 4 );
/**
 * References section carousel arrow controls.
 */
add_action( 'wp_footer', function() {
	if ( ! is_front_page() ) {
		return;
	}
	?>
	<script>
	jQuery(function($) {
		var $carousel = $('.references_carousel');
		if ( ! $carousel.length || typeof $.fn.owlCarousel === 'undefined' ) {
			return;
		}
		$('.references_prev').on('click', function() {
			$carousel.trigger('prev.owl.carousel');
		});
		$('.references_next').on('click', function() {
			$carousel.trigger('next.owl.carousel');
		});
	});
	</script>
	<?php
}, 99 );

/**
 * Katalog page — inject More button on Page Builder portfolio tiles.
 */
add_action(
	'wp_footer',
	function() {
		if ( ! is_page( 'katalog' ) ) {
			return;
		}
		?>
		<script>
		jQuery(function($) {
			$('body.page-katalog .vertical-item.item-gallery').each(function() {
				var $item = $(this);
				var $media = $item.find('.item-media').first();

				if ( ! $media.length || $media.find('.katalog-more-btn').length ) {
					return;
				}

				var href = $media.find('a.abs-link').attr('href')
					|| $item.find('.item-content a[href]').first().attr('href')
					|| '#';

				$media.append(
					$('<a>', {
						class: 'btn btn-maincolor btn-small katalog-more-btn',
						href: href,
						text: 'More'
					})
				);
			});
		});
		</script>
		<?php
	},
	100
);
