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
                        <h1 class="title-product mb-4"><?php the_title();?></h1>
                        <!-- <span class="author-product"><?php //the_field('autor'); ?></span> -->
                        <div id="sectioautores">
                            <?php
                            $autores = get_field('autor');
                            if( $autores ): ?>
                            <?php
                                if( sizeof($autores) > 0 ){
                                    $ponercoma = '<span class="eliminarcoma">,</span>';
                                }else{
                                    $ponercoma = '';
                                }

                             ?>
                            <?php foreach( $autores as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>

                            <a class="pr-2 mainautor" href="<?php the_permalink(); ?>">
                                <?php the_title(); echo $ponercoma;?>
                                <?php//the_field( 'ano_de_nacimiento' ); ?>
                            </a>

                            <?php endforeach; ?>

                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                            <?php endif; ?>
                            <br>
                            <span><?php the_field('ano_de_producto');?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 text-right">

                        <p
                            class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> mb-0">
                            <?php 
                                if( $product->is_type( 'variable' ) ){
                                echo _e('Desde: ', 'woocommerce');
                                }
                            ?>
                            <?php 
                                $productss = new WC_Product(get_the_ID());
                                echo $productss->get_price_html();
                            ?>
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
        <div class="container-fluid px-0 position-relative">
            <div class="slider-primary-product" id="slider-primary-product">

                <?php 
                    $content = get_field('slider_principal', false, false);
                    $stripped_P = apply_filters('acf_the_content', $content);
                    echo str_replace(array('<p>','</p>'),'',$stripped_P); 
                ?>

            </div>
        </div>
        <div class="chocolat-lightboxxx">

        </div>
    </section>

    <!-- /GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="mb-lg-5 mb-0 pb-lg-5">
        <div class="container-fluid px-lg-4 px-3">
            <div class="row">
                <div
                    class="col-lg-7 col-12 d-flex flex-column justify-content-center wrapper summary entry-summary mb-lg-0 mb-4">
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
                                    <?php _e('¿Tienes alguna duda? Echa un vistazo a las', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('condiciones de compra', 'santa-cole') ?></a>
                                    <?php _e('o contacta con', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('nosotros.', 'santa-cole') ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 wrapper-right-fluid pl-lg-3 pl-0">

                    <?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					    do_action( 'woocommerce_before_single_product_summary' );
					?>
                </div>

            </div>
        </div>
    </section>



    <?php if( $product->is_type( 'simple' ) ){ ?>


    <seccion>
        <div class="wrapper bg-beige">
            <div class="container-fluid pb-5 pt-3">
                <div class="row py-5 sectionproducts">
                    <div class="col-12">
                        <div class="accordion" id="accordionEspecificaciones">
                            <div class="card" id="especitab">
                                <!-- ACCORDION ESPECIFICACIONES -->
                                <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                    id="heading-1" data-toggle="collapse" data-target="#collapse-1"
                                    aria-expanded="false" aria-controls="collapse-1">
                                    <p class="fs-12 mb-0"><?php _e('Especificaciones', 'santa-cole') ?> </p>
                                    <span class="fal fa-chevron-down fs-12"></span>
                                </div>
                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                    data-parent="#accordionEspecificaciones">
                                    <div class="card-body px-0">
                                        <div class="container-fluid px-0">
                                            <ul class="nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                id="modeltab">
                                                <?php 
                                            $active = 'checked=""';

                                            ?>
                                                <li class="nav-item mr-4 ml-0 mb-2" role="tabini">
                                                    <input id="model-00" type="radio" class="input-radio"
                                                        name="model-select" value="model-00" <?php echo $active ?>>
                                                    <label for="model-00" data-id-act="model-00-tab"
                                                        id="callto_model-00">
                                                        <?php the_title(); ?>
                                                    </label>
                                                </li>
                                                <?php 
                                               /*  $i++;   
                                                endforeach; */
                                                                                         
                                            ?>
                                            </ul>
                                            <!-- Tabs -->
                                            <div class="tab-content" id="modeltancontent">
                                                <?php  
                                                $active = 'active';
                                                ?>
                                                <div class="tab-pane <?php echo $active ?>" id="model-00-tab"
                                                    role="tabpanel" aria-labelledby="model-00-tab">
                                                    <div class="row px-0">
                                                        <div class="col-12 col-md-4 mb-4 mb-md-0">
                                                            <h4 class="mb-4 fw-400 fs-1">
                                                                <?php _e('Plano de cotas', 'santa-cole') ?>
                                                            </h4>

                                                            <?php if (comprar()) { ?>
                                                            <!-- CE -->
                                                            <a href="<?php  the_field('url_plano_de_cotas_pdf');?>"
                                                                target="_blank">
                                                                <img src="<?php  the_field('url_plano_de_cotas');?>"
                                                                    class="img-fluid img-plano-cotas">
                                                            </a>
                                                            <?php }else { ?>
                                                            <!-- UL -->
                                                            <a href="<?php  the_field('url_plano_de_cotas_ul_pdf');?>"
                                                                target="_blank">
                                                                <img src="<?php  the_field('url_plano_de_cotas_ul');?>"
                                                                    class="img-fluid img-plano-cotas">
                                                            </a>
                                                            <?php } ?>

                                                        </div>
                                                        <div class="col-12 col-md-4  mb-4 mb-md-0">
                                                            <h4 class="mb-4 fw-400 fs-1">
                                                                <?php _e('Descripción general', 'santa-cole') ?>
                                                            </h4>
                                                            <div class="fs-09 color-custom-black formato">
                                                                <?php if (comprar()) { ?>
                                                                <!-- CE -->
                                                                <?php the_field('descripcion_general_producto_simple'); ?>
                                                                <?php }else { ?>
                                                                <!-- UL -->
                                                                <?php the_field('descripcion_general_producto_simple_ul'); ?>
                                                                <?php } ?>

                                                            </div>

                                                            <div
                                                                class="col-12 d-flex align-items-center px-lg-0 mt-lg-4 mt-3">

                                                                <?php 
                                                                if (comprar()) { /* CE */
                                                                    $iconos = get_field('html_de_sellos');
                                                                }else { /* UL */
                                                                    $iconos = get_field('html_de_sellos_ul');
                                                                } 
                                                                
                                                                $arrayIconos = explode(",", $iconos);//array($iconos);
                                                                //print_r2($arrayIconos);
                                                                foreach ($arrayIconos as $valor) : 
                                                            ?>

                                                                <div class="d-block pr-lg-4 pr-3">
                                                                    <span class="fs-2 <?php echo $valor;?>"></span>
                                                                </div>
                                                                <?php endforeach; ?>

                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                                <?php /* $i++;   
                                                endforeach; */
                                                 ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="descargastab">
                                    <!-- ACCORDION DESCARGABLES -->
                                    <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                        id="heading-2" data-toggle="collapse" data-target="#collapse-2"
                                        aria-expanded="false" aria-controls="collapse-2">
                                        <p class="fs-12 mb-0"><?php _e('Descargables', 'santa-cole') ?></p>
                                        <span class="fal fa-chevron-down fs-12"></span>
                                    </div>
                                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                        data-parent="#accordionEspecificaciones">
                                        <div class="card-body px-0">
                                            <div class="container-fluid px-0">
                                                <div class="d-flex flex-row">
                                                    <ul class="col-7 col-md-8 col-lg-6 nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                        id="modeltabdescargabl-simple" role="tablist">

                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="model-descargable-00" type="radio"
                                                                class="input-radio" name="model-descargable-select"
                                                                value="model-descargable-00" checked="">
                                                            <label for="model-descargable-00"
                                                                data-id-act="model-descargable-00-tab-simple"
                                                                id="callto_model-descargable-00">
                                                                <?php the_title(); ?>
                                                            </label>
                                                        </li>
                                                        <?php 
                                                       /*  $i++;   
                                                        endforeach; */
                                                    ?>
                                                    </ul>
                                                    <!-- Select for mercado -->
                                                    <ul class="col-5 col-md-4 col-lg-6 nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                        id="mercadoselect">
                                                        <li class="nav-item mr-4 ml-0 mb-2" role="tabpanel-des">
                                                            <input id="mercado-ce" type="radio" class="input-radio"
                                                                name="model-descargable-select-mercado"
                                                                value="mercado-ce" checked="">
                                                            <label for="mercado-ce" data-id-act="mercado-ce-tab"
                                                                id="callto_mercado-ce">
                                                                CE
                                                            </label>
                                                        </li>
                                                        <li class="nav-item mr-4 ml-0 mb-2" role="tabpanel-des">
                                                            <input id="mercado-ul" type="radio" class="input-radio"
                                                                name="model-descargable-select-mercado"
                                                                value="mercado-ul">
                                                            <label for="mercado-ul" data-id-act="mercado-ul-tab"
                                                                id="callto_mercado-ul">
                                                                UL
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Tabs -->
                                                <div class="tab-content" id="descargabletancontent">

                                                    <div class="tab-pane fade show active"
                                                        id="model-descargable-00-tab-simple" role="tabpanel"
                                                        aria-labelledby="model-descargable-00-tab-simple">


                                                        <div class="tab-content" id="mercadoselectcontent">


                                                            <div class="tab-pane fade show active" id="mercado-ce-tab"
                                                                role="tabpanel-des" aria-labelledby="mercado-ce-tab">
                                                                <div class="d-flex flex-wrap">

                                                                    <?php if (comprar()) { ?>
                                                                    <!-- CE -->
                                                                    <?php if( have_rows('archivos_descargables_ce_ce') ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ce_ce') ): the_row(); ?>

                                                                    <a href="<?php the_sub_field('url_del_archivo'); ?>" class="card-descargas-new" target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo'); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo');
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo'); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo');
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo'); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>

                                                                    <?php }else { ?>
                                                                    <!-- UL -->
                                                                    <?php if( have_rows('archivos_descargables_ul_ce') ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ul_ce') ): the_row(); ?>

                                                                    <a href="<?php the_sub_field('url_del_archivo'); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo'); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo');
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo'); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo');
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo'); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>
                                                                    <?php } ?>


                                                                </div>
                                                            </div>


                                                            <div class="tab-pane fade" id="mercado-ul-tab"
                                                                role="tabpanel" aria-labelledby="mercado-ul-tab">
                                                                <div class="d-flex flex-wrap">



                                                                    <?php if (comprar()) { ?>
                                                                    <!-- CE -->
                                                                    <?php if( have_rows('archivos_descargables_ce_ul') ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ce_ul') ): the_row(); ?>

                                                                    <a href="<?php the_sub_field('url_del_archivo'); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo'); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo');
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo'); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo');
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo'); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>

                                                                    <?php }else { ?>
                                                                    <!-- UL -->
                                                                    <?php if( have_rows('archivos_descargables_ul_ul') ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ul_ul') ): the_row(); ?>

                                                                    <a href="<?php the_sub_field('url_del_archivo'); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo'); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo');
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo'); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo');
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo'); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <!-- ACCORDION ADAPTACIONES DE PRODUCTO -->
                                    <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                        id="heading-3" data-toggle="collapse" data-target="#collapse-3"
                                        aria-expanded="false" aria-controls="collapse-3">
                                        <p class="fs-12 mb-0"> <?php _e('Adaptaciones de producto', 'santa-cole') ?></p>
                                        <span class="fal fa-chevron-down fs-12"></span>
                                    </div>
                                    <div id="collapse-3" class="collapse " aria-labelledby="heading-3"
                                        data-parent="#accordionEspecificaciones">
                                        <div class="card-body px-0">
                                            <div class="container-fluid px-0">
                                                <div class="row">

                                                    <?php if(  get_field('adaptaciones_de_producto') !=  null):  ?>
                                                    <div class="col-12 col-md-4">
                                                        <h4 class="mb-4 fw-400">
                                                            <?php _e('Modificaciones disponibles', 'santa-cole') ?></h4>
                                                        <div class="fs-09 color-custom-black formato mb-4">
                                                            <?php the_field('adaptaciones_de_producto') ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php else: ?>
                                                        <div class="col-12 col-md-12">
                                                            <?php endif; ?>
                                                            <h4 class="mb-2">
                                                                <?php _e('Estas y otras modificaciones se estudiarán bajo petición respetando nuestros mínimos de cantidades. Contáctanos para solicitar tu modificación.', 'santa-cole') ?>
                                                            </h4>
                                                            <?php echo do_shortcode( '[contact-form-7 id="294" title="Formulario de contacto"]');  ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                            if (get_field('codigos_unicos_de_recambios')) {?>
                                    <div class="card" id="recambiostab">
                                        <!-- ACCORDION RECAMBIOS -->
                                        <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                            id="heading-4" data-toggle="collapse" data-target="#collapse-4"
                                            aria-expanded="false" aria-controls="collapse-4">
                                            <p class="fs-12 mb-0"> <?php _e('Recambios', 'santa-cole') ?></p>
                                            <span class="fal fa-chevron-down fs-12"></span>
                                        </div>
                                        <div id="collapse-4" class="collapse " aria-labelledby="heading-4"
                                            data-parent="#accordionEspecificaciones">
                                            <div class="card-body px-0">
                                                <div class="container-fluid px-0">
                                                    <div class="row">

                                                        <?php 
                                            
                                                $SKUsRecambios = get_field('codigos_unicos_de_recambios');
                                                $arrayRecambios = explode(",", $SKUsRecambios);
                                                foreach ($arrayRecambios as $Sku) : 
                                                    $language_actuall = apply_filters( 'wpml_current_language', NULL ); 
                                                    $post_id = IDProduct_By_Sku_Mich($Sku,$language_actuall);
                                                    if ($post_id != 000) :
                                                    $imgRecambios = get_the_post_thumbnail($post_id,'full');
                                                    $TitleRecambios = get_the_title($post_id);
                                                    $productt = new WC_Product($post_id);
                                                ?>

                                                        <div class="col-12 col-md-3 mb-4 ">
                                                            <?php echo $imgRecambios; ?>
                                                            <div class="product-contet mt-lg-3 mt-2">
                                                                <div class="d-block">
                                                                    <p class="mb-2 fs-1 color-black">
                                                                        <?php echo $TitleRecambios; ?></p>
                                                                    <!-- <p class="fs-08 color-grey-light3">Acabado</p> -->
                                                                </div>
                                                                <div class="d-block">
                                                                    <p
                                                                        class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> fs-1 mb-2">
                                                                        <?php echo $productt->get_price_html(); ?>
                                                                    </p>
                                                                    <a href="<?php echo get_site_url(); ?>/<?php echo $language_actuall;
                                                            if ($language_actuall == 'es') {
                                                                echo '/carrito';
                                                            } elseif ($language_actuall == 'en') {
                                                                echo '/cart';
                                                            }
                                                            ?>/?add-to-cart=<?php echo $post_id; ?>&quantity=1"
                                                                        class="text-underline color-black"><?php _e('Añadir a la cesta', 'santa-cole') ?></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php 
                                                            endif;
                                                            endforeach;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </seccion>

    <?php } elseif( $product->is_type( 'variable' ) ){ ?>

    <?php
    $IDProduct =  get_the_ID();

 
    if ($language_actual == 'es') {
        $modelo_string = 'pa_modelo';
    } elseif ($language_actual == 'en') {
        $modelo_string = 'pa_model';
    }

    $values = wc_get_product_terms( $IDProduct, $modelo_string, array( 'fields' =>  'all' ) ); ?>

    <?php //print_r2($values); ?>

    <?php if( $values ) {?>

    <seccion>
        <div class="wrapper bg-beige">
            <div class="container-fluid pb-5 pt-3">
                <div class="row py-5 sectionproducts">
                    <div class="col-12">
                        <div class="accordion" id="accordionEspecificaciones">
                            <div class="card" id="especitab">
                                <!-- ACCORDION ESPECIFICACIONES -->
                                <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                    id="heading-1" data-toggle="collapse" data-target="#collapse-1"
                                    aria-expanded="false" aria-controls="collapse-1">
                                    <p class="fs-12 mb-0"><?php _e('Especificaciones', 'santa-cole') ?> </p>
                                    <span class="fal fa-chevron-down fs-12"></span>
                                </div>
                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                    data-parent="#accordionEspecificaciones">
                                    <div class="card-body px-0">
                                        <div class="container-fluid px-0">
                                            <ul class="nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                id="modeltab">
                                                <?php 
                                            $i=0;
                                            foreach ( $values as $term ) :
                                            if($i === 0){$active = 'checked=""';}else{$active = '';}

                                            ?>
                                                <li class="nav-item mr-4 ml-0 mb-2" role="tabini">
                                                    <input id="model-<?php echo $i ?>" type="radio" class="input-radio"
                                                        name="model-select" value="model-<?php echo $i ?>"
                                                        <?php echo $active ?>>
                                                    <label for="model-<?php echo $i ?>"
                                                        data-id-act="model-<?php echo $i ?>-tab"
                                                        id="callto_model-<?php echo $i ?>">
                                                        <?php echo before('-', $term->name); ?>
                                                    </label>
                                                </li>
                                                <?php 
                                                $i++;   
                                                endforeach;
                                                                                         
                                            ?>
                                            </ul>
                                            <!-- Tabs -->
                                            <div class="tab-content" id="modeltancontent">
                                                <?php  
                                                $i=0;
                                                foreach ( $values as $term ) : 
                                                    if($i === 0){$active = 'active';}else{$active = '';}
                                                ?>
                                                <div class="tab-pane <?php echo $active ?>"
                                                    id="model-<?php echo $i ?>-tab" role="tabpanel"
                                                    aria-labelledby="model-<?php echo $i ?>-tab">
                                                    <div class="row px-0">
                                                        <div class="col-12 col-md-4 mb-4 mb-md-0">
                                                            <h4 class="mb-4 fw-400 fs-1">
                                                                <?php _e('Plano de cotas', 'santa-cole') ?>
                                                            </h4>

                                                            <?php if (comprar()) { ?>
                                                            <a href="<?php  the_field('url_plano_de_cotas_pdf', 'term_' . $term->term_id);?>"
                                                                target="_blank">
                                                                <img src="<?php  the_field('url_plano_de_cotas', 'term_' . $term->term_id);?>"
                                                                    class="img-fluid img-plano-cotas">
                                                            </a>
                                                            <?php }else { ?>
                                                            <a href="<?php  the_field('url_plano_de_cotas_ul_pdf', 'term_' . $term->term_id);?>"
                                                                target="_blank">
                                                                <img src="<?php  the_field('url_plano_de_cotas_ul', 'term_' . $term->term_id);?>"
                                                                    class="img-fluid img-plano-cotas">
                                                            </a>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-12 col-md-4  mb-4 mb-md-0">
                                                            <h4 class="mb-4 fw-400 fs-1">
                                                                <?php _e('Descripción general', 'santa-cole') ?>
                                                            </h4>
                                                            <div class="color-custom-black fs-09 formato">

                                                                <?php if (comprar()) { ?>
                                                                <?php  the_field('descripcion_general_ce', 'term_' . $term->term_id);?>
                                                                <?php //echo $term->description; ?>
                                                                <?php }else { ?>
                                                                <?php  the_field('descripcion_general_ul', 'term_' . $term->term_id);?>
                                                                <?php } ?>
                                                            </div>

                                                            <div
                                                                class="col-12 d-flex align-items-center px-lg-0 mt-lg-4 mt-3">

                                                                <?php 
                                                                if (comprar()) { 
                                                                    $iconos = get_field('html_de_sellos', 'term_' . $term->term_id);
                                                                }else {
                                                                    $iconos = get_field('html_de_sellos_ul', 'term_' . $term->term_id);
                                                                }
                                                                $iconos = get_field('html_de_sellos', 'term_' . $term->term_id);
                                                                $arrayIconos = explode(",", $iconos);//array($iconos);
                                                                //print_r2($arrayIconos);
                                                                foreach ($arrayIconos as $valor) : 
                                                            ?>

                                                                <div class="d-block pr-lg-4 pr-3">
                                                                    <span class="fs-2 <?php echo $valor;?>"></span>
                                                                </div>
                                                                <?php endforeach; ?>

                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                                <?php $i++;   
                                                endforeach;
                                                 ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="descargastab">
                                    <!-- ACCORDION DESCARGABLES RATATAAA -->
                                    <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                        id="heading-2" data-toggle="collapse" data-target="#collapse-2"
                                        aria-expanded="false" aria-controls="collapse-2">
                                        <p class="fs-12 mb-0"><?php _e('Descargables', 'santa-cole') ?></p>
                                        <span class="fal fa-chevron-down fs-12"></span>
                                    </div>
                                    <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                        data-parent="#accordionEspecificaciones">
                                        <div class="card-body px-0">
                                            <div class="container-fluid px-0">

                                                <div class="d-flex flex-row">
                                                    <ul class="col-7 col-md-8 col-lg-6 nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                        id="modeltabdescargable-simple" role="tablist">
                                                        <?php 
                                                        $i=0;
                                                        foreach ( $values as $term ) :
                                                        if($i === 0){$active = 'checked=""';}else{$active = '';} 
                                                    ?>
                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="model-descargable-<?php echo $i ?>" type="radio"
                                                                class="input-radio" name="model-descargable-select"
                                                                value="model-descargable-<?php echo $i ?>"
                                                                <?php echo $active ?>>
                                                            <label for="model-descargable-<?php echo $i ?>"
                                                                data-id-act="model-descargable-<?php echo $i ?>-tab-simple"
                                                                id="callto_model-descargable-<?php echo $i ?>">
                                                                <?php echo before('-', $term->name); ?>
                                                            </label>
                                                        </li>
                                                        <?php 
                                                       $i++;   
                                                        endforeach;
                                                    ?>
                                                    </ul>
                                                    <!-- Select for mercado -->
                                                    <ul class="listalo col-5 col-md-4 col-lg-6 nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                        id="mercadoselect-m1">
                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="mercado-ce-m1" type="radio" class="input-radio"
                                                                name="model-descargable-select-mercado-m1"
                                                                value="mercado-ce-m1" checked="">
                                                            <label for="mercado-ce-m1"
                                                                data-id-act="mercadoselectcontent-ce-0">
                                                                CE
                                                            </label>
                                                        </li>
                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="mercado-ul-m1" type="radio" class="input-radio"
                                                                name="model-descargable-select-mercado-m1"
                                                                value="mercado-ul-m1">
                                                            <label for="mercado-ul-m1"
                                                                data-id-act="mercadoselectcontent-ul-0">
                                                                UL
                                                            </label>
                                                        </li>
                                                    </ul>

                                                    <ul class="listalo col-5 col-md-4 col-lg-6 nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                        id="mercadoselect-m2">


                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="mercado-ce-m2" type="radio" class="input-radio"
                                                                name="model-descargable-select-mercado-m2"
                                                                value="mercado-ce-m2" checked="">
                                                            <label for="mercado-ce-m2"
                                                                data-id-act="mercadoselectcontent-ce-1">
                                                                CE
                                                            </label>
                                                        </li>
                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="mercado-ul-m2" type="radio" class="input-radio"
                                                                name="model-descargable-select-mercado-m2"
                                                                value="mercado-ul-m2">
                                                            <label for="mercado-ul-m2"
                                                                data-id-act="mercadoselectcontent-ul-1">
                                                                UL
                                                            </label>
                                                        </li>


                                                    </ul>
                                                </div>
                                                <!-- Tabs -->
                                                <div class="tab-content" id="descargabletancontent">
                                                    <?php  
                                                $i=0;
                                                foreach ( $values as $term ) : 
                                                    if($i === 0){$active = 'active';}else{$active = '';}
                                                ?>
                                                    <div class="tab-pane fade show <?php echo $active ?>"
                                                        id="model-descargable-<?php echo $i ?>-tab-simple"
                                                        role="tabpanel"
                                                        aria-labelledby="model-descargable-<?php echo $i ?>-tab-simple">

                                                        <div class="tab-content-inter-ce"
                                                            id="mercadoselectcontent-ce-<?php echo $i ?>">
                                                            <div class="tab-pane-inter show active" id="mercado-ce-tab"
                                                                role="tabpanel-inter" aria-labelledby="mercado-ce-tab">
                                                                <div class="d-flex flex-wrap">

                                                                    <?php if (comprar()) { ?>
                                                                    <?php if( have_rows('archivos_descargables_ce_ce', 'term_' . $term->term_id) ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ce_ce', 'term_' . $term->term_id) ): the_row(); ?>


                                                                    <a href="<<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                            $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                            $fianlexte =  explode( ".", $extencion );
                                                                                            echo  $fianlexte[1];
                                                                                        ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>
                                                                    <?php }else { ?>
                                                                    <?php if( have_rows('archivos_descargables_ul_ce', 'term_' . $term->term_id) ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ul_ce', 'term_' . $term->term_id) ): the_row(); ?>
                                                                    <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>
                                                                    <?php } ?>



                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="tab-content-inter-ul"
                                                            id="mercadoselectcontent-ul-<?php echo $i ?>">
                                                            <div class="tab-pane-inter-ul" id="mercado-ul-tab"
                                                                role="tabpanel-inter-ul"
                                                                aria-labelledby="mercado-ul-tab">
                                                                <div class="d-flex flex-wrap">
                                                                    <?php if (comprar()) { ?>
                                                                    <?php if( have_rows('archivos_descargables_ce_ul', 'term_' . $term->term_id) ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ce_ul', 'term_' . $term->term_id) ): the_row(); ?>

                                                                    <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>
                                                                    <?php }else { ?>
                                                                    <?php if( have_rows('archivos_descargables_ul_ul', 'term_' . $term->term_id) ): ?>

                                                                    <?php while( have_rows('archivos_descargables_ul_ul', 'term_' . $term->term_id) ): the_row(); ?>

                                                                    <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>" class="card-descargas-new"  target="_blank">
                                                                        <p class="mb-0">
                                                                            <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?><br>
                                                                            <span class="color-grey-light2 mb-0 text-uppercase topmvov">
                                                                                <?php
                                                                                    $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                    $fianlexte =  explode( ".", $extencion );
                                                                                    echo  $fianlexte[1];
                                                                                ?>
                                                                            </span>
                                                                            <spen class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </span>
                                                                        </p>
                                                                    </a>
                                                                    <!-- <div class="card-descargas">
                                                                        <div
                                                                            class="border-black border d-flex flex-column text-center justify-content-center align-items-center ">
                                                                            <div class="topmvov">
                                                                                <p class="mb-0">
                                                                                    <?php the_sub_field('nombre_del_archivo', 'term_' . $term->term_id); ?>
                                                                                </p>
                                                                                <p
                                                                                    class="color-grey-light2 mb-0 text-uppercase">
                                                                                    <?php
                                                                                        $extencion = get_sub_field('url_del_archivo', 'term_' . $term->term_id);
                                                                                        $fianlexte =  explode( ".", $extencion );
                                                                                        echo  $fianlexte[1];
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                            <a href="<?php the_sub_field('url_del_archivo', 'term_' . $term->term_id); ?>"
                                                                                class="enlacecard">
                                                                                <i class="fal fa-arrow-to-bottom"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div> -->

                                                                    <?php endwhile; ?>

                                                                    <?php endif; ?>
                                                                    <?php } ?>


                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <?php 
                                                    $i++; 
                                                    endforeach;
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <!-- ACCORDION ADAPTACIONES DE PRODUCTO -->
                                    <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                        id="heading-3" data-toggle="collapse" data-target="#collapse-3"
                                        aria-expanded="false" aria-controls="collapse-3">
                                        <p class="fs-12 mb-0"> <?php _e('Adaptaciones de producto', 'santa-cole') ?></p>
                                        <span class="fal fa-chevron-down fs-12"></span>
                                    </div>
                                    <div id="collapse-3" class="collapse " aria-labelledby="heading-3"
                                        data-parent="#accordionEspecificaciones">
                                        <div class="card-body px-0">
                                            <div class="container-fluid px-0">
                                                <div class="row">
                                                    <?php if(  get_field('adaptaciones_de_producto') !=  null):  ?>
                                                    <div class="col-12 col-md-4">
                                                        <h4 class="mb-4 fw-400">
                                                            <?php _e('Modificaciones disponibles', 'santa-cole') ?></h4>
                                                        <div class="fs-09 color-custom-black formato mb-4">
                                                            <?php the_field('adaptaciones_de_producto') ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <?php else: ?>
                                                        <div class="col-12 col-md-12">
                                                            <?php endif; ?>
                                                            <h4 class="mb-2">
                                                                <?php _e('Estas y otras modificaciones se estudiarán bajo petición respetando nuestros mínimos de cantidades. Contáctanos para solicitar tu modificación.', 'santa-cole') ?>
                                                            </h4>
                                                            <?php echo do_shortcode( '[contact-form-7 id="294" title="Formulario de contacto"]');  ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card" id="recambiostab">
                                        <!-- ACCORDION RECAMBIOS  aqui -->
                                        <div class="d-flex justify-content-between align-items-center card-header collapsed border-bottom bg-transparent px-0"
                                            id="heading-4" data-toggle="collapse" data-target="#collapse-4"
                                            aria-expanded="false" aria-controls="collapse-4">
                                            <p class="fs-12 mb-0"> <?php _e('Recambios', 'santa-cole') ?></p>
                                            <span class="fal fa-chevron-down fs-12"></span>
                                        </div>
                                        <div id="collapse-4" class="collapse " aria-labelledby="heading-4"
                                            data-parent="#accordionEspecificaciones">
                                            <div class="card-body px-0">
                                                <div class="container-fluid px-0">




                                                    <ul class="nav nav-tabs d-flex justify-content-start justify-content-md-start mb-3 flex-column flex-md-row mb-4"
                                                        id="select-model-recambios" role="tablist">
                                                        <?php 
                                                        $i=0;
                                                        foreach ( $values as $term ) :
                                                        if($i === 0){$active = 'checked=""';}else{$active = '';} 
                                                    ?>
                                                        <li class="nav-item mr-4 ml-0 mb-2">
                                                            <input id="model-recambios-<?php echo $i ?>" type="radio"
                                                                class="input-radio" name="model-recambios-select"
                                                                value="model-recambios-<?php echo $i ?>"
                                                                <?php echo $active ?>>
                                                            <label for="model-recambios-<?php echo $i ?>"
                                                                data-id-act="model-recambios-<?php echo $i ?>-tab"
                                                                id="callto_model-recambios-<?php echo $i ?>">
                                                                <?php echo  before('-', $term->name); ?>
                                                            </label>
                                                        </li>
                                                        <?php 
                                                       $i++;   
                                                        endforeach;
                                                    ?>
                                                    </ul>
                                                    <div class="tab-content" id="recambios-tancontent">
                                                        <?php  
                                                    $i=0;
                                                    foreach ( $values as $term ) : 
                                                        if($i === 0){$active = 'active';}else{$active = '';}
                                                    ?>
                                                        <div class="tab-pane <?php echo $active ?>"
                                                            id="model-recambios-<?php echo $i ?>-tab" role="tabpanel"
                                                            aria-labelledby="model-recambios-<?php echo $i ?>-tab">
                                                            <div class="row ">

                                                                <?php 
                                            
                                                                $SKUsRecambios = get_field('codigos_unicos_de_recambios', 'term_' . $term->term_id);
                                                                $arrayRecambios = explode(",", $SKUsRecambios);
                                                                foreach ($arrayRecambios as $Sku) : 
                                                                $language_actuall = apply_filters( 'wpml_current_language', NULL ); 
                                                                $post_id = IDProduct_By_Sku_Mich($Sku,$language_actuall);
                                                                if ($post_id != 000) :
                                                                $imgRecambios = get_the_post_thumbnail($post_id,'full');
                                                                $TitleRecambios = get_the_title($post_id);
                                                                $productt = new WC_Product($post_id);
                                                            ?>

                                                                <div class="col-12 col-md-3 mb-4">
                                                                    <?php echo $imgRecambios; ?>
                                                                    <div class="product-contet mt-lg-3 mt-2">
                                                                        <div class="d-block">
                                                                            <p class="mb-2 fs-1 color-black">
                                                                                <?php echo $TitleRecambios; ?></p>
                                                                            <!-- <p class="fs-08 color-grey-light3">Acabado</p> -->
                                                                        </div>
                                                                        <div class="d-block">
                                                                            <p
                                                                                class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> fs-1 mb-2">
                                                                                <?php echo $productt->get_price_html(); ?>
                                                                            </p>
                                                                            <a href="<?php echo get_site_url(); ?>/<?php echo $language_actuall;
                                                                    if ($language_actuall == 'es') {
                                                                        echo '/carrito';
                                                                    } elseif ($language_actuall == 'en') {
                                                                        echo '/cart';
                                                                    }
                                                                    ?>/?add-to-cart=<?php echo $post_id; ?>"
                                                                                class="text-underline color-black"><?php _e('Añadir a la cesta', 'santa-cole') ?></a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <?php 
                                                                endif;
                                                                endforeach; 
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <?php 
                                                        $i++; 
                                                        endforeach; 
                                                    ?>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </seccion>

    <?php } ?>

    <?php } ?>


    <!-- 
        INICIO NUEVAS SECCIONES YOVALO  
        SECCONES DE ILUMINACION 

         Sección Especificaciones <-----------
    -->
    <?php
    /* 
    ESTO ES PARA MOSTRAR EL LOS CAMPOS PERSONALIZADOS DE LA VARIACION
    $variation_ids = $product->get_children();
 
		 if ( empty( $variation_ids ) ) 
			 return $respuesta;
		 
		 foreach( $variation_ids as $variation_id ) {
			  
			$variation = wc_get_product( $variation_id); 
			$adicional_var =  get_post_meta($variation_id, '_esl_variation', true);
			 if($variation->get_stock_quantity()<1 && $adicional_var!='')  { 
 				$detalle .= '<div class="aviso_agotado_var">'.$adicional_var."</div>";
			 }
		 } */?>


    <!--  Sección Texto lírico  -->
    <seccion>
        <div class="wrapper py-5">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12">
                        <h3 class="fs-1 fw-400"><?php the_field('titulo_del_texto_lirico') ?></h3>
                        <hr class="border-light-grey">
                    </div>
                </div>
                <div class="row pt-md-5 justify-content-between">
                    <div class="col-12 col-md-6 mb-4 mb-md-0">
                        <?php the_content(); ?>
                        <a href="" title=""
                            class="fs-08 text-underline "><?php _e('Nombre del premio', 'santa-cole') ?></a>
                    </div>
                    <div class="col-12 col-md-5 text-right">
                        <img src="<?php the_field('imagen_adicional') ?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </seccion>
    <!--  / Sección Texto lírico  -->

    <?php 
        /*
            OCULTAMOS LA SECCION DE PRODICTOS EN LUGARES 
            CUANDO NO HAY IMAGENES
        */
        if( $product->is_type( 'simple' ) ){
            $imgs = damApi($product->get_sku(), false);
        } elseif( $product->is_type( 'variable' ) ){
            $imgs = damApi($product->get_sku());
        }
        if ( !empty( $imgs ) ):
    ?>
    <!-- Sección Productos en lugares -->
    <section>
        <div class="wrapper py-5">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-lg-6 col-md-6 ">
                        <h3 class="mb-4 fw-400"> <?php _e('Producto en lugares', 'santa-cole') ?></h3>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                            consequat massa quis enim.</p> -->
                    </div>
                    <!-- <div class="col-lg-6 col-md-6 d-flex flex-column justify-content-end">
                        <a href="#" class="text-sm-left text-md-right text-lg-right text-underline">CTA de la
                            sección</a>
                    </div> -->
                </div>
            </div>
        </div>

        <div <?php if(wp_is_mobile()){echo 'class="wrapper pb-5"';}else{echo 'class="wrapper-left pb-5 "';} ?>>
            <div class="container-fluid <?php if(!wp_is_mobile()){echo 'pr-0';} ?>">
                <div class="carrusel-una-imagen-dos">
                    <?php 

                    foreach ($imgs as $valores) { ?>

                    <div class="item-container-dos pr-lg-5 pr-4 mb-4">
                        <a href="https://www.santacole.com/recursos/imagenes_galeria/<?php echo $valores['redimension_x1000']; ?>"
                            class="lightbox-carrusel-dos">
                            <img
                                src="https://www.santacole.com/recursos/imagenes_galeria/<?php echo $valores['redimension_x600']; ?>">
                        </a>
                    </div>

                    <?php } ?>

                </div>
            </div>
            <div id="carrusel-02" class="bg-white"></div>
        </div>
    </section>

    <!-- /Sección Productos en lugares -->
    <?php endif; ?>
    <!-- SECCION AUTOR -->
    <seccion>
        <div class="wrapper bg-beige py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h3 class="fw-400 fs-1"><?php _e('Diseño de', 'santa-cole') ?></h3>
                        <hr class="border-light-grey">
                    </div>
                </div>
                <div class="row pt-md-4 pt-lg-5">
                    <div id="autor-container">
                        <?php
                            $autores = get_field('autor');
                            if( $autores ): ?>

                        <?php foreach( $autores as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>
                        <div class="autor-item d-flex col-12 mb-5  mb-md-0">
                            <div class="autor-iamge col-12 px-0">
                                <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail('full');
                                    }
                                    else { ?>
                                <img src="<?php echo get_template_directory_uri() ?>/img/default.png"
                                    class="img-fluid" />
                                <?php } ?>
                            </div>
                            <div class="autor-description col-12 mt-2 pt-2 mt-lg-4 pt-lg-4 px-0">
                                <p class="fs-11 mb-4"><?php the_title(); ?></p>
                                <div class="fs-09 color-custom-black formato mb-4">
                                    <?php the_field( 'texto_destacado' ); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" title=""
                                    class="fs-08 text-underline color-grey-light2"><?php _e('Más información', 'santa-cole') ?></a>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </seccion>

    <!-- /SECCION AUTOR -->

    <!-- Sección Relacionados -->
    <section class="py-lg-5 py-4">
        <div class="wrapper">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-12 mb-lg-4 mb-3">
                        <?php
                            $heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'Productos relacionados', 'woocommerce' ) );

                            if ( $heading ) :
			            ?>
                        <h2 class="fw-400 fs-11 mb-lg-4 mb-3"><?php echo esc_html( $heading ); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-left">
            <div class="container-fluid px-1 pb-5">
                <div class="row">

                    <div class="col-12 px-0">


                        <?php
                        /**
                         * Hook: woocommerce_after_single_product_summary.
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Sección Relacionados -->


</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>