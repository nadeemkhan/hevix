<?php
/******************************************/
// 				SCREENSHOT WIDGET
/******************************************/
class Pi_Screenshot_Widget extends WP_Widget {
	
	/**************************************/
	//			Screenshot
	/**************************************/
	function Pi_Screenshot_Widget() {

		$widget_ops = array( 'classname' => 'pi_screenshot_widget', 'description' => __('A widget that displays large thumbnails with lightbox.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_screenshot_widget', 'Custom Screenshot Widget', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		
		extract($args);
	
		$title = apply_filters('widget_title', $instance['title'] );
		$desc = $instance['desc'];
		$img = $instance['img']; 
		$excerpt = $instance['excerpt']; ?>
		
		
		<div class="widget-grey-bg">
		
			<?php echo $before_widget;
	
			if ( $title ) echo $before_title . $title . $after_title; ?>
					
			<div class="pi-screenshot-widget">
				<?php if ( $desc != '' ) ?>
					<p class="description"><?php echo $desc; ?></p>
				<?php if( $img != '' ) : ?>	
					<?php $image = vt_resize( '', $img, 288, 105, true ); ?>
					<div class="post-thumb">
						<a href="<?php echo $img; ?>" rel="prettyPhoto[gallery]"><img src="<?php echo $image[url]; ?>" alt="" /></a>
					</div>
				<?php endif; ?>
				<?php if ( $excerpt != '' ) ?>
					<p class="excerpt"><?php echo $excerpt ?></p>
			</div>
			
		<?php  echo $after_widget; ?>
	
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

		$defaults = array('title' => '', 'desc' => '', 'img' => '' );
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
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e('Image', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo $instance['img']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>"><?php _e('Excerpt', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" value="<?php echo $instance['excerpt']; ?>" />
		</p>
		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_screenshot_widget() {
	register_widget('Pi_Screenshot_Widget');
}
add_action('widgets_init', 'register_pi_screenshot_widget', 1);

?>