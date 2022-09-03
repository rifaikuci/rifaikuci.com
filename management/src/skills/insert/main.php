

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("skillsInsert","skillsInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Yetenek Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, " Özellik Adı", "", "name", '', false, false);
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
                <h3 class="card-title">Yetenek Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, " Özellik Adı", "", "nameE", '', false, false);
                    getTextArea(12, "Açıklama", "", "descriptionE", 3, '', false, false);
                    ?>


                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getTextInput(3, "Seviye", "", "level", '', false, false);
            getTextInput(3, "Class adı", "", "className", '', false, false);
            getSelect(3,$TYPE_SKILLS,"Kategori","type","",false,"",false,false);
            getInputFile(3, "image", "Okul Resim", false, false, false);


            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


