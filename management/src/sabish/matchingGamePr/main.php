<?php
$row = getDataRow(1, 'sabishMatchingGamePr', $db);

?>

<section class="content">
    <?php statusAlert(); ?>


    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("matchingGamePrUpdate", 1);
        getTextHidden("deleteFile", isset($row['image']) && $row['image'] ?  $row['image'] : '');
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Eşleştirme Oyunu (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getInputFile(5, "image", "Image-Cover", false, false, false);
                    if (isset($row['image']) && $row['image'])
                        getViewFile(3, "Görüntülemek için Tıklayın", $row['image']);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>


        <div class="card-footer">
            <?php getButton("btn btn-warning", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


