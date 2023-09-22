<section class="content">
    <?php statusAlert(); ?>

    <?php

    $sql = "SELECT mH.id AS id, mH.count AS count,  DATEDIFF(mH.sellDate, mL.buyDate) + 1  AS diffDay, s.id as stockItemId,shortName
FROM stockListHistory mH
         INNER JOIN myStockList mL ON mH.myStockListId = mL.id
         INNER JOIN stockItem s on s.id = mL.stockItemId";


    $result = $db->query($sql);
    $data = array();
    $counter = 1;
    $sumClearAmount = 0;
    while ($row = $result->fetch_array()) {

        $tempItem = null;

        $tempItem['clearAmount'] = number_format(
            stockDailyClear($row['stockItemId'], $db), 6);
        $tempItem['shortName'] = $row['shortName'];
        $tempItem['id'] = $row['id'];
        $tempItem['count'] = $row['count'];
        $tempItem['diffDay'] = $row['diffDay'];
        $tempItem['counter'] = $counter;

        array_push($data, $tempItem);
        $sumClearAmount = $sumClearAmount + $tempItem['clearAmount'];
        $counter++;
    }

    $isVisibleColumn = ["counter", "shortName", "count", 'diffDay', 'clearAmount'];
    $columnName = ["#", "Hisse", "Lot", 'Gün', 'Tutar'];

    ?>
    <div class="row">
        <div class="col-12" style="text-align: center">

            <h3 style="color: #0c84ff">
                Toplan Arındırma Tutarı : <?php echo $sumClearAmount; ?>
            </h3>
        </div>
    </div>
    <?php getTable($data, $isVisibleColumn, $columnName,
        false, false, true, false,
        "Arıdndırmalar",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


