<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */
defined( 'ABSPATH' ) || exit;
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
	
?>
		<div id="payment" class="woocommerce-checkout-payment" ontouchmove >
			<?php if ( WC()->cart->needs_payment() ) : ?>
				<!-- 
					Desarrollo original	
				<ul class="wc_payment_methods payment_methods methods"> -->
					<?php
					// if ( ! empty( $available_gateways ) ) {
					// 	foreach ( $available_gateways as $gateway ) {
					// 		wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					// 	}
					// } else {
					// 	echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
					// }
					?>
				<!-- </ul> -->
				<?php if ( ! empty( $available_gateways ) ): ?>	
				<!-- Nav tabs -->
				<ul class="nav nav-tabs d-flex justify-content-start flex-column flex-md-column flex-lg-column flex-xl-row mb-3" id="pymentstab"  role="tablist">
					<?php
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}				
					?>
				</ul>
				<!-- Tabs -->
				<div class="tab-content py-4" id="pymentstabcontent">
					<?php
						foreach ( $available_gateways as $gateway ) : 
							// echo $gateway->payment_fields();
						?>
							<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
								<div class="tab-pane " id="<?php echo esc_attr( $gateway->id ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $gateway->id ); ?>-tab">
									<?php $gateway->payment_fields(); ?>
								</div>
							<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php else: ?>
					<ul class="nav nav-tabs d-flex justify-content-start mb-3">
						<?php
							echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
						?>
					</ul>
				<?php endif; ?>
				<script>
					//Open tab on load
					openerTabPay = jQuery('#pymentstab li label').attr("data-id-act")
					openTabPay = jQuery('#pymentstabcontent div').attr('id')
					if(openerTabPay === openTabPay){
						jQuery( jQuery('#pymentstabcontent div')[0] ).addClass( "active")
					}
					//Opent/close payment tabs on click
					jQuery('#pymentstab li label').click(function (e) {
						jQuery('#pymentstabcontent .tab-pane').removeClass( "active" )
						let idatt = jQuery(this).attr("data-id-act")
						jQuery('#'+idatt).tab('show')
					})
			
					//Iconos para métodos de pago
					jQuery('#callto_cod').find('i').addClass('fas fa-cash-register')
					jQuery('#callto_yith_pos_cash_gateway').find('i').addClass('far fa-money-bill-alt')
					jQuery('#callto_cheque').find('i').addClass('fal fa-money-check-edit')
					// jQuery('#callto_redsys').find('i').addClass('fal fas fa-credit-card')
					jQuery('#callto_paypal').find('i').addClass('icon-paypal_yovalo')
					jQuery('#callto_ppcp-gateway').find('i').addClass('icon-paypal_yovalo')
					jQuery('#callto_bizum').find('i').addClass('icon-bizum_yovalo')
					// jQuery('#callto_klarna_payments_pay_later').find('i').addClass('icon-klarna_yovalo')
					jQuery('#callto_bacs').find('i').addClass('fas fa-university')
				</script>
			<?php endif; ?>
			<div class="form-row place-order">
		
				<noscript>
					<?php
					/* translators: $1 and $2 opening and closing emphasis tags respectively */
					printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
					?>
					
					<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
				</noscript>
				<?php wc_get_template( 'checkout/terms.php' ); ?>
				<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
				<?php 
					/*
						Usado para añadir modal de contraseña cuando se logea con usuario galeria 
						la contraseña es la que usa normalmente
					*/
					$curr = wp_get_current_user();
					$loguser =  $curr->user_login;
					if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados'){
						$validatorpos = 'activeforpos';
					}else{
						$validatorpos = '';
					}
				?>
				<?php 
					echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="square-btn-black alt '.$validatorpos.'" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine 
					
				?>
					<br>
				<?php do_action( 'woocommerce_review_order_after_submit' ); ?>
				
				<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
			</div>
		</div>
<script>
	//Funciones para el modal de cotraseña para la galeria
	butonPos = jQuery( '.activeforpos' );
	butonPos.mouseover(function(){
		jQuery('#modalPssPos').modal('show')
		jQuery('#modalPssPos').keypress(function(e) {
			if (e.which == 13) {
				return false;
			}
		});
		jQuery('#getvald').click(function( e ){
			valpass = jQuery('#contraspos').val()
			codeval = 'GestorGaleria555'
			if ( valpass == codeval ) {
				jQuery('#modalPssPos').removeAttr('id');
				jQuery('#responsemodal').modal('show')
			}else{
				e.preventDefault();
				jQuery('#responsemodalnegativ').modal('show')
				jQuery('#getvaldneg').click(function() {
					jQuery('#modalPssPos').modal('show')
				})
			}
		})
	});	
	//elimio span check en privacidad
	jQuery('#news_suscription_field .optional').remove()
	//Para modificar un poco el boton de paypal
	jQuery('#ppc-button').addClass('botonnuevo')

</script>


    
          
            
    

          
    
    
  
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}