<?php

$today = new DateTime();
$today->modify('-18 years');
$birthDateDefault = $today->format('Y-m-d');


$groupList =   getAllData("learnerDriverGroup","",$db);

$groupData = array();
for($k = 0 ; $k < count($groupList); $k++) {
    $groupData[$groupList[$k]['id']] = $groupList[$k]['groupName'];
}
?>

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("learnerDriverUserInsert", "learnerDriverUserInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Senet Alış</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(4, "Ad Soyad", "", "shortName", "", false, false);
                    getSelect(8,$groupData, "Grup Listesi","groupId","blue",false,false,true,false);
                    getTextInput(4, "Telefon No", "05555555555", "phone", "", false, false);
                    getTextInput(4, "T.C. Kimlik No", "11111111110", "identityNo", "", false, false);
                    getDatetime(3, "Kayıt Tarihi", "registerDate", "", false, false);
                    getNumberInput(4, "Kayıt Tutarı", "1232", "debit", '', 1, 0, "", false, false);

                    ?>

                </div>

            </div>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


