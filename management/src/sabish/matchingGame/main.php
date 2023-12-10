<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("sabishMatchingGameCategory",'', $db);
    $isVisibleColumn = ["counter","title"];
    $columnName = [ "#", "Kategori"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,  true,
        "Eşleştirme Kategorileri",
        "Eşleştirme Kategorileri",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


