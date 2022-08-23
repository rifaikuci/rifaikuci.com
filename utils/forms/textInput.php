<?php

function getTextInput($size, $label, $placeholder, $name, $value, $required, $disabled)
{
    $size = $size ? $size : 12;
    $label = $label ? $label : "label";
    $placeholder = $placeholder ? $placeholder : "placeholder";
    $name = $name ? $name : "name";
    $value = $value ? $value : "";
    $required = $required ? true : false;
    $disabled = $disabled ? true : false;

    $first = '<div class="col-sm-' . $size . '">
                    <div class="form-group">
                        <label>' . $label . '</label>
                            <input ';
    $required = $required ? " required " : "";
    $disabled = $disabled ? " disabled " : "";

    $first = $first . $required;
    $first = $first . $disabled;
    $last = 'type="text" 
                            class="form-control form-control-md" 
                            value = "' . $value . '"    
                            name = "' . $name . '"    
                            placeholder="' . $placeholder . '">
                    </div>
           </div>';
    echo $first . $last;
}

function getNumberInput($size, $label, $placeholder, $name, $value, $step, $min, $max, $required, $disabled)
{
    $size = $size ? $size : 4;
    $label = $label ? $label : "label";
    $placeholder = $placeholder ? $placeholder : "0";
    $name = $name ? $name : "name";
    $step = $step ? $step : "1";
    $step = $step ? $step : "1";
    $min = $min ? $min : 0;
    $max = $max ? $max : 1000000;
    $value = $value ? $value : "";
    $required = $required ? $required : false;
    $disabled = $disabled ? $disabled : false;

    $first = '<div class="col-sm-' . $size . '">
                    <div class="form-group">
                        <label>' . $label . '</label>
                            <input ';
    $required = $required ? " required " : "";
    $disabled = $disabled ? " disabled " : "";
    $first = $first . $required;
    $first = $first . $disabled;

    $last = 'type="number"
                            class="form-control form-control-md" 
                            name = "' . $name . '"    
                            value = "' . $value . '"    
                            step = "' . $step . '"
                            min = "' . $min . '"
                            max = "' . $max . '"
                            placeholder="' . $placeholder . '">
                    </div>
           </div>';
    echo $first . $last;

}

function getTextHidden($name, $value)
{
    echo '<input type="hidden" name="' . $name . '" value="' . $value . '"/>';
}

function getInputFile($size, $name, $label, $isLabelAlso,$required, $disabled)
{
    $size = $size ? $size : 4;
    $label = $label ? $label : "label";
    $name = $name ? $name : "name";
    $required = $required ? $required : false;
    $disabled = $disabled ? $disabled : false;


    $first = '<div class="col-sm-' . $size . '">
                    <div class="form-group">';
    if ($isLabelAlso) {
        $first = $first . '<label style="color: #0c84ff; font-weight: 500">Resmi güncellemek için Resim seçiniz</label> <br>';
    }


    $first = $first . '<label>' . $label . ' </label>
                        <div>
                            <input ';
    $required = $required ? " required " : "";
    $disabled = $disabled ? " disabled " : "";
    $first = $first . $required;
    $first = $first . $disabled;

    $last = 'type="file" class=" form-group" name = "' . $name . '">
                            </div>
                    </div>
           </div>';
    echo $first . $last;


}

function getViewFile($size, $title, $path)
{
    $size = $size ? $size : 3;
    $title = $title ? $title : 3;

    $path = $path ? base_url() . $path : "#";
    echo '<div class="col-sm-' . $size . '">
                        <a href="' . $path . '" data-toggle="lightbox" data-title="' . $title . '" data-gallery="gallery">
                            <img src="' . $path . '" class="img-fluid mb-' . $size . '" alt="' . $title . '"/>
                        </a>
                    </div>';
}

function getTextArea($size, $name, $title, $placeHolder, $rows, $value, $required,$disabled)
{
    $size = $size ? $size : 12;
    $title = $title ? $title : 3;
    $placeHolder = $placeHolder ? $placeHolder : "Giriş Yapın";
    $rows = $rows ? $rows : 3;
    $value = $value ? $value : "";
    $name = $name ? $name : "";


    $first = '<div class="col-sm-' . $size . '"><div>
    <label>' . $title . '</label>
    <textarea ';

    $required = $required ? " required " : "";
    $disabled = $disabled ? " disabled " : "";
    $first = $first . $required;
    $first = $first . $disabled;

    $first = $first . ' name="' . $name . '" class="form-control" rows="' . $rows . '" placeholder="' . $placeHolder . '">' . $value . '</textarea>
    </div></div>';

    echo $first;
}

?>
