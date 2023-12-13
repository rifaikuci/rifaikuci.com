<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'sabishMatchingGameCategory', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("matchingGameUpdate", $id);
        getTextHidden("deleteFile", isset($row['image']) ? $row['image'] : "");

        ?>

        <div class="card card-dark">
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Kategori Adı", "", "title", $row['title'], true, false);
                    ?>

                </div>
                <div class="row">

                    <?php
                    getInputFile(4, "image", "Cover-Image", true, false, false);

                    if (isset($row['image']) && $row['image'])
                        getViewFile(4, "Cover-Image", $row['image']);

                    ?>

                </div>
            </div>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


