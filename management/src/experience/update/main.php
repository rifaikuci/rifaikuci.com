<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'experience', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("experienceUpdate", $id);
        getTextHidden("deleteFile", isset($row['image']) ? $row['image'] : "");

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Kitap Listesi (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Unvan", "", "title", $row['title'], false, false);
                    getTextInput(3, "Firma Adı", "", "firmName", $row['firmName'], false, false);
                    getCKEditor(12,"Açıklama","","description",$row['description'],false,false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Kitap Listesi (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php

                    getTextInput(3, "Unvan", "", "titleE", $row['titleE'], false, false);
                    getTextInput(3, "Firma Adı", "", "firmNameE", $row['firmNameE'], false, false);
                    getCKEditor(12,"Açıklama","","descriptionE",$row['descriptionE'],false,false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getTextInput(3, "Firma Linki", "", "link", $row['link'], false, false);
            getDatetime(2,"Başlangıç","startDate",$row['startDate'],false,false);
            getDatetime(2,"Bitiş","finishDate",$row['finishDate'],false,false);
            getInputFile(3, "image", "Resim", true, false, false);

            if ($row['image'])
                getViewFile(3, "Resim", $row['image']);
            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


