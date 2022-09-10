<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("certificate",'', $db);
    $isVisibleColumn = ["counter","title", "description",];
    $columnName = [ "#", "Sertifika Adı", "Detay"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,
        "Sertifika Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


