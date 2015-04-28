<?php
/*
Bootpress Functions
*/
global $bootpress_settings;
$bootpress_settings = get_option( "bootpress_settings" ); // site options
$defaults = array(
	"style" => "cerulean",
	"default_style" => "cerulean",
	"version" => "1.2"
);
$bootpress_settings = wp_parse_args($bootpress_settings, $defaults);
if ( ! isset( $content_width ) ) $content_width = 900;
function bootpress_setup() {
	load_theme_textdomain( 'bootpress', get_template_directory() . '/lang' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	//add custom menu
	register_nav_menus(array('primary'=>'Bootpress Top Menu','footer'=>'Bootpress Footer Menu'));

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	//add_theme_support( 'custom-background', array('default-color' => 'FFFFFF') );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'bootpress_setup' );
//bootpress title
function bootpress_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bootpress' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'bootpress_wp_title', 10, 2 );
add_filter('get_avatar','bootpress_avatar');
function bootpress_avatar($class) {
$class = str_replace("class='avatar", "class='avatar img-thumbnail", $class) ;
return $class;
}
//Enque Scripts and styles
   function bootpress_theme_stylesheets()
    {
		global $bootpress_settings;
        wp_register_style('bootstrap3', get_template_directory_uri() . '/dist/css/'.$bootpress_settings["style"]. '.min.css', array(), $bootpress_settings['version'], 'all' );
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array('bootstrap3'), '1', 'all' );
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/dist/js/bootstrap.min.js',array( 'jquery' ),$bootpress_settings['version'],true );
		wp_enqueue_script('bootpress-js', get_template_directory_uri() . '/js/bootpress.js',array( 'jquery' ),$bootpress_settings['version'],true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
    }
    add_action('wp_enqueue_scripts', 'bootpress_theme_stylesheets');
	add_action ("wp_footer", "bootpress_init_footer",1);
	function bootpress_init_footer() {
		?>
		<div id="visible-lg" class="visible-lg"></div>
		<div id="visible-md" class="visible-md"></div>
		<div id="visible-sm" class="visible-sm"></div>
		<div id="visible-xs" class="visible-xs"></div>
		<?php
	}
		add_action ("wp_head", "bootpress_init_head",11);
	function bootpress_init_head() {
		?>
		<script type="text/javascript">
			function visible_lg(){ return (jQuery("#visible-lg").css("display") === "block") ? true : false; }
			function visible_md(){ return (jQuery("#visible-md").css("display") === "block") ? true : false; }
			function visible_sm(){ return (jQuery("#visible-sm").css("display") === "block") ? true : false; }
			function visible_xs(){ return (jQuery("#visible-xs").css("display") === "block") ? true : false; }
			
			// http://remysharp.com/2010/07/21/throttling-function-calls/
			function throttle(d,a,h){a||(a=250);var b,e;return function(){var f=h||this,c=+new Date,g=arguments;b&&c<b+a?(clearTimeout(e),e=setTimeout(function(){b=c;d.apply(f,g)},a)):(b=c,d.apply(f,g))}};
        </script>
		<?php
	}
//register sidebar
function bootpress_register_sidebars(){
register_sidebar(array(
  'name' => __( 'Right Hand Sidebar','bootpress' ),
  'id' => 'right-sidebar',
  'description' => __( 'Widgets in this area will be shown on the right-hand side.','bootpress' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>' ));
}
add_action( 'widgets_init', 'bootpress_register_sidebars' );
//bs3 menu
class wp_bootstrap_navwalker extends Walker_Nav_Menu {

      function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
	  if($depth >= 1){
 	   $output .= "\n<ul class=\"dropdown-menu submenu\">\n";
	  } else {
	   $output .= "\n<ul class=\"dropdown-menu\">\n";
	  }
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
      $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);    
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }   

    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = !empty($children_elements[$element->ID]);

    if ($element->is_dropdown) {
      if ($depth === 0) {
        $element->classes[] = 'dropdown';
      } elseif ($depth === 1) {
        $element->classes[] = 'dropdown have-submenu';
      }
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}
function bootpress_roots_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-' . $slug;

  $classes = array_unique($classes);

  return array_filter($classes, 'bootpress_is_element_empty');
}

add_filter('nav_menu_css_class', 'bootpress_roots_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');
function bootpress_is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}
//fallback_cb
function bootpress_link_to_menu_editor( $args )
{
    if ( ! current_user_can( 'manage_options' ) )
    {
        return;
    }

    // see wp-includes/nav-menu-template.php for available arguments
    extract( $args );

    $link = $link_before
        . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>'
        . $link_after;

    // We have a list
    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }

    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ( $echo )
    {
        echo $output;
    }

    return $output;
}
//credit links
function bootpress_credits() {
	printf(
		'<span id="credits" class="text-left">&copy; %1$s <a href="%2$s">%3$s</a>, all rights reserved. Powered by <a href="http://wordpress.org">WordPress</a> and <a href="http://99webtools.com/bootpress.html" rel="designer">Bootpress</a> Theme</span>',
		date( 'Y' ),
		home_url( '/' ),
		get_bloginfo( 'name' )
	);
}
//search format
function bootpress_search_form( $form ) {
    $form = '<form role="form" method="get" id="searchform" class="searchform form" action="' . home_url( '/' ) . '" >
    <div class="input-group input-group-sm">
    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="' . __( 'Search for','bootpress' ) . '" >
	<span class="input-group-btn">
    <button type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','bootpress' ) .'" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
	</span>
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'bootpress_search_form' );

if ( ! function_exists( 'bootpress_content_nav' ) ) :
function bootpress_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
		<ul class="pager">
			<li class="previous"><?php next_posts_link( __( '<span class="glyphicon glyphicon-arrow-left"></span> Older posts', 'bootpress' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="glyphicon glyphicon-arrow-right"></span>', 'bootpress' ) ); ?></li>
			</ul>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;
//entry meta
if ( ! function_exists( 'bootpress_entry_meta' ) ) :
function bootpress_entry_meta()  {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span><span class="glyphicon glyphicon-pushpin"></span><strong>' . __( 'Sticky', 'bootpress' ) . '</strong></span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		bootpress_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list(', ');
	if ( $categories_list ) {
		echo '<span class="categories-links"><span class="glyphicon glyphicon-folder-open"></span> ' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		echo '<span class="tags-links"><span class="glyphicon glyphicon-tag"></span> ' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><span class="glyphicon glyphicon-user"></span> <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'bootpress' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;
if ( ! function_exists( 'bootpress_entry_date' ) ) :
function bootpress_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'bootpress' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><span class="glyphicon glyphicon-time"></span> <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'bootpress' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;
//comment
if ( ! function_exists( 'bootpress_comment' ) ) :
function bootpress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'bootpress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bootpress' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment clearfix">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 100 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span class="label label-default">' . __( 'Post author', 'bootpress' ) . '</span> ' : ''
					);
					printf( '<div class="text-muted"><a href="%1$s" >#</a><time datetime="%2$s">%3$s</time><div>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'bootpress' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bootpress' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( '<span class=" glyphicon glyphicon-pencil"></span> Edit', 'bootpress' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply text-right">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'bootpress' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
//theme custmizer
$bootpress_settings["styles"] = array(
	"default" => esc_attr__( 'Default', 'bootpress' ),		//0
	"amelia" => esc_attr__( 'Amelia', 'bootpress' ),		//1
	"cerulean" => esc_attr__( 'Cerulean', 'bootpress' ),	//2
	"cosmo" => esc_attr__( 'Cosmo', 'bootpress' ),			//3
	"cyborg" => esc_attr__( 'Cyborg', 'bootpress' ),		//4
	"flatly" => esc_attr__( 'Flatly', 'bootpress' ),		//13
	"journal" => esc_attr__( 'Journal', 'bootpress' ),		//5
	"readable" => esc_attr__( 'Readable', 'bootpress' ),	//6
	"simplex" => esc_attr__( 'Simplex', 'bootpress' ),		//7
	"slate" => esc_attr__( 'Slate', 'bootpress' ),			//8
	"spacelab" => esc_attr__( 'Spacelab', 'bootpress' ),	//9
	"united" => esc_attr__( 'United', 'bootpress' ),		//12
);
		
$bootpress_styles_url_default = get_template_directory_uri() . '/dist/css/';
$bootpress_settings["styles_url"] = array(		
	"default" => $bootpress_styles_url_default. "default",		//0
	"amelia" => $bootpress_styles_url_default. "amelia",		//1
	"cerulean" => $bootpress_styles_url_default. "cerulean",	//2
	"cosmo" => $bootpress_styles_url_default. "cosmo",			//3
	"cyborg" => $bootpress_styles_url_default. "cyborg",		//4
	"flatly" => $bootpress_styles_url_default. "flatly",		//13
	"journal" => $bootpress_styles_url_default. "journal",		//5
	"readable" => $bootpress_styles_url_default. "readable",	//6
	"simplex" => $bootpress_styles_url_default. "simplex",		//7
	"slate" => $bootpress_styles_url_default. "slate",			//8
	"spacelab" => $bootpress_styles_url_default. "spacelab",	//9
	"united" => $bootpress_styles_url_default. "united",		//12
);

if (class_exists("WP_Customize_Control")){
	class Bootpress_Customize_ImageOptions_Control extends WP_Customize_Control {
		public $type = 'imageoptions';
	 
		public function render_content() {
			if ( empty( $this->choices ) )
				return;
				
			global $bootpress_settings;

			$name = '_customize-imageoptions-' . $this->id;

			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
			foreach ( $this->choices as $value => $label ) :
				$selected = "";
				if ($this->value() == $value) $selected = "of-radio-img-selected"; 
				
				if(!isset($bootpress_settings["thumbnail_url"][esc_attr( $value )]))
					$bootpress_settings["thumbnail_url"][esc_attr( $value )] = $bootpress_settings["styles_url"][esc_attr( $value )];
				?>
				<label class="of-radio-img-lable">
                        <input type="radio" id="<?php echo esc_attr( $value ); ?>" class="of-radio-img-radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php if ($this->value() == $value){ ?>
                            <div class="of-radio-img-label selected"><i class="icon-ok"></i> <?php echo esc_html( $label ); ?></div>                          
							<?php } else {?>
                            <div class="of-radio-img-label"><?php echo esc_html( $label ); ?></div>
                            <?php } ?>
							<img src="<?php echo $bootpress_settings["thumbnail_url"][esc_attr( $value )]; ?>.png" alt="<?php echo esc_attr( $name ); ?>" class="of-radio-img-img <?php echo $selected; ?>"  />
				</label>
				<?php
			endforeach;
		}
	}
}
function bootpress_register_theme_customizer( $wp_customize ) {
global $bootpress_settings;
$wp_customize->add_section( 'bootpress' , array(
    'title'      => 'Bootstrap Theme',
    'priority'   => 30,
) );
 
 // Theme Style
			$wp_customize->add_setting( 'bootpress_settings[style]', array(
				'default' => 'united',
				'type' => 'option',
				'transport'         => 'postMessage'
			) );			 
			$wp_customize->add_control( new Bootpress_Customize_ImageOptions_Control( $wp_customize, 'bootpress_settings[style]', array(
				'label' => esc_attr__( 'Theme Style', 'bootpress' ),
				'section' => 'bootpress',
				'type' => 'imageoptions',
				'settings'=>'bootpress_settings[style]',
				'priority' => '20',
				'choices' => $bootpress_settings["styles"],
			) ) );	
}
add_action( 'customize_register', 'bootpress_register_theme_customizer' );

add_action( 'customize_preview_init', "bootpress_preview_init" );
function bootpress_preview_init() {
	wp_enqueue_script( 'customizer-panel', get_template_directory_uri() . '/js/customizer-panel.js', array( 'jquery','customize-preview' ) );

}
add_action( 'customize_controls_print_styles', "bootpress_customizer_print_styles" );
function bootpress_customizer_print_styles() {
wp_enqueue_style( 'bootpress_customizer', get_template_directory_uri() . '/css/customizer.css' );
}
?>