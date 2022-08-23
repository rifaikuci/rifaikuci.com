<?php

function base_url()
{
    return 'http://localhost/management/';
}

function firmName()
{
    return "Management";
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