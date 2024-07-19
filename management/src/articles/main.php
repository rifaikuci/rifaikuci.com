<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("projects",'', $db);
    $isVisibleColumn = ["counter","title"];
    $columnName = [ "#", "Proje Adı"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Projeler",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


