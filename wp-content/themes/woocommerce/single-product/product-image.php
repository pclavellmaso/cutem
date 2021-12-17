<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'my_custom_img_function' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="px-lg-3 px-1 container-fluid float-none <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>"
    data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <div class="row">
        <div class="col-12 px-0">
            <figure class="woocommerce-product-gallery__wrapper">
                <div class="container-fluid px-0">
                    <div class="slider-product" id="slider-product">
                        <?php
						if ( $post_thumbnail_id ) {
							$html = my_custom_img_function( $post_thumbnail_id, true );
						} else {
							$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
							$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image img-fluid testttt" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
							$html .= '</div>';
						}

						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

						do_action( 'woocommerce_product_thumbnails' );
						?>
                    </div>
                    <!-- ARROWS SLIDER PRIMARY -->
                    <div class="control-slider-products">
                        <span id="arrow-left" class="pr-3">
                            <span class="slick-prev slick-arrow text-right"></span>
                        </span>
                        <span id="arrow-right">
                            <span class="slick-next slick-arrow"></span>
                        </span>
                    </div>

                </div>
            </figure>
        </div>
    </div>
</div>

<!-- <div class="chocolat-lightboxxx">

</div> -->