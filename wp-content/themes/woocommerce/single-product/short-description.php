<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
/* if ( ! $short_description ) {
	return;
} */

$productt = new WC_Product($post->ID);
?>

<?php if( has_term( 'libros', 'product_cat' ) ||  has_term( 'books', 'product_cat' )) : ?>
<div class="description-large mb-lg-4 mb-3">
    <?php the_content(); ?>
</div>
<span class="color-custom-black fw-400 "><?php _e('Detalles', 'santa-cole') ?></span>
<hr class="w-100">
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-6 pl-0">
            <div class="woocommerce-product-details__short-description mb-lg-5 mb-4 fs-09">
                <?php echo $short_description; // WPCS: XSS ok. ?>
                <?php 
                if (get_field('indice_de_libro')) {?>
                <a href="/recursos/productos/downloads/libros/indice/<?php the_field('indice_de_libro');?>"
                    class="anchorindice">
                    <ins class="text-14px color-grey-light2"><?php _e('Índice del libro', 'santa-cole') ?></ins>
                </a>
                <?php }
                ?>

            </div>
        </div>
        <div class="col-lg-6 pl-lg-3 pl-0 iconos-libros">
            <!-- Iconos Libros -->
            <?php the_field('iconos');?>
        </div>
    </div>
</div>
<?php elseif ( has_term( 'originales', 'product_cat' ) ||  has_term( 'originals', 'product_cat' ) ||  has_term( 'series', 'product_cat' )) : ?>
    
<div class="woocommerce-product-details__short-description mb-lg-5 mb-4">
    <?php the_content(); ?>
</div>
<div class="caracteristicas">
    <span class="color-custom-black fw-400 "><?php _e('Características', 'santa-cole') ?></span>
    <hr class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 pl-0 fs-09">
                <span class="color-grey-light3 fw-400 "><?php _e('Técnica', 'santa-cole') ?></span>
            </div>
            <div class="col-8 fs-09">
                <?php the_field('tecnica');?>
            </div>
            <div class="col-12 px-0">
                <hr class="w-100">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 pl-0 fs-09">
                <span class="color-grey-light3 fw-400 "><?php _e('Formato', 'santa-cole') ?></span>
            </div>
            <div class="col-8 fs-09">
                <?php //echo do_shortcode("[product_additional_information id='$post->ID']");?>
                <?php if ($productt->has_dimensions()) { ?>
                    <!-- <span class="d-block"><?php echo $productt->get_width();?> x <?php echo $productt->get_height();?> <?php _e('cm', 'santa-cole') ?></span> -->
                <?php } ?>
                <?php the_field('formato');?>
            </div>
            <div class="col-12 px-0">
                <hr class="w-100">
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 pl-0">
                <span class="color-grey-light3 fw-400 d-block"><?php _e('Edición', 'santa-cole') ?></span>
            </div>
            <div class="col-8 fs-09">
                <?php the_field('edicion');?>
            </div>
            <div class="col-12 px-0">
                <hr class="w-100">
                <!-- <div class="mt-4 fs-09"><?php //echo $short_description; // WPCS: XSS ok. ?></div> -->
            </div>
        </div>
    </div>
</div>

<?php elseif ( has_term( 'neoserie', 'product_cat' ) ||  has_term( 'neoseries', 'product_cat' ) ) : ?>

    <div class="woocommerce-product-details__short-description mb-lg-5 mb-4">
    <?php the_content(); ?>
</div>
<div class="caracteristicas">
    <span class="color-custom-black fw-400 "><?php _e('Características', 'santa-cole') ?></span>
    <hr class="w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 pl-0 fs-09">
                <span class="color-grey-light3 fw-400 "><?php _e('Técnica', 'santa-cole') ?></span>
            </div>
            <div class="col-8 fs-09">
                <?php the_field('tecnica');?>
            </div>
            <div class="col-12 px-0">
                <hr class="w-100">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 pl-0 fs-09">
                <span class="color-grey-light3 fw-400 "><?php _e('Formato', 'santa-cole') ?></span>
            </div>
            <div class="col-8 fs-09">
                <?php //echo do_shortcode("[product_additional_information id='$post->ID']");?>
                <?php if ($productt->has_dimensions()) { ?>
                    <!-- <span class="d-block"><?php echo $productt->get_width();?> x <?php echo $productt->get_height();?> <?php _e('cm', 'santa-cole') ?></span> -->
                <?php } ?>
                <?php the_field('formato');?>
            </div>
            <div class="col-12 px-0">
                <hr class="w-100">
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 pl-0">
                <span class="color-grey-light3 fw-400 d-block"><?php _e('Edición', 'santa-cole') ?></span>
                <span class="d-block pointer color-grey-light3 text-underline open-modal-neoserie"><?php _e('¿Qué es una Neoserie?', 'santa-cole') ?></span>
            </div>
            <div class="col-8 fs-09">
                <span class="d-block"><?php _e('Siguiente unidad en venta Nº', 'santa-cole') ?> <?php the_field('siguiente_unidad_en_venta');?></span>
                <?php the_field('edicion');?>
            </div>
            <div class="col-12 px-0">
                <hr class="w-100">
                <!-- <div class="mt-4 fs-09"><?php //echo $short_description; // WPCS: XSS ok. ?></div> -->
            </div>
        </div>
    </div>
</div>

<?php elseif( has_term( 'iluminacion', 'product_cat' ) && has_term( 'recambios', 'product_cat' )) : ?>
    <div class="description-large mb-lg-4 mb-3">
        <?php the_content(); ?>
    </div>
<?php else : ?>
<div class="woocommerce-product-details__short-description mb-lg-5 mb-4 fs-09">
    <?php echo $short_description; // WPCS: XSS ok. ?>
</div>
<?php endif;?>