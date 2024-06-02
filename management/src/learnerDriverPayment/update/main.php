<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $row = getDataRow($id, 'learnerDriverPayment', $db);

    $user = getDataRowByColumn($row['learnerDriverId'], 'learnerDriver', $db, "id");

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("learnerDriverPaymentUpdate", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Sürücü Bilgi Güncelleme</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("learnerDriverPaymentUpdate", $id);
                    getTextInput(4, "Ad Soyad", "", "shortName", $user['shortName'], false, true);
                    getDatetime(4, "İşlem Tarihi", "transactionDate", $row['transactionDate'], false, false);
                    getSelect(4, $PAYMENT_TYPE, "Ödeme Türü", "paymentType", '', false, $row['paymentType'],true,false);
                    getNumberInput(4, "Ödenen Tutarı", "paymentPrice", "paymentPrice", $row['paymentPrice'], 1, 0, "", false, false);
                    getTextInput(8, "Açıklama", "", "description", $row['description'], false, false);


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


