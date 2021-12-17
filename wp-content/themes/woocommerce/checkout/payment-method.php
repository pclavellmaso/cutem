<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- 
	Desarrollo original	
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		<?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?> <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li> yith_pos_cash_gateway
-->

<?php 
/*
	Usado para validar los metodos depago de la galeria 
	carga paypal/efectivo al logear con usuario galeria
	carga paupal/tarjeta/klarna para todos los demas
*/
$curr = wp_get_current_user();
$loguser =  $curr->user_login;


	if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados') : 
		if( $gateway->id == 'yith_pos_cash_gateway' or $gateway->id == 'bizum' or $gateway->id == 'cod' or $gateway->id == 'bacs' ):

		if ( $gateway->get_title()  == 'BIZUM' ){
			$titleboton = 'Bizum';
		}elseif ( $gateway->get_title() == 'Dinero en efectivo' ) {
			$titleboton = 'Efectivo';
		}elseif ( $gateway->get_title() == 'Pago con Datáfono' ) {
			$titleboton = 'Datáfono';
		}elseif ( $gateway->get_title() == 'Transferencia bancaria' ) {
			$titleboton = $gateway->get_title();
		}
?>

		<li class="nav-item mainlispayment mb-2" role="tabini">
			<input 
				id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" 
				type="radio" class="input-radio" 
				name="payment_method" 
				value="<?php echo esc_attr( $gateway->id ); ?>" 
				data-order_button_text="<?php _e('Continuar con', 'santacole') ?> <?php _e( $titleboton , 'santacole')  /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>"	
			> 
			<label 
				for="payment_method_<?php echo esc_attr( $gateway->id ); ?>"
				data-id-act="<?php echo esc_attr( $gateway->id ); ?>"
				id="callto_<?php echo esc_attr( $gateway->id ); ?>"
			>
				<i></i>
				<?php 
				
					if( $gateway->get_title() == 'PayPal' || $gateway->get_title() == 'PayPal'){
					
					}elseif( $gateway->get_title() == 'BIZUM' ){
					
					}elseif( $gateway->id == 'klarna_payments_pay_later' ){
					
					}elseif( $gateway->id == 'cod' ){
						echo 'Datáfono';
					}elseif( $gateway->id == 'yith_pos_cash_gateway' ){
						echo 'Efectivo';
					}else{
						echo $gateway->get_title(); 
					}
				
				?>
			</label>
		</li>
		<?php endif; ?>	
		
<?php else: ?>

	<?php
		if( $gateway->id == 'redsys' or $gateway->id == 'bizum' or $gateway->id == 'paypal' or $gateway->id == 'ppcp-gateway' or  $gateway->id == 'klarna_payments_pay_later' ): 
		// echo $gateway->get_title();
		
		if( $gateway->get_title() == 'PayPal' || $gateway->get_title() == 'PayPal'){
			$titleboton =  $gateway->get_title();
		}elseif( $gateway->get_title() == 'BIZUM' ){
			$titleboton =  'Bizum';
		}elseif( $gateway->id == 'klarna_payments_pay_later' ){
			$titleboton =  'Pago a plazos';
		}elseif( $gateway->id == 'redsys' ){
			$titleboton =  $gateway->get_title();
		}else{
			echo $gateway->get_title(); 
		}
	
	?>
	<li class="nav-item mainlispayment mb-2" role="tabini">
		<input 
			id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" 
			type="radio" class="input-radio" 
			name="payment_method" 
			value="<?php echo esc_attr( $gateway->id ); ?>" 
			data-order_button_text="<?php _e('Continuar con', 'santacole') ?> <?php _e( $titleboton , 'santacole') /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>"	
		> 
		<label 
			for="payment_method_<?php echo esc_attr( $gateway->id ); ?>"
			data-id-act="<?php echo esc_attr( $gateway->id ); ?>"
			id="callto_<?php echo esc_attr( $gateway->id ); ?>"
		>
			<i></i>
			<?php 
		
				if( $gateway->get_title() == 'PayPal' || $gateway->get_title() == 'PayPal'){
					
				}elseif( $gateway->get_title() == 'BIZUM' ){
					
				}elseif( $gateway->id == 'klarna_payments_pay_later' ){
					_e( 'Pago a plazos' , 'santacole');
				}elseif( $gateway->id == 'redsys' ){
					_e( 'Tajeta de crédito' , 'santacole');
				}else{
					echo $gateway->get_title(); 
				}
			
			?>
		</label>
	</li>
	<?php endif; ?>	
	
<?php endif; ?>	



