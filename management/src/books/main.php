<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("books",'', $db);
    $isVisibleColumn = ["counter","name", "author","publisher","printing"];
    $columnName = [ "#", "Kitap Adı", "Yazar", "Yayınevi", "Basım Yılı"];

    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Kitap Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


