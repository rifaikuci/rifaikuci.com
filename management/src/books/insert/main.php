

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("booksInsert","booksInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Kitap Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Kitap Adı", "", "name", '', false, false);
                    getTextInput(3, "Yazar", "", "author", '', false, false);
                    getTextInput(3, "Yayınevi", "", "publisher", '', false, false);
                    getTextArea(12, "Özet", "", "summary", 3, '', false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Kitap Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Kitap Adı", "", "nameE", '', false, false);
                    getTextInput(3, "Yazar", "", "authorE", '', false, false);
                    getTextInput(3, "Yayınevi", "", "publisherE", '', false, false);
                    getTextArea(12, "Özet", "", "summaryE", 3, '', false, false);
                    ?>


                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php

            getNumberInput(3, "Basım Yılı", "2022", "printing", '', 1, 1960,date("Y"),false,false);
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


