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

function getDataRow($id, $table, $db) {
    $sql = "SELECT * FROM $table WHERE id = ?";
    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        die("MySQL prepare statement error: " . mysqli_error($db));
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("MySQL execute statement error: " . mysqli_error($db));
    }

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null; // Or handle the case where no row is found
    }
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

function getAllDataWithSort($table, $limit, $db, $sort)
{
    $columns = getTableColumns($table, $db);
    $sort = $sort ? $sort : "asc";


    if($limit) {
        $sql = "SELECT * FROM $table order by id $sort LIMIT $limit  ";;

    } else {
        $sql = "SELECT * FROM $table order by id $sort ";;

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

function getDataRowByColumn ($id, $table, $db, $columnName = 'id') {
    $sql = "SELECT * FROM $table where ". $columnName ." = '$id'";

    $result = mysqli_query($db, $sql)->fetch_assoc();

    return $result;
}

?>