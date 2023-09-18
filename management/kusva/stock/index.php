<?php

if (isset($_POST['stockInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();


    $arrayKey = ["bValue", "cValue", "totalLot", "link", "shortName","fullName","month"];
    $data = getDataForm($arrayKey);

    $sql = insert($data, "stock");
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

if (isset($_POST['stockUpdate'])) {

    $id = $_POST['stockUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();



    $arrayKey = ["bValue", "cValue", "totalLot", "link", "shortName","fullName","month"];
    $data = getDataForm($arrayKey);

    $sql = update($data, "stock", $id);
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

if (isset($_GET['stockDelete'])) {
    $id = $_GET['stockDelete'];
    $row = getDataRow("$id", "stock", $db);
    $sql = delete($id, 'stock');
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

?>