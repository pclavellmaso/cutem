<?php


get_header();

$page_id = get_queried_object_id();
?>

<section class="wrapper py-5 bg-light-grey">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-12 mb-lg-0 mb-4 d-none d-lg-block">
                <span class="color-red text-uppercase title-promociones-page text-left mb-lg-4 mb-2 d-block">
                    <?php pll_e('DESCUBRE')?>
                </span>
                <ul class="list-unstyled">
                    <?php

                    $tipos_terms = get_terms(
                        array('taxonomy' => 'tipos',
                        'orderby'    => 'id',
                        'hide_empty' => false)
                    );

                    foreach ($tipos_terms as $term) {

                    ?>
                    <li class="mb-lg-3 mb-2">
                        <a href="<?php echo get_site_url() ?>/tipos-comercios/<?php echo $term->slug ?>"
                            class="title-taxonomy-sidebar color-grey-light">
                            <?php echo $term->name ?>
                        </a>
                    </li>
                    <?php }
              ?>
                </ul>
            </div>
            <div class="col-lg-9 col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-lg-5 mb-4">
                            <h1 class="color-red text-uppercase title-promociones-page text-lg-left text-center">
                                <?php echo single_term_title(); ?>
                            </h1>
                            <div class="border-bottom-grey mb-lg-4 mb-3"></div>
                            <div class="text-term text-lg-left text-center">
                                <?php echo term_description(); ?>
                            </div>
                        </div>
                        <?php
					if ( have_posts() ) :

                        $args = array(  'posts_per_page' => -1,
                                        'post_type' => 'comercios',
                                        'orderby' => 'date',
                                        'order' => 'ASC',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'tipos',
                                                'field' => 'term_id',
                                                'terms' => $page_id,
                                                'operator'  => 'IN',
                                            ),
                                        ),

                        );
                        $wp_query = new WP_Query( $args );
                        $counterr =1;
                        while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <div class="text-left br-10 border-ficha bg-white">
                                <div class="br-10 mb-4 position-relative">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php the_field('banner_desktop_img') ?>" alt="imagen destacada post"
                                            class="img-fluid">
                                    </a>
                                    <?php
                                      $terms = get_the_terms(get_the_ID(),'tipos');
                                      foreach ($terms as $term) {
                                        $image_id = get_field('imagen', $term);
                                        $image_src = wp_get_attachment_image_src($image_id, 'full');
                                      }
                                      ?>
                                    <div class="term-icon">
                                        <img src="<?php echo $image_src[0] ?>">
                                    </div>
                                </div>
                                <div class="px-3">
                                    <a href="<?php the_permalink(); ?>"><span
                                            class="d-block mb-4 title-relacionados"><?php the_title(); ?></span></a>
                                    <p class="p-simple"><?php //get_excerpt_cpts('descripcion_comercio'); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            $counterr++;
                            endwhile;
                            endif;

                            wp_reset_query();
					    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();
