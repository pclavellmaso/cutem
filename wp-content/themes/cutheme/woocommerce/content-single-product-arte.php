<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$language_actual = apply_filters( 'wpml_current_language', NULL );
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <section class="d-lg-block d-none">
        <div class="wrapper">
            <div class="container-fluid mb-lg-5 mt-lg-5 mt-3 mb-3 ">
                <div class="row justify-content-betwwen">
                    <div class="col-lg-6 col-12">
                        <h1 class="title-product mb-2 ff-caslon-i"><?php the_title();?></h1>
                        <!-- <span class="author-product"><?php //the_field('autor'); ?></span> -->
                        <div>
                            <?php
                            $autores = get_field('autor');
                            if( $autores ): ?>

                            <?php foreach( $autores as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>

                            <a class="fs-1563" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                                <?php//the_field( 'ano_de_nacimiento' ); ?>
                            </a>

                            <?php endforeach; ?>

                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                            <?php endif; ?>
                            <br>
                            <span class="fs-1"><?php the_field('ano_de_producto');?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 text-right">

                        <p
                            class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> mb-0">
                            <?php echo $product->get_price_html(); ?>
                        </p>
                        <div class="btn-comprar-1">
                            <a href="<?php echo get_site_url(); ?>/<?php echo $language_actual;
                            if ($language_actual == 'es') {
                                echo '/carrito';
                            } else {
                                echo '/cart';
                            }
                             ?>/?add-to-cart=<?php the_ID(); ?>"
                                class="text-underline color-custom-black"><?php _e('Añadir a la cesta', 'santa-cole') ?></a>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="my-lg-5 my-4 py-lg-5 py-4 overflow-hidden">
        <div class="wrapper">
            <div class="container-fluid px-0 position-relative">
                <div class="slider-primary-product-arte" id="slider-primary-product">

                    <?php 
                        $content = get_field('slider_principal', false, false);
                        $stripped_P = apply_filters('acf_the_content', $content);
                        echo str_replace(array('<p>', '</p>'), '', $stripped_P);
                    ?>

                </div>
            </div>
            <div class="chocolat-lightboxxx">

            </div>
        </div>
    </section>
    <!-- /GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="mb-lg-5 mb-0 pb-lg-5">
        <div class="wrapper">
            <div class="container-fluid ">
                <div class="row d-flex align-items-center">
          
                    <div class="col-12  col-lg-6 summary entry-summary mb-lg-0 mb-4">

                        <?php
                        /**
                         * Hook: woocommerce_single_product_summary.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                            do_action( 'woocommerce_single_product_summary' );
                        ?>


                        <hr class="w-100">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-5 pl-0">
                                    <span
                                        class="text-underline color-grey-light2 fs-08 d-block mb-2 cursor-pointer open-modal-pago">
                                        <?php _e('Pago seguro', 'santa-cole') ?>
                                    </span>
                                    <a href="#" id="seguro_de_envio"
                                        class="text-underline color-grey-light2 fs-08 d-block mb-2 open-modal-envio">
                                        <?php _e('Seguro de envío incluido', 'santa-cole') ?>
                                    </a>
                                    <a href="#"
                                        class="text-underline color-grey-light2 fs-08 d-block mb-2 open-modal-plazos">
                                        <?php _e('Opción de pago a plazos', 'santa-cole') ?>
                                    </a>
                                </div>
                                <div class="col-lg-7 pl-lg-3 pl-0 pr-0 text-md-right">
                                    <span class="color-grey-light2 fs-08"> 
                                        <?php _e('¿Tienes alguna duda? Echa un vistazo a las', 'santa-cole') ?> <a
                                            href="#"
                                            class="text-underline fs-1"><?php _e('condiciones de compra', 'santa-cole') ?></a>
                                        <?php _e('o contacta con', 'santa-cole') ?> <a href="#"
                                            class="text-underline fs-1"><?php _e('nosotros.', 'santa-cole') ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 wrapper-right-fluid pl-lg-3 pl-0 no-destacada">
                        <?php
                            /**
                             * Hook: woocommerce_before_single_product_summary.
                             *
                             * @hooked woocommerce_show_product_sale_flash - 10
                             * @hooked woocommerce_show_product_images - 20
                             */
                            // do_action( 'woocommerce_before_single_product_summary' );
                            global $product;
                            $gallery_images = $product->get_gallery_image_ids();
                            // print_r($gallery_images);
                            foreach( $gallery_images as $attachment_id ) {
                                echo  wp_get_attachment_image(  $attachment_id ,'full');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <!-- SECCION AUTOR -->
    <?php
    $autores = get_field('autor');
    if( $autores ): ?>
    <section class="bg-grey-dark py-lg-5 py-5">
        <div class="wrapper my-lg-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 pb-lg-4 mb-lg-3">
                        <span class="text-white fw-400 "><?php _e('Obra de', 'santa-cole') ?></span>
                        <hr class="w-100 border-color-grey">
                    </div>
                    <div class="col-12">

                        <?php foreach( $autores as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 pr-lg-4 mb-4 px-0">
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('full');
                                    }
                                    else { ?>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/default.png"
                                        class="img-fluid" width="100%" />
                                    <?php } ?>
                                </div>
                                <div class="col-lg-4 px-0">
                                    <h3 class="fw-400 text-white fs-1 mb-lg-4"><?php the_title(); ?></h3>
                                    <div class="fs-09 text-white formato enlacemasinfo"><?php the_field( 'texto_destacado' ); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="text-underline color-grey-light2 ">
                                        <?php _e('Más información', 'santa-cole') ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>

                        <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                        
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <!-- /SECCION AUTOR -->

    <!-- Más obras del artista -->
    <?php 
    //print_r2($autores);
    $menos = array();
    $ProductActual = get_the_ID();
    $menos[] = $ProductActual;
    $args = array(
        'orderby'        => 'rand',
        'posts_per_page' => -1,
        'post_type'      => 'product',
        'post__not_in'        => $menos,
        
        'meta_query'	=> array(
            array(
                'key'		=> 'autor',
                'value'		=> $autores[0],
                'compare'	=> 'LIKE',
            ),
        ),
    );
    //print_r2($args);
    $mas_obras_artista = new WP_Query( $args );                 
        
    if ( $mas_obras_artista->have_posts() ) {
    
    ?>
    <section class="py-lg-5 py-4">
        <div class="wrapper mt-lg-4 mt-0 mb-lg-5 mb-4">
            <div class="container-fluid py-5 px-3">

                <div class="row">
                    <div class="col-12 mb-lg-4 mb-3">

                        <h2 class="fw-400 fs-11"><?php _e('Más obras del artista', 'santa-cole') ?></h2>

                    </div>
                    <div class="col-12">
                        <div class="mas-obras">


                            <?php  
                    
                        
                            while ( $mas_obras_artista->have_posts() ) {
                                $mas_obras_artista->the_post();
                                ?>
                            <div class="obra">
                                <div class="container-fluid px-lg-3 px-0">
                                    <div class="row justify-content-between">
                                        <div
                                            class="col-12 d-flex justify-content-center content-img-mas-obras mb-lg-5 mb-4">

                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('full');
                                                }
                                                else { ?>
                                                <img src="<?php echo get_template_directory_uri() ?>/img/default.png"
                                                    class="img-fluid" />
                                                <?php } ?>

                                            </a>
                                        </div>
                                        <div class="col-lg-6 pl-lg-0">
                                            <h3 class="fs-1 fw-400 mb-1 ff-caslon-i"><a class="fs-1 ff-caslon-i"
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <h4 class="fs-1 mb-1"> <?php 
                                                $auttores = get_field('autor');
                                                if( $auttores ): ?>

                                                <?php foreach( $auttores as $post ): 

                                                // Setup this post for WP functions (variable must be named $post).
                                                setup_postdata($post); ?>
                                                <span><?php the_title(); ?>, </span>
                                                <?php endforeach; ?>

                                                <?php 
                                                // Reset the global post object so that the rest of the page works correctly.
                                                wp_reset_postdata(); ?>
                                                <?php endif; ?><span><?php the_field('ano_de_producto');?></span>
                                            </h4>
                                            <p class="mb-0 color-grey-light2 fs-08">
                                                <?php echo Polwoo_get_product_child_cat($mas_obras_artista->post->ID);?>
                                            </p>
                                            <?php 
                                            /* console_log('postID2');
                                            console_log($mas_obras_artista->post->ID); */
                                            ?>
                                            <!-- <p class="mb-0 color-grey-light2 fs-08">
                                                <?php //the_field('formato'); ?>
                                            </p> -->

                                        </div>
                                        <div class="col-lg-6 text-lg-right">
                                            <p
                                                class="price otro-price fs-09 mb-0">
                                                <?php 
                                                $productt = wc_get_product( $mas_obras_artista->post->ID );
                                                $price = $productt->get_price_html();
                                                echo $price;
                                                ?>
                                            </p>
                                            <div class="btn-comprar-2 fs-08">

                                                <a href="<?php echo get_site_url(); ?>/<?php echo $language_actual;
                                                    if ($language_actual == 'es') {
                                                        echo '/carrito';
                                                    } else {
                                                        echo '/cart';
                                                    }
                                                    ?>/?add-to-cart=<?php echo $mas_obras_artista->post->ID; ?>"
                                                    class="text-underline color-custom-black fs-1"><?php _e('Añadir a la cesta', 'santa-cole') ?>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
                            }//endforeach; 
                            wp_reset_postdata();
                        
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php endif; ?>
    <!-- /Más obras del artista -->
</div>



<?php do_action( 'woocommerce_after_single_product' ); ?>