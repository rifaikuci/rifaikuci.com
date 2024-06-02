<?php


$sql = "SELECT * FROM learnerDriver";
$result = $db->query($sql);


?>

<section class="content">

    <div style="text-align: center">
        <h4 style="color: #0b93d5">Sürücü Adayları Listesi</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div style="text-align: right;margin-right: auto">
                    <a href="insert/" class="btn btn-primary"><i class="fa fa-plus"><?php echo "\t\t\t\t" ?>
                            Ekle</i></a>
                </div>

                <br>
                <div class="card" id="payment-detail-show">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sürücü Adı</th>
                                <th>Kayıt Tarihi</th>
                                <th>Kalan Borç</th>
                                <th>Ödenen Borç</th>
                                <th style="text-align: center">İşlem</th>
                            </tr>
                            </thead>

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
                                    <td><?php echo sayiFormatla($kalan,0) . " TL"; ?></td>
                                    <td><?php echo sayiFormatla($odenen,0) . " TL"; ?></td>
                                    <td style="text-align: center">
                                        <button type="button" v-on:click="paymentDetail($event)"
                                                class="btn btn-dark"
                                                data-toggle="modal" data-driverid="<?php echo $learnerDriverId ?>">
                                            Ödeme Detayları
                                        </button>
                                        <a href="<?php echo "update/?id=" . $row['id']; ?>" class="btn btn-primary">Görüntüle</a>
                                        <a href="<?php echo "payment/?id=" . $row['id']; ?>" class="btn btn-success">Ödeme Yap</a>
                                        <a href="<?php echo base_url_back() . "kusva/index.php?learnerDriverDelete=" . $row['id']; ?>"
                                           class="btn btn-danger">Sil</a>

                                    </td>
                                </tr>
                                <?php $sira++;
                            } ?>
                            </tbody>
                        </table>

                        <div id="modalviewpayment" class="modal fade show" role="dialog">
                            <div class="modal-dialog modal-xl">

                                <div class="modal-content">
                                    <div style="margin: 10px">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


