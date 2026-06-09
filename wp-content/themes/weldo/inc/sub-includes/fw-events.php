<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Weldo_Unyson_Events_Extends {
	public $self;
	public $all_events;
	public $weekly_events;
	public $weekly_events_ids_with_start_dates;
	public $ext;
	public $shortcode;
	public $days_of_week;
	public $day_of_week_today;
	public $next_event;
	public function __construct() {

		//singleton
		if( $this->self ) {
			return $this->self;
		} else {
			$this->self = $this;
		}

		$this->days_of_week = $this->get_default_day_of_week_names();
		$this->weekly_events = $this->get_all_weekly_events();
		$this->day_of_week_today = date('l');
		$this->next_event = $this->get_next_event();
	}

	public function get_upcoming_events() {
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

		//returning next events with status 'published'
		return $next_events_posts_published;
	}

	public function get_default_day_of_week_names() {
		return array(
			$this->get_day_of_week_from_event_start_date_option( '2001/01/01' ),
			$this->get_day_of_week_from_event_start_date_option( '2001/01/02' ),
			$this->get_day_of_week_from_event_start_date_option( '2001/01/03' ),
			$this->get_day_of_week_from_event_start_date_option( '2001/01/04' ),
			$this->get_day_of_week_from_event_start_date_option( '2001/01/05' ),
			$this->get_day_of_week_from_event_start_date_option( '2001/01/06' ),
			$this->get_day_of_week_from_event_start_date_option( '2001/01/07' ),
		);
	}

	public function get_all_weekly_events() {
		$all_events = $this->get_all_events();
		$all_events_ids = $this->get_events_ids( $all_events );
		$all_weekly_events_id = $this->get_weekly_events_ids_by_ids( $all_events_ids );

		$all_weekly_events = array();
		foreach ( $all_events as $event ) {
			if( in_array( $event->ID, $all_weekly_events_id ) ) {
				$all_weekly_events[] = $event;
			}
		}

		return $all_weekly_events;
	}

	public function get_all_weekly_events_sorted_by_day_of_week() {
		$days_of_week = $this->days_of_week;
		$weekly_events_ids_with_start_dates = $this->weekly_events_ids_with_start_dates;
		$days_events = array();
		foreach ( $weekly_events_ids_with_start_dates as $event ) {
			foreach ( $days_of_week as $day ) {
				if( $event['day'] === $day ) {
					$days_events[$day][] = $event;
				}
			}
		}

		return( $days_events );
	}

	public function get_all_events() {
		//get all child posts of events with start date larger than now
		$all_events = new WP_Query( array(
			'posts_per_page'      => -1,
			'post_type'           => 'fw-event',
			'post_status'         => array( 'publish' ),
		) );
		return $all_events->posts;
	}

	public function get_events_ids( $events ) {
		$ids = array();
		foreach ( $events as $event ) {
			$ids[] = $event->ID;
		}
		return $ids;
	}

	public function get_weekly_events_ids_by_ids( $ids ) {
		$weekly_events_ids = array();
		$weekly_events_ids_with_start_dates = array();
		foreach ( $ids as $id ) {
			$post_meta = get_post_meta( $id, 'fw_options' );
			$is_weekly = false;
			foreach ( $post_meta[0]['general-event']['event_children'] as $event_children ) {
				if ( ! empty( $event_children['weekly'] ) ) {
					$is_weekly = true;
					$day = $this->get_day_of_week_from_event_start_date_option( $event_children['event_date_range']['from'] );
					$weekly_events_ids_with_start_dates[$day][] = array(
						'id' => $id,
						'from' => $event_children['event_date_range']['from'],
						'to' => $event_children['event_date_range']['to'],
						'day' => $day,
						'users' => $event_children['event-user'],
						'from_timestamp' => $this->get_timestamp_from_event_date_option( $event_children['event_date_range']['from'] ),
						'to_timestamp' => $this->get_timestamp_from_event_date_option( $event_children['event_date_range']['to'] ),
					);
				}
			}

			if ( $is_weekly ) {
				$weekly_events_ids[] = $id;
			}
		}

		//building array with all weeks days
		$weekly_events_ids_with_start_dates_full = array();
		foreach ( $this->days_of_week as $day ) {
			$weekly_events_ids_with_start_dates_full[$day] = array();
			foreach ( $weekly_events_ids_with_start_dates as $day_name => $events_day ) {
				if ( $day_name === $day ) {
					usort( $events_day, function( $a, $b ) {
						$from_time_a = explode( ' ' , $a['from'] );
						$from_time_b = explode( ' ' , $b['from'] );
						$a = ( ! empty( $from_time_a[1] ) ) ? $from_time_a[1] : '00:00';
						$b = ( ! empty( $from_time_b[1] ) ) ? $from_time_b[1] : '00:00';
						if ( $a == $b ) {
							return 0;
						}
						return strcmp( $a, $b );
					});
					$weekly_events_ids_with_start_dates_full[$day] = $events_day;
				}
			}
		}

		$this->weekly_events_ids_with_start_dates = $weekly_events_ids_with_start_dates_full;

		return $weekly_events_ids;
	}

	public function get_next_event() {
		$next_event = array();
		$all_events = $this->weekly_events_ids_with_start_dates;
		$day_of_week_today = $this->day_of_week_today;

		//if today has events - returning first event
		if( ! empty( $all_events[$day_of_week_today][0] ) ) {
			$next_event = $all_events[$day_of_week_today][0];
		} else {
			//searching in other days
			$day_index = array_search( $day_of_week_today, array_keys( $all_events ) );
			$length = count( $all_events );

			$upcoming_days = array_slice( $all_events, $day_index + 1, $length - $day_index, true );

			//searching in upcoming days
			foreach ( $upcoming_days as $day => $day_events ) {
				$next_event = $day_events[0];
				break;
			}

			//if no events in next days - searching in previous days
			if ( empty( $next_event ) ) {
				$previous_days = array_slice( $all_events, 0, $day_index, true );
				foreach ( $previous_days as $day => $day_events ) {
					$next_event = $day_events[0];
					break;
				}
			}
		}

		return $next_event;

	}

	public function get_day_of_week_from_event_start_date_option( $from ) {
		$timestamp = strtotime( $from );
		$day_of_week = strftime( '%A', $timestamp );
		return $day_of_week;
	}

	public function get_day_of_week_from_timestamp( $timestamp ) {
		$day_of_week = strftime( '%A', $timestamp );
		return $day_of_week;
	}

	public function get_timestamp_from_event_date_option( $date ) {
		$timestamp = strtotime( $date );
		return $timestamp;
	}

	public static function filter_events_add_weekly_recurring_options( $array ) {
		return array_merge( $array, array(
			'weekly' => array(
				'type'         => 'switch',
				'value'        => false,
				'label'        => esc_html__( 'Weekly Repeatable', 'weldo' ),
				'desc'         => esc_html__( 'Switch if your event is weekly recurring from start date', 'weldo' ),
				'help'         => esc_html__( 'Day of the event will be set from event start date', 'weldo' ),
				'left-choice' => array(
					'value' => false,
					'label' => esc_html__( 'No', 'weldo' )
				),
				'right-choice'  => array(
					'value' => true,
					'label' => esc_html__( 'Yes', 'weldo' )
				),
			),
		) );
	}
}

add_filter( 'fw_option_type_event_popup_options:after', array( 'Weldo_Unyson_Events_Extends', 'filter_events_add_weekly_recurring_options') );
