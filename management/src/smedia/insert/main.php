

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("smediaInsert","smediaInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Sosyal Medya Hesap Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(2, "Hesap Adı", "", "title", '', false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", '', false, false);
                    getTextArea(12, "Meta Açıklama", "", "description", 3, '', false, false);
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
                    getTextInput(2, "Hesap Adı", "", "titleE", '', false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", '', false, false);
                    getTextArea(12, "Meta Açıklama", "", "descriptionE", 3, '', false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php

            getTextInput(2, "Class Adı", "", "class", '', false, false);
            getTextInput(4, "Link", "", "link", '', false, false);
            getInputFile(4, "image", "Hesap Iconu", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


