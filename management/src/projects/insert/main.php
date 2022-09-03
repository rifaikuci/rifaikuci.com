

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("projectsInsert","projectsInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Proje Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(5, "Proje Adı", "", "title", '', false, false);
                    getCKEditor(12,"Proje Detayı","","detail","",false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", '', false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "description", 3, '', false, false);
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
                    getTextInput(5, "Proje Adı", "", "titleE", '', false, false);
                    getCKEditor(12,"Proje Detayı","","detailE","",false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", '', false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "descriptionE", 3, '', false, false);
                    ?>


                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getTextInput(4, "Link", "", "link", '', false, false);
            getSelect(4, $TYPE_PROJECT, "Kategori", "type", '', false, false,false,false);

            getDatetime(4,"Başlangıç","startDate","",false,false);
            getDatetime(4,"Bitiş","finishDate","",false,false);
            getInputFile(4, "image", "Resim", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


