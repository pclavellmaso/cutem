<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cutem
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

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
        <div id="page" class="site margin-top-content top-bar-margin top-bar-margin-classy">
            <header id="masthead" class="site-header fixed-top bg-transparent">
                <nav class="navbar-main navbar-expand-xl navbar-transition top-bar-include
                <?php
                    if ( is_user_logged_in() ) {
                        $user = wp_get_current_user();
                        
                        if ($user->roles[0] == 'administrator') { ?>
                            logged-admin
                        <?php }
                    }
                ?>">

                    <?php
                        /*if ( is_user_logged_in() ) {
                            $user = wp_get_current_user();
                            if ($user->roles[0] == 'administrator') { ?>
                                <div class="fc-adminbar px-2 px-lg-5 bg-black color-custom-white
                            fs-08 py-1">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <a href="<?php echo site_url()?>/wp-admin">
                                                        Panel de administración de Cutem
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
                        }*/
                    ?>

                    <div class="wrapper-header">
                        <div class="container-fluid">

                            <div class="row align-items-center justify-content-between">

                                <div class="col-4 d-xl-flex d-none align-items-center justify-content-start">
                                    <a href="#" class="open-search pr-5 fal fa-search fa-sm color-black under-box d-xl-block d-none">
                                    </a>
                                    <?php
                                        wp_nav_menu([
                                        'menu'	           => 'Principal',
                                        'theme_location'   => 'Primary',
                                        'container'        => 'div',
                                        'container_id'     => 'navbar',
                                        'depth'            => 3,
                                        'container_class'  => 'menu collapse navbar-collapse justify-content-end py-xl-3 flex-grow-0',
                                        'menu_id'          => 'main-menu',
                                        'menu_class'       => 'navbar-nav nav-primary text-center text-xl-left justify-content-end',
                                        'fallback_cb'      => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'           => new WP_Bootstrap_Navwalker()
                                        ]);
                                        ?>
                                </div>

                                <div class="col-4 d-xl-block d-none text-center navbar-brand m-0 py-4">
                                    <?php //the_custom_logo(); ?>
                                </div>

                                <div class="col-4 nav-secondary d-xl-flex d-none align-items-center justify-content-end">

                                    <div class="padre-minicart d-lg-block d-none pl-3">

                                        <?php 
                                            $idpages = get_the_ID();
                                            // echo $idpages; 
                                            if( $idpages == '8' or $idpages == '9' or $idpages == '10' or $idpages == '12674' or $idpages == '99113'):
                                        ?>
                                        <div class="icon-cart-wrapper rel-wrapper">
                                            <a href="<?php echo home_url('/carrito/')?>">
                                                <div class="fal fa-shopping-bag fa-lg">
                                                    
                                                    <?php if($items_cart): ?>
                                                    <span><?php echo $items_cart; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </div>
                                        <?php else: ?>
                                        <div id="icon-cart" class="icon-cart-wrapper rel-wrapper">
                                            <div class="fal fa-shopping-bag fa-lg">
                                                
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
                                        <!--<img src="" alt="Logo Cutem" class="img-fluid" height="auto">-->
                                    </a>
                                </div>

                                <div class="col-6 d-xl-none d-flex justify-content-between align-items-center">

                                    <div>
                                        <a href="#" class="open-search fal fa-search fa-lg color-black under-box">
                                        </a>
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
            <div id="content" class="site-content mt-content-header <?php //echo get_user_geo_country(); ?>">