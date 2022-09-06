<?php

function getDataForm($arrayKey)
{
    $arrayKeyValue = array();
    for ($i = 0; $i < count($arrayKey); $i++) {
        $temp = $arrayKey[$i];
        $value = isset($_POST[$temp]) ? $_POST[$temp] : '';
        array_push($arrayKeyValue, $value);
    }

    return array_combine($arrayKey, $arrayKeyValue);
}

function getDataFilter($array, $objectName, $searchValue)
{
    $data = array();
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i][$objectName] == $searchValue) {
            array_push($data, $array[$i]);
        }
    }
    return $data;
}

?>