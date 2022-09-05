<?php


function base_url_back()
{
    return 'http://localhost/rifaikuci.com/management/';
}

function firmName()
{
    return "rifaikuci";
}

function imageBaseUrl()
{
    return "assets/images/";
}

function isUrlActive($link) {
    return strpos($_SERVER['REQUEST_URI'],$link);
}

function base_url_front()
{
    return 'http://localhost/rifaikuci.com/';
}

function getColumn ($about,$title,$lang) {
   if($lang == "tr") {
       return $about[$title];
   } else {
       return $about[$title."E"] ? $about[$title."E"] : $about[$title];
   }

}

?>