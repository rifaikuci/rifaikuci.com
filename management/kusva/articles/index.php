<?php

if (isset($_POST['articlesInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = $path . "/" . $fileName;

    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("articles", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["title", "titleE", "description", "descriptionE",
         "active", "subject", "subjectE", "subTitle", "subTitleE", "keywords", "keywordsE", "metaDescription", "metaDescriptionE"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $data['seoTitle'] = seo($data['title']);
    $data['seoTitleE'] = seo($data['titleE']);

    $sql = insert($data, "articles");
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

if (isset($_POST['articlesUpdate'])) {

    $id = $_POST['articlesUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;

    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("articles", 'image', '');
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


    $arrayKey = ["title", "titleE", "description", "descriptionE",
        "active", "subject", "subjectE", "subTitle", "subTitleE", "keywords", "keywordsE", "metaDescription", "metaDescriptionE"];
    $data = getDataForm($arrayKey);


    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;


    $data['seoTitle'] = seo($data['title']);
    $data['seoTitleE'] = seo($data['titleE']);

    $sql = update($data, "articles", $id);
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

if (isset($_GET['articlesDelete'])) {
    $id = $_GET['articlesDelete'];
    $row = getDataRow("$id", "articles", $db);
    $sql = delete($id, 'articles');

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = base_url_back() . "src/" . $dirName . "/" . $fileName;


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