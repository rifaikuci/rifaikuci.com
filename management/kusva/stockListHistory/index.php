<?php

if (isset($_POST['stockListHistoryInsert'])) {


    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = base_url_back() . "src/" . $dirName ."/" . $fileName;

    $data = array();

    $arrayKey = ["count", "stockItemId"];
    $data = getDataForm($arrayKey);


    $sql = insert($data, "stockListHistory");
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

if (isset($_POST['stockListHistoryUpdate'])) {

    $id = $_POST['stockListHistoryUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = base_url_back() . "src/" . $dirName ."/" . $fileName;

    $data = array();



    $arrayKey = ["count", "substract"];
    $data = getDataForm($arrayKey);

    $data['count'] = $data['count'] - $data['substract'];
    unset($data['substract']);
    $sql = update($data, "stockListHistory", $id);
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


if (isset($_GET['stockListHistoryDelete'])) {
    $id = $_GET['stockListHistoryDelete'];
    $row = getDataRow("$id", "stockListHistory", $db);
    $sql = delete($id, 'stockListHistory');

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = base_url_back() . "src/" . $dirName ."/" . $fileName;


    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

if (isset($_GET['fullDeleteStockListHistory'])) {

    $sql = "TRUNCATE table stockListHistory";

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = base_url_back() . "src/" . $dirName ."/" . $fileName;

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

?>