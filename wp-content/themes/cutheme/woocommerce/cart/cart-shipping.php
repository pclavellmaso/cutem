<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>


	<tr class="woocommerce-shipping-totals shipping">
		<?php 
			//Mostramos la nueva maquetacion en tab envio
			$page_id = get_queried_object_id();
			// echo $page_id;
			if ( $page_id == 8 or $page_id == 12674):
		?>
			<!-- <th><?php //echo wp_kses_post( $package_name ); ?></th> -->
			<th><?php _e('Opciones de envío', 'santacole') ?></th>
		<?php endif; ?>
		<td data-title="<?php echo esc_attr( $package_name ); ?>" id="deletshipp">
			<?php if ( $available_methods ) : ?>
				<div class="container-fluid" id="newmak-ship">
					<div class="row">

						<div class="card-deck">
							<?php foreach ( $available_methods as $method ) : ?>

								<div class="card widthcartcustom" id="<?php echo $method->method_id ?>">
									<div class="card-body">
										
									<?php 

										if( $method->method_id == 'flat_rate' || $method->method_id == 'free_shipping' ){
											$desc_shop = __('Entrega en España de 3 a 5 días hábiles', 'santacole');
										}elseif ( $method->method_id == 'wc_pickup_store' ) {
											$desc_shop = __('Recogida en España de 2 a 3 días hábiles', 'santacole');
										}else{
											$desc_shop = __('Entrega personalizada', 'santacole');
										}
										//Ponemos el precio del método de envio, es el resultado de la suma del precio mas el impuesto

										if ( $method->cost != 0 ){
											$taxreal = $method->taxes[11];
										}else{
											$taxreal = 0;
										}

										$pricetotal = $method->cost + $taxreal;

										if ( $pricetotal <= 0 ){
											//Si es cero no ponemos nada
											$realprice = '';
										}else{
											//Si tiene valor, ponemos el precio mas el currency
											$realprice = $pricetotal.get_woocommerce_currency_symbol();
										}
										//Para limpiar el id en el label si es cero
										if ( $method->instance_id != '0'  ){
											$numberid = $method->instance_id;
										}else{
											$numberid = '';
										}
										echo '
											<label for="shipping_method_0_'.$method->method_id.$numberid.'" id="'.$method->method_id.$numberid.'" data-custo-id="'. $method->method_id .'">
												<span class="fs-1 fw-500">'.$method->label.'</span> '.$realprice.' <br>
												<span class="fs-0875 color-grey-light">'.$desc_shop.'</span>
											</label>
										';			

										
										if ( 1 < count( $available_methods ) ) {
											printf( '<input type="radio" name="shipping_method[%1$d]"  data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s  data-custom-label="'. $method->label .'" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
										} else {
											printf( '<input type="hidden" name="shipping_method[%1$d]" data-delet="%1$d"  data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" data-custom-label="'. $method->label .'" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
										}
										// printf( '<label for="shipping_method_%1$s_%2$s" id="%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
										do_action( 'woocommerce_after_shipping_rate', $method, $index );
									?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<ul id="shipping_method" class="woocommerce-shipping-methods">
					<?php foreach ( $available_methods as $method ) : ?>
						<li > 
							<?php
							if ( 1 < count( $available_methods ) ) {
								printf( '<input type="radio" name="shipping_method[%1$d]"  data-index="%1$d" id="new.shipping_method_%1$d_%2$s" value="'.$method->id.'" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
							} else {
								printf( '<input type="hidden" name="shipping_method[%1$d]" data-delet="%1$d"  data-index="%1$d" id="new_shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
							}
							printf( '<label for="shipping_method_%1$s_%2$s" id="%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
							do_action( 'woocommerce_after_shipping_rate', $method, $index );
							?>
						</li>
					<?php endforeach; ?>
				</ul>
			
				<?php
			elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
				if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
					echo wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'woocommerce' ) ) );
				} else {
					echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
				}
			elseif ( ! is_cart() ) :
				echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
			else :
				// Translators: $s shipping destination.
				echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
				$calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
			endif;
			?>

			<?php if ( $show_package_details ) : ?>
				<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
			<?php endif; ?>

			<?php if ( $show_shipping_calculator ) : ?>
				<?php woocommerce_shipping_calculator( $calculator_text ); ?>
			<?php endif; ?>
		</td>
	</tr>
<script>
	//Deshabilitamos el boton continuar cuando no selecciona ninguna tienda
	activepickup = jQuery('.shipping-pickup-store').length
	valSelectpick = jQuery('#shipping-pickup-store-select option:selected').attr('data-id');
	disablelink  = jQuery( "#messages-tab" ).hasClass('isdisabledlink')

	if(disablelink != true){

		if( (valSelectpick == undefined)  && (activepickup != '0') ){
			//deshabilitamos todos los botones de pago si no ha selaccionado una opcin de recogida
			jQuery('#butonnextcheck').addClass('isdisabledlink')
			jQuery('#butonnextcheck').attr("data-toggle","tooltip");		
			jQuery('#butonnextcheck').attr("title","Es necesario seleccionar un lugar de recogida para cotinuar.");
			jQuery('#npago-tab').addClass('isdisabledlink')
			jQuery('#npago-tab').attr("data-toggle","tooltip");		
			jQuery('#npago-tab').attr("title","Es necesario seleccionar un lugar de recogida para cotinuar.");
			jQuery("#butonnextcheck").on('click', function (event) {
				event.preventDefault()
				jQuery('#myTab a[href="#messages"]').tab('show')
			});
		}else{
			jQuery('#butonnextcheck').removeClass('isdisabledlink')
			jQuery('#butonnextcheck').removeAttr("data-toggle");		
			jQuery('#butonnextcheck').removeAttr("data-original-title");		
			jQuery('#butonnextcheck').removeAttr("title");		
			//boton continuar datos pago
			jQuery("#butonnextcheck").on('click', function (event) {
				event.preventDefault()
				jQuery('#myTab a[href="#npago"]').tab('show')
			});
			jQuery('#npago-tab').removeClass('isdisabledlink')
			jQuery('#npago-tab').attr("data-toggle","tab");
			jQuery('#npago-tab').removeAttr("data-original-title");		
			jQuery('#npago-tab').removeAttr("title");	
		}

	}

	//Cambiamos a la tab de pago al seleccionar un metod de envio Estádar/Gratuito
	jQuery('#flat_rate9').click(function() {
		setTimeout(function(){ 
			jQuery('#myTab a[href="#npago"]').tab('show')
			}, 1000);
	});
	jQuery('#free_shipping8').click(function() {
		setTimeout(function(){ 
			jQuery('#myTab a[href="#npago"]').tab('show')
			}, 1000);
	});

	
</script>