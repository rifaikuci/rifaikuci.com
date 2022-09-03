<?php

if (isset($_POST['skillsInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("skills", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["name", "nameE", "description", "descriptionE", "level", "className", "type"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = insert($data, "skills");
    if (mysqli_query($db, $sql)) {

        header("Location:" . $path . "/?insert=ok");
        exit();
    } else {
        if (file_exists("../" . $file)) {
            unlink("../" . $file);
        }
        header("Location:" . $path . "/?insert=no");
        exit();
    }
}

if (isset($_POST['skillsUpdate'])) {

    $id = $_POST['skillsUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("skills", 'image', '');
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


    $arrayKey = ["name", "nameE", "description", "descriptionE", "level", "className", "type"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = update($data, "skills", $id);
    if ($sql == "no_update") {
        header("Location:" . $path . "/?update=ok");
        exit();
    }

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

if (isset($_GET['skillsDelete'])) {
    $id = $_GET['skillsDelete'];
    $row = getDataRow("$id", "skills", $db);
    $sql = delete($id, 'skills');
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;


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