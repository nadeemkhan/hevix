<?php
/******************************************/
// 					VIDEO WIDGET
/******************************************/
class Pi_Info_Widget extends WP_Widget {
	
	/**************************************/
	//			Screenshot
	/**************************************/
	function Pi_Info_Widget() {

		$widget_ops = array( 'classname' => 'pi_info_widget', 'description' => __('Display info with title, description and link.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_info_widget', 'Custom Info Widget', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		
		extract($args);
	
		$title = apply_filters('widget_title', $instance['title'] );
		$desc = $instance['desc'];
		$anchor = $instance['anchor'];
		$url = $instance['url']; ?>
		
		<div class="widget-grey-bg">	
		
			<?php echo $before_widget;
	
			if ( $title ) echo $before_title . $title . $after_title; ?>
			
			<div class="pi-info-widget clearfix">
				<p><?php echo $desc; ?></p>
				<p class="more"><a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $anchor; ?></a></p>
			</div>
			
			<?php echo $after_widget; ?>
			
		</div>
			
	<?php }
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array('title' => '', 'desc' => '', 'anchor' => '', 'url' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description', 'theme_textdomain'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'anchor' ); ?>"><?php _e('Anchor text', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'anchor' ); ?>" name="<?php echo $this->get_field_name( 'anchor' ); ?>" value="<?php echo $instance['anchor']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('URL Link', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" />
		</p>
		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_info_widget() {
	register_widget('Pi_Info_Widget');
}
add_action('widgets_init', 'register_pi_info_widget', 1);

?>