<?php

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);
header('Content-Type: application/json');


$tableNameSabishName = "sabishMatchingGameCategory";
$tableGaleria = "galeria";


//Categoryilerin Listelenmesi
if (isset($data) && isset($data['method']) && $data['method'] == "categoryList") {
    $categoryList = array();

    $sql = "SELECT * FROM " .  $tableNameSabishName ." where active = 1";
    $result = $db->query($sql);


    while ($row = $result->fetch_array()) {
        $category = null;
        $category['id'] = $row['id'];
        $category['title'] = $row['title'];
        $category['insertDate'] = $row['insertDate'];
        $category['updateDate'] = $row['updateDate'];

        array_push($categoryList, $category);
    }

    echo json_encode($categoryList);
}


//Seçilen kategorilere ait resimlerin getirilmesi
if (isset($data) && isset($data['method']) && $data['method'] == "categoryImages") {
    $imageList = array();

    $categoryId = $data['categoryId'] ? $data['categoryId'] : 0;
    $limit = $data['limit'] ? $data['limit'] : 4;
    $sql = "SELECT * FROM " . $tableGaleria . " where productId = " . $categoryId. " and tblName= '" . $tableNameSabishName. "'  ORDER BY RAND() LIMIT " . $limit;

    $result = $db->query($sql);

    while ($row = $result->fetch_array()) {
        $image = null;
        $image['image'] = base_url_back() . $row['image'];

        array_push($imageList, $category);
    }

    echo json_encode($imageList);
}



