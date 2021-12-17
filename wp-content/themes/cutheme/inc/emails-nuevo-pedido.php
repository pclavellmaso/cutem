<?php

add_action( 'woocommerce_email_after_order_table', 'add_payment_method_to_admin_new_order', 15, 2 );

/**
 * Add used coupons to the order confirmation email
 *
*/
function add_payment_method_to_admin_new_order( $order, $is_admin_email ) {
	
	if ( $is_admin_email ) {	
        
        if( $order->get_coupon_codes() ) {
    
            $coupons_count = count( $order->get_coupon_codes() );
        
            echo '<h4>' . __('Cupones usados') . ' (' . $coupons_count . ')</h4>';
             
            echo '<p style="margin-bottom:0;"><strong>' . __('Código de cupon') . ':</strong> ';
            
            $i = 1;
            
            foreach( $order->get_coupon_codes() as $coupon_code ) {
                // Get the WC_Coupon object
                $coupon = new WC_Coupon($coupon_code);
            
                $discount_type = $coupon->get_discount_type(); // Get coupon discount type
                $coupon_amount = $coupon->get_amount(); // Get coupon amount

                echo $coupon_code;
                if( $i < $coupons_count )
                    echo ', ';
                $i++;
            }

            if ($discount_type == 'fixed_cart') {

                if ($order->get_currency() == 'EUR') {
                    echo '<br><span><strong>Descuento fijo </strong>'. $coupon_amount .'€</span>';
                }

            } elseif ($discount_type == 'percent') {
                echo '<br><span><strong>Descuento: </strong>'. $coupon_amount .'%</span>';
            }
            echo '</p>';         

        }

        $metododepago = $order->get_payment_method();

        if ($metododepago == 'redsys') {
            echo '<p style="margin-top:0;"><strong>Método de Pago:</strong> Redsys</p>';
        } elseif ($metododepago == 'paypal') {
            echo '<p style="margin-top:0;"><strong>Método de Pago:</strong> Paypal</p>';
        }elseif ($metododepago == 'bizum') {
            echo '<p style="margin-top:0;"><strong>Método de Pago:</strong> Bizum</p>';
        }elseif ($metododepago == 'klarna_payments') {
            echo '<pstyle="margin-top:0;"><strong>Método de Pago:</strong> Klarna</p>';
        }
        
        // endif get_used_coupons

        //* Añadir el método de pago a la notificación del administrador de WooCommerce
        
            //echo '<p><strong>Método de Pago:</strong> ' . $order->get_payment_method_title() . '</p>';
            //echo '<p><strong>Método de Pago:</strong> ' . $order->get_payment_method() . '</p>';
        
            if ($order->get_user()) {
                
                $user = $order->get_user();
                $role = ( array ) $user->roles;
                //return $role[0];

                if( $role[0] == "personal_empresa" ) {
                    echo '<p><strong>Pedido hecho por personal de la empresa</strong></p>';
                }

            }

	} // endif $is_admin_email
}