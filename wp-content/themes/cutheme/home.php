<?php

/* Template Name: Noticias */

get_header();
?>

<?php

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
);

$wp_query = new WP_Query($args);

$args_more = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    // [Variable para hacer la consulta ajax]
    // Necesario indicar la pagina actual considerando los proyectos por pagina (3) y los mostrados (6) --> pagina 2
    'paged' => 2,
);

$more_noticias = new WP_Query($args_more);

?>

<!-- Sección introducción -->
<section>
    <div class="wrapper">
        <div class="container-fluid">
            
            <div class="row pt-5 pt-lg-5">
                <div class="col-12 px-0 px-lg-3">

                    <div class="breadcrumb color-grey-light2 p-0 bg-transparent mb-0 pb-2">
                        <?php
                            if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
                            }
                        ?>
                    </div>

                </div>
            </div>

            <?php
                // Secure conditionals
                $full_text = '';
                $show_text = '';
                if (get_the_content()) {
                    $full_text = get_the_content();
                    $full_text .= '<p class="view-less color-grey-light2 mb-0" style="display: none;">Leer menos</p>';
                    $replacement = '... <br><p class="view-more color-grey-light2 mb-0">Leer más</p>';
                    if (strlen($full_text) > 150 ) {
                        $show_text = substr_replace($full_text, $replacement, 150);
                    }
                    $show_text = $full_text;
                }
            ?>

            <div class="row pt-3 pt-lg-5">
                <div class="col-12 px-0 px-lg-3">

                    <div class="col-lg-6 px-0 d-flex flex-column">
                        <?php
                            display_tag(
                                'title_group',
                                'title_tag',
                                'title_txt',
                                'pb-0 pb-lg-3 mb-0 mb-lg-3 fs-11 fs-lg-15 fw-400 color-custom-black'
                            );
                        ?>
                        <?php if (wp_is_mobile()) { ?>
                            <p class="full-text pt-3 pt-lg-4 mb-1" style="display: none;"><?php echo $full_text; ?></p>
                            <p class="partial-text pt-3 pt-lg-4 mb-1"><?php echo $show_text; ?></p>
                        <?php } else { ?>
                            <p class="pt-lg-4 pt-lg-0 pb-4 pb-lg-0 mb-0"><?php echo $full_text; ?></p>
                        <?php } ?>
                    </div>

                    <div class="hline-grey my-4 my-lg-5"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Grid -->
<section>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-12 px-0 px-lg-3">
                    <div class="grid-noticias card-columns">

                        <?php if ($wp_query->have_posts()) {
                            while ($wp_query->have_posts()) { $wp_query->the_post(); ?>

                                <div class="card card-noticia mb-4">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            $content = get_field('imagen_destacada', false, false);
                                            if ($content) echo apply_filters('acf_the_content', $content);
                                        ?>
                                    </a>
                                    <div class="card-body border">
                                        <p class="color-grey-light2 fs-lg-09 mb-2"><?php if (get_field('fecha_noticia')) the_field('fecha_noticia'); ?></p>
                                        <a href="<?php the_permalink(); ?>"><p class="fs-11 color-custom-black mb-2"><?php the_title(); ?></p></a>
                                        <p class="fs-lg-09 color-custom-black mb-0"><?php if (get_field('texto_descripcion_corto')) the_field('texto_descripcion_corto'); ?></p>
                                    </div>
                                </div>

                            <?php }
                        } ?>

                    </div>
                </div>

                <div class="col-12 px-0 px-lg-3">
                    <div class="hline-grey my-4 my-lg-5"></div>
                    <div class="col-lg-12 px-0 d-flex flex-column justify-content-center align-items-center">
                        <?php if ( $more_noticias->max_num_pages > $more_noticias->query_vars['paged'] ) { ?>
                            <p class="load_more_news text-underline mb-0 pointer"><?php _e('Mostrar más', 'santa-cole'); ?></p>
                        <?php } ?>
                    </div>
                </div>
            
            </div>
        </div>      
    </div>
</section>

<script>
    
    var posts_myajax = '<?php echo json_encode( $more_noticias->query_vars ); ?>';
    // [Variable para borrar el botón si hemos llegado a la última página (JS)]
    // Necesario indicar la pagina actual considerando los proyectos por pagina (3) y los mostrados (6) --> pagina 2
    var current_page_myajax = 2;
    var max_pages_myajax = '<?php echo $more_noticias->max_num_pages; ?>';

</script>

<?php 
    // endif;
    // endwhile;
    // endif;
?>

<?php
get_footer();