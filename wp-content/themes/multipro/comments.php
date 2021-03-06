 <?php
 
/*******************************************************************/
//				LOAD DIRECTLY OR PASSWORD PROTECTED
/*******************************************************************/

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'theme_textdomain') ?></p>
<?php	
	return;
}
  
/*******************************************************************/
//				DISPLAY COMMENTS AND PINGBACKS
/*******************************************************************/

if( have_comments() ) : ?>
	
	<!-- BEGIN #comments-wrap -->
	<div id="comments-wrap" class="clearfix">
	
	<?php if( ! empty($comments_by_type['comment']) ) : 
	//if there are normal comments
	?>
	  	<h2 id="comments"><?php comments_number( __('No Comments', 'theme_textdomain'), __('1 Comment', 'theme_textdomain'), __('% Comments', 'theme_textdomain') ); ?></h2>
		<ul class="commentslist">
		     	 <?php wp_list_comments('type=comment&avatar_size=60&callback=custom_comments'); ?>
		</ul>
	
	<?php endif; ?>
	
	<?php if( ! empty($comments_by_type['pings']) ) : 
	//if there are pings
	?>
		<h2 id="pings"><?php _e('Trackbacks for this post', 'theme_textdomain') ?></h2>
		<ul class="pingslist">
			<?php wp_list_comments('type=pings'); ?>
		</ul>
	<?php endif; ?> 
	 
		<div class="navigation">
			<div class="align-left"><?php previous_comments_link(); ?></div>
			<div class="align-right"><?php next_comments_link(); ?></div>
		</div>
		
	<!-- END #comments-wrap -->	
	</div>
	
 <?php else : 
 // No comments or closed comments
 ?>	
	<?php if ($post->comment_status == 'closed') : 
	// closed status
	?>
		<p class="nocomments"><?php _e('Comments are closed.', 'theme_textdomain') ?></p>
	<?php endif; ?> 

 <?php endif; ?>
 
 <?php
/*******************************************************************/
//				COMMENTS FORM
/*******************************************************************/
 ?>
 
 <?php if ('open' == $post->comment_status) : 
 // open status
 ?>     
	 <div id="respond" class="clearfix">    
	 	
	 	<h3 class="respond-title"><?php comment_form_title( __('Leave a Comment', 'theme_textdomain'), __('Leave a Comment to %s', 'theme_textdomain') ); ?></h3>
	 	
	 	<div class="cancel-comment-reply">
	 		<?php cancel_comment_reply_link(); ?>
	 	</div>
	 	
	 	<p class="respond-message"><?php _e('Make sure you enter the required information where indicated. Comments are moderated and nofollow is in use. Please no link dropping, no keywords or domains as names, do not spam, and do not advertise!', 'theme_textdomain') ?></p>
	 	
	 	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	 		
	 		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'theme_textdomain'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
	 
	 	<?php else : ?>
	 	
		 	<!-- BEGIN form -->
		 	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		 	    
		 	    <?php if ( is_user_logged_in() ) : ?>
		 	    
		 	    	<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'theme_textdomain'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'theme_textdomain').'">', '</a>') ?></p>
		 	    
		 		<?php else : ?>
		 			
		 			<p>
		 				<label for="author"><small><?php _e('Name', 'theme_textdomain') ?><span class="required-message"><?php if($req)  _e("*", 'theme_textdomain'); ?></span></small></label>
		 				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="50" class="input" tabindex="1" />
		 			</p>
		 			
		 			<p class="right">
		 				<label for="url"><small><?php _e('Website', 'theme_textdomain') ?></small></label>
		 				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="50"  class="input" tabindex="3" />
		 			</p>
		 			
		 			<p>
		 				<label for="email"><small><?php _e('Email', 'theme_textdomain') ?><span class="required-message"><?php if ($req) _e("*", 'theme_textdomain'); ?></span></small></label>
		 				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="50" class="input" tabindex="2" />
		 			</p>
		 			
		 		<?php endif; ?>
		 		
		 		<p>
		 			<label for="comment"><small><?php _e('Message', 'theme_textdomain') ?><span class="required-message"><?php if ($req) _e("*", 'theme_textdomain'); ?></span></small></label>
		 			<textarea name="comment" id="comment" cols="60" rows="7" tabindex="4"></textarea>
		 		</p>
		 		<p>
		 			<button class="blue-btn" type="submit" name="submit">
		 		        <span class="left"><span class="right"><?php _e('Submit Comment', 'theme_textdomain'); ?></span></span>
		 		    </button>
		 			<?php comment_id_fields(); ?>
		 		</p>
		 		<?php do_action('comment_form', $post->ID); ?>
		 	</form>	
		 
	 	<?php endif; ?>
	 	
	 </div>
	 	
 <?php endif; ?> 