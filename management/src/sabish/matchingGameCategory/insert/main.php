<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("matchingGameCategoryInsert", "matchingGameCategoryInsert");
        ?>
        <div class="card card-dark">
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Kategori Adı", "", "title", '', true, false);
                    ?>

                </div>
                <div class="row">

                    <?php
                    getInputFile(4, "image", "Cover-Image", false, false, false);
                    ?>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


