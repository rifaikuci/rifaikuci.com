<?php

try {
    $db = mysqli_connect("localhost", "root", "", "management");
    $db->set_charset("utf8");

} catch (ErrorException  $exception) {
    echo $exception;
}

?>