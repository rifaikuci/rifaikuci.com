<?php

function getTable($data, $isVisibleColumn, $columnName,
                  $isInsert,$isView, $isDelete,$isUpdate,
                  $title, $titleBackground, $titleText, $rowBackground, $rowText, $tableHeaderBackground, $tableHeaderText)
{
    $title = $title ? $title : "";
    $titleBackground = $titleBackground ? $titleBackground : "";
    $titleText = $titleText ? $titleText : "";

    $rowBackground = $rowBackground ? $rowBackground : "";
    $rowText = $rowText ? $rowText : "";

    $tableHeaderBackground = $tableHeaderBackground ? $tableHeaderBackground : "";
    $tableHeaderText = $tableHeaderText ? $tableHeaderText : "";


    $return = '<div class="card ' . $titleBackground . '">
        <div class="card-header">
            <h3 class="card-title ' . $titleText . '">' . $title . '</h3>
        </div>
        <div class="card-body">';

    if ($isInsert) {
        $return = $return . '
             <div style="text-align: right; margin-bottom: 5px; margin-left: 30px;">
                <a href="insert/" class="btn btn-primary"><i class="fa fa-plus">
                        Ekle</i></a>
            </div>
            ';
    }


    $return = $return . ' <table id="example1" class="table table-bordered table-striped ' . $rowBackground . ' ' . ' ' . $rowText . ' ">
                <thead>
                <tr class="' . $tableHeaderText . ' ' . $tableHeaderBackground . '">';
    for ($i = 0; $i < count($columnName); $i++) {
        $return = $return . '<th>'.$columnName[$i].'</th>';
    }
    if($isView || $isDelete ||$isUpdate) {
        $return = $return. '<th style="text-align: center">İşlem</th>';
    }
    $return = $return . '</tr>
                </thead>
               <tbody>';

    for ($i = 0; $i < count($data); $i++) {
       $return = $return. ' <tr>';
       for($k = 0; $k < count($isVisibleColumn) ; $k++) {

        $return = $return . '<td>'.$data[$i][$isVisibleColumn[$k]].'</td>';
       }
        $return =  $return .'<td style="text-align: center">';

        if($isView || $isDelete ||$isUpdate) {
            $id = $data[$i]['id'];
            if($isView) {
                $return = $return . '<a style="margin-right:  15px" href="view/?id='.$id.'"
                                            class="btn btn-outline-primary"><i class="fa fa-eye"></i>
                                            </a>';
            }

            if($isUpdate) {
                $return = $return . '<a style="margin-right:  15px" href="update/?id='.$id.'"
                                            class="btn btn-outline-success"><i class="fa fa-edit"></i>
                                            </a>';
            }


            if($isDelete) {

                $cur_dir = getcwd();
                $cur_dir = explode("/",$cur_dir);
                $tempKeyword = $cur_dir[count($cur_dir)-1]."Delete";

                $return = $return . '<a style="margin-right:  15px" href="../../kusva/?'.$tempKeyword.'='.$id.'"
                                            class="btn btn-outline-danger"><i class="fa fa-trash"></i>
                                            </a>';
            }
            $return = $return . '</td>';
        }
       $return = $return. '</tr>';

    }

                $return = $return . '</tbody>
            </table>
        </div>
    </div>';


    echo $return;
}

?>