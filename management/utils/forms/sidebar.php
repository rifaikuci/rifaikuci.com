<?php

function menuTreeTitle($title, $classIcon)
{
    $title = $title ? $title : "Dashboard";
    $classIcon = $classIcon ? $classIcon : "fas fa-tachometer-alt";

    echo ' <a href="#" class="nav-link">
                <i class="nav-icon ' . $classIcon . '"></i>
                <p>'
        . $title .
        '<i class="right fas fa-angle-left"></i>
                </p>
            </a>';
}

function menuTreeSubTitle($title, $classIcon, $link, $target,$badge)
{
    $title = $title ? $title : "Alt Title 1";
    $classIcon = $classIcon ? $classIcon : "fas fa-tachometer-alt";
    $target = $target ? $target : "_parent";
    $badge = $badge ? $badge : "";
    $active = $link ?  isUrlActive($link) > 0 ? "active" : "" : "";
    $link = $link ? base_url_back().$link : base_url_back()."#";

    echo '<li class="nav-item">
            <a href="' . $link . '" class="nav-link '.$active.'" target="' . $target . '">
                <i class="nav-icon ' . $classIcon . '"></i>
                <p>' . $title . '</p>
                '.$badge.'
            </a>
        </li>';
}

function menuLabel($title,$color)
{
    $title = $title ? $title : "Alt Title 1";
    $color = $color ? $color : "";

    echo '  <li class="nav-header text-'.$color.'">'.$title.'</li>';

}

function badge($title, $type)
{
    $title = $title ? $title : "";
    $type = $type ? $type : "danger";

    return '<span class="right badge badge-'.$type.'">'.$title.'</span>';
}



function menuTitleWithDot($title,$color, $link,$pageType) {
    $title = $title ? $title : "";
    $color = $color ? $color : "";
    $link = $link ? $link : "#";
    $pageType = $pageType ? $pageType : "";


    echo '<li class="nav-item">
                    <a href="'.$link.'" target="'.$pageType.'" class="nav-link">
                        <i class="nav-icon far fa-circle text-'.$color.'"></i>
                        <p class="text">'.$title.'</p>
                    </a>
                </li>';
}

?>