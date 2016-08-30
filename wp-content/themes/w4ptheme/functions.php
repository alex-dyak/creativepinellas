<?php
/**
 * W4P Theme Functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

/**
 * Theme Setup.
 */
function w4ptheme_setup() {
	load_theme_textdomain( 'w4ptheme', get_template_directory() . '/languages' );
	add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	add_theme_support( 'post-formats', array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'quote',
			'status',
		)
	);
	register_nav_menu( 'primary', __( 'Navigation Menu', 'w4ptheme' ) );
	register_nav_menu( 'contacts', __( 'Contacts Menu', 'w4ptheme' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'w4ptheme' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'post_page_img', 650, 300, true );
        add_image_size( 'related_post_img', 280, 280, true );
        add_image_size( 'single_event_img', 650, 380, true );
        add_image_size( 'single_event_880x880', 880, 880, true );
		add_image_size( 'related_post_img', 280, 280, true );
		add_image_size( 'big_blog_img', 1480, 1480, true );
		add_image_size( 'small_blog_img', 880, 880, true );
		add_image_size( 'big_section_img', 960, 960, true );
		add_image_size( 'small_section_img', 480, 480, true );
        add_image_size( 'artist_gallery_300x300', 300, 300, true );
        add_image_size( 'artist_gallery_440x440', 440, 440, true );
        add_image_size( 'artist_gallery_600x250', 600, 250, true );
	}

}

add_action( 'after_setup_theme', 'w4ptheme_setup' );

//WP-PageNavi styles
add_filter( 'wp_pagenavi_class_previouspostslink', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_nextpostslink', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_page', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_larger', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_current', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_smaller', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_extend', 'theme_pagination_class' );

function theme_pagination_class( $class_name ) {
	switch ( $class_name ) {
		case 'previouspostslink':
			$class_name = 'prev page-numbers';
			break;
		case 'nextpostslink':
			$class_name = 'next page-numbers';
			break;
		case 'page':
			$class_name = 'page-numbers';
			break;
		case 'extend':
			$class_name = 'page-numbers dots';
			break;
		case 'smaller':
			$class_name = 'page-numbers';
			break;
		case 'current':
			$class_name = 'page-numbers current';
			break;
		case 'larger':
			$class_name = 'page-numbers';
			break;
	}

	return $class_name;
}

/**
 * Scripts & Styles.
 */
function w4ptheme_scripts_styles() {
	global $wp_styles;

	// Load Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Jquery
	wp_enqueue_script( 'w4ptheme-jquery', get_template_directory_uri() . '/js/vendor/jquery-ui.min.js', array(), NULL, TRUE );

	// Load Stylesheets.
	wp_enqueue_style( 'application.css', get_stylesheet_uri() );

	// Load scripts.
	wp_enqueue_script( 'w4ptheme-svgdefs', get_template_directory_uri() . '/js/custom/svgdefs.js', array( 'w4ptheme-jquery' ), NULL, TRUE );

	// Load mobile scripts.
	wp_enqueue_script( 'w4ptheme-gpb0qdz', "https://use.typekit.net/gpb0qdz.js", array(), NULL, TRUE );

	add_action('wp_footer', 'add_this_script_footer');

	// This is where we put our custom JS functions.
	wp_enqueue_script( 'w4ptheme-app', get_template_directory_uri() . '/js/app.min.js', array( 'w4ptheme-vendors' ), NULL, TRUE );

	// Vendors
	wp_enqueue_script( 'w4ptheme-vendors', get_template_directory_uri() . '/js/vendor.min.js', array(), NULL, TRUE );

    // Swipebox
    wp_enqueue_script( 'w4ptheme-swipebox', get_template_directory_uri() . '/js/vendor/jquery.swipebox.min.js', array(), NULL, TRUE );
}

add_action( 'wp_enqueue_scripts', 'w4ptheme_scripts_styles' );

/**
 * Function add script to footer.
 */
function add_this_script_footer(){ ?>
	<script>
		try {
			Typekit.load({
				async: true
			});
		} catch (e) {
		}
	</script>
<?php }


/**
 * WP Title.
 *
 * @param string $title Where something interesting takes place.
 * @param string $sep Separator string.
 *
 * @return string
 */
function w4ptheme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'w4ptheme' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'w4ptheme_wp_title', 10, 2 );

// Custom Menu.
register_nav_menu( 'primary', __( 'Navigation Menu', 'w4ptheme' ) );


/**
 * Navigation.
 */
function post_navigation() {
	echo '<section class="row column">';
	echo '<div class="postPageNavigation u-clearfix">';
	echo '	<div class="postNavigation-prev">' .  get_next_post_link( '%link', '&lt; Prev Post %title' ) . '</div>';
	echo '	<div class="postNavigation-next">' . get_previous_post_link( '%link', 'Next Post &gt;' ) . '</div>';
	echo '</div>';
	echo '</section>';
}

// Include theme options.
require_once( get_template_directory() . '/inc/options.php' );

// Widgets and Sidebars.
require_once( get_template_directory() . '/inc/widgets-sidebars.php' );

// Custom post types & Taxonomies.
require_once( get_template_directory() . '/inc/custom-post-types.php' );
require_once( get_template_directory() . '/inc/custom-taxonomies.php' );

// Filters and functions to manipulate content.
require_once( get_template_directory() . '/inc/filters.php' );

// Custom shortcodes.
require_once( get_template_directory() . '/inc/shortcodes.php' );

/**
 * Class Main_Nav_Menu
 */
class Main_Nav_Menu extends Walker_Nav_Menu {
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( $item->title == 'Contacts' ) {
			return;
		}

		if ( $args->has_children ) {
			$item->classes[] = 'has-subNav';
		}

		parent::start_el( $output, $item, $depth, $args );
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"u-list--plain\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

}

/**
 * Class Footer_Nav_Menu
 */
class Footer_Nav_Menu extends Walker_Nav_Menu {
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( $args->has_children ) {
			$item->classes[] = 'has-subNav';
		}

		parent::start_el( $output, $item, $depth, $args );
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"u-list--plain\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

}

/**
 * Class Mobile_Nav_Menu
 */
class Mobile_Nav_Menu extends Walker_Nav_Menu {
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( $args->has_children ) {
			$item->classes[] = 'has-subNav js-hasSubNav';
		}
		if ( $item->title == 'Contacts' ) {
			$item->classes[] = 'has-subNav js-hasSubNav';
		}

		parent::start_el( $output, $item, $depth, $args );
		if ( $args->has_children ) {
			$output = substr( $output, 0, - 4 );
			$output .= '<span class="siteNavigation-subNavToggle js-subNavToggle"></span></a>';
		}
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"u-list--plain js-subNav\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

}

/**
 * Add button in html-editor.
 */
add_action( 'admin_print_footer_scripts', 'add_intro_quicktags' );
function add_intro_quicktags() {
	if (wp_script_is('quicktags')) :
		?>
		<script type="text/javascript">
			if (QTags) {
				// QTags.addButton( id, display, arg1, arg2, access_key, title, priority, instance );
				QTags.addButton( 'div_intro', 'intro', '<div class="intro"><p>', '</p></div>', 'intro', 'Intro', 1 );
			}
		</script>
		<script type="text/javascript">
			if (QTags) {
				// QTags.addButton( id, display, arg1, arg2, access_key, title, priority, instance );
				QTags.addButton( 'recipients', 'recipients', '[resipients_list recipients=4]', 'recipients', 'Recipients', 1 );
			}
		</script>
	<?php endif;
}

/**
 * Add button in Visual-editor.
 */
function visual_intro_button()
{
	if ( current_user_can('edit_posts') && current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'visual_intro_plugin');
		add_filter('mce_buttons_3', 'visual_intro_register_button');
	}
}
add_action('init', 'visual_intro_button');

function visual_intro_plugin($plugin_array){
	$plugin_array['visual_intro'] = get_bloginfo('template_url').'/js/introbutton.js';
	return $plugin_array;
}

function visual_intro_register_button($buttons){
	array_push($buttons, "intro");

	return $buttons;
}

/**
 * Add recipients button in Visual-editor.
 */
function recipients_button()
{
	if ( current_user_can('edit_posts') && current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'recipients_plugin');
		add_filter('mce_buttons_3', 'recipients_register_button');
	}
}
add_action('init', 'recipients_button');

function recipients_plugin($plugin_array){
	$plugin_array['recipients'] = get_bloginfo('template_url').'/js/recipientsbutton.js';
	return $plugin_array;
}

function recipients_register_button($buttons){
	array_push($buttons, "recipients");

	return $buttons;
}

/**
 * Validate custom field vanue_tel.
 */
function acf_validate_value_tel_field( $valid, $value, $field, $input ){
    if( !$valid ) {
        return $valid;
    }
    // valid telephone data, format (000) 000-0000.
    $pattern = '/^\(\d{3}\)\s\d{3}-\d{4}/';
    if( preg_match($pattern, $value)  == FALSE | preg_match($pattern, $value)  == 0 ) {

        $valid = __('Incorrect phone number, correct format to (000) 000-0000', 'w4ptheme') ;

    }
    return $valid;
}
add_filter('acf/validate_value/name=venue_tel', 'acf_validate_value_tel_field', 10, 4);

/**
 * Get related events in location page.
 */
function get_related_events($location_id){
    $events_count = EM_Events::count( array('location'=>$location_id, 'scope'=>'future') );
    if ( $events_count > 0 ) {
        $args = array('location' => $location_id, 'scope' => 'future', 'pagination' => 1, 'ajax' => 0);
        $args['format_header'] = get_option('dbem_location_event_list_item_header_format');
        $args['format_footer'] = get_option('dbem_location_event_list_item_footer_format');
        $args['format'] = get_option('dbem_location_event_list_item_format');
        $args['limit'] = get_option('dbem_location_event_list_limit');
        $args['page'] = (!empty($_REQUEST['pno']) && is_numeric($_REQUEST['pno'])) ? $_REQUEST['pno'] : 1;
        return $replace = EM_Events::get($args);
    }
}


function the_excerpt_max_charlength( $charlength ){
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '(...)';
	} else {
		echo $excerpt;
	}
}
