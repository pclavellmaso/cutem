<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cutem_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cutem' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cutem' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
        array(
            'name' => 'Footer_Logo',
            'id' => 'Footer_Logo',
                    'before_title'  => '<span class="widgettitle d-block">',
                    'after_title'   => '</span>',
    ));

	register_sidebar(
        array(
            'name' => 'Footer_1',
            'id' => 'Footer_1',
                    'before_title'  => '<span class="widgettitle d-block">',
                    'after_title'   => '</span>',
    ));

	register_sidebar(
        array(
            'name' => 'Footer_2',
            'id' => 'Footer_2',
                    'before_title'  => '<span class="widgettitle d-block">',
                    'after_title'   => '</span>',
	));

	register_sidebar(
        array(
            'name' => 'Footer_3',
            'id' => 'Footer_3',
                    'before_title'  => '<span class="widgettitle d-block">',
                    'after_title'   => '</span>',
	));

	register_sidebar(
        array(
            'name' => 'Footer_4',
            'id' => 'Footer_4',
                    'before_title'  => '<span class="widgettitle d-block">',
                    'after_title'   => '</span>',
    ));

	register_sidebar(
        array(
            'name' => 'Nav_header',
            'id' => 'Nav_header',
                    'before_widget'  => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'   => "</div>",
                    'before_title'  => '<span class="widgettitle close-minicart d-flex w-100 justify-content-between align-items-center fs-1 mb-4">',
                    'after_title'   => '</span>',
	));

}
add_action( 'widgets_init', 'cutem_widgets_init' );