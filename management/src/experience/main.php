<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("experience",'', $db);
    $isVisibleColumn = ["counter","firmName", "title"];
    $columnName = [ "#", "Firma Adı", "Unvan"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


