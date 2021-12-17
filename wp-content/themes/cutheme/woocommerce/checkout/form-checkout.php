<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Para no mostrar el notice de login
// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
 <section class="mb-4">
    <div class="container-fluid px-md-3">
        <div class="row">
            <div class="col-12 col-md-6 pl-md-0 linkselemts">
                <a href="<?php echo home_url('/carrito/')?>" class="color-grey-light2"><i class="fal fa-chevron-left"></i> <?php _e( 'Volver al Carrito', 'santacole' ); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="mb-5 pb-5">
    <div class="contaienr-fluid px-md-3">
        <div class="row">
            <div class="col-12 pl-md-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs d-flex justify-content-center" id="myTab"  role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if ( ! is_user_logged_in()  ){ echo 'active'; } ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php _e('1. Acceso', 'santacole')?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link <?php if ( is_user_logged_in()  ){ echo 'active'; } ?>   " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php _e('2. Tus datos', 'santacole')?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false"><?php _e('3.Envío','santacole')?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="npago-tab" data-toggle="tab" href="#npago" role="tab" aria-controls="npago" aria-selected="false"><?php _e('4. Pago','santacole')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#"><?php _e('5. Confirmación de pedido','santacole')?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="vh-30-full">
<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>

    <div id="oculatarestoalclic" class="contaienr-fluid px-3">
        <div class="row justify-content-start justify-content-md-center">
            <div class="col-12 col-md-4 px-md-0">
                <!-- Tabs login -->
                <ul class="nav nav-tabs d-flex justify-content-start justify-content-md-center mb-3 flex-column flex-md-row" id="logintab">
                    <li class="nav-item mx-0 ml-0 mr-3 mb-2" role="tabini">
                        <input 
                            id="login_checkuot_cliente" 
                            type="radio" class="input-radio" 
                            name="login_checkuot" 
                            value="cliente" 	
                            checked
                        > 
                        <label 
                            for="login_checkuot_cliente"
                            data-id-act="cliente"
                            id="callto_cliente"
                        >
                            <?php _e( 'Ya soy cliente', 'santacole' ); ?>                    
                        </label>
                    </li>
                    <li class="nav-item mx-0 mx-md-2 mb-2" role="tabini">
                        <input 
                            id="login_checkuot_registrarse" 
                            type="radio" class="input-radio" 
                            name="login_checkuot" 
                            value="registrarse" 	
                        > 
                        <label 
                            for="login_checkuot_registrarse"
                            data-id-act="registrarse"
                            id="callto_registrarse"
                        >
                            <?php _e( 'Registrarse', 'santacole' ); ?>
                        </label>
                    </li>
                    <li class="nav-item mx-0 ml-md-3 mb-2" role="tabini">
                        <input 
                            id="login_checkuot_invitadoc" 
                            type="radio" class="input-radio" 
                            name="login_checkuot" 
                            value="invitadoc" 	
                        > 
                        <label 
                            for="login_checkuot_invitadoc"
                            data-id-act="invitadoc"
                            id="callto_invitadoc"
                        >
                            <?php _e( 'Invitado', 'santacole' ); ?>
                        </label>
                    </li>
                </ul>
                <div class="tab-content py-4" id="logincontent">
                    <div class="tab-pane active" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">


                    
                        <!-- Tab login  -->
                        <form class="woocommerce-form woocommerce-form-login login" method="post">

                            <?php do_action( 'woocommerce_login_form_start' ); ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <!-- <label
                            for="username"><?php //esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span
                            class="required">*</span></label> -->
                                <input type="text"
                                    placeholder="<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>"
                                    class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                                    id="username" autocomplete="username"
                                    value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <!-- <label for="password"><?php //esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span
                            class="required">*</span></label> -->
                                <input class="woocommerce-Input woocommerce-Input--text input-text"
                                    placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" type="password"
                                    name="password" id="password" autocomplete="current-password" />
                            </p>

                            <?php do_action( 'woocommerce_login_form' ); ?>

                            <div class="d-block d-md-flex justify-content-between align-items-center ">
                                <p class="form-row fs-09">
                                    <label
                                        class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox"
                                            name="rememberme" type="checkbox" id="rememberme" value="forever" />
                                        <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                                    </label>

                                </p>
                                <!-- <p class="woocommerce-LostPassword lost_password">
                                <a href="<?php //echo esc_url( wp_lostpassword_url() ); ?>"
                                    class="color-grey-light3 fs-09"><?php //esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                            </p> -->

                                <p class="passperdida text-right">
                                    <a href="" class="color-grey fs-09 linkmas">
                                        <?php esc_html_e( '¿Has olvidado tu contraseña?', 'woocommerce' ); ?>
                                        <span class="text-underline"><?php esc_html_e( 'Recordar contraseña', 'woocommerce' ); ?></span>
                                    </a>
                                </p>
                            </div>
                            <p class="form-row">
                                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                <button type="submit" class="single_add_to_cart_button button alt" name="login"
                                    value="<?php esc_attr_e( 'Inciar sesión', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                            </p>

                            <?php do_action( 'woocommerce_login_form_end' ); ?>

                        </form>


                    </div>
                    <div class="tab-pane " id="registrarse" role="tabpanel" aria-labelledby="registrarse-tab">
                        <!-- Tab new account -->
                        <form method="post" class="woocommerce-form woocommerce-form-register register"
                            <?php do_action( 'woocommerce_register_form_tag' ); ?>>

                            <?php do_action( 'woocommerce_register_form_start' ); ?>

                            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <!-- <label for="reg_username"><?php //esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span
                                        class="required">*</span></label> -->
                                <input type="text" placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                                    id="reg_username" autocomplete="username"
                                    value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                            </p>

                            <?php endif; ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <!-- <label for="reg_email"><?php //esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span
                                        class="required">*</span></label> -->
                                <input type="email" placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                                    id="reg_email" autocomplete="email"
                                    value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                            </p>

                            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <!-- <label for="reg_password"><?php //esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span
                                        class="required">*</span></label> -->
                                <input type="password" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text"
                                    name="password" id="reg_password" autocomplete="new-password" />
                            </p>

                            <?php else : ?>

                            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

                            <?php endif; ?>

                            <?php do_action( 'woocommerce_register_form' ); ?>

                            <p class="woocommerce-form-row form-row">
                                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                                <button type="submit"
                                    class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit bg-custom-black text-white px-lg-5 px-4 py-2 square-btn-black"
                                    name="register"
                                    value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                            </p>
                            <?php do_action( 'woocommerce_register_form_end' ); ?>
                        </form>
                    </div>
                    <div class="tab-pane " id="invitadoc" role="tabpanel" aria-labelledby="invitadoc-tab">   
                        <!-- Tab guess -->         
                        <p class="mb-5"><?php _e( 'Completa tu pedido sin crear una cuenta. Podrás guardar tus datos en el siguiente paso y ahorrar tiempo en próximas compras.', 'santacole' ); ?></p>
                        <a id="butonnextprofile" class="buttoncont square-btn-black"> <?php _e( 'Continuar', 'santacole' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


    <form name="checkout" id="newsend" method="post" class="checkout woocommerce-checkout"
        action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <?php if ( $checkout->get_checkout_fields() ) : ?>

        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
        <!-- Tabs -->
        <div class="tab-content">
            <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
            <!--TAB LOGEADO -->
                <?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
				

                <?php else: ?>
                    <p class="mb-3 fs-1 fw-500"><?php _e( 'Bienvenido', 'santacole' );?>, 
                        <?php 
                            $user = wp_get_current_user();
                            $user_id = $user->ID;
                            $user_info = get_userdata($user_id); 
                            echo $user_info->first_name .  " " . $user_info->last_name . "\n"; 
                        ?> 
                    </p>
                    <a id="butonnextprofileloged" class="buttoncont square-btn-black"> <?php _e( 'Continuar con el pago', 'santacole' ); ?></a>
                <?php endif; ?>
            </div>
            <div class="tab-pane <?php if ( is_user_logged_in()  ){ echo 'active'; } ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <!--TAB TUS DATOS -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-8 px-3 pl-md-0">
                            <p class="mb-5 fs-1 fw-500"><?php _e( 'Datos personales', 'santacole' ); ?></p>
                            <div class="row" id="contenedoform1">
                                <div class="col-12 col-md-6 mb-4">
                                   <!-- Inicio tabdatos personales -->
                                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                                    <!-- the code finish on form-billing.php -->
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <!--TAB ENVÍO -->
                <div class="container-fluid px-0">
                    <div class="row">
                        <div class="col-12 col-md-12" id="deleteduplicate">
                            <p class="mb-5 fs-1 fw-500"><?php _e( 'Envío', 'santacole' ); ?> </p>
                            <div id="borar-review-shipseccion"> 
                                <!-- La maquetacion de los métodos de envio están en cart/cart-shipping.php --> 
                                <?php remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20)  ?>
                                <?php do_action( 'woocommerce_checkout_order_review' ); ?>   
                            </div>
                            <div id="sendto-diferent" class="col-12 col-md-4 pl-0">
                                <?php do_action( 'woocommerce_checkout_shipping' ); ?>  
                            </div>
                            <a id="butonnextcheck" class="buttoncont square-btn-black mt-4"> <?php _e( 'Continuar', 'santacole' ); ?></a>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="npago" role="tabpanel" aria-labelledby="npago-tab">
                <!--TAB PAGO -->
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-12 col-md-5 pl-3 pl-md-0">
                                <p class="mb-5 fs-1 fw-500"><?php _e( 'Resumen', 'santacole' ); ?> </p>
                                    <?php
                                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                            ?>
                                        <div class="row mb-4 px-3 pb-3 pb-md-0">
                                            
                                            <div class="col-5 col-md-2 pl-md-0 mb-3">
                                                <!-- Image section -->
                                                <?php
                                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                                    if ( ! $product_permalink ) {
                                                        echo $thumbnail; // PHPCS: XSS ok.
                                                    } else {
                                                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-7 col-md-10">
                                                <!-- Description section -->
                                                <div class="row">
                                                    <div class="col-12 col-md-7 mb-3 ">
                                                        <?php
                                                            if ( ! $product_permalink ) {
                                                                echo '<p class="fs-1">'.wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ). '</p>';
                                                            } else {
                                                                echo '<p style="margin-bottom:0px;">'. wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="fs-1">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) ). '</p>';
                                                            }

                                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                            // Meta data. autores/caracteristicas
                                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
                                                            /* $descripcioncheckout = $_product->get_attribute_summary();
                                                            $antes = array(",");
                                                            $despues = array(".");
                                                            $formatoDes = str_replace($antes, $despues, $descripcioncheckout);
                                                            echo '<p class="mb-lg-2 color-grey-light2">'.$formatoDes.'</p>'; */


                                                            // Backorder notification.
                                                            // if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                            //     echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                            // }
                                                            echo '<div id="sectioautores">';
                                                            $autores = get_field('autor', $product_id);
                                                            if( $autores ):
                                                                if( sizeof($autores) > 0 ){
                                                                    $ponercoma = '<span class="eliminarcoma">,</span>';
                                                                }else{
                                                                    $ponercoma = '';
                                                                }
                                                            foreach( $autores as $postt ): 
                                                                $TitleAutor = get_the_title($postt);
                                                            echo '<span class="pr-1 pb-lg-1 mainautor">'.$TitleAutor.$ponercoma.'</span>';
                                                            endforeach;
                                                            endif;
                                                            echo '</div>';
                                                        
                                                        ?>
                                                    </div>
                                                    <div class="col-6 col-md-2">
                                                        <?php 
                                                            // Get cart items quantities
                                                            $cart_item_quantities = WC()->cart->get_cart_item_quantities();
                                                            // Product quantity in cart - All PHP versions
                                                            $product_qty_in_cart = isset( $cart_item_quantities[ $product_id ] ) ? $cart_item_quantities[ $product_id ] : null;
                                                            // Product quantity in cart - Same as the previous one with PHP 7
                                                            $product_qty_in_cart = $cart_item_quantities[ $product_id ] ?? null;
                                                            // Result
                                                            echo $product_qty_in_cart;
                                                        ?>
                                                    </div>
                                                    <div class="col-6 col-md-3 pr-0 text-right">
                                                        <?php
                                                            //precio por unidad
                                                            //echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                            
                                                            if( $_product->get_regular_price() !=  $_product->get_price() ){?>
                                                            <div class="fs-09">
                                                                <?php
                                                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                                                ?>
                                                            </div>
                                                            <?php }else {
                                                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                            }                                                           
                                                        ?>
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3 border-bottom-1 border-color-grey "></div>
                                        </div>
                                    <?php
                                        // endforeach
                                    }
                                }
                                ?>
                                <div class="row px-3 px-md-3" id="motrar-totals-cart">
                                    <?php remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20)  ?>
                                    <?php do_action( 'woocommerce_checkout_order_review' ); ?> 
                                </div>
                            </div>  
                            <div class="col-12 col-md-6 fordelete offset-md-1" id="fordelete">
                                <p class="mb-5 fs-1 fw-500"><?php _e( 'Pago', 'santacole' ); ?> </p>
                            
                                <!-- <h3 id="order_review_heading"><?php //esc_html_e( 'Your order', 'woocommerce' ); ?></h3> -->

                                <?php add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20)  ?>
                                <?php do_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20); ?>
                                    
                                <?php //do_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10); ?>

                                <!-- <div id="order_review" class="woocommerce-checkout-review-order"> -->
                                    <?php //do_action( 'woocommerce_checkout_order_review' ); ?>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
        <?php endif; ?>
    </form>
</section>

<section class="my-4">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12 col-md-6 pl-md-0 linkselemts">
                <a href="<?php echo home_url('/aviso-legal-y-condiciones-de-compra/')?>" class="color-grey-light2 text-underline"><?php _e( 'Condiciones de compra', 'santacole' ); ?></a>
            </div>
            <div class="col-12 col-md-6 pl-md-0 linkselemts d-flex justify-content-end">
                <a href="<?php echo home_url('/contacto/')?>" class="color-grey-light2  text-underline"><?php _e( '¿Necesitas ayuda? Por favor contacta con Atención al cliente.', 'santacole' ); ?></a>
            </div>
        </div>
    </div>
</section>


<!-- Modal validacion pos-->
<div class="modal fade" id="modalPssPos" tabindex="-1" role="dialog" aria-labelledby="modalPssPosLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="modalPssPosLabel"><?php echo _e('Introduce tu contraseña', 'woocommerce'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<input type="password" class="form-control" id="contraspos" placeholder="Password">
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="square-btn-black alt " id="getvald" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal validacion pos response-->
<div class="modal fade" id="responsemodal" tabindex="-1" role="dialog" aria-labelledby="modalPssPosLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="modalPssPosLabel"><?php echo _e('Ahora puedes comprar el producto', 'woocommerce'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer border-top-0">
        <button type="button" class="square-btn-black alt " id="getvaldposi" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal validacion negativa pos response-->
<div class="modal fade" id="responsemodalnegativ" tabindex="-1" role="dialog" aria-labelledby="modalPssPosLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="modalPssPosLabel"><?php echo _e('Debes introducir una contraseña valida', 'woocommerce'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer border-top-0">
        <button type="button" class="square-btn-black alt " id="getvaldneg" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<?php 
    //¿Es usuario con rol Santa & Cole?
    if(!isset($role)){
        $role = null;
    }
    if( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $role = ( array ) $user->roles;
    }
    //SARA = 73198420t
        //¿Es cupón de grupo Santa & Cole?
    //Activo direccion de envío diferente.
    // add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );
    //Cargar de datos en direccion de envío - destino Parc de Belloch.
?>
<?php if( $role[0] == "personal_empresa" ):?>
    <script>  	
        document.getElementById('shipping_country').value = 'ES';
        document.getElementById('shipping_state').value = 'B';
        document.getElementById('shipping_postcode').value = '08431';
        document.getElementById('billing_postcode').value = '08431';
        document.getElementById('shipping_address_1').value = 'Ctra. C-251 km 5,6';
        document.getElementById('shipping_address_2').value = 'Parc de Belloch';
        document.getElementById('shipping_city').value = 'La roca del Vallés';
        document.getElementById('order_comments').value = 'Se registro cupón Santa & Cole, la recogida es en Parc de Belloch.';
        var nombre = document.getElementById('billing_first_name').value;
        var apellido = document.getElementById('billing_last_name').value;
        if(nombre != null || nombre != ''){
            document.getElementById('shipping_first_name').value = nombre;
        }
        if(apellido != null || apellido != ''){
            document.getElementById('shipping_last_name').value = apellido;
        }
        jQuery('#shipping_country option:not(:selected)').attr('disabled',true);
        jQuery('#shipping_state option:not(:selected)').attr('disabled',true);
        document.getElementById('shipping_postcode').readOnly = true;
        document.getElementById('billing_postcode').readOnly = true;
        document.getElementById('shipping_address_1').readOnly = true;
        document.getElementById('shipping_address_2').readOnly = true;
        document.getElementById('shipping_city').readOnly = true;
        jQuery('#shippingtabcontent .tab-pane').addClass( 'active' );
    </script>
<?php else: ?> 
<script>

    //Ocultamos el envio a diferente dirección de entrada
    jQuery('#sendto-diferent').addClass('hideoncheck')
    /*
		Verificamos si existen campos vacios en la tab Tus datos,
		Si hay alguno vacío desactiva el botón y las tab de envio/pago 
	*/
	valname = jQuery( "#billing_first_name" ).val()
	valaddress = jQuery( "#billing_address_1" ).val()
	valcp = jQuery( "#billing_postcode" ).val()
	valcity = jQuery( "#billing_city" ).val()
    if( (valname == '') || (valaddress == '') || (valcp == '') || (valcity == '') ){
        //deshabilitar tabs
        jQuery('#messages-tab').addClass('isdisabledlink')
        jQuery('#messages-tab').attr("data-toggle","tooltip");
        jQuery('#npago-tab').addClass('isdisabledlink')
        jQuery('#npago-tab').attr("data-toggle","tooltip");		
        //deshabilitar boton
        jQuery('#butonnextmessages').attr("data-toggle","tooltip");		
        jQuery('#butonnextmessages').attr("title","Debes completar todos los campos antes de continuar");
        jQuery("#butonnextmessages").on('click', function (event) {
            event.preventDefault()
            jQuery('#myTab a[href="#profile"]').tab('show')
        });
        

    }else{
        
    }
	/*
		Verificamos si hay cambios en los input de la tab Tus datos
		si se cambian y tiene algun valor, activa el botón y las tab
	*/
	jQuery( "#contenedoform1 input" ).change(function() {
		valname = jQuery( "#billing_first_name" ).val()
		valaddress = jQuery( "#billing_address_1" ).val()
        valcp = jQuery( "#billing_postcode" ).val()
		valcity = jQuery( "#billing_city" ).val()
		if( (valname != '') && (valaddress != '') && (valcp != '') && (valcity != '')){
			//Habilitar tabs
			jQuery('#messages-tab').removeClass('isdisabledlink')
        	jQuery('#messages-tab').attr("data-toggle","tab");
        	jQuery('#npago-tab').removeClass('isdisabledlink')
        	jQuery('#npago-tab').attr("data-toggle","tab");
			//Habilitar boton
			jQuery('#butonnextmessages').removeAttr("data-toggle");		
			jQuery('#butonnextmessages').removeAttr("data-original-title");		
			jQuery('#butonnextmessages').removeAttr("title")
			// //boton continuar datos envio
			jQuery("#butonnextmessages").on('click', function (event) {
				event.preventDefault()
				jQuery('#myTab a[href="#messages"]').tab('show')
			});

            //Para ocultar la div que debería ir en la tab  1  haciendo clic en envio
            jQuery('#messages-tab').on('click', function(event){
                jQuery('#oculatarestoalclic').hide()
            });
            //Para ocultar la div que debería ir en la tab  1  haciendo clic en pago
            jQuery('#npago-tab').on('click', function(event){
                jQuery('#oculatarestoalclic').hide()
            });
      
		}else{
			//deshabilitar tabs
			jQuery('#messages-tab').addClass('isdisabledlink')
			jQuery('#messages-tab').attr("data-toggle","tooltip");
			jQuery('#npago-tab').addClass('isdisabledlink')
			jQuery('#npago-tab').attr("data-toggle","tooltip");
			//Habilitar boton
			jQuery('#butonnextmessages').attr("data-toggle","tooltip");		
			jQuery('#butonnextmessages').attr("title","Debes completar todos los campos antes de continuar");
			jQuery("#butonnextmessages").on('click', function (event) {
				event.preventDefault()
				jQuery('#myTab a[href="#profile"]').tab('show')
			});
          
		}
	});

</script>
<?php endif; ?>            
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>