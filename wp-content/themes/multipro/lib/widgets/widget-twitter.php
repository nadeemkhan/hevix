<?php
/******************************************/
// 				TWITTER WIDGET
/******************************************/
class Pi_Twitter_Widget extends WP_Widget {
	
	/**************************************/
	//			Twitter
	/**************************************/
	function Pi_Twitter_Widget() {

		$widget_ops = array( 'classname' => 'pi_twitter_widget', 'description' => __('A widget that displays your latest tweets.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_twitter_widget', 'Custom Twitter Widget', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$show_number = $instance['show_number'];
		$show_follow = $instance['show_follow']; ?>

		<div class="widget-grey-bg">

			<?php echo $before_widget;
	
			if ( $title )
				echo $before_title . $title . $after_title;
			
			pi_twitter_plugin($username, $show_number);
			
			if ( $show_follow == 'yes' ) 
				echo '<div class="follow-me"><a title="'.$instance['follow_text'].'" href="http://twitter.com/'.$username.'">'.$instance['follow_text'] .'</a></div>';
	
			echo $after_widget; ?>
			
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

		$defaults = array( 'title' => 'Latest Tweets', 'username' => '', 'show_number' => 4, 'show_follow' => 'si' , 'follow_text' => 'Follow me' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('User', 'theme_textdomain') ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_number' ); ?>"><?php _e('No. Tweets', 'theme_textdomain') ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_number' ); ?>">
		        <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_follow' ); ?>"><?php _e('Show Follow', 'theme_textdomain') ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_follow' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_follow' ); ?>">
		        <option value="yes" <?php if($instance['show_follow'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_follow'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'follow_text' ); ?>"><?php _e('Follow Text', 'theme_textdomain') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'follow_text' ); ?>" name="<?php echo $this->get_field_name( 'follow_text' ); ?>" value="<?php echo $instance['follow_text']; ?>" />
		</p>

		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_twitter_widget() {
	register_widget('Pi_Twitter_Widget');
}
add_action('widgets_init', 'register_pi_twitter_widget', 1);

?>