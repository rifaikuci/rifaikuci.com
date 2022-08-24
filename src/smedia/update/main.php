<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'smedia', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("smediaUpdate", $id);
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sosyal Medya Hesap Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(2, "Hesap Adı", "", "title", $row['title'], false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", $row['keywords'], false, false);
                    getTextArea(12, "Meta Açıklama", "", "description", 3, $row['description'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sosyal Medya Hesap Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(2, "Hesap Adı", "", "titleE", $row['titleE'], false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", $row['keywordsE'], false, false);
                    getTextArea(12, "Meta Açıklama", "", "descriptionE", 3, $row['descriptionE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php

            getTextInput(2, "Class Adı", "", "class", $row['class'], false, false);
            getInputFile(4, "image", "Hesap Iconu", true, false, false);
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


