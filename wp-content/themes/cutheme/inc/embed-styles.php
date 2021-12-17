<?php
/**
 * Embed Styles
 *
 * @package santa-cole
 */

/* ------------- Embed Modular CSS */
function include_styles() {
  wp_enqueue_style('santa-cole-bs-css', get_template_directory_uri() . '/dist/css/bootstrap.min.css' );
  wp_enqueue_style('santa-cole-bsmm-css', get_template_directory_uri() . '/dist/css/bootstrap.min.css.map' );
  wp_enqueue_style('santa-cole-bsmm-css', get_template_directory_uri() . '/dist/css/bootstrap.css.map' );
  wp_enqueue_style('style-cookies', get_template_directory_uri() . '/dist/css/style-cookies.css' );  
  wp_enqueue_style('style-admin', get_template_directory_uri() . '/dist/css/style-admin.css' );
  wp_enqueue_style('style-banner', get_template_directory_uri() . '/dist/css/style-banner.css' );
  wp_enqueue_style('style-blog', get_template_directory_uri() . '/dist/css/style-blog.css' );
  wp_enqueue_style('style-borders', get_template_directory_uri() . '/dist/css/style-borders.css' );
  wp_enqueue_style('style-colors', get_template_directory_uri() . '/dist/css/style-colors.css' );

  if (is_404()) {
    wp_enqueue_style('style-404', get_template_directory_uri() . '/dist/css/style-404.css' );
  }

  wp_enqueue_style('style-extras', get_template_directory_uri() . '/dist/css/style-extras.css' );
  wp_enqueue_style('style-fonts', get_template_directory_uri() . '/dist/css/style-fonts.css' );
  wp_enqueue_style('style-footer', get_template_directory_uri() . '/dist/css/style-footer.css' );
  wp_enqueue_style('style-forms', get_template_directory_uri() . '/dist/css/style-forms.css' );
  wp_enqueue_style('style-general', get_template_directory_uri() . '/dist/css/style-general.css' );
  wp_enqueue_style('style-search', get_template_directory_uri() . '/dist/css/style-search.css' );
  wp_enqueue_style('style-icons', get_template_directory_uri() . '/dist/css/style-icons.css' );
  wp_enqueue_style('style-navbar', get_template_directory_uri() . '/dist/css/style-navbar.css' );

  if (is_page(283)) {
    wp_enqueue_style('select2-css', get_template_directory_uri() . '/dist/css/select2.min.css' );
  }
  
  wp_enqueue_style('slick-css', get_template_directory_uri() . '/dist/css/slick.css' );
  wp_enqueue_style('chocolat-lightbox-css', get_template_directory_uri() . '/dist/css/chocolat.css' );
  wp_enqueue_style('style-slick', get_template_directory_uri() . '/dist/css/style-slick.css' );
  wp_enqueue_style('style-header', get_template_directory_uri() . '/dist/css/style-header.css' );

  if  ( is_cart() || is_account_page() || is_checkout()  || is_product() || taxonomy_exists('product_cat')) {
    wp_enqueue_style('style-products', get_template_directory_uri() . '/dist/css/style-products.css' );
    wp_enqueue_style('style-ficha-products', get_template_directory_uri() . '/dist/css/style-ficha-product.css' );
    wp_enqueue_style('nice-select-css', get_template_directory_uri() . '/dist/css/nice-select.css' );
    wp_enqueue_style('select2-css', get_template_directory_uri() . '/dist/css/select2.min.css' );
  }
  wp_enqueue_style('style-selec2', get_template_directory_uri() . '/dist/css/style-select2.css' );


  wp_enqueue_style('style-tabs', get_template_directory_uri() . '/dist/css/style-tabs.css' );
  wp_enqueue_style('style-acordeon', get_template_directory_uri() . '/dist/css/style-acordeon.css');
  wp_enqueue_style('custom-css', get_template_directory_uri() . '/dist/css/custom.css' );
  wp_enqueue_style('custom-css-nuria', get_template_directory_uri() . '/dist/css/custom-css-nuria.css' );
  wp_enqueue_style('custom-css-inmanol', get_template_directory_uri() . '/dist/css/custom-css-inmanol.css' );
  wp_enqueue_style('custom-pol', get_template_directory_uri() . '/dist/css/custom-pol.css' );
  
  if(is_page(533) || is_page(21907)){
    wp_enqueue_style('style-where-to-buy', get_template_directory_uri() . '/dist/css/style-where-to-buy.css' );
  }
}
add_action( 'wp_enqueue_scripts', 'include_styles' );
