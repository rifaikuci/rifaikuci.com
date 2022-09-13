<?php


function base_url_back()
{
    return 'https://rifaikuci.com/management/';
}

function firmName()
{
    return "rifaikuci";
}

function imageBaseUrl()
{
    return "assets/images/";
}

function pdfBaseUrl()
{
    return "assets/pdf/";
}

function isUrlActive($link) {
    return strpos($_SERVER['REQUEST_URI'],$link);
}

function isTreeOpen($array) {
    $isOpen = false;
    for ($i = 0; $i <  count($array); $i++) {
        if(isUrlActive("src/".$array[$i])) {
            $isOpen = true;
        }
    }
    return $isOpen;
}

function base_url_front()
{
    return 'https://rifaikuci.com/';
}

function getColumn ($row,$title,$lang) {
   if($lang == "tr") {
       return $row[$title];
   } else {
       return $row[$title."E"] ? $row[$title."E"] : $row[$title];
   }
}

function getLabel($tr,$eng,$lang) {
    if($lang == "tr") echo $tr;
    else echo $eng;

}

?>