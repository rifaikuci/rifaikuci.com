<?php

if (isset($_POST['projectsInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("projects", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["title", "titleE", "detail","detailE","description","descriptionE", "startDate","finishDate","keywords","keywordsE","link","type"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $data['seoTitle'] = seo($data['title']);
    $data['seoTitleE'] = seo($data['titleE']);

    $sql = insert($data, "projects");
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

if (isset($_POST['projectsUpdate'])) {

    $id = $_POST['projectsUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("projects", 'image', '');
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


    $arrayKey = ["title", "titleE", "detail","detailE","description","descriptionE", "startDate","finishDate","keywords","keywordsE","link","type"];
    $data = getDataForm($arrayKey);


    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;


    $data['seoTitle'] = seo($data['title']);
    $data['seoTitleE'] = seo($data['titleE']);

    $sql = update($data, "projects", $id);
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

if (isset($_GET['projectsDelete'])) {
    $id = $_GET['projectsDelete'];
    $row = getDataRow("$id", "projects", $db);
    $sql = delete($id, 'projects');
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