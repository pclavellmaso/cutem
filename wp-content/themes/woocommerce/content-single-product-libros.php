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
$language_actual = apply_filters( 'wpml_current_language', NULL );
?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <section class="d-lg-block d-none">
        <div class="wrapper">
            <div class="container-fluid mb-lg-5 mt-lg-5 mt-3 mb-3 ">
                <div class="row justify-content-betwwen">
                    <div class="col-lg-6 col-12">
                        <h1 class="title-product mb-0"><?php the_title();?></h1>
                        <!-- <span class="author-product"><?php //the_field('autor'); ?></span> -->
                        <div>
                            <?php
                            $autores = get_field('autor');
                            if( $autores ): ?>

                            <?php foreach( $autores as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>

                            <span>
                                <?php the_title(); ?>
                                <?php//the_field( 'ano_de_nacimiento' ); ?>
                            </span>

                            <?php endforeach; ?>

                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                            <?php endif; ?>
                            <br>
                            <span><?php the_field('ano_de_producto');?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 text-right">

                        <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> mb-0">
                        <?php 
                                if( $product->is_type( 'variable' ) ){
                                echo  _e('Desde: ', 'woocommerce');
                                }
                            ?> 
                            <?php 
                                $productss = new WC_Product(get_the_ID());
                                echo $productss->get_price_html();
                            ?>
                        </p>
                        <div class="btn-comprar-1">

                            <a href="<?php echo get_site_url(); ?>/<?php echo $language_actual;
                            if ($language_actual == 'es') {
                                echo '/carrito';
                            } else {
                                echo '/cart';
                            }
                             ?>/?add-to-cart=<?php the_ID(); ?>"
                                class="text-underline color-custom-black"><?php _e('Añadir a la cesta', 'santa-cole') ?></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="my-lg-5 my-4 py-lg-5 py-4 overflow-hidden">
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
            <!-- ARROWS SLIDER PRIMARY -->
            <!-- <div class="control-slider-products">
                <span id="arrow-left2" class="pl-3">
                    <span class="slick-prev slick-arrow text-right"></span>
                </span>
                <span id="arrow-right2" class="pr-3">
                    <span class="slick-next slick-arrow"></span>
                </span>
            </div> -->
        </div>
        <div class="chocolat-lightboxxx">

        </div>
    </section>
    <!-- /GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="mb-lg-5 mb-0">
        <div class="wrapper">
        <div class="container-fluid px-lg-4 px-3">
            <div class="row">
                <div
                    class="col-lg-7 col-12 d-flex flex-column justify-content-center wrapper-right pl-lg-0 summary entry-summary mb-lg-0 mb-4">
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
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2 open-modal-pago">
                                    <?php _e('Pago seguro', 'santa-cole') ?>
                                </a>
                                <a href="#"
                                    class="text-underline color-grey-light2 fs-08 d-block mb-2 open-modal-envio">
                                    <?php _e('Seguro de envío incluido', 'santa-cole') ?>
                                </a>
                                <a href="#"
                                    class="text-underline color-grey-light2 fs-08 d-block mb-2 open-modal-plazos">
                                    <?php _e('Opción de pago a plazos', 'santa-cole') ?>
                                </a>
                            </div>
                            <div class="col-lg-7 pr-0 pl-lg-3 pl-0 text-md-right">
                                <span class="color-grey-light2 fs-08">
                                    <?php _e('¿Tienes alguna duda? Echa un vistazo a las', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('condiciones de compra', 'santa-cole') ?></a>
                                    <?php _e('o contacta con', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('nosotros.', 'santa-cole') ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 wrapper-right-fluid pl-lg-3 pl-0">

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
    <?php 
    $upsells = $product->get_upsell_ids();
    if ( $upsells ) : ?>
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
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>