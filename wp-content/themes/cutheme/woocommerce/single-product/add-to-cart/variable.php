<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
$languageee = apply_filters( 'wpml_current_language', NULL );
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart"
    action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
    method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>"
    data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>

    <!-- <div class="btn-comprar-1">
        <a href="<?php //echo home_url(); ?>/<?php //if ($languageee == 'es') {echo '/donde-comprar/';} elseif ($languageee == 'en'){echo '/where-to-buy/';}?>"
            class="buttoncont button square-btn-black fs-09 py-4 mr-md-3 mt-2"><?php //_e('Donde comprar', 'santa-cole') ?>
        </a>
    </div> -->
    <p class="stock out-of-stock">
        <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?>
    </p>
    <?php else : ?>
    <table class="variations" cellspacing="0">
        <tbody class="row mx-0">
            <?php 
            $variations_mich=0;
            foreach ( $attributes as $attribute_name => $options ) : ?>
            <tr class="col-12 position-static tr-variacion-<?php echo $variations_mich;?>">
                <td class="value d-flex align-items-center w-100 td-variacion-<?php echo $variations_mich;?>">
                    <div class="label col-3 pl-0">
                        <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" class="fs-1 color-grey-light3">
                            <?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>
                        </label>
                    </div>
                    <?php
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
                                        'class' => 'custom-select-mich nice-custom-select-'.$variations_mich.'',  
									)
								);
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
                                /* console_log('test mich');
                                console_log($options[0]); */
							?>
                </td>
            </tr>
            <?php
                $variations_mich++; 
                endforeach;
            ?>
        </tbody>
    </table>

    <div class="single_variation_wrap">
        <div class="row d-flex align-items-end variable_producto">
            <div class="col-12 col-md-auto mb-lg-4 mb-3">
                <span
                    class="pointer open-modal-variations text-underline"><?php _e('Compara todos los modelos', 'santa-cole') ?></span>
            </div>
            <div class="col-12">
                <?php
                    /**
                     * Hook: woocommerce_before_single_variation.
                     */
                    do_action( 'woocommerce_before_single_variation' );

                    /**
                     * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                     *
                     * @since 2.4.0
                     * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                     * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                     */
                    do_action( 'woocommerce_single_variation' );

                    /**
                     * Hook: woocommerce_after_single_variation.
                     */
                    do_action( 'woocommerce_after_single_variation' );
                ?>
            </div>

        </div>

    </div>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php if (!comprar()) { ?>

<div class="row d-flex align-items-center mainbutonart px-3 simple2">

    <a href="<?php echo home_url(); ?>/<?php if ($languageee == 'es') {echo '/donde-comprar/';} elseif ($languageee == 'en'){echo '/where-to-buy/';}?>"
        class="buttoncont button square-btn-black fs-09 py-4 mr-0 mr-md-3 mt-2"><?php _e('Donde comprar', 'santa-cole') ?>
    </a>

    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>

</div>

<?php } ?>


<div class="modalvariations modalvariationscloose" id="ModalVariations">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between px-0 mb-lg-5 mb-4">
                <span class="d-block fs-1"><?php _e('Compara todos los modelos', 'santa-cole') ?></span>

                <div id="close-Modalvariations" class="pointer">
                    <span class="fal fa-times color-custom-black fa-lg"></span>
                </div>
            </div>
            <?php 
                $variation_ids = $product->get_children(); // Get product variation IDs

                foreach( $variation_ids as $variation_id => $valor ){
                    $variation = wc_get_product($valor);
                    $varname = $variation->get_attribute_summary();
                    $varid = $valor;
                    $imgVariation = get_the_post_thumbnail($varid,'full');
                    $TitleVariation = get_the_title($varid);
                    $productt = wc_get_product( $varid );
                    $price = $productt->get_price_html();
                    //$productt = new WC_Product($varid);
                    
                ?>


            <div class="col-12 col-lg-3 col-md-4 mb-4 pl-lg-0 pl-0 pr-lg-5 pr-4">
                <?php echo $imgVariation; ?>
                <div class="product-contet mt-lg-3 mt-2">
                    <div class="d-flex justify-content-between">
                        <p class="mb-2 fs-1 color-black">
                            <?php echo $TitleVariation; ?>
                        </p>
                        <p class="fs-1 parrilla-price fw-400">
                            <?php echo $price; ?>
                        </p>

                    </div>
                    <div class="d-block">
                        <p class="fs-8 color-grey-light3 mb-2">
                            <?php 
                            
                                /* $pre_varname = explode(',', $varname)[0];
                                $post_varname = explode(',', $varname)[1];
                
                                $pre_varname = explode('-', $pre_varname)[0];

                                $pre_post = array($pre_varname, $post_varname);
                                $varname = implode(',', $pre_post); */
                            
                                echo $varname;

                            ?>
                        </p>
                        <a href="<?php echo get_site_url(); ?>/carrito/?add-to-cart=<?php echo $varid; ?>"
                            class="text-underline color-black"><?php _e('Añadir a la cesta', 'santa-cole') ?></a>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    </div>

</div>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );