<?php
/**
 * Embed Scripts
 *
 * @package cutem
 */

/* ------------- Embed JS Scripts Local */
function include_scripts() {

    wp_enqueue_script ('slick-js', get_template_directory_uri() . '/dist/js/slick.min.js', array('jquery'), '', true);
    wp_enqueue_script ('spinner-js', get_template_directory_uri() . '/dist/js/bootstrap-input-spinner.js', array('jquery'), '', true);
    wp_enqueue_script ('sc-init', get_template_directory_uri() . '/dist/js/init.js', array('jquery'), '', true);
    wp_enqueue_script ('sc-custom-slick', get_template_directory_uri() . '/dist/js/custom-slick.js', array('jquery'), '', true);
    wp_enqueue_script ('sc-header', get_template_directory_uri() . '/dist/js/home.js', array('jquery'), '', true);
    wp_enqueue_script ('sc-header', get_template_directory_uri() . '/dist/js/header.js', array('jquery'), '', true);
    wp_enqueue_script ('sc-footer', get_template_directory_uri() . '/dist/js/footer.js', array('jquery'), '', true);
}
add_action( 'wp_enqueue_scripts', 'include_scripts' );

/* ------------- Embed JS Scripts CDNS */
function include_scripts_cdn(){

    wp_enqueue_script( 'popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array(), '1.14.3', true); 
    wp_enqueue_script( 'bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery','popper_js'), '4.1.3', true);
    wp_enqueue_script ('intra-font-awesome', 'https://kit.fontawesome.com/89a11451ca.js', array(), null, true);

    // Add filters to catch and modify the styles and scripts as they're loaded.
    add_filter( 'script_loader_tag', __NAMESPACE__ . '\wpdocs_my_add_sri_crossorigin', 10, 2 );
}
add_action( 'wp_enqueue_scripts', 'include_scripts_cdn' );

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