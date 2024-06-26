
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

$groupId = $_POST['groupDetailShow'];

$sql =  "SELECT * FROM learnerDriver where groupId = '$groupId'";
$result = $db->query($sql);

if ($result) {
    $countUser = $result->num_rows;
}

$group = getDataRow($groupId, 'learnerDriverGroup', $db);

?>

<div style="text-align: center">
    <h4 style="color: #0e84b5">
        Grup Detayı
    </h4>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label style="color: #0b2e13">Grup Adı : <?php echo $group['groupName']?> </label>
        </div>
    </div>


    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label style="color: #0b2e13">Kayıtlı Aday Sayısı : <?php echo $countUser; ?>  </label>
        </div>
    </div>

    <div class="col-sm-6" style="text-align: right" >
        <a href="<?php echo base_url_back() . "kusva/learnerDriverPdf/?group_detail=$groupId"?>" target="_blank" class="btn btn-outline-success" >Grup Bilgisi Yazdır
        </a>
        <a href="<?php echo base_url_back() . "kusva/learnerDriverPdf/?group_payment_detail=$groupId"?>" target="_blank" class="btn btn-outline-primary" >Grup Detayı Yazdır
        </a>
    </div>
</div>


<div class="card-body table-responsive p-0">


    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
            <th>Sürücü Adı</th>
            <th>Kayıt Tarihi</th>
            <th>Kayıt Ücreti</th>
            <th>Ödenen Ücret</th>
            <th>Kalan Ücret</th>
        </tr>
        </thead>
        <tbody>
        <?php $sira = 1;
        while ($row = $result->fetch_array()) {
            $learnerDriverId = $row['id'];
            $odenenSql = "select SUM(paymentPrice) as odenen from learnerDriverPayment where learnerDriverId  = '$learnerDriverId'";
            $result2 = mysqli_query($db, $odenenSql)->fetch_assoc();
            $odenen = $result2['odenen'];
            $kalan = $row['debit']  - $odenen;
            ?>
            <tr>
                <td><?php echo $row['shortName']; ?></td>
                <td><?php echo onlyDate($row['registerDate']); ?></td>
                <td><?php echo sayiFormatla($row['debit'],0) . " ₺"; ?></td>
                <td><?php echo sayiFormatla($odenen,0) . " ₺"; ?></td>
                <td><?php echo sayiFormatla($kalan,0) . " ₺"; ?></td>

            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>



