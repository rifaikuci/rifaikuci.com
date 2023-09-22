<section class="content">
    <?php statusAlert(); ?>

    <?php
    $sqlCount = "SELECT * FROM myStockList where count = 0 ";

    $resultCount = $db->query($sqlCount);

    while ($row = $resultCount->fetch_array()) {
        $tempId = $row['id'];
        $sqlMyStockListHistory = "SELECT COUNT(*) as sayi from stockListHistory where myStocklistId = '$tempId'  ";
        $resultMyStockList = mysqli_query($db, $sqlMyStockListHistory)->fetch_assoc();

        if ($resultMyStockList['sayi'] == 0) {
            $sqlDelte = delete($tempId, 'myStockList');
            mysqli_query($db, $sqlDelte);
        }
    }


    $tempData = getAllData("myStockList", '', $db);
    $data = array();
    for ($i = 0; $i < count($tempData); $i++) {
        if ($tempData[$i]['count'] > 0) {
            $tempData[$i]['shortName'] = getDataRow($tempData[$i]['stockItemId'], 'stockItem', $db)['shortName'];
            $tempData[$i]['buyDate'] = onlyDate($tempData[$i]['buyDate']);
            array_push($data, $tempData[$i]);
        }
    }
    $isVisibleColumn = ["counter", "shortName", "buyDate", "count"];
    $columnName = ["#", "Kısa Adı", "Alış Tarihi", "Adet"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true, false, false, true,
        "Senetler",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


