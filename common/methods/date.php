<?php

function onlyDate($tarih)
{
    $tarih = date("d.m.Y", strtotime(explode(" ", $tarih)[0]));

    return $tarih;
}

function dateWithTime($tarih)
{
    $tarih = date_create($tarih);
    $tarih = date_format($tarih, "d.m.Y H:i");

    return $tarih;
}

function dateString($tarih) {
    $date = onlyDate($tarih);
    $month = date("m",strtotime($date));
    $year = date("Y",strtotime($date));
    $day = date("d",strtotime($date));
    $monthString = "";
    if($month == "01") {
        $monthString = "Ocak";
    } else if ($month == "02"){
        $monthString = "Şubat";
    } else if ($month == "03"){
        $monthString = "Mart";
    } else if ($month == "04"){
        $monthString = "Nisan";
    } else if ($month == "05"){
        $monthString = "Mayıs";
    } else if ($month == "06"){
        $monthString = "Haziran";
    } else if ($month == "07"){
        $monthString = "Temmuz";
    } else if ($month == "08"){
        $monthString = "Ağustos";
    } else if ($month == "09"){
        $monthString = "Eylül";
    } else if ($month == "10"){
        $monthString = "Ekim";
    } else if ($month == "11"){
        $monthString = "Kasım";
    } else if ($month == "12"){
        $monthString = "Aralık";
    }
    return $day ." " . $monthString . " " . $year;
}

function dateValue($tarih) {
    $tarih = date_create($tarih);
    $tarih = date_format($tarih, "Y-m-d");

    return $tarih;
}

?>