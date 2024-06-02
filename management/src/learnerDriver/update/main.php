<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'learnerDriver', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("learnerDriverUpdate", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Sürücü Bilgi Güncelleme</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("learnerDriverPayment", $id);
                    getTextInput(4, "Ad Soyad", "", "shortName", $row['shortName'], false, false);
                    getDatetime(3, "Doğum Tarihi", "birthDate", $row['birthDate'], false, false);
                    getTextInput(4, "Telefon No", "05555555555", "phone", $row['phone'], false, false);
                    getTextInput(4, "T.C. Kimlik No", "11111111110", "identityNo", $row['identityNo'], false, false);
                    getDatetime(3, "Kayıt Tarihi", "registerDate", $row['registerDate'], false, false);
                    getNumberInput(4, "Kayıt Tutarı", "1232", "debit", $row['debit'], 1, 0, "", false, false);

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


