<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */
defined( 'ABSPATH' ) || exit;
?>
<!-- <section class="mb-4">
    <div class="container-fluid px-0 px-md-3">
        <div class="row">
            <div class="col-12 col-md-6 pl-md-0 linkselemts">
                <a href="<?php //echo home_url('/carrito/')?>" class="color-grey-light2"><i class="fal fa-chevron-left"></i> <?php //_e( 'Volver a Carretilla', 'santacole' ); ?></a>
            </div>
        </div>
    </div>
</section> -->
<section class="mb-5">
    <div class="contaienr-fluid px-0 px-md-3">
        <div class="row">
            <div class="col-12 pl-md-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="">1. Acceso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo home_url('/mi-cuenta/orders/')?>">2. Tus datos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo home_url('/mi-cuenta/edit-address/')?>">3. Envío y pago</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ( is_user_logged_in()  ){ echo 'active'; } ?>" href="#messages">4.
                            Confirmación de pedido</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="my-5 pt-5 eliminarchec">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-xl-5 pl-0">
                <div class="woocommerce-order">
                    <?php
					if ( $order ) :
						do_action( 'woocommerce_before_thankyou', $order->get_id() );
						?>
                    <?php if ( $order->has_status( 'failed' ) ) : ?>
                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                        <?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?>
                    </p>
                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                        <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
                            class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
                        <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
                            class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
                        <?php endif; ?>
                    </p>
                    <?php else : ?>
                    <!-- <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p> -->
                    <p class="fs-13 px-md-5 px-3 pt-4 pt-md-5 mb-4 bor mostrarsst text-center text-xl-left">
                        <?php _e('Resumen del pedido', 'santa-cole') ?></p>
                    <ul
                        class="woocommerce-order-overview woocommerce-thankyou-order-details order_details px-md-5 px-3 pb-4 pb-md-5">
                        <li class="woocommerce-order-overview__order order">
                            <span
                                class="color-grey-light2 mr-3"><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></span>
                            <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </li>
                        <li class="woocommerce-order-overview__date date">
                            <span class="color-grey-light2 mr-3"><?php esc_html_e( 'Date:', 'woocommerce' ); ?></span>
                            <strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </li>
                        <?php //if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                        <!-- <li class="woocommerce-order-overview__email email">
										<?php //esc_html_e( 'Email:', 'woocommerce' ); ?>
										<strong><?php //echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
									</li> -->
                        <?php //endif; ?>
                        <!-- <li class="woocommerce-order-overview__total total">
									<?php// esc_html_e( 'Total:', 'woocommerce' ); ?>
									<strong><?php //echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</li> -->
                        <?php //if ( $order->get_payment_method_title() ) : ?>
                        <!-- <li class="woocommerce-order-overview__payment-method method">
										<?php// esc_html_e( 'Payment method:', 'woocommerce' ); ?>
										<strong><?php //echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
									</li> -->
                        <?php //endif; ?>
                    </ul>
                    <?php endif; ?>
                    <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
                    <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
                    <?php else : ?>
                    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                        <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </p>
                    <?php endif; ?>
                </div>
                <a href="<?php echo home_url('/producto/')?>"
                    class="single_add_to_cart_button button alt mt-0 mb-3"><?php echo _e('Volver a la tienda', 'santacole'); ?></a>
                <a href="javascript:imprSelec('imprimirdiv')">Imprimir</a>
            </div>
            <div class="col-12 col-xl-7 pr-0 imgthank">
                <span class="icon-pedido-custom d-flex justify-content-center justify-content-md-end"></span>
            </div>
        </div>
    </div>
</section>
<section class="my-4 pt-5">
    <div class="container-fluid px-md-3">
        <div class="row">
            <div class="col-12 col-md-6 pl-md-0 linkselemts">
                <a href=""
                    class="color-grey-light2 text-underline"><?php _e( 'Condiciones de compra', 'santacole' ); ?></a>
            </div>
            <div class="col-12 col-md-6 pl-md-0 linkselemts d-flex justify-content-end">
                <a href=""
                    class="color-grey-light2  text-underline"><?php _e( '¿Necesitas ayuda? Por favor contacta con Atención al cliente.', 'santacole' ); ?></a>
            </div>
        </div>
    </div>
</section>
<div id="imprimirdiv" style="border:1px solid black; display:none;">
    <div style="padding:20px 0px;display: flow-root;">
        <div style="width:50%;float:left;">
            <img src="https://new.santacole.com/wp-content/uploads/logo_web_desktop-01.svg" class="custom-logo"
                alt="Santa cole" style="width:60%;">
        </div>
        <div style="width:50%;float:left;text-align:right;">
            <div style="font-size:9px">
                <p><strong>B63879597</strong></p>
                <p><strong>Ctra. C-251 km. 5,6 08430 La Roca</strong></p>
                <p><strong>+34 938462437</strong></p>
                <p><strong>hola@santacole.com</strong></p>
            </div>
        </div>
    </div>
    <div style="border-top:1px solid black;padding:30px 0px;">
        <ul style="list-style:none;marign:20px;padding:0px;">

            <li class="woocommerce-order-overview__order order">
                <span class="color-grey-light2 mr-3"><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></span>
                <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
            </li>

            <li class="woocommerce-order-overview__date date">
                <span class="color-grey-light2 mr-3"><?php esc_html_e( 'Date:', 'woocommerce' ); ?></span>
                <strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
            </li>
        </ul>

    </div>
    <div style="border:1px solid black;padding:20px;">
        <h2>Detalles del pedido</h2>
        <hr style="margin-bottom:20px">
        <?php 
			$order->get_id();
			$order->get_order_key();
			// Get and Loop Over Order Items
			foreach ( $order->get_items() as $item_id => $item ) {
				$product_id = $item->get_product_id();
				$variation_id = $item->get_variation_id();
				$product = $item->get_product();
				$product_name = $item->get_name();
				$quantity = $item->get_quantity();
				$subtotal = $item->get_subtotal();
				$total = $item->get_total();
				$tax = $item->get_subtotal_tax();
				$taxclass = $item->get_tax_class();
				$taxstat = $item->get_tax_status();
				$allmeta = $item->get_meta_data();
				$somemeta = $item->get_meta( '_whatever', true );
				$product_type = $item->get_type();
				echo '<p><strong>'.$product_name.'</strong>: x'.$quantity.' <span style="font-weight: bold;float:right;">'.$subtotal.' €</span></p>';
			}
			if($order->get_shipping_total() == 0){
				$valimpu = $order->get_shipping_method();
			}else{
				// $valimpu = $order->get_shipping_tax();
				$valimpu = $order->get_shipping_total() + $order->get_shipping_tax();
			}
				
				echo '<hr>';
				echo '<p><strong>Impuestos: <span style="font-weight: bold;float:right;">'.$order->get_cart_tax().' €</span></strong></p>';
				echo '<p><strong>Subtotal: <span style="font-weight: bold;float:right;">'.$order->get_subtotal_to_display().'</span></strong></p>';
				echo '<p><strong>Envío: <span style="font-weight: bold;float:right;">'.$valimpu.' €</span></strong></p>';
				echo '<hr>';
				echo '<p><strong>TOTAL: <span style="font-weight: bold;float:right;">'.$order->get_formatted_order_total().'</strong><span style="font-size:13px">Incluye '.$order->get_cart_tax().'de IVA</span></span></p>';
		?>
    </div>
</div>



<?php if ( $order ) :

	do_action( 'woocommerce_before_thankyou', $order->get_id() ); 
	echo "<!-- Event snippet for Compra AM conversion page -->
	<script>
	gtag('event', 'conversion', {
		'send_to': 'AW-1042335346/0LhbCN_Q05ECEPKMg_ED',
		'value': ".$order->get_total().",
		'currency': '".$order->get_currency()."',
		'transaction_id': '". $order->get_id()."'
	});
	</script>";

	?>
<?php 
	$precio_total = $order->get_total();
	$precio = round($precio_total/1.21);
	$preciored = ($precio * 2) / 10;
	$preciored2 = ceil($preciored);
	$preciored3 = $preciored2 * 10 / 2;
	if($precio_total == 0){
		$diferencia = 0;
	}else{
		$diferencia = $precio_total - $preciored3;
	}
	echo "<script>gtag('event', 'conversion', {
				'send_to': 'AW-1042335346/l6HICPr5rpIBEPKMg_ED',
				‘value': ".$order->get_total()." ,
				'tax': ".$diferencia." ,
				'shipping': ".$order->get_total_tax()." ,
				'currency': '".$order->get_currency()."',
				'transaction_id': '".$order->get_transaction_id()."'
		});</script>";
	$json = "gtag('event','purchase', {
			'transaction_id': '".$order->get_transaction_id()."' ,
			'value': '".$order->get_total()."' ,
			'currency': '".$order->get_currency()."',
			'tax': '".$order->get_total_tax()."' ,
			'shipping': 0,
			'items': [";
	$json2 = "gtag('event','begin_checkout', {
			'items': [";
	foreach ( $order->get_items() as $item_id => $item ) {
		// print_r($item);
		$json .= "{";
		$json2 .= "{";
	$product_id = $item->get_product_id();
	$product = wc_get_product($item->get_product_id());
	$variation_id = $item->get_variation_id();
	$name = $item->get_name();
	$quantity = $item->get_quantity();
	$total = $item->get_total();

	$json .= "'id': '".$product->sku."' ,
				'name': '".addslashes($name)."' ,
				'brand': '' ,
				'category': '' ,
				'variant': '".$variation_id."' ,
				'list_position': 1,
				'quantity': ".$quantity." ,
				'price': ".$total;
		$json2 .= "'id': '".$product->sku."' ,
				'name': '".addslashes($name)."' ,
				'brand': '' ,
				'category': '' ,
				'variant': '".$variation_id."' ,
				'list_position': 1,
				'quantity': ".$quantity." ,
				'price': ".$total;

		$json .= "},";
		$json2 .= "},";

	}
	foreach( $order->get_coupon_codes() as $coupon_code ) {
		$cupon = $coupon_code;
	}


	$json .= "]
	});";

	$json2 .= "],
	'coupon':'$cupon'
	});";
	// echo "<script>".$json."</script>";
	// echo "<script>".$json2."</script>";



endif; ?>



<script>
function imprSelec(imprimirdiv) {










    var ficha = document.getElementById(imprimirdiv);
    var ventimp = window.open(' ', 'imprimirdiv');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();
    ventimp.print();
    ventimp.close();
}
</script>