<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'certificate', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("certificateUpdate", $id);
        getTextHidden("deleteFile", isset($row['image']) ? $row['image'] : "");

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sertifika Listesi (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Sertifika Adı", "", "title", $row['title'], false, false);
                    getTextArea(12, "Detay", "", "description", 3, $row['description'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sertifika Listesi (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Sertifika Adı", "", "titleE", $row['titleE'], false, false);
                    getTextArea(12, "Detay", "", "descriptionE", 3, $row['descriptionE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
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


