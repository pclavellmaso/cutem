<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Ajustes Generales Del Tema',
		'menu_title'	=> 'Ajustes del tema',
		'menu_slug' 	=> 'ajustes-tema',
		'capability'	=> 'edit_posts',
        'update_button' => __('Actualizar', 'acf'),
        'updated_message' => __('Edite opciones predeterminadas del tema', 'acf'),
        'position' => '63',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Configuración del Header',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'ajustes-tema',
        'update_button' => __('Actualizar', 'acf'),
        'updated_message' => __('Edite opciones predeterminadas del tema', 'acf'),
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Configuración del Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'ajustes-tema',
        'update_button' => __('Actualizar', 'acf'),
        'updated_message' => __('Edite opciones predeterminadas del tema', 'acf'),
	));
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Páginas 404',
		'menu_title'	=> '404',
		'parent_slug'	=> 'ajustes-tema',
        'update_button' => __('Actualizar', 'acf'),
        'updated_message' => __('Edite opciones predeterminadas del tema', 'acf'),
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Información producto',
		'menu_title'	=> 'Producto',
		'parent_slug'	=> 'ajustes-tema',
        'update_button' => __('Actualizar', 'acf'),
        'updated_message' => __('Edite opciones predeterminadas del tema', 'acf'),
	));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Página de entradas',
		'menu_title'	=> 'Noticias',
		'parent_slug'	=> 'ajustes-tema',
        'update_button' => __('Actualizar', 'acf'),
        'updated_message' => __('Edite opciones predeterminadas del tema', 'acf'),
	));
	
}

?>