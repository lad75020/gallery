<?php
    $random_number_array = range(0, 255);
    shuffle($random_number_array );
    $random_number_array = array_slice($random_number_array ,0,$_REQUEST['size']-1);
    echo(json_encode( $random_number_array));
?>