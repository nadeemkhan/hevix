<?php
/******************************************/
//			RECENT POSTS WIDGET
/******************************************/
class Pi_Links_Widget extends WP_Widget {
	
	/**************************************/
	//			Recent Posts
	/**************************************/
	function Pi_Links_Widget() {

		$widget_ops = array( 'classname' => 'pi_links_widget' ,'description' => __('A custom links widget.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_links_widget', __('Custom Links Widget', 'theme_textdomain'), $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
	
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title'] );
		$category = $instance['category'];
		$order = $instance['order'];
		$show_number = $instance['show_number'];
		$show_desc = ( $instance['show_desc'] == "yes" ) ? true : false; ?>
				
		<div class="widget-grey-bg">
		
			<?php echo $before_widget;
	
			if ( $title ) echo $before_title . $title . $after_title; ?>
				
				<div class="pi-links-widget">
					<ul class="clearfix">
						
						<?php 
						
						wp_list_bookmarks( array(
							'categorize'        => false,
							'title_li'          => false,
							'orderby'           => $order,
							'limit'             => $show_number,
							'category'          => $category,
							'show_description'  => $show_desc,
							'between'			=> '<br />',
							'category_before'   => '<li id=%id class=%class clearfix>',
						));
						
						?>
						
					</ul>
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

		$defaults = array( 'title' => 'Links', 'category' => '', 'order' => '' , 'show_number' => 1, 'show_desc' => 'no' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'category' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" >
		    	<option value="" <?php if ( '' == $instance['category'] ) echo 'selected="selected"'; ?>><?php _e('All', 'theme_textdomain'); ?></option>
		    	<?php
		    	$categories = get_categories(array('type' => 'link'));
		    	
		    	foreach( $categories as $cat ) {
		    		echo '<option value="' . $cat->cat_ID . '"';
		    		
		    		if ( $cat->cat_ID == $instance['category'] ) echo  ' selected="selected"';
		    		
		    		echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';
		    		
		    		echo '</option>';
		    	}
		    	?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Order by', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" id="<?php echo $this->get_field_id('order'); ?>">
		        <option value="name" <?php if($instance['order']== "name"){ echo "selected='selected'";} ?>><?php _e('Name', 'theme_textdomain'); ?></option>
		        <option value="rating" <?php if($instance['order'] == "rating"){ echo "selected='selected'";} ?>><?php _e('Value', 'theme_textdomain'); ?></option>
		        <option value="rand" <?php if($instance['order'] == "rand"){ echo "selected='selected'";} ?>><?php _e('Rand', 'theme_textdomain'); ?></option>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_number' ); ?>"><?php _e('Number', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_number' ); ?>">
		        <?php for ( $i = 1; $i <= 20; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_desc' ); ?>"><?php _e('Description', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_desc' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_desc' ); ?>">
		        <option value="yes" <?php if($instance['show_desc'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_desc'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>
		<?php
	
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_links_widget() {
	register_widget('Pi_Links_Widget');
}
add_action('widgets_init', 'register_pi_links_widget', 1);

?>