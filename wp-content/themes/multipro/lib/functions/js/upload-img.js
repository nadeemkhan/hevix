jQuery(document).ready(function() {
	jQuery('#upload_image_button_1').click(function() {
		window.send_to_editor = function(html) 
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_1').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	jQuery('#upload_image_button_2').click(function() {
		window.send_to_editor = function(html) 
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_2').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	jQuery('#upload_image_button_3').click(function() {	
		window.send_to_editor = function(html) 
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_3').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});	
	jQuery('#upload_image_button_4').click(function() {
		window.send_to_editor = function(html) 
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_4').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
});
