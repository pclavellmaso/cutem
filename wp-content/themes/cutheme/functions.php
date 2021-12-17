<?php
/**
 * Santa i cole functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package santa_cole
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'santa_cole_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function santa_cole_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Santa i cole, use a find and replace
		 * to change 'santa-cole' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'santa-cole', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'santa-cole' ),
				'menu-2' => esc_html__( 'Secondary', 'santa-cole' ),
				'menu-3' => esc_html__( 'Mobile', 'santa-cole' ),
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
				'santa_cole_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'santa_cole_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function santa_cole_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'santa_cole_content_width', 1200 );
}
add_action( 'after_setup_theme', 'santa_cole_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function santa_cole_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'santa-cole' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'santa-cole' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(array(
        'name' => 'Footer_Logo',
        'id' => 'Footer_Logo',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
    ));
	register_sidebar(array(
        'name' => 'Footer_1',
        'id' => 'Footer_1',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
    ));
	register_sidebar(array(
        'name' => 'Footer_2',
        'id' => 'Footer_2',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
	));
	register_sidebar(array(
        'name' => 'Footer_3',
        'id' => 'Footer_3',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
	));
	register_sidebar(array(
        'name' => 'Footer_4',
        'id' => 'Footer_4',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
    ));
	register_sidebar(array(
        'name' => 'Shop_1',
        'id' => 'Shop_1',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
	));
	register_sidebar(array(
        'name' => 'Shop_2',
        'id' => 'Shop_2',
				'before_title'  => '<span class="widgettitle d-block">',
				'after_title'   => '</span>',
	));
	register_sidebar(array(
        'name' => 'Nav_header',
        'id' => 'Nav_header',
				'before_widget'  => '<div id="%1$s" class="widget %2$s">',
				'after_widget'   => "</div>",
				'before_title'  => '<span class="widgettitle close-minicart d-flex w-100 justify-content-between align-items-center fs-1 mb-4">',
				'after_title'   => '</span>',
	));

}
add_action( 'widgets_init', 'santa_cole_widgets_init' );

/* COMPATIBILIDAD CON YOAST */
add_theme_support( 'yoast-seo-breadcrumbs' );

/**
 * Embed Google Fonts
 */
require get_template_directory() . '/inc/embed-fonts.php';

/**
 * Embed Modular CSS
 */
require get_template_directory() . '/inc/embed-styles.php';

/**
 * Embed JS Scripts
 */
require get_template_directory() . '/inc/embed-scripts.php';

/**
 * add last nav item
 */
require get_template_directory() . '/inc/add-last-nav-item.php';

/**
 * Enqueue scripts and styles.
 */
function santa_cole_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	  wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'santa_cole_scripts' );

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
 * Bootstrap Navwalker.
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Custom CPTs
 */
require get_template_directory() . '/inc/custom-cpt.php';

/**
 * Custom CPTs
 */
require get_template_directory() . '/inc/custom-search.php';

/**
 * Embed Video using iFrame
 */
require get_template_directory() . '/inc/embed-video.php';

/**
 * Add ALT to images
 */
require get_template_directory() . '/inc/alt-images.php';

/**
 * Custom Admin menu
 */
require get_template_directory() . '/inc/custom-backoffice.php';

/**
 * Custom Breadcrumbs
 */
require get_template_directory() . '/inc/custom-breadcrumbs.php';

/**
 * Custom Woo Sidebar Categories
 */
require get_template_directory() . '/inc/custom-woo-sidebar-categories.php';

/**
 * Dynamic Tags
 */
require get_template_directory() . '/inc/dynamic-tags.php';

/**
 * Etiquetado de los medios
 */
require get_template_directory() . '/inc/tags-attachment.php';

/**
 * embeb mapa
 *
 */
require get_template_directory() . '/inc/embed-map.php';

/**
 * Página de opciones
 */
require get_template_directory() . '/inc/options-theme.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom WPML
 */
require get_template_directory() . '/inc/custom-wpml.php';


/**
 * ROLES DE USUARIOS PERSONALIZADOS Y PERMISOS Y PRIVILEGIOS
 */
require get_template_directory() . '/inc/custom-users.php';


/**
 * SHORTCODES PERSONALIZADOS
 */
require get_template_directory() . '/inc/shortcodes.php';

function print_r2($val) {
  echo '<pre>';
  print_r($val);
  echo  '</pre>';
}
