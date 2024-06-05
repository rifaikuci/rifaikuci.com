<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("learnerDriverGroup",'', $db);
    $isVisibleColumn = ["counter", "groupName", "insertDate"];
    $columnName = [ "#", "Grup Adı", "Kayıt Tarihi"];

    for ($i = 0; $i<count($data); $i++) {
        $data[$i]['insertDate'] = dateString($data[$i]['insertDate']);
    }
    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,false, true, true, false,
        "Grup Listesi",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


