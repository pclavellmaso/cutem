<?php
/** @version 4.6.0 */
/* Template Name: Tienda */

defined('ABSPATH') || exit;

get_header('top-bar-classy');
$page_id = wc_get_page_id('shop');
?>
<div class="border-grey-categories mb-5 w-100 d-block"></div>
<section class="wrapper my-5 d-none">
    <h1 class="inner-header">
        <?php echo 'This is the shop with ID: ' . $page_id ?>
    </h1>
</section>
<section id="shop-grid" class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            <?php echo woo_category_sidebar(); ?>
            <?php woocommerce_get_sidebar(); ?>
            </div>
            <div class="col-md-9 text-center px-0">
              
                <?php
                if(woocommerce_product_loop()):
                  woocommerce_product_loop_start();
                  if(wc_get_loop_prop('total')):
                    while(have_posts()):the_post();
                      wc_get_template_part('content','product');
                    endwhile;
                  endif;
                  woocommerce_product_loop_end();
                ?>
                <div class="pagination my-5">
                    <?php echo paginate_links(['prev_text'=>'<','next_text'=>'>']); ?>
                </div>
                <?php
                else:
                  wc_no_products_found();
                endif;
                ?>
            </div>
        </div>
    </div>

</section>

<div class="border-green-page my-2"></div> 
<?php get_footer(); ?>