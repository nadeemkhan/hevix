<?php
/******************************************/
//			SOCIAL MEDIA WIDGET
/******************************************/
class Pi_Social_Widget extends WP_Widget {
	
	/**************************************/
	//			Social media
	/**************************************/
	function Pi_Social_Widget() {

		$widget_ops = array( 'classname' => 'pi_social_widget' ,'description' => __('A widget that share your social media profiles.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_social_widget', 'Custom Social Widget', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title'] ); ?>
		
		<div class="widget-grey-bg">
		
			<?php echo $before_widget;
			
			if ( $title )  ?>

			<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="big,round,line,horizontal,counter,theme=08" data-services="vkontakte,facebook,twitter"></div>
			<?php echo $before_title . $title . $after_title; ?>
			
			<?php echo $after_widget;	?>
	
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

		$defaults = array('title' => 'Follow me' ,'twitter' => '', 'facebook' => '', 'youtube' => '', 'linkedin' => '', 'vimeo' => '', 'flickr' => '', 'foursquare' => '',  'tumblr' => '', 'xing' => '', 'dribbble' => '', 'forrst' => '', 'delicious' => '', 'wordpress' => '', 'posterous' => '', 'dopplr' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p><small><?php _e('IMPORTANT: Insert your Profile URL.', 'theme_textdomain'); ?></small></p>
		<?php foreach($instance as $k => $v){ ?>
			<?php if( $k != 'title' ){ ?>
				<p>	
				    <label for="<?php echo $this->get_field_id($k); ?>"><?php echo $k ?> :</label>
				    <input type="text" name="<?php echo $this->get_field_name($k); ?>" value="<?php echo $v; ?>" class="widefat" id="<?php echo $this->get_field_id($k); ?>" />
				</p>
			<?php } ?>
		<?php } ?>
		
		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_social_widget() {
	register_widget('Pi_Social_Widget');
}
add_action('widgets_init', 'register_pi_social_widget', 1);

?>