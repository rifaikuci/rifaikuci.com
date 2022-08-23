<?php
require_once "date.php";
function getDatetime( $size, $label, $name, $value, $required, $disabled)
{
    $size = $size ? $size : 4;
    $name = $name ? $name : "name23";
    $label = $label ? $label : "label2";
    $value = $value ? dateValue($value) : date("Y-m-d");;
    $required = $required ? true : false;
    $disabled = $disabled ? true : false;


    $first =   '<div class="col-sm-'.$size.'">
                <div class="form-group">
                    <label>'.$label.'</label>
                    <input ';

    $required = $required ? " required " : "";
    $disabled = $disabled ? " disabled " : "";
    $first = $first . $required;
    $first = $first . $disabled;

    $last = ' type="date"
                           value="'.$value.'" 
                           class="form-control form-control-lg" name="'.$name.'">
                </div>
            </div>';
    echo $first.$last;
}

?>