<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("learnerDriver",'', $db);
    $isVisibleColumn = ["counter","shortName", "shortName", "shortName", "shortName"];
    $columnName = [ "#", "Sürücü Adı", "Kayıt Tarihi", "Kalan Borç", "Ödenen Borç"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Sürücü Adayları Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


