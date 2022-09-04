<?php

session_start();
$lang = "en";
if ($_GET['lang']) {
    $_SESSION['lang'] = $_GET['lang'];
    $lang = $_SESSION['lang'];
} else {
    if ($_SESSION['lang']) {
        $lang = $_SESSION['lang'];
    } else {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $acceptLang = ['fr', 'it', 'en', 'tr'];
        $lang = in_array($lang, $acceptLang) ? $lang : 'tr';
        $_SESSION['lang'] = $lang;
        $_SESSION['lang'] = $lang;
    }

}

?>
