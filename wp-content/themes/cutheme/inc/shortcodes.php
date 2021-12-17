<?php


/* SHORTCODE PARA COMUNICACIONES */

add_shortcode( 'comunicaciones', 'comunicaciones_users' );
function salcodes_init(){
function comunicaciones_users() {
     
    $args = array(  
        'posts_per_page' => -1,
        'post_type' => 'comunicacion',
        'orderby' => 'date',
        'order' => 'ASC',

    );
    $wp_query = new WP_Query( $args );
    $counterr =1;
    $content = '';
    while ( $wp_query->have_posts() ) : $wp_query->the_post();
    $content .= '<section><div class="container-fluid py-4 border-bottom border-color-grey"><div class="row"><div class="col-lg-4 pl-0 pr-lg-3 pr-0 mb-lg-0 mb-3">';
    $content .= get_the_post_thumbnail();
    $content .= '</div><div class="col-lg-8 d-flex align-items-center pl-lg-3 pl-0 pr-0"><div><h3 class="fs-12 fw-400 mb-lg-4">'.get_the_title() .'</h3>';
    $content .= '<p class="mb-lg-4">'. get_field('texto_comunicacion')  .'</p>';
    $content .= '<a class="button button-outline-black d-inline-block px-lg-5" href="'.get_the_permalink().'">'. __('Ver más', 'santa-cole') .'</a></div></div></div></div></section>';
    endwhile;
    $content .= wp_reset_query();
    return $content;
 }
}
add_action('init', 'salcodes_init');



