<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! fw()->extensions->get( 'events' ) ) {
	class FW_Shortcode_Events extends FW_Shortcode {
		protected function _render( $atts, $content = null, $tag = '' ) {}
	}
} else {


class FW_Shortcode_Events extends FW_Shortcode {

	public $event_option_id;
	public $date_format;
	public $time_format;

	protected function _init() {
		$this->event_option_id = fw()->extensions->get( 'events' )->get_event_option_id();
		$this->date_format     = get_option( 'date_format' );
		$this->time_format     = get_option( 'time_format' );
	}

	protected function _render( $atts, $content = null, $tag = '' ) {

		$next_events_posts_published = $this->fw_get_next_events_published();

		$first_next_event_post = false;
		$first_next_event_post_id = false;

		if ( !empty ($next_events_posts_published ) ) {
			$first_next_event_post = $next_events_posts_published[0];
			$first_next_event_post->next_event_post = true;
			$first_next_event_post_id = $first_next_event_post->ID;
		}

		$posts_query = $this->fw_get_posts_with_info( array(
			'sort'		  	=> 'post_date',
			'items'			=> $atts['number'],
			'post__not_in'	=> array( $first_next_event_post_id )
		) );

		$posts = $posts_query->posts;
		
		//putting feature event in events array if it exists
		if ( !empty( $first_next_event_post ) ) {
			if ( !empty( $posts ) )  {
				array_splice( $posts, 1, 0, array( $first_next_event_post ) );
			} else {
				$posts[] = $first_next_event_post;
			}
		}
	
		$view_path = $this->locate_path( '/views/isotope-extended.php' );

		return fw_render_view( $view_path, array(
				'shortcode'  			  => $this,
				'atts'  				  => $atts,
				'posts' 				  => $posts,
			)
		);
	}

	/**
	 * @param array $args
	 *
	 * @return WP_Query
	 */
	public function fw_get_posts_with_info( $args = array() ) {
		$defaults = array(
			'sort'        => 'recent',
			'items'       => 5,
			'image_post'  => true,
			'date_post'   => true,
			'post_type'   => 'fw-event',
			'post__not_in'=> false

		);

		extract( wp_parse_args( $args, $defaults ) );

		$query = new WP_Query( array(
			'post_type'           => $post_type,
			'post_status'		  => 'publish',
			'orderby'             => $sort,
			'order '              => 'DESC',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $items,
			'post__not_in'        => $post__not_in,
		) );

		return $query;
	}

	/**
	 * @return int - next (future) events published posts
	 */
	public function fw_get_next_events_published() {
		
		//get all child posts of events with start date larger than now
		$next_event_child_post_query = new WP_Query( array(
			'posts_per_page'      => -1,
			'post_type'           => 'fw-event-search',
			'orderby'             => 'event-from-date',
			'order'               => 'ASC',
			'meta_query' => array(
				array(
					'key'=> 'event-from-date',
					'value' => time(),
					'compare' => '>'
				),
			)
		) );


		$next_events_posts = array();
		$next_events_posts_published = array();

		//getting parent events
		foreach ($next_event_child_post_query->posts as $key => $post) {
			$next_events_posts[] = get_post( $next_event_child_post_query->posts[$key]->post_parent );
		}

		//filtering only published posts
		foreach ($next_events_posts as $key => $post) {
			if( $post->post_status === 'publish' ) {
				$next_events_posts_published[] = $post;
			}
		}

		return $next_events_posts_published;
	}


	/**
	 * @param int $event_id
	 *
	 * @return array of event's meta
	 */
	public function fw_get_event_meta_by_id( $event_id = false ) {

		if ( empty ( $event_id ) ) {
			return false;
		}
		return fw_get_db_post_option( $event_id, $this->event_option_id );
	}

	/**
	 * @param int $event_id
	 *
	 * @return string event's place (venue)
	 */
	public function fw_get_event_place_by_id( $event_id = false ) {

		if ( empty ( $event_id ) ) {
			return false;
		}

		$event_meta = $this->fw_get_event_meta_by_id( $event_id );

		if ( !empty ( $event_meta['event_location']['venue'] ) ) {
			return $event_meta['event_location']['venue'];
		}

        if ( !empty ( $event_meta['event_location']['location'] ) ) {
            return $event_meta['event_location']['location'];
        } else {
            return false;
        }
	}

    public function fw_get_event_place_location_by_id( $event_id = false ) {

        if ( empty ( $event_id ) ) {
            return false;
        }

        $event_meta = $this->fw_get_event_meta_by_id( $event_id );

        if ( !empty ( $event_meta['event_location']['location'] ) ) {
            return $event_meta['event_location']['location'];
        } else {
            return false;
        }
    }

	/**
	 * @param int $event_id
	 *
	 * @return string event's place (venue)
	 */
	public function fw_get_event_start_timestamp_by_id( $event_id = false ) {

		if ( empty ( $event_id ) ) {
			return false;
		}

		$event_meta = $this->fw_get_event_meta_by_id( $event_id );

		if ( !empty ( $event_meta['event_children'][0]['event_date_range']['from'] ) ) {
			return strtotime( $event_meta['event_children'][0]['event_date_range']['from'] );
		} else {
			return false;
		}
	}


	/**
	 * @param string $date
	 *
	 * @return array of formatted date and time
	 */
	public function fw_get_formatted_date_from_datetime_string( $date_string, $only_date = false ) {

		$date = array(
			'date' => false,
			'time' => false
		);

		//get timestamp of date string
		$date_timestamp = strtotime( $date_string );

		$date['date'] = date_i18n( $this->date_format, $date_timestamp );

		if ( empty( $only_date ) ) {
			$date['time'] = date( $this->time_format, $date_timestamp );
		}

		return $date;
	}


	/**
	 * @param array event's meta
	 *
	 * @return array of formatted dates and times for event based on it's meta
	 */
	public function fw_get_formatted_date_from_event_meta( $event_meta ) {

		$dates_array = array();

		foreach ( $event_meta['event_children'] as $key => $row ) :
			if ( empty( $row['event_date_range']['from'] ) or empty( $row['event_date_range']['to'] ) ) :
				continue;
			endif;

			//get date and time or only date
			$only_date = ( $event_meta['all_day'] === 'no' ) ? false : true;

			$dates_array[] = array(
				'from' => $this->fw_get_formatted_date_from_datetime_string( $row['event_date_range']['from'], $only_date ),
				'to' => $this->fw_get_formatted_date_from_datetime_string( $row['event_date_range']['to'], $only_date )
			);
			
		endforeach;

		return $dates_array;

	}

	/**
	 * @param int $date
	 *
	 * @return array of event's meta
	 */
	public function fw_get_event_dates_by_id( $event_id = false ) {

		if ( empty ( $event_id ) ) {
			return false;
		}

		$dates_array = $this->fw_get_formatted_date_from_event_meta( $this->fw_get_event_meta_by_id( $event_id ) );

		return $dates_array;
	}

	/**
	 * @param int $event_id
	 *
	 * @return string event's place (venue)
	 */
	public function fw_get_event_excerpt_by_id( $event_id = false ) {

		if ( empty ( $event_id ) ) {
			return false;
		}
		
		return $event_excerpt = get_post( $event_id )->post_content;
	}
}

}