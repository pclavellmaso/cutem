<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
 
echo wc_get_stock_html( $product ); // WPCS: XSS ok.

// print_r($product);

$languageee = apply_filters( 'wpml_current_language', NULL );
$short_description = $product->get_short_description();

if( has_term( 'arte', 'product_cat' ) || has_term( 'art', 'product_cat' ) ){ ?>
<div class="mb-4 fs-09 color-grey-light3">
    <?php 
		echo $short_description;
	?>
</div>
<?php } ?>


<?php
if ( $product->is_in_stock() ) : ?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart"
    action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
    method="post" enctype='multipart/form-data'>
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>


    <div class="row d-flex align-items-center mainbutonart px-3 simple1">
        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"
            class="single_add_to_cart_button button alt mr-0 mr-md-3 mb-2"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
    </div>
    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php else : ?>

<?php endif; ?>

<?php if (!comprar()) { ?>

<div class="row d-flex align-items-center mainbutonart px-3 simple2">

    <a href="<?php echo home_url(); ?><?php if ($languageee == 'es') {echo '/donde-comprar/';} elseif ($languageee == 'en'){echo '/where-to-buy/';}?>"
        class="buttoncont button square-btn-black fs-09 py-4 mr-0 mr-md-3 mb-2"><?php _e('Donde comprar', 'santa-cole') ?>
    </a>

    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>

</div>

<?php } ?>