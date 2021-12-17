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

//Incluimos el fichero del config en el tema


include(get_theme_root().'/santa-cole/config.php');
// require get_template_directory() .'/config.php';

//Declaramos la variable de idioma
$language_actual = apply_filters( 'wpml_current_language', NULL );
$idioma = ICL_LANGUAGE_CODE;
?>


<?php 

//Condicionales para determinar el producto de música
$productoMusica = "";

	if( has_term( 'guitarras-acusticas', 'product_cat')){
        $productoMusica = 8;
        $stringMusica = '%Frontera%';
	}
	elseif ( has_term( 'guitarras-clasicas', 'product_cat')) {
        $productoMusica = 30;
        $stringMusica = '%Liceo%';
	}
	elseif( has_term( 'percusion', 'product_cat' )){
        $productoMusica = 15;
        $stringMusica = '%Nomada%';
	}
    //console_log('$productoMusica');
    //console_log($productoMusica);

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

<?php if($productoMusica != null){?>

    <section>
        <div class="wrapper">
            <div class="container-fluid mb-lg-5 mt-lg-5 mt-3 mb-3 ">
                <div class="row justify-content-betwwen">
                    <div class="col-lg-6 col-12">
                        <h1 class="title-product mb-0"><?php the_title();?></h1>
                        <!-- <span class="author-product"><?php //the_field('autor'); ?></span> -->
                        <div>
                            <?php
                            $autores = get_field('autor');
                            if( $autores ): ?>

                            <?php foreach( $autores as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>

                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
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

                        <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> mb-0">
                            <?php 
                                 if( $product->is_type( 'variable' ) ){
                                    echo  _e('Desde :', 'woocommerce');
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

    <?php } ?>


    <!-- Sección del carrusel de imágenes inspiracionales -->
    <?php

    if($productoMusica != null){

        $getImagenesPresentacion = "SELECT mpi.id_producto, mpi.foto_original_r1, mpi.id_imagen 
        FROM `milagro_productos_imagenes` AS mpi 
        WHERE mpi.id_producto = ".$productoMusica." and mpi.Ver_Ficha_Completa = 1";
        $imagenesPresentacion = $bd_pim->consultar($getImagenesPresentacion);

    }

    //console_log("getImagenesPresentacion");
    //console_log($imagenesPresentacion);

    //Evaluación del contenido del select. Si no hay contenido no se pinta la sección

    if(isset($imagenesPresentacion)){
    
    ?>
    <!-- GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="my-lg-5 my-4 py-lg-5 py-4 overflow-hidden">
        <div class="container-fluid px-0 position-relative">
            <div class="slider-primary-product" id="slider-primary-product">

            <?php  for($u = 0; $u < sizeof($imagenesPresentacion); $u++):
                echo'
                <a href="/recursos/milagro/imagenes/productos/'.$imagenesPresentacion[$u][1].'" class="lightboxxx">
                    <img src="/recursos/milagro/imagenes/productos/'.$imagenesPresentacion[$u][1].'"
                        class="img-fluid pr-lg-4 mx-auto">
                </a>';
            endfor;?>
                
            </div>
            <!-- ARROWS SLIDER PRIMARY -->
            <!-- <div class="control-slider-products">
                <span id="arrow-left2" class="pl-3">
                    <span class="slick-prev slick-arrow text-right"></span>
                </span>
                <span id="arrow-right2" class="pr-3">
                    <span class="slick-next slick-arrow"></span>
                </span>
            </div> -->
        </div>
        <div class="chocolat-lightboxxx">

        </div>
    </section>

    <?php }?>
    <!-- /GALERIA PRINCIPAL DEL PRODUCTO -->
    <section class="mb-lg-5 mb-0 mb-md-3">
        <div class="container-fluid px-lg-4 px-3">
            <div class="row">
                <div
                    class="col-lg-7 col-12 col-md-7 d-flex flex-column justify-content-center wrapper summary entry-summary mb-lg-0 mb-4">
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
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2">
                                    <?php _e('Pago seguro', 'santa-cole') ?>
                                </a>
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2">
                                    <?php _e('Seguro de envío incluido', 'santa-cole') ?>
                                </a>
                                <a href="#" class="text-underline color-grey-light2 fs-08 d-block mb-2">
                                    <?php _e('Opción de pago a plazos', 'santa-cole') ?>
                                </a>
                            </div>
                            <div class="col-lg-7 pr-0 pl-0 text-lg-right">
                                <span class="color-grey-light2 fs-08">
                                    <?php _e('¿Tienes alguna duda? Echa un vistazo a las', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('condiciones de compra', 'santa-cole') ?></a>
                                    <?php _e('o contacta con', 'santa-cole') ?> <a href="#"
                                        class="text-underline fs-1"><?php _e('nosotros.', 'santa-cole') ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 col-md-5 wrapper-right-fluid pl-lg-3 pl-0">

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

    <!-- Sección de la parrilla de características del instrumento -->

    <?php
    if($productoMusica != null){
        $getCaracteristicas ="SELECT mbc.Nombre".$idioma.", mbc.Descripcion".$idioma.", mbc.id, mbc.Imagen_formato1 
        from milagro_producto as mp 
        inner join milagro_Biblioteca_CaracteristicasProducto as mbcp on mbcp.id_producto=mp.id 
        inner join milagro_Biblioteca_Caracteristicas as mbc on mbc.id=mbcp.id_BibliotecaCaracteristica 
        WHERE mbc.Tipo_CaracteristicaTecnologica IS NULL AND mp.id=".$productoMusica." Order by mbcp.Orden ASC"; 
        $caracteristicas = $bd_pim->consultar($getCaracteristicas);
    }

    //Evaluación del contenido del select. Si no hay contenido no se pinta la sección

    if(isset($caracteristicas)){
    ?>
    <section>
        <div class="wrapper bg-custom-black color-white py-5">
            <div class="container-fluid my-5 pb-lg-5">
                <div class="row d-flex pb-lg-5">

                    <?php 
                    for($u = 0; $u< sizeof($caracteristicas); $u++){

                        $nombreCaracteristicaMilagro = $caracteristicas[$u][0];
                        $textoCaracteristicaMilagro = $caracteristicas[$u][1];
                        
                    ?>
                        <div class="col-12 col-md-4 mb-4 mb-md-0 pb-lg-5 pb-2">
                            <h4 class="mb-3 fw-400"><?php echo $nombreCaracteristicaMilagro?></h4>
                            <hr class="border-light-grey mb-3">
                            <p class="mb-0"><?php echo $textoCaracteristicaMilagro?></p>
                        </div>
                    <?php
                    } 
                    ?>

                    <div class="col-12 col-md-4 mb-4 mb-md-0 pb-lg-5 pb-2">
                        <h4 class="mb-3 fw-400">Dimensiones y peso</h4>
                        <hr class="border-light-grey mb-3">
                        <p class="mb-0">103 x 38 x 11 cm</p>
                        <p class="mb-0">2.200 – 2.375 g, según acabado y opciones.</p>
                    </div>

                    <?php

                    //Select de los iframes de los audios de soundcloud 

                    $s_audiosInstrumento = "SELECT TituloAudio".$idioma.", EnlaceAudio, IdAudio 
                    FROM `milagro_audios` WHERE TituloAudioES like '$stringMusica'";

                    $r_audiosInstrumento = $bd_pim->consultar($s_audiosInstrumento);

                    //console_log($s_audiosInstrumento);
                    //console_log($r_audiosInstrumento);

                    if(isset($r_audiosInstrumento)){

                        echo '<div class="col-12 col-md-4 mb-4 mb-md-0 pb-lg-5 pb-2">

                                <h4 class="mb-3 fw-400 open-sound" id="opensounsd">Escucha como suena <i class="fas fa-play"></i></h4>
                            ';

                        // for($u = 0; $u < sizeof($r_audiosInstrumento); $u++){
                        //     //Imprimimos todos los iframes disponibles del instrumento
                        //     echo $r_audiosInstrumento[$u][1];
                        // }
                    
                    }?>
                    
                </div>
            </div>
        </div>




        <!-- MODAL SOUND -->
        <div class="modalnav" id="soundsistemModal" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between px-0">
                        <span class="d-block titleforget"><?php esc_html_e( 'Escucha como suena', 'woocommerce' ); ?></span>

                        <div id="close-navModalsound">
                            <span class="fal fa-times color-custom-black fa-lg"></span>
                        </div>
                    </div>
                    <div class="col-12 px-0 py-4">

                        <?php 
                             for($u = 0; $u < sizeof($r_audiosInstrumento); $u++){
                                //Imprimimos todos los iframes disponibles del instrumento
                                echo $r_audiosInstrumento[$u][1];
                            }
                        ?>     
                    
                    </div> 
                   
                </div>
            </div>
        </div>






    </section>
    <?php }?>

    
    <!-- Sección texto -->

    <?php

    if($productoMusica != null){

        $getInfoPresentacion = "SELECT mp.id, mp.NombreProducto".$idioma.", mp.TipoProducto".$idioma.", mp.Descripcion2".$idioma.", mp.Miniatura
        FROM `milagro_producto` as mp 
        WHERE mp.id = ".$productoMusica."";

        $infoPresentacion = $bd_pim->consultar($getInfoPresentacion );

    }

    //Evaluación del contenido del select. Si no hay contenido no se pinta la sección

    if(isset($caracteristicas)){
    ?>
    
    <seccion>
        <div class="wrapper masterpadding">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12 px-lg-0">
                        <h3><?php echo $infoPresentacion[0][1]; ?></h3>
                        <hr class="border-light-grey">
                    </div>
                </div>
                <div class="row pt-md-5 justify-content-between">
                    <div class="col-12 col-md-6 mb-4 mb-md-0 px-lg-0">
                        
                        <p class="f-italic"><?php echo $infoPresentacion[0][2]; ?></p>
                        <p><?php echo $infoPresentacion[0][3]; ?></p>
                    </div>
                    <div class="col-12 px-lg-0 col-md-5 text-right">
                        <img src="/recursos/milagro/imagenes/productos/'<?php echo $infoPresentacion[0][4];?>'"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </seccion>

    <?php }?>

    <!-- Sección slider características de tecnología Milagro <----------- -->

    <?php

    if($productoMusica != null){
        $getTecnologiaMilagro = "SELECT mbc.id, mbc.Nombre".$idioma.", mbc.Destacado".$idioma.", mbc.Descripcion".$idioma.", mbc.Imagen_formato1 
        from milagro_producto as mp 
        inner join milagro_Biblioteca_CaracteristicaEstaticaProducto as mbcp on mbcp.id_producto=mp.id 
        inner join milagro_Biblioteca_Caracteristicas as mbc on mbc.id=id_BibliotecaCaracteristicaEstaticaProducto 
        WHERE mbc.Tipo_CaracteristicaTecnologica = 1 
        AND mp.id=".$productoMusica." Order by mbcp.Orden ASC";

        $tecnologiaMilagro = $bd_pim->consultar($getTecnologiaMilagro);
    }

        //Evaluación del contenido del select. Si no hay contenido no se pinta la sección

        if(isset($tecnologiaMilagro)){
    ?>

        <section>
            <div class="wrapper ">
                <div class="container-fluid">
                    <div class="row pt-4">
                        <div class="col-lg-6 col-md-6 d-flex flex-column justify-content-start">
                            <h3 class="mb-4">Tecnología Milagro</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex flex-column justify-content-start">
                            <a href="#" class="text-sm-left text-md-right text-lg-right text-underline">CTA de la
                                sección</a>
                        </div>
                    </div>
                </div>
            </div>
            <div <?php if(wp_is_mobile()){echo 'class="wrapper"';}else{
                if(sizeof($tecnologiaMilagro) >= 3){
                echo 'class="wrapper-left"';
                }else {echo 'class="wrapper"';}
                } ?>
            >
                <div class="container-fluid py-5 <?php if(!wp_is_mobile()){echo 'pr-0';} ?>">

                
                    <!-- Condicionales de clases para rectificar los márgenes dependiendo ddel número de items de slick -->
                    <div class=<?php if(sizeof($tecnologiaMilagro) >= 3){echo '"carrusel-texto-milagro addposition"';}else {echo '"carrusel-texto-milagro menor"';}?>>
                        <?php for($u = 0; $u < sizeof($tecnologiaMilagro); $u++):
                            echo '
                            <div class="item-container pr-4">
                                <img src="/recursos/milagro/imagenes/productos/'.$tecnologiaMilagro[$u][4].'">
                                <div class="py-3">
                                    <div class="pl-0">
                                        <p class="fs-08 color-grey-light3 mb-1">'.$tecnologiaMilagro[$u][2].'</p>
                                        <p class="fs-1 mb-1 pt-lg-4">'.$tecnologiaMilagro[$u][1].'</p>
                                        <p>'.$tecnologiaMilagro[$u][3].'</p>
                                    </div>
                                </div>
                            </div>';
                        endfor;?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>


    <!-- Sección carrusel de productos relacionados -->

    <?php

    // echo $productoMusica;

    if($productoMusica != null){

        //Sacamos los ids de complementos relacionados al producto

        $s_complementos_id = "SELECT mcr.id_complementos_relacionados 
        FROM milagro_producto as p 
        inner join milagro_complementos_relacionados as mcr on mcr.id_producto=p.id 
        where p.id=".$productoMusica."";
        $r_complementos_id = $bd_pim->consultar($s_complementos_id);
    }
                    
    // console_log("r_complementos_id");
    // console_log($r_complementos_id);


    if (!wp_is_mobile()) { 
 
    //Evaluación del contenido del select. Si no hay contenido no se pinta la sección
        
    if(!empty($r_complementos_id) ) { ?>

    <section class="pb-lg-0 pb-4 d-none d-lg-block">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row pt-lg-4">
                    <div class="col-lg-6 col-md-6 d-flex flex-column justify-content-start">
                        <?php
                            $heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'Accesorios relacionados', 'woocommerce' ) );

                            if ( $heading ) :
                        ?>

                        <h2 class="d-block fw-400 fs-13 mb-lg-4 mb-3"><?php echo esc_html( $heading ); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-left">
            <div class="container-fluid pb-lg-4">
                <div class="row">
                    <div class="col-12">
                        <div class="carrusel-destacado relacionados">

                            
                            <?php  

                            //Recorremos los ids de complementos para sacar los $skus. Un id de complemento puede tener más de un sku, ya que el complemento puede tener uno o más modelos, por eso se reccorre en un bucle.

                            for($u = 0; $u < sizeof($r_complementos_id); $u++):

                                $s_complementos_sku = "SELECT DISTINCT mbdc.Codigo
                                FROM milagro_producto as mp 
                                inner join `milagro_Biblioteca_DetalleCaracteristicasComplemento` as mbdcc on mbdcc.id_producto=mp.id 
                                inner join milagro_Biblioteca_DetalleCaracteristicas as mbdc on mbdc.id=mbdcc.id_BibliotecaDetalleCaracteristicaComplemento 
                                where mp.IsComplemento=1 
                                and mp.id=".$r_complementos_id[$u][0]."";

                                $r_complementos_sku = $bd_pim->consultar($s_complementos_sku);
                            ?>
                            
                            
                            <?php 
                                // console_log('$r_complementos_sku');
                                // console_log($r_complementos_sku);
                            
                                for($i = 0; $i < sizeof($r_complementos_sku); $i++): 

                                    $sku = $r_complementos_sku[$i][0];

                                    $id = IDProduct_By_Sku_Mich($sku,$language_actual);
                        
                                    $link = get_permalink( $id );

                                    $titulo = get_the_title( $id );
                                    
                                    $imagen_producto_relacionado = get_the_post_thumbnail( $id, 'full' );
                                                                   
                                    $product = wc_get_product( $id );
                                   
                                ?>
                                
                                    <div class="product-card col-lg-4 col-12 px-0 pb-4">
                                        <a class="" href="<?php echo $link ?>">
                                            <div class="product-img">
                                                <?php echo $imagen_producto_relacionado; ?>
                                                    
                                            </div>
                                        </a>
                                        
                                        <div class="product-text d-flex flex-column justify-content-start align-items-end pt-4 pb-0">
                                            <div class="product-first-group d-flex justify-content-between w-100">
                                                <h2 class="fs-1"><?php echo $titulo ?></h2>
                                                <p class="fs-1 fw-500"><?php echo  $product->get_price_html(); ?></p>
                                                

                                            </div>
                                            <div class="container-fluid product-second-group w-100 mb-lg-2 px-lg-0">
                                                <div class="row">
                                                    <div class="col-lg-12 d-lg-flex px-lg-0">
                                                        <!-- <div class="col-lg-6 ">
                                                            <span class="color-custom-black fs-lg-09">
                                                            54545
                                                            </span> -
                                                            <span class="color-custom-black fs-lg-09">
                                                                
                                                                <span>autor</span>
                                                            </span>
                                                        </div> -->
                                                        <div class="col-12">
                                                            <p class="color-light-grey2 fs-lg-08 text-right">
                                                            <?php echo Polwoo_get_product_child_cat($id); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                

                            <?php 
                                endfor;
                            endfor;
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php } ?>





</div>






<?php do_action( 'woocommerce_after_single_product' ); ?>