<?php

if (isset($_POST['certificateInsert'])) {


    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("certificate", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["title", "titleE", "startDate","finishDate","description","descriptionE"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = insert($data, "certificate");
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

if (isset($_POST['certificateUpdate'])) {

    $id = $_POST['certificateUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("certificate", 'image', '');
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


    $arrayKey = ["title", "titleE", "startDate","finishDate","description","descriptionE"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = update($data, "certificate", $id);
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

if (isset($_GET['certificateDelete'])) {
    $id = $_GET['certificateDelete'];
    $row = getDataRow("$id", "certificate", $db);
    $sql = delete($id, 'certificate');

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;



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