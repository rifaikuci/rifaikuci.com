

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("certificateInsert","certificateInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sertifika Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Sertifika Adı", "", "title", '', false, false);
                    getTextArea(12, "Detay", "", "description", 3, '', false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sertifika Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Sertifika Adı", "", "titleE", '', false, false);
                    getTextArea(12, "Detay", "", "descriptionE", 3, '', false, false);
                    ?>


                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php

            getDatetime(3,"Başlangıç","startDate","",false,false);
            getDatetime(3,"Bitiş","finishDate","",false,false);
            getInputFile(3, "image", "Okul Resim", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


