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
?>

