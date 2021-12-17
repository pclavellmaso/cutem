<?php

function search_posts() {
    
    $s = $_POST['s'];

    $args = array(
        'post_type' => array('post', 'proyecto', 'autor', 'espacio', 'historia', 'evento', 'product', 'product_variation', 'notas'),
        's' => $s,
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby'     => 'title', 
        'order'       => 'ASC'        
    );
    
    $wp_query = new WP_Query($args);
    console_log('epep');
    console_log($wp_query->found_posts);
    if ($wp_query->found_posts > 0) {

        $post_types = array();

        $posts = $wp_query->posts;
        console_log($posts);
    
        // Guardar todos los tipos de post que se han encontrado
        foreach ($posts as $post) {
            $post_type = get_post_type($post->ID);
            if (!in_array($post_type, $post_types)) {
                array_push_assoc($post_types, $post_type, 0);
            }
        }
        
        
        // Incrementar el contador de cada tipo de post segun los resultados
        foreach ($posts as $post) {
            $post_type = get_post_type($post->ID);
            foreach($post_types as $key => $value) {
                if ($post_type == $key) {
                    $post_types[$post_type]++;
                }
            }
        }

        // Printeamos el resumen
        $counter = 0;
        foreach ($post_types as $key => $value) { console_log($value); console_log($key); ?>

            <li class="nav-item max-content pr-4 list-style-none" role="presentation">
                <a class="nav-link text-left px-0 pt-0 pb-2" id="<?php echo $key; ?>-tab" href="https://www.santacole.com/?s=<?php echo $s; ?>#<?php echo $key; ?>-tab" >
                    <?php $resultado_string = ($value == 1) ? 'resultado' : 'resultados';  printf(__('%d %s en %s', 'santa-cole'), $value, $resultado_string, ucfirst($key)); ?>
                </a>
            </li>

        <?php $counter++; }

    }

	die;
}

add_action('wp_ajax_search_posts', 'search_posts'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_search_posts', 'search_posts'); // wp_ajax_nopriv_{action}