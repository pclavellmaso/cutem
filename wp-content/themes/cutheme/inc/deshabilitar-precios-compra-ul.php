<?php 


if (comprar() == false ) {

    /**
    * *
    * * Oculta precios de WooCommerce en la página de tienda y producto
    */
    // Ocultamos los precios de la tienda y producto

    add_filter( 'woocommerce_variable_sale_price_html', 'MichWoo_remove_prices', 10, 2 );
    add_filter( 'woocommerce_variable_price_html', 'MichWoo_remove_prices', 10, 2 );
    add_filter( 'woocommerce_get_price_html', 'MichWoo_remove_prices', 10, 2 );
    add_filter( 'woocommerce_template_single_price', 'MichWoo_remove_prices', 10, 2 );
    
    function MichWoo_remove_prices( $price, $product ) {
    $price = '';
    return $price;
    }

    /**
    * *
    * * FIN
    */
    

    /**
    * *
    * * DESHABILITAR COMPRA Y BOTON DE COMPRA
    */
    
    function remove_add_to_cart_button($product){  
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    }
    add_action('init','remove_add_to_cart_button');

    add_filter( 'woocommerce_is_purchasable', '__return_false');

    /**
    * *
    * * FIN
    */
}