<?php
function damApi ($sku, $variable = true){
    if (!$variable) {
        $sql = "SELECT producto_id, codigo_nuevo FROM modelo LEFT JOIN composicion ON composicion.modelo_id = modelo.id WHERE codigo_nuevo LIKE '%$sku%'";
        //include('../config.php');
        require get_template_directory() . '/config.php';
        $data = $bd_pim->consultar($sql);
        //print_r2($data);
        if($data != NULL) $sku = $data[0]['producto_id'];
    }
    //$sku = "398";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_POST            => true,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_CUSTOMREQUEST   => "POST",
        CURLOPT_POSTFIELDS      => array('query' => 'getImagesProduct','productId' => $sku,'tipology' => 9, 'limit' => 15),
        CURLOPT_URL             => "https://downloads.santacole.com/api_dam.php",
        // CURLOPT_URL             => "../dam/api_dam.php",
        //For debug only
        CURLOPT_SSL_VERIFYHOST  => false,
        CURLOPT_SSL_VERIFYPEER  => false,
    ));
    
    $resp = array();
    $resp = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 200 ) {
        $resp['test'] = ("Error: Failed with status $status, response $resp, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        return json_decode($resp, true)['test'];
    }
    
    curl_close($curl);
    return json_decode($resp, true)['data'];
    // return $resp;
}