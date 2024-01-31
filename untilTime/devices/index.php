<?php

$json_data = file_get_contents('php://input');
header('Content-Type: application/json');
$data = json_decode($json_data, true);

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

if (isset($data['method']) && isset($data['method']) && $data['method'] == "deviceControl") {

    if ($deviceKey) {
        $query = "SELECT * FROM $tableUntilTimeDevices WHERE deviceKey = '$deviceKey'";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            $sqlInsert = "INSERT INTO $tableUntilTimeDevices (deviceKey, deviceBrand) VALUES ('$deviceKey', '$deviceBrand')";
            if ($db->query($sqlInsert)) {
                $response = [
                    'deviceKey' => $deviceKey,
                    'deviceBrand' => $deviceBrand
                ];

                echo json_encode($response);
            } else {
                echo "Ekleme hatası: " . $db->error;
            }
        }
    }
}