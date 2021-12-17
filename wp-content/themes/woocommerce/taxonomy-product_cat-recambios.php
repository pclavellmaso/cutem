<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* Template Name: Recambios */

get_header();

// Idioma actual
$lang = apply_filters( 'wpml_current_language', NULL );


$page_id = get_queried_object_id();
$term = get_term_by('term_id', $page_id, 'product_cat');
$term_name = $term->name;
$term_description = $term->description;


// Para verlo en local
$modelo_string = 'pa_modelo';
if ($lang == 'es') {
    $modelo_string = 'pa_modelo';
} elseif ($lang == 'en') {
    $modelo_string = 'pa_model';
}

$modelos = get_terms($modelo_string);
$modelos_ids = array();

foreach($modelos as $modelo) {
    array_push($modelos_ids, $modelo->term_id);
}

function check_product_recambios($product_id, &$productos_recambios, $modelo_string) {

    $product = wc_get_product($product_id);
    $modelos = $product->get_attribute( $modelo_string );

    if ($modelos) {
        
        if (strpos(',', $modelos) != -1) {

            $modelos = explode(',', $modelos);    
            $term_taxonomy_id = get_term_by('slug', $modelos[0], 'pa_modelo')->term_id;
            if (get_field('codigos_unicos_de_recambios', $modelo_string . '_' . $term_taxonomy_id)) {
                array_push($productos_recambios, get_post($product->get_id()));
            }
            
        } else {
    
            $term_taxonomy_id = get_term_by('slug', $modelos, 'pa_modelo')->term_id;
            if (get_field('codigos_unicos_de_recambios', $modelo_string . '_' . $term_taxonomy_id)) {
                array_push($productos_recambios, get_post($product->get_id()));
            }
        }
    }
    
}

function query_recambios($categoria_id, $modelos_ids, $modelo_string) {

    $productos_recambios = array();

    // Sección productos variables
    $args_variables = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $modelo_string,
                'field' => 'term_id',
                'terms' => $modelos_ids,
            ),
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $categoria_id,
            )
        ),
    );

    $query_variables = new WP_Query($args_variables);

    // Si has más de un producto
    if (isset($query_variables->posts)) {
        
        foreach($query_variables->posts as $product) {
            
            check_product_recambios($product->ID, $productos_recambios, $modelo_string);
        }
        // Si solo hay un producto
    } elseif (isset($query_variables['post']) && count($query_variables['post']) > 0 ) {

        check_product_recambios($_variables['post']->ID, $productos_recambios, $modelo_string);
    }

    // Sección productos simples
    $args_simples = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $modelo_string,
                'field' => 'term_id',
                'operator' => 'NOT EXISTS'
            ),
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $categoria_id
            ),
        ),
        'meta_query' => array(
            array(
                'key' => 'codigos_unicos_de_recambios',
                'value' => '',
                'compare' => '!='
            )
        )
    );

    $query_simples = new WP_Query($args_simples);

    foreach($productos_recambios as $variable_product) {

        array_push($query_simples->posts, $variable_product);
    }

    $query_simples->found_posts += count($productos_recambios);
    $query_simples->post_count += count($productos_recambios);

    return $query_simples;
}

/////////////////////////////////////////////////

?>

<!-- Section header -->
<section class="section-header">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row py-5">
                <div class="col-12 pb-lg-5 pb-4">
                    <div class="breadcrumb color-grey-light2 p-0 bg-transparent mb-0">
                        <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 pt-2 d-flex flex-column justify-content-start">

                    <p class="pb-0 pb-lg-3 mb-0 mb-lg-3 fs-11 fs-lg-15 fw-400 color-custom-black"><?php echo $term_name; ?></p>
                    <p class="pt-lg-4 pt-lg-0 pb-4 pb-lg-0 mb-0"><?php echo $term_description; ?></p>


                </div>
            </div>

            <?php if (!wp_is_mobile()) { ?>

                <div class="container-fluid d-none d-lg-block px-0">
                    <div class="row pt-3">
                        <div class="col-12 px-0 px-lg-3">
                            <ul class="nav nav-tabs tabs-custom d-flex flex-nowrap" id="myTab" role="tablist">
                                <!-- Links de navegación -->
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active text-left px-0 pb-3" id="lamparasdesobremesa-tab"
                                        data-toggle="tab" href="#lamparasdesobremesa" role="tab"
                                        aria-controls="lamparasdesobremesa"
                                        aria-selected="true"><?php _e('Lámparas de sobremesa', 'santa-cole') ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-left px-0 pb-3" id="lamparasdepie-tab" data-toggle="tab"
                                        href="#lamparasdepie" role="tab" aria-controls="lamparasdepie"
                                        aria-selected="false"><?php _e('Lámparas de pie', 'santa-cole') ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-left px-0 pb-3" id="lamparasdesuspension-tab" data-toggle="tab"
                                        href="#lamparasdesuspension" role="tab" aria-controls="lamparasdesuspension"
                                        aria-selected="false"><?php _e('Lámparas de suspensión', 'santa-cole') ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-left px-0 pb-3" id="apliques-tab" data-toggle="tab"
                                        href="#apliques" role="tab" aria-controls="apliques"
                                        aria-selected="false"><?php _e('Apliques', 'santa-cole') ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-left px-0 pb-3" id="bateria-tab" data-toggle="tab"
                                        href="#bateria" role="tab" aria-controls="bateria"
                                        aria-selected="false"><?php _e('Batería', 'santa-cole') ?></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-left px-0 pb-3" id="exterior-tab" data-toggle="tab"
                                        href="#exterior" role="tab" aria-controls="exterior"
                                        aria-selected="false"><?php _e('Exterior', 'santa-cole') ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- Lámparas de sobremesa -->
                                <?php //case 'lamparasdesobremesa': ?>
                                <div class="tab-pane fade show active" id="lamparasdesobremesa" role="tabpanel"
                                    aria-labelledby="lamparasdesobremesa-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                            <?php 
                                                
                                                $query_sobremesa = query_recambios(40, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_sobremesa->have_posts() ) : $query_sobremesa->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail('full');
                                                    }
                                                    else { ?>
                                                    <?php
                                                        $content = get_field('imagen_destacada', false, false);
                                                        echo apply_filters('acf_the_content', $content);
                                                    ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                                wp_reset_query();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Lámparas de pie -->
                                <!-- <?php //case 'lamparasdepie': ?> -->
                                <div class="tab-pane fade" id="lamparasdepie" role="tabpanel"
                                    aria-labelledby="lamparasdepie-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_pie = query_recambios(450, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_pie->have_posts() ) : $query_pie->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail('full');
                                                    }
                                                    else { ?>
                                                    <?php
                                                        $content = get_field('imagen_destacada', false, false);
                                                        echo apply_filters('acf_the_content', $content);
                                                    ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                                wp_reset_query();
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Lámparas de suspensión -->
                                <!-- <?php //case 'lamparasdesuspension': ?> -->
                                <div class="tab-pane fade" id="lamparasdesuspension" role="tabpanel"
                                    aria-labelledby="lamparasdesuspension-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_suspension = query_recambios(454, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_suspension->have_posts() ) : $query_suspension->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail('full');
                                                    }
                                                    else { ?>
                                                    <?php
                                                        $content = get_field('imagen_destacada', false, false);
                                                        echo apply_filters('acf_the_content', $content);
                                                    ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                                wp_reset_query();
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Apliques -->
                                <?php //case 'apliques': ?>
                                <div class="tab-pane fade" id="apliques" role="tabpanel" aria-labelledby="apliques-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                            <?php 
                                                
                                                $query_apliques = query_recambios(473, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_apliques->have_posts() ) : $query_apliques->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail('full');
                                                    }
                                                    else { ?>
                                                    <?php
                                                        $content = get_field('imagen_destacada', false, false);
                                                        echo apply_filters('acf_the_content', $content);
                                                    ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                                wp_reset_query();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Batería -->
                                <?php //case 'bateria': ?>
                                <div class="tab-pane fade" id="bateria" role="tabpanel" aria-labelledby="bateria-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_bateria = query_recambios(551, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_bateria->have_posts() ) : $query_bateria->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail('full');
                                                    }
                                                    else { ?>
                                                    <?php
                                                        $content = get_field('imagen_destacada', false, false);
                                                        echo apply_filters('acf_the_content', $content);
                                                    ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                                wp_reset_query();
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Exterior -->
                                <?php //case 'exterior': ?>
                                <div class="tab-pane fade" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_exterior = query_recambios(555, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_exterior->have_posts() ) : $query_exterior->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail('full');
                                                    }
                                                    else { ?>
                                                    <?php
                                                        $content = get_field('imagen_destacada', false, false);
                                                        echo apply_filters('acf_the_content', $content);
                                                    ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                                wp_reset_query();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {?>

            <div class="container-fluid px-0">
                <div class="row pt-3">
                    <div class="col-12 px-0 px-lg-3">
                        <ul class="swipe-tabs" id="myTab" role="tablist">
                            <!-- Links de navegación -->
                            <li class="swipe-tab tabContacto" role="presentation">
                                <a class="nav-link active text-left px-0 pb-3" id="lamparasdesobremesa-tab"
                                    data-toggle="tab" href="#lamparasdesobremesa" role="tab"
                                    aria-controls="lamparasdesobremesa"
                                    aria-selected="true"><?php _e('Lámparas de sobremesa', 'santa-cole') ?></a>
                            </li>
                            <li class="swipe-tab tabContacto" role="presentation">
                                <a class="nav-link text-left px-0 pb-3" id="lamparasdepie-tab" data-toggle="tab"
                                    href="#lamparasdepie" role="tab" aria-controls="lamparasdepie"
                                    aria-selected="false"><?php _e('Lámparas de pie', 'santa-cole') ?></a>
                            </li>
                            <li class="swipe-tab tabContacto" role="presentation">
                                <a class="nav-link text-left px-0 pb-3" id="lamparasdesuspension-tab" data-toggle="tab"
                                    href="#lamparasdesuspension" role="tab" aria-controls="lamparasdesuspension"
                                    aria-selected="false"><?php _e('Lámparas de suspensión', 'santa-cole') ?></a>
                            </li>
                            <li class="swipe-tab tabContacto" role="presentation">
                                <a class="nav-link text-left px-0 pb-3" id="apliques-tab" data-toggle="tab"
                                    href="#apliques" role="tab" aria-controls="apliques"
                                    aria-selected="false"><?php _e('Apliques', 'santa-cole') ?></a>
                            </li>
                            <li class="swipe-tab tabContacto" role="presentation">
                                <a class="nav-link text-left px-0 pb-3" id="bateria-tab" data-toggle="tab"
                                    href="#bateria" role="tab" aria-controls="bateria"
                                    aria-selected="false"><?php _e('Batería', 'santa-cole') ?></a>
                            </li>
                            <li class="swipe-tab tabContacto" role="presentation">
                                <a class="nav-link text-left px-0 pb-3" id="exterior-tab" data-toggle="tab"
                                    href="#exterior" role="tab" aria-controls="exterior"
                                    aria-selected="false"><?php _e('Exterior', 'santa-cole') ?></a>
                            </li>
                        </ul>
                        <div class="main-container wrapper">
                            <div class="tab-content swipe-tabs-container" id="myTabContent">
                                <!-- Lámparas de sobremesa -->
                                <?php //case 'lamparasdesobremesa': ?>
                                <div class="tab-pane fade show active" id="lamparasdesobremesa" role="tabpanel"
                                    aria-labelledby="lamparasdesobremesa-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php
                                                
                                                $query_sobremesa = query_recambios(40, $modelos_ids, $modelo_string);

                                                while ( $query_sobremesa->have_posts() ) : $query_sobremesa->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                    <?php
                                                    $content = get_field('imagen_destacada', false, false);
                                                    echo apply_filters('acf_the_content', $content);
                                                ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                            wp_reset_query();
                                        ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Lámparas de pie -->
                                <!-- <?php //case 'lamparasdepie': ?> -->
                                <div class="tab-pane fade" id="lamparasdepie" role="tabpanel"
                                    aria-labelledby="lamparasdepie-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_pie = query_recambios(450, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_pie->have_posts() ) : $query_pie->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                    <?php
                                                    $content = get_field('imagen_destacada', false, false);
                                                    echo apply_filters('acf_the_content', $content);
                                                ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                            wp_reset_query();
                                        ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Lámparas de suspensión -->
                                <!-- <?php //case 'lamparasdesuspension': ?> -->
                                <div class="tab-pane fade" id="lamparasdesuspension" role="tabpanel"
                                    aria-labelledby="lamparasdesuspension-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                            
                                            <?php 
                                                
                                                $query_suspension = query_recambios(454, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_suspension->have_posts() ) : $query_suspension->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                    <?php
                                                    $content = get_field('imagen_destacada', false, false);
                                                    echo apply_filters('acf_the_content', $content);
                                                ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                            wp_reset_query();
                                        ?>


                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Apliques -->
                                <?php //case 'apliques': ?>
                                <div class="tab-pane fade" id="apliques" role="tabpanel" aria-labelledby="apliques-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_apliques = query_recambios(473, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_apliques->have_posts() ) : $query_apliques->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                    <?php
                                                    $content = get_field('imagen_destacada', false, false);
                                                    echo apply_filters('acf_the_content', $content);
                                                ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                            wp_reset_query();
                                        ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Batería -->
                                <?php //case 'bateria': ?>
                                <div class="tab-pane fade" id="bateria" role="tabpanel" aria-labelledby="bateria-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_bateria = query_recambios(551, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_bateria->have_posts() ) : $query_bateria->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                    <?php
                                                    $content = get_field('imagen_destacada', false, false);
                                                    echo apply_filters('acf_the_content', $content);
                                                ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                            wp_reset_query();
                                        ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                                <!-- Exterior -->
                                <?php //case 'exterior': ?>
                                <div class="tab-pane fade" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                                    <div class="container-fluid py-5 px-0">

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">

                                            <?php 
                                                
                                                $query_exterior = query_recambios(555, $modelos_ids, $modelo_string);
                                                
                                                while ( $query_exterior->have_posts() ) : $query_exterior->the_post();
                                            ?>
                                            <div class="col-lg-3 col-12">
                                                <a href="<?php the_permalink(); ?>#recambiostab" >
                                                    <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                    <?php
                                                    $content = get_field('imagen_destacada', false, false);
                                                    echo apply_filters('acf_the_content', $content);
                                                ?>
                                                    <?php }?>
                                                </a>
                                                <div class="container-fluid">
                                                    <div class="py-3 row">
                                                        <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                                                            <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile;
                                            wp_reset_query();
                                        ?>

                                        </div>
                                    </div>
                                </div>
                                <?php //break; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php }?>
        </div>
    </div>
</section>

<script>
jQuery(document).ready(function($) {

    $(".view-more").click(function() {
        $(this).toggle()
        $(".partial-text").toggle()
        $(".full-text").toggle()
        $(".view-less").toggle()
    })
    $(".view-less").click(function() {
        $(".full-text").toggle()
        $(".view-less").toggle()
        $(".partial-text").toggle()
        $(".view-more").toggle()

        $('body').animate({
            scrollTop: $(".section-header").offset().top
        }, 800);
    })

})
</script>

<section>
    <div class="wrapper">
        <div class="container-fluid px-0">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                <?php //if(have_posts('recambio')) {
                    //while(have_posts('recambio')) { $wp_query->the_post(); ?>
                <?php //switch(get_field('tipo_de_recambio')) { ?>


                <?php //} ?>

                <?php //}
                //} ?>

            </div>
        </div>
    </div>
</section>

<?php
get_footer();?>