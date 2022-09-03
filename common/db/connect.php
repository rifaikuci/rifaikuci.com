<?php

try {
    $db = mysqli_connect("localhost", "root", "", "rifaikuci.com");
    $db->set_charset("utf8");

} catch (ErrorException  $exception) {
    echo $exception;
}

?>