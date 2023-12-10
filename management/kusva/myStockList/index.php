<?php

if (isset($_POST['myStockListInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

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
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    $data = array();



    $arrayKey = ["count", "substract"];
    $data = getDataForm($arrayKey);

    $data['count'] = $data['count'] - $data['substract'];
    $countSell  = $data['substract'];
    unset($data['substract']);
    $sql = update($data, "myStockList", $id);
    if (mysqli_query($db, $sql)) {

        $sqlMyStockListHistory = "INSERT INTO stockListHistory (myStockListId, count) VALUES ('$id', '$countSell')";
        $sqlMyStockListHistory;
        mysqli_query($db, $sqlMyStockListHistory);

        header("Location:" . $path . "/?update=ok");
        exit();
    } else {

        header("Location:" . $path . "/?update=no");
        exit();
    }
}


if (isset($_GET['myStockListDelete'])) {
    $id = $_GET['myStockListDelete'];
    $row = getDataRow("$id", "myStockList", $db);
    $sql = delete($id, 'myStockList');


    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

if(isset($_POST['myStockListUpdateTotal'])) {
    $id = $_POST['myStockListUpdateTotal'];
    $substract= $_POST['substract'];
    $itemSql = "Select * from myStockList where stockItemId = '$id'";

    $result = $db->query($itemSql);
    while ($row = $result->fetch_array()) {
        $tempId  = $row['id'];
        $count = $row['count'];

        if($substract > 0 ) {

            if (($substract - $count) > 0) {
                $substract = $substract - $count;
                $insertCount = $count;
                $newCount = 0;
            } else {
                $count = $count - $substract;
                $insertCount = $substract;
                $newCount = $count;
                $substract = 0;
            }

                $stockItemId = $row['id'];

                $data['count'] = $newCount;
                $sql = update($data, "myStockList", $stockItemId);
                 mysqli_query($db, $sql);

                $sqlMyStockListHistory = "INSERT INTO stockListHistory (myStockListId, count) VALUES ('$tempId', '$insertCount')";

                mysqli_query($db, $sqlMyStockListHistory);

        }

    }

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if($fileName != "index")
        $path = $path ."/" . $fileName;

    header("Location:" . $path . "/?update=ok");

}

?>