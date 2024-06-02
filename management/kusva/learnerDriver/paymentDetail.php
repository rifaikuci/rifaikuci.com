
<?php

if (file_exists("utils/index.php")) {
    require_once "utils/index.php";
} else if (file_exists("../utils/index.php")) {
    require_once "../utils/index.php";
} else if (file_exists("../../utils/index.php")) {
    require_once "../../utils/index.php";
} else if (file_exists("../../../utils/index.php")) {
    require_once "../../../utils/index.php";
} else if (file_exists("../../../../utils/index.php")) {
    require_once "../../../../utils/index.php";
} else if (file_exists("../../../../../utils/index.php")) {
    require_once "../../../../../utils/index.php";
}

$learenerDriverId = $_POST['driverId'];

$sql = "SELECT * FROM learnerDriverPayment where learnerDriverId = '$learenerDriverId'";
$result = $db->query($sql);

$sql2 = "SELECT sum(paymentPrice) as toplam FROM learnerDriverPayment l where learnerDriverId = '$learenerDriverId' group by learnerDriverId";
 $rowToplam = mysqli_query($db, $sql2)->fetch_assoc();


$driver = getDataRow($learenerDriverId, 'learnerDriver', $db);
$kalan  = $driver['debit'] -  $rowToplam['toplam'];
?>

<div style="text-align: center">
    <h4 style="color: #0e84b5">
        Ödeme Geçmişi
    </h4>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label style="color: #0b2e13">Sürücü Adı : <?php echo $driver['shortName']?> </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label style="color: #0b2e13">Kayıt Ücreti : <?php echo sayiFormatla($driver['debit'],2)?>  </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label style="color: #0b2e13">Toplam Ödenen Ücreti : <?php echo sayiFormatla($rowToplam['toplam'],2)?> </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label style="color: #0b2e13">Kalan : <?php echo sayiFormatla($kalan,2)?> </label>
        </div>
    </div>
</div>

<div class="card-body table-responsive p-0">


    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
            <th>Ödeme Tipi</th>
            <th>Ödeme Tarihi</th>
            <th>Açıklama</th>
            <th>Tutar</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_array()) { ?>
            <tr>
                <td><?php  echo $PAYMENT_TYPE[$row['paymentType']];?></td>
                <td><?php  echo onlyDate($row['transactionDate']);?></td>
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo sayiFormatla($row['paymentPrice'], 2) .  " TL";?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>



