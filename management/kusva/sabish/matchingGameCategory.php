<?php
$SABISH_MATCHING_GAME_CATEGORY = "sabishMatchingGameCategory";

if (isset($_POST['matchingGameCategoryInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;

    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("matchingGameCategory", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }



    $arrayKey = ["title"];
    $data = getDataForm($arrayKey);


    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $data['seoTitle'] = seo($data['title']);

    $sql = insert($data, $SABISH_MATCHING_GAME_CATEGORY);
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

if (isset($_POST['matchingGameCategoryUpdate'])) {

    $id = $_POST['matchingGameCategoryUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;

    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("matchingGameCategory", 'image', '');
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

    $sql = update($data, $SABISH_MATCHING_GAME_CATEGORY, $id);
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

if (isset($_GET['matchingGameCategoryDelete'])) {
    $id = $_GET['matchingGameCategoryDelete'];
    $row = getDataRow("$id", $SABISH_MATCHING_GAME_CATEGORY, $db);
    $sql = delete($id, $SABISH_MATCHING_GAME_CATEGORY);

    $fileDelete =  $row['image'];
    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;


    if (file_exists("../" . $fileDelete)) {
        unlink("../" . $fileDelete);
    }

    imageDeleteByProductId($SABISH_MATCHING_GAME_CATEGORY, $id, $db);

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

