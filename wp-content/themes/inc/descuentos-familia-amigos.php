<?php
/////////////////////////////////////////////////////// DESCUENTOS FAMILIA ////////////////////////////////////////////////////////////////
add_filter( 'woocommerce_before_calculate_totals', 'descuentos_cupones_familia' );
function descuentos_cupones_familia( $checkout ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) return;
    //CONEXION BD
    $bd         = new WPDB('root', 'Timpulse02', 'santacole_pim_v3', 'localhost');
    $sql        = "SELECT c.tipo, c.codigo FROM cupones c WHERE c.tipo LIKE 'Familia' AND c.activo = 1";
    $cupones_bd = $bd->get_results($sql);
    $cupones_wc = WC()->cart->get_applied_coupons();
    for ( $i = 0; $i < sizeof( $cupones_bd ); $i++ ) {
        $cupon_activo_bd = $cupones_bd[$i]->codigo;
        if( in_array( $cupon_activo_bd, $cupones_wc ) ){
            $cart = WC()->cart->get_cart();
            //CATEGORIAS => ES
            $arte       =   197;    //ID de categoria Arte
            $neoseries  =   191;    //ID de categoria Neoseries
            $series     =   195;    //ID de categoria Series
            $originales =   193;    //ID de categoria Originales
            $iluminacion=   41;     //ID de categoria Iluminacion
            $mobiliario =   537;    //ID de categoria Mobiliario
            $libros     =   63;     //ID de categoria Libros
            $musica     =   388;    //ID de categoria Musica
            //DESCUENTOS
            $descuento1 =   0.3;    //30%
            $descuento2 =   0.25;   //25%
            $descuento3 =   0.1;    //10%
            $descuento4 =   0.15;   //15%
            foreach ( $cart as $cart_item_key => $cart_item ) {
                $product = wc_get_product( $cart_item['product_id'] );
                $categoria_producto = $product->get_category_ids();
                if ( in_array( $iluminacion , $categoria_producto ) || in_array( $mobiliario , $categoria_producto ) ){ //ID de categorias Diseño
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento1 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $neoseries , $categoria_producto ) ){   //ID de categoria Neoseries
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento2 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $series , $categoria_producto ) ){      //ID de categoria Series
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento3 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $originales , $categoria_producto ) ){  //ID de categoria Originales
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento3 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $libros , $categoria_producto ) ){      //ID de categoria Libros
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento4 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $musica , $categoria_producto ) ){      //ID de categoria Musica
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento4 ), 2 );
                    $cart_item['data']->set_price( $price );
                }
            }
        }
    }
}   
/////////////////////////////////////////////////////// FIN DESCUENTOS FAMILIA /////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////// DESCUENTOS AMIGO ////////////////////////////////////////////////////////////////
add_filter( 'woocommerce_before_calculate_totals', 'descuentos_cupones_amigo' );
function descuentos_cupones_amigo( $checkout ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) return;
    //CONEXION BD
    $bd         = new WPDB('root', 'Timpulse02', 'santacole_pim_v3', 'localhost');
    $sql        = "SELECT c.tipo, c.codigo FROM cupones c WHERE c.tipo LIKE 'Amigo' AND c.activo = 1";
    $cupones_bd = $bd->get_results($sql);
    $cupones_wc = WC()->cart->get_applied_coupons();
    for ( $i = 0; $i < sizeof( $cupones_bd ); $i++ ) {
        $cupon_activo_bd = $cupones_bd[$i]->codigo;
        if( in_array( $cupon_activo_bd, $cupones_wc ) ){
            $cart = WC()->cart->get_cart();
            //CATEGORIAS
            $arte       =   197;    //ID de categoria Arte
            $neoseries  =   191;    //ID de categoria Neoseries
            $series     =   195;    //ID de categoria Series
            $originales =   193;    //ID de categoria Originales
            $iluminacion=   41;     //ID de categoria Iluminacion
            $mobiliario =   537;    //ID de categoria Mobiliario
            $libros     =   63;     //ID de categoria Libros
            $musica     =   388;    //ID de categoria Musica
            //DESCUENTOS
            $descuento1 =   0.15;   //15%
            $descuento2 =   0.12;   //10%
            $descuento3 =   0.10;   //12%
            $descuento4 =   0.08;   //8%
            foreach ( $cart as $cart_item_key => $cart_item ) {
                $product = wc_get_product( $cart_item['product_id'] );
                $categoria_producto = $product->get_category_ids();
                if ( in_array( $iluminacion , $categoria_producto ) || in_array( $mobiliario , $categoria_producto ) ){ //ID de categorias Diseño
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento1 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $neoseries , $categoria_producto ) ){   //ID de categoria Neoseries
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento2 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $series , $categoria_producto ) ){      //ID de categoria Series
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento4 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $originales , $categoria_producto ) ){  //ID de categoria Originales
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento4 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $libros , $categoria_producto ) ){      //ID de categoria Libros
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento3 ), 2 );
                    $cart_item['data']->set_price( $price );
                }elseif ( in_array( $musica , $categoria_producto ) ){      //ID de categoria Musica
                    $price = round( $cart_item['data']->get_price() * ( 1 - $descuento4 ), 2 );
                    $cart_item['data']->set_price( $price );
                }
            }
        }
    }   
}
/////////////////////////////////////////////////////// FIN DESCUENTOS AMIGO /////////////////////////////////////////////////////////////