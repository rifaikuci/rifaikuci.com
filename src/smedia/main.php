<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("smedia", $db);
    $isVisibleColumn = ["counter", "title"];
    $columnName = [ "#", "Sosyal Medya Hesap İsmi"];


    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,
        "Sosyal Medya Hesapları",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


