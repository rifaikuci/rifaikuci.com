

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("experienceInsert","experienceInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Deneyim Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Unvan", "", "title", '', false, false);
                    getTextInput(3, "Firma Adı", "", "firmName", '', false, false);
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
                <h3 class="card-title">Deneyim Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Unvan", "", "titleE", '', false, false);
                    getTextInput(3, "Firma Adı", "", "firmNameE", '', false, false);
                    getTextArea(12, "Açıklama", "", "descriptionE", 3, '', false, false);
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
            getInputFile(3, "image", "Resim", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


