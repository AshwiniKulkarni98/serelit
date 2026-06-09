<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


if ( ! function_exists( 'weldo_kses_list' ) ) :
	/**
	 * Returns allowed tags array for wp_kses functions
	 */
	function weldo_kses_list( $add_tags = array(), $add_atts = array() ) {

		//init additional params
		if ( ! is_array( $add_tags ) ) {
			$add_tags = array();
		}
		if ( ! is_array( $add_atts ) ) {
			$add_atts = array();
		}

		//allowed attributes for all tags
		$allowed_atts = array(
			'align'       => true,
			'aria-hidden' => true,
			'aria-label'  => true,
			'class'       => true,
			'clear'       => true,
			'dir'         => true,
			'id'          => true,
			'lang'        => true,
			'name'        => true,
			'style'       => true,
			'title'       => true,
			'xml:lang'    => true,
		) + $add_atts;

		if ( is_array( $add_tags ) && ! empty( $add_tags ) ) {
			foreach ( $add_tags as $key => $value ) {
				$add_tags[ $key ] += $allowed_atts;
			}
		}

//final allowed tags array
		return array(
					'address'    => $allowed_atts,
					'a'          => array(
					'href'         => true,
					'rel'          => true,
					'rev'          => true,
					'target'       => true,
					'data-content' => true,
					'data-month'   => true,
					'onclick'      => true,
				) + $allowed_atts,
					'abbr'       => $allowed_atts,
					'acronym'    => $allowed_atts,
					'area'       => array(
					'alt'    => true,
					'coords' => true,
					'href'   => true,
					'nohref' => true,
					'shape'  => true,
					'target' => true,
				) + $allowed_atts,
					'aside'      => $allowed_atts,
					'b'          => $allowed_atts,
					'bdo'        => $allowed_atts,
					'big'        => $allowed_atts,
					'blockquote' => array(
					'cite' => true,
				) + $allowed_atts,
					'br'         => $allowed_atts,
					'cite'       => $allowed_atts,
					'code'       => $allowed_atts,
					'del'        => array(
					'datetime' => true,
				) + $allowed_atts,
					'dd'         => $allowed_atts,
					'dfn'        => $allowed_atts,
					'details'    => array(
					'open' => true,
				) + $allowed_atts,
					'div'        => $allowed_atts,
					'dl'         => $allowed_atts,
					'dt'         => $allowed_atts,
					'em'         => $allowed_atts,
					'h1'         => $allowed_atts,
					'h2'         => $allowed_atts,
					'h3'         => $allowed_atts,
					'h4'         => $allowed_atts,
					'h5'         => $allowed_atts,
					'h6'         => $allowed_atts,
					'hr'         => array(
					'noshade' => true,
					'size'    => true,
					'width'   => true,
				) + $allowed_atts,
					'i'          => $allowed_atts,
					'img'        => array(
					'alt'      => true,
					'border'   => true,
					'height'   => true,
					'hspace'   => true,
					'longdesc' => true,
					'vspace'   => true,
					'src'      => true,
					'usemap'   => true,
					'width'    => true,
				) + $allowed_atts,
					'ins'        => array(
					'datetime' => true,
					'cite'     => true,
				) + $allowed_atts,
					'kbd'        => $allowed_atts,
					'li'         => array(
					'value' => true,
				) + $allowed_atts,
					'map'        => $allowed_atts,
					'mark'       => $allowed_atts,
					'p'          => $allowed_atts,
					'pre'        => array(
					'width' => true,
				) + $allowed_atts,
					'q'          => array(
					'cite' => true,
				) + $allowed_atts,
					's'          => $allowed_atts,
					'samp'       => $allowed_atts,
					'span'       => array(
					'data-content' => true,
				) + $allowed_atts,
					'small'      => $allowed_atts,
					'strike'     => $allowed_atts,
					'strong'     => $allowed_atts,
					'sub'        => $allowed_atts,
					'summary'    => $allowed_atts,
					'sup'        => $allowed_atts,
					'time'       => array(
					'datetime' => true,
				) + $allowed_atts,
					'tt'         => $allowed_atts,
					'u'          => $allowed_atts,
					'ul'         => array(
					'type' => true,
				) + $allowed_atts,
					'ol'         => array(
					'start'    => true,
					'type'     => true,
					'reversed' => true,
				) + $allowed_atts,
					'var'        => $allowed_atts,
				) + $add_tags;
	}
endif;