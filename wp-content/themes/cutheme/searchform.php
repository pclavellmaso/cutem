<?php
/**
 * Custom search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package santa_cole
 */
?>

<form role="search" class="mt-0 search-form d-flex" action="<?php echo home_url('/') ?>" method="get">
    <input type="search" name="s" id="search" value="<?php the_search_query(); ?>" class="input-activo" placeholder="<?php _e('Buscar...', 'santa-cole') ?>"/>
    <!-- <input type="hidden" name="name" value="" /> -->
</form>
