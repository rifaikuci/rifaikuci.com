<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'projects', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("projectsUpdate", $id);
        getTextHidden("deleteFile", isset($row['image']) ? $row['image'] : "");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Proje Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(5, "Proje Adı", "", "title", $row['title'], false, false);
                    getCKEditor(12,"Proje Detayı","","detail",$row['detail'],false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", $row['keywords'], false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "description", 3, $row['description'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Proje Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(5, "Proje Adı", "", "titleE", $row['titleE'], false, false);
                    getCKEditor(12,"Proje Detayı","","detailE",$row['detailE'],false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", $row['keywordsE'], false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "descriptionE", 3, $row['descriptionE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getTextInput(4, "Link", "", "link", $row['link'], false, false);
            getSelect(4, $TYPE_PROJECT, "Kategori", "type", '', false, $row['type'],false,false);

            getDatetime(4,"Başlangıç","startDate",$row['startDate'],false,false);
            getDatetime(4,"Bitiş","finishDate",$row['finishDate'],false,false);
            getInputFile(4, "image", "Resim", true, false, false);

            if ($row['image'])
                getViewFile(4, "Resim", $row['image']);
            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


