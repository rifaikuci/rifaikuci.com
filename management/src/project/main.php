<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("tblProject",'', $db);
    $isVisibleColumn = ["counter", "title", "content", "keywords", "noticeDate"];
    $columnName = [ "#", "Title", "Content", "Keywords", "İlan Tarihi"];

    for ($i = 0; $i<count($data); $i++) {
        $data[$i]['noticeDate'] = dateString($data[$i]['noticeDate']);
        $data[$i]['content'] = wordSplice($data[$i]['content'],2);
    }
    ?>
    <?php getTable($data, $isVisibleColumn, $columnName,
        true,true, true, true, false,
        "Projelerim",
        "",
        "",
        "",
        "",
        "",
        ""); ?>
</section>


