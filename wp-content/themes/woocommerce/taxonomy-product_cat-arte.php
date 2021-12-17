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

// Plantilla por defecto
// wc_get_template( 'archive-product.php' );

get_header();

// Get the language of the current page
$lang = apply_filters( 'wpml_current_language', NULL );

// By default (according to the url), this page already have the context of the taxnonomy (term), so we can get the description (p.e) without setting up the context

// Get the id of the category
$category_id = get_queried_object_id();

// Get the object category
$category_object = get_queried_object();

$category_parent = get_term($category_id)->parent;
if ($category_parent) $category_parent_slug = get_term($category_parent)->slug;

// Get the name of the category
$category_name = get_term($category_id)->name;

// Get the slug of the category
$category_slug = get_term($category_id)->slug;

// Get the description of the category
$category_description = get_term($category_id)->description;

// In order to retrieve the products (an object post custom field), we have to pass the term_object into the get_field(), not the (post)_id,
//  because we're talking about a taxonomy instead of a post
// * [Note that we are getting the post_id, not the object id]
$products = get_field('productos', $category_object);

?>

<!--Parrilla de productos -->
<section>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row pb-5">
                <div class="w-100 d-flex flex-wrap" id="delclasFlex">

                    <?php

                        $counter_product = 1;
                        $n = '';

                        // $post ~= $product_id
                        foreach($products as $post) { setup_postdata($post);
                                $product = wc_get_product($post);
                                // Cogemos los ids (en este caso es retorno de ID)
                                // En este caso no es necesario dar contexto ya que cogemos el titulo del post con un ID único
                                if (get_field('autor')) {
                                    $ids_autores = get_field('autor');
                                    $autores = '';
                                    $counter_author = 1;
                                    foreach($ids_autores as $id_autor) {
                                        if ($id_autor) {
                                            $autores .= get_the_title($id_autor);
                                            if ($counter_author < count($ids_autores)) {
                                                $autores .= ', ';
                                            }
                                            $counter_author++;
                                        }
                                    }
                                }
                            ?>

                            <div class="art-item mb-2 pl-lg-3 pr-lg-5" data-precio="<?php echo wc_get_price_including_tax($product); ?>" data-autor="<?php echo $autores; ?>" data-nombre="<?php echo get_the_title(); ?>">

                                <div class="image-art">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php $src = get_the_post_thumbnail_url($post); ?>
                                        <img class="img-fluid2" src="<?php echo $src; ?>" alt="<?php echo $src; ?>">
                                    </a>
                                </div>

                                <div class="hideformo pt-4 pb-4 pt-lg-3 pb-lg-4">
                                    <div class="content-item-art d-flex justify-content-between">

                                        <div class="info-art">
                                            <!-- Nombre Obra -->
                                            <p class="color-custom-black fs-1 ff-ebgi mb-1"><?php the_title(); ?></p>
                                            
                                            <!-- Autores -->
                                            <span class="color-custom-black">
                                                <?php echo $autores; ?> - 
                                            </span>

                                            <!-- Año -->
                                            <span class="color-custom-black">
                                                <?php the_field('ano_de_producto'); ?>
                                            </span>

                                            <!-- Categoria y medidas -->
                                            <div class="category-art product-child-cat">

                                                <span class="color-grey-light2">
                                                    <?php echo Polwoo_get_product_child_cat_a($post); ?>
                                                </span>

                                                <?php if ($product->has_dimensions()) {
                                                    // Local purposes
                                                    $measure = ' cm';
                                                    if ($lang == 'es') {
                                                        $measure = ' cm';
                                                    } elseif ($lang == 'en') {
                                                        // Cambiar por medida ingles
                                                        $measure = ' cm';
                                                    }
                                                    $dimensions = $product->get_width() . ' x ' . $product->get_height() . $measure;
                                                } else {
                                                    $dimensions = get_field('formato');
                                                } ?>

                                                <span class="color-grey-light2"><?php echo $dimensions; ?></span>
                                                
                                            </div>
                                        </div>

                                        <!-- Precio -->
                                        <div class="price-art">
                                            <p class="color-custom-black parrilla-price">
                                                <?php
                                                    if (comprar()) {
                                                        
                                                        $price = wc_get_price_including_tax($product);
                                                        // Solo si estamos en idioma español formateamos precio con separador decimal de ','
                                                        /* if ($lang == 'es') {
                                                            // Formateamos el precio
                                                            $price = custom_format_price($price);
                                                        } */
                                                        echo $price . ' €';
                                                    }
                                                ?>
                                            </p>
                                            <?php
                                                if ( is_user_logged_in() ) {
                                                    $curr = wp_get_current_user();
                                                    $loguser =  $curr->user_login;
                                                    if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados'){  
                                                        $language_actuall = apply_filters( 'wpml_current_language', NULL );         
                                            ?>
                                             test
                                            <?php 
                                                    } 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        <?php $counter_product++; }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!--Modal filtros -->
<section class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div id="modalFiltros" class="scrollBar">
                <div class="d-flex flex-column justify-content-between h-100">

                    <div class="topPart">

                        <div class="topModal d-flex justify-content-between">
                            <h3 class="fw-300"><?php _e('Filtrar y ordenar', 'santa-cole'); ?></h3>
                            <span id="close-filtros" class="icon-close pointer"></span>
                            <!--<div id="close-filtros" class="collapse close">
                                <span class="icon-close"></span>
                            </div>-->
                        </div>

                        <div class="pt-4">
                            <div class="accordion accordionFiltros" id="accordionExample">

                                <?php if (!empty($parent_category)) {

                                    $term = get_term_by('slug', $parent_category, 'product_cat');

                                    // Exclude 'recambios' category (spanish and english)
                                    $terms = get_terms( 'product_cat', array(
                                        'hide_empty' => false,
                                        'parent' => $term->term_id,
                                        'exclude' => array(419, 423)
                                    ) ); ?>

                                <div class="card border-bottom">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mt-3">
                                            <button
                                                class="btn btn-block text-left px-0 collapsed tituloAcordeonContacto w-100"
                                                type="button" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                <?php _e('Categorías', 'santa-cole'); ?>
                                                <span class="fal fa-chevron-up color-custom-black-important"></span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <div class="row align-items-center justify-content-between w-100">
                                                    <div class="col-12 d-flex flex-column justify-content-start px-1">

                                                        <input name="category_all" value="0" type="checkbox"
                                                            id="checkAll" class="position-relative checkBoxCategories"
                                                            checked>
                                                        <label
                                                            for="checkAll"><?php _e('Ver todas las categorias', 'santa-cole'); ?></label>

                                                        <?php

                                                                foreach($terms as $index => $term) { ?>

                                                        <input name="category_option"
                                                            value="<?php echo $term->term_id; ?>" type="checkbox"
                                                            id="<?php echo 'check' . $index; ?>"
                                                            class="position-relative checkBoxCategories">
                                                        <label
                                                            for="<?php echo 'check' . $index; ?>"><?php echo $term->name; ?></label>
                                                        <?php }

                                                            ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                                <?php if (!$musica) { ?>

                                <div class="card border-bottom">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mt-3">
                                            <button
                                                class="btn btn-block text-left px-0 collapsed tituloAcordeonContacto w-100"
                                                type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                <?php _e('Autores', 'santa-cole'); ?>
                                                <span class="fal fa-chevron-up color-custom-black-important"></span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <input name="autor_filter"
                                                class="form-control border-bottom-beige p-0 fs-09" type="text"
                                                placeholder="Buscar por nombre">
                                            <div class="row align-items-center justify-content-between w-100 py-lg-5 py-4 mx-0">
                                                <div class="col-12 d-flex flex-column justify-content-start listaAutoresFiltro scrollBar px-0">

                                                    <script>
                                                        // Filtros script
                                                        jQuery(document).ready(function($) {

                                                            // Se cogen los autores de la parrilla y se printan
                                                            let autores_parrilla = [];
                                                            let productos = $(".product-card")

                                                            productos.each(function() {

                                                                autores_producto = $(this).data('autor')
                                                                autores_producto = autores_producto.split(',')
                                                                
                                                                autores_producto.forEach(function(autor) {
                                                                    // Remove whitespaces
                                                                    autor = autor.replace(/\s/g, '')
                                                                    if (!autores_parrilla.includes(autor)) {
                                                                        autores_parrilla.push(autor)
                                                                    }
                                                                })
                                                            })

                                                            console.log('AUTORES ' + autores_parrilla)
                                                            
                                                            let html_autores = '';

                                                            autores_parrilla.forEach(function(autor) {
                                                                html_autores += `<p class="autor-option color-grey-light2 pointer">${autor}</p>`
                                                            })

                                                            $(".listaAutoresFiltro").append(html_autores)

                                                            // Funcionalidad busqueda y seleccion de autor
                                                            let autors = $(".autor-option")

                                                            $("input[name=autor_filter]").keydown(function(e) {

                                                                if (e.keyCode != 13) {

                                                                    autors.show()

                                                                    let filter_text = $(
                                                                        "input[name=autor_filter]")
                                                                    .val()

                                                                    autors.filter(function(index, element) {

                                                                        let nombre_autor = element
                                                                            .innerText

                                                                        // Normalize strings
                                                                        let norm_autor =
                                                                            nombre_autor
                                                                            .normalize("NFD")
                                                                            .replace(
                                                                                /[\u0300-\u036f]/g,
                                                                                "")
                                                                        let norm_filter =
                                                                            filter_text
                                                                            .normalize("NFD")
                                                                            .replace(
                                                                                /[\u0300-\u036f]/g,
                                                                                "")
                                                                        norm_autor = norm_autor
                                                                            .toLowerCase();
                                                                        norm_filter = norm_filter
                                                                            .toLowerCase();

                                                                        return (!norm_autor.indexOf(
                                                                                norm_filter) <
                                                                            1)

                                                                    }).hide()

                                                                } else {
                                                                    $("input[name=autor_filter").val($(
                                                                            ".listaAutoresFiltro")
                                                                        .children()[0].innerText)
                                                                }

                                                            })

                                                        })
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                                <!--<div class="card border-bottom">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mt-3">
                                            <button
                                                class="btn btn-block text-left px-0 collapsed tituloAcordeonContacto w-100"
                                                type="button" data-toggle="collapse" data-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <?php //_e('Colores', 'santa-cole'); ?>
                                                <span class="fal fa-chevron-up color-custom-black-important"></span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <div class="row align-items-center justify-content-between w-100">
                                                    <div class="col-12 d-flex flex-column justify-content-start px-0">
                                                        <div class="container-fluid">
                                                            <div class="d-flex row w-100">
                                                                <div
                                                                    class="col-12 d-flex flex-wrap justify-content-starts px-0">
                                                                    <div data-color="Red" class="color-item"></div>
                                                                    <div data-color="Blue" class="color-item"></div>
                                                                    <div data-color="Green" class="color-item"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="card border-bottom">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mt-3">
                                            <button
                                                class="btn btn-block text-left px-0 collapsed tituloAcordeonContacto w-100"
                                                type="button" data-toggle="collapse" data-target="#collapseFour"
                                                aria-expanded="true" aria-controls="collapseFour">
                                                <?php _e('Ordenar por', 'santa-cole'); ?>
                                                <span class="fal fa-chevron-up color-custom-black-important"></span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <div class="row align-items-center justify-content-between w-100">
                                                    <div class="col-12 d-flex flex-column justify-content-start px-1">
                                                        <input name="order_option" value="name" type="checkbox"
                                                            id="order1" class="position-relative checkBoxOrder"
                                                            checked><label
                                                            for="order1"><?php _e('Nombre', 'santa-cole'); ?></label>
                                                        <input name="order_option" value="price_asc" type="checkbox"
                                                            id="order2" class="position-relative checkBoxOrder"><label
                                                            for="order2"><?php _e('Precio ascendente', 'santa-cole'); ?></label>
                                                        <input name="order_option" value="price_desc" type="checkbox"
                                                            id="order3" class="position-relative checkBoxOrder"><label
                                                            for="order3"><?php _e('Precio descendente', 'santa-cole'); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid pt-4 ">
                                <div class="row align-items-center justify-content-between w-100">
                                    <div
                                        class="active-filters-modal col-12 d-flex flex-wrap justify-content-start px-0 px-lg-3">
                                        <div class="nav-item pr-1">
                                            <?php //_e('Filtros', 'santa-cole'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bottomPart row justify-content-start pt-5 pt-lg-5 mx-0">
                        <button
                            class="aplicar-filtros square-btn-black"><?php _e('Aplicar filtros', 'santa-cole'); ?></button>
                        <button
                            class="limpiar-filtros bg-transparen square-btn pl-lg-2"><?php _e('Limpiar filtros', 'santa-cole'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();?>