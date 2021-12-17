<?php 

function get_event_info_ajax_handler() {
 
	// prepare our arguments for the query
	$args = json_decode(stripslashes($_POST['query']), true);

	// it is always better to use WP_Query but not here
	query_posts( $args );
    
    $event_info = array();

	if( have_posts() ) : the_post();
 
        $title = get_the_title();
        $date = get_field('descripcion');
        $localizacion = get_field('localizacion');
        $inicio = get_field('inicio');
        $fin = get_field('fin');

        echo $title . '|' . $date . '|' . $localizacion . '|' . $inicio . '|' .$fin;        
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_getEventInfo', 'get_event_info_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_getEventInfo', 'get_event_info_ajax_handler'); // wp_ajax_nopriv_{action}