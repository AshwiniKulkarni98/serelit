<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Manual gallery cards for specific portfolio projects (slug or post ID).
 *
 * @return array<int, array{image: string, title?: string}>
 */
function weldo_get_manual_project_gallery_cards( $post_id ) {
	$uploads = content_url( '/uploads' );
	$slug    = get_post_field( 'post_name', $post_id );

	$by_slug = array(
		'4050' => array(
			array( 'image' => $uploads . '/2026/06/p1.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/06/p2.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/06/p3.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/06/p4.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/06/p5.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/06/p6.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/06/4.jpeg', 'title' => '' ),
		),
		'fliegengittersysteme' => array(
			// array( 'image' => $uploads . '/2026/04/1-1170x700.jpeg', 'full' => $uploads . '/2026/04/1.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/04/2.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/04/3.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/04/4.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/04/5.jpeg', 'title' => '' ),
			array( 'image' => $uploads . '/2026/04/6.jpeg', 'title' => '' ),
		),
	);

	if ( isset( $by_slug[ $slug ] ) ) {
		return $by_slug[ $slug ];
	}

	if ( isset( $by_slug[ (string) $post_id ] ) ) {
		return $by_slug[ (string) $post_id ];
	}

	return array();
}

/**
 * Strip WordPress generated size suffix for lightbox full image.
 */
function weldo_gallery_full_image_url( $url ) {
	$url = html_entity_decode( $url, ENT_QUOTES, 'UTF-8' );
	$url = preg_replace( '/-\d+x\d+(?=\.(jpe?g|png|webp|gif)$)/i', '', $url );

	return esc_url_raw( $url );
}

/**
 * Skip icons, logos, and very small thumbs when building galleries.
 */
function weldo_should_skip_gallery_image( $url ) {
	if ( preg_match( '/logo|icon|avatar|gravatar/i', $url ) ) {
		return true;
	}

	if ( preg_match( '/-(\d+)x(\d+)\.(jpe?g|png|webp|gif)$/i', $url, $size ) ) {
		$width  = (int) $size[1];
		$height = (int) $size[2];

		return $width < 120 && $height < 120;
	}

	return false;
}

/**
 * Pick the best display URL from an img tag (src + largest srcset candidate).
 */
function weldo_gallery_best_url_from_img_tag( $tag ) {
	$candidates = array();

	if ( preg_match( '/\ssrc=["\']([^"\']+)["\']/i', $tag, $match ) ) {
		$candidates[] = array(
			'url' => $match[1],
			'w'   => 0,
		);
	}

	if ( preg_match( '/\ssrcset=["\']([^"\']+)["\']/i', $tag, $match ) ) {
		foreach ( preg_split( '/\s*,\s*/', html_entity_decode( $match[1], ENT_QUOTES, 'UTF-8' ) ) as $part ) {
			$part = trim( $part );
			if ( preg_match( '/(\S+)\s+(\d+)w/i', $part, $size_match ) ) {
				$candidates[] = array(
					'url' => $size_match[1],
					'w'   => (int) $size_match[2],
				);
			} elseif ( preg_match( '/^(\S+)/', $part, $size_match ) ) {
				$candidates[] = array(
					'url' => $size_match[1],
					'w'   => 0,
				);
			}
		}
	}

	if ( empty( $candidates ) ) {
		return '';
	}

	usort(
		$candidates,
		static function ( $a, $b ) {
			return $b['w'] <=> $a['w'];
		}
	);

	foreach ( $candidates as $candidate ) {
		$resolved = weldo_gallery_resolve_image_url( $candidate['url'] );
		if ( $resolved ) {
			return $resolved;
		}
	}

	return '';
}

/**
 * Normalize a gallery URL; upgrade tiny thumbs to full-size when possible.
 */
function weldo_gallery_resolve_image_url( $url ) {
	$url = html_entity_decode( trim( $url ), ENT_QUOTES, 'UTF-8' );
	$url = preg_replace( '/\?.*$/', '', $url );

	if ( empty( $url ) || preg_match( '/logo|icon|avatar|gravatar|favicon/i', $url ) ) {
		return '';
	}

	$full = weldo_gallery_full_image_url( $url );

	if ( weldo_should_skip_gallery_image( $url ) ) {
		if ( $full && $full !== esc_url_raw( $url ) ) {
			return $full;
		}

		return '';
	}

	return esc_url_raw( $url );
}

/**
 * Add image URL to ordered gallery list (dedupe exact src only, keep grid order).
 *
 * @param array<int, array{src: string, full: string}> $ordered
 * @param array<string, true>                          $seen
 */
function weldo_gallery_collect_url( array &$ordered, array &$seen, $src ) {
	$src = weldo_gallery_resolve_image_url( $src );
	if ( empty( $src ) ) {
		return;
	}

	if ( isset( $seen[ $src ] ) ) {
		return;
	}

	$full = weldo_gallery_full_image_url( $src );
	if ( ! $full ) {
		return;
	}

	$seen[ $src ] = true;
	$ordered[]    = array(
		'src'  => $src,
		'full' => $full,
	);
}

/**
 * Pull image URLs from rendered HTML (Page Builder output).
 *
 * @return array<int, array{image: string, title: string}>
 */
function weldo_extract_gallery_cards_from_html( $html ) {
	if ( empty( $html ) ) {
		return array();
	}

	$html    = html_entity_decode( $html, ENT_QUOTES, 'UTF-8' );
	$ordered = array();
	$seen    = array();

	// One card per gallery img (skip featured/logo thumbs; use largest srcset size).
	if ( preg_match_all( '/<img\b[^>]+>/i', $html, $img_tags ) ) {
		foreach ( $img_tags[0] as $tag ) {
			if ( preg_match( '/\b(?:wp-post-image|custom-logo|site-logo|avatar|gravatar)\b/i', $tag ) ) {
				continue;
			}

			$src = weldo_gallery_best_url_from_img_tag( $tag );
			if ( $src ) {
				weldo_gallery_collect_url( $ordered, $seen, $src );
			}
		}
	}

	if ( preg_match_all( '/\s(?:data-src|data-lazy-src|data-original)=["\']([^"\']+)["\']/i', $html, $lazy_matches ) ) {
		foreach ( $lazy_matches[1] as $src ) {
			weldo_gallery_collect_url( $ordered, $seen, $src );
		}
	}

	if ( preg_match_all( '/background-image\s*:\s*url\s*\(\s*["\']?([^"\')]+)["\']?\s*\)/i', $html, $bg_matches ) ) {
		foreach ( $bg_matches[1] as $src ) {
			weldo_gallery_collect_url( $ordered, $seen, $src );
		}
	}

	$cards = array();
	foreach ( $ordered as $item ) {
		$cards[] = array(
			'image' => $item['src'],
			'full'  => $item['full'],
			'title' => '',
		);
	}

	return $cards;
}

/**
 * Gallery cards for a portfolio single.
 *
 * @return array<int, array{image: string, title?: string}>
 */
function weldo_get_project_gallery_cards( $post_id ) {
	$manual = weldo_get_manual_project_gallery_cards( $post_id );
	if ( ! empty( $manual ) ) {
		return apply_filters( 'weldo_project_gallery_cards', $manual, $post_id );
	}

	return array();
}

/**
 * Replace Page Builder image grids with uniform zoom cards on portfolio singles.
 */
function weldo_portfolio_content_to_card_gallery( $content ) {
	if ( ! is_singular( 'fw-portfolio' ) || false !== strpos( $content, 'weldo-project-extra-cards' ) ) {
		return $content;
	}

	$post_id = get_the_ID();
	$manual  = weldo_get_manual_project_gallery_cards( $post_id );
	$cards   = ! empty( $manual ) ? $manual : weldo_extract_gallery_cards_from_html( $content );

	if ( count( $cards ) < 2 ) {
		return $content;
	}

	$cards = apply_filters( 'weldo_project_gallery_cards', $cards, $post_id );

	ob_start();
	set_query_var( 'weldo_gallery_cards', $cards );
	get_template_part( 'template-parts/portfolio/project-extra-cards' );

	return ob_get_clean();
}

add_filter( 'the_content', 'weldo_portfolio_content_to_card_gallery', 999 );

/**
 * Hide entry meta row on project 4050 only.
 */
function weldo_project_hides_entry_meta( $post_id ) {
	$slug = get_post_field( 'post_name', $post_id );
	return ( 4050 === (int) $post_id )
		|| ( '4050' === $slug )
		|| ( 'fliegengittersysteme' === $slug );
	// return ( 4050 === (int) $post_id ) || ( '4050' === get_post_field( 'post_name', $post_id ) );
}
