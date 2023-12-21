<?php


$json_data = file_get_contents('php://input');
header('Content-Type: application/json');


$tableMatchingGameCategory = "sabishMatchingGameCategory";
$tableMatchingGamePr = "sabishMatchingGamePr";
$tableGaleria = "galeria";



//Categoryilerin Listelenmesi
if (isset($_GET['method']) && isset($_GET['method']) && $_GET['method'] == "categoryList") {
    $categoryList = array();

    $sql = "SELECT * FROM " .  $tableMatchingGameCategory ." where active = 1";
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
if (isset($_GET['method']) && isset($_GET['method']) && $_GET['method'] == "categoryImages") {
    $imageList = array();

    $categoryId = $_GET['categoryId'] ? $_GET['categoryId'] : 0;
    $limit = $_GET['limit'] ? $_GET['limit'] : 0;
    if($limit > 0) {
        $sql = "SELECT * FROM " . $tableGaleria . " where productId = " . $categoryId. " and tblName= '" . $tableMatchingGameCategory. "'  ORDER BY RAND() LIMIT " . $limit;
    } else {
        $sql = "SELECT * FROM " . $tableGaleria . " where productId = " . $categoryId. " and tblName= '" . $tableMatchingGameCategory. "'  ORDER BY RAND()";
    }

    $category = getDataRow($categoryId, $tableMatchingGameCategory, $db);
    $gamePr = getDataRow(1, $tableMatchingGamePr, $db);

    $result = $db->query($sql);

    while ($row = $result->fetch_array()) {
        $image = null;
        $image['imageUrl'] = base_url_back() . $row['image'];
        $image['guid'] =  uniqid();
        $image['coverUrl'] = base_url_back() . $category['image'] ? $category['image'] : $gamePr['image'];

        array_push($imageList, $image);
    }

    echo json_encode($imageList);
}



