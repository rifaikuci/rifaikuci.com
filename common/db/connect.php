<?php

try {
    $db =
        mysqli_connect("localhost", "rifaikuc", "Gt36wwY2x7", "rifaikuc_rifaikuci");
       // mysqli_connect("localhost", "root", "", "rifaikuci");
    $db->set_charset("utf8");

} catch (ErrorException  $exception) {
    echo $exception;
}

?>