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

if (isset($data['method']) && isset($data['method']) && $data['method'] == "getRoutinesMainPage") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;

            $sql = "select * from ". $tableUntilTimeRoutines ." where deviceId = '$deviceId' and isMainPage = 1 and isDeleted = 0";
            $result = $db->query($sql);

            $routines = array();
            while ($row = $result->fetch_array()) {
                $routine = null;
                $routine['id'] = $row['id'];
                $routine['title'] = $row['title'];
                $routine['isMainPage'] = $row['isMainPage'];
                $routine['isDeleted'] = $row['isDeleted'];
                $routine['insertDate'] = dateWithTime($row['insertDate']);
                $routine['updateDate'] = dateWithTime($row['updateDate']);

                array_push($routines, $routine);
            }

            echo json_encode($routines);


        } catch (Exception $exception) {
            echo  json_encode(['success' => false]);
        }
    }
}

if (isset($data['method']) && isset($data['method']) && $data['method'] == "updateRoutineMainPage") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : null;

            $sqlUpdate = "UPDATE ". $tableUntilTimeRoutines . " SET isMainPage = 0 WHERE deviceId = '$deviceId' AND id = '$routineId'";

            echo $db->query($sqlUpdate) ? json_encode(['success' => true]) : json_encode(['success' => false]);

        } catch (Exception $exception) {
            echo  json_encode(['success' => false]);
        }
    }
}

if (isset($data['method']) && isset($data['method']) && $data['method'] == "deleteRoutine") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : null;

            $sqlUpdate = "UPDATE ". $tableUntilTimeRoutines . " SET isDeleted = 1,isMainPage = 0  WHERE deviceId = '$deviceId' AND id = '$routineId'";


            echo $db->query($sqlUpdate) ? json_encode(['success' => true]) : json_encode(['success' => false]);

        } catch (Exception $exception) {
            echo  json_encode(['success' => false]);
        }
    }
}

if (isset($data['method']) && isset($data['method']) && $data['method'] == "getRoutineId") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : null;

            $sql = "select * from ". $tableUntilTimeRoutines ." where deviceId = '$deviceId' and id = '$routineId'";

            $routine = getDataRow($routineId,$tableUntilTimeRoutines, $db);

            echo json_encode([
                'id' => $routine['id'],
                'insertDate'=>  dateWithTime($routine['insertDate']) ,
                'updateDate'=>  dateWithTime($routine['updateDate']) ,
                'title'=>  $routine['title'],
                'isMainPage'=>  $routine['isMainPage'],
                ]);
        } catch (Exception $exception) {
            echo  json_encode(['success' => false]);
        }
    }
}

if (isset($data['method']) && isset($data['method']) && $data['method'] == "updateRoutine") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : null;

            $title = isset($data['title']) ? $data['title'] : null;
            $isMainPage = isset($data['isMainPage']) ? $data['isMainPage'] : 1;
            $deviceId = getDataRowByColumn($deviceKey, $tableUntilTimeDevices, $db, "deviceKey")['id'];


            $sqlUpdate = "UPDATE ". $tableUntilTimeRoutines . " SET title = '$title' , isMainPage = '$isMainPage'  WHERE id = '$routineId'";

            echo $db->query($sqlUpdate) ? json_encode(['success' => true]) : json_encode(['success' => false]);

        } catch (Exception $exception) {
            echo  json_encode(['success' => false]);
        }
    }
}