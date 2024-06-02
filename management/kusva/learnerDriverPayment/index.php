<?php



if (isset($_GET['learnerDriverPaymentDelete'])) {
    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $id = $_GET['learnerDriverPaymentDelete'];
    $sql = delete($id, 'learnerDriverPayment');
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

if (isset($_POST['learnerDriverPaymentUpdate'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $id = $_POST['learnerDriverPaymentUpdate'];
    $data = array();
    $arrayKey = ["transactionDate", "paymentType", "paymentPrice", "description"];
    $data = getDataForm($arrayKey);


    $sql = update($data, "learnerDriverPayment", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

?>