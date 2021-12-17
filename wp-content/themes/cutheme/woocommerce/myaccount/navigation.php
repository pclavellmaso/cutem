<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<?php  
if (!wp_is_mobile()) {?>
<nav class="woocommerce-MyAccount-navigation">
    <ul>
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
        <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
            <a
                href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php
}else{ ?>
<div class="mb-4">

<script>

jQuery(document).ready(function ($) {


let textdinamic = $('.is-active.d-block').text();

$('#navigationn').html(textdinamic + '<span class="fal fa-chevron-down"></span>');

});


	</script>

    <button class="btn br-0 border-bottom w-100 d-flex justify-content-between align-items-center fs-09 px-0" id="navigationn" type="button" data-toggle="collapse" data-target="#collapseExample"
        aria-expanded="false" aria-controls="collapseExample">

    </button>

    <div class="collapse" id="collapseExample">
        <nav class="woocommerce-MyAccount-navigation mb-0 border-0">
            <ul class="my-0">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> d-block py-3 border-bottom">
                    <a
                        href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>
<?php
}
?>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>