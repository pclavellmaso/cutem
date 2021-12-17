<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package santa_cole
 */
get_header();
?>

<section>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row py-5 justify-content-center">
                <div class="col-12 pb-lg-3 pb-2 d-flex justify-content-center">
                    <p class="text-center fs-13"><?php the_field('texto_error_largo', 'option'); ?></p>
                </div>
                <div class="col-12 col-lg-6 pb-lg-3 pb-2">
                    <?php echo get_search_form(); ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 pb-lg-5 pb-4 text-center">
                    <!-- <?php //$src = get_field('imagen', 'option'); ?>
                        <img class="w-100" src="<?php //echo $src; ?>" alt="404_img"> -->
                        <span class="fs-1-5 fs-xl-500 icon-noencontramos text-center"></span>
                </div>
                <div class="col-12 pb-lg-5 pb-4 d-flex justify-content-center">
                    <p class="text-center fs-13"><?php the_field('texto_error_corto', 'option'); ?></p>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
get_footer();