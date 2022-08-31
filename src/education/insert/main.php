

<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("educationInsert","educationInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Eğitim Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Okul Adı", "", "title", '', false, false);
                    getTextArea(12, "Açıklama", "", "description", 3, '', false, false);
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
                    getTextInput(4, "Okul Adı", "", "titleE", '', false, false);
                    getTextArea(12, "Açıklama", "", "descriptionE", 3, '', false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php

            getDatetime(4,"Başlangıç","startDate","",false,false);
            getDatetime(4,"Bitiş","finishDate","",false,false);
            getInputFile(4, "image", "Okul Resim", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


