<?php


$learnerDriver = getAllData("learnerDriver", "", $db);


$learnerDriverList = array();
for ($k = 0; $k < count($learnerDriver); $k++) {
    $learnerDriverList[$learnerDriver[$k]['id']] = $learnerDriver[$k]['shortName'];
}

$sql = "SELECT p.id              as id,
       p.paymentPrice    as paymentPrice,
       p.transactionDate as transactionDate,
       p.paymentType     as paymentType,
       ld.shortName as shortName
FROM learnerDriverPayment p
         inner join learnerDriver ld on p.learnerDriverId = lD.id where 1=1 ";

$paymentType = "";
$learnerDriverId = "";
$transactionDateBegin = null;
$transactionDateEnd = null;
if (isset($_GET['paymentType']) && $_GET['paymentType'] != "") {

    $paymentType = $_GET['paymentType'];
    $sql = $sql . " and p.paymentType = '$paymentType'";
}

if (isset($_GET['learnerDriverId']) && $_GET['learnerDriverId'] != "") {
    $learnerDriverId = $_GET['learnerDriverId'];
    $sql = $sql . " and ld.id = '$learnerDriverId'";
}

if (isset($_GET['transactionDateBegin']) && $_GET['transactionDateBegin'] != "" || isset($_GET['transactionDateEnd']) && $_GET['transactionDateEnd'] != "") {
    $transactionDateBegin = $_GET['transactionDateBegin'];
    $transactionDateEnd = $_GET['transactionDateEnd'];

    if( $transactionDateBegin && $transactionDateEnd) {
        $sql = $sql . " and  p.transactionDate between '$transactionDateBegin' and '$transactionDateEnd'";

    } else {
        if ($transactionDateBegin) {
            $sql = $sql . " and  (p.transactionDate >= '$transactionDateBegin' OR $transactionDateBegin IS NULL) ";
        }

        if ($transactionDateEnd) {
            $sql = $sql . " and  (p.transactionDate <= '$transactionDateEnd' OR $transactionDateEnd IS NULL)";

        }
    }

}

$sql = $sql . " order by p.transactionDate desc";

$result = $db->query($sql);

?>



<section class="content">
    <?php statusAlert(); ?>

    <form method="get" action="#">
        <div class="row">


            <?php
            getSelect(5, $learnerDriverList, "Sürücü Adayları", "learnerDriverId", '', false, $learnerDriverId, false, false);
            getSelect(5, $PAYMENT_TYPE, "Ödeme Türü", "paymentType", '', false, $paymentType, false, false);
            getDatetime(5, "Baş Tar.", "transactionDateBegin", $transactionDateBegin, false, false);
            getDatetime(5, "Bit Tar.", "transactionDateEnd", $transactionDateEnd, false, false);

            ?>

        </div>

        <div class="row">
            <div class="col-sm-10">
                <div>
                    <button type="submit" class="btn btn-info float-right">Sorgula
                    </button>
                </div>
            </div>
        </div>


    </form>


    <div style="text-align: center">
        <h4 style="color: #0b93d5">Sürücü Ödeme Geçmişleri</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sürücü Adı</th>
                                <th>İşlem Tarihi</th>
                                <th>Ödeme Tipi</th>
                                <th>Tutar</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>

                            <?php
                            $sira = 1;
                            $toplamKart = 0;
                            $toplamIban = 0;
                            $toplamNakit = 0;
                            while ($row = $result->fetch_array()) {


                                if ($row['paymentType'] == "CARD") {
                                    $toplamKart = $toplamKart + $row['paymentPrice'];
                                } else if ($row['paymentType'] == "IBAN") {
                                    $toplamIban = $toplamIban + $row['paymentPrice'];
                                } else if ($row['paymentType'] == "NAKIT") {
                                    $toplamNakit = $toplamNakit + $row['paymentPrice'];
                                }
                                ?>
                                <tr>
                                    <td style="font-weight: bold"><?php echo $sira; ?></td>
                                    <td><?php echo $row['shortName']; ?></td>
                                    <td><?php echo onlyDate($row['transactionDate']); ?></td>
                                    <td><?php echo $PAYMENT_TYPE[$row['paymentType']]; ?></td>
                                    <td><?php echo sayiFormatla($row['paymentPrice'], 2) . " ₺"; ?></td>
                                    <td>
                                        <a href="<?php echo "update/?id=" . $row['id']; ?>" class="btn btn-primary">Güncelle</a>

                                        <a href="<?php echo base_url_back() . "kusva/index.php?learnerDriverPaymentDelete=" . $row['id']; ?>"
                                           onclick="return confirm('Silmek istediğinizden emin misiniz?')"
                                           class="btn btn-danger">Sil</a>
                                    </td>
                                </tr>
                                <?php $sira++;
                            } ?>
                            </tbody>
                        </table>

                        <div>
                            <h3 style=" text-align: center">
                                Toplam Nakit <?php echo sayiFormatla($toplamNakit, 2) . " ₺" ?> </h3>
                            <h3 style="color: #0c525d; text-align: center">
                                Toplam Kart <?php echo sayiFormatla($toplamKart, 2) . " ₺" ?> </h3>
                            <h3 style="color: #0c525d; text-align: center">
                                Toplam IBAN (HAVALE) <?php echo sayiFormatla($toplamIban, 2) . " ₺" ?> </h3>

                            <h3 style="color: #0BD7FAFF; text-align: center">
                                GENEL
                                TOPLAM <?php echo sayiFormatla($toplamIban + $toplamKart + $toplamIban, 2) . " ₺" ?> </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

