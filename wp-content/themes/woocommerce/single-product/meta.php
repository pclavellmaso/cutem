<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

<div class="product_meta mb-lg-5 mb-3 d-lg-block d-none">
  <section>
    <?php do_action( 'woocommerce_product_meta_start' ); ?>
    <?php 
    if ( is_user_logged_in() ) {

    $user = wp_get_current_user();
    $user_id = $user->ID;
    $user_info = get_userdata($user_id);

    if ( in_array( 'administrator', $user_info->roles)  || in_array( 'shop-manager', $user_info->roles ) ) : ?>
    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

    <span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span
        class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

    <?php endif; ?>

    <?php endif;
    } ?>

    <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( '', '', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

    <?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in category-product-ficha">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>


    <?php if( has_term( 'neoserie', 'product_cat' ) || has_term( 'neoseries', 'product_cat' ) ) : ?>
    <div class="d-flex justify-content-between">
      <div>
      <?php
        $autores = get_field('autor' );
        if( $autores ): 

        foreach( $autores as $getvart ): 
        $otravar = get_the_title($getvart);
        // Setup this post for WP functions (variable must be named $post).
      ?>
      <a class="fs-1 d-flex" href="<?php the_permalink(); ?>">
        <?php echo $otravar; ?>
      </a>
      <?php 
        endforeach;  
        endif; 
        ?>
    </div>
    <div class="text-lg-right">
      <div><?php echo Polwoo_get_product_child_cat($product->get_id()); ?></div>
      <?php 
        if (get_field('version_del_producto', $product->get_id())) { 
        $sku = get_field('version_del_producto', $product->get_id());
        $language_actualll = apply_filters( 'wpml_current_language', NULL ); 
        $id = IDProduct_By_Sku_Mich( $sku,$language_actualll );
        if ($id != 000) :
        $link = get_permalink( $id );
      ?>
      <p class="color-grey-light2 "><?php _e('Reproducción de este', 'santa-cole') ?> <a href="<?php echo $link;?>"
          class="text-underline"><?php _e('Original', 'santa-cole') ?></a></p>
      
      <?php endif; ?>
      <?php } ?>
    </div>
        </div>
    <?php elseif ( has_term( 'originales', 'product_cat' ) || has_term( 'originals', 'product_cat' )) : ?>
    <div class="d-flex justify-content-between text-right">
      <div class="d-block">
          <?php
          $autores = get_field('autor' );
          if( $autores ): 

          foreach( $autores as $getvart ): 
          $otravar = get_the_title($getvart);
          // Setup this post for WP functions (variable must be named $post).
        ?>
          <a class="fs-1 d-flex" href="<?php the_permalink(); ?>">
            <?php echo $otravar; ?>
          </a>
          <?php 
          endforeach;  
          endif; 
        ?>
      </div>
      <?php 
	    if (get_field('version_del_producto', $product->get_id())) {
			$sku = get_field('version_del_producto', $product->get_id());
      $language_actualll = apply_filters( 'wpml_current_language', NULL ); 
      $id = IDProduct_By_Sku_Mich( $sku,$language_actualll );
      if ($id != 000) :
      $link = get_permalink( $id );
		?>
      <div class="d-block">
        <span
          class="d-block pointer open-modal-originales"><?php _e('¿Qué supone adquirir el original de una Neoserie?', 'santa-cole') ?></span>
        <p class="color-grey-light2 ">
          <?php _e('De esta obra deriva una', 'santa-cole') ?> <a href="<?php echo $link;?>"
            class="text-underline"><?php _e('Neoserie', 'santa-cole') ?></a>
        </p>
      </div>
      <?php endif; ?>
      <?php } ?>
    </div>
    <?php else : 
      echo Polwoo_get_product_child_cat($product->get_id()); 
    endif;
    ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>
  </section>
</div>