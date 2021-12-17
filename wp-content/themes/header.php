<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package santa_cole
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <meta name="theme-color" content="#fff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <?php
        // Códigos de seguimientos
        if( have_rows('codigos_de_seguimiento', 'option') ):

            // Loop through rows.
            while( have_rows('codigos_de_seguimiento', 'option') ) : the_row();

                // Load sub field value.
                the_sub_field('codigo_de_seguimiento', 'option');
                // Do something...

            // End loop.
            endwhile;
        endif;
    ?>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site margin-top-content top-bar-margin top-bar-margin-classy">
        <header id="masthead" class="site-header fixed-top bg-transparent">
            <nav class="navbar-main navbar-expand-xl
        <?php
        if ( is_user_logged_in() ) {
          $user = wp_get_current_user();
          if ($user->roles[0] == 'administrator') { ?>
            logged-admin
          <?php
          }
        }
        ?>
        navbar-transition top-bar-include">

                <?php
          if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            if ($user->roles[0] == 'administrator') { ?>
                <div class="fc-adminbar px-2 px-lg-5 bg-black color-custom-white
             fs-08 py-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="<?php echo site_url()?>/wp-admin">
                                        Panel de administración Santa i Cole
                                    </a>
                                    <a href="https://www.santacole.com/santa-login.php?loggedout=true">
                                        Cerrar sesión
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
          }
          ?>

                <?php $logo_mobile = get_field('logo_mobile', 'option'); ?>

                <div class="wrapper-header">
                    <div class="container-fluid">

                        <div class="row align-items-center justify-content-between">

                            <div class="col-4 d-xl-flex d-none align-items-center justify-content-start">
                                <a href="#"
                                    class="open-search pr-5 fal fa-search fa-sm color-black under-box d-xl-block d-none">
                                </a>
                                <?php
                                    wp_nav_menu([
                                    'menu'	           => 'primary-classy',
                                    'theme_location'   => 'primary',
                                    'container'        => 'div',
                                    'container_id'     => 'navbar',
                                    'depth'            => 3,
                                    'container_class'  => 'menu collapse navbar-collapse justify-content-end py-xl-3 flex-grow-0',
                                    'menu_id'          => 'main-menu-classy',
                                    'menu_class'       => 'navbar-nav nav-primary text-center text-xl-left justify-content-end',
                                    'fallback_cb'      => 'WP_Bootstrap_Navwalker::fallback',
                                    'walker'           => new WP_Bootstrap_Navwalker()
                                    ]);
                                    ?>
                            </div>

                            <div class="col-4 d-xl-block d-none text-center navbar-brand m-0 py-4">
                                <?php the_custom_logo(); ?>
                            </div>

                            <div class="col-4 nav-secondary d-xl-flex d-none align-items-center justify-content-end">
                                <?php

                                    wp_nav_menu([
                                        'menu'	           => 'menu-secondary',
                                        'theme_location'   => 'secondary',
                                        'container'        => 'div',
                                        'container_id'     => 'navbar_secondary',
                                        'depth'            => 3,
                                        'container_class'  => 'menu collapse navbar-collapse justify-content-end py-lg-3 flex-grow-0',
                                        'menu_id'          => 'main-menu-secondary',
                                        'menu_class'       => 'navbar-nav nav-primary text-center text-lg-left justify-content-end',
                                        'fallback_cb'      => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'           => new WP_Bootstrap_Navwalker(),
                                    ]);

                                ?>

                                <div class="padre-minicart d-lg-block d-none pl-3">

                                    <?php 
                                        $idpages = get_the_ID();
                                        // echo $idpages; 
                                        if( $idpages == '8' or $idpages == '9' or $idpages == '10' or $idpages == '12674' or $idpages == '99113'):
                                    ?>
                                    <div class="icon-cart-wrapper rel-wrapper">
                                        <a href="<?php echo home_url('/carrito/')?>">
                                            <div class="fal fa-shopping-bag fa-lg">
                                                <?php $items_cart = WC()->cart->get_cart_contents_count(); ?>
                                                <?php if($items_cart): ?>
                                                <span><?php echo $items_cart; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div id="icon-cart" class="icon-cart-wrapper rel-wrapper">
                                        <div class="fal fa-shopping-bag fa-lg">
                                            <?php $items_cart = WC()->cart->get_cart_contents_count(); ?>
                                            <?php if($items_cart): ?>
                                            <span><?php echo $items_cart; ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="minicart-modal">
                                        <?php
                                            if ( !function_exists('dynamic_sidebar')
                                            || !dynamic_sidebar('Nav_header') ) : 
                                            ?>

                                        <?php endif; ?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-6 d-xl-none d-flex navbar-brand navbrand-movil m-0 py-4 ">

                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo $logo_mobile; ?>" alt="Logo Santa Cole" class="img-fluid"
                                        height="auto">
                                </a>
                            </div>

                            <div class="col-6 d-xl-none d-flex justify-content-between align-items-center">

                                <div>
                                    <a href="#" class="open-search fal fa-search fa-lg color-black under-box">
                                    </a>
                                </div>

                                <div id="icon-cart-mobile" class="icon-cart-wrapper rel-wrapper">
                                    <a class="fal fa-shopping-bag fa-lg" href="<?php echo wc_get_cart_url(); ?>">
                                        <?php $items_cart = WC()->cart->get_cart_contents_count(); ?>
                                        <?php if($items_cart): ?>
                                        <span><?php echo $items_cart; ?></span>
                                        <?php endif; ?>
                                    </a>
                                    <div class="minicart-modal">
                                        <?php
                                            if ( !function_exists('dynamic_sidebar')
                                            || !dynamic_sidebar('Nav_header') ) : 
                                            ?>

                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div>
                                    <a class="navbar-toggler-right navbar-icon-menu color-custom-black"
                                        data-toggle="collapse" data-target="#navbar_mobile" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">
                                        <span class="fal fa-bars fa-lg pt-1"></span>
                                    </a>
                                    <a href="#" class="collapse closed-menu-mobile fs-1">
                                        <span class="fal fa-times fa-2x"></span>
                                    </a>
                                </div>


                            </div>


                        </div>

                    </div>
                </div>
                <div class="menu-mobile d-xl-none d-block">
                    <?php

                        wp_nav_menu([
                            'menu'	           => 'primary-classy',
                            'theme_location'   => 'mobile',
                            'container'        => 'div',
                            'container_id'     => 'navbar_mobile',
                            'depth'            => 3,
                            'container_class'  => 'menu collapse navbar-collapse justify-content-end py-xl-3 flex-grow-0',
                            'menu_id'          => 'main-menu-mobile',
                            'menu_class'       => 'navbar-nav nav-primary text-center text-xl-left justify-content-end',
                            'fallback_cb'      => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'           => new WP_Bootstrap_Navwalker(),
                        ]);

                    ?>
                </div>
            </nav>
        </header>



        <!-- Search Modal -->
        <div class="bg-white p-lg-5 p-4" id="searchModal">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-between align-items-center px-0">
                        <span class="color-black d-block title-search">
                            <?php //_e('Búscador', 'santa-cole') ?>
                        </span>
                        <div id="close-buscador">
                            <span class="fal fa-times color-custom-black fa-lg" style="cursor:pointer;"></span>
                        </div>
                    </div>

                    <div class="col-11 py-4">
                        <?php //echo custom_product_search_form(); 
                        echo get_search_form();
                        ?>
                    </div>
                    <div class="col-11">
                        <div class="container-fluid px-0">
                            <div class="row mx-0">
                                <div class="col-12 px-0 mb-3">
                                    <span class=" color-grey-light3 d-block">
                                        Búsquedas recientes
                                    </span>
                                </div>
                                <?php 
                                            if( have_rows('enlaces_rapidos','option') ):
                                            while ( have_rows('enlaces_rapidos','option') ) : the_row(); 

                                            $link = get_sub_field('enlace','option');
                                            if( $link ): 
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                <div class="col-lg-auto col-12 pl-0">
                                    <a class="button pl-0 color-custom-black text-underline"
                                        href="<?php echo esc_url( $link_url ); ?>"
                                        target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                </div>
                                <?php 
                                                endif; 
                                                endwhile;
                                                endif;
                                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL OLVIDO PASS -->
        <div class="modalnav" id="forgetpassModal">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between px-0">
                        <span
                            class="d-block titleforget"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></span>

                        <div id="close-navModal">
                            <span class="fal fa-times color-custom-black fa-lg"></span>
                        </div>
                    </div>
                    <div class="col-12 px-0 py-4">

                        <?php 
                           defined( 'ABSPATH' ) || exit;

                           do_action( 'woocommerce_before_lost_password_form' );
                           ?>

                        <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                            <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?>
                            </p><?php // @codingStandardsIgnoreLine ?>

                            <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                <label
                                    for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="text"
                                    name="user_login" id="user_login" autocomplete="username" />
                            </p>

                            <div class="clear"></div>

                            <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                            <p class="woocommerce-form-row form-row">
                                <input type="hidden" name="wc_reset_password" value="true" />
                                <button type="submit" class="single_add_to_cart_button button alt"
                                    value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
                            </p>

                            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

                        </form>
                        <?php
                           do_action( 'woocommerce_after_lost_password_form' );
                        ?>
                    </div>

                </div>
            </div>
        </div>





        <!-- MODAL MENUS -->
        <div class="modalnav" id="navModal">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between px-0">
                        <span class="d-block fs-1"><?php _e('Contacto y servicios', 'santa-cole') ?></span>

                        <div id="close-navModal">
                            <span class="fal fa-times color-custom-black fa-lg"></span>
                        </div>
                    </div>
                    <?php 
                        if( have_rows('secciones_headers', 'option') ):
                        while ( have_rows('secciones_headers', 'option') ) : the_row(); 
                    ?>
                    <div class="col-12 border-bottom px-0 py-lg-5 py-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-2 px-0">
                                    <div class="circle bg-custom-black p-3 fs-1">
                                        <span class="text-white <?php the_sub_field('icono', 'option') ?> fa-lg"></span>
                                    </div>

                                </div>
                                <div class="col-10 pr-0">
                                    <span
                                        class="d-block fw-500 mb-2 fs-08"><?php the_sub_field('titulo', 'option') ?></span>
                                    <span
                                        class="d-block mb-3 color-grey-light3 fs-08"><?php the_sub_field('texto', 'option') ?></span>


                                    <div class="container-fluid px-0">
                                        <div class="row mx-0">

                                            <?php 
                                            if( have_rows('enlaces','option') ):
                                            while ( have_rows('enlaces','option') ) : the_row(); 

                                            $link = get_sub_field('enlace','option');
                                            if( $link ): 
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <div class="col pl-0">
                                                <a class="button color-grey-light3 text-underline pl-0"
                                                    href="<?php echo esc_url( $link_url ); ?>"
                                                    target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                            </div>
                                            <?php 
                                                endif; 
                                                endwhile;
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php  
                        endwhile;
                        endif;
                    ?>

                </div>
            </div>

        </div>
        <div class="d-lg-block d-none">
            <?php             
            if ( !is_user_logged_in() ) {
        ?>
            <div class="u-columns col2-set" id="customer_login_header">
                <div class="container-fluid mb-lg-5 mb-4">
                    <div class="row justify-content-between">
                        <div class="col-auto px-0">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-0 active" id="pills-login-tab" data-toggle="pill"
                                        href="#pills-login" role="tab" aria-controls="pills-login"
                                        aria-selected="true"><?php _e('Iniciar sesión', 'santa-cole') ?></a>
                                </li>
                                <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
                                <li class="nav-item px-0" role="presentation">
                                    <a class="nav-link">/</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-0" id="pills-register-tab" data-toggle="pill"
                                        href="#pills-register" role="tab" aria-controls="pills-register"
                                        aria-selected="false"><?php _e('Registrarse', 'santa-cole') ?></a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <span id="close-login" class="fal fa-times color-custom-black fa-lg"
                                aria-hidden="true"></span>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                        aria-labelledby="pills-login-tab">
                        <div class="u-column1">

                            <!-- <h2><?php //esc_html_e( 'Login', 'woocommerce' ); ?></h2> -->

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

                                <div class="d-flex justify-content-between align-items-center">
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

                                    <p class="passperdida">
                                        <a href="" class="color-grey fs-09 linkmas">
                                            <?php esc_html_e( '¿Has olvidado tu contraseña?', 'woocommerce' ); ?>
                                            <span
                                                class="text-underline"><?php esc_html_e( 'Recordar contraseña', 'woocommerce' ); ?></span>
                                        </a>
                                    </p>
                                </div>
                                <p class="form-row">
                                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                    <button type="submit" class="single_add_to_cart_button button alt" name="login"
                                        value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                                </p>

                                <?php do_action( 'woocommerce_login_form_end' ); ?>

                            </form>
                            <?php 

                        if (is_product() || is_cart() || is_checkout() || is_account_page()) {
                           echo '<div class="nada"></div>';
                        }else {
                            do_action( 'woocommerce_before_customer_login_form' ); 
                        }
                        
                        ?>
                        </div>
                        <div class="alignbot">
                            <a href="https://viadirecta.santacole.com/" target="_blank"
                                class="add_to_wishlist single_add_to_wishlist button alt border-1 d-block ">
                                <?php _e('Acceso distribuidor', 'santa-cole') ?>
                            </a>
                        </div>
                    </div>
                    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                        <nav class="mb-4">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link pl-0 active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true"><i
                                        class="fas fa-circle pr-2"></i> <?php _e('Particular', 'santa-cole') ?></a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile" aria-selected="false"><i
                                        class="fas fa-circle pr-2"></i>
                                    <?php _e('Profesional', 'santa-cole') ?></a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="u-column2">

                                    <!-- <h2><?php //esc_html_e( 'Register', 'woocommerce' ); ?></h2> -->

                                    <form method="post" class="woocommerce-form woocommerce-form-register register"
                                        <?php do_action( 'woocommerce_register_form_tag' ); ?>>

                                        <?php do_action( 'woocommerce_register_form_start' ); ?>

                                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                                        <p
                                            class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <!-- <label for="reg_username"><?php //esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label> -->
                                            <input type="text"
                                                placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?>"
                                                class="woocommerce-Input woocommerce-Input--text input-text"
                                                name="username" id="reg_username" autocomplete="username"
                                                value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                        </p>

                                        <?php endif; ?>

                                        <p
                                            class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <!-- <label for="reg_email"><?php //esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label> -->
                                            <input type="email"
                                                placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>"
                                                class="woocommerce-Input woocommerce-Input--text input-text"
                                                name="email" id="reg_email" autocomplete="email"
                                                value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                        </p>

                                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                                        <p
                                            class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <!-- <label for="reg_password"><?php //esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label> -->
                                            <input type="password"
                                                placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>"
                                                class="woocommerce-Input woocommerce-Input--text input-text"
                                                name="password" id="reg_password" autocomplete="new-password" />
                                        </p>

                                        <?php else : ?>

                                        <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?>
                                        </p>

                                        <?php endif; ?>

                                        <?php do_action( 'woocommerce_register_form' ); ?>

                                        <p class="woocommerce-form-row form-row">
                                            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                                            <button type="submit" class="single_add_to_cart_button button alt"
                                                name="register"
                                                value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                                        </p>

                                        <?php do_action( 'woocommerce_register_form_end' ); ?>

                                    </form>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="u-column3">

                                    <form action="" method="post" name="user_registration" class="register-form">

                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_fname" id="register_fname" class="input"
                                                value="" size="20" placeholder="Nombre">
                                        </span>
                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_lname" id="register_lname" class="input"
                                                value="" size="20" placeholder="Apellido">
                                        </span>

                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_email" id="register_email" class="input"
                                                value="" size="20"
                                                placeholder="<?php _e('Dirección de correo electrónico', 'woocommerce') ?>">
                                        </span>


                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_empresa" id="register_empresa"
                                                class="input" value="" size="20"
                                                placeholder="<?php _e('Empresa', 'woocommerce') ?>">
                                        </span>
                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_profesion" id="register_profesion"
                                                class="input" value="" size="20"
                                                placeholder="<?php _e('Profesión', 'woocommerce') ?>">
                                        </span>
                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_pais" id="register_pais" class="input"
                                                value="" size="20" placeholder="<?php _e('País', 'woocommerce') ?>">
                                        </span>


                                        <span class="login-field mb-3 d-block">
                                            <input type="text" name="register_username" id="register_username"
                                                class="input" value="" size="20" placeholder="Nombre de usuario">
                                        </span>
                                        <span class="login-field mb-2 d-block">
                                            <input type="password" name="register_pass" id="register_pass" class="input"
                                                value="" size="20" placeholder="Contraseña">
                                        </span>

                                        <p class="form-row form-row news-suscription validate-required"
                                            id="news_suscription_field" data-priority="">
                                            <span class="woocommerce-input-wrapper">
                                                <label
                                                    class="checkbox woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                    <input type="checkbox"
                                                        class="input-checkbox woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                                        name="news_suscription" id="news_suscription" value="1">
                                                    <span>Suscríbete para ser el primero en recibir información sobre
                                                        nuestros productos, lanzamientos y eventos especiales.</span>
                                                </label>
                                            </span>
                                        </p>


                                        <p class="form-row form-row privacy validate-required" id="privacy_policy_field"
                                            data-priority="">
                                            <span class="woocommerce-input-wrapper">
                                                <label
                                                    class="checkbox woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                    <input type="checkbox"
                                                        class="input-checkbox woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                                        name="privacy_policy" id="privacy_policy" value="1"> <span>He
                                                        leído y acepto los términos y condiciones, así como la <a
                                                            href="https://www.santacole.com/en/about-us/privacy-policy/">Política
                                                            de Datos y Privacidad</a></span>
                                                </label>
                                            </span>
                                        </p>

                                        <span class="my-3 d-block">
                                            <input type="submit" name="user_registration"
                                                class="single_add_to_cart_button button alt" value="Registrarse"
                                                style="width:auto;  ">
                                        </span>
                                    </form>
                                    <div class="text-center">
                                        <?php
                                    if (isset($_POST['user_registration'])) {

                                        $error_count = 0;
                                        $error_format_1 = '<div><p class="p-3 color-custom-white" style="background-color:#293543;"><strong>Error! </strong>';
                                        $error_format_2 = '</p></div>';
                                        $email = $_POST['register_email'];
                                        $fname = $_POST['register_fname'];
                                        $lname = $_POST['register_lname'];
                                        $username = $_POST['register_username'];
                                        $password = $_POST['register_pass'];
                                        $empresa = $_POST['register_empresa'];
                                        $profesion = $_POST['register_profesion'];
                                        $pais = $_POST['register_pais'];


                                    if ( empty( $username ) || empty( $email ) || empty($password) || empty($fname) || empty($lname) || 
                                            empty($empresa) || empty($profesion) || empty($pais)
                                    ) {
                                        $register_error = 'Por favor llena todos los campos';
                                        $error_count = 1;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                    } else {

                                        if ( 4 > strlen( $empresa ) ) {
                                        $register_error = 'El campo empresan no es valido';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( 4 > strlen( $profesion ) ) {
                                        $register_error = 'El campo profesión no es valido';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( 4 > strlen( $pais ) ) {
                                        $register_error = 'El campo país no es valido';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }

                                        if ( 6 > strlen( $username ) ) {
                                        $register_error = 'El nombre de usuario es muy corto. Al menos introduce 6 caracteres';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( username_exists( $username ) ) {
                                        $register_error = 'El nombre de usuario ya está registrado';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( ! validate_username( $username ) ) {
                                        $register_error = 'El nombre de usuario no es válido';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( !is_email( $email ) ) {
                                        $register_error = 'El correo electrónico no es válido';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( email_exists( $email ) ) {
                                        $register_error = 'El correo electrónico ya está registrado';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                        if ( 5 > strlen( $password ) ) {
                                        $register_error = 'La contraseña debe tener más de 5 caracteres';
                                        $error_count = 1;
                                        // echo $error_format_1 . $register_error . $error_format_2;
                                        wc_add_notice(__(  $register_error ), 'error');
                                        }
                                    }
                                    if ( $error_count == 0 ) {
                                        global $username, $email, $password, $fname, $lname , $lempresa, $lprofesion, $lpais;
                                        $username   =   sanitize_user( $_POST['register_username'] );
                                        $email      =   sanitize_email( $_POST['register_email'] );
                                        $password   =   esc_attr( $_POST['register_pass'] );
                                        $fname      =   sanitize_text_field( $_POST['register_fname'] );
                                        $lname      =   sanitize_text_field( $_POST['register_lname'] );
                                        $lempresa      =   sanitize_text_field( $_POST['register_empresa'] );
                                        $lprofesion      =   sanitize_text_field( $_POST['register_profesion'] );
                                        $lpais      =   sanitize_text_field( $_POST['register_pais'] );

                                        $userdata = array(
                                        'user_login'    =>   $username,
                                        'user_email'    =>   $email,
                                        'user_pass'     =>   $password,
                                        'first_name'    =>   $fname,
                                        'last_name'     =>   $lname,

                                        // 'last_name'     =>   $lempresa,
                                        // 'last_name'     =>   $lprofesion,
                                        // 'last_name'     =>   $lpais,


                                        'role'          =>   'profesional'
                                        );
                                        $user = wp_insert_user( $userdata );

                                        $from      = get_option('admin_email');
                                        $headers   = array('Content-Type: text/html; charset=UTF-8', 'From: '.$from . "\r\n");
                                        $subject   = 'Registro completado - Santa & Cole';
                                        $url       = get_site_url() . '/mi-cuenta/';
                                        $main_url  = get_site_url();
                                        $message   = '<img width="150" height="auto" src="' . $main_url . '/wp-content/themes/memoria/img/logo-color.png">
                                        <h3>¡Registro completado!</h3><h4>Puedes iniciar sesión en la web del Santa & Cole haciendo click <a href=' . $url . '><b>aquí</b></a></h4>';

                                        // Email password and other details to the user
                                        wp_mail( $email, $subject, $message, $headers );

                                        echo '<div class="p-3  color-white" style="background-color: #000;margin-bottom:30px;">Por favor, revisa tu correo para completar el proceso de registro.</div>';
                                    }

                                    }
                                    ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alignbot">
                            <a href="https://viadirecta.santacole.com/" target="_blank"
                                class="add_to_wishlist single_add_to_wishlist button alt border-1 d-block ">
                                <?php _e('Acceso distribuidor', 'santa-cole') ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
            </div>




            <?php
            } else { ?>
            <div class="u-columns col2-set" id="customer_login_header">
                <div class="container-fluid mb-lg-5 mb-4">
                    <div class="row justify-content-between">
                        <div class="col-auto px-0">
                            <h3 class="color-custom-black fs-1 text-capitalize fw-400">
                                <?php _e('Hola,', 'santa-cole') ?>

                                <?php 
                                $user = wp_get_current_user();
                                $user_id = $user->ID;
                                $user_info = get_userdata($user_id); 
                                echo $user_info->first_name .  " " . $user_info->last_name . "\n";
                            ?>
                            </h3>
                        </div>
                        <div class="col-auto">
                            <span id="close-login" class="fal fa-times color-custom-black fa-lg"
                                aria-hidden="true"></span>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 px-0">

                            <div class="woocommerce-MyAccount-content">
                                <?php
                                /**
                                 * My Account content.
                                 *
                                 * @since 2.6.0
                                 */
                                do_action( 'woocommerce_account_content' );
                            ?>
                            </div>
                            <?php do_action( 'woocommerce_account_navigation' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
        ?>
        </div>
        <div id="content" class="site-content mt-content-header <?php //echo get_user_geo_country(); ?>">