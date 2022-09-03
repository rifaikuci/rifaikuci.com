<?php

function getDataForm($arrayKey)
{
    $arrayKeyValue = array();
    for ($i = 0; $i < count($arrayKey); $i++) {
        $temp = $arrayKey[$i];
        $value = isset($_POST[$temp]) ? $_POST[$temp] : null;
        array_push($arrayKeyValue, $value);
    }

    return array_combine($arrayKey, $arrayKeyValue);
}

?>