<?php
class Report_an_Error extends WP_Widget {
			public function __construct() {
			    parent::__construct(
			        'Report_an_Error',
			        __('Report an error','RERR'),
			        array( 'description' =>  __('This widget displays a description of the same name of the plugin. Displays the active element to create a bug report.','RERR'))
			    );
			}
// -------------------------------------------------------------------------------------------------------
			public function widget( $args, $instance ){

				echo $args['before_widget'];				
						
					// получаем сохраненные переменные	
		 			$title 			= isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : '';
		 			$description 	= isset( $instance[ 'description' ] )  ? str_replace("\n","<br>", $instance[ 'description' ]) : '';
		 			$type 			= isset( $instance[ 'type' ] )  ? $instance[ 'type' ] : 'link';
		 			$parameter 		= isset( $instance[ 'parameter' ] )  ? $instance[ 'parameter' ] : __('link','RERR');
		 			$color 			= isset( $instance[ 'color' ] )  ? $instance[ 'color' ] : '#000000';
		 			$size 			= isset( $instance[ 'size' ] )  ? $instance[ 'size' ] : '12';
		 			$description2 	= isset( $instance[ 'description2' ] )  ? str_replace("\n","<br>", $instance[ 'description2' ]) : '';

		 			if(isset($title)){
						echo $args['before_title'].$title.$args['after_title'];
					}

					echo $description;

					switch ($type) {
						case 'link':
							echo "<a href='javascript:void(0)' onclick='javascript:RERR();' style='color:".$color.";font-size:".$size."pt;'>".$parameter."</a>";
							break;
						case 'img':
							echo "<a src='javascript:void(0)' onclick='javascript:RERR();'><img border=0 style='width:".$size."px;' src='".$parameter."'></a>";
							break;						
						case 'button':
							echo "<button onclick='javascript:RERR();' style='font-size:".$size."pt;background-color:".$color.";padding:4px;border:0px'>".$parameter."</button>";
							break;						
						default:
							# code...
							break;
					}
					echo $description2;

				echo $args['after_widget'];

			}
// -------------------------------------------------------------------------------------------------------				
			public function update( $new_instance, $old_instance )
			{
					$instance = array();
					$instance['title']			= strip_tags( $new_instance['title'] );
					$instance['description']	= strip_tags( $new_instance['description'],'<b><i><u><small><li><ul><h1><h2><h3><h4><h5><br><center>');
					$instance['description2']	= strip_tags( $new_instance['description2'],'<b><i><u><small><li><ul><h1><h2><h3><h4><h5><br><center>');
					$instance['type']			= strip_tags( $new_instance['type'] );
					$instance['parameter']		= strip_tags( $new_instance['parameter'] );
					$instance['color']			= strip_tags( $new_instance['color'] );
					$instance['size']			= (strip_tags( $new_instance['size'] ))*1;
				

			    return $instance;
			}
// -------------------------------------------------------------------------------------------------------				
			public function form( $instance ){


		 			$title 			= isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : __('Noticed a typo?','RERR');
		 			$description 	= isset( $instance[ 'description' ] )  ? $instance[ 'description' ] : __('Select the text with error and press Ctrl+Enter or the link below','RERR')."\n";
		 			$type 			= isset( $instance[ 'type' ] )  ? $instance[ 'type' ] : 'link';
		 			$parameter 		= isset( $instance[ 'parameter' ] )  ? $instance[ 'parameter' ] : __('link','RERR');
		 			$color 			= isset( $instance[ 'color' ] )  ? $instance[ 'color' ] : '#000000';
		 			$size 			= isset( $instance[ 'size' ] )  ? $instance[ 'size' ] : '12';
		 			$description2 	= isset( $instance[ 'description2' ] )  ? $instance[ 'description2' ] : '';

				echo "<p>
				<label for='".$this->get_field_id('title')."'>".__('Title','RERR').":</label><br>
				<input class='widefat' id='".$this->get_field_id( 'title' )."' name='".$this->get_field_name( 'title' )."' type='text' value='".esc_attr($title)."' />
				<br>
				<label for='".$this->get_field_id('description')."'>".__('Description of the top','RERR').":</label><br>
				<textarea class='widefat' id='".$this->get_field_id( 'description' )."' rows=4 name='".$this->get_field_name( 'description' )."'>".esc_textarea($description)."</textarea><br>
				<font color='green'><small>".__('Text formatting tags are available:','RERR')." b,i,u,small,li,ul,h1,h2,h3,h4,h5,br,center.</small></font><br>
				<label for='".$this->get_field_id('type')."'>".__('Type','RERR').":</label><br>
				<select class='widefat' id='".$this->get_field_id('type' )."' name='".$this->get_field_name( 'type' )."'>
					<option value='link'"; 
					selected($type,"link");
					echo ">".__('Link','RERR')."</option>
					<option value='img'";
					selected($type,"img");
					echo ">".__('Image','RERR')."</option>
					<option value='button'";
					selected($type,"button");
					echo ">".__('Button','RERR')."</option>
				</select>
				<label for='".$this->get_field_id('parameter')."'>".__('Parameter','RERR').":</label><br>				
				<input class='widefat' id='".$this->get_field_id( 'parameter' )."' name='".$this->get_field_name( 'parameter' )."' type='text' value='".esc_attr($parameter)."' />
				<font color='green'><small>".__('For item "link" enter the URL you want to link, for item "image" specify the URL of an image, for item "button" enter the name of a button.','RERR')."</small></font>
				<table width='100%'>
				<tr><td>
					<label for='".$this->get_field_id('color')."'>".__('Color','RERR').":</label>
					<input id='".$this->get_field_id( 'color' )."' name='".$this->get_field_name( 'color' )."' type='color' value='".esc_attr($color)."' /></td><td align='right'>
					<label for='".$this->get_field_id('size')."'>".__('Size','RERR').":</label>
					<input id='".$this->get_field_id( 'size' )."' name='".$this->get_field_name( 'size' )."' type='number' value='".esc_attr($size)."' /></td></tr></table>
				<label for='".$this->get_field_id('description2')."'>".__('Description of the bottom','RERR').":</label><br>
				<textarea class='widefat' id='".$this->get_field_id( 'description2' )."' rows=4 name='".$this->get_field_name( 'description2' )."'>".esc_textarea($description2)."</textarea><br>
				<font color='green'><small>".__('Text formatting tags are available:','RERR')." b,i,u,small,li,ul,h1,h2,h3,h4,h5,br,center.</small></font>
				</p>";

			}
}