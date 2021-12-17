<?php
/**
 * Embed Youtube Videos
 *
 * @package Santacole
 */

/* ------------- Embed Youtube Video */
function get_iframe_url($embed_video_link) {
		$url = get_field($embed_video_link);
    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_url = $my_array_of_vars['v'];
		echo '<iframe width="100%" class="" src="https://www.youtube.com/embed/' . $video_url . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>';
		echo '</iframe>';
}


/* ------------- Embed Youtube Video */
function get_iframe_url_sub($embed_video_link) {
	$url = get_sub_field($embed_video_link);
parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	$video_url = $my_array_of_vars['v'];
	echo '<iframe width="100%" class="iframe-video" src="https://www.youtube.com/embed/' . $video_url . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen>';
	echo '</iframe>';
}


/* ------------- Embed Vimeo Video */
function get_iframe_url_vimeo($embed_video_link) {
	$url = get_field($embed_video_link);
	$my_array_of_vars = parse_url( $url);
	/* var_dump($my_array_of_vars); */
	
	echo '<iframe width="100%" class="iframe-video" src="https://player.vimeo.com/video' . $my_array_of_vars['path'] . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>';
	echo '</iframe>';
}

/* ------------- Embed Vimeo Video */
function get_iframe_url_vimeo_sub($embed_video_link) {
	$url = get_sub_field($embed_video_link);
	$my_array_of_vars = parse_url( $url);
	/* var_dump($my_array_of_vars); */
	
	echo '<iframe width="100%" class="iframe-video" src="https://player.vimeo.com/video' . $my_array_of_vars['path'] . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>';
	echo '</iframe>';
}

/* ------------- Embed Youtube Video Only video*/
function get_iframe_url_code($embed_video_link) {
	$url = get_field($embed_video_link);
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	$video_url = $my_array_of_vars['v'];
	$url_sinespacio = str_replace(' ', '', $video_url);
    return $url_sinespacio;
};


/* ------------- Embed Youtube Video Slider*/
function get_iframe_url_sub_code($embed_video_link) {
	$url = get_sub_field($embed_video_link);
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	$video_url = $my_array_of_vars['v'];
	$url_sinespacio = str_replace(' ', '', $video_url);
    return $url_sinespacio;
}
