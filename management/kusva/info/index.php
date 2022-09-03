<?php

if (isset($_POST['infoUpdate'])) {

    $id = $_POST['infoUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("info", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }

        if (isset($_POST['deleteFile']) && $_POST['deleteFile']) {
            if (file_exists("../" . $_POST['deleteFile'])) {
                unlink("../" . $_POST['deleteFile']);
            }
        }
    }

    $arrayKey = [
        "name", "nameE", "address", "addressE", "district", "districtE", "phone1", "phone2", "about", "aboutE",
        "description","descriptionE","birthPlace","mail","city","cityE","keywords","keywordsE","birthPlaceE","title","titleE","link","maps"
    ];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = update($data, "info", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        if (file_exists("../" . $file)) {
            unlink("../" . $file);
        }
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

?>