<?php
$row = getDataRow(1, 'about', $db);

?>

<section class="content">
    <?php statusAlert(); ?>


    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("aboutUpdate", 1);
        getTextHidden("deleteFile", $row['cv']);
        getTextHidden("deleteFileE", $row['cvE']);
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Hakkımda Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Title", "", "title", $row['title'], false, false);
                    getTextInput(5, "Link", "", "link", $row['link'], false, false);
                    getTextArea(12, "Hakkımda", '', "about",3, $row['about'], false,false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", $row['keywords'], false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "description", 3, $row['description'], false, false);
                    getInputFile(5, "cv", "Cv Türkçe", false, false, false);
                    if ($row['cv'])
                        getLinkView(4,"Görüntülemek için tıklayınız",$row['cv']);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Hakkımda Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Title", "", "titleE", $row['titleE'], false, false);
                    getTextInput(5, "Link", "", "linkE", $row['linkE'], false, false);
                    getTextArea(12, "Hakkımda", '', "aboutE",3, $row['aboutE'], false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", $row['keywordsE'], false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "descriptionE", 3, $row['descriptionE'], false, false);
                    getInputFile(5, "cvE", "Cv Türkçe", false, false, false);
                    if ($row['cvE'])
                        getLinkView(4,"Görüntülemek için tıklayınız",$row['cvE']);
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


