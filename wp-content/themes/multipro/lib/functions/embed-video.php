<?php
/*******************************************************************/
//						EMBED VIDEO
/*******************************************************************/
	
function embed_video($post_id, $width, $height, $type=null){
	/* load custom fields values */
	if($type != null)
		$video = get_post_meta( $post_id, $type, true );
	$video_url = $video['vimeo-youtube'] ;
	$video_code = $video['embedded-code'];
	if($width == '')
		$width = 400;
	if($height == '')
		$height = 225;
	
	/* priority: 1.url , 2.code */
	if($video_url != ''){
		/* youtube */
		if(preg_match('/youtube/', $video_url)){
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches)){
				$video_result = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$matches[1].'?wmode=transparent" frameborder="0" allowFullScreen></iframe>';
			}else{
				$video_result = __('Invalid YouTube URL, please check it again.', 'theme_textdomain');
			}
		}
		/* vimeo */
		elseif(preg_match('/vimeo/', $video_url)){
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches)){
				$video_result = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';
			}else{
				$video_result = __('Invalid Vimeo URL, please check it again.', 'theme_textdomain');
			}
		}
		else{
			$video_result = __('Invalid YouTube or Vimeo URL, please check it again.', 'theme_textdomain');
		}
		echo $video_result;
	/* embedded code */ 
	}else{
		echo stripslashes(htmlspecialchars_decode($video_code));
	}
}


/*******************************************************************/
//						VIDEO LIGHTBOX
/*******************************************************************/

function video_lightbox($post_id, $img_width, $img_height){
	$video = get_post_meta( $post_id, 'portfolio_video', true );
	$thumb = get_post_thumbnail_id(); 
	$image = vt_resize( $thumb,'' , $img_width, $img_height, true );
	if($video['vimeo-youtube'] != ''){
		echo '<a href="'.$video['vimeo-youtube'].'" rel="prettyPhoto[gallery]" title=""><img src="'.$image[url].'" alt="'.the_title('', '', false).'" /></a>';
	}else{
		echo '<a href="#inline-'.$post_id.'" rel="prettyPhoto[gallery]"><img src="'.$image[url].'" alt="'.the_title('', '', false).'" /></a><div id="inline-'.$post_id.'" class="hide">'.$video['embedded-code'].'</div>';
	}
}
?>