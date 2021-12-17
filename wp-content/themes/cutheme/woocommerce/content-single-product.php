<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
 
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    

    <?php if (get_field('slider_principal')) { ?>

    <!-- GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="my-lg-5 my-4 py-lg-5 py-4 overflow-hidden">
    <div class="wrapper">
        <div class="container-fluid px-0 position-relative">
            <div class="slider-primary-product" id="slider-primary-product">

                <?php 
                    $content = get_field('slider_principal', false, false);
                    $stripped_P = apply_filters('acf_the_content', $content);
                    echo str_replace(array('<p>','</p>'),'',$stripped_P); 
                ?>

                <!-- <a href="<?php echo get_template_directory_uri() ?>/img/basica (5).jpg" class="lightboxxx">
                    <img src="<?php echo get_template_directory_uri() ?>/img/basica (5).jpg"
                        class="img-fluid pr-lg-4 mx-auto">
                </a> -->

            </div>
        </div>
        <div class="chocolat-lightboxxx">

        </div>
        </div>
    </section>
    <!-- /GALERIA PRINCIPAL DEL PRODUCTO -->
    <?php } ?>
    <section class="my-5">
    <div class="wrapper">
        <div class="container-fluid px-lg-4 px-3">
            <div class="row">
                <div
                    class="col-lg-7 col-12 col-md-7 d-flex flex-column justify-content-center wrapper summary entry-summary mb-lg-0 mb-4">
                    <?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
                    <hr class="w-100">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5 pl-0">
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2">
                                    <?php _e('Pago seguro', 'santa-cole') ?>
                                </a>
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2">
                                    <?php _e('Seguro de envío incluido', 'santa-cole') ?>
                                </a>
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2">
                                    <?php _e('Opción de pago a plazos', 'santa-cole') ?>
                                </a>
                            </div>
                            <div class="col-lg-7 pr-0 pl-0 text-lg-right">
                                <span class="color-grey-light2 fs-08">
                                    <?php _e('¿Tienes alguna duda? Echa un vistazo a las', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('condiciones de compra', 'santa-cole') ?></a>
                                    <?php _e('o contacta con', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('nosotros.', 'santa-cole') ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 col-md-5 wrapper-right-fluid pl-lg-3 pl-0">

                    <?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
                </div>

            </div>
        </div>
        </div>
    </section>


    <!-- 
        Sección Relacionados <-----------
    -->
    <section class="py-lg-5 py-4">
        <div class="wrapper">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-12 mb-lg-4 mb-3">
                        <?php
                            $heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'Productos relacionados', 'woocommerce' ) );

                            if ( $heading ) :
			            ?>
                        <h2 class="fw-400 fs-11 mb-lg-4 mb-3"><?php echo esc_html( $heading ); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-left">
            <div class="container-fluid px-1 pb-5">
                <div class="row">

                    <div class="col-12 px-0">


                        <?php
                        /**
                         * Hook: woocommerce_after_single_product_summary.
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>