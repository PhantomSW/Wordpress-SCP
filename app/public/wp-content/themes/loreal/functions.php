<?php
/**
 * loreal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package loreal
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

// ----------------------------------------------------------
// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// L'en tête du site prends automatiquement le nom du site
add_theme_support( 'title-tag' );

// Pour ajouter des emplacements de menus
register_nav_menus( array(
	'main' => 'Menu Principal',
	'footer' => 'Bas de page',
) );

// Pour ajouter des emplacements de sidebar
register_sidebar( array(
	'id' => 'blog-sidebar',
	'name' => 'Blog',
	'before_widget'  => '<div class="site__sidebar__widget %2$s">', // remplacer les <li> (défault) par des <div>
	'after_widget'  => '</div>',
	'before_title' => '<p class="site__sidebar__widget__title">', // remplacer les h2 (défault) par des <p>
	'after_title' => '</p>',
  ) );

  function capitaine_register_post_types() {
	
    
    
    // Déclaration de la Taxonomie
    $labels = array(
        'name' => 'Type de projets',
        'new_item_name' => 'Nom du nouveau Projet',
    	'parent_item' => 'Type de projet parent',
    );
    
    $args = array( 
        'labels' => $labels,
        'public' => true, 
        'show_in_rest' => true,
        'hierarchical' => true, 
    );
	register_post_type( 'portfolio', $args );
    register_taxonomy( 'type-projet', 'portfolio', $args );
}
add_action( 'init', 'capitaine_register_post_types' );

// Déclaration des Custom Post Types et Taxonomies
function loreal_register_post_types() {

	// CPT Portfolio
	$labels = array(
		'name' => 'Portfolio',
		'all_items' => 'Tous les projets',  // affiché dans le sous menu
		'singular_name' => 'Projet',
		'add_new_item' => 'Ajouter un projet',
		'edit_item' => 'Modifier le projet',
		'menu_name' => 'Portfolio'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_rest' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor','thumbnail' ),
		'menu_position' => 5, 
		'menu_icon' => 'dashicons-admin-customizer',
	);

	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'loreal_register_post_types' );

//-----------------------------------------------------------

function loreal_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on loreal, use a find and replace
		* to change 'loreal' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'loreal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'loreal' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'loreal_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'loreal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function loreal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'loreal_content_width', 640 );
}
add_action( 'after_setup_theme', 'loreal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function loreal_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'loreal' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'loreal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'loreal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function loreal_scripts() {
	wp_enqueue_style( 'loreal-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'loreal-style', 'rtl', 'replace' );

	wp_enqueue_script( 'loreal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'loreal_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

