<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

//additional fields to widgets
if ( !function_exists('weldo_action_in_widget_form') ) :
	function weldo_action_in_widget_form( $t, $return, $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'float' => 'none' ) );
		if ( ! isset( $instance['widget_background'] ) ) {
			$instance['widget_background'] = null;
		}

		if ( ! isset( $instance['bootstrap_width'] ) ) {
			$instance['bootstrap_width'] = null;
		}
		?>
		<p class="widget_background_option">
			<label for="<?php echo esc_attr( $t->get_field_id( 'widget_background' ) ); ?>"><?php esc_html_e( 'Widget Background:', 'weldo' ); ?></label>
			<select id="<?php echo esc_attr( $t->get_field_id( 'widget_background' ) ); ?>"
					name="<?php echo esc_attr( $t->get_field_name( 'widget_background' ) ); ?>">
				<option <?php selected( $instance['widget_background'], '' ); ?>
						value=""><?php esc_html_e( 'None', 'weldo' ); ?></option>
				<option
					<?php selected( $instance['widget_background'], 'ls' ); ?>value="ls"><?php esc_html_e( 'Light Backgorund', 'weldo' ); ?></option>
				<option
					<?php selected( $instance['widget_background'], 'ls ms' ); ?>value="ls ms"><?php esc_html_e( 'Light Muted Backgorund', 'weldo' ); ?></option>
				<option <?php selected( $instance['widget_background'], 'ds' ); ?>
						value="ds"><?php esc_html_e( 'Dark Background', 'weldo' ); ?></option>
				<option <?php selected( $instance['widget_background'], 'ds ms' ); ?>
						value="ds ms"><?php esc_html_e( 'Dark Muted Background', 'weldo' ); ?></option>
				<option <?php selected( $instance['widget_background'], 'cs' ); ?>
						value="cs"><?php esc_html_e( 'Color Main Background', 'weldo' ); ?></option>
                <option <?php selected( $instance['widget_background'], 'cs cs2' ); ?>
						value="cs cs2"><?php esc_html_e( 'Color Main Background 2', 'weldo' ); ?></option>
			</select>
		</p>
		<p class="widget_bootstrap_width">
			<label
				for="<?php echo esc_attr( $t->get_field_id( 'bootstrap_width' ) ); ?>"><?php esc_html_e( 'Widget Column Width:', 'weldo' ); ?>
			</label>
			<select id="<?php echo esc_attr( $t->get_field_id( 'bootstrap_width' ) ); ?>"
			        name="<?php echo esc_attr( $t->get_field_name( 'bootstrap_width' ) ); ?>">
				<option <?php selected( $instance['bootstrap_width'], '' ); ?> value=""><?php esc_html_e( 'None', 'weldo' ); ?></option>
				<option <?php selected( $instance['bootstrap_width'], 'col-md-3' ); ?>value="col-md-3">1/4</option>
				<option <?php selected( $instance['bootstrap_width'], 'col-md-4' ); ?> value="col-md-4">1/3</option>
				<option <?php selected( $instance['bootstrap_width'], 'col-md-6' ); ?> value="col-md-6">1/2</option>
				<option <?php selected( $instance['bootstrap_width'], 'col-md-12' ); ?>value="col-md-12"><?php esc_html_e( 'Full Width', 'weldo' ); ?></option>
			</select>
		</p>

		<?php
		$return = null;

		return array( $t, $return, $instance );
	} //weldo_action_in_widget_form()
endif;

if( !function_exists('weldo_filter_in_widget_form_update') ) :
	function weldo_filter_in_widget_form_update( $instance, $new_instance, $old_instance ) {
		$instance['widget_background'] = $new_instance['widget_background'];
		$instance['bootstrap_width']   = $new_instance['bootstrap_width'];
	
		return $instance;
	} //weldo_filter_in_widget_form_update()
endif;

if( !function_exists( 'weldo_filter_dynamic_sidebar_params' ) ):
	function weldo_filter_dynamic_sidebar_params( $params ) {
	
		//only for frontend
		if ( is_admin() ) {
			return $params;
		}
		global $wp_registered_widgets;
	
		//widget options
		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[ $widget_id ];
		$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		$widget_num = $widget_obj['params'][0]['number'];
	
		//arrays with widgets that needs to modify they CSS classes
		$darklinks_widgets = array(
			'widget_recent_comments',
			'widget_recent_entries',
		);
	
		$greylinks_widgets = array(
			'widget_pages',
			'widget_nav_menu',
			'widget_meta',
			'widget_categories',
			'widget_archive',
		);
	
		$background_widgets = array();
	
		if ( in_array( $wp_registered_widgets[ $widget_id ]['classname'], $darklinks_widgets ) ) {
			$params[0]['before_widget'] = str_replace( 'class="widget ', 'class="links-darkgrey widget ', $params[0]['before_widget'] );
		}

		if ( in_array( $wp_registered_widgets[ $widget_id ]['classname'], $greylinks_widgets ) ) {
			$params[0]['before_widget'] = str_replace( 'class="widget ', 'class="widget ', $params[0]['before_widget'] );
		}

		if ( in_array( $wp_registered_widgets[ $widget_id ]['classname'], $background_widgets ) ) {
			$params[0]['before_widget'] = str_replace( 'class="widget ', 'class="hero-bg widget ', $params[0]['before_widget'] );
		}
	
		if ( is_active_widget( false, false, 'monster' ) ) {
	
			foreach ( $wp_registered_widgets as $key => $widget_instance ) {
	
				//working inside monster but not outside
				if ( is_active_widget( false, false, 'monster' ) ) {
					if ( in_array( $widget_instance['callback'][0]->widget_options['classname'], $darklinks_widgets ) ) {
						$widget_instance['callback'][0]->widget_options['classname'] .= ' links-darkgrey';
						continue;
					}
	
					if ( in_array( $widget_instance['callback'][0]->widget_options['classname'], $greylinks_widgets ) ) {
						$widget_instance['callback'][0]->widget_options['classname'] .= ' ';
						continue;
					}
	
					if ( in_array( $wp_registered_widgets[ $key ]['classname'], $background_widgets ) ) {
						$widget_instance['callback'][0]->widget_options['classname'] .= ' hero-bg';
						continue;
					}
				}
	
			}
		} //if monster widget
	
		$widget_background = ( !empty( $widget_opt[ $widget_num ]['widget_background'] ) ) ? $widget_opt[ $widget_num ]['widget_background'] : 'widget_no_background';
		$bootstrap_width   = ( !empty( $widget_opt[ $widget_num ]['bootstrap_width'] ) ) ? $widget_opt[ $widget_num ]['bootstrap_width'] : '';
	
		//creating columns only in footer widget area
		if ( $bootstrap_width == 'none' || $params[0]['id'] !== 'sidebar-footer' ) {
			$bootstrap_width = '';
		}
		if ( ( $bootstrap_width == 'none' || ! $bootstrap_width ) && $params[0]['id'] == 'sidebar-footer' ) {
			$bootstrap_width = 'col-sm-12';
		}
	
		$params[0]['before_widget'] = '<div class="widget-theme-wrapper ' . esc_attr( $widget_background ) . '">' . $params[0]['before_widget'];
		$params[0]['after_widget']  = $params[0]['after_widget'] . '</div>';
	
		if ( $bootstrap_width ) {
			$params[0]['before_widget'] = '<div class="' . esc_attr( $bootstrap_width ) . '">' . $params[0]['before_widget'];
			$params[0]['after_widget']  = $params[0]['after_widget'] . '</div>';
		}
	
		return $params;
	} //weldo_filter_dynamic_sidebar_params()
endif;

//Add input fields(priority 5, 3 parameters)
add_action( 'in_widget_form', 'weldo_action_in_widget_form', 5, 3 );
//Callback function for options update (priority 5, 3 parameters)
add_filter( 'widget_update_callback', 'weldo_filter_in_widget_form_update', 5, 3 );
//add class names (default priority, one parameter)
add_filter( 'dynamic_sidebar_params', 'weldo_filter_dynamic_sidebar_params', 1 );

//eof widgets additional fields