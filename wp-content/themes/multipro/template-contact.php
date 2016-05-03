<?php
/*
Template Name: Contact
*/
?>

<?php 
if(isset($_POST['submitted'])) {
	if(trim($_POST['cName']) === '') {
		$hasError = true;			
		$nameError = true;
	} else {
		$name = trim($_POST['cName']);
	}
		
	if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['cEmail']))) {
		$hasError = true;
		$emailError = true;
	} else {
		$email = trim($_POST['cEmail']);
	}
			
	if(trim($_POST['cComment']) === '') {
		$hasError = true;
		$commentError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['cComment']));
		} else {
			$comments = trim($_POST['cComment']);
		}
	}
			
	if(!isset($hasError)) {
		$emailTo = of_get_option('email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'Contact Form - From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		mail_utf8($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}	
} ?>

<?php get_header(); ?>

<!-- BEGIN #content -->
<div id="content">
	<div class="grey-line"></div>
	<!-- BEGIN .center-wrap -->
	<div class="center-wrap clearfix">
		<!-- #path > nav location -->
		<?php if(function_exists('yoast_breadcrumb')){ ?>
			<div id="path"><?php yoast_breadcrumb(); ?></div>
		<?php } ?>
		<!-- BEGIN .contact-wrap -->
		<div id="contact-info">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<!-- BEGIN .post -->
				<div <?php post_class('contact-template'); ?> id="post-<?php the_ID(); ?>">
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
						<!-- END .entry-title-wrap -->
						<?php if( current_user_can('edit_post', $post->ID) ): ?>
							<div class="edit-message">
								<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
							</div>
						<?php endif; ?>
						<?php $data = get_post_meta( get_the_ID(), 'key', true ); ?>
						<?php if( ( !of_get_option('enable_submenu') ) || ( of_get_option('enable_submenu') && $data['heading'] != '' ) ) : ?>
							<div class="entry-title-wrap">
								<div class="entry-title-line"></div>
								<?php if( !of_get_option('enable_submenu') ) : ?>
									<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php else : ?>
									<h2 class="entry-title"><?php the_title(); ?></h2>
								<?php endif; ?>
								<div class="entry-title-line"></div>
							</div>
						<?php endif; ?>
						<!-- BEGIN #entry-content -->
						<div class="entry-content">
							<?php the_content(); ?>
						<!-- END entry-content -->
						</div>
					<!-- END .post-content -->
					</div>
				<!-- END .post -->
				</div>
			<?php endwhile; endif; ?>
		<!-- END .contact-wrap -->
		</div>
		<!-- BEGIN .contact-wrap -->
		<div id="contact-form">
			<?php if(isset($emailSent) && $emailSent == true) : ?>
				<div class="alert green"><?php _e('Thanks, your email was sent successfully.', 'theme_textdomain') ?></div>
			<?php else : ?>
				<!-- BEGIN #contact-form -->
				<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
					<fieldset>
						<p>
							<label for="cName"><?php _e('Name', "theme_textdomain"); ?> <span class="required-message">*</span></label>
							<input type="text" name="cName" value="<?php if(isset($_POST['cName'])) echo $_POST['cName'];?>" id="cName" class="required" tabindex="1" />
							<?php if(isset($nameError) && $nameError == true ) { ?> 
								<span class="error"><?php _e('Please enter your name.', 'theme_textdomain'); ?></span>
							<?php } ?>
						</p>
						<p>
							<label for="cEmail"><?php _e('Email', "theme_textdomain"); ?> <span class="required-message">*</span></label>
							<input type="text" name="cEmail" value="<?php if(isset($_POST['cEmail'])) echo $_POST['cEmail'];?>" id="cEmail" class="required email" tabindex="2" />
							<?php if(isset($emailError) && $emailError == true ) { ?> 
								<span class="error"><?php _e('You entered an invalid email address.', 'theme_textdomain'); ?></span>
							<?php } ?>
						</p>
						<p>
							<label for="cComment"><?php _e('Comment', "theme_textdomain"); ?> <span class="required-message">*</span></label>
							<textarea name="cComment" id="cComment" class="required" cols="60" rows="7" tabindex="3"><?php if(isset($_POST['cComment'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['cComment']); } else { echo $_POST['cComment']; } } ?></textarea>		
							<?php if(isset($commentError) && $commentError == true ) { ?> 
								<span class="error"><?php _e('Please enter a message.', 'theme_textdomain'); ?></span>
							<?php } ?>			
						</p>
						<p>
							<input type="hidden" name="submitted" id="submitted" value="true" />
							<button class="blue-btn" type="submit" name="submit">
							    <span class="left"><span class="right"><?php _e('Submit Email', 'theme_textdomain'); ?></span></span>
							</button>
						</p>
					</fieldset>
				<!-- END #contact-form -->
				</form>
			<?php endif; ?>
		<!-- END .contact-wrap -->
		</div>
	<!-- END .center-wrap -->
	</div>
<!-- END #content -->
</div>

<?php get_footer(); ?>