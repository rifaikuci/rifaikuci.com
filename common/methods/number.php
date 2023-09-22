<?php

function sayiFormatla ($sayi, $delimiter) {
    if($delimiter === 0 ) {
        return number_format($sayi, 0, ',', '.');

    } else if ($delimiter === "") {
        $delimiter  = $delimiter ? $delimiter : 2;
        return number_format($sayi, $delimiter, ',', '.');

    } else {
        $delimiter  = $delimiter ? $delimiter : 2;
        return number_format($sayi, $delimiter, ',', '.');
    }
}

function stockDailyClear($stockId, $db) {
    $row = getDataRow($stockId, 'stockItem',$db);

    $month = $row['month'];
    $bValue =  $row['bValue'];
    $cValue =  $row['cValue'];
    $totalLot =  $row['totalLot'];

    $day  = $month * 30;
    $result = $bValue - $cValue ;

    return ($result / $totalLot ) / $day;


}
?>

