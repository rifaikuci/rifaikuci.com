<?php

if (isset($_POST['myStockListInsert'])) {

    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();

    $arrayKey = ["count", "stockItemId"];
    $data = getDataForm($arrayKey);


    $sql = insert($data, "myStockList");
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

if (isset($_POST['myStockListUpdate'])) {

    $id = $_POST['myStockListUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();



    $arrayKey = ["count", "substract"];
    $data = getDataForm($arrayKey);

    $data['count'] = $data['count'] - $data['substract'];
    $countSell  = $data['substract'];
    unset($data['substract']);
    $sql = update($data, "myStockList", $id);
    if (mysqli_query($db, $sql)) {

        $sqlMyStockListHistory = "INSERT INTO stockListHistory (myStockListId, count) VALUES ('$id', '$countSell')";
        echo $sqlMyStockListHistory;
        mysqli_query($db, $sqlMyStockListHistory);

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


if (isset($_GET['myStockListDelete'])) {
    $id = $_GET['myStockListDelete'];
    $row = getDataRow("$id", "myStockList", $db);
    $sql = delete($id, 'myStockList');
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