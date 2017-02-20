<?php

function set_active($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'active' : '';
}