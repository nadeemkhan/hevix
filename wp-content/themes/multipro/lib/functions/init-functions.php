<?php
/*******************************************************************/
//						REGISTER SIDEBARS
/*******************************************************************/

if (function_exists('register_sidebar')){
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Main Page Widget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Single Article Page Widget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Search',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

/************************************************************/
//						WP 2.9+ THUMBNAILS
/************************************************************/

if ( function_exists( 'add_theme_support' ) ) { // WP 2.9+
	    add_theme_support( 'post-thumbnails' );
	    set_post_thumbnail_size( 220, 150, true ); // featured image
	    add_image_size('imagen_grande', 630, 230, true); // post image
	    add_image_size('imagen_slider', 950, 325, true); // slider image
	    add_image_size('imagen_portafolio', 300, 160, true); // posrtfolio image
	}

/*******************************************************************/
//						WP 3.0+ MENUS
/*******************************************************************/

function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' )
		)
	);
}

add_action('init', 'register_my_menus');


/*******************************************************************/
//						EXCERPT LENGTH
/*******************************************************************/

function change_excerpt_length($length) {
	return 30; 
}
add_filter('excerpt_length', 'change_excerpt_length');


/*******************************************************************/
//						CUSTOM COMMENTS
/*******************************************************************/

function custom_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div class="grey-bg">
	     <div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="comment-author vcard">
		         <?php echo get_avatar($comment,$size='60'); ?>
		    </div>
			<div class="comment-content">
				<?php if ($comment->comment_approved == '0') : ?>
					<span class="required-message"><?php _e('Your comment is awaiting moderation.') ?></span>
				<?php endif; ?>
			    <div class="comment-meta commentmetadata">
			    	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
			    	<span class="date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
			    </div>
			    <div class="comment-body">
			    	<?php comment_text() ?>
			    </div>
				<div class="reply">
			         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
	      	</div>	
		</div>
	</div>
<?php
}

/*******************************************************************/
//						PRIMARY MENU
/*******************************************************************/

class custom_nav_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth, $args){
		global $wp_query;
        $indent = ( $depth ) ? str_repeat( "", $depth ) : '';
	    $class_names = $value = '';
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	    $class_names = ' class="'. esc_attr( $class_names ) . '"';
	    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	    $prepend = '';
	    $append = '';
 	    $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
	    if($depth != 0){
	    	$description = $append = $prepend = "";
	    }
	    $item_output = $args->before;
	    $item_output .= '<a'. $attributes .'><span>';
	    $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	    $item_output .= '</span></a>';
 	    $item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/*******************************************************************/
//						PORTFOLIO CATEGORIES
/*******************************************************************/

class filterable_portfolio_walker extends Walker_Nav_Menu{
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all posts filed under %s' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>'. $cat_name .'</a>';
      $output .= '<li class="cat-item '.strtolower(preg_replace('/\s+/', '-', $cat_name)). '">' .$link;
   }
} 



/*******************************************************************/
//						REGISTER & LOAD COMMON JS
/*******************************************************************/

/* register js & load default scripts */
function register_my_javascript(){
	if(!is_admin()){
		/* deregister */
		wp_deregister_script('jquery');
		
		/* register */
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
		wp_register_script('validation', 'http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js', 'jquery');
		wp_register_script('nivoSlider', get_template_directory_uri() . '/resources/js/jquery.nivo.slider.js', 'jquery');
		wp_register_script('ciclePlugin', get_template_directory_uri() . '/resources/js/cycle-plugin.js', 'jquery');
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/resources/js/jquery.prettyPhoto.js', 'jquery');
		wp_register_script('superfish', get_template_directory_uri() . '/resources/js/superfish.js', 'jquery');
		wp_register_script('selectivizr', get_template_directory_uri() . '/resources/js/selectivizr.js', 'jquery');
		wp_register_script('easing', get_template_directory_uri() . '/resources/js/easing.js', 'jquery');
		wp_register_script('quicksand', get_template_directory_uri() . '/resources/js/quicksand.js', 'jquery');
		wp_register_script('custom', get_template_directory_uri() . '/resources/js/custom.js', 'jquery', '1.0', TRUE);
		
		/* enqueue */
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('prettyPhoto');
		wp_enqueue_script('custom');
	}
}
add_action('init', 'register_my_javascript');

// load IE scripts
function ie_scripts() {
	global $is_IE;
	if($is_IE) wp_enqueue_script('selectivizr');
}
add_action('wp_print_scripts', 'ie_scripts');

/* if is home */
function home_scripts(){
	if(is_page_template('template-home.php')){
		wp_enqueue_script('ciclePlugin');
	}
}
add_action('wp_print_scripts', 'home_scripts');

/* cycle plugin - home template */
function home_cycle(){
	if (is_page_template('template-home.php')) { ?>
		<script type="text/javascript">
		$(document).ready(function() {
		    $('#slideshow')
		     .after('<div id="slider-nav" class="clearfix">')
		     .cycle({
				fx:     '<?php echo of_get_option("home_transition_effect"); ?>',
				<?php if( of_get_option("home_slider_autoplay") ) echo "timeout:".of_get_option("home_slider_autoplay").","; 
				else echo "timeout:0,"; ?> 
				pause:   true,
				pager:  '#slider-nav',
				containerResize: 0 
			});
		});		
		</script>
	<?php }	
}
add_action('wp_head', 'home_cycle');

/* if is blog */
function blog_scripts(){
	if( (is_home() && is_front_page()) || (is_home() && !is_front_page()) || (is_page_template('template-magazine.php')) ){
		wp_enqueue_script('nivoSlider');
	}
}
add_action('wp_print_scripts', 'blog_scripts');

/* nivoSlider - Blog */
function blog_nivo(){ 
	if( (is_home() && is_front_page()) || (is_home() && !is_front_page()) || (is_page_template('template-magazine.php')) ){ ?>
	<script type="text/javascript">
	$(window).load(function() {
	    $('#slider').nivoSlider({
	        effect:'<?php echo of_get_option("blog_transition_effect"); ?>', // Specify sets like: 'fold,fade,sliceDown...'
	        slices: <?php echo of_get_option("blog_slider_number"); ?>,
	        <?php if( of_get_option("blog_slider_autoplay") != '' ) echo "pauseTime:".of_get_option("blog_slider_autoplay");
	       	else echo "manualAdvance:true" ?>
	    });
	});
	</script>	
<?php } 
}
add_action('wp_footer', 'blog_nivo');

/* if is contact template */
function contact_scripts() {
	if (is_page_template('template-contact.php')){ 
		wp_enqueue_script('validation');
	}
}
add_action('wp_print_scripts', 'contact_scripts');

/* validation plugin - contact template */
function contact_validate() {
	if (is_page_template('template-contact.php')) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#contactForm").validate();
			});
		</script>
	<?php }
}
add_action('wp_head', 'contact_validate');

/* if is portfolio template */
function portfolio_scripts(){
	if( is_page_template('template-portfolio-two-columns.php') || is_page_template('template-portfolio-three-columns.php') || is_page_template('template-portfolio-four-columns.php') ){
		wp_enqueue_script('easing');
		wp_enqueue_script('quicksand');
	}
}
add_action('wp_print_scripts', 'portfolio_scripts');


/* if is single-portfolio */
function single_portfolio_scripts(){
	if( is_single() && get_post_type() == 'portfolio' ){
		wp_enqueue_script('nivoSlider');
	}
}
add_action('wp_print_scripts', 'single_portfolio_scripts');

/* nivoSlider - Blog */
function portfolio_nivo(){ 
	if( is_single() && get_post_type() == 'portfolio' ){ ?>
	<script type="text/javascript">
	$(window).load(function() {
	    $('#slider').nivoSlider({
	        effect:'<?php echo of_get_option("portfolio_transition_effect"); ?>', // Specify sets like: 'fold,fade,sliceDown...'
	        <?php if( of_get_option("portfolio_slider_autoplay") != '' ) echo "pauseTime:".of_get_option("portfolio_slider_autoplay");
	        else echo "manualAdvance:true" ?>
	    });
	});
	</script>	
<?php } 
}
add_action('wp_footer', 'portfolio_nivo');

/* add shortcode list script */
function button_js() {
	echo '<script type="text/javascript">
	jQuery(document).ready(function(){
	   jQuery("#sc_select").change(function() {
			  send_to_editor(jQuery("#sc_select :selected").val());
        		  return false;
		});
	});
	</script>';
}
add_action('admin_head', 'button_js');

/*******************************************************************/
//						REGISTER & LOAD STYLES
/*******************************************************************/

// register styles
function register_my_styles(){
	if(!is_admin()){
		wp_register_style('nivo-slider', get_template_directory_uri() . '/resources/css/nivo-slider.css');
		wp_register_style('pagenavi', get_template_directory_uri() . '/resources/css/pagenavi.css');
	}
}
add_action('init', 'register_my_styles');

//add nivo slider style
function nivo_slider_style(){
	if( (is_home() && is_front_page()) || (is_home() && !is_front_page()) || (is_page_template('template-magazine.php')) || (is_single() && get_post_type() == 'portfolio')  ){
		wp_enqueue_style('nivo-slider');
	}
}
add_action('wp_print_styles', 'nivo_slider_style');

//add pagenavi style
function pagenavi_style(){
	if( function_exists('wp_pagenavi') ){
		wp_enqueue_style('pagenavi');
	}
}
add_action('wp_print_styles', 'pagenavi_style');

/*******************************************************************/
//						ADD POST CLASS
/*******************************************************************/

// add .grey-bg to all posts
function grey_bg_class($classes){
	$classes[] = 'grey-bg';
	return $classes;
}
add_filter('post_class', 'grey_bg_class');

/*******************************************************************/
//						CUSTOM CSS OPTION
/*******************************************************************/

function add_custom_css(){
	if( of_get_option('custom_css') != '' ){
		echo "<!-- Custom Styling -->\n<style type=\"text/css\">\n".of_get_option('custom_css')."\n</style>\n";
	}
}
add_action('wp_head', 'add_custom_css');

/*******************************************************************/
//						ADD SHORTCODES LIST
/*******************************************************************/

function add_sc_select(){
    global $shortcode_tags;
    $exclude = array();
    echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
    foreach ($shortcode_tags as $key => $val){
	    if(!in_array($key,$exclude)){
            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
    	    }
        }
     echo $shortcodes_list;
     echo '</select>';
}
add_action('media_buttons','add_sc_select',11);

/*******************************************************************/
//						EMAIL ENCODE
/*******************************************************************/

function mail_utf8($to, $subject = '(No subject)', $message = '', $header = '') {
  $header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
  mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_ . $header);
}

/*******************************************************************/
//						GET THUMBNAILS URL
/*******************************************************************/

function get_thumbnail_url(){
	$image_id = get_post_thumbnail_id();  
	$image_url = wp_get_attachment_image_src($image_id,'large');  
	return $image_url[0];
} 

/*******************************************************************/
//						LOAD THEME TEXTDOMAIN
/*******************************************************************/

load_theme_textdomain ( 'theme_textdomain', TEMPLATEPATH . '/lang' );
?>