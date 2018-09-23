<?php

function set_active($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'active' : '';
}

function html_tidy($src){
    $opentag = strrchr($src, '<');
    $closetag = strrchr($src, '>');

    if ( ( $closetag  ||  $opentag ) ) {
        if ( $closetag && (strlen($closetag) > strlen($opentag) )) {
            $src = substr($src , 0 , -strlen($opentag));
        }
    }
    return $src;
}