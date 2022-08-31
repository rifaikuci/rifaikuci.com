<?php

if (isset($_POST['booksInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;
    $data = array();
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("books", 'image', '');
        if ($file == "image_large" || $file == "image_invalid_type" || $file == "image_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }
    }

    $arrayKey = ["name", "nameE", "startDate","finishDate","author","authorE", "summary","summaryE","publisher","publisherE","printing"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = insert($data, "books");
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

if (isset($_POST['booksUpdate'])) {

    $id = $_POST['booksUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $file = imageUpload("books", 'image', '');
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


    $arrayKey = ["name", "nameE", "startDate","finishDate","author","authorE", "summary","summaryE","publisher","publisherE","printing"];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['image']) && $_FILES['image']['name']) $data['image'] = $file;

    $sql = update($data, "books", $id);
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

if (isset($_GET['booksDelete'])) {
    $id = $_GET['booksDelete'];
    $row = getDataRow("$id", "books", $db);
    $sql = delete($id, 'books');
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