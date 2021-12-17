<?php

function selector_idiomas_personalizado(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    $language_actual = apply_filters( 'wpml_current_language', NULL );
    $idioma = "<div class='dropdown d-lg-none'>";
    if(!empty($languages)){
      
        $idioma .=  '<button class="btn bg-transparent dropdown-toggle text-uppercase fs-09" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fal fa-globe pr-2 fa-lg"></span>'.$language_actual.'</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
        foreach($languages as $l){
            if(!$l['active']){
                $idioma .=  '<a href="'.$l['url'].'" class="dropdown-item text-uppercase" style="font-size:.9em;">'.$l['language_code'].'</a>';
            }
        }
    }
    $idioma .=  "</div></div>";
    return $idioma;
}
?>