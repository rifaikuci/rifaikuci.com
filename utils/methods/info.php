<?php

function base_url()
{
    return 'http://localhost/rifaikuci.com/';
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

function getContent($content) {
    return  isset($_GET[$content]); 
}

function postContent($content) {
    return  isset($_POST[$content]);
}

?>