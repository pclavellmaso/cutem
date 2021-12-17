<?php

/******************************************************************************
 *** Google Maps API
 ******************************************************************************/


function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyD4zQhioqBnqpXSts9r_9644cgPzDwrzw4');
}

add_action('acf/init', 'my_acf_init');

const GOOGLE_MAPS_EMBED_API_KEY = 'AIzaSyD4zQhioqBnqpXSts9r_9644cgPzDwrzw4';

function acf_make_map($acf_map_field) {
	$address_field = $acf_map_field['address'];
	$lat_field = $acf_map_field['lat'];
	$long_field = $acf_map_field['lng'];
	$encoded_address = urlencode($address_field);
	echo ' <iframe 	width="100%"	height="400" frameborder="0" style="border:0"	src ="https://www.google.com/maps/embed/v1/view?key=' . GOOGLE_MAPS_EMBED_API_KEY . '&center=' . $lat_field . ',' . $long_field . '&zoom=20' . '"	allowfullscreen >
		</iframe>';
}



function acf_make_map_marker($acf_map_field) {
	$address_field = $acf_map_field['address'];
	$lat_field = $acf_map_field['lat'];
	$long_field = $acf_map_field['lng'];
	$encoded_address = urlencode($address_field);
	echo ' <iframe 	width="100%"	height="400" frameborder="0" style="border:0"	src ="https://www.google.com/maps/embed/v1/place?q=' . $lat_field . ',' . $long_field . '&key=' . GOOGLE_MAPS_EMBED_API_KEY . '&center=' . $lat_field . ',' . $long_field . '&zoom=18' . '"	allowfullscreen >
		</iframe>';
}

?>