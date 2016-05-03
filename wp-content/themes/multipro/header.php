<!DOCTYPE html>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php if (is_single() || is_page() ) : if (have_posts() ) : while (have_posts() ) : the_post(); ?>
	<meta name="description" content="<?php echo get_the_excerpt();?>">
	<?php endwhile; endif; elseif (is_home() ): ?>
	<meta name="description" content="Содружество веб-программистов и дизайнеров, настоящих профессионалов в своем деле.">
	<?php endif; ?>


	<title><?php wp_title(' - ', true, 'right'); ?></title>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/resources/css/bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/resources/css/blue.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/resources/css/prettyPhoto.css" type="text/css" media="screen" />
	
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic' rel='stylesheet' type='text/css' />
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/images/favicon.ico">

	<?php wp_head(); ?>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	(function (d, w, c) {
	    (w[c] = w[c] || []).push(function() {
	        try {
	            w.yaCounter26360910 = new Ya.Metrika({id:26360910,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true});
	        } catch(e) { }
	    });

	    var n = d.getElementsByTagName("script")[0],
	        s = d.createElement("script"),
	        f = function () { n.parentNode.insertBefore(s, n); };
	    s.type = "text/javascript";
	    s.async = true;
	    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

	    if (w.opera == "[object Opera]") {
	        d.addEventListener("DOMContentLoaded", f, false);
	    } else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="//mc.yandex.ru/watch/26360910" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
		
</head>

<!-- BEGIN body -->
<body <?php body_class(of_get_option('layout')); ?>>

		<a href="http://hevix.net" class="alarm_message">Finally launch day has arrived! Click here to open new Hevix!</a>
	
		<div id="header">
			<div class="container clearfix">
			
				<?php if(of_get_option('logo')){ ?>

					<div id="logo" class="clearfix">
							<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img class="img-responsive" src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					</div>
				<?php } ?>
			</div>
		<!-- END #header -->
		</div>
		
	<div id="sub-header" class="tagline-wrap">
	
		<div class="container">
					<?php uberMenu_easyIntegrate(); ?>
			</div>
	</div>

		<div class="grey-line"></div>
