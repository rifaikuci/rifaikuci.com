<?php

if (isset($_POST['projectInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;
    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("project", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["title", "content", "description", "keywords", "noticeDate"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = insert($data, "tblProject");
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?insert=ok");
        exit();
    } else {
        header("Location:" . $path . "/?insert=no");
        exit();
    }
}

if (isset($_POST['projectUpdate'])) {

    $id = $_POST['projectUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("project", 'image', '');
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


    $arrayKey = ["title", "content", "description", "keywords", "noticeDate"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = update($data, "tblProject", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

if (isset($_GET['projectDelete'])) {
    $id = $_GET['projectDelete'];
    $row = getDataRow("$id", "tblProject", $db);
    $sql = delete($id, 'tblProject');
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