<?php

function insert($data, $table)
{
    $sql = "INSERT INTO " . $table . "(";
    $keys = "";
    $values = "";

    foreach ($data as $key => $value) {
            $keys = $keys . $key . ", ";
            if($value != '') {
                $value = str_replace("'","`",$value);
                $values = $values . "'$value'" . ", ";
            }else {
                $values = $values . 'NULL' . ", ";
            }
    }
    $keys = rtrim($keys, " ,");
    $values = rtrim($values, " ,");

    $sql = $sql . $keys . ') VALUES (' . $values . ')';
    return $sql;

}

function update($data, $table, $id) {

    $sql  =  "UPDATE $table set ";
    $sira = 0;
    foreach ($data as $key => $value) {

            $sira++;
            $value = str_replace("'","`",$value);
            $sql = $sql. "$key = '$value',"  ;
    }
    $sql = rtrim($sql,",");
    $sql = $sql . " WHERE id = ". $id;

    // yapılmasının değeri eğer set 'ten sonra tamam boş geliniyorsa engellemek yoksa sql çalıştırılmaz.
    if ($sira > 0) {
        return  $sql;
    }  else {
        return "no_update";
    }
}

function delete($id, $table) {
    $sql = "DELETE FROM $table where id = '$id'";
    return $sql;
}

function getDataRow ($id, $table, $db) {
    $sql = "SELECT * FROM $table where id = '$id'";
    $result = mysqli_query($db, $sql)->fetch_assoc();

    return $result;

}
function getTableColumns($table, $db)
{
    $sql = "SHOW COLUMNS FROM $table";
    $getColumns = mysqli_query($db, $sql);

    $columns = array();
    while ($row = mysqli_fetch_array($getColumns)) {
        array_push($columns, $row['Field']);
    }
    return $columns;
}

function getAllData($table, $limit, $db)
{
    $columns = getTableColumns($table, $db);


    if($limit) {
        $sql = "SELECT * FROM $table order by id LIMIT $limit ";;

    } else {
        $sql = "SELECT * FROM $table order by id ";;

    }

    $result = $db->query($sql);
    $data = array();
    $counter = 0;
    while ($row = $result->fetch_array()) {
        $counter ++;
        $item = null;
        for ($i = 0; $i < count($columns); $i++) {
            $item[$columns[$i]] = $row[$columns[$i]];
        }
        $item['counter'] = "#".$counter;
        array_push($data,$item);
    }

    return $data;
}

?>