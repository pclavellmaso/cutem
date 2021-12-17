<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?> 

<!-- <div class="woocommerce-billing-fields"> -->
	<?php //if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<!-- <h3><?php //esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3> -->

	<?php //else : ?>

		<!-- <h3><?php //esc_html_e( 'Billing details', 'woocommerce' ); ?></h3> -->

	<?php //endif; ?>
			<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
						<?php
							$fields = $checkout->get_checkout_fields( 'billing' );

								foreach ( $fields as $key => $field ) {
						
								//echo $key.'<br>';
								if($key === 'billing_first_name' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_last_name' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_company' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_email' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_phone' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
							}
						?>
						<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>

					</div>
					<div class="col-12 col-md-6 eliminamoselema mb-5">
						<!-- <p class="mb-5 fs-1 fw-500"><?php //_e( 'Dirección de facturación', 'santacole' ); ?></p> -->
						
						<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
						<?php
							$fields = $checkout->get_checkout_fields( 'billing' );

							foreach ( $fields as $key => $field ) {
								//echo $key.'<br>';
								if($key === 'billing_country' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_address_1' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_address_2' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_postcode' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_city' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}
								if($key === 'billing_state' ){
									woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
								}			
									
							}
						?>
						<?php //do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>

					</div>
				</div>
				<?php 
					$curr = wp_get_current_user();
					$loguser =  $curr->user_login;
					if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados'): 
				?>
					<div class="row">
						<div class="col-12 py-4 ">
							<div class="d-flex justify-content-between">
								<p class="mb-5 fs-1 fw-500" id="mostrarempresas"><?php _e( 'Datos para empresas', 'santacole' ); ?></p>
								<p class="mb-5 fs-1 fw-500" id="cultarrempresas"><?php _e( 'Cerrar datos para empresas', 'santacole' ); ?></p>
							</div>
							<div class="ocultarempresas">
								<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
							</div>
						</div>
					</div>	
				<?php endif; ?>	
			</div>			
			<div class="col-12 col-md-4">
				
				<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
					<div class="woocommerce-account-fields">
						<?php if ( ! $checkout->is_registration_required() ) : ?>
							<p class="mb-5 fs-1 fw-500"><?php _e( 'Gardar tu datos', 'santacole' ); ?></p>
							<p><?php _e( 'Guarda tus datos y ahorra tiempo en tus futuras compras.', 'santacole' ); ?></p>
							<p class="form-row form-row-wide create-account">
								
								<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" 
									<?php //checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> 
									type="checkbox" name="createaccount" value="1" /> 

								<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox" for="createaccount">
									<span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
								</label>
							</p>

						<?php endif; ?>

						<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

						<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

							<div class="create-account">
								<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
									<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
								<?php endforeach; ?>
								<div class="clear"></div>
							</div>

						<?php endif; ?>

						<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
					</div>
				<?php else: ?>

					<p class="mb-5 fs-1 fw-500"><?php _e( 'Envío y pago', 'santacole' ); ?></p>

					
			<?php endif; ?>
				<!-- Notas del pedido, originalmente se encuentran en chekout/form-shipping.php -->
				<div class="woocommerce-additional-fields">
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

						<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

							<h3><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>

						<?php endif; ?>

						<div class="woocommerce-additional-fields__field-wrapper">
							<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
								<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
							<?php endforeach; ?>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
				</div>
				<a id="butonnextmessages"class="buttoncont square-btn-black"> <?php _e( 'Continuar', 'santacole' ); ?></a>
			</div>

	<?php //do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<!-- <div class="woocommerce-billing-fields__field-wrapper">  -->
		<?php
		// 	$fields = $checkout->get_checkout_fields( 'billing' );

		// foreach ( $fields as $key => $field ) {
		// 	woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		// }
		?>
	<!-- </div> -->

	<?php //do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
<!-- </div> -->

<script>

	jQuery('#contenedoform1 #factory_field').remove()			
	jQuery('#contenedoform1 #factoryemail_field').remove()			
	jQuery('#contenedoform1 #factorydireccion_field').remove()
	jQuery('#contenedoform1 #factorycp_field').remove()			
	jQuery('#contenedoform1 #factoryciudad_field').remove()			
	jQuery('#contenedoform1 #factorypais_field').remove()	
	jQuery('#contenedoform1 #factorynif_field').remove()	
	jQuery('#contenedoform1  #factoryphone_field').remove()		
	jQuery('#contenedoform1  #factoryactivempresa_field').remove()		
	jQuery('.ocultarempresas  #nif_field').remove()		

	jQuery('#mostrarempresas').click(function(e){
		jQuery('.ocultarempresas').addClass('mostrarempresas')
		jQuery('#cultarrempresas').show()	
		jQuery('#mostrarempresas').hide()
		jQuery('#factoryactivempresa').val('1')
		jQuery(".ocultarempresas input").attr("required", "true")
		jQuery('.ocultarempresas #factoryactivempresa_field').hide()	
		
		jQuery('#contenedoform1 #nif').hide()
		jQuery('#contenedoform1 #nif').val('')
		
	})
	jQuery('#cultarrempresas').click(function(e){
		jQuery('#cultarrempresas').hide()	
		jQuery('#mostrarempresas').show()	
		jQuery('.ocultarempresas').removeClass('mostrarempresas')
		jQuery('#factoryactivempresa').val('0')

		jQuery('#factorynif').val('')

		jQuery('#contenedoform1 #nif').show()
	})


	jQuery('#nif').attr("data-toggle","tooltip");		
	jQuery('#nif').attr("title","Este campo es obligatorio a partir de 3.000 € de compra.");

	jQuery('#factorynif').attr("data-toggle","tooltip");		
	jQuery('#factorynif').attr("title","Este campo es obligatorio a partir de 3.000 € de compra.");
	
	jQuery(function () {
		jQuery('[data-toggle="tooltip"]').tooltip()
	})
</script>
