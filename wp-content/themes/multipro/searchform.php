<!--BEGIN #searchform-->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
		<input type="text" name="s" id="s" class="s" placeholder="Поиск по сайту" />
		<button class="blue-minibtn" type="submit" name="submit">
		    <span class="left"><span class="right"><?php _e('Найти', 'theme_textdomain'); ?></span></span>
		</button>
<!--END #searchform-->
</form>