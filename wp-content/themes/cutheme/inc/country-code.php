<?php




////////////////////////////////// FUNCION CODIGO ISO PAIS - DEVUELVE CODIGO ISO DEL PAIS QUE ACCEDE AL SITIO ///////////////////////////

function get_user_geo_country(){
    $geo      = new WC_Geolocation(); // Get WC_Geolocation instance object
    $user_ip  = $geo->get_ip_address(); // Get user IP
    $user_geo = $geo->geolocate_ip( $user_ip ); // Get geolocated user data.
    $country  = $user_geo['country']; // Get the country code
	//$country  = 'US';
    return $country; // return the country name

}

/////////////////////////////////////////////////////// PAISES DE LA UE /////////////////////////////////////////////////////////////////


function paises_ue(){
	require get_template_directory() . '/config.php';		
	//OBTENER PAISES DE LA UNION EUROPEA - SQL BBDD
	$sql_pais_ue 	 = 'SELECT p.nombre, p.codigo_iso, p.continente FROM pais as p WHERE union_europea = 1';
	$paises_ue	 	 = $bd_pim->consultar($sql_pais_ue);
	
	return $paises_ue;
}

////////////////////////////////// FUNCION COMPRAR - MOSTRAR PRECIOS SEGUN LA GEOLOCALIZACIÓN ///////////////////////////////////////////

function comprar(){
	//OBTENER PAISES DE LA UNION EUROPEA -> FUNCION
	$paises_ue 		 = paises_ue();
	
	//CREAMOS VARIABLE CON EL CODIGO ISO PAIS DEL USUARIO -> FUNCION
	$geolocation_iso = get_user_geo_country();
	
	//VERIFICAR GEOLOCALIZACIÓN -> SI ES PAIS MIEMBRO DE LA UE DEVUELVE TRUE
	foreach( $paises_ue as $value ){
		if( $geolocation_iso == $value['codigo_iso'] ){
			return true;
		}
	}
	return false;
}

function precio_mas_iva( $post_id ){
	require get_template_directory() . '/config.php';	
    $codigo_iso = get_user_geo_country();
    $precio     = '';
    $idiomaPagina = apply_filters( 'wpml_current_language', NULL );
    if( ! empty( $post_id ) ){
        //OBTENER PRECIO SEGUN POST ID
        $sql_precio = "SELECT meta_value FROM `sc_wp_postmeta` WHERE `meta_key` = '_price' AND `post_id` = $post_id";
        $precio_wc  = $bd_wp->consultar( $sql_precio );
        if( ! empty( $precio_wc ) || isset( $precio_wc ) ){
            //OBTENER IVA SEGUN PAIS
            $sql_tax    = "SELECT tax_rate FROM `sc_wp_woocommerce_tax_rates` WHERE tax_rate_country = '$codigo_iso'";
            $tax        = $bd_wp->consultar( $sql_tax );
            if( !empty( $tax ) || isset( $tax ) ){
                $valor_tax  = ( $tax[0][0] / 100 ) + 1;
                //PRECIO + IVA
                $precio_base = $precio_wc[0][0];
                $precio_mas_iva = $precio_base * $valor_tax;
                //REDONDEO  
                //$precio = round( $precio_mas_iva );
                $precio  =  $precio_mas_iva;
               console_log($precio);
                if($idiomaPagina == 'es'){
                   
                    $precio = money_format('%.2n', $precio);
                    $precio     = str_replace('.',',', $precio);
                    
                }else if ($idiomaPagina == 'en')  {
                    $precio     = money_format('%.2n', $precio);
                    $precio     = number_format($precio,2);
                }
            }
        }
    }
    return $precio;
}


function precio_mas_iva_libros( $post_id ){
	require get_template_directory() . '/config.php';	
    $codigo_iso = get_user_geo_country();
    $precio     = 10000;
    $idiomaPagina = apply_filters( 'wpml_current_language', NULL );
    if( ! empty( $post_id ) ){
        //OBTENER PRECIO SEGUN POST ID
        $sql_precio = "SELECT meta_value FROM `sc_wp_postmeta` WHERE `meta_key` = '_price' AND `post_id` = $post_id";
        $precio_wc  = $bd_wp->consultar( $sql_precio );
        if( !empty( $precio_wc ) || isset( $precio_wc ) ){
            //OBTENER IVA SEGUN PAIS
            $sql_tax    = "SELECT tax_rate FROM `sc_wp_woocommerce_tax_rates` WHERE tax_rate_country = '$codigo_iso' AND tax_rate_class = 'libros'";
            $tax        = $bd_wp->consultar( $sql_tax );
            if( !empty( $tax ) || isset( $tax ) ){
                $valor_tax  = ( $tax[0][0] / 100 ) + 1;
                //PRECIO + IVA
                $precio_base        = $precio_wc[0][0];
                $precio_mas_iva     = $precio_base * $valor_tax;
                //REDONDEO  
                //$precio               = round( $precio_mas_iva );
                $precio             =  $precio_mas_iva;
                if($idiomaPagina == 'es'){
                    $precio     = money_format('%.2n', $precio);
                    $precio     = str_replace('.',',', $precio);
                }else if ($idiomaPagina == 'en')  {
                    $precio     = money_format('%.2n', $precio);
                    $precio     = number_format($precio,2);
                }
            }
        }
    }   
    return $precio;
}

