<?php

function load_more_ajax_handler() {

	// prepare our arguments for the query
	$args = json_decode(stripslashes($_POST['query']), true);
 
    // Custom fields for filtering
    $post_type = $_POST['post_type'];
    //$filter_by_category = $_POST['filter_by_category'];
    $category_field = $_POST['category_field'];
    $category_value = $_POST['category_value'];
    $current_page = $_POST['current_page'];

    // we need next page to be loaded
    $args['paged'] = $current_page;

	// it is always better to use WP_Query but not here
	query_posts( $args );

    $posts = new WP_Query($args);
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();

            if ($post_type == 'evento') {
                
                if (get_field($category_field) == $category_value) { ?>
                    <div class="col-12 px-0 px-lg-3 col-sm-6 col-lg-4 mb-lg-5">
                        <div class="card-evento card-padre mx-auto">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                // the_field('imagen_destacada'); Funciona bien igual
                                    $img = get_field('imagen_destacada', false, false);
                                    echo do_shortcode($img);
                                ?>
                            </a>
                            <div class="card-body px-0 w-lg-100">
                                <a href="<?php the_permalink(); ?>"><p class="fs-11 fs-lg-14 color-custom-black"><?php the_title(); ?></p></a>
                                <p class="card-text"><?php the_field('texto_descripcion_corto'); ?></p>
                                <?php 
                                    if (!empty(get_field('fecha_evento_inicio'))) {
                                        $date = explode(' ', get_field('fecha_evento_inicio'));
                                    }
                                    if (get_field('localizacion')) {
                                        $localizacion = the_field('localizacion');
                                    }
                                ?>
                                <a class="button bg-custom-white color-custom-black d-block max-content px-2 py-2 fw-400 fs-6 fs-lg-8 mb-100" href="#">
                                    <?php if ($date) {
                                        echo $date[0] . ' de ' . $date[1] . ' ' . $date[2];
                                        if (isset($localizacion)) {
                                            echo ' - ' . $localizacion;
                                        }
                                    } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php }
                
            } elseif ($post_type == 'noticia') { ?>
                <div class="card p-lg-3">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                            the_field('imagen_destacada');
                        ?>
                    </a>
                    <div class="card-body border">
                        <p class="color-grey-light2 fs-lg-09"><?php the_field('fecha_noticia'); ?></p>
                        <a href="<?php the_permalink(); ?>"><p class="fs-lg-14 color-custom-black"><?php the_title(); ?></p></a>
                        <p class="fs-lg-09 color-custom-black mb-lg-0"><?php the_field('texto_descripcion_corto'); ?></p>
                    </div>
                </div>
            <?php } elseif ($post_type == 'historia') { ?>
                <div class="card historia">
                    <div class="d-flex flex-column">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                                $content = get_field('_thumbnail_id', false, false);
                                if ($content) echo apply_filters('acf_the_content', $content);
                            ?>
                        </a>
                        <div class="card-body px-0 w-lg-100">
                            <a href="<?php the_permalink(); ?>"><p class="subtitle-size color-custom-black mb-1 lh-20"><?php the_title(); ?></p></a>
                            <p class="card-text"><?php if (get_field('texto_descripcion_corto')) the_field('texto_descripcion_corto'); ?></p>
                        </div>
                    </div>
                </div>
            <?php } elseif ($post_type == 'proyecto') { ?>
                <div class="proyecto-card col-lg-4 py-0 px-0 px-lg-3 py-lg-2">
                    <div class="proyecto-img">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                                $content = get_field('imagen_destacada', false, false);
                                if ($content) echo apply_filters('acf_the_content', $content);
                            ?>
                        </a>
                    </div>

                    <div class="proyecto-text d-flex flex-column justify-content-start align-items-end pt-3 pt-lg-4 pb-0 mb-3 mb-lg-0">
                        <div class="proyecto-first-group d-flex justify-content-between w-100 mb-2">
                            <h2 class="fs-09 fs-lg-1 fw-400 mb-0 w-75"><?php the_title(); ?></h2>
                            <a class="fs-075 fs-lg-875 text-underline hover-text mb-0" href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                        </div>

                        <div>
                            <p class="fs-075 fs-lg-875 mb-1 mb-lg-0"><?php if (get_field('texto_descripcion_corto')) the_field('texto_descripcion_corto'); ?></p>
                        </div>

                        <div class="proyecto-second-group d-flex justify-content-between w-100 pt-0 pt-lg-1">
                            <h3 class="color-grey-light2 font-weight-normal">
                                <?php echo get_the_term_list( $post->ID, 'categoria-pro', '', ', ', ''); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            <?php }
 
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'load_more_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'load_more_ajax_handler'); // wp_ajax_nopriv_{action}

// No se incluye un caso proyectos en la función genérica porque el tipo de query es distinto
function load_more_proyectos() {
    
    $proyectos_ids = $_POST['ids'];

    $args = array(
        'post_type' => 'proyecto',
        'posts_per_page' => -1,
        'post__in' => $proyectos_ids
    );
	
    // it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post(); ?>

            <div class="proyecto-card col-lg-4 py-0 px-0 px-lg-3 py-lg-2">

                <div class="proyecto-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                            $content = get_field('imagen_destacada', false, false);
                            if ($content) echo apply_filters('acf_the_content', $content);
                        ?>
                    </a>
                </div>

                <div class="proyecto-text d-flex flex-column justify-content-start align-items-end pt-3 pt-lg-4 pb-0 mb-3 mb-lg-0">
                    <div class="proyecto-first-group d-flex justify-content-between w-100 mb-2">
                        <h2 class="fs-09 fs-lg-1 fw-400 mb-0 w-75 w-lg-100"><?php the_title(); ?></h2>
                        <a class="fs-075 fs-lg-875 text-underline hover-text mb-0" href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>

                    <div>
                        <p class="fs-075 fs-lg-875 mb-1 mb-lg-2"><?php if (get_field('texto_descripcion_corto')) the_field('texto_descripcion_corto'); ?></p>
                    </div>

                    <div class="proyecto-second-group d-flex justify-content-between w-100 pt-0 pt-lg-1">
                        <h3 class="color-grey-light2 font-weight-normal">
                            <?php echo get_the_term_list( $post->ID, 'categoria-pro', '', ', ', ''); ?>
                        </h3>
                    </div>
                </div>

            </div>
 
		<?php endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore_proyectos', 'load_more_proyectos'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore_proyectos', 'load_more_proyectos'); // wp_ajax_nopriv_{action}