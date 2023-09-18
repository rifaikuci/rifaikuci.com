<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("stock",'', $db);

    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['avarage'] =
            number_format(
            stockDailyClear($data[$i]['bValue'], $data[$i]['cValue'], $data[$i]['totalLot'], $data[$i]['month']), 6 );

    }
    $isVisibleColumn = ["counter", "shortName","fullName","avarage"];
    $columnName = [ "#", "Kısa Adı", "Full Adı", "GAP"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,
        "Hisse Senetleri Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


