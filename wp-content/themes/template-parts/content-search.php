<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package santa_cole
 */

// Idioma actual
$lang = apply_filters( 'wpml_current_language', NULL );

?>


<div class="col-lg-3 col-md-4 col-12 mb-lg-4 mb-3">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>">
            <?php
                if ( has_post_thumbnail() ) {
                    
                    if($post->post_type == 'product') {
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
                    }
                    elseif($post->post_type == 'product_variation') {
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
                        the_post_thumbnail('full');
                    }
                } else { 
                    $content = get_field('imagen_destacada', false, false);
                    echo apply_filters('acf_the_content', $content);
                    
                }
                ?>
        </a>
        <header class="entry-header">
            <?php if ( 'post' === get_post_type() )  : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo get_the_term_list( $post->ID, 'category', '', ', ' );?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>

            <?php elseif ('proyecto' === get_post_type() ) : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo get_the_term_list( $post->ID, 'categoria-pro', '', ', ' );?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php elseif('autor' === get_post_type() ) : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo get_the_term_list( $post->ID, 'tipos-autores', '', ', ' );?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php elseif('historia' === get_post_type() ) : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo get_the_term_list( $post->ID, 'categoria-historia', '', ', ' );?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php elseif('evento' === get_post_type() ) : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo get_the_term_list( $post->ID, 'categoria-evento', '', ', ' );?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php elseif('notas' === get_post_type() ) : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo get_the_term_list( $post->ID, 'categoria-notas', '', ', ' );?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Leer más', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php elseif('product' === get_post_type() ) : ?>
            <?php
                    $id = get_the_ID();
                    $product = wc_get_product($id);
                ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span
                            class="fs-07 color-grey-light2"><?php echo Polwoo_get_product_child_cat_a(get_the_ID());?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <span class="parrilla-price fw-400 text-right">
                            <?php
                                    if (comprar()) {
                                        if ( $product->is_type( 'variable' ) ) {

                                            
                                                $price = precio_mas_iva($id);
                                            
                                            
                                            if ($price == '0,00') :
                                                echo '';
                                            else : 
                                                _e('Desde ', 'santa-cole'); echo $price . ' €';
                                            endif;
                                        } else {
                                        
                                            /* if ($lang == 'es') {
                                                $price = $product->get_price_including_tax();
                                            }
                                            if ($price == '0,00') :
                                                echo '';
                                            else : 
                                                echo $price . ' €';
                                            endif; */
                                            woocommerce_template_loop_price();
                                        }
                                    }
                                ?>
                        </span>
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Comprar', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php elseif('product_variation' === get_post_type() ) : ?>
            <div class="container-fluid">
                <div class="py-3 row">
                    <div class="col-8 col-lg-8 d-flex flex-column pl-0">
                        <h3 class="d-block fs-1 mb-1 fw-400"><?php the_title(); ?></h3>
                        <span class="fs-07 color-grey-light2"><?php echo Polwoo_get_product_child_cat_a(get_the_ID());?></span>
                    </div>
                    <div class="col-4 col-lg-4 d-flex flex-column px-0">
                        <span
                            class="fs-1 parrilla-price fw-400 text-right"><?php woocommerce_template_loop_price(); ?></span>
                        <a class="text-right text-underline"
                            href="<?php the_permalink(); ?>"><?php _e('Comprar', 'santa-cole'); ?></a>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </header><!-- .entry-header -->



    </article><!-- #post-<?php the_ID(); ?> -->
</div>