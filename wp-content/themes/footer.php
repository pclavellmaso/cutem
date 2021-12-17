<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package santa_cole
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
                <div class="col-lg-2 col-12 mb-lg-0 pt-lg-4 pb-lg-5 d-flex flex-column justify-content-between align-items-lg-end align-items-start">
                    <?php if(!wp_is_mobile()) {?>
                    <div class="footer-up" id="footerIdioma">
                        <?php echo selector_idiomas_personalizado(); ?>
                    </div>
                        
                    

                    <?php } else {?>

                        <div class="footer-up d-flex w-100 mb-5 justify-content-between" id="footerIdioma">

                        <?php echo selector_idiomas_personalizado(); ?>
                        
                            <div class="logos-group d-inline w-50 text-right">

                                <a href=" <?php the_field('link_instagram', 'option') ?>"><span class="fab fa-instagram text-white px-lg-4 px-2 px-xs-2"> </span></a>
                                <a href=" <?php the_field('link_pinterest', 'option') ?>"><span class="fab fa-pinterest-p text-white px-lg-4 px-2 px-xs-2"> </span></a>
                                <a href=" <?php the_field('link_linkedin', 'option') ?>"><span class="fab fa-linkedin-in text-white px-lg-4 px-2 px-xs-2"> </span></a>
                                <a href=" <?php the_field('link_facebook', 'option') ?>"><span class="fab fa-facebook-square text-white px-lg-4 px-2 px-xs-2"> </span></a>
                            
                            </div>
                        </div>
                        
                    <div class="footer-down w-100">

                        
                        <div class="suscribe-container pt-5 w-100">
                            <button type="button" data-toggle="modal" data-target="#modalNewsletter" class="openNL btn-negro btn border-white br-0 py-3 px-4 text-white w-100"><?php the_field('texto_cta_newsletter', 'option') ?></button>
                        </div>

                    </div>

                    
                    <?php } ?>

                    <!-- MODAL FORMULARIO NEWSLETTER -->

                    <section class="wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div id="modalNewsletter">

                                    <div class="topModal d-flex justify-content-between">
                                        <h3 class="fw-300"><?php the_field('titulo_newsletter', 'option') ?> </h3>
                                        <div id="close-newsletter" class="collapse close">
                                            <span class="icon-close"></span>
                                        </div>
                                    </div>

                                    <div class="texto-newsletter pt-4">
                                        <p><?php the_field('texto_newsletter', 'option') ?></p>
                                    </div>

                                    <?php
                                    if ( !function_exists('dynamic_sidebar')
                                    || !dynamic_sidebar('Footer_4') ) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </section>
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
<?php
        // Códigos de seguimientos
        if( have_rows('codigos_de_seguimiento_footer', 'option') ):

            // Loop through rows.
            while( have_rows('codigos_de_seguimiento_footer', 'option') ) : the_row();

                // Load sub field value.
                the_sub_field('codigo_de_seguimiento_footer', 'option');
                // Do something...

            // End loop.
            endwhile;
        endif;
    ?>
</body>

</html>