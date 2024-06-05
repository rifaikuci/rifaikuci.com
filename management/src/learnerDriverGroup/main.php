<section class="content">
    <?php statusAlert(); ?>

    <?php $data = getAllData("learnerDriverGroup",'', $db);
    $isVisibleColumn = ["counter", "groupName", "insertDate"];
    $columnName = [ "#", "Grup Adı", "Kayıt Tarihi"];

    for ($i = 0; $i<count($data); $i++) {
        $data[$i]['insertDate'] = dateString($data[$i]['insertDate']);
    }
    ?>
    <section class="content">

    <?php statusAlert(); ?>


    <div style="text-align: center">
        <h4 style="color: #0b93d5">Grup Listesi</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div style="text-align: right;margin-right: auto">
                    <a href="insert/" class="btn btn-primary"><i class="fa fa-plus"><?php echo "\t\t\t\t" ?>
                            Ekle</i></a>
                </div>

                <br>
                <div class="card" id="group-detail-show">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Grup Adı</th>
                                <th>Kayıt Tarihi</th>
                                <th style="text-align: center">İşlem</th>
                            </tr>
                            </thead>

                            <?php $sira = 1;
                            for ($i = 0; $i<count($data); $i++) {

                                $row = $data[$i];
                                $groupId =  $row['id'];
                                ?>
                                <tr>
                                    <td><?php echo $sira; ?></td>
                                    <td><?php echo $row['groupName']; ?></td>
                                    <td><?php echo $row['insertDate']; ?></td>
                                    <td style="text-align: center">
                                        <button type="button" v-on:click="groupDetail($event)"
                                                class="btn btn-dark"
                                                data-toggle="modal" data-groupId="<?php echo $groupId ?>">
                                            Grup Detayları
                                        </button>
                                        <a href="<?php echo "update/?id=" . $row['id']; ?>" class="btn btn-primary">Güncelle</a>
                                        <a href="<?php echo base_url_back() . "kusva/index.php?learnerDriverGroupDelete=" . $row['id']; ?>"
                                           onclick="return confirm('Silmek istediğinizden emin misiniz?')"
                                           class="btn btn-danger">Sil</a>

                                    </td>
                                </tr>
                                <?php $sira++;
                            } ?>
                            </tbody>
                        </table>

                        <div id="modalviewgroup" class="modal fade show" role="dialog">
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




