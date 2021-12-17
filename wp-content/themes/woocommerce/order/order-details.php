<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<section class="woocommerce-order-details ">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<p class="fs-13 px-md-5 px-3 pt-0 pt-md-3 mb-4 mostrarsst text-center text-xl-left"><?php _e('Detalles del pedido', 'santa-cole') ?></p>	
	
	<!-- <h2 class="woocommerce-order-details__title"><?php //esc_html_e( 'Order details', 'woocommerce' ); ?></h2> -->

	<table class="woocommerce-table woocommerce-table--order-details shop_table order_details ">

		<!-- <thead>
			<tr>
				<th class="woocommerce-table__product-name product-name"><?php //esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="woocommerce-table__product-table product-total"><?php //esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead> -->

		<tbody>
			<?php
				do_action( 'woocommerce_order_details_before_order_table_items', $order );

				foreach ( $order_items as $item_id => $item ) {
					$product = $item->get_product();

					wc_get_template(
						'order/order-details-item.php',
						array(
							'order'              => $order,
							'item_id'            => $item_id,
							'item'               => $item,
							'show_purchase_note' => $show_purchase_note,
							'purchase_note'      => $product ? $product->get_purchase_note() : '',
							'product'            => $product,
						)
					);
				}

				do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
			<tr>
				<td style="padding-bottom:20px;"></td>
				<td></td>
			</tr>
		</tbody>

		<tfoot>
			<tr>
				<td style="padding-top:20px;"></td>
				<td></td>
			</tr>
			<?php
				foreach ( $order->get_order_item_totals() as $key => $total ) {
				if($key != 'payment_method' and $key != 'order_total'){
			?>
					<tr>
						<th class="pl-3 pl-md-5" colspan="2"><?php echo esc_html( $total['label'] ); ?></th>
						<td class="pr-3 pr-md-5 text-right"><strong><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
					</tr>
					<?php
				}
			}
			?>
			<tr>
				<td style="padding-top:20px;"></td>
				<td></td>
			</tr>

			<?php 

				foreach ( $order->get_order_item_totals() as $key => $total ) {
				

					if($key == 'order_total'){

					?>
						<tr style="border-top:1px solid silver">
							<th class="pl-3 pl-md-5" colspan="2" style="padding-top:40px;"><p class="fs-13 mostrarsst"><?php echo esc_html( $total['label'] ); ?></p></th>
				
							<td class="pr-3 pr-md-5 text-right elimtest" style="padding-top:40px;"><strong><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
						</tr>
						<?php
					}
				}
		

			?>

			<?php //if ( $order->get_customer_note() ) : ?>
				<!-- <tr>
					<th class="pl-5" colspan="2"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td class="pr-5 text-right"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr> -->
			<?php //endif; ?>
		</tfoot>
	</table>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>











<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
