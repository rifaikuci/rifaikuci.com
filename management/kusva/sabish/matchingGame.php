<?php


if (isset($_POST['matchingGameInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;

    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("matchingGame", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["title"];
    $data = getDataForm($arrayKey);


    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $data['seoTitle'] = seo($data['title']);

    $sql = insert($data, "sabishMatchingGameCategory");
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

if (isset($_POST['matchingGameUpdate'])) {

    $id = $_POST['matchingGameUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;

    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("matchingGame", 'image', '');
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


    $arrayKey = ["title"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $data['seoTitle'] = seo($data['title']);

    $sql = update($data, "sabishMatchingGameCategory", $id);
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

if (isset($_GET['matchingGameDelete'])) {
    $id = $_GET['matchingGameDelete'];
    $tableName = "sabishMatchingGameCategory";
    $row = getDataRow("$id", $tableName, $db);
    $sql = delete($id, $tableName);

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;

    imageDeleteByProductId($tableName, $id, $db);

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

