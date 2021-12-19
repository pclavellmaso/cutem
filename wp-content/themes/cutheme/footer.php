<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cutem
 */

?>



</div><!-- #content -->
<footer id="colophon" class="site-footer bg-custom-black color-black pt-lg-5 pt-5">
    <section class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-12 mb-lg-0 pt-lg-4 pb-lg-5 footer-group footer-logo">             
                    <?php
                        if ( !function_exists('dynamic_sidebar')
                        || !dynamic_sidebar('Footer_Logo') ) : ?>

                    <?php endif; ?>
                </div>
                <div class="col-lg-2 col-12 mb-lg-0 pt-lg-4 pb-lg-5 footer-group footer-pedidos-soporte">

                    <?php
                          if ( !function_exists('dynamic_sidebar')
                          || !dynamic_sidebar('Footer_1') ) : ?>

                    <?php endif; ?>

                </div>
                <div class="col-lg-2 col-12 mb-lg-0  pt-lg-4 pb-lg-5 footer-group footer-nosotros">
                    <?php
                      if ( !function_exists('dynamic_sidebar')
                      || !dynamic_sidebar('Footer_2') ) : ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-2 col-12 mb-lg-0  pt-lg-4 pb-lg-5 pb-4 footer-group footer-profesionales">
                    <?php
                      if ( !function_exists('dynamic_sidebar')
                      || !dynamic_sidebar('Footer_3') ) : ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-2 col-12 mb-lg-0  pt-lg-4 pb-lg-5">

                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row py-3 justify-content-between">
                <div class="col-lg-6 col-12 mt-1 footer-copyright text-left d-flex flex-column justify-content-end">
                    <p class="mb-0 fs-08 color-grey-light2">
                    <?php the_field('texto_copyright', 'option') ?>
                    </p>
                </div>
                <?php if(!wp_is_mobile()) {?>
                <div class="col-lg-3 col-12 mt-1 footer-iconos text-right">
                    <div class="footer-down">

                        <div class="logos-group d-inline">

                        <a href=" <?php the_field('link_instagram', 'option') ?>"><span class="fab fa-instagram text-white pr-md-2 pr-lg-3"> </span></a>
                        <a href=" <?php the_field('link_pinterest', 'option') ?>"><span class="fab fa-pinterest-p text-white pr-md-2 pr-lg-3"> </span></a>
                        <a href=" <?php the_field('link_linkedin', 'option') ?>"><span class="fab fa-linkedin-in text-white pr-md-2 pr-lg-3"> </span></a>
                        <a href=" <?php the_field('link_facebook', 'option') ?>"><span class="fab fa-facebook-square text-white px-md-2 pr-lg-3"> </span></a>
                        
                        
                        </div>
                        <div class="suscribe-container pt-5 w-100">
                            <button type="button" data-toggle="modal" data-target="#myModal2" class="openNL btn-negro-hover btn border-white br-0 py-3 px-4 text-white w-100"><?php the_field('texto_cta_newsletter', 'option') ?></button>
                        </div>

                    </div>
                </div>

                <?php } ?>
                <!--<div class="col-lg-6 col-12 mt-1 footer-copyright text-left fs-08">
                    <a class="fs-1" href="<?php echo site_url() ?>/aviso-legal/">
                        Aviso Legal
                    </a>
                    <span class="fs-1">|</span>
                    <a class="fs-1" href="<?php echo site_url() ?>/politica-privacidad/">
                        Política de Privacidad
                    </a>
                    <span class="fs-1">|</span>
                    <a class="fs-1" href="<?php echo site_url() ?>/politica-cookies/">
                        Política Cookies
                    </a>
                </div>-->

            </div>
        </div>
    </section>
</footer><!-- #colophon -->
</div><!-- #page -->



<?php wp_footer(); ?>

</body>

</html>