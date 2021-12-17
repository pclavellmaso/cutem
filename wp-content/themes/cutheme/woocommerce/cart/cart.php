<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<section class="mb-4">
    <div class="container-fluid px-0 px-md-3">
        <div class="row">
            <div class="col-12 col-md-6 pl-md-0 linkselemts">
                <a href="<?php echo home_url('/mi-cuenta/')?>" class="color-grey-light2"><i
                        class="fal fa-chevron-left"></i> <?php _e( 'Volver a página', 'santacole' ); ?></a>
            </div>
        </div>
    </div>
</section>
<section>
    <form class="woocommerce-cart-form mainform" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <div class="container-fluid px-0 px-md-3">
            <div class="row d-flex justify-content-between">
                <div class="col-12 col-md-12 col-lg-6">

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>

                    <div class="row mb-4 pb-4 mainborderbotom">
                        <div class="col-5 col-md-2 pl-md-0 mb-3">
                            <!-- Image section -->
                            <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                            if ( ! $product_permalink ) {
                                echo $thumbnail; // PHPCS: XSS ok.
                            } else {
                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                            }
                        ?>
                        </div>
                        <div class="col-7 col-md-10">
                            <!-- Description section -->
                            <div class="row">
                                <div class="col-12 col-md-8 minheight-cart mb-3 ">
                                    <?php
                                    if ( ! $product_permalink ) {
                                        echo '<p class="fs-1">'.wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ). '</p>';
                                    } else {
                                        echo '<p>'. wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="fs-1">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) ). '</p>';
                                    }
   echo '<div id="sectioautores">';
                                    $autores = get_field('autor', $product_id);
                                    if( $autores ):
                                        if( sizeof($autores) > 0 ){
                                            $ponercoma = '<span class="eliminarcoma">,</span>';
                                        }else{
                                            $ponercoma = '';
                                        }
                                    foreach( $autores as $postt ): 
                                        $TitleAutor = get_the_title($postt);
                                    echo '<span class="pr-1 pb-lg-1 mainautor">'.$TitleAutor.$ponercoma.'</span>';
                                    endforeach;
                                    endif;
                                    echo '</div>';
                                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                    // Meta data. autores/caracteristicas
                                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
                                    /* $descripcioncheckout = $_product->get_attribute_summary();
                                    $antes = array(",");
                                    $despues = array(".");
                                    $formatoDes = str_replace($antes, $despues, $descripcioncheckout);
                                    echo '<p class="mb-lg-2 color-grey-light2">'.$formatoDes.'</p>'; */


                                    // Backorder notification.
                                    // if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    //     echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                    // }
                                 
                                    //For link edit config

                                    echo '<a href="'.$product_permalink.'" class="text-underline color-grey-light3 fs-08">'.esc_html__( 'Editar configuración', 'woocommerce' ).'</a>';

                                    // if ( ! $product_permalink ) {
                                    //     echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', esc_html__( 'Editar configuración', 'woocommerce' ), $cart_item, $cart_item_key ) . '&nbsp;' );
                                    // } else {
                                    //     echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="text-underline color-grey-light3">%s</a>', esc_url( $product_permalink ),esc_html__( 'Editar configuración', 'woocommerce' ) ), $cart_item, $cart_item_key ) );
                                    // } 
                                ?>
                                </div>
                                <div class="col-12 col-md-4 d-md-flex justify-content-md-end mb-3 d-none">
                                    <!-- eliminar desktop -->
                                    <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="text-underline color-grey-light3" aria-label="%s" data-product_id="%s" data-product_sku="%s">'. esc_html__( "Eliminar", "woocommerce" ).'</a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ), 
                                                esc_html__( 'Eliminar', 'woocommerce' ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                    ?>
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-6 col-md-8 d-flex ">
                                    <!-- cantidad -->
                                    <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }
                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                    ?>
                                    <?php do_action( 'woocommerce_cart_contents' ); ?>

                                    <button type="submit" class="button updatecartclass text-left" name="update_cart"
                                        value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                                        <i class="fal fa-chevron-down"></i>
                                    </button>



                                    <?php do_action( 'woocommerce_cart_actions' ); ?>

                                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

                                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>

                                    <?php do_action( 'woocommerce_after_cart_table' ); ?>
                                </div>



                                <div class="col-6 col-md-4 d-flex justify-content-end">
                                    <?php
                                    //precio por unidad
                                    //echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    
                                    if( $_product->get_regular_price() !=  $_product->get_price() ){?>
                                    <div class="fs-09">
                                        <?php
                                        $language_actual = apply_filters( 'wpml_current_language', NULL );

                                        $antes 			=	'Antes';
                                        $parati 		=	'Para tí';
                                        if($language_actual != 'es'){
                                            $antes 	= 'Before';
                                            $parati = 'For you';
                                        }

                                        $valor_tax 			 = iva_pais_woocommerce();
                                        $precio_real_mas_iva = $_product->get_regular_price() * $valor_tax;
                                        
                                        number_format($precio_real_mas_iva,2,",",".");
                                        
                                        if($language_actual == 'es'){
                                            $precio_real_mas_iva = money_format('%.2n', $precio_real_mas_iva);
                                            $precio_real_mas_iva = str_replace('.',',', $precio_real_mas_iva);
                                            $precio_real_mas_iva = $precio_real_mas_iva . '€';
                                        }else {
                                            $precio_real_mas_iva = money_format('%.2n', $precio_real_mas_iva);
                                            $precio_real_mas_iva = number_format($precio_real_mas_iva,2);
                                            $precio_real_mas_iva = '€' . $precio_real_mas_iva;
                                        }
                                        echo $antes.' <span style="color: #b43c16;text-decoration:line-through;">'.$precio_real_mas_iva.'</span><br>'.$parati.' ';
                                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                        ?>
                                    </div>
                                    <?php }else {
                                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    }
            
                                    
                                ?>
                                </div>

                            </div>
                            <div class="row mt-3 d-block d-md-none">
                                <div class="col-12 ">
                                    <!-- eliminar movil -->
                                    <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="text-underline color-grey-light3" aria-label="%s" data-product_id="%s" data-product_sku="%s">Eliminar</a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                esc_html__( 'Eliminar', 'woocommerce' ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>



                    <?php
                // end foreach
                }
            }
            ?>

                    <?php //do_action( 'woocommerce_before_cart_table' ); ?>

                    <!-- <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents d-none" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-remove">&nbsp;</th>
                        <th class="product-thumbnail">&nbsp;</th>
                        <th class="product-name"><?php //esc_html_e( 'Product', 'woocommerce' ); ?></th>
                        <th class="product-price"><?php //esc_html_e( 'Price', 'woocommerce' ); ?></th>
                        <th class="product-quantity"><?php //esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                        <th class="product-subtotal"><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody> -->
                    <?php //do_action( 'woocommerce_before_cart_contents' ); ?>

                    <?php
                    // foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    // 	$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    // 	$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    // 	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    // 		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>





                    <!-- <tr
                        class="woocommerce-cart-form__cart-item <?php //echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                        <td class="product-remove">
                            <?php
                                        // echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        // 	'woocommerce_cart_item_remove_link',
                                        // 	sprintf(
                                        // 		'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                        // 		esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        // 		esc_html__( 'Remove this item', 'woocommerce' ),
                                        // 		esc_attr( $product_id ),
                                        // 		esc_attr( $_product->get_sku() )
                                        // 	),
                                        // 	$cart_item_key
                                        // );
                                    ?>
                        </td> -->

                    <!-- <td class="product-thumbnail">
                            <?php
                                // $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                // if ( ! $product_permalink ) {
                                // 	echo $thumbnail; // PHPCS: XSS ok.
                                // } else {
                                // 	printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                // }
                                // ?>
                        </td> -->

                    <!-- <td class="product-name" data-title="<?php //esc_attr_e( 'Product', 'woocommerce' ); ?>">
                            <?php
                                // if ( ! $product_permalink ) {
                                // 	echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                // } else {
                                // 	echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                // }

                                // do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                // // Meta data.
                                // echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                // // Backorder notification.
                                // if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                // 	echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                // }
                                ?>
                            <div class="product-autor mb-3">

                                <?php
                                    // $autors = get_field('autor_producto', $product_id);
                                    // if( $autors ): ?>
                                <span class="d-block fw-600 mb-2">Autores:</span>
                                <ul>
                                    <?php //foreach( $autors as $autor ): ?>
                                    <li><?php //echo $autor; ?></li>
                                    <?php //endforeach; ?>
                                </ul>
                                <?php //endif; ?>
                                
                            </div>
                            <div class="product-category">
                                 PARA MOSTRAR LA CATEGORIA -->
                    <!-- <span class="d-block fw-600 mb-2">Categoria:</span> -->
                    <?php //echo wc_get_product_category_list( $cart_item['product_id'] ); ?>
                    <!-- </div>
                        </td>  -->



                    <!-- <td class="product-price" data-title="<?php //esc_attr_e( 'Price', 'woocommerce' ); ?>">
                            <?php
                                        //echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                        </td> -->

                    <!-- <td class="product-quantity" data-title="<?php //esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                            <?php
                                //if ( $_product->is_sold_individually() ) {
                                // 	$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                // } else {
                                // 	$product_quantity = woocommerce_quantity_input(
                                // 		array(
                                // 			'input_name'   => "cart[{$cart_item_key}][qty]",
                                // 			'input_value'  => $cart_item['quantity'],
                                // 			'max_value'    => $_product->get_max_purchase_quantity(),
                                // 			'min_value'    => '0',
                                // 			'product_name' => $_product->get_name(),
                                // 		),
                                // 		$_product,
                                // 		false
                                // 	);
                                // }

                                // echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                ?>
                        </td> -->

                    <!-- <td class="product-subtotal" data-title="<?php //esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                            <?php
                                        //echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                        </td>

                    </tr> -->
                    <?php
                        //}
                    //}
                    ?>

                    <?php //do_action( 'woocommerce_cart_contents' ); ?>

                    <!-- <tr>
                        <td colspan="6" class="actions"> -->

                    <!-- <?php //if ( wc_coupons_enabled() ) { ?>
                            <div class="coupon">
                                <label for="coupon_code"><?php //esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input
                                    type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
                                    placeholder="<?php //esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit"
                                    class="button" name="apply_coupon"
                                    value="<?php //esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                <?php //do_action( 'woocommerce_cart_coupon' ); ?>
                            </div>
                            <?php // } ?> -->




                    <!-- <button type="submit" class="button" name="update_cart"
                                value="<?php //esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                            <?php do_action( 'woocommerce_cart_actions' ); ?>

                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                        </td>
                    </tr> -->

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    <!-- </tbody>
            </table> -->



                    <?php do_action( 'woocommerce_after_cart_table' ); ?>


                </div>
                <div class="col-12 col-md-12 col-lg-5">

                    <?php if ( wc_coupons_enabled() ) { ?>
                        <div class="mb-md-4">
                            <input type="text" name="coupon_code" class="inputcupon" id="coupon_code" value=""
                                placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                            <button type="submit" class="cuponbuton" name="apply_coupon"
                                value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                                <i class="fal fa-chevron-right"></i>
                            </button>
                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                        </div>
                    <?php } ?>
                
                    <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

                    <div class="cart-collaterals">
                        <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         * @hooked woocommerce_cart_totals - 10
                         */
                        do_action( 'woocommerce_cart_collaterals' );
                    ?>
                    </div>

                    <?php do_action( 'woocommerce_after_cart' ); ?>

                </div>
            </div>
        </div>
    </form>

    <?php 
        /*
            Usado para validar los metodos depago de la galeria 
            carga paypal/efectivo al logear con usuario galeria
            carga paupal/tarjeta/klarna para todos los demas
        */
        $curr = wp_get_current_user();
        $loguser =  $curr->user_login;
	    if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados') : 
    ?>

    <div class="row">

        <?php
            //Muestra los productos especiales para la galería
            $language_actual = ICL_LANGUAGE_CODE;
            if ($language_actual == "es") {
                $urlcart =  'carrito';
            } else {
                $urlcart = 'cart';
            }
            $args_propiedades = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => array(411)
                        // 'terms' => array(80)
                    )
                )
            );
            $wp_query = new WP_Query( $args_propiedades ); 
            while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
        ?>
        <div class="col-12 col-md-2 ">
            <div class="mb-3"><?php echo get_the_post_thumbnail() ?></div>
            <div class="d-md-flex justify-content-md-start align-items-center  mb-2 ">
                <h2 class="woocommerce-loop-product__title "><?php echo get_the_title()  ?></h2>
            </div>
            <div class="d-md-flex justify-content-md-between align-items-center title-price-loop mb-1">
                <div class="d-flex justify-content-start flex-column bottonplisserv">
                    <input type="number" step="1" min="0" name="" value="1" title="Cantidad" size="4" placeholder=""
                        id="<?php echo get_the_ID() ?>">
                </div>
                <div class="d-flex justify-content-start justify-content-md-end">
                    <a href="" data-id="<?php echo get_the_ID() ?>"
                        class="quantityenvi"><?php _e('Añadir al carrito', 'woocommerce') ?></a>
                </div>
            </div>
        </div>
        <?php endwhile;?>

    </div>
    <?php endif; ?>
</section>

<script>
siteUrl = '<?php echo get_site_url() ?>'
siteLanguage = '<?php echo $language_actual ?>'
siteUrlCart = '<?php echo $urlcart ?>'
jQuery('.quantityenvi').click(function(e) {
    e.preventDefault();
    valId = jQuery(this).attr("data-id");
    valueCant = jQuery('#' + valId).val();
    jQuery(location).attr('href', siteUrl + '/' + siteLanguage + '/' + siteUrlCart + '/?add-to-cart=' + valId +
        '&quantity=' + valueCant);
})
</script>


<section class="my-4">
    <div class="container-fluid px-0 px-md-3">
        <div class="row">
            <div class="col-12 col-md-6 pl-md-0 linkselemts">
                <a href="<?php echo home_url('/aviso-legal-y-condiciones-de-compra/')?>"
                    class="color-grey-light2 text-underline"><?php _e( 'Condiciones de compra', 'santacole' ); ?></a>
            </div>
            <div class="col-12 col-md-6 pl-md-0 linkselemts d-flex justify-content-end">
                <a href="<?php echo home_url('/contacto/')?>"
                    class="color-grey-light2  text-underline"><?php _e( '¿Necesitas ayuda? Por favor contacta con Atención al cliente.', 'santacole' ); ?></a>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery('.page-id-12674 #newmak-ship').remove()
</script>