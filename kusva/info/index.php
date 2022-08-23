<?php

if (isset($_POST['infoekleme'])) {

    $data = array();

    if (isset($_FILES['file']) && $_FILES['file']['name']) {
        $file = imageUpload("infos", 'file', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:../../index.php?hata=" . $file);
        }
    }

    $arrayKey = ["name", "surname", "address", "city", "gender", "birthdate", "age"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['file']) && $_FILES['file']['name']) $data['image'] = $file;

    $sql = insert($data, "tbl_info");
    if (mysqli_query($db, $sql)) {
        header("Location:../../index.php?durumekle=ok");
        exit();
    } else {
        header("Location:../../index.php?durumekle=no");
        exit();
    }
}

?>