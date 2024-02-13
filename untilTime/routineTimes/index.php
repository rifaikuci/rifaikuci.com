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
            if ($db->query($sqlInsert)) {
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

if (isset($data['method']) && isset($data['method']) && $data['method'] == "getRoutineTimes") {

    if ($deviceKey) {

        try {
            $deviceId = isset($data['deviceId']) ? $data['deviceId'] : null;
            $routineId = isset($data['routineId']) ? $data['routineId'] : 47;
            $timeType = isset($data['timeType']) ? $data['timeType'] : "DAILY";



            $now =  date("Y-m-d H:i:s");

            $selectSQL = "select u.id as id, r.title as title, r.insertDate as insertDate, u.finishDate as finishDate, u.startDate as startDate
                from untilTimeRoutineTimes u
            inner join untilTimeRoutines r on u.routineId = r.id
                where u.routineId = '$routineId' and u.isDeleted = 0";


            $result = $db->query($selectSQL);



            $items = array();
            $totalSeconds = 0;
            while ($item = $result->fetch_array()) {

                $tempItem['id'] = $item['id'];
                $tempItem['title'] = $item['title'];
                $tempItem['insertDate'] = $item['insertDate'];
                $tempItem['active'] =  $item['finishDate'] ? 0 : 1 ;
                $finishDate= $item['finishDate'] ? $item['finishDate'] : $now ;
                $startDate=  $item['startDate'];

                if($timeType == "DAILY") {
                    if(isPastDate($now, $startDate)) {
                    } else {
                        $startDate = date("Y-m-d 00:00:00");
                    }
                }

                if($timeType == "LAST_SEVEN_DAY") {
                    $threeDaysAgo = date("Y-m-d 00:00:00", strtotime("-6 days"));

                    if(isPastDate($threeDaysAgo, $startDate)) {} else { $startDate = $threeDaysAgo;}
                }

                if($timeType == "LAST_THIRTY_DAY") {
                    $threeDaysAgo = date("Y-m-d 00:00:00", strtotime("-29 days"));

                    if(isPastDate($threeDaysAgo, $startDate)) {} else { $startDate = $threeDaysAgo;}
                }

                $tempItem['records'] = generateRecords( $startDate , $finishDate);
                $totalSeconds = $totalSeconds + calculateTimeDifferenceSecond( $startDate , $finishDate);
                $tempItem['totalSeconds'] = $totalSeconds;
                array_push($items,$tempItem);


            }

            echo  json_encode($items);

        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'message' => "data getirilirken bir hata oluştu"]);
        }

    }
}

