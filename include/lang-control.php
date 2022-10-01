<?php

session_start();
$lang = "en";
if ($_GET['lang']) {
    $_SESSION['lang'] = $_GET['lang'];

    $lang = $_GET['lang'];
    $acceptLang = ['fr', 'it', 'en', 'tr'];
    $lang = in_array($lang, $acceptLang) ? $lang : 'tr';
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $filteredURL = preg_replace('~(\?|&)'.'lang'.'=[^&]*~', '$1', $currentURL);
    $filteredURL = str_replace("?","",$filteredURL);
    header('Location:'.$filteredURL);

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
