<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if( has_term( 'arte', 'product_cat' ) || has_term( 'art', 'product_cat' )){
	the_title( '<h2 class="product_title entry-title fw-400 fs-125 ff-caslon-i mb-3 mb-md-1">', '</h2>' );

}else {
	the_title( '<h2 class="product_title entry-title fw-400 fs-125 mb-3 mb-md-1">', '</h2>' );
}