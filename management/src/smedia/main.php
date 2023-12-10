<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("smedia",'', $db);
    $isVisibleColumn = ["counter", "title"];
    $columnName = [ "#", "Sosyal Medya Hesap İsmi"];


    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Sosyal Medya Hesapları",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


