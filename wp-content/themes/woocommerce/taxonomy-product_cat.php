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

// Idioma actual
$lang = apply_filters( 'wpml_current_language', NULL );

// By default (according to the url), this page already have the context of the taxnonomy (term), so we can get the description (p.e) without setting up the context

// Get the id of the category
$category_id = get_queried_object_id();

// Get the object category
$category_object = get_queried_object();

$category_parent = get_term($category_id)->parent;
if ($category_parent) {
    $category_parent_slug = get_term($category_parent)->slug;
}



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

// Check the category or subcategory

$iluminacion = false;
$libros = false;
$arte = false;
$musica = false;
$mobiliario = false;

$tipo_autor = '';

if ( ($category_slug == 'iluminacion' || $category_slug == 'lighting') || ( !empty($category_parent_slug) && (($category_parent_slug == 'iluminacion') || ($category_parent_slug == 'lighting') ) ) ) {
    $iluminacion = true;
    // term_id de tipo autor iluminación array(81, 217);
    $tipo_autor = 61;
	
	//console_log(apply_filters( 'wpml_object_id', $category_id, 'product_cat' ));
    
	if (empty($category_parent_slug)) {
        if ($lang == 'es') {
            $parent_category = 'iluminacion';
        } else {
            $parent_category = 'lighting';
        }
        
    }
}

if ( ($category_slug == 'libros' || $category_slug == 'books') || ( !empty($category_parent_slug) && (($category_parent_slug == 'libros') || ($category_parent_slug == 'books') ) ) ) {
    $libros = true;
    $tipo_autor = array(87, 215);

    if (empty($category_parent_slug)) {
        if ($lang == 'es') {
            $parent_category = 'libros';
        } else {
            $parent_category = 'books';
        }
    }
}

if ( ($category_slug == 'musica' || $category_slug == 'music') || ( !empty($category_parent_slug) && (($category_parent_slug == 'musica') || ($category_parent_slug == 'music') ) ) ) {
    $musica = true;
    $tipo_autor = array(85,219);

    if (empty($category_parent_slug)) {
        if ($lang == 'es') {
            $parent_category = 'musica';
        } else {
            $parent_category = 'music';
        }
        
    }
}

if ( ($category_slug == 'mobiliario' || $category_slug == 'furniture') || ( !empty($category_parent_slug) && (($category_parent_slug == 'mobiliario') || ($category_parent_slug == 'furniture') ) ) ) {
    $mobiliario = true;
    
    $tipo_autor = array(209,211);

    if (empty($category_parent_slug)) {
        if ($lang == 'es') {
            $parent_category = 'mobiliario';
        } else {
            $parent_category = 'furniture';
        }
    }
}

if ( ($category_slug == 'arte' || $category_slug == 'art') || ( !empty($category_parent_slug) && (($category_parent_slug == 'arte') || ($category_parent_slug == 'art') ) ) ) {
    $arte = true;
    $tipo_autor = array(83,213);

    // Lo de parent_category no es necesario si no hay una parrila de arte de 'Todas las categorias'
    
}

?>

<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"
    integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k=" crossorigin="anonymous"></script>

<!--Navbar sticky  filtros -->
<header id="navbar_filtros" class="d-lg-block d-none">
    <nav id="navbar_top" class="navbar navbar-expand-lg bg-white">
        <div class="wrapper-header w-100">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between w-100">
                    <div class="col-4 nav-item dropdown position-static justify-content-start">
                        <a class="nav-link dropdown-toggle text-left" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!--Lámparas de sobremesa-->
                        </a>
                        <div class="dropdown-menu drop-class w-100" aria-labelledby="navbarDropdown">
                            <div class="container-fluid">
                                <div class="row align-items-center justify-content-between w-100">
                                    <div class="col-12 justify-content-start">
                                        <div class="wrapper-header w-100">
                                            <div class="container-fluid px-0">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Action</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 collapse navbar-collapse d-flex justify-content-center" id="main_nav">
                        <div
                            class="active-filters-sticky navbar-nav ms-auto row align-items-center justify-content-between w-100">
                            <div class="nav-item"><span class="nav-link"><?php _e('Filtros', 'santa-cole'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-right text-underline openM pointer pr-0">
                        <div class=""><?php _e('Filtrar y ordenar', 'santa-cole'); ?></div>
                    </div>
                </div> <!-- row.// -->
            </div> <!-- container-fluid.// -->
        </div> <!-- wrapper-header.// -->
    </nav>
</header>




<!--Sección introductoria -->
<section>
    <div class="wrapper">
        <div class="container-fluid px-0 px-lg-3">
            <div class="row pt-lg-5">
                <div class="col-12">
                    <div class="container-fluid">
                        <div class="row d-flex flex-column">
                            <div class="col-12 pb-lg-2 pb-4 px-0">
                                <div class="breadcrumb color-grey-light2 p-0 bg-transparent mb-0">
                                    <?php
                                        if ( function_exists('yoast_breadcrumb') ) {
                                            yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5 d-flex justify-content-between align-items-end">
                            <div class="col-12 col-md-6 col-xl-6 px-0">
                                <h1 class="color-custom-black fs-13 fs-lg-15 pb-3 fw-400 mb-lg-0">
                                    <?php echo $category_name; ?></h1>
                                <p class="color-custom-black fs-08 fs-lg-09 lh-lg-20 mb-0">
                                    <?php echo $category_description; ?></p>
                            </div>
                            <div
                                class="col-12 col-md-6 col-xl-6 d-flex align-items-end justify-content-md-end mt-md-0 px-0">

                                <div
                                    class="col text-underline pointer py-3 py-lg-0 d-lg-flex d-block  justify-content-end align-items-center pr-0">
                                    <div class="openM px-2">
                                        <p class="color-custom-black fs-08 fs-lg-09 mb-lg-0 text-right">
                                            <?php _e('Filtrar y ordenar', 'santa-cole'); ?></p>
                                    </div>
                                    <?php if ($arte) { ?>
                                    <div class="col-auto pl-0 px-2 d-flex align-items-center justify-content-end">
                                        <p class="color-custom-black fs-08 fs-lg-09 mb-0 px-2">
                                            <?php _e('Vista', 'santa-cole'); ?></p>
                                        <input type="range" min="0" max="100" value="50"
                                            class="range bg-black p-0 w-50 w-lg-auto"></input>
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="hline-grey mt-lg-5 mb-5"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Get selected banners data before the loop -->
<?php

    $bannerShow = false;

    if (get_field('anadir_banner_1', $category_object)) {
        $banner1 = array(
            'imagen' => get_field('imagen_1', $category_object),
            'tag_titulo' => get_field('etiqueta_1', $category_object),
            'texto_titulo' => get_field('titulo_1', $category_object),
            'texto' => get_field('texto_1', $category_object),
            'enlace' => get_field('enlace_1', $category_object),
            'fila' => get_field('fila_1', $category_object),
            'ancho' => get_field('ancho_1', $category_object),
            'color_textos' => get_field('color_textos_1', $category_object)
        );
        $bannerShow = true;
    }

    if (get_field('anadir_banner_2', $category_object)) {
        $banner2 = array(
            'imagen' => get_field('imagen_2', $category_object),
            'tag_titulo' => get_field('etiqueta_2', $category_object),
            'texto_titulo' => get_field('titulo_2', $category_object),
            'texto' => get_field('texto_2', $category_object),
            'enlace' => get_field('enlace_2', $category_object),
            'fila' => get_field('fila_2', $category_object),
            'ancho' => get_field('ancho_2', $category_object),
            'color_textos' => get_field('color_textos_2', $category_object)
        );
        $bannerShow = true;
    }

    if (get_field('anadir_banner_2', $category_object)) {
        $banner3 = array(
            'imagen' => get_field('imagen_3', $category_object),
            'tag_titulo' => get_field('etiqueta_3', $category_object),
            'texto_titulo' => get_field('titulo_3', $category_object),
            'texto' => get_field('texto_3', $category_object),
            'enlace' => get_field('enlace_3', $category_object),
            'fila' => get_field('fila_3', $category_object),
            'ancho' => get_field('ancho_3', $category_object),
            'color_textos' => get_field('color_textos_3', $category_object)
        );
        $bannerShow = true;
    }

?>

<!--Parrilla de productos -->
<!-- Parrilla style for iluminaciónn / Books category and subcategories -->
<?php if ( !$arte ) { ?>

<section>
    <div class="wrapper cat-grid-products">
        <div class="container-fluid px-lg-4">
            <div class="row d-flex justify-content-between row-margin px-lg-n4">
                <div
                    class="row pb-5 d-flex row-cols-1 products-cards <?php if ($libros) { echo 'row-cols-lg-4'; } else { echo 'row-cols-lg-3'; } ?> ">

                    <?php 
                            
                            $counter_product = 1;
                            $n = '';
                            
                            // $post == $product_id
                            if (!empty($products)) {

                                foreach($products as $post) { 
                                
                                    $banner = false;

                                    if ($bannerShow) {

                                        if ($banner1['fila'] == $counter_product) {
                                            $n = 1;
                                            $banner = true;
                                        } elseif ($banner2['fila'] == $counter_product) {
                                            $n = 2;
                                            $banner = true;
                                        } elseif ($banner3['fila'] == $counter_product) {
                                            $n = 3;
                                            $banner = true;
                                        }
                                    }

                                    if ($banner) { ?>
                    <div class="<?php echo ${'banner' . $n}['ancho']; ?> px-lg-4 pb-5">
                        <div class="d-flex flex-column justify-content-start"
                            style="background:url('<?php echo ${'banner' . $n}['imagen']; ?>') center center; background-size:cover; height:60vh;">

                            <div class="px-lg-5 col-lg-4">
                                <div class="row py-5">
                                    <div class="col-12">

                                        <?php

                                                                $tag = ${'banner' . $n}['tag_titulo'];
                                                                $color = ${'banner' . $n}['color_textos'];
                                                                $texto = ${'banner' . $n}['texto_titulo'];
                                                                echo '<' . $tag . ' class="fs-1 fs-lg-11 fw-400 lh-lg-23 ' . $color . '">' . $texto . '</' . $tag . '>';

                                                            ?>

                                        <p class="<?php echo ${'banner' . $n}['color_textos']; ?> py-3">
                                            <?php echo ${'banner' . $n}['texto'] ?></p>

                                        <?php $link = ${'banner' . $n}['enlace'];
                                                                if( $link ): 
                                                                    $link_url = $link['url'];
                                                                    $link_title = $link['title'];
                                                                    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                                        <?php endif; ?>
                                        <a class="text-underline <?php echo ${'banner' . $n}['color_textos']; ?>"
                                            href="<?php echo esc_url( $link_url ); ?>"
                                            target="<?php echo esc_attr( $link_target ); ?>">
                                            <?php echo esc_html( $link_title ); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } 
                                    
                                    
                                    if (!empty($post)) {

                                        setup_postdata($post);

                                        $product = wc_get_product($post); ?>

                    <?php
                                            // Cogemos los autores
                                            if ($product->get_parent_id()) {
                                                $ids_autores = get_field('autor', $product->get_parent_id());
                                            } else {
                                                $ids_autores = get_field('autor');
                                            }
                                            
                                            if ($ids_autores) {
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

                                            // Cogemos precio (si el producto es variable cogemos el mínimo)

                                            if ($libros) {
                                                $price = precio_mas_iva_libros( $post );
                                            } else {
                                                $price = precio_mas_iva($post);

                                                /* if($product->is_type('variable')) {
                                                    $variable = true;
                                                    $price = $product->get_variation_sale_price( 'min', true );
                                                } */
    
                                                // Solo si estamos en idioma español formateamos precio con separador decimal de ','
                                                /* if ($lang == 'es') {
                                                    // Formateamos el precio
                                                    $price = custom_format_price($price);
                                                } */
                                            }

                                            
                                            
                                            // Posibilidad de quitar el html y quedarnos solo con el numero (explode etc)

                                            // Cogemos año del producto (si el producto es variable cogemos el del padre)
                                            if ($product->get_parent_id()) {
                                                $parent_id = $product->get_parent_id();
                                                if (get_field('ano_de_producto', $parent_id)) $ano_producto = get_field('ano_de_producto', $parent_id);
                                            } else {
                                                if (get_field('ano_de_producto')) $ano_producto = get_field('ano_de_producto');
                                            }

                                            // Cogemos la categoria del producto y su id (si el producto es variable cogemos la del padre)
                                            if ($product->get_parent_id()) {
                                                $categoria_producto = Polwoo_get_product_child_cat_a( $product->get_parent_id() );
                                                
                                                // Cogemos el id de la categoria de cada producto (caso más lógico en parrilla iluminación genérica)
                                                //  para poder filtrar productos por categoria
                                                $category_id = Polwoo_get_product_child_cat_id( $product->get_parent_id() );
                                            } else {
                                                $categoria_producto = Polwoo_get_product_child_cat_a($post);
                                                $category_id = Polwoo_get_product_child_cat_id( $product->get_id() );
                                            }
                                                                                      
                                        ?>

                    <div class="product-card col px-lg-4 pb-5"
                        data-precio="<?php if ($price) echo str_replace($price, ',', '.'); ?>"
                        data-autor="<?php if ($autores) echo $autores; ?>" data-nombre="<?php echo get_the_title(); ?>"
                        data-category="<?php echo $category_id; ?>">

                        <div class="product-img position-relative">
                            <a href="<?php the_permalink(); ?>">

                                <?php
                                    /* if (comprar()) {

                                        if ( has_post_thumbnail($post) ){
                                            //the_post_thumbnail('full');
                                            echo get_the_post_thumbnail( $post, 'full' );
                                        }
                                        
                                    } else {

                                        // Solo en iluminacion y mobiliario, mostramos imagen de upload, y sinó la thumbnail
                                        if ($iluminacion || $mobiliario) {

                                            $content = get_field('imagen_destacada');
                                            if ($content) {
    
                                                echo wp_get_attachment_image( $content, 'full' , true);
                                            }else {
    
                                                the_post_thumbnail('full');
                                            }
                                        }
                                    } */

                                    if ( has_post_thumbnail($post) ) {
                                    
                                        
                                        if (comprar()) {
                                            the_post_thumbnail('full');
                        
                                        }else {
                                            $content = get_field('imagen_destacada', false, false);
                                            if ($content) {
                                                echo wp_get_attachment_image( $content, 'full' , true);
                                            }else {
                                                the_post_thumbnail('full');
                                            }
                                        }
                                        
                                    } else { 
                                        $content = get_field('imagen_destacada', false, false);
                                        echo apply_filters('acf_the_content', $content);
                                        
                                    }

                                    // Sea lo que sea (comprar()), mostrar imagen de hover si hay
                                    $img_ids = $product->get_gallery_image_ids();

                                    if ($img_ids) {
                                        $img_url = wp_get_attachment_url( $img_ids[0] );
                                        $split_url = explode('/', $img_url); ?>

                                <img class="img-hover" src="<?php echo $img_url; ?>"
                                    alt="<?php echo end($split_url); ?>">

                                <?php }
                                ?>
                            </a>
                        </div>

                        <div
                            class="product-text d-flex flex-column justify-content-start align-items-end pt-4 pb-0 pt-lg-3 pb-lg-4">

                            <div class="product-first-group d-flex justify-content-between w-100 mb-lg-1">

                                <!-- Nombre -->
                                <h2 class="fs-1 w-60 fw-400 mb-0"><?php the_title(); ?></h2>

                                <!-- Precio -->
                                <span class="parrilla-price fw-400">
                                    <?php
                                        if (comprar()) {
                                            
                                            if ($product->is_type('variable')) {
                                                _e('Desde ', 'santa-cole');
                                                echo $price . ' €';
                                            } else {
                                                echo $price . ' €';
                                            }
                                            
                                        }
                                    ?>
                                </span>

                            </div>

                            <div
                                class="product-second-group d-flex <?php if (!$musica) { echo 'justify-content-between'; } else { echo 'justify-content-end'; } ?> w-100 mb-lg-2">

                                <?php if (!$musica) { ?>
                                <div>
                                    <!-- Autores -->
                                    <span class="color-grey-light2">
                                        <?php if ($autores) echo $autores; ?> -
                                    </span>
                                    <!-- Año -->
                                    <span class=" color-grey-light2">
                                        <?php if ($ano_producto) echo $ano_producto; ?>
                                    </span>
                                </div>
                                <?php } ?>


                                <div class="text-right">
                                    <span class="color-grey-light2 product-child-cat text-right lh-1">
                                        <!-- Categoria -->
                                        <!-- Parrilla libros y musica hay que mostrar categoria hija? -->
                                        <?php if ($categoria_producto) echo $categoria_producto; ?>
                                    </span>
                                </div>

                            </div>
                            <?php
                                $language_actuall = apply_filters( 'wpml_current_language', NULL ); 
                                if ( $language_actuall == 'es' ){
                                    if ( is_user_logged_in() ) {
                                        $curr = wp_get_current_user();
                                        $loguser =  $curr->user_login;
                                        if ( $loguser == 'galeriabarcelona' || $loguser == 'galeriabarcelonados'){      
                                ?>
                            <div>
                                <?php 
                                            $real_cat = yov_get_product_child_cat( $post );
                                            if (comprar()) { ?>
                                <?php if( $product->is_type( 'simple' ) ){ ?>
                                <a href="<?php echo $real_cat;?>?add-to-cart=<?php echo $post; ?>"
                                    class="text-underline color-black">
                                    <?php _e('Añadir al carrito', 'santa-cole') ?>
                                </a>
                                <?php }elseif( $product->is_type( 'variable' ) ){ 
                                                    
                                                        //woocommerce_template_loop_add_to_cart(); 
                                                    } ?>
                                <?php } ?>
                            </div>
                            <?php 
                                        }
                                    } 
                                }
                            ?>









                            <div class="product-third-group d-flex justify-content-between w-100">
                                <!-- hasta nuevo aviso <div class="tags d-flex justify-content-start">
                                                        <p class="tag-acabado text-white bg-black p-2 mr-2">Nuevo acabado</p>
                                                        <p class="tag-entrega bg-custom-white p-2">Entrega rápida</p>
                                                    </div> -->
                                <!-- <div class="colors-group ml-auto">
                                                        <div class="color-item"></div>
                                                        <div class="color-item"></div>
                                                        <div class="color-item"></div>
                                                    </div> -->
                            </div>

                        </div>
                    </div>

                    <?php }
                            
                                $counter_product++; }
                            } ?>

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

<!-- Editor's Picks or Other Categories -->
<?php } elseif ($arte) {
    wc_get_template_part( 'taxonomy-product_cat', 'arte' );
} else { ?>

<section>
    <div class="wrapper cat-grid-products">
        <div class="container-fluid px-lg-4">
            <div class="row d-flex justify-content-between row-margin px-lg-n4">
                <div class="row pb-5 d-flex row-cols-1 row-cols-lg-3">

                    <?php 
                            
                            $counter_product = 1;
                            $n = '';
                            
                            // $post == $product_id
                            if (!empty($products)) {

                                foreach($products as $post) { 
                                    
                                    if (!empty($post)) {

                                        setup_postdata($post);

                                        $product = wc_get_product($post); ?>

                                        <?php
                                            // GET AUTHORS
                                            if ($product->get_parent_id()) {
                                                $ids_autores = get_field('autor', $product->get_parent_id());
                                            } else {
                                                $ids_autores = get_field('autor');
                                            }
                                            if ($ids_autores) {
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

                                            // GET PRICE
                                            

                                            
                                                $price = precio_mas_iva($post);

                                                /* if($product->is_type('variable')) {
                                                    $variable = true;
                                                    $price = $product->get_variation_sale_price( 'min', true );
                                                } */
                                            

                                            // Solo si estamos en idioma español formateamos precio con separador decimal de ','
                                            /* if ($lang == 'es') {
                                                // Formateamos el precio
                                                $price = custom_format_price($price);
                                            } */

                                            // GET YEAR
                                            if ($product->get_parent_id()) {
                                                $parent_id = $product->get_parent_id();
                                                if (get_field('ano_de_producto', $parent_id)) $ano_producto = get_field('ano_de_producto', $parent_id);
                                            } else {
                                                if (get_field('ano_de_producto')) $ano_producto = get_field('ano_de_producto');
                                            }

                                            // GET CATEGORY
                                            if ($product->get_parent_id()) {
                                                $categoria_producto = Polwoo_get_product_child_cat_a($product->get_parent_id());
                                            } else {
                                                $categoria_producto = Polwoo_get_product_child_cat_a($post);
                                            }
                                            
                                        ?>

                    <div class="product-card col px-lg-4 pb-5"
                        data-precio="<?php if ($price) echo str_replace(',', '.', $price); ?>"
                        data-autor="<?php if ($autores) echo $autores; ?>" data-nombre="<?php echo get_the_title(); ?>">

                        <div class="product-img position-relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php $src = get_the_post_thumbnail_url($post); ?>
                                <img class="img-fluid" src="<?php echo $src; ?>" alt="<?php echo $src; ?>">

                                <?php
                                    $img_ids = $product->get_gallery_image_ids();
                                    if ($img_ids) {
                                        $img_url = wp_get_attachment_url( $img_ids[0] );
                                        $split_url = explode('/', $img_url); ?>

                                <img class="img-hover" src="<?php echo $img_url; ?>"
                                    alt="<?php echo end($split_url); ?>">

                                <?php }
                                ?>
                            </a>
                        </div>

                        <div
                            class="product-text d-flex flex-column justify-content-start align-items-end pt-4 pb-0 pt-lg-3 pb-lg-4">

                            <div class="product-first-group d-flex justify-content-between w-100 mb-lg-1">
                                <!-- ECHO NAME -->
                                <h2 class="fs-1 fs-lg-1 w-60 fw-400 mb-0"><?php the_title(); ?></h2>
                                <!-- ECHO PRICE -->
                                <span class="fs-075 fs-lg-875 parrilla-price fw-400">
                                    <?php
                                        if (comprar()) {
                                            
                                            if ($product->is_type( 'variable' )) {
                                                _e('Desde ', 'santa-cole');
                                                echo $price . ' €';
                                            } else {
                                                echo $price . ' €';
                                            }
                                            
                                        }
                                    ?>
                                </span>
                            </div>

                            <div class="product-second-group d-flex justify-content-between w-100 mb-lg-2">

                                <div>
                                    <!-- ECHO AUTHORS -->
                                    <span class="color-grey-light2 fs-08 fs-lg-08">
                                        <?php if ($autores) echo $autores; ?> -
                                    </span>
                                    <!-- ECHO YEAR -->
                                    <span class=" color-grey-light2 fs-08 fs-lg-08">
                                        <?php
                                                                if ($ano_producto) echo $ano_producto;
                                                            ?>
                                    </span>
                                </div>

                                <div>
                                    <span class="fs-08 color-grey-light2 product-child-cat">
                                        <!-- ECHO CATEGORY -->
                                        <?php if ($categoria_producto) echo $categoria_producto; ?>
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                    <?php }
                            
                                $counter_product++; }
                            } ?>

                </div>
            </div>
        </div>
    </div>
</section>



<?php } ?>

<?php

get_footer();?>