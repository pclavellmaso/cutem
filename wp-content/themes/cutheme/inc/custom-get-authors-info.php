<?php 

function get_authors_ajax_handler() {
 
    $filter_text = $_POST['filter_text'];

	$args = array(
        'post_type' => 'autor',
        'posts_per_page' => -1,
        
    );

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) : the_post();
 
        $author_name = get_the_title();

        echo $author_name;        
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_getAuthors', 'get_authors_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_getAuthors', 'get_authors_ajax_handler'); // wp_ajax_nopriv_{action}