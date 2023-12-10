<?php

if (isset($_POST['educationInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("education", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["title", "titleE", "description","descriptionE","startDate","finishDate"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = insert($data, "education");
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

if (isset($_POST['educationUpdate'])) {

    $id = $_POST['educationUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("education", 'image', '');
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


    $arrayKey = ["title", "titleE", "description","descriptionE","startDate","finishDate"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = update($data, "education", $id);
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

if (isset($_GET['educationDelete'])) {
    $id = $_GET['educationDelete'];
    $row = getDataRow("$id", "education", $db);
    $sql = delete($id, 'education');

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