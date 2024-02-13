<?php

function generateRecords( $startDateTime, $endDateTime) {
    $records = array();
    $endDateTime = $endDateTime ? $endDateTime :  date("Y-m-d H:i:s");
    $currentDate = date("Y-m-d", strtotime($startDateTime));
    $endDate = date("Y-m-d", strtotime($endDateTime));



    while ($currentDate <= $endDate) {
        $startOfDay = $currentDate . " 00:00:00";
        $endOfDay = $currentDate . " 23:59:59";

        if ($currentDate == date("Y-m-d", strtotime($startDateTime))) {
            $startOfDay = $startDateTime;
        }

        if ($currentDate == date("Y-m-d", strtotime($endDateTime))) {
            $endOfDay = $endDateTime;
        }

        $records[] = array(
            'date' => onlyDate($currentDate),
            'startDate' => dateWithTime($startOfDay),
            'finishDate' => dateWithTime($endOfDay),
            'totalSeconds' => calculateTimeDifferenceSecond($startOfDay, $endOfDay)
        );

        $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
    }

    return $records;
}