<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package santa_cole
 */

get_header();
?>

<section id="search-main" class="wrapper my-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-md-3">
				<div class="mt-2">
					<?php //echo custom_product_search_form(); ?>
				</div>
				<div class="mt-4">
					<?php //echo woo_category_sidebar(); ?>
				</div>
				<div class="d-none d-md-block">
					<?php //woocommerce_get_sidebar(); ?>
				</div>
			</div> -->
            <div class="col-12 px-0">
                <?php if ( have_posts() ) : ?>
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-12 pb-lg-5 pb-4">
                            <div class="breadcrumb color-grey-light2 p-0 bg-transparent mb-0">
                                <?php
								if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
								}
								?>
                            </div>
                        </div>

                        <div class="col-12 pt-2 d-flex flex-column justify-content-start mb-lg-5 mb-4 ">
                            <header class="page-header border-bottom border-color-grey pb-lg-5 pb-3">
                                <span class="fs-15 color-custom-black">
                                    <?php
										/* translators: %s: search query. */
										printf( esc_html__( 'Tu búsqueda: %s', 'santa-cole' ), '<span class="fs-1">&quot;' . get_search_query() . '&quot;</span>' );
										?>
                                </span>
                            </header><!-- .page-header -->

                        </div>
                        <?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', 'search' );
							endwhile;
							//the_posts_navigation();
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
                    </div>
                </div>

            </div>
            <div class="col-12 d-md-none">
                <?php //woocommerce_get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();