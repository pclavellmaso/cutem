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
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site margin-top-content top-bar-margin top-bar-margin-classy">
        <header id="masthead" class="site-header fixed-top">
            <nav class="navbar-main navbar-expand-lg
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
                <a href="#" class="close-menu d-lg-none collapse closed">
                    <span aria-hidden="true" class="color-custom-black">&times;</span>
                </a>

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
                                    <a href="<?php echo wp_logout_url() ?>">
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

                <div class="top-bar-classy wrapper bg-custom-black d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="d-flex align-items-center">

                                        <a title="Search" href="#" data-toggle="modal" data-target="#searchModal"
                                            aria-haspopup="true" aria-expanded="false"
                                            class="mr-45 icon icon-search text-white">
                                        </a>
                                        <a class="icon icon-user text-white mr-45"
                                            href="<?php echo home_url('/mi-cuenta/')?>">
                                        </a>
                                        <div id="icon-cart" class="icon-cart-wrapper rel-wrapper">
                                            <a class="icon icon-cart fs-3" href="<?php echo wc_get_cart_url(); ?>">
                                                <?php $items_cart = WC()->cart->get_cart_contents_count(); ?>
                                                <?php if($items_cart): ?>
                                                <span><?php echo $items_cart; ?></span>
                                                <?php endif; ?>
                                            </a>
                                            <div class="minicart-modal">
                                                <?php woocommerce_mini_cart() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrapper">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a class="navbar-toggler-right d-lg-none navbar-icon-menu icon icon-menu color-custom-black"
                                         data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">
                                    </a>
                                    <div class="navbar-brand py-3 pt-lg-3 pb-lg-3">
                                        <?php the_custom_logo(); ?>
                                    </div>
                                    <?php
    									wp_nav_menu([
    									'menu'	           => 'primary-classy',
    									'theme_location'   => 'primary',
    									'container'        => 'div',
    									'container_id'     => 'navbar',
    									'depth'            => 3,
    									'container_class'  => 'menu collapse navbar-collapse justify-content-end py-lg-3',
    									'menu_id'          => 'main-menu-classy',
    									'menu_class'       => 'navbar-nav nav-primary text-center text-lg-left justify-content-end',
    									'fallback_cb'      => 'WP_Bootstrap_Navwalker::fallback',
    									'walker'           => new WP_Bootstrap_Navwalker()
    									]);
    									?>

                                    <div id="icon-cart-mobile" class="d-lg-none icon-cart-wrapper rel-wrapper">
                                        <a class="icon icon-cart" href="<?php echo wc_get_cart_url(); ?>">
                                            <?php $items_cart = WC()->cart->get_cart_contents_count(); ?>
                                            <?php if($items_cart): ?>
                                            <span><?php echo $items_cart; ?></span>
                                            <?php endif; ?>
                                        </a>
                                        <div class="minicart-modal">
                                            <?php woocommerce_mini_cart() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-custom-black">
                    <div class="modal-header d-flex align-items-center">
                        <span class="text-white d-block">
                            <?php _e('Búsqueda de Producto', 'santa-cole') ?>
                        </span>
                        <a href="#" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body bg-light-grey">
                        <?php echo custom_product_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="site-content">
