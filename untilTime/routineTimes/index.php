<?php

$json_data = file_get_contents('php://input');
header('Content-Type: application/json');
$data = json_decode($json_data, true);

$tableUntilTimeDevices = "untilTimeRoutines";
$tableUntilTimeRoutineTimes = "untilTimeRoutineTimes";

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

if (isset($data['method']) && isset($data['method']) && $data['method'] == "startRoutineTimes") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : null;


            $sqlInsert = "INSERT INTO $tableUntilTimeRoutineTimes (routineId ) VALUES ('$routineId')";
            if($db->query($sqlInsert)) {
                $id = mysqli_insert_id($db);
                echo json_encode(['success' => true, 'routineTimesId' => $id]);
            } else {
                echo json_encode(['success' => false]);
            }

        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'message' => "Zamanlıyıcı Kaydederken bir hata oluştu."]);
        }

    }
}

if (isset($data['method']) && isset($data['method']) && $data['method'] == "finishRoutineTimes") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : null;
            $routineTimesId = isset($data['routineTimesId']) ? $data['routineTimesId'] : 0;

            $now = new DateTime();
            $finishDate = $now->format("Y-m-d H:i:s");

            $sqlUpdate = "UPDATE " . $tableUntilTimeRoutineTimes . " SET finishDate = '$finishDate' WHERE  id = '$routineTimesId'";




            echo $db->query($sqlUpdate) ? json_encode(['success' => true]) : json_encode(['success' => false]);

        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'message' => "Zamanlıyıcı Durdururken bir hata oluştu."]);
        }

    }
}

