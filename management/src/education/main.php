<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("education",'', $db);
    $isVisibleColumn = ["counter","title", "description","startDate","finishDate"];
    $columnName = [ "#", "Okul Adı", "Başlangıç T.", "Bitiş T."];

    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['startDate'] = dateString($data[$i]['startDate']);
        $data[$i]['finishDate'] = dateString($data[$i]['finishDate']);
     }


    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true,
        "Eğitim Bilgileri",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


