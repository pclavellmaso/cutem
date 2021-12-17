<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'loop-content-product d-flex flex-column', $product ); ?>> 
    <?php

	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );?>
    <div class="content-img-loop mb-3">
        <?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
    </div>
    <div class="d-flex justify-content-between align-items-center title-price-loop mb-1">
        <?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
    </div>

    <?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
    <div class="autor-ano-cat order-2">

        <div class="mb-1">
            
            <span>
                <?php
                    $ids_autores = get_field('autor');
            
                    if ($ids_autores) {
                        $autores = '';
                        $counter_author = 1;
                        foreach($ids_autores as $id_autor) {
                            if ($id_autor) {
                                $autores .= get_the_title($id_autor);
                                if ($counter_author < count($ids_autores)) {
                                    $autores .= ', ';
                                }
                                $counter_author++;
                            }
                        }
                    }

                    $ano_producto = get_field('ano_de_producto');
                    
                    if ($ano_producto) echo $ano_producto;
                    if ($autores) echo ' - ' . $autores;
                ?>
            </span>

        </div>

        <?php 
            if ($product->get_parent_id()) {
                $categoria_producto = Polwoo_get_product_child_cat_a( $product->get_parent_id() );
                
            } else {
                $categoria_producto = Polwoo_get_product_child_cat_a($product->get_id());
            }
        ?>

        <h3 class="fs-08 color-grey-light2 font-weight-normal text-left">
            <?php echo $categoria_producto; ?>
        </h3>

        <!-- HAY QUE QUITAR EL BOTON DE AÑADIOR A LA CESTA -->
        
    </div>
</li>