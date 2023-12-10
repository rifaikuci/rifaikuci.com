<?php

if ( !empty($_FILES) && isset($_POST['multipleImageInsert'])) {

    $image = imageUpload("galeria","file","");
    $tblName = $_POST['tblName'];
    $productId = $_POST['productId'];

    $sql = "INSERT INTO galeria (image,productId, tblName)
    VALUES ('$image','$productId', '$tblName')";

    mysqli_query($db, $sql);
}


?>