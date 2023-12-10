<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("stockItem",'', $db);

    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['avarage'] =
            number_format(
            stockDailyClear($data[$i]['id'], $db), 6 );

    }
    $isVisibleColumn = ["counter", "shortName","fullName","avarage"];
    $columnName = [ "#", "Kısa Adı", "Full Adı", "GAP"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Hisse Senetleri Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


