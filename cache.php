<?php

function save_cache($data, $name) {
        if(!apcu_add($name,$data,86400))
            return false;
}

function get_cache($name) {
    if (!apcu_exists($name)){

        return false;
    }
    else
        return (apcu_fetch($name));
}

?>