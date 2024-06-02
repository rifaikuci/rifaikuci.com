<?php

require_once  'paymentDetail.php';

if (isset($_POST['learnerDriverInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;
    
    $data = array();


    $arrayKey = ["shortName", "phone", "identityNo", "birthDate", "registerDate","debit"];
    $data = getDataForm($arrayKey);

    $sql = insert($data, "learnerDriver");
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

if (isset($_POST['learnerDriverUpdate'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $id = $_POST['learnerDriverUpdate'];
    $data = array();
    $arrayKey = ["shortName", "phone", "identityNo", "birthDate", "registerDate","debit"];
    $data = getDataForm($arrayKey);


    $sql = update($data, "learnerDriver", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

if (isset($_GET['learnerDriverDelete'])) {
    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $id = $_GET['learnerDriverDelete'];
    $row = getDataRow("$id", "learnerDriver", $db);
    $sql = delete($id, 'learnerDriver');

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

if (isset($_POST['learnerDriverPayment'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $data = array();
    $arrayKey = ["paymentType", "transactionDate", "paymentPrice", "description","learnerDriverId"];
    $data = getDataForm($arrayKey);

    $sql = insert($data, "learnerDriverPayment");
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

?>