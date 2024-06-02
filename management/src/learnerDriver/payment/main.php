<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'learnerDriver', $db);

    $sqlPayment  = "SELECT SUM(paymentPrice) as toplam FROM `learnerDriverPayment` WHERE learnerDriverID = $id";
    $result = mysqli_query($db, $sqlPayment)->fetch_assoc();
    $toplam = $result['toplam'];

    $kalan = $row['debit'] - $toplam;

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("learnerDriverPayment", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Sürücü Ödeme</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("learnerDriverId", $id);
                    getTextInput(5, "Ad Soyad", "", "shortName", $row['shortName'], false, true);
                    getSelect(5, $PAYMENT_TYPE, "Ödeme Türü", "paymentType", '', false, false,true,false);

                    getDatetime(5, "Ödeme Tarihi", "transactionDate", "", true, false);
                    getNumberInput(5, "Ödenecek Tutar", "", "paymentPrice", $kalan, 1, 0, $kalan, true, false);
                    getTextInput(10, "Açıklama", "", "description", "", false, false);


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


