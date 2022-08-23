<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $settings = getDataRow($id, 'tblSettings', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Güncelleme</h3>
            </div>
            <div class="card-body" id="app">

                <div class="row">
                    <?php

                    getTextInput(3, "Ad", "Ad giriniz", "name", $settings['name'], false, false);
                    getTextInput(3, "Soyad", "Soyad giriniz", "surname", $settings['surname'], false, false);
                    getTextInput(3, "Adres Giriniz", "Adres giriniz", "address", $settings['address'], false, false);
                    getTextInput(3, "Memleket Girinz", "Memleket giriniz", "city", $settings['city'], false, false);
                    getSelect(3, $dataGender, "Cinsiyet", "gender", "", false, $settings['gender'], false, false);
                    getDatetime(3, "Doğum Tarihiniz", "birthdate", $settings['birthdate'], false, false);
                    getNumberInput(3, "Yaş", 0, "age", $settings['age'], "", "", "", false, false);
                    getTextHidden("settingsUpdate", $settings['id']);
                    ?>
                </div>
                <div class="row">
                    <?php
                    getInputFile(3, "file", "Resim", false, false, true);
                    getViewFile(3, $settings['name'], $settings['image']);
                    getTextHidden("deleteFile",$settings['image']);
                    ?>
                </div>

                <div class="row">
                    <?php getTextArea(12,"description", "Açıklama Giriniz...", "Açıklama", 3,$settings['description'], true, false ); ?>
                </div>



            </div>
            <div class="card-footer">
                <?php getButton("btn btn-secondary", 'left', "Vazgeç", "", false); ?>
                <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
            </div>
        </div>
    </form>
</section>


