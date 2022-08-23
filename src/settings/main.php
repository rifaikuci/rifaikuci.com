<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("tblSettings", $db);
    $isVisibleColumn = ["counter", "name", "surname", "address", "birthdate","city"];
    $columnName = [ "#", "Ad", "Soyad", "Adres", "Doğum Tarihi", "Memleket"];


    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,true, true, true,
        "Tablo Başlık",
        "card-dark",
        "text-lime",
        "table-dark",
        "text-lime",
        "table-dark",
        "text-white"); ?>
</section>


