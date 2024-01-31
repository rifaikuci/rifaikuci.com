<?php

$json_data = file_get_contents('php://input');
header('Content-Type: application/json');
$data = json_decode($json_data, true);

$tableUntilTimeRoutines = "untilTimeRoutines";
$tableUntilTimeDevices = "untilTimeDevices";

$DEVICE_KEY = 'device-key';
$DEVICE_BRAND = 'brand-model';

$headers = getallheaders();

$deviceKey = "";
$deviceBrand = "";
if (isset($headers[$DEVICE_KEY])) {
    $deviceKey = $headers[$DEVICE_KEY];
}

if (isset($headers[$DEVICE_BRAND])) {
    $deviceBrand = $headers[$DEVICE_BRAND];
}

if (isset($data['method']) && isset($data['method']) && $data['method'] == "saveRoutines") {

    if ($deviceKey) {

        try {
            if(isset($data['title'])) {
                $title = isset($data['title']) ? $data['title'] : null;
                $isMainPage = isset($data['isMainPage']) ? $data['isMainPage'] : 1;
                $deviceId = getDataRowByColumn($deviceKey, $tableUntilTimeDevices, $db, "deviceKey")['id'];
                $sqlInsert = "INSERT INTO $tableUntilTimeRoutines (title, isMainPage, deviceId) VALUES ('$title', '$isMainPage', '$deviceId')";

                echo $db->query($sqlInsert) ? json_encode(['success' => true]) : json_encode(['success' => false]);
            } else {
                echo json_encode(['success' => false, 'message'=> "rutin Adı giriniz1"]);
            }

        } catch (Exception $exception) {
            echo  json_encode(['success' => false]);
        }
    }
}