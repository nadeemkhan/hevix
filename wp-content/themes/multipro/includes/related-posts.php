	<?php if( of_get_option('related_post_type') == 'category' ) : ?>
	
		<?php
		global $post;
		$categories = get_the_category($post->ID);
		
		if ($categories) :
		    $cat_ids = array();
		    foreach($categories as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
		
		    $args=array(
		            'category__in' => $cat_ids,
		            'post__not_in' => array($post->ID),
		            'posts_per_page'=> of_get_option('related_post_number'),
		        	);
		endif; ?>
		
	<?php else: ?>
	
		<?php
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) :
		    $tag_ids = array();
		    foreach($tags as $individual_tag){ $tag_ids[] = $individual_tag->term_id;}
		
		    $args=array(
		    	'tag__in' => $tag_ids,
		        'post__not_in' => array($post->ID),
		        'posts_per_page' => of_get_option('related_post_number'),
		   		);
		    $my_query = new wp_query($args);
		        
		endif; ?>
		
	<?php endif; ?>
	
	<?php query_posts($args); ?>
	
	<?php if( have_posts() ){ ?>    
	
		<!-- BEGIN #related-posts -->
		<div id="related-posts" class="clearfix">
			<ul>
				
				<?php while (have_posts()) : the_post(); ?>
					<?php if( has_post_thumbnail() ) : ?>		
						<li>
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php resize_img("width=135&height=80"); ?></a>
							</div>
						</li>
					<?php endif; ?>
				<?php endwhile; wp_reset_query(); ?>		
		
			</ul>
		<!-- END #related-posts -->
		</div>
		
	<?php } ?>