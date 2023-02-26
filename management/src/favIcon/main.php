<?php
$row = getDataRow(1, 'favIcon', $db);

?>

<section class="content">
    <?php statusAlert(); ?>


    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("favIconUpdate", 1);
        getTextHidden("deleteFile", $row['image']);
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Fav Icon Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Title", "", "title", $row['title'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Fav Icon Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Title", "", "titleE", $row['titleE'], false, false);
                    ?>
                </div>
                <div class="row">
                    <?php

                    getInputFile(5, "image", "Fav Icon Resmi", true, false, false);
                    if ($row['image'])
                        getViewFile(5, "Fav Icon", $row['image']);

                    ?>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


