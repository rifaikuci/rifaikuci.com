<?php

if (isset($_POST['stockItemInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
         $path = base_url_back() . "src/" . $dirName ."/" . $fileName;

    $data = array();


    $arrayKey = ["bValue", "cValue", "totalLot", "link", "shortName","fullName","month"];
    $data = getDataForm($arrayKey);

    $sql = insert($data, "stockItem");
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

if (isset($_POST['stockItemUpdate'])) {

    $id = $_POST['stockItemUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = base_url_back() . "src/" . $dirName ."/" . $fileName;

    $data = array();



    $arrayKey = ["bValue", "cValue", "totalLot", "link", "shortName","fullName","month"];
    $data = getDataForm($arrayKey);

    $sql = update($data, "stockItem", $id);
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

if (isset($_GET['stockItemDelete'])) {
    $id = $_GET['stockItemDelete'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = base_url_back() . "src/" . $dirName ."/" . $fileName;


    $row = getDataRow("$id", "stockItem", $db);
    $sql = delete($id, 'stockItem');

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

?>