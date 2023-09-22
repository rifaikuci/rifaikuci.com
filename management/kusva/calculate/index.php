<?php

$received_data = json_decode(file_get_contents("php://input"));
$data = array();


if ($received_data->action == 'stockCalculate') {

    $sql = "select stockAmount, stockPerson, stockPercent, stockItemAmount from info where id = 1";

    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();

    foreach ($result as $row) {
        $data['stockAmount'] = $row['stockAmount'];
        $data['stockPerson'] = $row['stockPerson'];
        $data['stockPercent'] = $row['stockPercent'];
        $data['stockItemAmount'] = $row['stockItemAmount'];
    }

    echo json_encode($data);

}

if ($received_data->action == 'stockCalculateSubmit') {

    $stockAmount = $received_data->stockAmount;
    $stockPerson = $received_data->stockPerson;
    $stockPercent = $received_data->stockPercent;
    $stockItemAmount = $received_data->stockItemAmount;


    $sql = "UPDATE info set stockAmount = '$stockAmount', stockPerson = '$stockPerson', stockPercent= '$stockPercent', stockItemAmount= '$stockItemAmount'   where id = 1";


    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();

    foreach ($result as $row) {
        $data['stockAmount'] = $row['stockAmount'];
        $data['stockPerson'] = $row['stockPerson'];
        $data['stockPercent'] = $row['stockPercent'];
        $data['stockItemAmount'] = $row['stockItemAmount'];
    }

    echo json_encode($data);

}