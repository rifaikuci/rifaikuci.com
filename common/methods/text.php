<?php

function seo($text)
{
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);

    return $text;
}

function wordSplice($metin, $sayi)
{
    $uzunluk = count(explode(' ', $metin));
    if ($uzunluk > $sayi) {
        return implode(' ', array_slice(explode(' ', $metin), 0, $sayi)) . " ...";
    } else {
        return $metin;
    }
}

function wordCharacter($metin, $sayi ){

    if(strlen($metin) < $sayi) {
        echo $metin;
    } else {

        for ($i = 0; $i< 20; $i++) {
            if($metin[$sayi+$i] == ' ' ) {
                echo   $metin  = substr($metin,0,$sayi+$i)."...";
            }
        }

    }
}

function generateKeywordVariations($companyName) {
    $variations = array();
    $companyName = strtolower($companyName);
    $length = strlen($companyName);

    for ($i = 0; $i < $length; $i++) {
        $char = $companyName[$i];
        $variations[] = substr_replace($companyName, $char, $i, 1);

        for ($j = ord('a'); $j <= ord('z'); $j++) {
            $newChar = chr($j);

            if ($newChar !== $char) {
                $variations[] = substr_replace($companyName, $newChar, $i, 1);
            }
        }
    }

    for ($i = 0; $i <= $length; $i++) {
        for ($j = ord('a'); $j <= ord('z'); $j++) {
            $char = chr($j);
            $variations[] = substr_replace($companyName, $char, $i, 0);
        }
    }

    for ($i = 0; $i < $length; $i++) {
        $variations[] = substr_replace($companyName, '', $i, 1);
    }

    return $variations;
}

?>