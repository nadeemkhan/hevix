<?php
/******************************************/
// 					VIDEO WIDGET
/******************************************/
class Pi_Search_Widget extends WP_Widget {
	
	/**************************************/
	//			Screenshot
	/**************************************/
	function Pi_Search_Widget() {

		$widget_ops = array( 'classname' => 'pi_search_widget', 'description' => __('A custom search widget.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_search_widget', 'Custom Search Widget', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		
		extract($args);
	
		$title = apply_filters('widget_title', $instance['title'] ); ?>
		
		<div class="widget-grey-bg">	
		
			<?php echo $before_widget;
	
			if ( $title ) echo $before_title . $title . $after_title; ?>
			
			<?php include(TEMPLATEPATH . '/searchform.php'); ?>
			
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

		$defaults = array('title' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_search_widget() {
	register_widget('Pi_Search_Widget');
}
add_action('widgets_init', 'register_pi_search_widget', 1);

?>