<?php

function getButton($style, $align, $title, $name, $disabled ){
    //align right ve left alabilir
    $style = $style ? $style : "btn btn-outline-dark";
    $title = $title ? $title : "Title";
    $name = $name ? $name : "";
    $disabled = $disabled ? $disabled : false;
    if($align) {
        $style = $style . " float-".$align;
    }
    $first = '<button';
    $disabled = $disabled ? " disabled " : "";
    $first = $first . $disabled;

    $last =  ' name="'.$name.'" type="submit" class="'.$style.'">'. $title.'</button>';
    echo $first.$last;
}
?>