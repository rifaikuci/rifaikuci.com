<?php
$row = getDataRow(1, 'info', $db);

?>

<section class="content">
    <?php statusAlert(); ?>


    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("infoUpdate",1);
        getTextHidden("deleteFile", isset($row['image']) ? $row['image'] : "");

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Genel Ayar Bilgileri (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput("2", "Ad Soyad", "Ad Soyad", "name", $row['name'], false, false);
                    getTextInput("2", "Unvan ", "", "title", $row['title'], false, false);
                    getTextInput("2", "Doğum Yeri ", "", "birthPlace", $row['birthPlace'], false, false);
                    getTextInput("2", "Adres", "", "address", $row['address'], false, false);
                    getTextInput("2", "İl", "", "city", $row['city'], false, false);
                    getTextInput("2", "İlçe", "", "district", $row['district'], false, false);
                    getCKEditor(12, "Alt Açıklama", '', "subAbout", $row['subAbout'], false, false);
                    getCKEditor(12, "Öz geçmiş", '', "about", $row['about'], false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywords", $row['keywords'], false, false);
                    getTextArea(12, "Meta Açıklama", "Açıklama", "description", 3, $row['description'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Genel Ayar Bilgileri (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput("2", "Ad Soyad", "Ad Soyad", "nameE", $row['nameE'], false, false);
                    getTextInput("2", "Unvan ", "", "titleE", $row['titleE'], false, false);
                    getTextInput("2", "Doğum Yeri ", "", "birthPlaceE", $row['birthPlaceE'], false, false);
                    getTextInput("2", "Adres", "", "addressE", $row['addressE'], false, false);
                    getTextInput("2", "İl", "", "cityE", $row['cityE'], false, false);
                    getTextInput("2", "İlçe", "", "districtE", $row['districtE'], false, false);
                    getCKEditor(12, "Alt Açıklama", '', "subAboutE", $row['subAboutE'], false, false);
                    getCKEditor(12, "Öz geçmiş", 'Açıklama', "aboutE", $row['aboutE'], false, false);
                    getTextInput(12, "Meta Anahtar Kelimeler", "", "keywordsE", $row['keywordsE'], false, false);
                    getTextArea(12, "Meta Açıklama", "açıklam", "descriptionE", 3, $row['descriptionE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getTextInput(12, "Harita Linki (iframe)", "", "maps", $row['maps'], false, false);

            getDatetime(2, "Doğum Tarihi", "birthdate", $row['birthdate'], false, false);
            getTextInput("2", "Telefon", "", "phone1", $row['phone1'], false, false);
            getTextInput("2", "Telefon ", "", "phone2", $row['phone2'], false, false);
            getTextInput("2", "Mail ", "", "mail", $row['mail'], false, false);
            getTextInput(3, "Link ", "", "link", $row['link'], false, false);

            getInputFile(5, "image", "Profil Resmi", true, false, false);
            if ($row['image'])
                getViewFile(5, "Resim", $row['image']);

            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


