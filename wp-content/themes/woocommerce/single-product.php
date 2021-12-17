<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<script>
jQuery(document).ready(function($) {

    $(".open-modal-arte").click(function() {
        let field = $(this).prop("id")
    })
})
</script>

<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

<?php while ( have_posts() ) : ?>
<?php the_post(); ?>

<?php 
    $language_actual = apply_filters( 'wpml_current_language', NULL );
	if( has_term( 'libros', 'product_cat' ) || has_term( 'books', 'product_cat' )){
		wc_get_template_part( 'content', 'single-product-libros' );
	}
	elseif ( has_term( 'arte', 'product_cat' ) ||  has_term( 'art', 'product_cat' ) || has_term( 'series', 'product_cat' ) || has_term( 'editions', 'product_cat' ) || has_term( 'neoserie', 'product_cat' )  || has_term( 'originales', 'product_cat' ) || has_term( 'originals', 'product_cat' )) {
        wc_get_template_part( 'content', 'single-product-arte' );
	}
    elseif( has_term( 'mobiliario', 'product_cat' ) || has_term( 'asientos', 'product_cat' ) || has_term( 'furniture', 'product_cat' )){
        wc_get_template_part( 'content', 'single-product-mobiliario' );
	}
    elseif( has_term( 'musica', 'product_cat' ) || has_term( 'music', 'product_cat' )){
        wc_get_template_part( 'content', 'single-product-musica' );
	}
    elseif( has_term( 'iluminacion', 'product_cat' ) && has_term( 'recambios', 'product_cat' )){
        wc_get_template_part( 'content', 'single-product' );
	}
	elseif( has_term( 'iluminacion', 'product_cat' ) || has_term( 'lighting', 'product_cat' ) || has_term( 'lamparas-de-sobremesa', 'product_cat' ) || has_term( 'lamparas-de-pie', 'product_cat' ) || has_term( 'apliques', 'product_cat' ) || has_term( 'lamparas-de-suspension', 'product_cat' ) || has_term( 'bateria', 'product_cat' ) || has_term( 'exterior', 'product_cat' ) || has_term( 'table-lamps', 'product_cat' ) || has_term( 'floor-lamps', 'product_cat' ) || has_term( 'wall-lamps', 'product_cat' ) || has_term( 'pendant-lamps', 'product_cat' ) || has_term( 'portable', 'product_cat' ) || has_term( 'outdoor', 'product_cat' )){
        wc_get_template_part( 'content', 'single-product-iluminacion' );
	}
	else{
		wc_get_template_part( 'content', 'single-product' );
	}
	
?>

<?php endwhile; // end of the loop. ?>

<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>
<div class="modalnav" id="Modal-product">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between px-0">
                <span class="d-block fs-1"><?php //_e('Contacto y servicios', 'santa-cole') ?></span>

                <div id="close-navModal" class="collapse">
                    <span class="fal fa-times color-custom-black fa-lg"></span>
                </div>
            </div>

            <div class="col-12">
                <?php the_field('que_es_una_neoserie', 'option')?>
                <?php the_field('el_original_de_una_neoserie', 'option')?>
                <?php the_field('pago_seguro', 'option')?>
                <?php the_field('seguro_de_envio', 'option')?>
                <?php the_field('pago_a_plazos', 'option')?>
            </div>

        </div>
    </div>

</div>

<div class="modalnav modal-right-arte modal-pago">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <span class="d-block fs-11"><?php _e('Pago seguro', 'santa-cole') ?></span>
                <div>
                    <span class="fal fa-times color-custom-black cursor-pointer fa-lg"></span>
                </div>
            </div>
            <div class="col-12 mt-4 pr-lg-5">
                <p><?php the_field('pago_seguro', 'option') ?></p>
            </div>
        </div>
    </div>
</div>

<div class="modalnav modal-right-arte modal-envio">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <span class="d-block fs-11"><?php _e('Seguro de envío incluido', 'santa-cole') ?></span>
                <div class="iconocerrar">
                    <span class="fal fa-times color-custom-black cursor-pointer fa-lg"></span>
                </div>
            </div>
            <div class="col-12 mt-4 pr-lg-5">
                <p class="bb-grey pb-5 mb-0"><?php the_field('envio_parrafo_1', 'option') ?></p>
                <?php if (have_rows('envio_parrafo_2', 'option')) {
                    while (have_rows('envio_parrafo_2', 'option')) { the_row(); ?>
                <p class="bb-grey py-3 mb-0"><?php the_sub_field('subseccion'); ?></p>
                <?php }
                } ?>
                <p class="pt-5"><?php the_field('envio_parrafo_3', 'option') ?></p>
            </div>
        </div>
    </div>
</div>

<div class="modalnav modal-right-arte modal-plazos">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <span class="d-block fs-11"><?php _e('Opción de pago a plazos', 'santa-cole') ?></span>
                <div>
                    <span class="fal fa-times color-custom-black cursor-pointer fa-lg"></span>
                </div>
            </div>
            <div class="col-12 mt-4 pr-lg-5">
                <p><?php the_field('pago_a_plazos', 'option') ?></p>
            </div>
        </div>
    </div>
</div>

<div class="modalnav-left modal-left-arte modal-que-es-neoserie custom-scroll custom-border-right-modal custom-direction">

    <div class="container-fluid">
        <div class="row ovy-scroll">
            <div class="col-12 d-flex justify-content-between">
                <div>
                    <p class="d-block fs-11 fs-lg-11 mb-0"><?php _e('¿Qué es una Neoserie', 'santa-cole') ?>&reg; ?</p>
                    <p class="mb-0 ff-ebgi fs-lg-11"><?php _e('La democratización del arte', 'santa-cole'); ?></p>
                </div>
                <div>
                    <span class="fal fa-times color-custom-black cursor-pointer fa-lg"></span>
                </div>
            </div>
            <div class="col-12 mt-4 pr-lg-5">
                <p><?php the_field('que_es_una_neoserie', 'option') ?></p>
            </div>
            <a href="" class="square-btn-black button alt wc-forward nomanlad ml-3 mt-3 open-modal-muestras"><?php echo _e('Pedir muestras', 'santacole') ?></a>
        </div>
    </div>
</div>


<!-- Modal Muestras Neoseries -->
<div class="modalnav modal-muestras bg-black">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <span class="d-block fs-11"><?php _e('Muestras de Neoseries', 'santa-cole') ?></span>
                <div>
                    <span class="fal fa-times color-custom-black cursor-pointer fa-lg"></span>
                </div>
            </div>
            <div class="col-12 mt-4 pr-lg-5">
                <?php 
                    $desclocal = $_SERVER['HTTP_HOST'];
                    if( $desclocal == 'localhost'){
                        echo do_shortcode( '[contact-form-7 id="12828" title="Muestras neoseries"]'); 
                    }else{
                        echo do_shortcode( '[contact-form-7 id="21753" title="Muestras neoseries"]'); 
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal ¿Qué supone adquirir el original de una Neoserie? -->
<div class="modalnav-left custom-border-right-modal modal-origninal ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <div>
                    <span class="d-block fs-11"><?php _e('¿Qué supone adquirir el original de una Neoserie?', 'santa-cole') ?></span>
                    <span class="d-block fs-11 fw-400 ff-caslon-i"><?php _e('¿La democratización del arte', 'santa-cole') ?></span>
                </div>
                <div>
                    <span class="fal fa-times color-custom-black cursor-pointer fa-lg"></span>
                </div>
            </div>
            <div class="col-12 mt-4 pr-lg-5">
                <?php the_field('el_original_de_una_neoserie', 'option')?>
            </div>
        </div>
    </div>
</div>



<!-- Sección stick bar -->
<section id="navbar_filtros-products" class="mainfixpro">
    <nav id="navbar_top" class="navbar navbar-expand-lg bg-white py-0 px-0">
        <div class="w-100">
            <div class="ml-5">
                <div class="row align-items-center justify-content-between w-100">
                    <div class="col-5 nav-item dropdown position-static justify-content-start">
                        <?php  if( has_term( 'arte', 'product_cat' ) ||  has_term( 'art', 'product_cat' ) || has_term( 'series', 'product_cat' ) || has_term( 'neoseries', 'product_cat' ) || has_term( 'originales', 'product_cat' ) || has_term( 'neoserie', 'product_cat' ) || has_term( 'originals', 'product_cat' ) || has_term( 'editions', 'product_cat' ))  : ?>
                        <a href='<?php the_field('imagen_adicional') ?>'
                            class='ver-en-espacio lightboxxx mr-4'><?php _e('Ver en espacio', 'santa-cole') ?></a>
                        <a href="" class="mr-4"><?php _e('Información de la obra', 'santa-cole') ?></a>
                        <a href="" class="mr-4"><?php _e('Artista', 'santa-cole') ?></a>
                        <?php elseif( has_term( 'iluminacion', 'product_cat' ) ) : ?>
                        <a href="#especitab" id="especificaiones-product"
                            class="mr-4 smooth-link"><?php _e('Información técnica', 'santa-cole') ?></a>
                        <a href="#descargastab" id="descargatab-product"
                            class="mr-4 smooth-link"><?php _e('Descargas', 'santa-cole') ?></a>
                        <a href="#recambiostab" id="recambiostab-product"
                            class="mr-4 smooth-link"><?php _e('Recambios', 'santa-cole') ?></a>
                        <a href="" class="mr-4 smooth-link"><?php _e('Autor', 'santa-cole') ?></a>
                        <?php elseif( has_term( 'libros', 'product_cat' ) ) : ?>

                        <?php 
                                if (get_field('indice_de_libro')) {?>
                        <a class="mr-4"
                            href="/recursos/productos/downloads/libros/indice/<?php the_field('indice_de_libro');?>"
                            class="anchorindice">
                            <ins class="text-14px color-grey-light2"><?php _e('Índice del libro', 'santa-cole') ?></ins>
                        </a>
                        <?php }
                            ?>
                        <a href="" class="mr-4"><?php _e('Información de libro', 'santa-cole') ?></a>
                        <?php elseif( has_term( 'musica', 'product_cat' ) ) : ?>
                        <a href="" class="mr-4">Características</a>
                        <a href="" class="mr-4">Tecnología</a>
                        <a href="" class="mr-4">Personalizar</a>
                        <?php else: ?>
                        <!-- No tiene categoria -->
                        <a href="#especitab" id="especificaiones-product"
                            class="mr-4 smooth-link"><?php _e('Información técnica', 'santa-cole') ?></a>
                        <a href="#descargastab" id="descargatab-product"
                            class="mr-4 smooth-link"><?php _e('Descargas', 'santa-cole') ?></a>
                        <a href="#recambiostab" id="recambiostab-product"
                            class="mr-4 smooth-link"><?php _e('Recambios', 'santa-cole') ?></a>
                        <a href="" class="mr-4 smooth-link"><?php _e('Autor', 'santa-cole') ?></a>

                        <?php endif; ?>
                    </div>
                    <div class="col-5 text-right d-flex justify-content-end align-items-center pr-0 topbarfix">
                        <p
                            class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> mb-0 ml-3 mr-3 d-flex align-items-center">

                            <?php 
                                if( $product->is_type( 'variable' ) ){
                                   echo  _e('Desde:', 'woocommerce');
                                } 
                            ?>&nbsp
                            <?php 
                                $productss = new WC_Product(get_the_ID());
                                echo $productss->get_price_html();
                            ?>
                        </p>

                        <?php if (comprar()) { ?>

                        <?php if( $product->is_type( 'simple' ) ){ ?>
                        <div class="btn-comprar-1 ml-3">
                            <a href="<?php echo get_site_url(); ?>/<?php echo $language_actual;
								if ($language_actual == 'es') {
									echo '/carrito';
								} else {
									echo '/cart';
								}
								?>/?add-to-cart=<?php the_ID(); ?>" class="add-to-cart-var buttoncont square-btn-black"><?php _e('Añadir a la cesta', 'santa-cole') ?>
                            </a>
                        </div>
                        <?php } elseif( $product->is_type( 'variable' ) ){ ?>
                        <div class="btn-comprar-1">

                            <button
                                class="add-to-cart-var buttoncont square-btn-black fs-09"
                                id="add-to-cart-var"><?php _e('Añadir a la cesta', 'santa-cole') ?></button>

                        </div>
                        <?php } ?>
                        <?php } else { ?>
                        <div class="btn-comprar-1">
                            <a href="<?php echo home_url(); ?>/<?php echo $language_actual;
                            if ($language_actual == 'es') {
                                echo '/donde-comprar/';
                            } else  if ($language_actual == 'en'){
                                echo '/where-to-buy/';
                            }
                             ?>/"
                                class="text-underline color-custom-black"><?php _e('Donde comprar', 'santa-cole') ?></a>
                        </div>
                        <?php }?>
                    </div>
                </div> <!-- row.// -->
            </div> <!-- container-fluid.// -->
        </div> <!-- wrapper-header.// -->
    </nav>
</section>


<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */