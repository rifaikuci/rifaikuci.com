<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("languages",'', $db);
    $isVisibleColumn = ["counter","title", "level"];
    $columnName = [ "#", "Dil", "Seviye"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,
        "Dil Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


