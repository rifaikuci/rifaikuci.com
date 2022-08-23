<?php

if (isset($_POST['settingsInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;
    $data = array();
    if (isset($_FILES['file']) && $_FILES['file']['name']) {
        $file = imageUpload("settings", 'file', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
        }
    }

    $arrayKey = ["name", "surname", "address", "city", "gender", "birthdate", "age", "description"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['file']) && $_FILES['file']['name']) $data['image'] = $file;

    $sql = insert($data, "tblSettings");
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?insert=ok");
        exit();
    } else {
        header("Location:" . $path . "/?insert=no");
        exit();
    }
}

if (isset($_POST['settingsUpdate'])) {

    $id = $_POST['settingsUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['file']) && $_FILES['file']['name']) {
        $file = imageUpload("settings", 'file', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
        }

        if (isset($_POST['deleteFile']) && $_POST['deleteFile']) {
            if (file_exists("../" . $_POST['deleteFile'])) {
                unlink("../" . $_POST['deleteFile']);
            }
        }
    }


    $arrayKey = ["name", "surname", "address", "city", "gender", "birthdate", "age", "description"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['file']) && $_FILES['file']['name']) $data['image'] = $file;

    $sql = update($data, "tblSettings", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

if (isset($_GET['settingsDelete'])) {
    $id = $_GET['settingsDelete'];
    $row = getDataRow("$id", "tblSettings", $db);
    $sql = delete($id, 'tblSettings');
    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;


    if (isset($row['image']) && $row['image']) {
        if (file_exists("../" . $row['image'])) {
            unlink("../" . $row['image']);
        }
    }

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

?>