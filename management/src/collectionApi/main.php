<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("collectionApi",'', $db);
    $isVisibleColumn = ["counter","mail"];
    $columnName = [ "#", "Mail"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Api Key Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


