<?php if ( ! defined( 'ABSPATH' ) ) {
	die();
}
if ( ( defined( 'FW' ) ) && ! ( class_exists( 'MWT_Widget_Icons_List' ) ) ) :

	class MWT_Widget_Icons_List extends WP_Widget {

		/**
		 * Widget constructor.
		 */
		private $options;
		private $prefix;

		function __construct() {

			$widget_ops = array(
				'classname'   => 'widget_icons_list',
				'description' => esc_html__( 'Add icons with title', 'mwt' ),
			);
			
			
			$shortcodes_extension = fw()->extensions->get( 'shortcodes' );
			$social_icons  = array();
			$icons_list  = array();
			if ( ! empty( $shortcodes_extension ) ) {
				$shortcode_icons_social = $shortcodes_extension->get_shortcode( 'icons_social' );
				if ( ! empty ( $shortcode_icons_social ) ) {
					$social_icons = $shortcode_icons_social->get_options();
				}

				$shortcode_icons_list = $shortcodes_extension->get_shortcode( 'icons_list' );
				if ( ! empty ( $shortcode_icons_list ) ) {
					$icons_list = $shortcode_icons_list->get_options();
				}
			}

			parent::__construct( false, esc_html__( 'Theme - Icons list', 'mwt' ), $widget_ops );

			//Create our options by using Unyson option types
			$this->options = array(
				'title' => array(
					'type'  => 'text',
					'label' => esc_html__( 'Widget Title', 'mwt' ),
				),
				'social_icons' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Social Icons in list', 'mwt' ),
					'popup-title'   => esc_html__( 'Add/Edit Icons in list', 'mwt' ),
					'desc'          => esc_html__( 'Create your tabs', 'mwt' ),
					'template'      => '{{=icon_title}}',
					'popup-options' => array(
						'icon_title'      => array(
							'label' => esc_html__( 'Social Title', 'mwt' ),
							'desc'  => esc_html__( 'Enter the title', 'mwt' ),
							'type'  => 'text',
							'value' => esc_html__( '', 'mwt' ),
						),
						'icon_class' => array(
							'type'  => 'icon',
							'label' => esc_html__( 'Social Icon', 'mwt' ),
							'set'   => 'social-icons',
						),
						'icon_link'  => array(
							'type'  => 'text',
							'value' => '',
							'label' => esc_html__( 'Social URL', 'mwt' ),
						),
					),
				),
				$icons_list,
			);
			$this->prefix  = 'widget_icons_list';
		}

		function widget( $args, $instance ) {
			extract( wp_parse_args( $args ) );

			$title     = esc_attr( $instance['title'] );
			$title     = $before_title  . $title . $after_title;

			$params = array();

			foreach ( $instance as $key => $value ) {
				$params[ $key ] = $value;
			}

			$instance = $params;

			$filepath = MWT_WIDGETS_PLUGIN_PATH . '/widgets/icons-list/views/widget.php';

			if ( file_exists( $filepath ) ) {
				include( $filepath );
			} else {
				esc_html_e( 'View not found', 'mwt' );
			}
		}

		function update( $new_instance, $old_instance ) {
			return fw_get_options_values_from_input(
				$this->options,
				FW_Request::POST( fw_html_attr_name_to_array_multi_key( $this->get_field_name( $this->prefix ) ), array() )
			);
		}

		function form( $values ) {

			$prefix = $this->get_field_id( $this->prefix ); // Get unique prefix, preventing duplicated key
			$id     = 'fw-widget-options-' . $prefix;

			// Print our options
			echo '<div class="fw-force-xs fw-theme-admin-widget-wrap fw-framework-widget-options-widget" data-fw-widget-id="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '">';

			echo fw()->backend->render_options( $this->options, $values, array(
				'id_prefix'   => $prefix . '-',
				'name_prefix' => $this->get_field_name( $this->prefix ),
			) );
			echo '</div>';

			return $values;
		}
	}

endif;