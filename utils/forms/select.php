<?php

function getSelect($size, $data, $label,$name, $color,$multiple, $selected,$required, $disabled)
{
    $size = $size ? $size : 4;
    $color = $color ? $color : "blue";
    $label = $label ? $label : "Label";
    $multiple = $multiple ? $multiple : false;
    $data = $data ? $data : array();
    $selected = $selected ? $selected : "";
    $name = $name ? $name : "";
    $required = $required ? true : false;
    $disabled = $disabled ? true : false;
    $data['']= "Seçiniz";

    $first = '<div class="col-sm-'.$size.'">
                <div class="select2-'.$color.'">
                    <div class="form-group">
                        <label>'.$label.'</label>';
    $isMultiple = $multiple ?   '<select multiple ' : '<select ';

    $required = $required ? " required " : "";
    $disabled = $disabled ? " disabled " : "";
    $first = $first. $isMultiple;
    $first = $first . $required;
    $first = $first . $disabled;

    $first = $first .
                         'name='.$name.' class="form-control select2"
                                data-dropdown-css-class="select2-'.$color.'" 
                                style="width: 100%;">';
    $options = "";

    foreach ($data as $key => $value) {
        if($key == $selected) {
        $options =  '<option selected value="'.$key.'">'.$value.'</option>'. $options;
        } else {
            $options =  '<option value="'.$key.'">'.$value.'</option>'. $options;
        }
    }

    $last = '   </select>
                    </div>
                </div>
                </div>';
    echo $first . $options. $last;

}