<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( class_exists( 'MWT_Widget_Theme_Posts' ) ) {
	return;
}

class MWT_Widget_Theme_Posts extends WP_Widget {
	/**
	 * Sets up a new Theme Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_popular_entries',
			'description' => esc_html__( 'Most Recent or Popular Posts with Images, Date and Excerpt', 'mwt' ),
		);
		parent::__construct( false, esc_html__( 'Theme - Posts', 'mwt' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Theme Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Theme Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Theme Posts', 'mwt');
		$category = ( ! empty( $instance['category'] ) ) ? absint( $instance['category'] ) : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) {
			$number = 3;
		}

		$sort = isset( $instance['sort'] ) ? $instance['sort'] : 'recent';

		$show_media = isset( $instance['show_media'] ) ? $instance['show_media'] : true;
		$show_excerpt = isset( $instance['show_excerpt'] ) ? $instance['show_excerpt'] : false;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filters the arguments for the Theme Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the Theme Posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'orderby'             => $sort,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'cat'                 => $category,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote', 'post-format-status', 'post-format-link', 'post-format-aside', 'post-format-chat' ),
					'operator' => 'NOT IN'
				)
			)
		) ) );

		$filepath = MWT_WIDGETS_PLUGIN_PATH . '/widgets/theme-posts/views/widget.php';

		if ( file_exists( $filepath ) ) {
			include( $filepath );
		} else {
			esc_html_e( 'View not found', 'mwt' );
		}
	}

	/**
	 * Handles updating the settings for the current Theme Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['category']     = (int) $new_instance['category'];
		$instance['sort']         = sanitize_text_field( $new_instance['sort'] );
		$instance['number']       = (int) $new_instance['number'];
		$instance['show_media']   = isset( $new_instance['show_media'] ) ? (bool) $new_instance['show_media'] : false;
		$instance['show_excerpt'] = isset( $new_instance['show_excerpt'] ) ? (bool) $new_instance['show_excerpt'] : false;
		$instance['show_date']    = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Theme Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : esc_html__( 'Theme Posts', 'mwt' );
		$category     = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';
		$number       = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$sort         = isset( $instance['sort'] ) ? $instance['sort'] : 'recent';
		$show_media   = isset( $instance['show_media'] ) ? (bool) $instance['show_media'] : true;
		$show_excerpt = isset( $instance['show_excerpt'] ) ? (bool) $instance['show_excerpt'] : false;
		$show_date    = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'mwt' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select category to show:', 'mwt' ); ?></label>
			<?php wp_dropdown_categories( array(
				'id'              => $this->get_field_id( 'category' ),
				'name'            => $this->get_field_name( 'category' ),
				'selected'        => $category,
				'show_option_all' => esc_html__( 'All', 'mwt' ),
				'hierarchical'    => 1,
				'show_count'      => 1,
				'class'           => 'widefat'
			) ); ?>
		</p>

		<p><label
				for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'mwt' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1"
			       value="<?php echo esc_attr($number); ?>" size="3"/></p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sort' ) ); ?>"><?php esc_html_e( 'Order by:', 'mwt' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'sort' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'sort' ) ); ?>" class="widefat">
				<option value="carousel" <?php selected( $sort, 'carousel' ); ?> ><?php esc_html_e( 'Random', 'mwt' ) ?></option>
				<option value="recent" <?php selected( $sort, 'recent'); ?>><?php esc_html_e( 'Recent', 'mwt' ); ?></option>
				<option value="comment_count" <?php selected( $sort, 'comment_count'); ?>><?php esc_html_e( 'Popular', 'mwt' ); ?></option>
			</select>
		</p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_media ); ?>
		          id="<?php echo esc_attr($this->get_field_id( 'show_media' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'show_media' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_media' )); ?>"><?php esc_html_e( 'Display post media?', 'mwt' ); ?></label>
		</p>
		<p><input class="checkbox" type="checkbox"<?php checked( $show_excerpt ); ?>
		          id="<?php echo esc_attr($this->get_field_id( 'show_excerpt' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'show_excerpt' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_excerpt' )); ?>"><?php esc_html_e( 'Display post excerpt?', 'mwt' ); ?></label>
		</p>
		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?>
		          id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?', 'mwt' ); ?></label>
		</p>
		<?php
	}
}