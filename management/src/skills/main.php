<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("skills",'', $db);
    $isVisibleColumn = ["counter","name", "level"];
    $columnName = [ "#", "Özellik adı","Seviye"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,
        "Yetenekler",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


