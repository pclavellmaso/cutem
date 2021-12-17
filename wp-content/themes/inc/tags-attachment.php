<?php
/**
 * Handle Dynamic Fields for Location
 *
 * @package Aincasa
 */
/* Crear Carpetas en Medios */
function jml_folder_taxonomies() {
  $labels = array(
  'name' => _x( 'Carpeta', 'taxonomy general name' ),
  'singular_name' => _x( 'Carpetas', 'taxonomy singular name' ),
  'search_items' => __( 'Buscar carpetas' ),
  'all_items' => __( 'Todas las carpetas' ),
  'parent_item' => __( 'Carpeta superior' ),
  'parent_item_colon' => __( 'Carpeta superior:' ),
  'edit_item' => __( 'Editar' ),
  'update_item' => __( 'Actualizar' ),
  'not_found' => __( 'No se encontraron carpetas' ),
  'no_terms' => __( 'No hay carpetas' ),
  'add_new_item' => __( 'Añadir nueva' ),
  'new_item_name' => __( 'Nuevo nombre' ),
  'menu_name' => __( 'Carpetas' ),
  );
  $args = array(
  'hierarchical' => true,
  'labels' => $labels,
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => 'folder' ),
  );
  register_taxonomy( 'folder', array( 'attachment' ), $args );
}
add_action( 'init', 'jml_folder_taxonomies', 0 );

function jml_tags_taxonomies() {
  $labels = array(
  'name' => _x( 'Etiqueta', 'taxonomy general name' ),
  'singular_name' => _x( 'Etiquetas', 'taxonomy singular name' ),
  'search_items' => __( 'Buscar etiquetas' ),
  'all_items' => __( 'Todas las etiquetas' ),
  'edit_item' => __( 'Editar' ),
  'update_item' => __( 'Actualizar' ),
  'add_new_item' => __( 'Añadir nueva' ),
  'new_item_name' => __( 'Nuevo nombre' ),
  'menu_name' => __( 'Etiquetas' ),
  );
  $args = array(
  'hierarchical' => false,
  'labels' => $labels,
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => 'my-tags' ),
  );
  register_taxonomy( 'my-tags', array( 'attachment' ), $args );
}
add_action( 'init', 'jml_tags_taxonomies', 0 );

/* Sortable Folders in columns */
function jml_sortable_folders_column( $columns ) {
  $columns['taxonomy-folder'] = 'Folder';
  return $columns;
  }
  add_filter( 'manage_upload_sortable_columns', 'jml_sortable_folders_column' );
  /* Sortable Tags in columns */
  function jml_sortable_tags_column( $columns ) {
  $columns['taxonomy-my-tags'] = 'Etiquetas';
  return $columns;
}
add_filter( 'manage_upload_sortable_columns', 'jml_sortable_tags_column' );

?>