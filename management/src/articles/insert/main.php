

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("articlesInsert","articlesInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Yazı Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(5, "Yazı Başlık", "", "title", '', false, false);
                    getTextInput(7, "Yazı Alt Başlık", "", "subTitle", '', false, false);
                    getCKEditor(12,"Yazı Detayı","","description","",false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", '', false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "metaDescription", 3, '', false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Yazı Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(5, "Yazı Başlık", "", "titleE", '', false, false);
                    getTextInput(7, "Yazı Alt Başlık", "", "subTitleE", '', false, false);
                    getCKEditor(12,"Yazı Detayı","","descriptionE","",false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", '', false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "metaDescriptionE", 3, '', false, false);
                    ?>


                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
           
            getInputFile(4, "image", "Resim", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


