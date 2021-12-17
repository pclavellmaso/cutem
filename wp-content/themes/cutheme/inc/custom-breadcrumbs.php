<?php
/**
 * Custom breadcrumbs
 *
 * @package santa-cole
 */

 /* ------------- Blog Breadcrumbs */
 function blog_breadcrumbs() {

   echo '<a href="'. home_url() .'">Home</a>';
   ?>
   <span class="fal fa-chevron-right px-1"></span>
   <?php
   echo '<a href="'. home_url("/blog/") .'">Blog</a>';
    if (is_category() || is_single()) {
        ?>
        <span class="fal fa-chevron-right px-1"></span>
        <?php
            if (is_single()) {
              the_category(' &bull; ');
              ?>
              <span class="fal fa-chevron-right px-1"></span>
              <span><?php
                the_title(); ?></span>
            <?php }
            else {
              single_cat_title();
            }
    } elseif (is_page()) {
        ?>
        <span class="fal fa-chevron-right px-1"></span>
        <?php
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
 }

 /* ------------- CPT Breadcrumbs */
 function cpt_breadcrumbs($cpt_name) {
   ?>
   <a class="color-grey-light2"
   href="<?php echo site_url() . '/' . $cpt_name; ?>">
     <?php echo $cpt_name?>
   </a>
   <span class="fal fa-chevron-left px-1"></span>
   <span>
     <?php the_title(); ?>
   </span>
<?php }

function pol_cpt_breadcrumbs($cpt_name) {
    ?>
    <a class="color-grey-light2"
    href="<?php echo site_url() . '/' . $cpt_name; ?>">
      <?php echo ucfirst($cpt_name); ?>
    </a>
    <span class="breadcrumb-chevron fal fa-chevron-right px-1"></span>
    <span class="">
      <?php the_title(); ?>
    </span>
 <?php }
 /* ------------- Custom Breadcrumbs */

