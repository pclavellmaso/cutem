<?php
/**
 * Embed Scripts
 *
 * @package santa-cole
 */

/* ------------- Embed JS Scripts */
function include_scripts() {
  
 // wp_enqueue_script ('jquery', get_template_directory_uri() . '/dist/js/jquery-3.5.1.slim.min.js', array('jquery'), '', true);
  wp_enqueue_script ('popper', get_template_directory_uri() . '/dist/js/popper.min.js', array('jquery'), '', true);
  wp_enqueue_script ('bs-js', get_template_directory_uri() . '/dist/js/bootstrap.min.js', array('jquery'), '', true);
  //wp_enqueue_script ('bsm-js', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
  wp_enqueue_script ('slick-js', get_template_directory_uri() . '/dist/js/slick.min.js', array('jquery'), '', true);
  wp_enqueue_script ('chocolat-lightbox-js', get_template_directory_uri() . '/dist/js/chocolat.js', array('jquery'), '', true);
  wp_enqueue_script ('select2-js', get_template_directory_uri() . '/dist/js/select2.min.js', array('jquery'), '', true);
  wp_enqueue_script ('nice-select-js', get_template_directory_uri() . '/dist/js/jquery.nice-select.min.js', array('jquery'), '', true);
  wp_enqueue_script ('spinner-js', get_template_directory_uri() . '/dist/js/bootstrap-input-spinner.js', array('jquery'), '', true);
  wp_enqueue_script ('sc-init', get_template_directory_uri() . '/dist/js/init.js', array('jquery'), '', true);
  wp_enqueue_script ('sc-configurador', get_template_directory_uri() . '/dist/js/configurador.js', array('jquery'), '', true);
  wp_enqueue_script ('sc-custom-slick', get_template_directory_uri() . '/dist/js/custom-slick.js', array('jquery'), '', true);
  wp_enqueue_script ('sc-header', get_template_directory_uri() . '/dist/js/header.js', array('jquery'), '', true);
  wp_enqueue_script ('sc-footer', get_template_directory_uri() . '/dist/js/footer.js', array('jquery'), '', true);
  wp_enqueue_script ('sc-custom-slick-nuria', get_template_directory_uri() . '/dist/js/custom-slick-nuria.js', array('jquery'), '', true);
  wp_enqueue_script ('custom-slick-pol', get_template_directory_uri() . '/dist/js/custom-slick-pol.js', array('jquery'), '', true);
  wp_enqueue_script ('custom-pol', get_template_directory_uri() . '/dist/js/custom-pol.js', array('jquery'), '', true);
  // Scripts for creating and downloading .ics files (calendar)
  if (is_singular('evento')) {
    wp_enqueue_script ('ics', get_template_directory_uri() . '/dist/js/ics.min.js', array('jquery'), '', true);
    wp_enqueue_script ('file-saver', get_template_directory_uri() . '/dist/js/file-saver.js', array('jquery'), '', true);
  }


  if(is_page(533) || is_page(21907)){
  wp_enqueue_script ('sc-where-to-buy', get_template_directory_uri() . '/dist/js/where-to-buy.js', array('jquery'), '', true);

  }

}
add_action( 'wp_enqueue_scripts', 'include_scripts' );

/* ------------- Embed JS Scripts urls */

add_action( 'wp_enqueue_scripts', 'include_scripts_cdn' );
function include_scripts_cdn(){
  wp_enqueue_script ('intra-font-awesome', 'https://kit.fontawesome.com/89a11451ca.js', array(), null, true);

  // Add filters to catch and modify the styles and scripts as they're loaded.
  add_filter( 'script_loader_tag', __NAMESPACE__ . '\wpdocs_my_add_sri_crossorigin', 10, 2 );
}

/**
* Add SRI attributes based on defined script/style handles.
*/
function wpdocs_my_add_sri_crossorigin( $html, $handle ) : string {

  switch( $handle ) {
      case 'intra-font-awesome':
          $html = str_replace( '></script>', ' crossorigin="anonymous"></script>', $html );
          break;
  } 
  return $html;
}