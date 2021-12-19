<?php

/**
* Template Name: Home
*/
//wp_head();
get_header();
?>

<!-- Sección principal -->
<section>
    <div class="wrapper px-0">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-12 px-0">

                    <?php if (have_rows('slider_principal')) { ?>
                        <div class="slider-principal-home vh-100">
                            <?php while (have_rows('slider_principal')) { the_row(); ?>
                                <?php img_with_alt_sub('imagen_slider'); ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php
get_footer();