<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package santa_cole
 */

get_header();
?>

<?php

    $args_noticias = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'orderby' => 'rand',
    );

    $query_noticias = new WP_Query($args_noticias);

?>

<!-- [Breadcrumbs] -->
<section">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row row pt-lg-5">
                <div class="col-12 px-0 px-lg-3">

                    <div class="breadcrumb color-grey-light2 p-0 pb-2 bg-transparent mb-0">
                        <?php
                            //if ( function_exists('yoast_breadcrumb') ) {
                              //  yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
                            //}
                            pol_cpt_breadcrumbs('noticias');
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
    // Secure conditionals
    $full_text = '';
    $show_text = '';
    if (get_field('texto_introduccion', 'option')) {
        $full_text = get_the_content();
        $full_text .= '<p class="view-less color-grey-light2 mb-0" style="display: none;">Leer menos</p>';
        $replacement = '... <br><p class="view-more color-grey-light2 mb-4">Leer más</p>';
        if (strlen($full_text) > 150 ) {
            $show_text = substr_replace($full_text, $replacement, 150);
        }
        $show_text = $full_text;
    }
?>

<!-- Seccion introducción -->
<section>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 px-0 px-lg-3 d-lg-flex mt-4 my-lg-5 seccion-introduccion-noticias">

                    <div class="col-12 px-0 col-lg-6">
                        
                            <p class="fs-11 fs-lg-14 mb-lg-0"><?php the_title(); ?></p>

                            <p class="fs-lg-09 mb-lg-5 color-grey-light2"><?php if (get_field('fecha_noticia')) { $date = explode(' ', get_field('fecha_noticia')); if ($date) { echo $date[0] . ' de ' . $date[1] . ' ' . $date[2]; }} ?></p>

                            <?php if (!wp_is_mobile()) { ?>
                                <div class="mb-lg-5 color-custom-black mb-lg-5"><?php the_content(); ?></div>
                            <?php } else { ?>
                                <p class="full-text pt-3 pt-lg-4 mb-1" style="display: none;"><?php echo $full_text; ?></p>
                                <p class="partial-text pt-3 pt-lg-4 mb-1"><?php echo $show_text; ?></p>
                            <?php } ?>
                            
                            <div class="my-5">
                                <?php 
                                    $link = get_field('boton_noticia');
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                        <a class="px-4 px-lg-5 py-3 py-lg-3 border" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>
                            
                    </div>

                    <div class="col-12 px-0 col-lg-6 d-lg-flex justify-content-end">
                        <div class="img-cover-wrap margin-auto pl-lg-5 mb-4">
                            <?php
                                $content = get_field('imagen_destacada', false, false);
                                echo apply_filters('acf_the_content', $content);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seccion video -->
<?php if (get_field('video')) { ?>

    <section>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-0 px-lg-3 pr-lg-0 mb-5">
                        <div class="img-video-proyecto position-relative text-center">
                            <img class="img-fluid w-100"
                                src="https://img.youtube.com/vi/<?php echo get_iframe_url_code('video');?>/sddefault.jpg">
                            <div class="centered play-video"
                                data-videoid="https://www.youtube.com/embed/<?php echo get_iframe_url_code('video');?>">
                                <i class="fal fa-play-circle text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal_video" style="background-color: <?php the_field('color_de_fondo_modal');?>;">
            <div class="d-flex w-100 p-3 justify-content-end">
                <div class="item"><span class="close-video"></span></div>
            </div>

            <div class="iframe-wrap px-lg-1 w-lg-100">
                <iframe class="video-autoplayadd" src="https://www.youtube.com/embed/<?php echo get_iframe_url_code('video');?>" frameborder="0"
                    style="margin:auto;" allow="autoplay; fullscreen; picture-in-picture">
                </iframe>
            </div>
        </div>
    </section>

<?php } ?>

<!-- Seccion galeria imágenes -->
<section>
    <div class="slick-noticia pb-lg-5">
        
        <?php
            if (get_field('slider_de_imagenes')) {
                $content = get_field('slider_de_imagenes', false, false);
                echo apply_filters('acf_the_content', $content);
            }
        ?>    
        
    </div>
</section>



<!-- Navegación -->
<div class="wrapper mb-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-0 px-lg-3">
                
                <?php if (wp_is_mobile()) { ?>
                    <div class="hline-grey my-4 my-lg-5"></div>
                <?php } ?>

                <?php
                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( '', 'intramundana' ) . '</span>
                            <span class="nav-title d-block color-custom-black">%title</span><span class="fs-1 color-grey-light2">'. esc_html__( 'Anterior', 'intramundana' ) .'</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( '', 'intramundana' ) . '</span>
                            <span class="nav-title d-block color-custom-black">%title</span><span class="fs-11 color-grey-light2">'. esc_html__( 'Siguiente', 'intramundana' ) .'</span>',
                        )
                    );
                ?>

                <!-- Compartir -->
                <?php if (!wp_is_mobile()) { ?>
                    <div class="shareaholic-canvas" data-app="share_buttons" data-app-id-name="post_below_content"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php if (!wp_is_mobile()) { ?>

    <!-- Seccion más noticias relacionadas -->
    <?php if ($query_noticias->have_posts()) { ?>
        <section class="bg-beige">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-12 d-lg-flex justify-content-between mb-lg-3 mt-lg-8">
                            <div>
                                <p class="fs-lg-11 color-custom-black mb-0"><?php _e('Más noticias', 'santa-cole'); ?></p>
                            </div>
                            <div>
                                <?php 
                                    $link = get_field('cta_de_la_seccion');
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                        <a class="underline color-custom-black" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-12 px-lg-0 d-lg-flex mb-lg-5 noticias-rel">

                            <?php while ($query_noticias->have_posts()) {
                                $query_noticias->the_post(); ?>

                                <div class="col col-lg-4 p-lg-3">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            $content = get_field('imagen_destacada', false, false);
                                            if ($content) echo apply_filters('acf_the_content', $content);
                                        ?>
                                    </a>
                                    <div class="card-body border">
                                        <p class="color-grey-light2 fs-lg-09"><?php if (get_field('fecha_noticia')) { $date = explode(' ', get_field('fecha_noticia')); if ($date) { echo $date[0] . ' de ' . $date[1]; }} ?></p>
                                        <a href="<?php the_permalink(); ?>"><p class="fs-11 fs-lg-14 color-custom-black mb-0"><?php the_title(); ?></p></a>
                                        <?php if (get_the_excerpt()) { ?>
                                            <p class="fs-lg-09 color-custom-black mb-lg-0"><?php the_excerpt(); ?></p>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

<?php } ?>

<script>

    jQuery(document).ready(function($) {

        function waitForEl(selector, callback) {
            if ($(selector).length) {
            callback();
            } else {
            setTimeout(function() {
                waitForEl(selector, callback);
            }, 100);
            }
        };

        waitForEl('.shr-hide', function() {
            $("a.shareaholic-service-linkedin").append('<p class="mr-1">LinkedIn</p>')
            $("a.shareaholic-service-facebook").append('<p class="mr-1">Facebook</p>')
            $("a.shareaholic-service-email_this").append('<p class="mr-1">Correo electrónico</p>')
            $("a.shareaholic-service-pinterest").append('<p class="mr-1">Pinterest</p>')
            $("a.shareaholic-service-whatsapp").append('<p class="mr-1">Whatsapp</p>')
            $(".shr-hide").removeClass("shr-hide")
        })

    })

</script>

<?php

get_footer();?>