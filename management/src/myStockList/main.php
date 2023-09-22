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

    $sqlSumStock = "SELECT stockItemId, shortName, sum(count) as count FROM myStockList m
                        inner join stockItem s on s.id = m.stockItemId
                        group by stockItemId";
    $sumGroupResult =  mysqli_query($db, $sqlSumStock);

    ?>

    <div class="row" style="margin-bottom: 30px">
        <?php
        while ($item = $sumGroupResult->fetch_array()) { ?>
            <div class="col-2" style="margin:15px">
                <button class="btn" style="background-color: #0c84ff; padding: 15px; color: white"><?php echo $item['shortName']  ." <br> ". $item['count']  ?></button>
            </div>

            <div class="col-2" style="margin:15px">
                <button class="btn" style="background-color: #0c84ff; padding: 15px; color: white"><?php echo $item['shortName']  ." <br> ". $item['count']  ?></button>
            </div>

            <div class="col-2" style="margin:15px">
                <button class="btn" style="background-color: #0c84ff; padding: 15px; color: white"><?php echo $item['shortName']  ." <br> ". $item['count']  ?></button>
            </div>

        <?php } ?>



        </div>

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


