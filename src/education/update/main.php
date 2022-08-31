<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'education', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("educationUpdate", $id);
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Eğitim Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Okul Adı", "", "title", $row['title'], false, false);
                    getTextArea(12, "Açıklama", "", "description", 3, $row['description'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Eğitim Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Okul Adı", "", "title", $row['titleE'], false, false);
                    getTextArea(12, "Açıklama", "", "description", 3, $row['descriptionE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php

            getDatetime(3,"Başlangıç","startDate",$row['startDate'],false,false);
            getDatetime(3,"Bitiş","finishDate",$row['finishDate'],false,false);
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


