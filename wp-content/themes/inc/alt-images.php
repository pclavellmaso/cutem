<?php
/**
 * Add ALT to images
 *
 * @package santa_cole
 */

/* ------------- Get ALT information from Wordpress */

function img_with_alt($custom_field) {

	global $post;
	$image_id = get_field($custom_field);
	$image_src = wp_get_attachment_image_src($image_id, 'full');
	$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

	echo '<img class="img-fluid" src="' . $image_src[0] . '"
	alt="'. $image_alt . '">';
}
function img_with_alt_sub($custom_field) {

	global $post;
	$image_id = get_sub_field($custom_field);
	$image_src = wp_get_attachment_image_src($image_id, 'full');
	$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

	echo '<img class="img-fluid" src="' . $image_src[0] . '"
	alt="'. $image_alt . '">';
}
function img_with_alt_featured() {

	global $post;
	$image_id = get_post_thumbnail_id( $post->ID );
	$image_src = wp_get_attachment_image_src($image_id, 'full');
	$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

	echo '<img class="img-fluid" src="' . $image_src[0] . '"
	alt="'. $image_alt . '">';
}


/* AÑADIR LAZY LOAD A LAS IMAGENES DESTACADAS */

add_filter( 'post_thumbnail_html', 'wpdd_modify_post_thumbnail_html', 10, 5 );
/**
 * Add `loading="lazy"` attribute to images output by the_post_thumbnail().
 *
 * @param  string $html	The post thumbnail HTML.
 * @param  int $post_id	The post ID.
 * @param  string $post_thumbnail_id	The post thumbnail ID.
 * @param  string|array $size	The post thumbnail size. Image size or array of width and height values (in that order). Default 'post-thumbnail'.
 * @param  string $attr	Query string of attributes.
 * 
 * @return string	The modified post thumbnail HTML.
 */
function wpdd_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {

	return str_replace( '<img', '<img loading="lazy"', $html );

}